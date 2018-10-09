<?php

class Controller{

    public function __construct($f3){
        $f3->_GUEST = UserModel::instance()->get_auth();
    }

    public function Logoff($f3){
        $f3->get('_GUEST')->logoff();
        $f3->reroute('/');
    }

    public static function rand_string($lenght=8, $chars='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'){
        $result = '';
        for($i=0; $i<$lenght; $i++)
            $result.= $chars[rand(0, strlen($chars)-1)];
        return $result;
    }

}

?>