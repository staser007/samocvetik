<?php

class ArticleModel extends Model{

    public function __construct(){
        parent::__construct(Base::instance()->get('DB'), 'articles');
    }

    public function get_by_name($name){
        $article = new self;
        $article->load(['`name` = ?', $name]);
        return $article;
    }

}