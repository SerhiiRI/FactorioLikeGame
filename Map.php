<?php
include_once("resr/src/PAGE_INCLUDES_SCRIPT/PAGE_DEFINE_VARIABLE.php");
if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "2") {

    include_once("resr/src/view_generator/view_for_user.php");

    if(!isset($_SESSION["BtnDes"])){
        $_SESSION["BtnDes"]="odblokuj";
        $BtnDes = "odblokuj";
    }else{
        $BtnDes = $_SESSION["BtnDes"];
    }

    $whatShouldOpen = $_SESSION["whatShouldOpen"];
    $whatShouldOpen = $_SESSION["whatShouldOpen"];
    if(isset($_SESSION["ActionInfo"])){
        if($_SESSION["ActionInfo"]!="0"){
            javamessage($_SESSION["ActionInfo"]);
            $_SESSION["ActionInfo"]="0";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="pl">

    <head>
        <meta charset="UTF-8">
        <title>Admin Tools</title>
        <!--Import materialize.css-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="style/materialize/css/materialize.min.css"
              media="screen,projection"/>
        <!--Import czcionek-->
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Bahiana|Chelsea+Market|Cinzel:400,700,900|Dosis:200,300,400,500,600,700,800|Jim+Nightshade|Nosifer|Poiret+One|Quicksand:300,400,500,700|Text+Me+One&amp;subset=latin-ext"
              rel="stylesheet">
        <!--Import fontello-->
        <link rel="stylesheet" href="style/fontello/css/fontello.css">
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="style/materialize/js/materialize.min.js"></script>
        <!--Import aleks_style.css-->
        <link type="text/css" rel="stylesheet" href="style/aleks_style.css"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <script>
        //function(){
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
                }
            };
            xmlhttp.open("GET", "./resr/src/PAGE_INCLUDES_SCRIPT/AJAX_HANDLER_TO_RESOURCE.php", true);
            xmlhttp.send();
        }, 1000);
    </script>
    <body class="alx_bg_img">

    <body class="alx_bg_img" onload="BtnDes('<?php echo $BtnDes;?>')">
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
                            <h1 class="alx_h1_title alx_h1_title_fix">Mapa Fabryki</h1>
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
    <script>
        function func_open_zindex(grafika, wydobycie, lvl, nameOfFactory, nameOfResource, idOfFactory) {
            document.getElementById("alx_flexkontener_0").style.opacity = 1;
            document.getElementById("alx_flexkontener_0").style.zIndex = 5;
            document.getElementById("grafika_ligthbox").src = "resr/img/" + grafika;
            document.getElementById("lvl_ligthbox").innerHTML = "Poziom: " + lvl;
            document.getElementById("wydobycie_ligthbox").innerHTML = "Wydobycie: " + wydobycie + "/h";
            document.getElementById("opis_fabryki").innerHTML = "Obiekt: " + nameOfFactory + "<br>Wydobycie: " + nameOfResource;
            document.getElementById("alx_flexkontener_0").style.transition = "all 500ms";
            document.getElementById("idOfFactoryOnMap").value = idOfFactory;
        }

        function func_close_zindex() {
            document.getElementById("alx_flexkontener_0").style.opacity = 0;
            document.getElementById("alx_flexkontener_0").style.zIndex = -1;
        }


        function start_working() {
            document.getElementById("working_ico").src = "resr/img/gear3.svg";
            document.getElementById("working_ico").style.animationIterationCount = 1000;
            document.getElementById("onClickWorking").setAttribute("onClick", "javascript: stop_working();")
        }

        function stop_working() {
            document.getElementById("working_ico").style.animationIterationCount = 0;
            document.getElementById("working_ico").src = "resr/img/stop.png";
            document.getElementById("onClickWorking").setAttribute("onClick", "javascript: start_working();")
        }


        function BtnDes(a) {
            if (a == "zablokuj") {
                // alert(a);
                var n = document.getElementById("addBtnDesibled");
                var a = [];
                var i;
                while (n) {
                    a.push(n);
                    document.getElementById("addBtnDesibled").disabled = true;
                    n.id = "a-different-id";
                    n = document.getElementById("addBtnDesibled");
                }
                for (i = 0; i < a.length; ++i) {
                    a[i].id = "addBtnDesibled";
                }
            } else
            if (a == "odblokuj") {
                // alert(a);
                var n = document.getElementById("addBtnDesibled");
                var a = [];
                var i;
                while (n) {
                    a.push(n);
                    document.getElementById("addBtnDesibled").disabled = false;
                    n.id = "a-different-id";
                    n = document.getElementById("addBtnDesibled");
                }
                for (i = 0; i < a.length; ++i) {
                    a[i].id = "addBtnDesibled";
                }
            }
        }

        function lvlup_open_zindex(task, taskID, quest, quest_id, odp1, odp2, odp3, odp4, odp1_id, odp2_id, odp3_id, odp4_id) {
            alert('Uwaga! Przeładowanie strony spowoduje utratę zebranych surowców, a aktualne badanie zostanie zresetowane!');
            var a = '<?php echo $_SESSION["BtnDes"];?>';
            // alert(a);
            <?php $_SESSION["BtnDes"]="zablokuj";?>
            a = '<?php echo $_SESSION["BtnDes"];?>';

            BtnDes(a);
            setTimeout(
                function(){
                    lvlup_open_zindex_part2(task, taskID, quest, quest_id, odp1, odp2, odp3, odp4, odp1_id, odp2_id, odp3_id, odp4_id);
                }, 1000);

        }

        function lvlup_open_zindex_part2(task, taskID, quest, quest_id, odp1, odp2, odp3, odp4, odp1_id, odp2_id, odp3_id, odp4_id) {
            document.getElementById("lvlup_lightbox").style.opacity = 1;
            document.getElementById("lvlup_lightbox").style.zIndex = 5;
            document.getElementById("task_lightbox").innerHTML = task;
            document.getElementById("quest_lightbox").innerHTML = quest;
            document.getElementById("odp1").innerHTML = odp1;
            document.getElementById("odp2").innerHTML = odp2;
            document.getElementById("odp3").innerHTML = odp3;
            document.getElementById("odp4").innerHTML = odp4;
            document.getElementById("hodp1").value = odp1_id;
            document.getElementById("hodp2").value = odp2_id;
            document.getElementById("hodp3").value = odp3_id;
            document.getElementById("hodp4").value = odp4_id;
            document.getElementById("questID").value = quest_id;
            document.getElementById("taskID").value = taskID;
            document.getElementById("addBtnDesibled").disabled = false;
            <?php $_SESSION["BtnDes"]="odblokuj";?>
            var a = '<?php echo $_SESSION["BtnDes"];?>';
            BtnDes(a);
        }

        function lvlup_close_zindex() {
            document.getElementById("lvlup_lightbox").style.opacity = 0;
            document.getElementById("lvlup_lightbox").style.zIndex = -2;
        }

        var audio = new Audio('resr/img/authors/audio.mp3');
        function lvlup_gratulation_open() {
            document.getElementById("lvlup_gratulation").style.opacity = 1;
            document.getElementById("lvlup_gratulation").style.zIndex = 5;
            audio.play();
        }

        function lvlup_gratulation_close() {
            document.getElementById("lvlup_gratulation").style.opacity = 0;
            document.getElementById("lvlup_gratulation").style.zIndex = -5;
            window.location.href = "db_update_user.php?lvlup=true";
            audio.stop();
        }

    </script>

    </body>
    </html>

<?php } else if (isset($_SESSION["idUser"]) && $_SESSION["UserType"] == "1") {
    header("Location:AdminControllerSystem.php");
} else if (!isset($_SESSION["idUser"])) {
    header("Location:index.php");
} ?>