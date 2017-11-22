<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_LOGOUT_BUTTON_AND_FORM.php");

if(isset($_POST["__Admin__UserRemove"])){
    //TODO: usuwanie
}
if(isset($_POST["__Admin__UserAdd"])){
    //TODO: dodawania usera
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/login.css">
</head>
<body style="background-image: url(resr/img/adminit.jpg)">
<div class="login-page">
    <div class="form">
        <p class="message" style='font-size: 2em; color: #4d4d4d'> I AM ROOT!!!</p>
    </div>
</div>
<div class="form" style="max-width: 1000px" >
<table style="margin: auto">
    <tr class="message" style='font-size: 1.4em; color: #4d4d4d'><td style="text-align: center" colspan="5"> Lista: </td></tr>
    <?php
    $listOf = $__controller__DataBase->__Admin__UserQuery();
    if ($listOf != null) {
        foreach ($listOf as $row) {
            echo "<tr class='message' style='font-size: 1.1em'><form action='' method='post'>";
            echo "<td><input type='hidden' name='Email' value='" . $row["Email"] . "'>" . $row["Email"] . "</td>";
            echo "<td><input type='hidden' name='Level' value='" . $row["Level"] . "'>" . $row["Level"] . "</td>";
            echo "<td>" . $row["Level"] . "</td>";
            if ($row["Type"] == ADMIN) {
                echo "<td><input type='hidden' name='Type' value='" . $row["Type"] . "'>ROOT</td>";
            } elseif($row["Type"] == USER) {
                echo "<td><input type='hidden' name='Type' value='" . $row["Type"] . "'>Użytkownik</td>";
                echo "<td><button type='submit' name='__Admin__UserRemove' value='1'> Usun użytkownika </button></td>";
            }
        echo "</form></tr>";
        }
    }
    ?>
    <tr class="message" style='font-size: 1.4em; color: #4d4d4d'><td style="text-align: center" colspan="5"> Dodaj: </td></tr>
    <form action="" method="post">
    <tr class="message" style='font-size: 1.1em; border-color: #1a1a1a; border-top: solid; padding: 7px; border-width: 4px'>
        <td><input type="text" name="Email" placeholder="Email" required></td>
        <td><input type="text" name="Password" placeholder="Password" required></td>
        <td><input type="number" name="Level" value="0" min="0" max="20" required></td>
        <td><input type='hidden' name='Type' value="2">Tylko użytkownik</td>
        <td><button type="submit" name="__Admin__UserAdd" value="1"> Dodaj </button></td>
    </tr>
    </form>
</table>
</div>
</body>
</html>
