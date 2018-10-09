<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 25.07.2017
 * Time: 21:13
 */
abstract class Model extends DB\SQL\Mapper{

    /**
     *	Return class instance
     *	@return static
     **/
    static function instance() {
        if (!Registry::exists($class=get_called_class())) {
            $ref=new Reflectionclass($class);
            $args=func_get_args();
            Registry::set($class, $args?$ref->newinstanceargs($args):new $class);
        }
        return Registry::get($class);
    }

    /**
     * Вернет новый экземпляр класса с загруженным id
     * @param $id
     * @return DB\SQL\Mapper
     */
    public function get_by_id($id=null){
        $class  = get_called_class();
        $result = new $class();
        if(!is_null($id))
            $result->load(['`id`=?', $id]);
        return $result;
    }

    public function get_items($filter=null, array $options=null, $ttl=0){
        $class  = get_called_class();
        $result = new $class();
        $result->load($filter, $options, $ttl);
        return $result;
    }

    public function &__get($key){
        $method = 'get_property_'.$key;
        if(method_exists($this, $method)){
            return $this->$method(parent::__get($key));
        }
        return parent::__get($key);
    }

    public function __set($key,$val){
        $method = 'set_property_'.$key;
        if(method_exists($this, $method)){
            return parent::__set($key,$this->$method($val)) ;
        }
        return parent::__set($key,$val);
    }

}