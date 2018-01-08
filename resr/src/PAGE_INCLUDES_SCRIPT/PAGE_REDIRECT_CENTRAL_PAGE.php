
<?php
if(isset($_SESSION["idUser"]) && isset($_SESSION["LOGINED"])) {
//    echo "<h1> ZMIENNA".$_SESSION["LOGINED"]."</h1>";
//    echo "<h1> ZMIENNA".$_SESSION["idUser"]."</h1>";
//    echo "<h1> ZMIENNA".$_SESSION["UserType"]."</h1>";

    if ($_SESSION["UserType"] == 2) {
        if(!isset($_SESSION["przekierowanie"])){header("Location:Map.php");}else
        if($_SESSION["przekierowanie"]=="userpage"){}else
        if($_SESSION["przekierowanie"]=="adminpage"){header("Location:Map.php");}
    }else if($_SESSION["UserType"] == 1) {
        if(!isset($_SESSION["przekierowanie"])){header("Location:AdminControllerSystem.php");}else
        if($_SESSION["przekierowanie"]=="adminpage"){}else
        if($_SESSION["przekierowanie"]=="userpage"){header("Location:AdminControllerSystem.php");}
    }

}
?>