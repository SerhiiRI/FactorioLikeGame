<?php
include_once __DIR__ . "/resr/src/Controllers/UserController.php";
include_once __DIR__ . "/resr/src/Controllers/TaskController.php";
include_once __DIR__ . "/resr/src/Controllers/ResourceController.php";
include_once __DIR__ . "/resr/src/Controllers/ScoreController.php";
include_once __DIR__ . "/resr/src/Controllers/FactoryInstanceController.php";
include_once __DIR__ . "/resr/src/Controllers/MapController.php";

use Controller\TaskController;
use Controller\UserController;
use Controller\ResourceController;
use Controller\ScoreController;
use Controller\FactoryInstanceController;
use Controller\MapController;

function string_rand($length_of_string=20)
{
    $symbolSet = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
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
$controllerMap = MapController::getInstance();
//$controllerTask->removeAll();

/*
$controllerTask->add(rand(1, 3), string_rand(), 2, 100);
$controllerTask->add(rand(1, 3), string_rand(), 3, 100);
$controllerTask->add(rand(1, 3), string_rand(), 4, 100);*/
$controllerUser = UserController::getInstance();
$controllerScore = ScoreController::getInstance();
$controllerResource = ResourceController::getInstance();
$controllerFI = FactoryInstanceController::getInstance();

/*for ($i = 0; $i < 4; $i++) {
    $controllerUser->add(string_rand(), "123", rand(3, 5));
}*/

//$controllerFI->add(1, 1, 2);
//$controllerFI->add(2, 1, 2);


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
*/


echo "\n\n\n";

$controllerMap->remove("7");
foreach ($controllerMap->returnArray() as $value){
    print_r($value);
}

?>