
<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>
<br/><br/>
<br/><br/>
<fieldset>
    <legend>Liste des articles</legend>
    <p> Faire une recherche par: </p>
    <form method="post">
        <input id="radio" type="radio" name="radio" value="TITRE" checked> Titre
        <input id="radio" type="radio" name="radio" value="ISBN_ISSN"> ISBN/ISSN
        <input id="radio" type="radio" name="radio" value="NOM_EDITEUR"> Editeur
        <input id="radio" type="radio" name="radio" value="COLLECTION"> Collection
        <input id="radio" type="radio" name="radio" value="MOTCLES"> Mots-clés
    </form>
    <form class="ajax" method="post" autocomplete="off">

        <p>
            <label for="q">Rechercher un article</label><input type="text" name="q" id="q"/>
        </p>
    </form>
    <div id="results" style="min-width:300px;"><?php include 'ajax-search-vitrine.php' ?></div>
</fieldset>


<?php

if (isset($_POST['delete'])) :
    $bdd->exec('DELETE FROM ecrire WHERE ISBN_ISSN ="' . $_POST['delete'] . '"');
    $bdd->exec('DELETE FROM article WHERE ISBN_ISSN = "' . $_POST['delete'] . '"');
    echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
endif;
?>


<script type="text/javascript">
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $('#q').keyup(function () {
            $field = $(this);
            $('#results').html('');
            $('#ajax-loader').remove();
            var elements = document.getElementsByName("radio");
            var j;
            for (var i = 0; i < elements.length; i++) {
                if (elements[i].checked) {
                    j = elements[i].value;
                }
            }

            $.ajax({
                type: 'POST', // envoi des données en GET ou POST
                url: 'ajax-search-vitrine.php', // url du fichier de traitement
                data: {q: $(this).val(), radio: j}, // données à envoyer en  GET ou POST
                beforeSend: function () { // traitements JS à faire AVANT l'envoi
                    $field.after('<img src="ajax-loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
                },
                success: function (data) { // traitements JS à faire APRES le retour d'ajax-search.php
                    $('#ajax-loader').remove(); // on enleve le loader
                    $('#results').html(data); // affichage des résultats dans le bloc
                }
            });

        });
    });
</script>

