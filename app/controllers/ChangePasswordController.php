<?php

class ChangePasswordController extends Controller
{
    public function ChangePassword()
    {
        if ($this->f3->get('client')->dry()) $this->f3->error(404);
        $user = $this->f3->get('client');
        $password = $this->f3->get('POST.password'); // Получаем параметры из POST
        $user->password = md5($password);
        if ($user->save() != false) {
            $errors = [
                "code" => 0,
                "description" => "success",
            ];
            die(json_encode($errors));
        } else {
            $errors = [
                "code" => 1,
                "description" => "invalid",
            ];
            die(json_encode($errors));
        }

    }
}

?>