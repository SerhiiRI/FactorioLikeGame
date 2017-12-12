<?php
if (isset($_POST["edytuj_user"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/MySQLController.php";
    $__update = \Controller\MySQLController::getInstance();

//echo "POST<br/>";
//echo "Grafika: ".$_POST["input_grafika"]."<br/>";
//echo "User: ".$_POST['input_name']."<br/>";
//echo "Pass: ".$_POST['input_passwd']."<br/>";
    $__update->__Admin__UserUpdate($_POST['input_name'], $_POST['input_passwd'], $_POST["input_grafika"]);
    $_SESSION["ActionInfo"] = "Edytowano użytkownika: ".$_POST["input_name"];
}

if (isset($_POST["del_user"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/MySQLController.php";
    $__update = \Controller\MySQLController::getInstance();

//echo "POST<br/>";
//echo "Grafika: ".$_POST["input_grafika"]."<br/>";
//echo "User: ".$_POST['input_name']."<br/>";
//echo "Pass: ".$_POST['input_passwd']."<br/>";
    $__update->__Admin__UserRemove($_POST['input_name']);
    $_SESSION["ActionInfo"] = "Usunięto użytkownika: ".$_POST["input_name"];
}

if (isset($_POST["edytuj_task"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/TaskController.php";
    $__TaskControler = \Controller\TaskController::getInstance();

//echo "POST<br/>";
//    echo "idOfTask: " . $_POST["idOfTask"] . "<br/>";
//    echo "Zaznaczone: " . $_POST["input_res_task"] . "<br/>";
//    echo "Task: " . $_POST['input_task'] . "<br/>";
//    echo "LVL: " . $_POST['input_lvl_task'] . "<br/>";
//    echo "Need: " . $_POST['input_needed_task'] . "<br/>";
    $__TaskControler->add($_POST["input_res_task"], $_POST["input_task"], $_POST["input_lvl_task"], $_POST["input_needed_task"]);
    $__TaskControler->remove($_POST["idOfTask"]);
    $_SESSION["ActionInfo"] = "Edytowano zadanie: ".$_POST["input_task"];
}

if (isset($_POST["del_task"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/TaskController.php";
    $__TaskControler = \Controller\TaskController::getInstance();

    $__TaskControler->remove($_POST["idOfTask"]);
    echo "Usunięto: " . $_POST['idOfTask'];
    $_SESSION["ActionInfo"] = "Usunięto zadanie: ".$_POST["idOfTask"];
}

if (isset($_POST["add_task"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/TaskController.php";
    $__TaskControler = \Controller\TaskController::getInstance();

//echo "POST<br/>";
    if (isset($_POST["input_res_task"]) && isset($_POST["input_task"]) && isset($_POST["input_lvl_task"]) && isset($_POST["input_needed_task"])) {
//        echo "Zaznaczone: " . $_POST["input_res_task"] . "<br/>";
//        echo "Task: " . $_POST['input_task'] . "<br/>";
//        echo "LVL: " . $_POST['input_lvl_task'] . "<br/>";
//        echo "Need: " . $_POST['input_needed_task'] . "<br/>";

    $__TaskControler->add($_POST["input_res_task"],  $_POST["input_task"], $_POST["input_lvl_task"], $_POST["input_needed_task"]);
    $_SESSION["ActionInfo"] = "Dodano nowe zadanie: ".$_POST["input_task"];
    }
}


if (isset($_POST["edytuj_fabryka"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
    $__ResControl = \Controller\ResourceController::getInstance();

    echo "POST<br/>";
    echo "Grafika: " . $_POST["input_grafika"] . "<br/>";
    echo "Name: " . $_POST["input_fabryka"] . "<br/>";
    echo "Surowiec: " . $_POST['input_surowiec'] . "<br/>";
    echo "Wydobycie: " . $_POST['input_wydobycie'] . "<br/>";
//    $__ResControl->update($_POST['input_surowiec'], $_POST['input_wydobycie'], $IMG, $_POST["input_grafika"]);
//    update($Resource, $ProductionUnit, $IMG, $IMGFac)
    $_SESSION["ActionInfo"] = "Edytowano surowiec/fabrykę: ".$_POST["input_surowiec"];
}


//header("Location: AdminControllerSystem.php");

?>
<br/>
<a href="AdminControllerSystem.php">Back to Admin</a>
