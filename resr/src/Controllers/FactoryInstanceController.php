<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 11.12.17
 * Time: 23:08
 */

namespace Controller;


class FactoryInstanceController
{
    private $FactoryInstance = array();
    static private $instance = null;
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return FactoryInstanceController::$instance;
    }

    private function __construct()
    {
        $this->__dataBase__controller = MySQLController::getInstance();
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
    }

    private function set(array $sql_question){
        unset($this->QuestionList);
        foreach ($sql_question as &$item){
            $this->QuestionList[] = new Question($item["idQuestion"], $item["Question"]);
        }
    }
    public function add($idTask, $Question, array $Answer){
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
        $this->__dataBase__controller->__Admin__QuestionAdd($idTask, $Question, $Answer);
    }
    public function removeByQuestion(string $Question){
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
        $this->__dataBase__controller->__Admin__QuestionRemoveByQuestion($Question);
    }
    public function removeByID(int $idQuestion){
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
        $this->__dataBase__controller->__Admin__QuestionRemoveById($idQuestion);
    }
    public function returnArray(){
        return $this->QuestionList;
    }
}