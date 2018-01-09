<?php

include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if(session_status()==false) {
    session_start();
}

function javamessage($txt){
    echo "<script type='text/javascript'>alert('$txt');</script>";
}

if(isset($_SESSION["ActionInfo"])){
    if($_SESSION["ActionInfo"]!="0"){
        javamessage($_SESSION["ActionInfo"]);
        $_SESSION["ActionInfo"]="0";
    }
}

if (isset($_POST["ok"])) {
    $id = $__controller__DataBase->validateUser($_POST["login"], $_POST["password"]);

    include_once __DIR__ . "/resr/src/Controllers/UserController.php";
    $__userControler = Controller\UserController::getInstance();

    $date = $__userControler->SearchByEmail($_POST["login"]);
    if ($id != -1) {
        $_SESSION["LastLogin"] = $date->getLastLogined();
//        $_SESSION["LastLogin"] = date("Y-m-d");
        $__userControler -> updateUserLoginDate($_POST["login"], date("Y-m-d"));
        $_SESSION["name_of_user"] = $_POST["login"];
        $_SESSION["LOGINED"] = "1";
        $_SESSION["idUser"] = $id["idUser"];
        $_SESSION["UserType"] = $id["Type"];
        $_SESSION["przekierowanie"] = "indexpage";
        $_SESSION["whatShouldOpen"] = "startPage";
        $_SESSION["ref"] = false;
    } else {
        javamessage("Coś poszło nie tak! Sprawdź swoje dane logowania.");
    }
    unset($id);
}

if (!isset($_SESSION["idUser"])) {

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Login and LLAP</title>
        <link rel="stylesheet" type="text/css" href="style/login.css">
        <!--import czcionek-->
        <?php include_once("style/fonts.html") ?>
    </head>
    <body>
    <div class="login-page">
        <div class="form" >
            <form class="login-form" method="post" >
                <input type="text" placeholder="username" name="login" value="admin" required/>
                <input type="password" placeholder="password" name="password" value="admin" required/>
                <button type="submit" name="ok">Zaloguj się!</button>
                <p class="message" style="text-align: center">Nie posiadasz konta? <a href="Regestration.php">Zarejestruj się!</a></p>
            </form>
        </div>
    </div>
    <a href="Credits.html"><img src="resr/img/gear6.gif" class="autorzy_btn"></a>
    </body>
    </html>

<?php } else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "1") {
    header("Location:AdminControllerSystem.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "2") {
    header("Location:Map.php");
}