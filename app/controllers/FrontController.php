<?php

class FrontController extends Controller{

    /**
     * Входная точка контроллера
     * @param $f3 Base
     */
    public function Index($f3){

        var_dump($f3->get('menu'));
        die;


        $action = $f3->get('PARAMS.action'); // Текущая страница
        if ($action == NULL) $action = 'index'; // Если страница не указана, то перевод на index.html

        $article = ArticleModel::instance()->get_by_name($action);  // Берем из БД блок контента
        if ($article->dry()){ // Если нет $action, то выдаём 404
            $f3->error(404);
        }

        $f3->mset([
            'action' => $action,
            'title' => $article->title,
            'keywords' => $article->keywords,
            'description' => $article->description,
            'content' => $article->content,
        ]);

        $method = $action.'_page';
        if(method_exists($this, $method))
            $this->$method($f3);

        echo Template::instance()->render('Front/layout.tpl');

    }

    /**
     * Расписание матчей
     * @param $f3 Base
     */
    private function catalog_page($f3){
        $f3->set('content', Template::instance()->render('Front/catalog.tpl'));
    }

    /**
     * Страница регистрации
     * @param $f3 Base
     */
    private function reg_page($f3){
        $f3->set('content', Template::instance()->render('Front/reg.tpl'));
    }

    /**
     * История матчей
     * @param $f3 Base
     */
    private function history_page($f3){
        MessageModel::instance()->enqueue([
            'to' => ['mpm6@yandex.ru'],
            'subject' => 'New user register in cybersport',
            'message' => 'New user: register in cybersport with password: ',
            'msg_params' => null,
            'sender' => 0,
            'recipient' => 0,
        ])->send();
    }

    /**
     * Страница TOP 5
     * @param $f3 Base
     */
    private function top_teams_page($f3){
        $f3->mset([
            'content' => Template::instance()->render('Front/top_teams.tpl'),
        ]);

    }

    /**
     * @param $f3 Base
     */
    private function progress_page($f3){
        $f3->mset([
            'content' => Template::instance()->render('Front/progress.tpl'),
        ]);
    }


    public function Login() // Авторизация
    {
        $email = $this->f3->get('POST.email'); // Получаем параметры из POST
        $password = $this->f3->get('POST.password');
        if (!empty($email) && !empty($password)) {
            $user = new UserModel(); // Ищем пользователя в БД
            $user->load(['`email` = ? AND `password` = ?', $email, md5($password)]);
            if ($user->dry()) {
                die(json_encode([
                    "code" => 1,
                    "description" => "Неверные параметры авторизации! Проверьте логин или пароль!",
                ]));
                $this->f3->set('alert', 'Неверные параметры авторизации! Проверьте логин или пароль!');
                echo Template::instance()->render('Front/layout.tpl');
                return null;
            }
            $user->sessid = md5(rand(100000, 999999).microtime(true).rand(100000, 999999));
            $this->f3->set('COOKIE.PHPSESSID', $user->sessid);
            $user->save();

            if(!empty($this->f3->get("client")->meet))
            {

            }

            die(json_encode([
                "code" => 0,
                "description" => $user->id,
            ]));
            $this->f3->reroute('Front/catalog.html');
        } else {
            $this->f3->set('alert', 'Не все поля заполнены!');
            echo Template::instance()->render('Front/layout.tpl');
            exit;
            die(json_encode([
                "code" => 2,
                "description" => "Не все поля заполнены!",
            ]));
        }
    }

