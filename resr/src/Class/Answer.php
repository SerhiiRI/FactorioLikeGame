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
