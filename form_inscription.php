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
            <p>Les champs accompagnés d'une étoile sont obligatoire</p>
            <form method="post">
                <p>
                <fieldset>
                    <legend> Identifiants :</legend>
                    <label class="text-base" for="pseudo">Pseudonyme: *</label>
                    <input type="text" name="pseudo" placeholder="Entrez un pseudo" pattern="[a-zA-Z0-9]{4,}$"/><p>Pseudo qui sera visible par les autres Utilisateurs</p>
                    <label for="passe">Mot de passe: *</label>
                    <input type="password" name="passe" placeholder="Entrez un mot de passe" pattern="[a-zA-Z0-9]{4,}$"/><br/><br/>
                    <label>Confirmation du mot de passe: *</label>
                    <input type="password" name="passe2" placeholder="Confirmez mot de passe" /><br/><br/>
                </fieldset>

                <fieldset>
                    <legend>Adresse Postale:</legend>
                    <label class="text-base" for="rue">Adresse: *</label>
                    <input type="text" name="adresse" placeholder="Entrez votre adresse" pattern="([a-zA-Z0-9](\s){,1}){4,}$"/><br/><br/>
                    <label class="text-base" for="postale">Code Postale: *</label>
                    <input type="text" name="postale" placeholder="Entrez code postale" pattern="[0-9]{5,5}$"/><br/><br/>
                    <label class="text-base" for="ville">Ville: *</label>
                    <input type="text" name="ville" placeholder="Entrez votre ville" pattern="[a-zA-Z]{2,}$"/><br/><br/>
                </fieldset>

                <fieldset>
                    <legend>Coordonnées</legend>
                    <label class="text-base" for="nom">Nom: *</label>
                    <input type="text" name="nom" placeholder="Entrez votre nom" pattern="[a-zA-Z]{2,}$"/><br/><br/>
                    <label class="text-base" for="prenom">Prenom: *</label>
                    <input type="text" name="prenom" placeholder="Entrez votre prenom" pattern="[a-zA-Z]{2,}$"/><br/><br/>
                    <label>Adresse e-mail: *</label>
                    <input type="text" name="email" placeholder="Entrez adresse mail" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/><br/><br/>
                    <label class="text-base" for="numero">Numero de téléphone: *</label>
                    <input type="text" name="numero" placeholder="Entrez numéro de tél" pattern="[0-9]{10,12}"/><br/><br/>
                </fieldset>

				 <fieldset>
					<legend>Professionnel</legend>
					<label class="text-base" for="Editeur">Je suis un éditeur : *</label>
					<input type="checkbox" name="Editeur" onclick="document.getElementById('formcache_Editeur').style.display = (this.checked? 'block':'none');" value = "Je suis un editeur"/>

						<br/>	<br/>

					<div id="formcache_Editeur" style="display: none">
					<label class="col-md-2 control-label" for="idEditeur">Id éditeur:</label>
					<input  type="text" name="idEditeur" placeholder="Identifiant" pattern="[0-9]{4,6}"/><br/><br/>
					<label class="col-md-2 control-label" for="nomEditeur">Nom éditeur:</label>
					<input  type="text" name="nomEditeur" placeholder="Nom" pattern="[A-Za-z]{1,}"/><br/><br/>
					</div>

					<input type="checkbox" name="Client_Pro" onclick="document.getElementById('formcache_ClienPro').style.display = (this.checked? 'block':'none');" value = "Je suis un client professionel"/>
					<label class="text-base" for="Client_Pro">Je suis un client professionnel : *</label>

								<br/>	<br/>	<br/>



					<div id="formcache_ClienPro" style="display: none">
					<label class="col-md-2 control-label" for="siret">N° Siret :</label>
					<input  type="text" name="siret" placeholder="Identifiant" pattern="[0-9]{14}"/><br/><br/>

					</div>


				 </fieldset>
                <br/>
                <input class="btn btn-default" type="submit" name="valider" value="S'inscrire"/>
                <input class="btn btn-default" type="button" name="Retour" value="Retour" onclick="self.location.href='index.php'"/>
                </p>
            </form>
        <?php } ?>
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
    if ((empty($_POST['nom']))) {
        $i = 0;
        $text = "Veuillez rentrer un nom";
    }
    if ((empty($_POST['prenom']))) {
        $i = 0;
        $text = "Veuillez rentrer un prénom";
    }
    if ((empty($_POST['adresse']))) {
        $i = 0;
        $text = "Veuillez rentrer une adresse postale";
    }
    if ((empty($_POST['postale']))) {
        $i = 0;
        $text = "Veuillez rentrer un code postale";
    }
    if ((empty($_POST['ville']))) {
        $i = 0;
        $text = "Veuillez rentrer une ville";
    }
    if ((empty($_POST['numero']))) {
        $i = 0;
        $text = "Veuillez rentrer un numéro de téléphone";
    }
    if ((empty($_POST['numero']))&&(empty($_POST['ville']))&&(empty($_POST['postale']))&&(empty($_POST['adresse']))&&(empty($_POST['prenom']))&&(empty($_POST['nom']))&&(empty($_POST['pseudo']))) {
        $i = 0;
        $text = "Veuillez remplir le formulaire";
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
            $text = "Les mots de passes ne correspondent pas";
        }
    } else if ($i == 1) {
        $i = 0;
        $text = "Merci de rentrer un mot de passe";
    }


	if (isset($_POST['Editeur'])) {
			if (empty($_POST['idEditeur']))
		    {

		         $i = 0;
				$text = "Veuillez entrer votre identifiant d'éditeur";
			}

            $nbligne = $bdd->query('SELECT NOM_EDITEUR FROM compte_fournisseur WHERE N_COMPTE = NULL && ID_EDITEUR = \'' . $_POST['idEditeur'] . '\' ');
            $nbligne = $nbligne->rowCount();
            if ($nbligne != 0) {
                $i = 0;
                $text = "Un compte a déjà étais crée avec cette identifiant";
            }

	      if (empty($_POST['nomEditeur']))
		    {

		         $i = 0;
				$text = "Veuillez entrer votre nom d'éditeur";
			}

	}

	if (isset($_POST['Client_Pro'])) {
		  if (empty($_POST['siret']))
		    {

		         $i = 0;
				$text = "Veuillez entrer votre Siret";
			}
	}



