<?php
    session_start();
    include_once("resr/src/Controllers/MySQLController.php");
    define("ADMIN", 1);
    define("USER", 2);
    $__controller__DataBase = \Controller\MySQLController::getInstance();

?>

