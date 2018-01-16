
loading();

function loading() {
    var reload = "<?php echo $_SESSION['ActionInfo'];?>";
    if(reload=="") {
        // alert("reload empty");
        setTimeout(function () {
            document.getElementById("loading").style.transition = "opacity 500ms";
            document.getElementById("loading").style.opacity = 0;
            document.getElementById("loading").style.zIndex = -2;
        }, 1000);
    }else{
        setTimeout(function () {
            document.getElementById("loading").style.opacity = 0;
            document.getElementById("loading").style.zIndex = -2;
        }, 10);
    }
}

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

function lvlup_open_zindex_noAnswer(taskID){
    window.location.href = "db_update_user.php?noAnswer=true&taskID=" + taskID;
}

function lvlup_open_zindex(task, taskID, quest, quest_id, odp1, odp2, odp3, odp4, odp1_id, odp2_id, odp3_id, odp4_id) {
    // alert('Uwaga! Zamknięcie urządzenia, bądź wylogowanie spowoduje utratę zebranych surowców, a aktualnie prowadzone badanie zostanie zresetowane!');
    var a = '<?php echo $_SESSION["BtnDes"];?>';
    // alert(a);
<?php $_SESSION["BtnDes"]="zablokuj";?>
    a = '<?php echo $_SESSION["BtnDes"];?>';

    BtnDes(a);
    setTimeout(
        function(){
            lvlup_open_zindex_part2(task, taskID, quest, quest_id, odp1, odp2, odp3, odp4, odp1_id, odp2_id, odp3_id, odp4_id);
        }, 0);

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

var audio = new Audio('resr/audio/audio.mp3');
function lvlup_gratulation_open(eofg) {
    if(eofg!="gameover") {
        document.getElementById("lvlup_gratulation").style.opacity = 1;
        document.getElementById("lvlup_gratulation").style.zIndex = 5;
        audio.play();
    }else{
        alert("Na chwilę obecną wykonałeś wszystkie aktywności, przez co skończyłeś naszą grę! Dziękujemy, że byłeś z nami :D");
    }
}

function lvlup_gratulation_close() {
    document.getElementById("lvlup_gratulation").style.opacity = 0;
    document.getElementById("lvlup_gratulation").style.zIndex = -5;
    window.location.href = "db_update_user.php?lvlup=true";
    audio.stop();
}
