<?php
include_once ("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");

if(isset($_POST["ok"]) && isset($_POST["email_address"]) && isset($_POST["password"])){
    $id = $__controller__DataBase->regestration($_POST["email_address"], $_POST["password"]);
    echo "<h1> id ".print_r($id)."</h1>";
    if($id!=-1){
        $_SESSION["LOGINED"] = "1";
        $_SESSION["idUser"] = $id;
        if ($id==1) {
            $_SESSION["UserType"] = "1";
        }else{
            $_SESSION["UserType"] = "2";
        }
    }else{
        ?>
        <div class="form">
            <p class="message" style="font-size: 30px;"> Login is failed, may be you want <a href="Regestration.php"> create an account</a></p>
        </div>
        <?php
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
            <input type="text" name="email_address" placeholder="email address"/>
            <input type="password" name="password" placeholder="password"/>
            <button name="ok">create</button>
            <p class="message">Already registered? <a href="Index.php">Sign In</a></p>
        </form>
    </div>
</div>
</body>
</html>

