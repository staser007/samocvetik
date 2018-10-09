<?php
/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 18.11.13
 * Time: 11:39
 */

class ErrorController {

    private static $_instanse = null;

    /**
     * Singleton
     * @return ErrorController
     */
    public static function instance(){
        if(self::$_instanse === null)
            self::$_instanse = new self;
        return self::$_instanse;
    }

    /**
     * @param $f3
     * @return bool - Обработана ошибка или продолжить обработку фреймворком
     */
    public static function OnError($f3){

//          'status'=>$header,
//			'code'=>$code,
//			'text'=>$text,
//			'trace'=>$trace

        $code     = $f3->get('ERROR.code');

        /* Если код ошибки описан в фреймворке */
        $f3_const = 'Base::HTTP_'.$code;
        if(defined($f3_const)){
            if($f3->get('AJAX')){
                echo Template::instance()->render('Error/ajax_http_error.tpl');
                return true;
            }
            echo Template::instance()->render('Error/http_error.tpl');
            return true;
        }

        /* Получим описание ошибки из словаря */
        if($description = $f3->get('error_'.$code)){
            if($f3->get('AJAX')){
                $f3->set('ERROR.status', $description);
                echo Template::instance()->render('Error/ajax_http_error.tpl');
                return true;
            }
            $f3->set('ERROR.text', $description);
            echo Template::instance()->render('Error/http_error.tpl');
            return true;
        }

        return false;


        // Если есть файл шаблона, выводим шаблон
        $tpl_path = $f3->get('ROOT').$f3->get('BASE').DIRECTORY_SEPARATOR.$f3->get('UI');
        $tpl      = 'Errors/'.$code.'.tpl';
        if(file_exists($tpl_path . $tpl)){
            $f3->set('ERROR.text', $description);
            echo Template::instance()->render($tpl);
            exit;
        };

        var_dump($f3->get('ERROR'));


        var_dump($description);die;
        // Обрабатываем ошибку сами
        $f3->set('ERROR.text', $desc);
        $f3->set('HALT', false);
        header($_SERVER['SERVER_PROTOCOL'].' 200 OK');


        // Выводим ошибку универсальным шаблоном, он сам определит метод запроса
        echo Template::instance()->render('Errors/layout.tpl');
        die;
    }

}