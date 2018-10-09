<?php

class SendMail extends SMTP
{
    private static $_instance = NULL;
    public static function Instance()
    {
        if(is_null(self::$_instance))
        {
             self::$_instance = new self;
        }
        return self::$_instance;
    }
    public function __construct()
    {
        //parent::__construct('smtp.yandex.ru',465,'ssl','adudkolomna','reset123');
        parent::__construct('smtp.yandex.ru',465,'ssl','scantiness496','496fialka1984');
    }

    public function SendMessage($user_email, $subject, $message)
    {
        $this->set('Content-type', 'text/html; charset=UTF-8');
        //$this->set('From','adudkolomna<adudkolomna@yandex.ru>');
        $this->set('From','scantiness496<scantiness496@yandex.ru>');
        $this->set('To',$user_email.'<'.$user_email.'>');
        $this->set('Subject',$subject);
        $smtp_msg = $message;
        $this->send($smtp_msg);
    }
}