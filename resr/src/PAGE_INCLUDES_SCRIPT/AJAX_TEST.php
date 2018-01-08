<?php


include_once __DIR__."/../Controllers/ResourceController.php";
include_once __DIR__."/../Controllers/TaskController.php";

$_SESSION["on_test"] = 0;

$__Resource__ = \Controller\ResourceController::getInstance();
$__Task__ = \Controller\TaskController::getInstance();
$__Resource__->initializeResourceScoreForFrontEnd();
$__Resource__->updateResourceScoreForFrontEnd();

$tf = true;
foreach ($__Resource__->returnArrayForCurrentUserResource($_SESSION["idUser"]) as $value){

    if (!($_SESSION[$value->getResourceName()] == $__Task__->searchLevelByIdResorce($value->getIdResources()))){
        $tf = false; break;
    }

}

$resultECHO = ($tf)? "1" : "0";
print("$resultECHO");

?>