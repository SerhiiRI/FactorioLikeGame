<?php
include_once ("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if(isset($_POST["ok"])){
    $id=$__controller__DataBase->validateUser($_POST["login"], $_POST["password"]);
    if($id!=-1)  {
        $_SESSION["LOGINED"] = "1";
        $_SESSION["idUser"] = $id["idUser"];
        $_SESSION["UserType"] = $id["Type"];
    }else{
        ?>
        <div class="form">
            <p class="message" style="font-size: 30px;"> Login is failed, may be you want <a href="Regestration.php"> create an account</a></p>
        </div>
        <?
    }
    unset($id);
}
include ("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_REDIRECT_CENTRAL_PAGE.php");
?>






<!DOCTYPE html>
<html>
<head>
    <title>Login and LLAP</title>
<link rel="stylesheet" type="text/css" href="style/login.css">
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" method="post">
            <input type="text" placeholder="username" name="login" value="admin" required/>
            <input type="text" placeholder="password" name="password" value="admin" required/>
            <button type="submit" name="ok">login</button>
            <p class="message">Not registered? <a href="Regestration.php">Create an account</a></p>
        </form>
    </div>
</div>
</body>
</html>

