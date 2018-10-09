<?php

class UserModel extends Model{

    const COOKIE_SESSION_VAR_NAME = 'PHPSESSID';

    public function __construct(){
        parent::__construct(Base::instance()->get('DB'), 'users');
    }

    /**
     * @return UserModel by cookie session variable name
     */
    public function get_auth(){
        $user = new self;
        $user->load(['`sessid`=?', Base::instance()->get('COOKIE.'.self::COOKIE_SESSION_VAR_NAME)]);
        return $user;
    }

    /**
     * Завершает сессию пользователя
     */
    public function logoff(){
        Base::instance()->set('COOKIE.'.self::COOKIE_SESSION_VAR_NAME, null);
        $this->reset();
    }

    public function authorize(){
        $this->sessid = md5(rand(100000, 999999).microtime(true).rand(100000, 999999));
        Base::instance()->set('COOKIE.PHPSESSID', $this->sessid);
        $this->save();
    }

    public function label_name(){
        $result = trim($this->name . ' ' .$this->surname);
        if($result)
            return $result;

        return 'No enter name';
    }

    public static function ValidPost($data){

    }

    public function get_property_roles($value){
        return array_map('trim', explode(',', $value));
    }
    public function set_property_roles($value){
//        echo "set_property_roles, ID:{$this->id} ";
//        var_dump($value);
    }


    public function access($permission){
        $permissions = [
            'admin_access' => [
                2 => true,
                4 => true,
                6 => true,
            ],
            'stop_servers' => [
                2 => true,
                4 => true,
                6 => true,
            ],
            'start_servers' => [
                2 => true,
                4 => true,
                6 => true,
            ]
        ];

        if(array_key_exists($permission, $permissions) && array_key_exists($this->id, $permissions[$permission]))
            return $permissions[$permission][$this->id];

        return null;

    }





    public function valid()
    {
        $errors = []; // Массив ошибок

        // Проверка поля почты на заполненность
        if (empty($this->email)) {
            $errors['email'] = 'Поле "email" обязательное для ввода!';
        }

        // Валидация поля почты(Встроенная F3)
        $hosts = [];
        $mx = true;
        $result = is_string(filter_var($this->email, FILTER_VALIDATE_EMAIL)) && (!$mx || getmxrr(substr($this->email, strrpos($this->email, '@') + 1), $hosts));
        if ($result != true) {
//            $errors['email'] = 'Неверный формат почты!';
            $errors['code'] = 999;
            $errors['action'] = 'email';
            $errors['description'] = 'Неверный формат почты!';
        }
        // Проверяем наличие пользователя в БД
        $result_email = $this->find(['`email` = ?', $this->email]);
        if (!empty($result_email)) {
//            $errors['email'] = 'Такой пользователь существует!';
            $errors['code'] = 998;
            $errors['action'] = 'email';
            $errors['description'] = 'Пользователь с таким email уже существует!';
        }
        // Проверка поля Имя
        if (empty($this->name)) {
            $errors['name'] = 'Поле обязательное для ввода!';
            $errors['action'] = 'name';
            $errors['description'] = 'Поле "Имя" обязательное для ввода!';
        }
        // Проверяем наличие пользователя в БД
        $result_name = $this->find(['`name` = ?', $this->name]);
        if (!empty($result_name)) {
//            $errors['email'] = 'Такой пользователь существует!';
            $errors['code'] = 997;
            $errors['action'] = 'name';
            $errors['description'] = 'Пользователь с таким именем уже существует!';
        }
        // Возвращаем результат
        if(empty($errors)){
            $errors['code'] = 0;
            $errors['action'] = 'registration';
            $errors['description'] = 'OK';
            return $errors;
        }else{
            return $errors;
        }
    }

    public function GetNameByID($id){
        $result = new self();
        $user_info = $result->load(['`id`=?', $id]);
        $result = $user_info->name;
        return $result;
    }

    public function GetInfoAllClients()
    {
        return $this->db->exec("SELECT * FROM `users` WHERE 1=1");
    }

    public function GetInfoClient($data)
    {
        $data = array_map(function ($value) {
            return intval($value);
        }, $data);
        $id_str = implode(", ", $data);
        return $this->db->exec("SELECT * FROM `users` WHERE `id` IN ($id_str)");
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