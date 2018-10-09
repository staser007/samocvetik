<?php

class ValidatorModel extends Prefab{

    public function Valid($fields, $value=null, $validators=null){

        if(!is_array($fields)){
            $fields = [$fields=>['value'=>$value, 'validators' => $validators]];
        }

        foreach($fields as $field=>$item){
            $validators = $this->explode_validators($item['validators']);
            foreach($validators as $validator=>$options){
                if(!method_exists($this, $validator)){
                    die("Error validator string");
                }
                $error = $this->$validator($options);
            }
        }



    }

    private function explode_validators($str){

        $result = [];

        if(!trim($str))
            return $result;

        $pieces = array_map('trim', explode('|', $str));
        foreach ($pieces as $item){
            if(!preg_match('/^(\w+)\(?(.*)\)?$/is', $item, $matches))
                die("Error validator string");
            $result[$matches[1]] = $matches[2]? array_map('trim', explode(',', trim($matches[2], '()'))) : null;
        }

        return $result;

    }


}

?>