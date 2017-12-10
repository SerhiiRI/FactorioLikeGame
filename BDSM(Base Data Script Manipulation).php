<?php
include_once __DIR__ . "/resr/src/Controllers/TaskController.php";
include_once __DIR__ . "/resr/src/Controllers/UserController.php";
include_once __DIR__ . "/resr/src/Controllers/ScoreController.php";

use Controller\TaskController;
use Controller\UserController;
use Controller\ScoreController;

function string_rand()
{
    $symbolSet = "qwertyui opasdfghjklzxcvb nmQWERTYUIOPASDFGH JKLZXCVBNM";
    $fin_str = "";
    for ($licznik = 0; $licznik < 20; $licznik++) {
        $fin_str = $fin_str . substr($symbolSet, rand(1, strlen($symbolSet) - 1), 1);
    }
    return $fin_str;
}

/*function dodaj_Taks(int $count){
$controller = TaskController::getInstance();
    for ($i = 0; $i < $count; $i++) {
        $idResourcl = rand(1, 3);
        $Tasl = string_rand();
        $LevelTl = rand(1, 40);
        $ResourceTl = rand(1, 500);
        $controller->add($idResourcl, $Tasl, $LevelTl, $ResourceTl);
    }
}
function usun_wszystko(){
    $controller = TaskController::getInstance();
    $controller->removeAll();
}

usun_wszystko();
dodaj_Taks(50);
/*$controller = TaskController::getInstance();
    echo "================================================\n";
    echo "idTask\t\tidResourcec\t\tTask\t\tLevelTO\t\tResourceTo\n";

foreach ($controller->returnArray() as $item){
    echo $item->getidTask()."\t\t";
    echo $item->getidResources()."\t\t";
    echo $item->getTask()."\t\t";
    echo $item->getLevelTo()."\t\t";
    echo $item->getResourceTo()."\t\t\n";
    print_r($item);
}*/

$controllerTask = TaskController::getInstance();
/*$controllerTask->removeAll();
$controllerTask->add(rand(1, 3), string_rand(), 2, 100);
$controllerTask->add(rand(1, 3), string_rand(), 3, 100);
$controllerTask->add(rand(1, 3), string_rand(), 4, 100);*/
$controllerUser = UserController::getInstance();
$controllerScore = ScoreController::getInstance();

//$controllerUser->add("test", "test", "3");

foreach ($controllerUser->returnArray() as $user) {
    $controllerScore->add(rand(1,100));
}


foreach ($controllerTask->returnArray() as $item) {
    print_r($item);
}
$controllerTask->add(rand(1, 3), string_rand(), 5, 99);
foreach ($controllerTask->returnArray() as $item) {
    print_r($item);
}
foreach ($controllerScore->returnArray() as $item) {
    print_r($item);
}
/*foreach ($controllerUser->returnArray() as $item){
    print_r($item);
}*/
