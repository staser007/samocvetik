<?php

class CronController extends Controller
{
    public function Index()
    {
        $ip_access = $this->f3->get('IP');
        $ip_arr = ['127.0.0.1', '62.182.52.40', '82.146.41.246'];
        if(!in_array($ip_access, $ip_arr)) $this->f3->error(404);

        $date = date("Y-m-d H:i:s");
        $lot = new LotModel();
        $closed_lots = $lot->GetClosedLots();
        foreach($closed_lots as $key => $val)
        {
            if($date >= $val->start_trading)
            {
                $data[] = $val->id;
            }
        }
        if(sizeof($data) > 0)
        {
            $errors = $lot->OpenAuction($data);
            die(var_dump(json_decode($errors, true)));
        }
        $opened_lots = $lot->GetOpenedLots();
        foreach($opened_lots as $key => $val)
        {
            if($date >= $val->end_trading)
            {
                $data[] = $val->id;
            }
        }
        if(sizeof($data) > 0)
        {
            $errors = $lot->CloseAuction($data);
            die(var_dump(json_decode($errors, true)));
        }
    }
}