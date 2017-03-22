<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Ajout d'auteur"; //Titre à changer sur chaque page
require_once 'menu.php';
?>

<style>
    .btn-default {
        width: 150px;
    }

    .aucentre {
        text-align: center;
    }

    label {
        display: block;
        width: 150px;
        float: left;
    }

    body #maincontent {
        width: 90%;
        min-height: 400px;
    }

    #maincontent {
        padding: 32px 16px;
        max-width: 894px;
        min-width: 320px;
    }

    body #maincontent, body .pageSectionContainer, body #c_content {
        margin: 1 auto;
        margin-top: 0px;
        margin-right: auto;
        margin-bottom: 0px;
        margin-left: 400px;
    }
</style>


<br/><br/>
<br/><br/>

<body>
<fieldset>

    <div id="maincontent">
        <form class="form-group" method="post">
            <p>
            <div class="form-group">
                <label class="col-md-2 control-label" for="nomAuteur">Nom auteur :</label>
                <input type="text" name="nomAuteur" placeholder="Nom" required size="25"/><br/>
            </div>
            <br/>
            <div class="form-group">
                <label class="col-md-2 control-label" for="prenomAuteur">Prénom auteur :</label>
                <input type="text" name="prenomAuteur" placeholder="Prénom" required size="25"/><br/>
            </div>


            </p>

            <br/>
            <input class="btn btn-default" type="submit" name="valider" value="Valider"/>
        </form>
    </div>
</fieldset>
</body>

<?php
if (isset($_POST['valider'])) {
    $rep = $bdd->query('SELECT max(ID_AUTEUR) as id FROM auteur');
    $donnees = $rep->fetch();
    $bdd->exec('INSERT INTO auteur(ID_AUTEUR, NOM_AUTEUR, PRENOM_AUTEUR) 
			VALUES(\'' . ($donnees['id'] + 1) . '\',
				\'' . strip_tags($_POST['nomAuteur']) . '\',
				\'' . strip_tags($_POST['prenomAuteur']) . '\')');

    echo 'L\'auteur a bien été ajouté !';
}
?>
