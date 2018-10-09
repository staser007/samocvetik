<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 25.07.2017
 * Time: 21:51
 */
class TeamModel extends Model{

    const
        STATUS_INACTIVE = null,
        STATUS_SCHEDULED = 'scheduled';

    public function __construct(){
        parent::__construct(Base::instance()->get('DB'), 'teams');
    }


//    public function get_inactive_team($game_id){
//        $result = $this->find(['ISNULL(`status`) AND `game_id`=?', $game_id]);//['`status`=?', self::STATUS_INACTIVE]
//        return $result[0];
//    }

}