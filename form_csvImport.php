<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>
    <style>
        .btn-default {
            width: 150px;

        }

    </style>


    <br/><br/>
    <br/><br/>
    <fieldset>

        <form class="form-group" method="post" enctype="multipart/form-data">
            <p>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="fichier">Votre fichier:</label>
                    <input type="file" name="fichier"/><br/><br/>
            <p align="center"><input class="btn btn-default" type="submit" name="valider" value="Envoyer"/></p>

            </p>
            <br/><br/>
        </form>
    </fieldset>
    </html>


<?php
if (isset($_POST["valider"])) {

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=librairie4.0;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $i = 0;
    $fichier = $_FILES["fichier"]["name"];

    if (!empty($fichier)) {
        $fp = fopen("../$fichier", "r");
    } else { // fichier inconnu
        echo "Fichier introuvable !<br>Importation stoppe."; ?>
        <br/><br/> <a href="http://localhost/librairie/menu.php" class="bouton">Retour au menu</a><br/><br/>
        <?php
        exit();
    }

    $count = count(file($fichier));
    $liste = fgetcsv($fp, 1000, ',');
    while (($liste = fgetcsv($fp, 1000, ',')) != FALSE) {
        $i++;
        $val1 = $liste[0];
        $titre = $liste[1];
        $motcles = $liste[2];
        $editeur = $liste[3];
        $collection = $liste[4];
        $valdate = $liste[5];
        $numerocollection = $liste[6];
        $edition = $liste[7];
        $val2 = $liste[8];
        $prix = $liste[9];
        $resume = $liste[10];
        $note = $liste[11];
        $support = $liste[12];
        $avis = $liste[13];
        $image = $liste[14];
        $isbn_issn = str_replace('-', '', $val1);
        $auteur = explode(',', $val2);
        $isbnEditeur = explode('-', $val1);

        $date = explode('/', $valdate);
        $date = array_reverse($date);
        $date = implode('-', $date);
        $date = date("Y-m-d", strtotime($date));
        $date = new DateTime($date);
        $date = $date->format('Y-m-d');


        $editeurExist = $bdd->query('SELECT ID_EDITEUR FROM editeur WHERE NOM = "' . $editeur . '"');
        $ligneResult = $editeurExist->rowCount();

        $isbnExist = $bdd->query('SELECT ISBN_ISSN FROM article WHERE ISBN_ISSN = "' . $isbn_issn . '"');
        $ligneResult2 = $isbnExist->rowCount();


        if (strlen($isbn_issn) == 10) {
            $isbnEditeur = $isbnEditeur[1];
        } else if (strlen($isbn_issn) == 13) {
            $isbnEditeur = $isbnEditeur[2];
        } else if ($isbn_issn == '') {
            $isbn_issn = 0000;
        } else {
            echo '<p style="color:red;"> L\'ISBN que vous essayez de rentrer à la ligne ' . $i . ' est incorrect </p> <br>';
            $flag = 1;
        }


        if ($ligneResult != 1) {
            $bdd->exec('INSERT INTO editeur(id_editeur, nom) 
		            			values(
		            				\'' . strip_tags($isbnEditeur) . '\',
		            				\'' . strip_tags($editeur) . '\')');
            $idEditeur = $isbnEditeur;

        } else {
            $rep = $bdd->query('SELECT ID_EDITEUR FROM editeur WHERE NOM = "' . $editeur . '"');
            $donnees = $rep->fetch();
            $idEditeur = ($donnees['ID_EDITEUR']);
        }

        if ($ligneResult2 == 1) {
            echo '<p style="color:red;"> L\'ISBN que vous essayez de rentrer à la ligne ' . $i . ' existe déjà</p> <br> ';
            $flag = 1;
        }
        if (($isbnEditeur != $idEditeur) && ($isbn_issn != 0000) && ($isbn_issn[0] != 2)) {
            echo '<p style="color:red;"> L\'ISBN entré ne correspond pas à l\'éditeur à la ligne ' . $i . ' </p> <br>';
            $flag = 1;
        }

        if ($isbn_issn[10] == X) {
            $isbn_iss[10] = 1;
            $isbn_iss[11] = 0;
        }


        for ($iter = 0; $iter < sizeof($auteur); $iter++) {
            $unauteur = explode('$', $auteur[$iter]);
            $aut = $bdd->query('SELECT ID_AUTEUR FROM auteur WHERE NOM_AUTEUR = "' . $unauteur[0] . '" AND PRENOM_AUTEUR = "' . $unauteur[1] . '"');
            $ligneResult3 = $aut->rowCount();

            if ($ligneResult3 == 1) {
                $ida = $aut->fetch();
                $idauteur[$iter] = $ida['ID_AUTEUR'];
            }


            if ($ligneResult3 != 1) {
                $idaut = $bdd->query('SELECT max(ID_AUTEUR) as id FROM auteur');
                $maxid = $idaut->fetch();
                $aut_total = $bdd->query('SELECT * FROM auteur');
                $result = $aut_total->rowCount();

                if ($result == 0) {
                    $idauteur[$iter] = 0;
                } else {
                    $idauteur[$iter] = $maxid['id'] + 1;
                }

                $bdd->exec('INSERT INTO auteur(id_auteur, nom_auteur, prenom_auteur) 
		            			values(
		            				\'' . strip_tags($idauteur[$iter]) . '\',
		            				\'' . strip_tags($unauteur[0]) . '\',
		            				\'' . strip_tags($unauteur[1]) . '\')');
            }

        }


        echo "1";
        if ($flag != 1) {
            $bdd->exec('INSERT INTO article(ISBN_ISSN, ID_EDITEUR, TITRE, MOTCLES, NOM_EDITEUR, COLLECTION, DATE_PARUTION, NUMERO_COLLECTION, EDITION, PRIX, RESUME, NOTE_GERANT, COUVERTURE, SUPPORT ) 
	                        VALUES(
	                        	\'' . safe($isbn_issn) . '\', 
	                        	\'' . safe($idEditeur) . '\', 
	                        	\'' . safe($titre) . '\', 
	                        	\'' . safe($motcles) . '\', 
	                        	\'' . safe($editeur) . '\', 
	                        	\'' . safe($collection) . '\', 
	                        	\'' . safe($date) . '\', 
	                        	\'' . safe($numerocollection) . '\', 
	                        	\'' . safe($edition) . '\', 
	                        	\'' . safe(str_replace(',', '.', $prix)) . '\', 
	                        	\'' . safe($resume) . '\', 
	                        	\'' . safe($note) . '\', 
	                        	\'' . safe($image) . '\', 
	                        	\'' . safe($support) . '\')');

            for ($iter = 0; $iter < sizeof($idauteur); $iter++) {
                $bdd->exec('INSERT INTO ecrire(ID_AUTEUR, ISBN_ISSN)
	    								VALUES( 
	    									\'' . safe($idauteur[$iter]) . '\', 
	    									\'' . safe($isbn_issn) . '\')');
            }

            echo '<p style="color:green;"> La ligne ' . $i . ' a correctement été ajouté à la base</p> <br> ';
        }
        unset($idauteur);

    }
    fclose($fp);
    echo "Ajout dans la base de données effectué avec succès";

}
function safe($var)
{
    $var = addslashes($var);
    $var = trim($var);
    $var = htmlspecialchars($var);
    return $var;
}

?>