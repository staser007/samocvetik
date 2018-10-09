<?php

/**
 * Created by PhpStorm.
 * User: egor
 * Date: 11.07.17
 * Time: 9:32
 */
class MatchModel extends DB\SQL\Mapper
{
    public function __construct()
    {
        parent::__construct(Base::instance()->get('DB'), 'teams');
    }

    public function GetAllMatch()
    {
        return $this->db->exec("SELECT * FROM `teams` WHERE `league` = 1");
    }
}
?>