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

    <!--Import aleks_style.css-->
    <link type="text/css" rel="stylesheet" href="style/aleks_style.css"/>

</head>
<body class="alx_bg_tut">
<div id="tutbg" class="tutbg">
    <div class="tut">
        <h1>Witaj w Factorio Online!</h1>
        <br/>
        <h2>Nim zaczniesz rozgrywkę chcielibyśmy Ci wyjaśnić na czym ona polega:</h2>
        <p class="zasady">
            <br/><br/>1. Po lewej stronie znajdziesz pasek z surowcem. Po pewnym czasie zapełni się cały.
            <br/><br/>2. W zakładce "Mapa Fabryki" znajdują się obiekty dostarczające surowców. Im więcej tych samych
            obiektów, tym szybciej ładują się paski po lewej.
            <br/><br/>3. Gdy wszystkie surowce zostaną zebrane odblokują się nowe zadania w zzakładce "Postęp technologiczny".
            <br/><br/>4. By Przejść na kolejny poziom, potrzebujesz wykonać wszystkie badania oraz zebrać surowce do wylewelowania.
            <br/><br/>5. Koniec gry nastąpi w momęcie braku nowych zadań.
            <br/><br/>6. Uwaga! Pola na mapie są ograniczone, jednak budowa i niszczenie fabryk są darmowe. Zarządzaj mapą tak, by
            jak najoptymalninej przebiegało pozyskiwanie surowców.
            <br/><br/>7. Na koniec musisz wiedzieć iż wylogowanie, bądź wyłączenie gry sprawi zresetowanie zebranych surowców!
            <br/><br/>
        </p>
        <h2>Dobrej zabawy : ]</h2>
        <br/><br/>
        <button onclick="tutok()" class="tutbtn">OK, zaczynajmy!</button>
        <script>
            function tutok() {
                window.location.href = "Map.php";
            }
        </script>
    </div>
</div>
</body>
</html>