<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 18.04.2018
 * Time: 16:19
 */
class ElementController extends Controller{

    public function Index($f3){

        $f3->set('PARAMS', explode('/', $f3->get('PARAMS.*')));

        $element = $f3->get('PARAMS.0');
        if(!method_exists($this, $element))
            return print '<h3>404</h3>';

        return $this->$element($f3);
    }

    public function authblock($f3){
        if($f3->get('_GUEST')->dry()){
            echo Template::instance()->render('Front/login_form.tpl');
        }else{
            echo Template::instance()->render('Front/login_block.tpl');
        }
    }

    public function shedule($f3){
        $game_kind  = $f3->get('PARAMS.1');
        $now        = time();
        $filter     = ['`game_kind`=? AND (`status`=? OR `status`=?) AND `date_schedule`>?', $game_kind, MeetModel::STATUS_SCHEDULED, MeetModel::STATUS_WAITING, date('Y-m-d H:i:s', $now)];

        $teams = TeamModel::instance()->find(['`game_kind`=?', $game_kind]);
        foreach ($teams as $team)
            $f3->set('teams.'.$team->id, ['club'=>$team->club]);

        $meets = MeetModel::instance()->find($filter, ['order'=>'`date_schedule`']);

        foreach ($meets as $key=>$meet){
            @$teams = json_decode($meet->teams, true);
            if($teams){
                list($club1, $client1) = each($teams);
                list($club2, $client2) = each($teams);
            }
            $client1 = UserModel::instance()->get_by_id($client1);
            $client2 = UserModel::instance()->get_by_id($client2);
            $f3->set("meets.$key", [
                'id' => $meet->id,
                'drawing' => $meet->drawing,
                'date'=> date('d.m H:i', strtotime($meet->date_schedule)),
                'club1'=> $f3->get("teams.$club1.club"),
                'club2'=> $f3->get("teams.$club2.club"),
                'client1' => $client1->dry() ? 'Свободно' : $client1->name,
                'client2' => $client2->dry() ? 'Свободно' : $client2->name,
            ]);

        }


        echo Template::instance()->render('Front/shedule_block.tpl');
    }



}