<html>
<link rel="icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="Style.css"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';

$auteurs = $bdd->query('SELECT NOM_AUTEUR, PRENOM_AUTEUR, ID_AUTEUR FROM auteur');
$editeurs = $bdd->query('SELECT NOM_EDITEUR, ID_EDITEUR FROM compte_fournisseur');
?>
<style>
    #gauche {
        float: left;
        width: 60%;
    }

    #droite {
        margin-left: 60%;
    }

    .btn-default {
        width: 150px;
    }
</style>

<br/><br/>
<br/><br/>
<form class="form-group" method="post">
    <fieldset>
        <div>
            <div id="gauche" class="form-group">

                <div class="form-group">
                    <label class="col-md-2 control-label" for="ISBN">ISBN:</label>
                    <input required type="text" name="isbn" placeholder="ISBN"
                           pattern="(?:(?=.{17}$)97[89][ -](?:[0-9]+[ -]){2}[0-9]+[ -][0-9]|97[89][0-9]{10}|(?=.{13}$)(?:[0-9]+[ -]){2}[0-9]+[ -][0-9Xx]|[0-9]{9}[0-9Xx])"/><br/>
                    <br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Titre">Titre:</label>
                    <input required type="text" name="titre" placeholder="Titre" pattern="/^[\p{L}-. ]*$/u"/><br/><br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Quantité en stock">Quantité en stock:</label>
                    <input required type="text" name="quantiteStock" placeholder="Quantité" pattern="[1-9][0-9]{0,10}"/><br/><br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Editeur">Editeur:</label>
                    <input required name="editeur" placeholder="Editeur" type="text" pattern="/^[\p{L}-. ]*$/u"
                           list="editeur" autocomplete="off"/><br/><br/>
                    <datalist id="editeur">

                        <?php while ($post = $editeurs->fetch()) {
                            echo "<option label='" . $post['ID_EDITEUR'] . "'value='" . $post['NOM_EDITEUR'] . "' >" . $post['NOM_EDITEUR'] . "</option> ";
                        } ?>
                    </datalist>
                    <br/><br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Collection">Collection:</label>
                    <input type="text" name="collection" placeholder="Collection" pattern="/^[\p{L}-. ]*$/u"/><br/><br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Date de parution">Date de parution:</label>
                    <input required type="date" name="dateParution"/><br/><br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Numero de collection">Numéro de collection:</label>
                    <input type="text" name="numeroCollection" placeholder="N°collection"
                           pattern="[0-9]{0,10}"/><br/><br/>
                </div>
								<div>
                <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Image de couverture :</label>

                <input name="fichier" type="file" id="fichier_a_uploader"/>
				</div>
				<br/>

            </div>

            <div id="droite" class="form-group">

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Edition">Édition:</label>
                    <input type="text" name="edition" placeholder="Edition" pattern="[a-Z]"/><br/><br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Auteur">Nom de l'auteur:</label>
                    <input required name="auteur" placeholder="Nom auteur" type="text" list="auteur"
                           autocomplete="off"/><br/><br/>
                    <datalist id="auteur">
                        <?php while ($post = $auteurs->fetch()) {
                            echo "<option id='auteur' label='' value='" . $post['NOM_AUTEUR'] . " " . $post['PRENOM_AUTEUR'] . " ' ></option> ";
                        } ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Prix">Prix:</label>
                    <input type="text" name="prix" placeholder="Prix" pattern="[0-9]{1,}[.,]{0,1}[0-9]{0,2}"/>
                    <br/><br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Resume">Résumé:</label>
                    <textarea name="resume" placeholder="Résumé" rows="8" cols="45"></textarea><br/><br/>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="Note du gérant">Note du gérant:</label>
                    <input type="text" name="noteGerant" placeholder="Note" pattern="[a-Z]"/><br/><br/>
                </div>

			
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Support">Support:</label>
                    <select name="support">
                        <option value="papier">papier</option>
                        <option value="choix2">numerique</option>
                    </select><br/><br/>
                </div>
            </div>
        </div>
		<br/>		<br/>
        <p align="center"><input class="btn btn-default" type="submit" name="valider" value="Valider"/></p>
    </fieldset>
    <br/><br/>
</form>
</html>

