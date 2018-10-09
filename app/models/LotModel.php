<?php

class LotModel extends DB\SQL\Mapper
{
    public $fio = NULL;
    public function __construct()
    {
        parent::__construct(Base::instance()->get('DB'), 'lots');
    }

    public function valid()
    {

        $errors = []; // Массив ошибок

        if (empty($this->first_price)) {
            $errors['first_price'] = 'Поле обязательное для ввода!';
            $errors['action'] = 'first_price';
            $errors['description'] = 'Поле обязательное для ввода!';
        }
        if (empty($this->end_price)) {
            $errors['first_price'] = 'Поле обязательное для ввода!';
            $errors['action'] = 'first_price';
            $errors['description'] = 'Поле обязательное для ввода!';
        }
        if (empty($this->step)) {
            $errors['step'] = 'Поле обязательное для ввода!';
            $errors['action'] = 'step';
            $errors['description'] = 'Поле обязательное для ввода!';
        }
        if (empty($this->start_trading)) {
            $errors['start_trading'] = 'Поле обязательное для ввода!';
            $errors['action'] = 'start_trading';
            $errors['description'] = 'Поле обязательное для ввода!';
        }
        if (empty($this->end_trading)) {
            $errors['end_trading'] = 'Поле обязательное для ввода!';
            $errors['action'] = 'end_trading';
            $errors['description'] = 'Поле обязательное для ввода!';
        }

        // Возвращаем результат
        return json_encode([
            'code' => empty($errors) ? 0 : 999,
            'description' => empty($errors) ? 'ok' : 'В форме найдены ошибки',
            'errors' => $errors,
        ]);
    }

    public function GetInfoAuction($number)
    {
        return $this->db->exec("SELECT * FROM `lots` WHERE `number` = $number");
    }

    public function GetInfoLots()
    {
        return $this->db->exec("SELECT * FROM `lots` GROUP BY `number`");
    }

    public function GetLots($id)
    {
        return $this->db->exec("SELECT * FROM `lots` WHERE `id`=$id");
    }

    public function GetClosedLots()
    {
        return $this->find(['`status` = ?', 0], ['group' => '`number`']);
    }

    public function GetClosedLotsCashBox()
    {
        return $this->find(['`status` = ?', 0], ['order' => '`id` DESC']);
    }

    public function GetOpenedLots()
    {
        return $this->find(['`status` = ?', 1], ['group' => '`number`']);
    }

    public function GetOpenedLotsCatalog_1()
    {
        $bidder[0] = $this->find(['`status` = ?  AND `bidder` = ?', 1, 0], ['order' => '`end_price` ASC']);
        $bidder[1] = $this->find(['`status` = ?  AND `bidder` > ?', 1, 0], ['order' => '`end_price` ASC']);
        return $bidder;
    }

    public function GetOpenedLotsCatalog()
    {
//        if($this->f3->client_id == 82){

//        }
        return $this->find(['`status` = ?', 1], ['order' => '`id` ASC']);
    }

    public function OpenAuction($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $id_str = implode(", ", $data);
        if ($this->db->exec(/*"UPDATE `lots` SET `status` = 1 WHERE `id` IN ($id_str)"*/"UPDATE `lots` SET `status` = 1 WHERE `number` IN ($id_str)")) {
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

    public function PayedAuction($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $id_str = implode(", ", $data);
        if ($this->db->exec("UPDATE `lots` SET `payed` = 1 WHERE `id` IN ($id_str)")) {
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

    public function UnPayedAuction($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $id_str = implode(", ", $data);
        if ($this->db->exec("UPDATE `lots` SET `payed` = 0 WHERE `id` IN ($id_str)")) {
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

    public function VisibledAuction($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $number_str = implode(", ", $data);
        if ($this->db->exec("UPDATE `lots` SET `visible` = 1 WHERE `number` IN ($number_str)")) {
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

    public function UnVisibledAuction($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $number_str = implode(", ", $data);
        if ($this->db->exec("UPDATE `lots` SET `visible` = 0 WHERE `number` IN ($number_str)")) {
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

    public function CloseAuction($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $id_str = implode(", ", $data);
        if ($this->db->exec(/*"UPDATE `lots` SET `status` = 0 WHERE `id` IN ($id_str)"*/"UPDATE `lots` SET `status` = 0 WHERE `number` IN ($id_str)")) {
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

    public function ChangeEndPrice($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $id = $data['lot_id'];
        $step = $data['step'];
        $bidder = $data['bidder'];
        $start_price = $data['start_price'];
        $previous_price = $data['previous_price'];

        $user_lot_model = new UserLotModel();
        $data['lot'] = $id;
        $get_all_changes = $user_lot_model->GetAllChangesLot($data);
        $user_change = $get_all_changes[0]->user;
//        var_dump(empty($user_change));
//        die;
        if(empty($user_change)){ // если ставка делается впервые, то конечную цену не увеличивать
            $end_price = $data['previous_price'];
            $step = 0;
        }else{
            $end_price = $data['previous_price'] + $data['step'];
        }
        $opdate = time();
        $status = $data['status'];
        $number = $data['number'];
        //die(json_encode($opdate));
        if ($this->db->exec(array(
            "UPDATE `lots` SET `end_price` = `end_price` + :step, `bidder` = :bidder WHERE `id` = :id",
            "INSERT INTO `user_lot` (`user`, `lot`, `step`, `start_price`, `previous_price`, `end_price`, `opdate`, `status`, `number`)
              VALUES (:user, :id, :step, :start_price, :previous_price, :end_price, :opdate, :status, :number)",
        ),
            array(
                ['step' => $step,
                    'bidder' => $bidder,
                    'id' => $id],
                ['user' => $bidder,
                    'id' => $id,
                    'step' => $step,
                    'start_price' => $start_price,
                    'previous_price' => $previous_price,
                    'end_price' => $end_price,
                    'opdate' => $opdate,
                    'status' => $status,
                    'number' => $number,]
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