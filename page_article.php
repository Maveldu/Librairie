<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';

$isbn = $_POST['isbn'];
?>
<br/><br/>
<?php


$result = $bdd->query('SELECT TITRE , COUVERTURE , DATE_PARUTION , RESUME, ISBN_ISSN, QUANTITE_STOCK, PRIX, NOM_EDITEUR, COLLECTION, NUMERO_COLLECTION, SUPPORT, NOTE_GERANT, MOTCLES
                             FROM article
                             WHERE  ISBN_ISSN LIKE ' . $isbn . '');

$post = $result->fetch();
$titre = $post['TITRE'];

$isbn = $post['ISBN_ISSN'];

$imgname = './couverture/' . $isbn . '.jpg';

if (file_exists($imgname)) {
    $img = $isbn . ".jpg";
} else {
    $img = "sans-image.jpg";
}


?>
<center><table width=90%><td align=center>
<?php echo '<h1 style="">' . $titre . '</h1>'; ?>
<?php echo '<img src="./couverture/' . $img . '" style="width:400px;height:400px;padding:0px;border:1px;"/>'; ?>
</center>
</td>
<td  width=400%>
<center>
<?php
echo '<table border="1" width=60%>';
	echo '<tr> <td align=center> <h5>INFORMATION </h5></td> <td align=center><h5>RESUME</h5></td></tr>';
echo "<tr>";
echo "<td width=35%><b>Date parution : </b>";
echo($post['DATE_PARUTION']);
echo "<br/>";
echo "<b>N°ISBN_ISSN : </b>";
echo($post['ISBN_ISSN']);
echo "<br/>";
echo "<b>Quantité : </b>";
echo($post['QUANTITE_STOCK']);
echo "<br/>";
echo "<b>Prix : </b>";
echo($post['PRIX']);
echo "<br/>";
echo "<b>Nom éditeur : </b>";
echo($post['NOM_EDITEUR']);
echo "<br/>";
echo "<b>N° Collection : </b>";
echo($post['NUMERO_COLLECTION']);
echo "<br/>";
echo "<b>Collection : </b>";
echo($post['COLLECTION']);
echo "<br/>";
echo "<b>Support : </b>";
echo($post['SUPPORT']);
echo "<br/>";
echo "<b>Note gérant: </b>";
echo($post['NOTE_GERANT']);
echo "<br/>";
echo "<b> Mot clés </b>";
echo($post['MOTCLES']);
echo "</td><br/>";
echo "<td><b>Résumé : </b>";
echo($post['RESUME']);
echo "<br/></td></tr>";
echo "<table>";
echo "</center>";
?>
</td>
<br>
<br>


