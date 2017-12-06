<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 05.12.17
 * Time: 18:59
 */

namespace Controllers;

use Controller\MySQLController;
use Controller\Task;

include_once(dirname(__FILE__)."/MySQLController.php");

class TaskController
{
    static private $instance = null;
    private $TaskList = array();
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
    }

    private function __construct()
    {
        $this->__dataBase__controller = MySQLController::getInstance();
        $this->set($this->__dataBase__controller->__Admin__TaskQuery());

    }

    private function set(array $sql_question){
        foreach ($sql_question as &$item){
            $this->TaskList[] = new Task(
                $item["idTask"],
                $item["idResources"],
                $item["Task"],
                $item["LevelTo"],
                $item["ResourceTo"]
            );
        }
    }
    public function add($idTask, $idResource,  $Task, $LevelTo, $ResourceTo){
        $this->__dataBase__controller->__Admin__TaskAdd($idTask, $idResource,  $Task, $LevelTo, $ResourceTo);
    }
    public function remove(string $Task){
        $this->__dataBase__controller->__Admin__TaskRemove($Task);
    }
    public function update($idTask, $idResource,  $Task, $LevelTo, $ResourceTo){
        $this->__dataBase__controller->__Admin__TaskUpdate($idTask, $idResource,  $Task, $LevelTo, $ResourceTo);
    }
    public function returnArray(){
        return $this->TaskList;
    }
}