    public function ChangeUserInfo(){
        $user = new UserModel();
        $data = $this->f3->get('POST');
        $errors = $user->ChangeInfo($data);
        die($errors);
    }

//    public function Registration()
//    {
//        $user = new UserModel(); // Ищем пользователя в БД
//        $user->copyfrom('POST');
//        $errors = $user->valid();
//
//        if ($errors['code'] != 0) // Неудачная проверка
//        {
//            die(json_encode($errors));
//        } else { // Удачная проверка
//            if ($errors['code'] == 0) {
//                $arr = array(
//                    'a', 'b', 'c', 'd', 'e', 'f',
//                    'g', 'h', 'i', 'j', 'k', 'l',
//                    'm', 'n', 'o', 'p', 'r', 's',
//                    't', 'u', 'v', 'x', 'y', 'z',
//                    'A', 'B', 'C', 'D', 'E', 'F',
//                    'G', 'H', 'I', 'J', 'K', 'L',
//                    'M', 'N', 'O', 'P', 'R', 'S',
//                    'T', 'U', 'V', 'X', 'Y', 'Z',
//                    '1', '2', '3', '4', '5', '6',
//                    '7', '8', '9', '0',
//                );
//                // Генерируем пароль
//                $number = 6; // Длина пароля
//                $pass = "";
//                for ($i = 0; $i < $number; $i++) {
//                    // Вычисляем случайный индекс массива
//                    $index = rand(0, count($arr) - 1);
//                    $pass .= $arr[$index];
//                }
//                $pass = 111111;
//                $user->password = md5($pass);
//                if ($user->save()) {
//                    $this->f3->set('SESSION.user_id', $user->id);
//                    $subject = "Регистрация на CyberSport";
//                    $message = "Учётная запись ".$user->email." успешно создана. Ваш пароль: ".$pass;
//                    SendMail::Instance()->SendMessage($user->email, $subject, $message);
//                    //echo SendMail::Instance()->log();
//                    die(json_encode($errors));
//                }
//            }
//        }
//    }

