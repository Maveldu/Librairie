<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Photo vitrine"; //Titre à changer sur chaque page
require_once 'menu.php';
?>

    <br/><br/>
    <br/><br/>
    <body>

    <!-- Debut du formulaire -->
    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset>
            <legend>Formulaire</legend>
            <div>
                <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Envoyer le fichier :</label>

                <input name="fichier" type="file" id="fichier_a_uploader"/>
                <input type="submit" name="submit" value="Uploader"/>
            </div>
			<div class="form-group">
				<label class="col-md-2 control-label" for="ISBN">ISBN :</label>
				<input required type="text" name="isbn" placeholder="ISBN"/><br/>
				<br/>
			</div>
        </fieldset>
    </form>
    <!-- Fin du formulaire -->
    </body>
    </html>

<?php

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
$tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
$infosImg = array();

// Variables
$extension = '';
$message = '';
$nomImage = '';
$isbn = ''; 
if(isset($_POST['isbn']))
{
	$isbn = $_POST['isbn'];
}
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
echo $message;
?>