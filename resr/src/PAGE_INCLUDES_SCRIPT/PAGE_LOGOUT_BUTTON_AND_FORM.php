<?php
if(isset($_POST["logut"])){
    session_destroy();
    header("Location:Index.php");
}
?>
<form class="logout" action="" method="post">
    <button class="btn-flat alx_przycisk_wylogowania" type="submit" name="logut"><img class="aleks_logout" src="resr/img/logout.svg"> Wyloguj
    </button>
</form>
