<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 23.10.17
 * Time: 2:36
 */

namespace Controller;


/**
 * @method __view__Generate is
 * @method __view__Change method
 * @method __view__ReturnParamert return
 */
class Question implements GraficView
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

