<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.10.17
 * Time: 21:53
 */

namespace Controller;


/**
 * @method __view__Generate is
 * @method __view__Change method
 * @method __view__ReturnParamert return
 */
class Answer implements GraficView
{
    private $idAnswer;
    private $answer;
    private $right = false;

    public function __construct($idAnswer, $answerField, $isCorrect = false)
    {
        if (!is_null($answerField)) {
            $this->idAnswer = $idAnswer;
            $this->answer = $answerField;
            $this->right = $isCorrect;
        }
    }

    public function getIdAnswer(){
        return $this->idAnswer;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function isRight()
    {
        return $this->right ? true : false;
    }


    public function __view__Generate()
    {
        // TODO: Implement __view__Generate() method.
    }

    public function __view__Change(array $param)
    {
        // TODO: Implement __view__Change() method.
    }

    public function __view__ReturnParametr()
    {
        // TODO: Implement __view__ReturnParametr() method.
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method __view__Generate is
        // TODO: Implement @method __view__Change method
        // TODO: Implement @method __view__ReturnParamert return
    }
}
