<?php


include_once __DIR__."/../Controllers/TaskController.php";
include_once __DIR__."/../Controllers/MySQLController.php";
include_once __DIR__."/../Controllers/ScoreController.php";

$_SESSION["on_test"] = 0;
$__DB = \Controller\MySQLController::getInstance();
$__Task__ = \Controller\TaskController::getInstance();
$__Score__ = \Controller\ScoreController::getInstance();


$tf = true;
//print("count of task ".count($__Task__->returnOnlyCurrentUserTaskArray()));
//print_r($__Task__->returnOnlyCurrentUserTaskArray());
foreach ($__Task__->returnOnlyCurrentUserTaskArray() as $value){
//    echo "zadanie - ".$__Score__->searchByIdTask($value->getidTask());
//    print("<br>--<br>");
    if (!$__Score__->searchByIdTask($value->getidTask())){
        $tf = false;
        break;
    }
}

$result =  $__DB->__System__GetMaxLevel();
$suka = "1";
foreach ($result as $item) {
    $suka = $item["LevelTo"];
}
$resultECHO = ($tf)? "1" : "0";
$resultECHO = ($suka-1 == $_SESSION['poziomGracza'])? "0": $resultECHO;
//print($suka."\n");
//print($_SESSION['poziomGracza']."\n");
print($resultECHO);

?>