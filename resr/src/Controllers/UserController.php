<?php
namespace Controller;
include_once __DIR__."/../Class/User.php";

class UserController
{
    static private $instance = null;
    private $UserList = array();
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    private function __construct()
    {
        $this->__dataBase__controller = MySQLController::getInstance();
        $this->set($this->__dataBase__controller->__Admin__UserQuery());
    }
    private function set(array $sql_question){
        if (!is_null($sql_question))
        foreach ($sql_question as $item){
            $this->UserList[] = new User(
                $item["idUser"],
                $item["idScore"],
                $item["Email"],
                $item["Passwd"],
                $item["Type"],
                $item["Level"]
            );
        }else{
            echo "no chuj";
        }
    }

    public function add($login, $password, $idLevel = 0, $type = 2, $idScore = 0){
        $this->__dataBase__controller->regestration($login, $password, $type, $idLevel, $idScore);
    }
    public function remove(string $email){
        $this->__dataBase__controller->__Admin__UserRemove($email);
    }
    public function update($EmailToChange, $PasswordToChange){
        $this->__dataBase__controller->__Admin__UserUpdate($EmailToChange, $PasswordToChange);
    }
    public function nextLevel($email){
        $this->__dataBase__controller->__User__UserNextLevel($email);
    }
    public function returnArray(){
        return $this->UserList;
    }
}