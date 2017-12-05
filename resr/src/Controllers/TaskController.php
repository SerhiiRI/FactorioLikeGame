<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 05.12.17
 * Time: 18:59
 */

namespace Controllers;

use Controller\MySQLController;

include_once(dirname(__FILE__)."/MySQLController.php");
include_once(dirname(__FILE__)."../Class/Question.php");
include_once(dirname(__FILE__)."../Class/Answer.php");

class TaskController
{
    static private $instance = null;
    private $TaskList = array();
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
    }

//=========================================================================

    private function __construct()
    {
        $this->__dataBase__controller = MySQLController::getInstance();
        $this->setQuestionList($this->__dataBase__controller->__Admin__TaskQuery());

    }

    private function setQuestionList(array $sql_question){
        foreach ($sql_question as &$item){
            $this->QuestionList[] = new Question($item["idQuestion"], $item["Question"]);
        }
    }

    public function addQuestion($idTask, $Question, array $Answer){
        $this->__dataBase__controller->__Admin__QuestionAdd($idTask, $Question, $Answer);
    }
    public function removeQuestion(string $Question){
        $this->__dataBase__controller->__Admin__QuestionRemove($Question);
    }
}