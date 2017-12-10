<?php
    include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");

    if (isset($_POST["ok"])) {
        $id = $__controller__DataBase->validateUser($_POST["login"], $_POST["password"]);
        if ($id != -1) {
            $_SESSION["name_of_user"] = $_POST["login"];
            $_SESSION["LOGINED"] = "1";
            $_SESSION["idUser"] = $id["idUser"];
            $_SESSION["UserType"] = $id["Type"];
            $_SESSION["przekierowanie"] = "indexpage";
        } else {
            ?>
            <div class="form">
                <p class="message" style="font-size: 30px;"> Login is failed, may be you want <a
                            href="Regestration.php"> create an account</a></p>
            </div>
            <?php
        }
        unset($id);
    }

if(!isset($_SESSION["idUser"])) {

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login and LLAP</title>
<link rel="stylesheet" type="text/css" href="style/login.css">
    <!--import czcionek-->
    <?php include_once("style/fonts.html")?>
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
<a href="Credits.html"><img src="resr/img/gear6.gif" class="autorzy_btn"></a>
</body>
</html>

<?php }else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"]=="1"){header("Location:AdminControllerSystem.php");}
else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"]=="2"){header("Location:Map.php");}