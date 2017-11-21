<?php
session_start();


define("ADMIN", 1);
define("USER", 2);
$__controller__DataBase=\Controller\MySQLController::getInstance();


if(isset($_POST["ok"])){
    $id=$__controller__DataBase->validateUser($_POST["login"], $_POST["password"]);
    if($id!=-1)  {
        $_SESSION["idUser"] = $id["idUser"];
        $_SESSION["UserType"] = $id["Type"];
    }
    unset($id);
}
if($_SESSION["idUser"] != null) {
    if ($_SESSION["UserType"] == USER) {
        header("Location:Map.php");
    }elseif($_SESSION["UserType"] == ADMIN) {
        header("Location:AdminControllerSystem.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style/login.css">
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" method="post">
            <input type="text" placeholder="username" name="login" required/>
            <input type="text" placeholder="password" name="password" required/>
            <button type="submit" name="ok">login</button>
            <p class="message">Not registered? <a href="Regestration.php">Create an account</a></p>
        </form>
    </div>
</div>
</body>
</html>

<?php
/*
if($_SESSION)

*/