<?php
/**
 * Created by PhpStorm.
 * User: The Samir
 * Date: 8/26/14
 * Time: 11:09 PM
 */

/*
 * $validate=new validate();
 * $validation=$validate->check($_POST,array(
 *  'username' => array(
 *          'required'=>true,
 *          'min'=>2,
*           'max'=>20,
*            'unique'=>'users'//table name
 *          ),
 * 'password'=> array(
 *
 *          'required'=>true,
 *          'min'=>2
 *          ),
 * 'password_again'=> array(
 *          'required'=>true,
 *          'matches'=>'password'
 *          ),
 * 'name'=> array(
 *          'required'=>true,
 *          'min'=>2,
*           'max'=>50
 *          )
 * );
 *if(validation->passed())
 * {
 *  //register user
 * }
 * else
 * {
 * //output error
 * }
 *
 * */
class Validate{
    private  $_passed=false,
            $_errors=array(),
            $_db=null;

    public function __construct(){
            $this->_db=myDB::getInstance();
    }

    public function check($source,$items=array()){
        foreach($items as $item=>$rules){
            foreach($rules as $rule=>$rule_value){
                $value=$source[$item];
                if($rule==='required' && empty($value)){
                    $this->addError("{$item} is required");
                }else{

                }
            }

        }
        if(empty($this->_errors)){
            return $this->_passed=true;
        }
        return $this;

    }

    private function addError($error)
    {
     $this->_errors[]=$error;
    }
    public function errors(){
        return $this->_errors;
    }
    public function passed(){
        return $this->_passed;
    }
}