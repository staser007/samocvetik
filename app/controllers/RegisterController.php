<?php

class RegisterController extends Controller
{
    public function Index()
    {
        echo Template::instance()->render('Front/layout.tpl');
    }
}