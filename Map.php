
<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "2") {

    include_once("resr/src/view_generator/view_for_message.php");
    include_once("resr/src/view_generator/view_for_user.php");


    if(!isset($_SESSION["BtnDes"])){
        $_SESSION["BtnDes"]="zablokuj";
        $BtnDes = "zablokuj";
    }else{
        $BtnDes = $_SESSION["BtnDes"];
    }

    $_SESSION["lvlup_ok"]='ok';

    $whatShouldOpen = $_SESSION["whatShouldOpen"];
    ?>

    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Admin Tools</title>


        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!--Import fontello-->
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Bahiana|Chelsea+Market|Cinzel:400,700,900|Dosis:200,300,400,500,600,700,800|Jim+Nightshade|Nosifer|Poiret+One|Quicksand:300,400,500,700|Text+Me+One&amp;subset=latin-ext" rel="stylesheet">
        <br/>
        <link rel="stylesheet" href="style/fontello/css/fontello.css">

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

        <!--Import aleks_style.css-->
        <link type="text/css" rel="stylesheet" href="style/aleks_style.css"/>


    </head>

    <script>
        function finalize() {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("serhii_log").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "./resr/src/PAGE_INCLUDES_SCRIPT/AJAX_ONLY_GET_RESOURCES.php", true);
            xmlhttp.send();
        }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("serhii_log").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "./resr/src/PAGE_INCLUDES_SCRIPT/AJAX_HANDLER_TO_RESOURCE.php", true);
            xmlhttp.send();
        //}
        var interval = setInterval(function(){
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("serhii_log").innerHTML = this.responseText;
                    testFullResourcea();
                }
            };
            xmlhttp.open("GET", "./resr/src/PAGE_INCLUDES_SCRIPT/AJAX_HANDLER_TO_RESOURCE.php", true);
            xmlhttp.send();
        }, 1000);
            function testOnNewLevelUp(){
                var xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange = function(ss) {
                    if (this.readyState == 4 && this.status == 200) {
                        // alert(this.responseText);
                        if(this.responseText == "1"){
                            if(document.getElementById("lvlupBTN").value=='ok'){document.getElementById("lvlupBTN").disabled = false;}

                        }else{

                            return false;
                        }
                    }
                };
                xhttp.open("POST", "./resr/src/PAGE_INCLUDES_SCRIPT/AJAX_TEST_TASK.php", true);
                xhttp.send();
            }
        function testFullResourcea(){
            var xhttp=new XMLHttpRequest();
            xhttp.onreadystatechange = function(ss) {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText == "1"){
                        clearInterval(interval);
                        BtnDes('odblokuj');
                        testOnNewLevelUp();
                        finalize();
                        //if(document.getElementById("lvlupBTN").value=='ok'){document.getElementById("lvlupBTN").disabled = false;}
                    }else{
                        return false;
                    }
                }
            };
            xhttp.open("POST", "./resr/src/PAGE_INCLUDES_SCRIPT/AJAX_TEST.php", true);
            xhttp.send();
        }

    </script>
    <body class="alx_bg_img" onload="BtnDes('<?php echo $BtnDes;?>')">
    <?php if(isset($_SESSION["EndGame"])){
        if($_SESSION["EndGame"]=="end"){
            javamessage("Gratulacje! Ukończyłeś grę!");
        }
    }?>

    <script>
        <?php echo include_once("java_map.js");?>
    </script>

    <div id="loading" class="loading"><img src="resr/img/chomiczek.gif" id="loadingimg" class="loadingimg"/></div>
    <div class="jsmessage" id="jsmessagestyle"><h4 id="jsmessage">TXT</h4></div>

    <?php
    if(isset($_SESSION["ActionInfo"])){
        if($_SESSION["ActionInfo"]!= ""){
            javamessage($_SESSION["ActionInfo"]);
            $_SESSION["ActionInfo"] = "";
        }
    }
    //    javamessage("Wygląda na to że działa :D")
    ;?>
    <a href="Credits.html"><img src="resr/img/gear6.gif" class="autorzy_btn"></a>

    <?php lvlupLightbox(); ?>
    <?php lvlupGratulation(); ?>
    <?php PanelKontrolnyFabryki(); ?>

    <div>
        <div>
            <!--lewy panel Admina-->
            <?php LewyPanelAdmina(); ?>
            <!--KONIEC PANELU LEWEGO-->

            <!--prawy panel Admina (content)-->
            <div class="aleks_content_panel aleks_content_panel_userfix">
                <!--Lista zadań-->
                <ul class="collapsible popout" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header <?php if($whatShouldOpen == "Task"){echo "active";} ?>"><i class="material-icons">sort</i>Postęp technologiczny
                        </div>
                        <?php ListaTaskowDlaUsera(); ?>
                    </li>
                    <li>
                        <div class="collapsible-header <?php if($whatShouldOpen == "statystyka" || $whatShouldOpen == "startPage"){echo "active";} ?>"><i class="material-icons">sort</i>Mapa Fabryki
                        </div>
                        <!--Mapa gracza-->
                        <div class="collapsible-body coll-body-first">
                            <h1 class="alx_h1_title alx_h1_title_fix" id="MapaFabryki">Mapa Fabryki</h1>
                        </div>
                        <div class="collapsible-body alx_flex_dla_mapy_diva">
                            <?php MapaFabryki(); ?>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">sort</i>Budowa obiektów fabryki
                        </div>
                        <?php ListaFabrykDoBudowyDlaUsera(); ?>
                    </li>
                </ul>


                <!--Koniec części z Mapą Fabryki-->

                <br/>
                <br/>
            </div>

        </div>
    </div>
</body>
    </html>

<?php

    if($_SESSION['ref'] == true){
        $_SESSION['ref'] = false;
        echo '<script>
//        window.location.reload(true);
        </script>';
    }

} else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "1") {
    header("Location:AdminControllerSystem.php");
} else if (!isset($_SESSION["idUser"])) {
    header("Location:Index.php");
} ?>