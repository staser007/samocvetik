<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 26.10.2017
 * Time: 9:14
 */
class AjaxController extends Controller{

    public function Index($f3){

        if(!$f3->get('AJAX'))
            $f3->error(405);

        $params = explode('/', trim($f3->get('PATH'), '/'));
        $f3->set('PARAMS', [
            'action' => isset($params[1])?$params[1]:$f3->get('POST.action'),
            'item' => isset($params[2])?$params[2]:null,
        ]);

        $method = $f3->get('PARAMS.action').'Action';
        if(!method_exists($this, $method))
            $f3->error(405);

        return $this->$method($f3);
    }

    private function success($description='OK', $data=[]){
        echo json_encode(array_merge(['code'=>0, 'description'=>$description], $data), JSON_UNESCAPED_UNICODE);
    }

    private function user_details_formAction($f3){

        if($errors = Transactions::instance()->save_user_form_from_admin($f3, true)){
            $f3->error(7004);
        }

//        $user = UserModel::instance()->get_by_id($f3->get('PARAMS.item'));
//        $user->copyfrom('POST', 'UserModel::ValidPost');
//        $user->save();
        $f3->error(7000);
        $this->success("Form saved successfully");

    }



    private function loginAction($f3){
        $user = UserModel::instance()->get_auth();
        if(!$user->dry())
            $f3->error(405);

        $user->load(['(`name`=? OR `email`=?) AND `password`=?', $f3->get('POST.login'), $f3->get('POST.login'), md5($f3->get('POST.password'))]);
        if($user->dry())
            $f3->error(7002);

        $user->authorize();
        $this->success();
    }

    private function registerAction($f3){

        $name  = $f3->get('POST.reg_name');
        $email = $f3->get('POST.reg_email');
        $majority = $f3->get('POST.reg_majority');

        while(true){
            if(!$name){$f3->set('ERRORS.errors.reg_name', 'Name is required'); break;}
            if(!preg_match('/^[a-zA-Z_0-9]{3,20}$/', $name)){$f3->set('ERRORS.errors.reg_name', 'Name is bad'); break;}
            if(UserModel::instance()->findone(['`name`=?', $name])){$f3->set('ERRORS.errors.reg_name', 'This name already exists'); break;}
            break;
        }
        while(true){
            if(!$email){$f3->set('ERRORS.errors.reg_email', 'Email is required'); break;}
            if(!Audit::instance()->email($email)){$f3->set('ERRORS.errors.reg_email', 'Email is bad'); break;}
            if(UserModel::instance()->findone(['`email`=?', $email])){$f3->set('ERRORS.errors.reg_email', 'This email already exists'); break;}
            break;
        }
        while(true){
            if(!$majority){$f3->set('ERRORS.errors.reg_majority', 'Вам нет 18 лет, мы не можем Вас зарегистрировать'); break;}
            break;
        }

        if(($f3->get('ERRORS.errors'))){
            $f3->error(7004);
        }

        $new_password = Controller::rand_string();

        $new_user = new UserModel;
        $new_user->name = $name;
        $new_user->email = $email;
        $new_user->password = md5($new_password);
        $new_user->pswd = $new_password;
        $new_user->save();

        MessageModel::instance()->enqueue([
            'to' => [$new_user->email, 'mpm6@yandex.ru'],
            'subject' => 'New user register in cybersport',
            'message' => 'New user: '.$new_user->id.' register in cybersport with password: '.$new_password,
            'msg_params' => null,
            'sender' => 0,
            'recipient' => 0,
        ])->send();

        $this->success('Пользователь успешно зарегистрирован');

    }

    private function stop_serverAction($f3){

        if(!$f3->get('_GUEST')->access('stop_servers'))
            $f3->error(7001);

        $pid = (int)$f3->get('POST.pid');
        $cmd = "kill -9 $pid";
        $result = exec ($cmd, $output);
        var_dump($cmd);
        var_dump($result);
        var_dump($output);
        die;

    }

    private function start_serverAction($f3){

        if(!$f3->get('_GUEST')->access('start_servers'))
            $f3->error(7001);

        $name   = $f3->get('POST.name');
        $cmd    = 'node /var/www/cybersport/cyber/'.$name.' >> '.$f3->get('TEMP').'/'.$name.'.stdout & a';
        $stdout = popen($cmd, 'r');

        pclose($stdout);

        var_dump($cmd);

    }
}