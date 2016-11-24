<!DOCTYPE html>
<html>
<link rel="icon" type="image/png" href="favicon.png"/>

<head>
    <title>Librairie</title>
    <link rel="icon" href="logo.gif">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="Style.css"/>
</head>
<?php
require_once('menu.php'); ?>

<br/><br/>
<br/><br/>

<body>

<blockquote style="margin-left:100px;margin-right:100px;">

    <h2>La librairie du Chameau ouvre ses portes à Dozulé à l’initiative des Éditions du Chameau.</h2></br></br>
    Après plus de 10 ans d’existence, les Éditions du Chameau ouvrent une librairie associative regroupant uniquement
    des micros-éditions à caractère artistique et littéraire. Située à Dozulé (14), cette librairie a pour but de
    regrouper et travailler avec des éditeurs, mais également de faire connaître des petits auteurs français et
    francophones. Enfin, cette librairie permet de diffuser et de garder la trace de réalisations artistiques, mais
    aussi d'associer dans cette aventure des personnes qui écrivent, favorisant la proximité artistique et les
    rencontres.</br></br>
    Créées en 1993, les Éditions du Chameau sont spécialisées dans la micro-édition de livres d’art et de poésie. Les
    Éditions du Chameau ont été officiellement lancées en 2002 lors de la parution d’un recueil d’aphorismes de Pierre
    Lebigre.</br> </br>
    Les Éditions du Chameau ont pour objectif d’éditer des œuvres en un nombre d’exemplaires volontairement restreint,
    de réaliser des œuvres à un prix de vente accessible, aussi bien pour la fabrication que pour les éventuels
    acquéreurs, tout en étant de belle qualité.</br> </br>
    Les Éditions du Chameau ont déjà 78 titres à notre catalogue et 5 titres dans la collection « l’unique ».
    </br> </br>

</blockquote>


<br/></br></br></br>

<h2 style="margin-left:300px;">Où sommes nous ?</h2>
<div class="container">
    <div class="row" id="login-container">
        <div class="span8 offset2">
            <div class="row text-center bg-1 ">
                <div id="googleMap"
                     style=" width:970px; height:500px; text-align:center; margin-left:10px; margin-right:10x; margin-top:10px; margin-bottom:10px"></div>
            </div>
        </div>
    </div>
</div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD-QWantOsGGvCL5ANHhc1mrst_yxFGZxE"></script>
<script>
    var myCenter = new google.maps.LatLng(49.230711, -0.047355);

    function initialize() {
        var mapProp = {
            center: myCenter,
            zoom: 12,
            scrollwheel: false,
            draggable: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        var marker = new google.maps.Marker({
            position: myCenter,
        });

        marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

</br></br>

</body>
</html>