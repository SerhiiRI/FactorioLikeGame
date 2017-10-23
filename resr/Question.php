<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.10.17
 * Time: 2:36
 */

namespace Controller;


class Question 
{
    public $question = ' ';
    public $answers = array();

    public function __construct(string $questionField, array $answer)
    {
        if (!is_null($questionField) && !is_null($answer)) {
            $this->question = $questionField;
            $this->answers = $answer;
        }
    }
}

class Answer
{
    private $answer;
    private $right = false;

    public function __construct($answerField, $isCorrect = false)
    {
        if (!is_null($answerField)) {
            $this->answer = $answerField;
            $this->right = $isCorrect;
        }
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function isRight()
    {
        return $this->right ? true : false;
    }
}
