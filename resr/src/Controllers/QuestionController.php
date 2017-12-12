<?php
namespace Controller;

//TODO: dopracuj

class QuestionController
{
    private $QuestionList = array();
    static private $instance = null;
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
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
        $this->__dataBase__controller->__Admin__QuestionAdd($idTask, $Question, $Answer);
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
    }
    public function removeByQuestion(string $Question){
        $this->__dataBase__controller->__Admin__QuestionRemoveByQuestion($Question);
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
    }
    public function removeByID(int $idQuestion){
        $this->__dataBase__controller->__Admin__QuestionRemoveById($idQuestion);
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
    }
    public function returnArray(){
        return $this->QuestionList;
    }
}
