<?php
include_once __DIR__ . "/resr/src/Controllers/UserController.php";
include_once __DIR__ . "/resr/src/Controllers/TaskController.php";
include_once __DIR__ . "/resr/src/Controllers/ResourceController.php";
include_once __DIR__ . "/resr/src/Controllers/ScoreController.php";

use Controller\TaskController;
use Controller\UserController;
use Controller\ResourceController;
use Controller\ScoreController;

function string_rand($length_of_string=20)
{
    $symbolSet = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGH JKLZXCVBNM";
    $fin_str = "";
    for ($licznik = 0; $licznik < $length_of_string; $licznik++) {
        $fin_str = $fin_str . substr($symbolSet, rand(1, strlen($symbolSet) - 1), 1);
    }
    return $fin_str;
}

/*function dodaj_Taks(int $count){
$controller = TaskController::getInstance();

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
//$controllerTask->removeAll();

/*
$controllerTask->add(rand(1, 3), string_rand(), 2, 100);
$controllerTask->add(rand(1, 3), string_rand(), 3, 100);
$controllerTask->add(rand(1, 3), string_rand(), 4, 100);*/
$controllerUser = UserController::getInstance();
$controllerScore = ScoreController::getInstance();
$controllerResource = ResourceController::getInstance();
/*for ($i = 0; $i < 4; $i++) {
    $controllerUser->add(string_rand(), "123", rand(3, 5));
}*/

foreach ($controllerResource->returnArray() as $item){
    print_r($item);
}
echo "========================================\n";
//$controllerResource->add("uska", 12, string_rand(), string_rand(), string_rand());
foreach ($controllerResource->returnArray() as $item){
    print_r($item);
}

/*
for ($i = 0; $i < 10; $i++) {
    $idResourcl = rand(1, 3);
    $Tasl = string_rand();
    $LevelTl = rand(1, 5);
    $ResourceTl = rand(1, 500);
    $controllerTask->add($idResourcl, $Tasl, $LevelTl, $ResourceTl);
}

foreach ($controllerUser->returnArray() as $item){
    print_r($item);
}

    echo "User\tTask\tUser\n";
    echo "=======================================\n";

foreach ($controllerTask->_ToTEST__returnUserAndtAsk() as $value){
    echo $value["task"]."\t\t".$value["user"]."\t\t".$value["mail"]."\t\t".$value["mes"]."\t\t"."\n";
}*/

?>