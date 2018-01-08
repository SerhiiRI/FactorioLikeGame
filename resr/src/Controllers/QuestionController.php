<?php
namespace Controller;
include_once __DIR__."/../Class/Question.php";
include_once __DIR__."/MySQLController.php";

use \Controller\Question;
use \Controller\MySQLController;

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

    private function set($sql_question){
        unset($this->QuestionList);
        if(!is_null($sql_question)) {
            foreach ($sql_question as &$item) {
                $this->QuestionList[] = new Question($item["idQuestion"], $item["idTask"], $item["Question"]);
            }
        }else{
           //javamessage("Lista Pytań: Nie znaleziono wartości. A w domu działało ; - ;");
        }
    }
    public function add($idTask, $Question, $AnswerTrue, $AnswerFalse1, $AnswerFalse2, $AnswerFalse3){
        $this->__dataBase__controller->__Admin__QuestionAdd($idTask, $Question, $AnswerTrue, $AnswerFalse1, $AnswerFalse2, $AnswerFalse3);
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
    }
    public function remove($idQuestion){
        $this->__dataBase__controller->__Admin__QuestionRemoveById($idQuestion);
        $this->set($this->__dataBase__controller->__Admin__QuestionQuery());
    }
    public function returnArray(){
        if(!empty($this->QuestionList)){
            return $this->QuestionList;
        }else{
            //javamessage("Null");
            return null;
        }
    }

    public function onClickAndCheckQuestion($idQuestion, $idAnswer){
        $temp = $this->searchQuestionByIdOf_Question($idQuestion);
        foreach ($temp->getAnswerList() as $odpowiedz){
            if(($odpowiedz->getidAnswers() == $idAnswer) && ($odpowiedz->getRight()==true)){
                return true;
            }
        }
        return false;
    }

    private function searchQuestionByIdOf_Question($idQuestion){
        foreach ($this->QuestionList as $item){
            if ($item->getIdQuestion() == $idQuestion){
                return $item;
            }
        }
        return false;
    }

    public function searchQuestionByIdOf_Task($idTask){
        foreach ($this->QuestionList as $item){
            if ($item->getIdTask() == $idTask){
                return $item;
            }
        }
        return false;
    }
}
