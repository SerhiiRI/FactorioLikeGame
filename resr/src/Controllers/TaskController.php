<?php
namespace Controller;


class TaskController
{
    static private $instance = null;
    private $TaskList = array();
    private $__dataBase__controller;

    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
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