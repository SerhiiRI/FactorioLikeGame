<?php
if (isset($_POST["edytuj"])){

include_once __DIR__ . "/../git-repo/resr/src/Controllers/MySQLController.php";
$__update = \Controller\MySQLController::getInstance();

//echo "POST<br/>";
//echo "Grafika: ".$_POST["input_grafika"]."<br/>";
//echo "User: ".$_POST['input_name']."<br/>";
//echo "Pass: ".$_POST['input_passwd']."<br/>";
$__update->__Admin__UserUpdate($_POST['input_name'], $_POST['input_passwd'], $_POST["input_grafika"]);
}

if (isset($_POST["edytuj_task"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/TaskController.php";
    $__TaskControler = \Controller\TaskController::getInstance();

//echo "POST<br/>";
    echo "idOfTask: " . $_POST["idOfTask"] . "<br/>";
    echo "Zaznaczone: " . $_POST["input_res_task"] . "<br/>";
    echo "Task: " . $_POST['input_task'] . "<br/>";
    echo "LVL: " . $_POST['input_lvl_task'] . "<br/>";
    echo "Need: " . $_POST['input_needed_task'] . "<br/>";
    $__TaskControler->add($_POST["input_res_task"],  $_POST["input_task"], $_POST["input_lvl_task"], $_POST["input_needed_task"]);
    $__TaskControler->remove($_POST["idOfTask"]);
}

if (isset($_POST["del_task"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/TaskController.php";
    $__TaskControler = \Controller\TaskController::getInstance();

    $__TaskControler->remove($_POST["idOfTask"]);
    echo "Usunięto: ".$_POST['idOfTask'];
}

?>