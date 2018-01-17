<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function javamessage($txt)
{
    $show = <<<HTML
    
<script>
    function jsmessage(txt){
        const mess = document.querySelector(".jsmessage");
        mess.style.opacity = 1;
        mess.innerHTML = txt;
        setTimeout(function() {
                mess.style.transition = "opacity 1000ms" 
                mess.style.opacity = 0;
        },5000);
}
        jsmessage('$txt');
        </script>

HTML;
    echo $show;
}


function jsEOG()
{
    $show = <<<HTML
<script>alert("Gratulacje! Ukończyłeś grę :D");</script>
HTML;
    echo $show;
}

function javaalert($txt){
    echo "<script>alert('$txt');</script>";
}

?>