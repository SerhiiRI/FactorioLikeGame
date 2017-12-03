<?php
if(isset($_POST["logut"])){
    unset($_SESSION["LOGINED"]);
    unset($_SESSION["idUser"]);
    unset($_SESSION["UserType"]);
    header("Location:Index.php");
}
?>
<form class="logout" action="" method="post">
    <input class="aleks_logout" name="logut"  src="resr/img/logout.svg" width="200px" alt="Logout" value="LOGOUT" type="image"/> Wyloguj
</form>
