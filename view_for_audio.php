<?php
if(session_status()==false) {
    session_start();
}
?>
<!DOCTYPE html>
<html id="musicTab">
<head>
    <title>Factorio Audio</title>
</head>
<body>
<h2>Muzyka w tle: Factorio #4</h2>
<?php
if(!isset($_SESSION['audiobg'])){
?>
<!--<a href="/../git-repo/resr/audio/factorioSoundtruck.mp3"></a>-->
<script>
    <?php $_SESSION['audiobg']=true;?>
    // alert("Factorio Sound BG");
    var factorio = new Audio('../git-repo/resr/audio/factorioSoundtruck.mp3');
    factorio.volume = 0.1;
    factorio.loop = true;
    factorio.play();
    window.open("Index.php", "_blank");
</script>
<?php }?>
</body>
</html>
