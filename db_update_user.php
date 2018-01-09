<?php

//Strona usera
session_start();
$_SESSION['ref']=true;

if (isset($_POST["create_factory"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/FactoryInstanceController.php";
    $__facControler = \Controller\FactoryInstanceController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/MapController.php";
    $__MapControl = \Controller\MapController::getInstance();

    echo "POST<br/>";
    echo "IDres: " . $_POST["idResource"] . "<br/>";
    echo "UpgradeLvl: " . $_POST['upgradeLvl'] . "<br/>";
    echo "IdUser: " . $_POST['idUser'] . "<br/>";

    $__facControler->add($_POST["idResource"], $_POST["upgradeLvl"], $_POST["idUser"]);
    $factoryInst = $__facControler->returnFactoryIDbyParametr($_POST["idResource"], $_POST["upgradeLvl"], $_POST["idUser"]);
//    echo "<pre> TO jest";print_r($iddodanejFabryki); echo "</pre>";

    $__MapControl->add($factoryInst);
    $_SESSION["ActionInfo"] = "Dodano fabrykę!";
    $_SESSION["whatShouldOpen"] = "startPage";
}//FINISH

if (isset($_GET["firstfactory"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/FactoryInstanceController.php";
    $__facControler = \Controller\FactoryInstanceController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/MapController.php";
    $__MapControl = \Controller\MapController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ScoreController.php";
    $__ScoreControl = \Controller\ScoreController::getInstance();

    echo "IDUSER: ".$_SESSION["idUser"];
    echo "<br>Działa";

    $__ScoreControl->update(591);
    $__facControler->add(1, 1, $_SESSION["idUser"]);
    $factoryInst = $__facControler->returnFactoryIDbyParametr(1, 1, $_SESSION["idUser"]);
    $__MapControl->add($factoryInst);

    $_SESSION["ActionInfo"] = "Witaj w Factorio Online!";
    $_SESSION["whatShouldOpen"] = "startPage";
}//FINISH

if (isset($_POST["destroy_factory"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/MapController.php";
    $__MapControl = \Controller\MapController::getInstance();

    echo "POST<br/>";
    echo "IDres: " . $_POST["idOfFactoryOnMap"] . "<br/>";

    $__MapControl->remove($_POST["idOfFactoryOnMap"]);
    $_SESSION["ActionInfo"] = "Usunięto fabrykę!";

    $_SESSION["whatShouldOpen"] = "startPage";
}//FINISH

if (isset($_POST["odp1"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/QuestionController.php";
    $__MapControl = \Controller\QuestionController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ScoreController.php";
    $__ScoreControl = \Controller\ScoreController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
    $__ResControl = \Controller\ResourceController::getInstance();
    $__ResControl->clearFrontEndResourcesCount();
    $_SESSION["BtnDes"]="zablokuj";
    if($__MapControl->onClickAndCheckQuestion($_POST["questID"], $_POST["hodp1"])==true){
        $_SESSION["ActionInfo"] = "Poprawna odpowiedź!";
        $__ScoreControl->update($_POST["taskID"]);

    }else{
        $_SESSION["ActionInfo"] = "Niestety to zła odpowiedź!";
    }
    $_SESSION["whatShouldOpen"] = "Task";
}//FINISH

if (isset($_POST["odp2"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/QuestionController.php";
    $__MapControl = \Controller\QuestionController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ScoreController.php";
    $__ScoreControl = \Controller\ScoreController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
    $__ResControl = \Controller\ResourceController::getInstance();
    $__ResControl->clearFrontEndResourcesCount();
    $_SESSION["BtnDes"]="zablokuj";

    echo "POST<br/>";
    echo "QuestID: " . $_POST["questID"] . "<br/>";
    echo "TaskID: " . $_POST["taskID"] . "<br/>";
    echo "Odp2: " . $_POST["hodp2"] . "<br/>";
    if($__MapControl->onClickAndCheckQuestion($_POST["questID"], $_POST["hodp2"])==true){
        $_SESSION["ActionInfo"] = "Poprawna odpowiedź!";
        $__ScoreControl->update($_POST["taskID"]);
    }else{
        $_SESSION["ActionInfo"] = "Niestety to zła odpowiedź!";
    }
    $_SESSION["whatShouldOpen"] = "Task";
}//FINISH

if (isset($_POST["odp3"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/QuestionController.php";
    $__MapControl = \Controller\QuestionController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ScoreController.php";
    $__ScoreControl = \Controller\ScoreController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
    $__ResControl = \Controller\ResourceController::getInstance();
    $__ResControl->clearFrontEndResourcesCount();
    $_SESSION["BtnDes"]="zablokuj";

    echo "POST<br/>";
    echo "QuestID: " . $_POST["questID"] . "<br/>";
    echo "TaskID: " . $_POST["taskID"] . "<br/>";
    echo "Odp3: " . $_POST["hodp3"] . "<br/>";
    if($__MapControl->onClickAndCheckQuestion($_POST["questID"], $_POST["hodp3"])==true){
        $_SESSION["ActionInfo"] = "Poprawna odpowiedź!";
        $__ScoreControl->update($_POST["taskID"]);
    }else{
        $_SESSION["ActionInfo"] = "Niestety to zła odpowiedź!";
    }
    $_SESSION["whatShouldOpen"] = "Task";
}//FINISH

if (isset($_POST["odp4"])) {

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/QuestionController.php";
    $__MapControl = \Controller\QuestionController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ScoreController.php";
    $__ScoreControl = \Controller\ScoreController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
    $__ResControl = \Controller\ResourceController::getInstance();
    $__ResControl->clearFrontEndResourcesCount();
    $_SESSION["BtnDes"]="zablokuj";

    echo "POST<br/>";
    echo "QuestID: " . $_POST["questID"] . "<br/>";
    echo "TaskID: " . $_POST["taskID"] . "<br/>";
    echo "Odp4: " . $_POST["hodp4"] . "<br/>";
    if($__MapControl->onClickAndCheckQuestion($_POST["questID"], $_POST["hodp4"])==true){
        $_SESSION["ActionInfo"] = "Poprawna odpowiedź!";
        $__ScoreControl->update($_POST["taskID"]);
    }else{
        $_SESSION["ActionInfo"] = "Niestety to zła odpowiedź!";
    }
    $_SESSION["whatShouldOpen"] = "Task";
}//FINISH

if (isset($_GET["noAnswer"])) {
    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
    $__ResControl = \Controller\ResourceController::getInstance();
    $__ResControl->clearFrontEndResourcesCount();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ScoreController.php";
    $__ScoreControl = \Controller\ScoreController::getInstance();

    echo "Get: ".$_GET["taskID"];
    $_SESSION["BtnDes"]="zablokuj";
    $__ScoreControl->update($_GET["taskID"]);
    $_SESSION["ActionInfo"] = "Badanie zakończone!";
    $_SESSION["whatShouldOpen"] = "Task";
}//FINISH

if(!empty($_GET["lvlup"])){
    echo $_GET["lvlup"];
    $_SESSION["ActionInfo"] = "Congratulation!";

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/UserController.php";
    $__UserControl = \Controller\UserController::getInstance();
    $__UserControl->nextLevel($_SESSION["name_of_user"]);
}

//Koniec
if(isset($_SESSION["ActionInfo"])){
    if( $_SESSION["ActionInfo"]== "0"){
        $_SESSION["ActionInfo"] = "Niepowodzenie działania.";
    }
}
header("Location: Map.php");
?>
<br/>
<a href="AdminControllerSystem.php">Back to Admin</a>
