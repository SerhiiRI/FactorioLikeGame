<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 09.12.17
 * Time: 23:44
 */

namespace Controllers;
use Controller\MySQLController;

include_once __DIR__."/MySQLController.php";
include_once __DIR__."/../Class/Task.php";

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
        $this->set($this->__dataBase__controller->__User__UserScore);

    }

    private function set(array $sql_question){
        //print_r($sql_question);

        if(!is_null($sql_question)) {
            foreach ($sql_question as $item) {
                $this->TaskList[] = new Task(
                    $item["idTask"],
                    $item["idResources"],
                    $item["Task"],
                    $item["LevelTo"],
                    $item["ResourceTo"]
                );
                //print_r($item);
            }
        }else{
            echo "no CHUJ!";
        }
    }
    public function add($idResource,  $Task, $LevelTo, $ResourceTo){
        $lastAddedIndex =$this->__dataBase__controller->__Admin__TaskAdd($Task, $idResource, $LevelTo, $ResourceTo);
        $this->__dataBase__controller->__User__UserScoreAdd();
    }
    public function remove(string $Task){
        $this->__dataBase__controller->__Admin__TaskRemove($Task);
    }
    public function removeAll(){
        $this->__dataBase__controller->__Admin__TaskRemoveAll();
    }
    public function update($idTask, $idResource,  $Task, $LevelTo, $ResourceTo){
        $this->__dataBase__controller->__Admin__TaskUpdate($idTask, $idResource,  $Task, $LevelTo, $ResourceTo);
    }
    public function returnArray(){
        return $this->TaskList;
    }
}