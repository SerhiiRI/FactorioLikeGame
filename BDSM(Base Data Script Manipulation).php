<?php
include_once __DIR__."/resr/src/Controllers/TaskController.php";
use Controller\TaskController;

function string_rand(){
    $symbolSet = "qwertyui opasdfghjklzxcvb nmQWERTYUIOPASDFGH JKLZXCVBNM";
    $fin_str ="";
    for($licznik=0; $licznik<20; $licznik++){
        $fin_str  = $fin_str.substr($symbolSet, rand(1, strlen($symbolSet)-1), 1);
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
$controller = TaskController::getInstance();
for ($i = 0; $i < $count; $i++) {
    $idResourcl = rand(1, 3);
    $Tasl = string_rand();
    $LevelTl = rand(1, 40);
    $ResourceTl = rand(1, 500);
    $controller->add($idResourcl, $Tasl, $LevelTl, $ResourceTl);
}
}
