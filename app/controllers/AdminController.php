<?php

class AdminController extends Controller{

    public function Index($f3){

//        if(!$f3->get('_GUEST')->access('admin_access'))
//            $f3->error(7001);

        $params = explode('/', trim($f3->get('PATH'), '/'));
        $f3->set('PARAMS', [
            'action' => isset($params[1])?$params[1]:'index',
            'item' => isset($params[2])?$params[2]:null,
        ]);

        $method = $f3->get('PARAMS.action').'Section';
        if(!method_exists($this, $method))
            $f3->error(404);

        $base = $f3->get('BASE');
        $f3->mset([
            'NAV_MENU' => [
                [
                    'name' => 'users',
                    'icon' => 'user',
                    'label' => 'Пользователи',
                    'href' => "$base/admin/users",
                    'items' => [
                        ['name' => 'users', 'label' => 'Пользователи', 'href' => "$base/admin/users"],
                        ['name' => 'roles', 'label' => 'Роли', 'href' => "$base/admin/roles"],
                        ['name' => 'permissions', 'label' => 'Полномочия', 'href' => "$base/admin/permissions"],
                    ],

                ],
                [
                    'name' => 'news',
                    'icon' => 'user',
                    'label' => 'Новости',
                ],                [
                    'name' => 'articles',
                    'icon' => 'user',
                    'label' => 'Статьи',
                    'items' => [
                        ['name' => 'users', 'label' => 'aaaaaaaaaaa'],
                        ['name' => 'roles', 'label' => 'bbbbbbbbbbbb'],
                        ['name' => 'permissions', 'label' => 'cccccccccc'],
                    ],

                ],
            ],
        ]);

        $this->$method($f3);

        echo Template::instance()->render('Admin/layout.tpl');
    }

    private function indexSection($f3){
        return $this->usersSection($f3);
    }

    private function usersSection($f3){
        $filter = null;

        $f3->mset([
            'content_tpl' => 'Admin/users.tpl',
            'users_list' => UserModel::instance()->get_items($filter, ['limit'=>20]),
            'roles_list' => RoleModel::instance()->get_items(),
            'content_header' => 'Users',
            'breadcrumbs' => [
                ['Home'=> $f3->get('BASE').'/admin'],
                ['Users'=>''],
            ],
        ]);


    }

    private function rolesSection($f3){


        $f3->mset([
            'content_tpl' => 'Admin/users.tpl',
            'content_header' => 'Users',
            'breadcrumbs' => [
                ['Home'=> $f3->get('BASE').'/admin'],
                ['Users'=>''],
            ],
        ]);


    }

    private function permissionsSection($f3){


        $f3->mset([
            'content_tpl' => 'Admin/users.tpl',
            'content_header' => 'Users',
            'breadcrumbs' => [
                ['Home'=> $f3->get('BASE').'/admin'],
                ['Users'=>''],
            ],
        ]);


    }

}

?>