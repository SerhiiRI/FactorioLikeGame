<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 09.12.17
 * Time: 23:43
 */

namespace Controller;


class Score
{
    private $idScore;
    private $idTask;
    private $FinishedTask;

    public function __construct($idScore, $idTask, $FinishedTask)
    {
        $this->idScore = $idScore;
        $this->idTask = $idTask;
        $this->FinishedTask = $FinishedTask;
    }

    public function getidScore(){
        return $this->idScore;
    }
    public function getidTask(){
        return $this->idTask;
    }
    public function getFinishedTask(){
        return $this->FinishedTask;
    }
}