<?php
if(session_status()==false) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Factorio Audio</title>
</head>
<body>
<?php
session_unset('audiobg');

if (!isset($_SESSION["audiobg"])) {
    $_SESSION["audiobg"]=true;
    echo '<script>
        window.open("view_for_audio.php", "_top");
        </script>';
}?>
<?php
        ?>
    </body>
</html>
