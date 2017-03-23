<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();

require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Connexion"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
$co=null;
$motif="^('{0,1}((([[:alpha:]]{1,})|[àâçèéêîôùû]){1,}'{0,1}){1,}(-'{0,1}((([[:alpha:]]{1,})|[àâçèéêîôùû]){1,}'{0,1}){1,})*)([[:space:]]'{0,1}((([[:alpha:]]{1,})|[àâçèéêîôùû]){1,}'{0,1}){1,}(-'{0,1}((([[:alpha:]]{1,})|[àâçèéêîôùû]){1,}'{0,1}){1,})*)*$";
?>


<html>
<link rel="icon" type="image/png" href="logo.png"/>
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
        <?php if (isset($_SESSION['id'])) {
            echo "Vous êtes déjà connectés !";
        } else {
            ?>

            <form method="post">
                <p>
                <div>
                    <label for="pseudo">Pseudonyme : </label><input type="text" name="pseudo" placeholder="Entrez votre pseudo"<?php if(isset($_POST['pseudo'])){echo ('value ="'.$_POST['pseudo'].'"') ;} ?>
                                                                   pattern="[a-zA-Z0-9]{4,}$"/><br/><br/>
                    <label for="passe">Mot de passe : </label><input type="password" name="passe" placeholder="Entrez mot de passe"
                                                                    pattern="[a-zA-Z0-9]{4,}$"/><br/><br/>
                    <br/><br/>
                    <input class="btn btn-default" type="submit" name="valider" value="Se connecter"/>
                    <input class="btn btn-default" type="button" name="Accueil" value="Accueil"
                           onclick="self.location.href='index.php'">
                </div>
                </p>
            </form>
        <?php } ?>
    </div>
</fieldset>
</body>
</html>


<?php
if (isset($_POST['valider'])) {
    $i = 0;
    if (empty($_POST['pseudo']) || empty($_POST['passe'])) {
        $i = 1;
        $text = "Vous devez remplir tous les champs";
    } else {
        $nbligne = $bdd->query('SELECT IDENTIFIANT, MOT_DE_PASSE
        FROM compte WHERE IDENTIFIANT = \'' . $_POST['pseudo'] . '\'')->fetchAll();
        if ($nbligne != 0) {
            $req = $bdd->query('SELECT IDENTIFIANT, MOT_DE_PASSE, ADRESSE_MAIL
	        FROM compte WHERE IDENTIFIANT LIKE  \'' . $_POST['pseudo'] . '\'');
            $donnee = $req->fetch();
            if ($donnee['MOT_DE_PASSE'] == md5($_POST['passe'])) {
                $co = 1;
                $_SESSION['id'] = $donnee['IDENTIFIANT'];
                $_SESSION['mail'] = $donnee['ADRESSE_MAIL'];
                $text = "Vous êtes bien connectés, bienvenue " . $_SESSION['id'] . ".
			    		<br /> Pour rappel, votre mail: " . $_SESSION['mail'] . "";

                if (isset($_SESSION['id'])) {

                }


            } else {
                $i = 1;
                $text = "Nom de compte ou mot de passe incorrect";
            }

        } else if ($i == 0) {
            $text = "Ce compte n'existe pas";
        }

    }
    echo "<p>" . $text . "</p>";

}

?>
<?php

if ($co == 1) {
    ?>
    <script language="javascript">
        setTimeout("location.href = 'index.php'",1);
    </script>
    <?php
}
?>
