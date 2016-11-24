<?php
session_start();
if(isset($_POST['valider'])){
	header('Location: index.php');
}
require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>


<html>
<link rel="icon" type="image/png" href="logo.png" />
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
    <div id ="maincontent"> 
    <?php if(isset($_SESSION['id'])) {
        echo "Vous êtes déjà connecté !";
    }
        else{?>

    <form method="post">
        <p>
            <div>
                <label for="pseudo">Pseudonyme: </label><input type="text" name="pseudo" pattern="[a-z0-9]{4,}$"/><br /><br />
                <label for="passe">Mot de passe: </label><input type="password" name="passe" pattern="[a-z0-9]{4,}$"/><br/><br/>
                <br/><br/>
                <input class="btn btn-default" type="submit" name="valider" value="Se connecter"/>
            <input class="btn btn-default" type="button" name="Accueil" value="Accueil" onclick="self.location.href='index.php'">
        </div>
        </p>
    </form>
    <?php } ?>
    </div>
</fieldset>
</body>
</html>


<?php
	if(isset($_POST['valider'])){
	$i = 0;
    if (empty($_POST['pseudo']) || empty($_POST['passe']) )
    {
    	$i = 1;
        $text = "Vous devez remplir tous les champs";
    }
    else
    {
        $nbligne=$bdd->query('SELECT IDENTIFIANT, MOT_DE_PASSE
        FROM compte WHERE IDENTIFIANT = \''.$_POST['pseudo'].'\'')->fetchAll();
		if($nbligne != 0){
			$req=$bdd->query('SELECT IDENTIFIANT, MOT_DE_PASSE, ADRESSE_MAIL
	        FROM compte WHERE IDENTIFIANT LIKE  \''.$_POST['pseudo'].'\'');
        	$donnee=$req->fetch();
        	if ($donnee['MOT_DE_PASSE'] == md5($_POST['passe'])){
			    $_SESSION['id'] = $donnee['IDENTIFIANT'];
			    $_SESSION['mail'] = $donnee['ADRESSE_MAIL'];
			    $text = "Vous êtes bien connecté, bienvenue ".$_SESSION['id'].".
			    		<br /> Pour rappel, votre mail: ".$_SESSION['mail']."";
			    header('Location: index.php');
	if(isset($_SESSION['id'])){

        }


            }
        	else{
        		$i = 1;
        		$text = "Mot de passe incorrect";
        	}

		}
		else if($i == 0){
			$text = "Le compte n'existe pas";
		}

    }
	echo "<p>".$text."</p>";

}

?>