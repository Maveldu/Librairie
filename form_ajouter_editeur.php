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

<style>

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
                <label class="col-md-2 control-label" for="idEditeur">Id éditeur:</label>
                <input required type="text" name="idEditeur" placeholder="Identifiant" pattern="[0-9]{4,6}"><br/>
            </div>


            <div class="form-group">
                <label class="col-md-2 control-label" for="nomEditeur">Nom éditeur:</label>
                <input required type="text" name="nomEditeur" placeholder="Nom" pattern="[A-Za-z]{1,}"><br/>
            </div>

            </p>


            <input class="btn btn-default" type="submit" name="valider" value="Valider"/>
        </form>
    </div>
</fieldset>
</body>
</html>


<?php
if (isset($_POST['valider'])) {
    $idEditeur = $_POST['idEditeur'];
    $idEditeurExist = $bdd->query('SELECT ID_EDITEUR FROM editeur WHERE ID_EDITEUR = "' . $idEditeur . '"');
    $ligneResult = $idEditeurExist->rowCount();


    if ($ligneResult == 1) {
        echo 'L\'éditeur que vous essayez de rentrer exise déjà';
    } else {
        $req = $bdd->prepare('INSERT INTO editeur(ID_EDITEUR, NOM) VALUES(:idEditeur, :nomEditeur)');
        $req->execute(array(
            'idEditeur' => strip_tags($_POST['idEditeur']),
            'nomEditeur' => strip_tags($_POST['nomEditeur'])));


        echo 'L\'éditeur a bien été ajouté !';
    }


}
?>