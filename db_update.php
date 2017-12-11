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
?>