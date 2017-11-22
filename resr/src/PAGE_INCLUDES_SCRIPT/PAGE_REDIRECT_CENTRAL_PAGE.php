
<?php

if(isset($_SESSION["idUser"]) && isset($_SESSION["LOGINED"])) {
    echo "<h1> ZMIENNA".$_SESSION["LOGINED"]."</h1>";
    echo "<h1> ZMIENNA".$_SESSION["idUser"]."</h1>";
    echo "<h1> ZMIENNA".$_SESSION["UserType"]."</h1>";


    if ($_SESSION["UserType"] == USER) {
        header("Location:Map.php");
    }elseif($_SESSION["UserType"] == ADMIN) {
        header("Location:AdminControllerSystem.php");
    }

}
?>