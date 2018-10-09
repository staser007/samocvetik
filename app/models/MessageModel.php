<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 16.02.2017
 * Time: 16:55
 */
class MessageModel extends Model {

    const
        TYPE_EMAIL = 'email',

        INTERVAL_BETWEEN_SENDING_SMS = 300,
        INTERVAL_BETWEEN_SENDING_EMAIL = 10,

        SMTP_HOST = 'smtp.yandex.ru',
        SMTP_LOGIN = 'aliska-ahead',
        SMTP_PASSWORD = 'dlhrng4i85',

        STATUS_DRAFT = 'draft',
        STATUS_TO_SEND = 'to send',
        STATUS_PROCESSED = 'processed',
        STATUS_SENT = 'sent',
        STATUS_SENT_FAIL = 'fail',
        STATUS_DELIVERED = 'delivered';

    public $error = null;

    public function __construct(){
        parent::__construct(Base::instance()->get('DB'), 'messages');
    }

    /**
     * Enqueue message to send
     * @param array $options
     * @return MessageModel with loaded enqueue messages
     */
    public function enqueue($options=[]){
        $options = array_merge([
            'type' => self::TYPE_EMAIL,
            'to' => null,
            'subject' => null,
            'message' => null,
            'msg_params' => null,
            'sender' => 0,
            'recipient' => 0,
        ], $options);

        $add_ids = [];

        if($options['type'] == self::TYPE_EMAIL){
            $emails = is_array($options['to']) ? $options['to'] : preg_split('/[\s,;]+/', $options['to'], -1, PREG_SPLIT_NO_EMPTY);
            if(is_array($options['msg_params']) && !is_array($options['msg_params'][0])){
                $params = $options['msg_params'];
                $options['msg_params'] = [];
                for($i=0; $i<count($emails); $i++)
                    $options['msg_params'][]=$params;
            }
            foreach($emails as $index => $email){
                $message = new self;
                $message->type = $options['type'];
                $message->sender = $options['sender'];
                $message->recipient = $options['recipient'];
                $message->to = $email;
                $message->subject = $options['subject'];
                $message->message = empty($options['msg_params'])?$options['message']:vsprintf($options['message'], array_shift($options['msg_params'])) ;
                $message->date_created = date('Y-m-d H:i:s');
                $message->status = self::STATUS_TO_SEND;
                $message->save();
                array_push($add_ids, $message->id);
            }
        }
        $result = new self();
        if(count($add_ids) == 0)
            return $result;

        $result->load(['`id` IN ('.implode(',', $add_ids).')']);
        return $result;
    }

    /**
     * Try sending a message
     * @return string|false - result error or false if success
     */
    public function send(){
        while(!$this->dry()){
            $method = '_send_' . $this->type . '_message';
            if(!method_exists($this, $method)){
                $this->status = self::STATUS_SENT_FAIL;
                $this->save();
            }
            $this->$method();
            $this->next();
        }
    }
    private function _send_email_message(){
        $recipient_name = 'Client';
        if($this->recipient > 0){
            $recipient_model = UserModel::instance()->get_by_id($this->recipient);
            if(!$recipient_model->dry()){
                $recipient = trim(ucfirst($recipient_model->name));
                $recipient_name = $recipient ? $recipient : $recipient_name;
            }
        }



        $smtp = new SMTP(self::SMTP_HOST, 465, 'ssl', self::SMTP_LOGIN, self::SMTP_PASSWORD);



        $smtp->set('Content-type', 'text/html; charset=UTF-8');
        $smtp->set('From', 'no-reply <aliska-ahead@yandex.ru>');
        $smtp->set('To',  '"'.$recipient_name.'" <'.$this->to.'>');
        $smtp->set('Subject', $this->subject);

        if($smtp->send($this->message)){
//            echo '<pre>'.$smtp->log().'</pre>';
//            die;
            $this->date_sent = date('Y-m-d H:i:s');
            $this->status = MessageModel::STATUS_SENT;
            $this->save();
            return false;
        }

        $this->status = MessageModel::STATUS_SENT_FAIL;
        $this->save();
        return 'Message could not be sent';
    }

}