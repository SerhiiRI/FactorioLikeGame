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

