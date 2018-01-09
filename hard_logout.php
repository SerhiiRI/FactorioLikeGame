<!DOCTYPE html>
<html>
<head>
    <title>Factorio Hard Logout</title>
</head>
<body>
    <!--<a href="/../git-repo/resr/audio/factorioSoundtruck.mp3"></a>-->
<?php
session_start();
session_destroy();
session_start();
$_SESSION['audiobg']=true;

header("Location:Index.php");
?>
</body>
</html>
