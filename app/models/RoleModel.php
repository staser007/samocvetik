<?php

class RoleModel extends Model{

    public function __construct(){
        parent::__construct(Base::instance()->get('DB'), 'roles');
    }

}
?>