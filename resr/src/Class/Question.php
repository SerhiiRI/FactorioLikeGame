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

include_once(dirname(__FILE__)."../Controllers/MySQLController.php");
include_once(dirname(__FILE__)."../Class/Answer.php");

/**
 * @method __view__Generate is
 * @method __view__Change method
 * @method __view__ReturnParamert return
 */
class Question implements GraficView
{
    public $idQuestion;
    public $question = '';
    public $idTask;
    public $answers = array();
    private $__dataBase__controller;

    public function __construct(int $idQuestion, int $idTask, string $questionField)
    {
        if (!is_null($questionField)) {
            $this->__dataBase__controller = MySQLController::getInstance();
            $this->idTask = $idTask;
            $this->idQuestion = $idQuestion;
            $this->question = $questionField;
            $this->initAsk($this->idQuestion);
        }

    }

    public function getQuestion(){
        return $this->question;
    }
    public function getIdQuestion(){
        return $this->idQuestion;
    }
    public function getAnswerList(){
        return $this->answers;
    }

    private function initAsk($id){
        foreach (($this->__dataBase__controller->__Admin__AnswerQuery($id)) as &$value) {
            $this->answers[] = new Answer($value["idAnswers"], $value["Answer"], $value["Right"]);
        }
        return null;
    }
    public function __view__Generate()
    {
        $str = <<<VIEW
        <tr>
            <td>
                {$this->question}
            </td>
        </tr>
VIEW;
        return $str;
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

