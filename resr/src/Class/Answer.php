<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.10.17
 * Time: 21:53
 */

namespace Controller;

class Answer
{
    private $idAnswers;
    private $idQuestion;
    private $Answer;
    private $Right;

    public function __construct($idAnswers, $idQuestion, $Answer, $Right)
    {
            $this->idAnswers = $idAnswers;
            $this->idQuestion = $idQuestion;
            $this->Answer = $Answer;
            $this->Right = $Right;
    }

    public function getidAnswers(){
        return $this->idAnswers;
    }
    public function getidQuestion()
    {
        return $this->idQuestion;
    }
    public function getAnswer()
    {
        return $this->Answer;
    }
    public function getRight()
    {
        return $this->Right;
    }


}