<?php
if (isset($_POST['valider'])) {


    $isbn_issn = str_replace('-', '', $_POST['isbn']);

    $editeur = $_POST['editeur'];

    $editeurExist = $bdd->query('SELECT ID_EDITEUR FROM editeur WHERE NOM = "' . $editeur . '"');
    $ligneResult = $editeurExist->rowCount();

    $isbnExist = $bdd->query('SELECT ISBN_ISSN FROM article WHERE ISBN_ISSN = "' . $isbn_issn . '"');
    $ligneResult2 = $isbnExist->rowCount();


    $auteur = explode(' ', $_POST['auteur']);
    $aut = $bdd->query('SELECT ID_AUTEUR FROM auteur WHERE NOM_AUTEUR = "' . $auteur[0] . '" AND PRENOM_AUTEUR = "' . $auteur[1] . '"');
    $ida = $aut->fetch();
    $idauteur = $ida['ID_AUTEUR'];
    $isbnEditeur = explode('-', $_POST['isbn']);

    if (strlen($isbn_issn) == 10) {
        $isbnEditeur = $isbnEditeur[1];
    } else $isbnEditeur = $isbnEditeur[2];


    $rep = $bdd->query('SELECT ID_EDITEUR AS id FROM editeur WHERE NOM = "' . $editeur . '"');
    $donnees = $rep->fetch();

    $idEditeur = ($donnees['id']);

    if ($ligneResult != 1) {

        echo 'L\'éditeur n\'existe pas, créez le d\'abord';

    } else if ($ligneResult2 == 1) {
        echo 'L\'ISBN que vous essayez de rentrer existe déjà';
    } else if ($isbnEditeur != $idEditeur) {


        echo 'L\'ISBN entré ne correspond pas à l\'éditeur';

    } else {


        $bdd->exec('INSERT INTO article(ISBN_ISSN, ID_EDITEUR, TITRE, QUANTITE_STOCK, NOM_EDITEUR, COLLECTION, DATE_PARUTION, NUMERO_COLLECTION, EDITION, PRIX, RESUME, NOTE_GERANT, SUPPORT ) 
						VALUES(\'' . strip_tags(strtoupper(str_replace('-', '', $_POST['isbn']))) . '\',
							\'' . strip_tags($donnees['id']) . '\',
							\'' . strip_tags($_POST['titre']) . '\',
							\'' . strip_tags($_POST['quantiteStock']) . '\',
							\'' . strip_tags($editeur) . '\',
							\'' . strip_tags($_POST['collection']) . '\',
							\'' . strip_tags($_POST['dateParution']) . '\',
							\'' . strip_tags($_POST['numeroCollection']) . '\',
							\'' . strip_tags($_POST['edition']) . '\',
							\'' . strip_tags(str_replace(',', '.', $_POST['prix'])) . '\',
							\'' . strip_tags($_POST['resume']) . '\',
							\'' . strip_tags($_POST['noteGerant']) . '\',
							\'' . strip_tags($_POST['support']) . '\'
							)');

        $bdd->exec('INSERT INTO ecrire(ID_AUTEUR, ISBN_ISSN) 
						VALUES( \'' . strip_tags($idauteur) . '\',
	 						\'' . strip_tags(strtoupper(str_replace('-', '', $_POST['isbn']))) . '\'
	 						)');
        echo 'L\'article a bien été ajouté !';

		
		
		
		/************************************************************
	 * Script realise par Emacs
	 * Crée le 19/12/2004
	 * Maj : 23/06/2008
	 * Licence GNU / GPL
	 * webmaster@apprendre-php.com
	 * http://www.apprendre-php.com
	 * http://www.hugohamon.com
	 *
	 * Changelog:
	 *
	 * 2008-06-24 : suppression d'une boucle foreach() inutile
	 * qui posait problème. Merci à Clément Robert pour ce bug.
	 *
	 *************************************************************/

	/************************************************************
	 * Definition des constantes / tableaux et variables
	 *************************************************************/

	// Constantes

	define('TARGET', "couverture\\");    // Repertoire cible
	define('MAX_SIZE', 100000);    // Taille max en octets du fichier
	define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
	define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels

	// Tableaux de donnees
	$tabExt = array('jpg');    // Extensions autorisees
	$infosImg = array();

	// Variables
	$extension = '';
	$message = '';
	$nomImage = '';

	/************************************************************
	 * Creation du repertoire cible si inexistant
	 *************************************************************/
	if (!is_dir(TARGET)) {
		if (!mkdir(TARGET)) {
			exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
		}
	}

	/************************************************************
	 * Script d'upload
	 *************************************************************/
	if (!empty($_POST))
		//var_dump ($_POST);
		//var_dump ($_FILES['fichier']['tmp_name']);
	{
		// On verifie si le champ est rempli
		if (!empty($_FILES['fichier']['name'])) {
			// Recuperation de l'extension du fichier
			$extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

			// On verifie l'extension du fichier
			if (in_array(strtolower($extension), $tabExt)) {
				// On recupere les dimensions du fichier
				$infosImg = getimagesize($_FILES['fichier']['tmp_name']);

				// On verifie le type de l'image
				if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
					// On verifie les dimensions et taille de l'image
					if (($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {
						// Parcours du tableau d'erreurs
						if (isset($_FILES['fichier']['error'])
							&& UPLOAD_ERR_OK === $_FILES['fichier']['error']
						) {
							// On renomme le fichier


							// Si c'est OK, on teste l'upload
							if (move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $_FILES['fichier']['name'])) {
								$message = 'Upload réussi !';
							} else {
								echo '7';
								// Sinon on affiche une erreur systeme
								$message = 'Problème lors de l\'upload !';
							}
							if (rename(TARGET.$_FILES['fichier']['name'], TARGET.$isbn.".jpg")) {
								$message = 'renommage réussi !';
							} else {
								echo $_FILES['fichier']['name'];           
								echo $isbn;
								// Sinon on affiche une erreur systeme
								$message = 'Problème lors du renommage !';
							}
						} else {
							$message = 'Une erreur interne a empêché l\'uplaod de l\'image';
						}
					} else {
						// Sinon erreur sur les dimensions et taille de l'image
						$message = 'Erreur dans les dimensions de l\'image !';
					}
				} else {
					// Sinon erreur sur le type de l'image
					$message = 'Le fichier à uploader n\'est pas une image !';
				}
			} else {
				// Sinon on affiche une erreur pour l'extension
				$message = 'L\'extension du fichier est incorrecte !';
			}
		} else {
			// Sinon on affiche une erreur pour le champ vide
			$message = 'Veuillez remplir le formulaire svp !';
		}
	}
		
		
		
		
		
		
		
		
		
		
    }
}
?>