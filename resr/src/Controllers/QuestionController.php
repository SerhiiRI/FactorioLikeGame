<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 05.12.17
 * Time: 3:17
 */

namespace Controllers;
use Controller\MySQLController;

include_once(dirname(__FILE__)."/MySQLController.php");
include_once(dirname(__FILE__)."../Class/Question.php");
include_once(dirname(__FILE__)."../Class/Answer.php");

class QuestionController
{
    private $QuestionList = array();
    static private $instance = null;
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
    }

    private function __construct()
    {
        //Constructor klasy;
        //pobierania danych z MySQLController-a
        $this->__dataBase__controller = MySQLController::getInstance();

        //Wypelnienia tablicy objektami Resource
        $this->setQuestionList($this->__dataBase__controller->__Admin__QuestionQuery());

    }

    private function setQuestionList(array $sql_question){

    }
}