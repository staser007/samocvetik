<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 25.07.2017
 * Time: 21:17
 */
class MeetModel extends Model{

    const
        STATUS_CANCELLED = 'cancelled',     // Отменен
        STATUS_WAITING   = 'waiting',       //
        STATUS_RUNS      = 'runs',          // Выполняется
        STATUS_FINISHED  = 'finished',      // Завершен
        STATUS_SCHEDULED = 'scheduled';     // Запланирован

    public function __construct(){
        parent::__construct(Base::instance()->get('DB'), 'meets');
    }

    public function get_by_criteria($filter, $options=null, $ttl=0){
        $result = new self;
        $result->load($filter, $options, $ttl);
        return $result;
    }

    public function schedule_meet($game_kind, $count=1){
        $res = $this->db->exec("SELECT * FROM `meets` WHERE `game_kind`=? AND `status`=? ORDER BY `date_shedule` DESC LIMIT 1", [$game_kind, self::STATUS_SCHEDULED]);
        var_dump($res[0]['date_shedule']);
        die;
    }

    /**
     * Этот метод актуализирует и возвращает расписание ближайших встреч
     * @return array of MeetModel
     */
    public function get_coming_meet(){
        // Удалим из расписания просроченные встречи поставим их в отмененные
//        $now        = date("'Y-m-d H:i:s'");
//        $cancelled  = $this->db->exec("SELECT * FROM `meets` WHERE `status`='".self::STATUS_SCHEDULED."' AND `date_shedule`<$now");
//        $teams      = [0];
//        $clients    = [0];
//        foreach ($cancelled as $meet){
//            $t = json_decode($meet['teams'], true);
//            $teams   = array_merge($teams, array_keys($t));
//            $clients = array_merge($clients, array_values($t));
//        }
//        $sql = [
//            "UPDATE `teams` SET `status`=? WHERE `id` IN(".implode(',', $teams).")",
//            "UPDATE `users` SET `meet`='0' WHERE `id` IN(".implode(',', $clients).")",
//            "UPDATE `meets` SET `status`='".self::STATUS_CANCELLED."' WHERE `status`='".self::STATUS_SCHEDULED."' AND `date_shedule`<$now"
//        ];
//        $this->db->exec($sql, [[1=>TeamModel::STATUS_INACTIVE], [], []]);

        // Выберем встречи с актуальным расписанием
        $result = $this->find(['`status` in (?,?) AND `game_id`=?', self::STATUS_SCHEDULED, self::STATUS_WAITING, 1]);

        // Если встреч меньше 5, то добъем его до 5
//        $count = count($result);
//        if($count < 5){
//            $add_count = 5 - $count;
//            for($i=0; $i<$add_count; $i++){
//                array_push($result, $this->create_new_meet());
//            }
//        }

        // Выберем встречи с актуальным расписанием
        $result2 = $this->find(['`status` in (?,?) AND `game_id`=?', self::STATUS_SCHEDULED, self::STATUS_WAITING, 2]);

        // Если встреч меньше 5, то добъем его до 5
//        $count = count($result2);
//        if($count < 2){
//            $add_count = 2 - $count;
//            for($i=0; $i<$add_count; $i++){
//                array_push($result2, $this->create_new_meet(2));
//            }
//        }

        $result3 = $this->find(['`status` in (?,?) AND `game_id`=?', self::STATUS_SCHEDULED, self::STATUS_WAITING, 3]);

        return array_merge($result, $result2, $result3);
    }

    public function create_new_meet($game_id = 1){
        $team1 = TeamModel::instance()->get_inactive_team($game_id);
        $team1->status = TeamModel::STATUS_SCHEDULED;
        $team1->save();
        $team2 = TeamModel::instance()->get_inactive_team($game_id);
        $team2->status = TeamModel::STATUS_SCHEDULED;
        $team2->save();
        $result = new self;
        $result->reset();
        $result->teams = json_encode([
            $team1->id => 0,
            $team2->id => 0,
        ]);
        $result->status = MeetModel::STATUS_SCHEDULED;
        $result->game_id = $game_id;
        $result->date_shedule = date('Y-m-d H:i:s', time()+600);
        $result->save();
        return $result;
    }

}