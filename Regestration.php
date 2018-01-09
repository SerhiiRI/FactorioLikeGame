<?php
include_once ("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if(session_status()==false) {
    session_start();
}

function javamessage($txt){
    echo "<script type='text/javascript'>alert('$txt');</script>";
}
//javamessage("work");

if(isset($_POST["ok"]) && isset($_POST["email_address"]) && isset($_POST["password"])){

    include_once __DIR__ . "/../git-repo/resr/src/Controllers/UserController.php";
    $id = \Controller\UserController::getInstance();
    if($id->SearchByEmail($_POST["email_address"])==null) {

        $id->add($_POST["email_address"], $_POST["password"], date("Y-m-d"));
        javamessage("Pomyślan rejestracja! Teraz możesz się zalogować :)");

        if ($id != "-1") {
            $_SESSION["name_of_user"] = $_POST["email_address"];
            $_SESSION["LOGINED"] = "1";
            $_SESSION["idUser"] = $id;
            if ($id == "1") {
                $_SESSION["UserType"] = "1";
            } else {
                $_SESSION["UserType"] = "2";
            }
        } else {
            javamessage("Coś poszło nie tak :/ Spróbuj jeszcze.");
        }
    }else{
        javamessage("Istnieje już taki użytkownik!");
    }
}

include_once ("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_REDIRECT_CENTRAL_PAGE.php");
?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/login.css">
</head>
<body style="background-image: url(resr/img/rejestr1.png)">

<div class="login-page">
    <div class="form">
        <form class="register-form" action="" method="post">
            <input type="text" name="email_address" placeholder="email address" required/>
            <input type="password" name="password" placeholder="password" required/>
            <button name="ok">Zarejestruj</button>
            <p class="message" style="text-align: center">Posiadasz już konto? <a href="Index.php">Zaloguj się!</a></p>
        </form>
    </div>
</div>
</body>
</html>

