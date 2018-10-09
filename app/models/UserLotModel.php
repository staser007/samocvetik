<?php

class UserLotModel extends DB\SQL\Mapper
{
    public function __construct()
    {
        parent::__construct(Base::instance()->get('DB'), 'user_lot');
    }

    public function GetAllUserLots($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $user = $data['user'];
        return $this->find(['`user` = ?', $user], ['group' => '`lot`']);
    }

    public function GetAllChangesLot($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $lot = $data['lot'];
        return $this->find(['`lot` = ?', $lot], ['order' => '`opdate` DESC']);
    }
}