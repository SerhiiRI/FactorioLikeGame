<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 02.11.17
 * Time: 15:47
 */

namespace Controller;


class ControllSession
{

    public static function createSession(){
        session_start();
    }
    public static function hadCoockie(){
        $boolRequest = false;
        if(isset($_COOKIE['login'], $_COOKIE['password'])){
            //TODO: ask if some of parameter issets in user browser, if not, then... set coockie to request;
            //$_SERVER['PHP_AUTH_USER'] = $_COOKIE['login']; // PHP_AUTH_USER is a LOGIN contained in server;
            //$_SERVER['PHP_AUTH_PW'] = $_COOKIE['password']; // PHP_AUTH_PW is a PASSWORD contained in server;
            session_start();
            $_SESSION['login'] = $_COOKIE['login'];
            $_SESSION['password'] = $_COOKIE['password'];
        }else{
            /**
             * Time deleting of cookie equals one day after set his 60*60 - hour;
             */
            setcookie('login', $_SESSION['login'], time() + 60*60*24);
            setcookie('password', $_SESSION['password'], time() +60*60*24);
            $boolRequest = true;
        }
        return $boolRequest;
    }

    public static function issetCoockie($coockie_variable){
        if(isset($_COOKIE[$coockie_variable])){
            return true;
        }
        return false;
    }

    public static function addCookiesVariable(string $variable_name, string $variable_value){
        setcookie('login', $_SESSION['login'], time() + 60*60*24);
        return true;
    }

    public static function addSesionVariable(string $variable_name, string $variable_value){
        $_SESSION[$variable_name] = $variable_value;
        return true;
    }

    public static function removeCoockie(){
        setcookie('login', '', 1);
        setcookie('password', '', 1);
        unset($_COOKIE['login']);
        unset($_COOKIE['password']);
        return True;
    }
    public static function removeSession(){
        unset($_SESSION["login"]);
        unset($_SESSION["password"]);
    }
}