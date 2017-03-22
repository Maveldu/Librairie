<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Auteurs"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>

<br/><br/>
<br/><br/>
<fieldset>
    <p> Faire une recherche par : </p>
    <form class="ajax" action="ajax-search.php" method="post" autocomplete="off">
        <p>
            <label for="q">Rechercher un auteur</label><input type="text" name="q" id="q"/>
        </p>
    </form>
    <div id="results"><?php include 'ajax-search-auteur.php' ?></div>

</fieldset>


<?php

if (isset($_POST['delete'])) :
    $bdd->exec('DELETE FROM auteur WHERE ID_AUTEUR = "' . $_POST['delete'] . '"');
    echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
endif;
?>


<script type="text/javascript">
    $(document).ready(function () {
        $('#q').keyup(function () {
            $field = $(this);
            $('#results').html('');
            $('#ajax-loader').remove();

            $.ajax({
                type: 'POST', // envoi des données en GET ou POST
                url: 'ajax-search-auteur.php', // url du fichier de traitement
                data: 'q=' + $(this).val(), // données à envoyer en  GET ou POST
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