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
    private $idUser;
    private $idTask;
    private $FinishedTask;

    public function __construct($idScore, $idUser, $idTask, $FinishedTask)
    {
        $this->idScore = $idScore;
        $this->idUser = $idUser;
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
    public function getidUser(){
        return $this->idUser;
    }
}