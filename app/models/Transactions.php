<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 05.06.2018
 * Time: 15:48
 */
class Transactions extends Prefab{

    /**
     * @param $f3 Base
     * @param bool $exec
     */
    public function save_user_form_from_admin($f3, $exec=false){

//        $errors = [];
//
//        $user_id = (int)$f3->get('PARAMS.item');
//        if("$user_id" !==  $f3->get('PARAMS.item')){
//            $errors[0] = 7005;
//            $user_id = 0;
//        }

        $errors = ValidatorModel::instance()->Valid([
            'name' => ['value'=>$f3->get('POST.name'), 'validators'=>'string(1,32)'],
            'surname' => ['value'=>$f3->get('POST.name'), 'validators'=>'string(1,32)'],
            'email' => ['value'=>$f3->get('POST.email'), 'validators'=>'required|email'],
            'phone' => ['value'=>$f3->get('POST.email'), 'validators'=>'phone'],
        ]);



//        $user = UserModel::instance()->get_by_id($user_id);
//        if(($user_id != 0) && ($user->dry())){
//            $errors[0] = 7005;
//        }
//
//
//        if(mb_strlen())

    }

}