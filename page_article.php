<?php
session_start();
require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';

$isbn=$_POST['isbn'];
?>
<br/><br/>
<br/><br/>
<?php



$result = $bdd->query( 'SELECT TITRE , COUVERTURE , DATE_PARUTION , RESUME, ISBN_ISSN, QUANTITE_STOCK, PRIX, NOM_EDITEUR, COLLECTION, NUMERO_COLLECTION, SUPPORT, NOTE_GERANT, MOTCLES
                             FROM article
                             WHERE  ISBN_ISSN LIKE '.$isbn.'');

$post = $result->fetch() ;
        $titre = $post['TITRE'];

        $isbn = $post['ISBN_ISSN'];

        $imgname = './couverture/'.$isbn.'.jpg';

        if (file_exists($imgname)) {
          $img = $isbn.".jpg";
        } 
        else {
           $img = "sans-image.jpg";
        }


?>
<?php echo '<img src="./couverture/'.$img.'" style="width:400px;height:400px;padding:0px;border:1px;"/>'; ?>
<?php echo '<h1 style="">'.$titre.'</h1>';?>
<?php
echo "Date parution : ";
echo($post['DATE_PARUTION']);
echo "<br/>";
echo "N°ISBN_ISSN : ";
echo($post['ISBN_ISSN']);
echo "<br/>";
echo "Résumé : ";
echo($post['RESUME']);
echo "<br/>";
echo "Quantité : ";
echo($post['QUANTITE_STOCK']);
echo "<br/>";
echo "Prix : ";
echo($post['PRIX']);
echo "<br/>";
echo "Nom éditeur : ";
echo($post['NOM_EDITEUR']);
echo "<br/>";
echo "N° Collection : ";
echo($post['NUMERO_COLLECTION']);
echo "<br/>";
echo "Collection : ";
echo($post['COLLECTION']);
echo "<br/>";
echo "Support : ";
echo($post['SUPPORT']);
echo "<br/>";
echo "Note gérant: ";
echo($post['NOTE_GERANT']);
echo "<br/>";
echo "Mot clés ";
echo($post['MOTCLES']);
echo "<br/>";
?>


