<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Créer gérant"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
error_reporting(3);
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
            <form method="post">
                <p>
                <fieldset>
                    <legend> Identifiants :</legend>
                    <label class="text-base" for="pseudo">Pseudonyme : *</label>
                    <input type="text" name="pseudo" pattern="[a-zA-Z0-9]{4,}$"/><br/><br/>
                    <label for="passe">Mot de passe : *</label>
                    <input type="password" name="passe" pattern="[a-zA-Z0-9]{4,}$"/><br/><br/>
                    <label>Confirmation du mot de passe : *</label>
                    <input type="password" name="passe2"/><br/><br/>
                </fieldset>

                <input class="btn btn-default" type="submit" name="valider" value="Créer"/>
				<input class="btn btn-default" type="submit" name="compte_aleatoire" value="Compte aléatoire"/>
                <input class="btn btn-default" type="button" name="Retour" value="Retour"
                       onclick="self.location.href='index.php'">
                </p>
            </form>
    </div>
</fieldset>
</body>
</html>

<!--VERIFICATION DU FORMULAIRE-->
<?php
if (isset($_POST['valider'])) {
    $i = 1;

    if ((empty($_POST['pseudo']))) {
        $i = 0;
        $text = "Veuillez rentrer un identifiant";
    }

    else {
        $nbligne = $bdd->query('SELECT IDENTIFIANT FROM compte WHERE IDENTIFIANT = \'' . $_POST['pseudo'] . '\' ');
        $nbligne = $nbligne->rowCount();
        if ($nbligne != 0) {
            $text = "Le nom de compte existe déjà";
        }

    }
    if ((!empty($_POST['passe']) && !empty($_POST['passe2'])) && ($i == 1)) {
        if ($_POST['passe'] != $_POST['passe2']) {

            $i = 0;
            $text = "Les mots de passe ne correspondent pas";
        }
    } else if ($i == 1) {
        $i = 0;
        $text = "Merci de rentrer un mot de passe";
    }


    if ($i == 1) 
	{
        $identifiant = $_POST['pseudo'];
        $mdp = $_POST['passe'];
        $nb = $bdd->query('SELECT max(NUMERO_COMPTE) as max FROM compte');
        $nb = $nb->fetch();


        $bdd->exec('INSERT INTO compte(NUMERO_COMPTE, IDENTIFIANT, MOT_DE_PASSE) 
					VALUES(
                     \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($identifiant) . '\',
                     \'' . strip_tags(md5($mdp)) . '\');');


        $bdd->exec('INSERT INTO compte_gerant(NUMERO_COMPTE) 
                    VALUES(
                     \'' . strip_tags($nb['max'] + 1) . '\');');

        echo "<center> Le compte gérant a bien été créé !<br/>";

        echo "identifiant : $identifiant<br/>";
        echo "mot de passe : $mdp<br/> </center>";

    } 
	else 
	{
        echo '<script type="text/javascript">window.alert("'.$text.'");</script>';
    }
}

if (isset($_POST['compte_aleatoire'])) 
{
		

	$char = "abcdefghijklmnopqrstuvwxyz0123456789";
	$mdp = str_shuffle($char);
	$mdp = substr($mdp , 0 , 7);

	
	$nb = $bdd->query('SELECT count(NUMERO_COMPTE) as max FROM compte_gerant');
    $nb = $nb->fetch();
	
	$identifiant = "gerant_".strip_tags($nb['max'] + 1) ;
		
		
		
		
	$nb = $bdd->query('SELECT max(NUMERO_COMPTE) as max FROM compte');
	$nb = $nb->fetch();
	
	
	$bdd->exec('INSERT INTO compte(NUMERO_COMPTE, IDENTIFIANT, MOT_DE_PASSE) 
				VALUES(
				 \'' . strip_tags($nb['max'] + 1) . '\',
				 \'' . strip_tags($identifiant) . '\',
				 \'' . strip_tags(md5($mdp ). '\')'));

	$bdd->exec('INSERT INTO compte_gerant(NUMERO_COMPTE) 
				VALUES(
				 \'' . strip_tags($nb['max'] + 1) . '\')');
		

	echo "<p> Le compte gérant a bien été créé ! </p></br>";
	
		echo "identifiant : $identifiant</br>";
	echo "mot de passe : $mdp</br>";
		

}

?>


