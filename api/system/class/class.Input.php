<?php
/**
 * Created by PhpStorm.
 * User: The Samir
 * Date: 8/26/14
 * Time: 11:12 PM
 */
class Input{
    public static function exists($type='post'){
        switch($type){
            case 'post':
                return (!empty($_POST))?true:false;
                break;
            case 'get' :
                return (!empty($_GET))?true:false;
                break;
        default:
                return false;
        }
    }
    public  static function get($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        }else if(isset($_GET[$item])){
            return $_GET[$item];
        }
        return '';
    }
}