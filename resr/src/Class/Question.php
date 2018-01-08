<?php
namespace Controller;


include_once __DIR__."/../Class/Answer.php";
use Controller\Answer;
use Controller\MySQLController;

class Question
{
    private $idQuestion;
    private $idTask;
    private $Question;
    private $answers = array();
    private $__dataBase__controller;

    private function initAnswer($id){
        foreach ($this->__dataBase__controller->__Admin__AnswerQuery($id) as $value) {
            $this->answers[] = new Answer($value["idAnswers"], $value["idQuestion"], $value["Answer"], $value["Right"]);
        }
        return null;
    }

    public function __construct( $idQuestion, $idTask, $Question)
    {
            $this->__dataBase__controller = MySQLController::getInstance();
            $this->idQuestion = $idQuestion;
            $this->idTask = $idTask;
            $this->Question = $Question;
            $this->initAnswer($this->idQuestion);
    }

    public function getQuestion(){
        return $this->Question;
    }
    public function getIdTask(){
        return $this->idTask;
    }
    public function getIdQuestion(){
        return $this->idQuestion;
    }
    public function getAnswerList(){
        return $this->answers;
    }


}

