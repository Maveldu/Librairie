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

<html>

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
<br/>
<body>
<fieldset>
    <div id="maincontent">
        <?php
        if (isset($_SESSION['id'])) {
            echo "<p> Vous êtes connecté, vous ne pouvez pas vous inscrire ! </p>";
        } else { ?>
        <h3>INSCRIPTION:</h3>
        <p>Les champs accompagnés d'une étoile sont obligatoires</p>
        <form method="post">
            <p>
            <fieldset>
             <legend>Coordonnées</legend>
                <label class="text-base" for="nom">Nom: *</label>
                <input type="text" name="nom" placeholder="Entrez votre nom" pattern="[a-zA-Z]{2,}$"/><br/><br/>
                <label class="text-base" for="prenom">Prenom: *</label>
                <input type="text" name="prenom" placeholder="Entrez votre prenom" pattern="[a-zA-Z]{2,}$"/><br/><br/>
                <label class="text-base" for="email">Adresse e-mail: *</label>
                <input type="text" name="email" placeholder="Entrez adresse mail" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/><br/><br/>
                <label class="text-base" for="numero">Numero de téléphone: *</label>
                <input type="text" name="numero" placeholder="Entrez numéro de tél" pattern="[0-9]{10,12}"/><br/><br/>
</fieldset>




<br/>
<input class="btn btn-default" type="submit" name="continuer" value="Continuer"/>
<input class="btn btn-default" type="button" name="Retour" value="Retour à la page d'Accueil" onclick="self.location.href='index.php'"/>
            <p>Page 1/3</p>
</p>
    </div>
    </form>
<?php } ?>
</div>
</fieldset>
</body>
</html>

<!--VERIFICATION DU FORMULAIRE-->
<?php
if (isset($_POST['continuer'])) {
    $i = 1;

    if ((empty($_POST['nom']))) {
        $i = 0;
        $text = "Veuillez rentrer votre Nom";
    }
    if ((empty($_POST['prenom']))) {
        $i = 0;
        $text = "Veuillez rentrer votre Prénom";
    }
    if ((empty($_POST['email']))) {
        $i = 0;
        $text = "Veuillez rentrer votre adresse email";
    }
    if ((empty($_POST['numero']))) {
        $i = 0;
        $text = "Veuillez rentrer votre numéro de téléphone";
    }
    if ((empty($_POST['nom'])) && (empty($_POST['prenom'])) && (empty($_POST['email'])) && (empty($_POST['numero']))) {
        $i = 0;
        $text = "Veuillez remplir le formulaire";
    } else {
            $nbligne = $bdd->query('SELECT ADRESSE_MAIL FROM compte WHERE ADRESSE_EMAIL = \'' . $_POST['email'] . '\' ');
            $nbligne = $nbligne->rowCount();
            if ($nbligne != 0) {
                $text = "Votre adresse email est déjà utilisé sur notre site";
            }
            $nbligne = $bdd->query('SELECT NUMERO_TELEPHONE FROM compte WHERE NUMERO_TELEPHONE = \'' . $_POST['numero'] . '\' ');
            $nbligne = $nbligne->rowCount();
            if ($nbligne != 0) {
                $text = "Votre numéro de telephone est déjà utilisé sur notre site";
            }

        }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    if ($i == 1) {

        $nb = $bdd->query('SELECT max(NUMERO_COMPTE) as max FROM compte');
        $nbcom = $bdd->query('SELECT max(NUMERO_COMMANDE) as max FROM commande');
        $nb = $nb->fetch();
        $nbcom = $nbcom->fetch();
        $bdd->exec('INSERT INTO compte(NUMERO_COMPTE,ADRESSE_MAIL, NUMERO_TELEPHONE) 
					VALUES(
					 \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($_POST['email']) . '\',
					 \'' . strip_tags($_POST['numero']) . '\')');
        $bdd->exec('INSERT INTO client(NUMERO_COMPTE, NOM, PRENOM) 
					VALUES(
					 \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($_POST['nom']) . '\',
					 \'' . strip_tags($_POST['prenom']) . '\')');
        $bdd->exec('INSERT INTO commande(NUMERO_COMPTE, NUMERO_COMMANDE) 
					VALUES(
					 \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($nbcom['max']+1) . '\')');

        $inscrit = "Vous êtes bien inscrit !";
        echo '<script type="text/javascript">window.alert("'.$inscrit.'");</script>';
        ?>
        <script language="javascript">
            setTimeout("location.href = 'index.php'",1);
        </script>
        <?php

    } else {
        echo '<script type="text/javascript">window.alert("'.$text.'");</script>';
    }
}
?>