    public function RestorePassword()
    {
        $user = new UserModel(); // Ищем пользователя в БД
        $email = $this->f3->get('POST.email');
        $hosts = [];
        $mx = true;
        $result = is_string(filter_var($email, FILTER_VALIDATE_EMAIL)) && (!$mx || getmxrr(substr($email, strrpos($email, '@') + 1), $hosts));
        if ($result != true) {
            $errors = [
                'code' => 999,
                'description' => 'Неверный формат почты!',
            ];
            die(json_encode($errors));
        }
        /* Найти пользователя в БД*/
        $users = $user->find([' email = ?', $email]);
        if(count($users) == 0){
            $errors = [
                'code' => 999,
                'description' => 'Пользователь '.$email.' не найден!',
                'errors' => '',
                'email' => $email,
            ];
            die(json_encode($errors));
        }
        /**************************/

        $arr = array(
            'a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S',
            'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0',
        );
        // Генерируем пароль
        $number = 6; // Длина пароля
        $pass = "";
        for ($i = 0; $i < $number; $i++) {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        $users[0]->password = md5($pass);
        if ($users[0]->save()) {
            $this->f3->set('SESSION.user_id', $users[0]->id);
            $subject = "Восстановление пароля на уд-аукцион.рф";
            $message = "Для учётной записи ".$users[0]->email." создан новый пароль: ".$pass;
            SendMail::Instance()->SendMessage($users[0]->email, $subject, $message);
            //echo SendMail::Instance()->log();
            $errors = [
                'code' => 0,
                'description' => 'ok',
                'errors' => '',
                'email' => $email,
            ];
            die(json_encode($errors));
        }


    }

    public function ViewCatalog()
    {
//        $lot_model = new LotModel();
//        $opened_lots = $lot_model->GetOpenedLots();
//        $this->f3->mset([
//            'content_template' => 'Front/catalog.tpl',
//            'ViewCatalog' => $opened_lots,
//        ]);
//        echo Template::instance()->render('Front/layout.tpl');
    }

    private function football_history_page(){
        $game_id = 1;
        $status = 'finished';
        $result = $balls = [];
        $balls_model = new DrawingModel();
        $users = new UserModel();
        $teams = new TeamModel();
        $meet = new MeetModel();
        $meets = $meet->find(['`game_id` = ? AND `status` = ?', $game_id, $status]);
        foreach($meets as $key=>$value)
        {
            if($value['drawing'] > 0){
                $balls[$value['id']] = $balls_model->GetBallsMeet($value['drawing']);
            }
            $commands = $players =[];
            $info = json_decode($value['teams'], JSON_FORCE_OBJECT);
            foreach($info as $k=>$v)
            {
                $com = $teams->load(['`id` = ?', $k]);
                $commands[] =$com['club'];
                $play = $users->load(['`id` = ?', $v]);
                $players[] = $play['name'];
            }
            $result[$value['id']] = [
                "id" => $value['id'],
                "commands" => $commands,
                "players" => $players,
                "details" => json_decode($value['details'], JSON_FORCE_OBJECT),
                "date_shedule" => $value['date_shedule'],
            ];
        }
        $this->f3->mset([
            'result' => $result,
            'balls' =>$balls
        ]);

        $this->f3->mset([
            'content' => Template::instance()->render('Front/football_history.tpl'),
        ]);
        
    }

    private function hockey_history_page(){
//        if(!empty($this->f3->get("GET.id"))){
//            $id = $this->f3->get("GET.id");
//            $balls_model = new DrawingModel();
//            $balls = $balls_model->GetBallsMeet($id);
//        }
        $game_id = 2;
        $status = 'finished';
        $result = $balls = [];
        $balls_model = new DrawingModel();
        $users = new UserModel();
        $teams = new TeamModel();
        $meet = new MeetModel();
        $meets = $meet->find(['`game_id` = ? AND `status` = ? ', $game_id, $status]);
        foreach($meets as $key=>$value)
        {
            if($value['drawing'] > 0){
                $balls[$value['id']] = $balls_model->GetBallsMeet($value['drawing']);
            }
            $commands = $players =[];
            $info = json_decode($value['teams'], JSON_FORCE_OBJECT);
            foreach($info as $k=>$v)
            {
                $com = $teams->load(['`id` = ?', $k]);
                $commands[] =$com['club'];
                $play = $users->load(['`id` = ?', $v]);
                $players[] = $play['name'];
            }
            $result[$value['id']] = [
                "id" => $value['id'],
                "commands" => $commands,
                "players" => $players,
                "details" => json_decode($value['details'], JSON_FORCE_OBJECT),
                "date_shedule" => $value['date_shedule'],
            ];
        }

        $res = array_reverse($result);
        $this->f3->mset([
            'result' => $res,
            'balls' =>$balls
        ]);

        $this->f3->mset([
            'content' => Template::instance()->render('Front/hockey_history.tpl'),
        ]);

    }

    private function rugbi_history_page(){
        $game_id = 3;
        $status = 'finished';
        $result = $balls = [];
        $balls_model = new DrawingModel();
        $users = new UserModel();
        $teams = new TeamModel();
        $meet = new MeetModel();
        $meets = $meet->find(['`game_id` = ? AND `status` = ? ', $game_id, $status]);
        foreach($meets as $key=>$value)
        {
            if($value['drawing'] > 0){
                $balls[$value['id']] = $balls_model->GetBallsMeet($value['drawing']);
            }
            $commands = $players =[];
            $info = json_decode($value['teams'], JSON_FORCE_OBJECT);
            foreach($info as $k=>$v)
            {
                $com = $teams->load(['`id` = ?', $k]);
                $commands[] =$com['club'];
                $play = $users->load(['`id` = ?', $v]);
                $players[] = $play['name'];
            }
            $result[$value['id']] = [
                "id" => $value['id'],
                "commands" => $commands,
                "players" => $players,
                "details" => json_decode($value['details'], JSON_FORCE_OBJECT),
                "date_shedule" => $value['date_shedule'],
            ];
        }
        $this->f3->mset([
            'result' => $result,
            'balls' =>$balls
        ]);

        $this->f3->mset([
            'content' => Template::instance()->render('Front/rugbi_history.tpl'),
        ]);

    }

    private function ebocce_history_page(){
        $game_id = 4;
        $status = 'finished';
        $result = $balls = [];
        $balls_model = new DrawingModel();
        $users = new UserModel();
        $teams = new TeamModel();
        $meet = new MeetModel();
        $meets = $meet->find(['`game_id` = ? AND `status` = ? ', $game_id, $status]);
        foreach($meets as $key=>$value)
        {
            if($value['drawing'] > 0){
                $balls[$value['id']] = $balls_model->GetBallsMeet($value['drawing']);
            }
            $commands = $players =[];
            $info = json_decode($value['teams'], JSON_FORCE_OBJECT);
            foreach($info as $k=>$v)
            {
                $com = $teams->load(['`id` = ?', $k]);
                $commands[] =$com['club'];
                $play = $users->load(['`id` = ?', $v]);
                $players[] = $play['name'];
            }
            $result[$value['id']] = [
                "id" => $value['id'],
                "commands" => $commands,
                "players" => $players,
                "details" => json_decode($value['details'], JSON_FORCE_OBJECT),
                "date_shedule" => $value['date_shedule'],
            ];
        }
        $this->f3->mset([
            'result' => $result,
            'balls' =>$balls
        ]);

        $this->f3->mset([
            'content' => Template::instance()->render('Front/ebocce_history.tpl'),
        ]);

    }

    private function registration_page(){
        $this->f3->mset([
            'content' => Template::instance()->render('Front/registration.tpl'),
        ]);

    }

    private function football_play_page(){
        $meets = MeetModel::instance()->get_coming_meet();

        $this->f3->set('meets', []);
        foreach ($meets as $meet){
            $teams = json_decode($meet->teams, true);
            foreach ($teams as $key=>$value){
                $user = $value;
                $teams[$key] = [
                    'team_name' => TeamModel::instance()->get_by_id($key)->club,
                    'user' => $user,
                ];
            }
            $this->f3->push('meets', [
                'id' => $meet->id,
                'teams' => $teams,
                'game_id' => $meet->game_id,
                'date_shedule' => $meet->date_shedule,
            ]);
        }
        $this->f3->mset([
            'content' => Template::instance()->render('Front/football_play.tpl'),
        ]);

    }

    private function hockey_play_page(){
        $meets = MeetModel::instance()->get_coming_meet();

        $this->f3->set('meets', []);
        foreach ($meets as $meet){
            $teams = json_decode($meet->teams, true);
            foreach ($teams as $key=>$value){
                $user = $value;
                $teams[$key] = [
                    'team_name' => TeamModel::instance()->get_by_id($key)->club,
                    'user' => $user,
                ];
            }
            $this->f3->push('meets', [
                'id' => $meet->id,
                'teams' => $teams,
                'game_id' => $meet->game_id,
                'date_shedule' => $meet->date_shedule,
            ]);
        }
        $this->f3->mset([
            'content' => Template::instance()->render('Front/hockey_play.tpl'),
        ]);

    }

    private function rugbi_play_page(){
        $meets = MeetModel::instance()->get_coming_meet();

        $this->f3->set('meets', []);
        foreach ($meets as $meet){
            $teams = json_decode($meet->teams, true);
            foreach ($teams as $key=>$value){
                $user = $value;
                $teams[$key] = [
                    'team_name' => TeamModel::instance()->get_by_id($key)->club,
                    'user' => $user,
                ];
            }
            $this->f3->push('meets', [
                'id' => $meet->id,
                'teams' => $teams,
                'game_id' => $meet->game_id,
                'date_shedule' => $meet->date_shedule,
            ]);
        }
        $this->f3->mset([
            'content' => Template::instance()->render('Front/rugbi_play.tpl'),
        ]);

    }

    private function ebocce_play_page(){
        $meets = MeetModel::instance()->get_coming_meet();

        $this->f3->set('meets', []);
        foreach ($meets as $meet){
            $teams = json_decode($meet->teams, true);
            foreach ($teams as $key=>$value){
                $user = $value;
                $teams[$key] = [
                    'team_name' => TeamModel::instance()->get_by_id($key)->club,
                    'user' => $user,
                ];
            }
            $this->f3->push('meets', [
                'id' => $meet->id,
                'teams' => $teams,
                'game_id' => $meet->game_id,
                'date_shedule' => $meet->date_shedule,
            ]);
        }
        $this->f3->mset([
            'content' => Template::instance()->render('Front/ebocce_play.tpl'),
        ]);

    }



    private function top_football_page(){
        $stat = new StatModel();
        $top = $stat->GetTOPTeamFootball();
        if(!empty($top)){
            foreach($top as $k=>$v){
                $a[$v['club']] = $v['pts'];
            }
            asort($a);
            $top = array_reverse($a, true);
            $this->f3->mset([
                'rating' => $top,
            ]);
        }
        $this->f3->mset([
            'rating' => [
                'Реал Сосьедад' => 104,
                'Сельта' => 89,
                'Гранада' =>45,
                'Милан' => 15,
                'Атлетик Бильбао' => 14
            ],
        ]);
        $this->f3->mset([
            'content' => Template::instance()->render('Front/top_football.tpl'),
        ]);

    }

    private function top_hockey_page(){
        $stat = new StatModel();
        $top = $stat->GetTOPTeamHockey();
        if(!empty($top)){
            foreach($top as $k=>$v){
                $a[$v['club']] = $v['pts'];
            }
            asort($a);
            $top = array_reverse($a, true);
            $this->f3->mset([
                'rating' => $top,
            ]);
        }
        $this->f3->mset([
            'content' => Template::instance()->render('Front/top_hockey.tpl'),
        ]);

    }

    private function top_rugbi_page(){
        $stat = new StatModel();
        $top = $stat->GetTOPTeamRugbi();
        if(!empty($top)){
            foreach($top as $k=>$v){
                $a[$v['club']] = $v['pts'];
            }
            asort($a);
            $top = array_reverse($a, true);
            $this->f3->mset([
                'rating' => $top,
            ]);
        }

        $this->f3->mset([
            'rating' => [
                'ВВА-Подмосковье' => 159,
                'Империя' => 156,
                'Металлург' =>101,
                'Слава-ЦСП' => 56,
                'Кубань' => 3
            ],
        ]);
        $this->f3->mset([
            'content' => Template::instance()->render('Front/top_rugbi.tpl'),
        ]);

    }

    private function rating_football_page(){
        $status_arr = [
            0 => 'Любитель',
            50 =>'Третий юношеский спортивный разряд',
            100 => 'Второй юношеский спортивный разряд',
            200 => 'Первый юношеский спортивный разряд',
            300 => 'Третий спортивный разряд',
            400 => 'Второй спортивный разряд',
            500 => 'Первый спортивный разряд',
            600 => 'Кандидат в мастера спорта',
            800 => 'Мастер спорта',
            1000 => 'Мастер спорта международного класса',
        ];

        $stat = new StatModel();
        $rating = $stat->GetRatingClientFootball();
        if(!empty($rating)){
            foreach($rating as $k=>$v){
                $a[$v['name']] = $v['pts'];
            }
            asort($a);
            $rating = array_reverse($a, true);
            foreach($rating as $k=>$v){
                if($v < 50){
                    $status_user[$k] = $status_arr[0];
                }elseif($v >= 50 && $v < 100){
                    $status_user[$k] = $status_arr[50];
                }elseif($v >= 100 && $v < 200){
                    $status_user[$k] = $status_arr[100];
                }elseif($v >= 200 && $v < 300){
                    $status_user[$k] = $status_arr[200];
                }elseif($v >= 300 && $v < 400){
                    $status_user[$k] = $status_arr[300];
                }elseif($v >= 400 && $v < 500){
                    $status_user[$k] = $status_arr[400];
                }elseif($v >= 500 && $v < 600){
                    $status_user[$k] = $status_arr[500];
                }elseif($v >= 600 && $v < 800){
                    $status_user[$k] = $status_arr[600];
                }elseif($v >= 800 && $v < 1000){
                    $status_user[$k] = $status_arr[800];
                }elseif($v >= 1000){
                    $status_user[$k] = $status_arr[1000];
                }
            }
            $this->f3->mset([
                'rating' => $rating,
                'status_user' => $status_user,
            ]);
        }
        $this->f3->mset([
            'content' => Template::instance()->render('Front/rating_football.tpl'),
        ]);

    }

    private function rating_hockey_page(){
        $status_arr = [
            0 => 'Любитель',
            50 =>'Третий юношеский спортивный разряд',
            100 => 'Второй юношеский спортивный разряд',
            200 => 'Первый юношеский спортивный разряд',
            300 => 'Третий спортивный разряд',
            400 => 'Второй спортивный разряд',
            500 => 'Первый спортивный разряд',
            600 => 'Кандидат в мастера спорта',
            800 => 'Мастер спорта',
            1000 => 'Мастер спорта международного класса',
        ];

        $stat = new StatModel();
        $rating = $stat->GetRatingClientHockey();
        if(!empty($rating)){
            foreach($rating as $k=>$v){
                $a[$v['name']] = $v['pts'];
            }
            asort($a);
            $rating = array_reverse($a, true);
            foreach($rating as $k=>$v){
                if($v < 50){
                    $status_user[$k] = $status_arr[0];
                }elseif($v >= 50 && $v < 100){
                    $status_user[$k] = $status_arr[50];
                }elseif($v >= 100 && $v < 200){
                    $status_user[$k] = $status_arr[100];
                }elseif($v >= 200 && $v < 300){
                    $status_user[$k] = $status_arr[200];
                }elseif($v >= 300 && $v < 400){
                    $status_user[$k] = $status_arr[300];
                }elseif($v >= 400 && $v < 500){
                    $status_user[$k] = $status_arr[400];
                }elseif($v >= 500 && $v < 600){
                    $status_user[$k] = $status_arr[500];
                }elseif($v >= 600 && $v < 800){
                    $status_user[$k] = $status_arr[600];
                }elseif($v >= 800 && $v < 1000){
                    $status_user[$k] = $status_arr[800];
                }elseif($v >= 1000){
                    $status_user[$k] = $status_arr[1000];
                }
            }
            $this->f3->mset([
                'rating' => $rating,
                'status_user' => $status_user,
            ]);
        }
        $this->f3->mset([
            'content' => Template::instance()->render('Front/rating_hockey.tpl'),
        ]);

    }

    private function rating_rugbi_page(){
        $status_arr = [
            0 => 'Любитель',
            50 =>'Третий юношеский спортивный разряд',
            100 => 'Второй юношеский спортивный разряд',
            200 => 'Первый юношеский спортивный разряд',
            300 => 'Третий спортивный разряд',
            400 => 'Второй спортивный разряд',
            500 => 'Первый спортивный разряд',
            600 => 'Кандидат в мастера спорта',
            800 => 'Мастер спорта',
            1000 => 'Мастер спорта международного класса',
        ];

        $stat = new StatModel();
        $rating = $stat->GetRatingClientRugbi();
        if(!empty($rating)){
            foreach($rating as $k=>$v){
                $a[$v['name']] = $v['pts'];
            }
            asort($a);
            $rating = array_reverse($a, true);
            foreach($rating as $k=>$v){
                if($v < 50){
                    $status_user[$k] = $status_arr[0];
                }elseif($v >= 50 && $v < 100){
                    $status_user[$k] = $status_arr[50];
                }elseif($v >= 100 && $v < 200){
                    $status_user[$k] = $status_arr[100];
                }elseif($v >= 200 && $v < 300){
                    $status_user[$k] = $status_arr[200];
                }elseif($v >= 300 && $v < 400){
                    $status_user[$k] = $status_arr[300];
                }elseif($v >= 400 && $v < 500){
                    $status_user[$k] = $status_arr[400];
                }elseif($v >= 500 && $v < 600){
                    $status_user[$k] = $status_arr[500];
                }elseif($v >= 600 && $v < 800){
                    $status_user[$k] = $status_arr[600];
                }elseif($v >= 800 && $v < 1000){
                    $status_user[$k] = $status_arr[800];
                }elseif($v >= 1000){
                    $status_user[$k] = $status_arr[1000];
                }
            }
            $this->f3->mset([
                'rating' => $rating,
                'status_user' => $status_user,
            ]);
        }
        $this->f3->mset([
            'content' => Template::instance()->render('Front/rating_rugbi.tpl'),
        ]);

    }

}

?>