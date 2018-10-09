<?php

class CashboxController extends Controller
{
    public function Index()
    {
        if ($this->f3->client->dry()) {
            $this->f3->reroute('/');
        }
        if ($this->f3->get('client')->type_id != 2 && $this->f3->get('client')->type_id != 3) {
            $this->f3->reroute('/');
//            $this->f3->error(404);
        }
        if ($this->f3->get("AJAX")) {
            $lot = new LotModel();
            $lot->copyfrom('POST');
            $lot_model = new LotModel();
            $all_id = $this->f3->get("POST.all_id");
            $checked_id = $this->f3->get("POST.status_pay");
            if (sizeof($checked_id) < 1) {
                $data = array_keys($all_id);
                $unpayed_lots = $lot_model->UnPayedAuction($data);
//                $errors_0 = json_decode($unpayed_lots, true);
            } else {
                $key_checked = array_keys($checked_id);
                foreach ($all_id as $key => $val) {
                    if (!in_array($key, $key_checked)) {
                        $data_0[] = $key;
                    } else {
                        $data_1[] = $key;
                    }
                }
                if (sizeof($data_0)) {
                    $unpayed_lots = $lot_model->UnPayedAuction($data_0);
//                    $errors_0 = json_decode($unpayed_lots, true);
                }
                if (sizeof($data_1)) {
                    $payed_lots = $lot_model->PayedAuction($data_1);
//                    $errors_1 = json_decode($payed_lots, true);
                }
            }
//            if(isset($errors_0) && isset($errors_1)){
//                $errors = $errors_0 + $errors_1;
//            }elseif(isset($errors_0) && !isset($errors_1)){
//                $errors = $errors_0;
//            }else{
//                $errors = $errors_1;
//            }
            $errors = [
                'code' => 0,
                'description' => 'ok',
            ];
            die(json_encode($errors));
        }
        $lot_model = new LotModel();
        $closed_lots = $lot_model->GetClosedLotsCashBox();
//        $data = array();
//        $user_model = new UserModel();
//        $user_info = $user_model->GetInfoClient($data);
//        foreach($closed_lots as $key => $val)
//        {
//
//            var_dump($val->fio);
//        }
//        die;
        $closed_lots_desc = array_reverse($closed_lots);
//        foreach($closed_lots_desc as $key => $val){
//        }
//        die;
//        var_dump($closed_lots_desc, $user_info);
//        die;
        $this->f3->mset([
            'content_template' => 'Back/cashbox.tpl',
            'ClosedLots' => $closed_lots_desc,
//            'UserInfo' => $user_info,
        ]);
        echo Template::instance()->render('Back/layout_cashbox.tpl');
    }
}