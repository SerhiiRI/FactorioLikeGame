<?php

//Strona usera

if (isset($_POST["create_factory"])) {


    include_once __DIR__ . "/../git-repo/resr/src/Controllers/FactoryInstanceController.php";
    $__facControler = \Controller\FactoryInstanceController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/ResourceController.php";
    $__ResControl = \Controller\ResourceController::getInstance();

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/MapController.php";
    $__MapControl = \Controller\MapController::getInstance();

    echo "POST<br/>";
    echo "IDres: " . $_POST["idResource"] . "<br/>";
    echo "UpgradeLvl: " . $_POST['upgradeLvl'] . "<br/>";
    echo "IdUser: " . $_POST['idUser'] . "<br/>";

    $__facControler->add($_POST["idResource"], $_POST["upgradeLvl"], $_POST["idUser"]);
//    echo "<pre> TO jest";print_r($iddodanejFabryki); echo "</pre>";
    $factoryInst = $__facControler->returnFactoryIDbyParametr($_POST["idResource"], $_POST["upgradeLvl"], $_POST["idUser"]);
    echo "<pre> TO jest";print_r($factoryInst); echo "</pre>";

    $__MapControl->add($factoryInst);
    $_SESSION["ActionInfo"] = "Dodano fabrykę!";
    $_SESSION["whatShouldOpen"] = "startPage";
//    public function add($idResource, $upgradeLevel, $idUser){
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


//Koniec
if($_SESSION["ActionInfo"] == "0"){$_SESSION["ActionInfo"] = "Niepowodzenie działania.";}
header("Location: AdminControllerSystem.php");
?>
<br/>
<a href="AdminControllerSystem.php">Back to Admin</a>
