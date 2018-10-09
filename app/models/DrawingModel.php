<?php


class DrawingModel extends DB\SQL\Mapper
{
    public function __construct()
    {
        parent::__construct(Base::instance()->get('DB'), 'drawing');
    }
    public function GetBallsMeet($id)
    {
        return $this->db->exec("SELECT * FROM `drawing` WHERE `id` = $id");
    }
}