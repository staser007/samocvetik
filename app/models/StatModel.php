<?php

class StatModel extends Model{

    protected static $_instance = null;

    public static function instance(){
        if(is_null(self::$_instance))
            self::$_instance = new self;
        return self::$_instance;
    }

    public function __construct(){
        parent::__construct(Base::instance()->get('DB'), 'stat');
    }

    public function get_by_id($id){
        $result = new self;
        $result->load(['`id`=?', $id]);
        return $result;
    }

    public function GetRatingClientFootball()
    {
        return $this->db->exec("SELECT st.`user`, SUM(st.`result`) as `pts`, u.`name` FROM `stat` st LEFT JOIN `users` u ON st.`user`=u.`id` WHERE st.`game_id`=1 GROUP BY st.`user`");
    }

    public function GetRatingClientHockey()
    {
        return $this->db->exec("SELECT st.`user`, SUM(st.`result`) as `pts`, u.`name` FROM `stat` st LEFT JOIN `users` u ON st.`user`=u.`id` WHERE st.`game_id`=2 GROUP BY st.`user`");
    }

    public function GetRatingClientRugbi()
    {
        return $this->db->exec("SELECT st.`user`, SUM(st.`result`) as `pts`, u.`name` FROM `stat` st LEFT JOIN `users` u ON st.`user`=u.`id` WHERE st.`game_id`=3 GROUP BY st.`user`");
    }

    public function GetTOPTeamFootball()
    {
        return $this->db->exec("SELECT st.`team`, SUM(st.`result`) as `pts`, t.`club` FROM `stat` st LEFT JOIN `teams` t ON st.`team`=t.`id` WHERE st.`game_id`=1 GROUP BY st.`team`");
    }

    public function GetTOPTeamHockey()
    {
        return $this->db->exec("SELECT st.`team`, SUM(st.`result`) as `pts`, t.`club` FROM `stat` st LEFT JOIN `teams` t ON st.`team`=t.`id` WHERE st.`game_id`=2 GROUP BY st.`team`");
    }

    public function GetTOPTeamRugbi()
    {
        return $this->db->exec("SELECT st.`team`, SUM(st.`result`) as `pts`, t.`club` FROM `stat` st LEFT JOIN `teams` t ON st.`team`=t.`id` WHERE st.`game_id`=3 GROUP BY st.`team`");
    }

    public function GetStatTeam($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $id_str = implode(", ", $data);
        return $this->db->exec("SELECT * FROM `stat` WHERE `id` IN ($id_str)");
    }

    public function ChangeInfo($data){
        if ($this->db->exec(array(
            "UPDATE `users` SET `name` = :name, `surname` = :surname, `patronymic` = :patronymic, `adress` = :adress, `reg_flat` = :reg_flat, `car_number` = :car_number, `car` = :car, `car_number2` = :car_number2, `car2` = :car2 WHERE `id` = :id",
        ),
            array(
                [
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'patronymic' => $data['patronymic'],
                    'adress' => $data['adress'],
                    'reg_flat' => date("Y-m-d", strtotime($data['reg_flat'])),
                    'car_number' => $data['car_number'],
                    'car' => $data['car'],
                    'car_number2' => $data['car_number2'],
                    'car2' => $data['car2'],
                    'id' =>$data['id'],
                ],
            )
        )
        ) {
            return json_encode([
                'code' => 0,
                'description' => 'ok',
            ]);
        } else {
            return json_encode([
                'code' => 999,
                'description' => 'Ошибка изменения статуса',
            ]);
        }
    }
}

?>