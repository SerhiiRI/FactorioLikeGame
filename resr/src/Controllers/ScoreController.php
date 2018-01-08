<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 09.12.17
 * Time: 23:44
 */

namespace Controller;
use Controller\MySQLController;
use Controller\Score;
use Controller\UserController;

include_once __DIR__."/MySQLController.php";
include_once __DIR__."/../Class/Score.php";

class ScoreController
{
    static private $instance = null;
    private $ScoreList = array();
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    private function __construct()
    {
        $this->__dataBase__controller = MySQLController::getInstance();
        $this->set($this->__dataBase__controller->__User__UserScoreQuery($_SESSION["idUser"]));
        //$this->set($this->__dataBase__controller->__User__UserScoreQuery());
    }

    private function set( $sql_question){
        if(!is_null($sql_question)) {
            foreach ($sql_question as $item) {
               $this->ScoreList[] = new Score(
                    $item["idScore"],
                    $item["idUser"],
                    $item["idTask"],
                    $item["FinishedTask"]
                );
            }
        }else{
            echo "no CHUJ!";
        }
    }

    public function add($idTask, $idUser=-1)
    {
        if ($idUser < 0) {
            $this->__dataBase__controller->__User__UserScoreAdd($idTask, $_SESSION["idUser"]);
        }else{
            $this->__dataBase__controller->__User__UserScoreAdd($idTask, $idUser);
        }
    }

    public function remove(string $Task){
        $this->__dataBase__controller->__User__UserScoreRemove($Task, $_SESSION["idUser"]);
    }
    public function update($idTask){
        $this->__dataBase__controller->__User__UserScoreChangeStatus($idTask, $_SESSION["idUser"]);
    }
    public function returnArray(){
        return $this->ScoreList;
    }
    public function searchByIdTask($idTask){
        foreach ($this->ScoreList as $item){
            if($idTask==$item->getidTask() && $item->getidUser()==$_SESSION["idUser"]){return $item->getFinishedTask();}
        }
        return null;
    }
}