//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    if ($i == 1) {

        $nb = $bdd->query('SELECT max(NUMERO_COMPTE) as max FROM compte');
        $nbcom = $bdd->query('SELECT max(NUMERO_COMMANDE) as max FROM commande');
        $nb = $nb->fetch();
        $nbcom = $nbcom->fetch();
        $bdd->exec('INSERT INTO compte(NUMERO_COMPTE, IDENTIFIANT, MOT_DE_PASSE, ADRESSE_MAIL, NUMERO_TELEPHONE, ADRESSE, CODE_POSTALE, VILLE) 
					VALUES(
					 \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($_POST['pseudo']) . '\',
					 \'' . strip_tags(md5($_POST['passe'])) . '\',
					 \'' . strip_tags($_POST['email']) . '\',
					 \'' . strip_tags($_POST['numero']) . '\',
					 \'' . strip_tags($_POST['adresse']) . '\',
					 \'' . strip_tags($_POST['postale']) . '\',
					 \'' . strip_tags($_POST['ville']) . '\')');
        $bdd->exec('INSERT INTO client(NUMERO_COMPTE, NOM, PRENOM) 
					VALUES(
					 \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($_POST['nom']) . '\',
					 \'' . strip_tags($_POST['prenom']) . '\')');
        $bdd->exec('INSERT INTO commande(NUMERO_COMPTE, NUMERO_COMMANDE) 
					VALUES(
					 \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($nbcom['max']+1) . '\')');

        if (isset($_POST['Client_Pro'])) {
            $bdd->exec('INSERT INTO compte_client_pro(NUMERO_COMPTE, NUMERO_PRO) 
					VALUES(
					 \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($_POST['siret']) . '\')');
        }
        if (isset($_POST['Editeur'])) {

            $nbligne = $bdd->query('SELECT NOM_EDITEUR FROM compte_fournisseur WHERE N_COMPTE is NULL && ID_EDITEUR = \'' . $_POST['idEditeur'] . '\' ');
            $nbligne = $nbligne->rowCount();

            if ($nbligne != 0) {
                $bdd->exec('UPDATE compte_fournisseur
					SET N_COMPTE = 
					 \'' . strip_tags($nb['max'] + 1) . '\'
					where ID_EDITEUR = 
					 \'' . strip_tags($_POST['idEditeur']) . '\'');
            }
            else {
                $bdd->exec('INSERT INTO compte_fournisseur(N_COMPTE, ID_EDITEUR, NOM_EDITEUR) 
					VALUES(
					 \'' . strip_tags($nb['max'] + 1) . '\',
					 \'' . strip_tags($_POST['idEditeur']) . '\',
					 \'' . strip_tags($_POST['nomEditeur']) . '\')');
            }


        }
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


