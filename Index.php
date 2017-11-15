<?php
define("ADMIN", 1);
/**
 *
 * twozenia objektu steroania Bazy Danych
 */
$dataBase=\Controller\MySQLController::getInstance();
if(isset($_POST["ok"])){
    if($dataBase->login($_POST["login"], $_POST["password"]))  {
        /**
         *
         * jeżeli zalogowany użytkownik jest adminem to zrób
         * przekierowania do strony sterowania Admina;
         *
         */
        if($_SESSION["userIdentificator"]==ADMIN)header("Location:Map.php");
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

            <!-- TODO: nie zapomnij zmienic input z teksta na password-a -->

            <input type="text" placeholder="password" name="password" required/>
            <button type="submit" name="ok">login</button>
            <p class="message">Not registered? <a href="Regestration.php">Create an account</a></p>
        </form>
    </div>
</div>
</body>
</html>

<?php
