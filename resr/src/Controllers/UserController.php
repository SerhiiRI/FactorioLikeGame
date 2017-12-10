<?php
namespace Controller;


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
        $this->set($this->__dataBase__controller->__User__UserMapQuery());

    }
    private function set(array $sql_question){
        foreach ($sql_question as &$item){
            $this->UserList[] = new User(
                $item["idUser"],
                $item["idScore"],
                $item["Email"],
                $item["Passwd"],
                $item["Type"],
                $item["Level"]
            );
        }
    }

    public function add($login, $password, $type = 2, $idLevel = 0, $idScore = 0){
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