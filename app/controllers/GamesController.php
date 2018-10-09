<?php

class GamesController extends Controller{

    private $meet;

    function Index($f3){

        $f3->set('PARAMS', explode('/', $f3->get('PARAMS.*')));

        $this->meet = MeetModel::instance()->get_by_id($f3->get('PARAMS.0'));
        if($this->meet->dry())
            $f3->error(404);

        $this->renderGame($f3);

    }

    function renderGame($f3){

        $team_side  = $f3->get('PARAMS.1');
        $teams      = json_decode($this->meet->teams, true);

        list($team1, $user1) = each($teams);
        list($team2, $user2) = each($teams);

        $team = $team_side ? $team2 : $team1;
        $user = $team_side ? $user2 : $user1;
        $team = TeamModel::instance()->get_by_id($team);
        $user = UserModel::instance()->get_by_id($user);


        if($team->dry()){
            $f3->error(7003); // todo залез не в свою встречу
        }


//        if(($f3->get('client')->meet) && ($f3->get('client')->meet != $meet->id)){
//            die("У вас уже есть назначенный матч"); // todo залез не в свою встречу
//        }

        if($user->dry()){ // Вакантно, ставим сюда юзера

            //$teams[$team->id] = $f3->get('client')->id;
            $this->meet->teams = json_encode([
                $team1 => $team_side ? $user1 : $f3->get('_GUEST')->id,
                $team2 => $team_side ? $f3->get('_GUEST')->id : $user2,
            ]);
            $this->meet->status = MeetModel::STATUS_WAITING;
            $this->meet->save();
            $f3->get('_GUEST')->meet = $this->meet->id;
            $f3->get('_GUEST')->save();
        }

//        if($teams[$team->id] != $f3->client->id){ // Хрень какая-то, кто-то пришел, но он не в списке комманд, возможно в будущем сделаем зрителей
//            $f3->mset([
//                'content_template' => 'Error/error.tpl',
//                'error' => "У вас уже есть назначенный матч",
//            ]);
//            echo Template::instance()->render('Error/error.tpl');
//            die;
//            die("У вас уже есть назначенный матч");
//            $f3->error(400);
//        }

        $f3->set('teams', []);
        foreach ($teams as $team_id=>$user_id){
            $f3->push('teams', [
                'team' => TeamModel::instance()->get_by_id($team_id),
                'user' => UserModel::instance()->get_by_id($user_id)
            ]);
        }

        $layout = $f3->get('games.'.$this->meet->game_kind.'.name');

        echo Template::instance()->render('Games/'.$layout.'/index.tpl');

    }

}