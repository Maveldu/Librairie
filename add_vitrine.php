<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Ajout Vitrine"; //Titre ‡ changer sur chaque page
require_once 'menu.php';

$isbn = str_replace('-', '', $_POST['vitrineadd']);
$num = $bdd->query('SELECT NUM from vitrine');
$count = $num->rowCount();
$count = $count + 1;
//echo $isbn;
$bdd->exec('INSERT INTO vitrine(ISBN_ISSN, NUM) VALUES(\'' . $isbn . '\'  ,    \'' . $count . '\'             );');

?>
<html>
<link rel="icon" type="image/png" href="favicon.png"/>
<br><br><br><br><br><center>
    <p>Le Livre a bien été ajouté à la vitrine.</p><br><br>
    <a class="btn btn-primary" href="form_afficher_article.php">Retour aux articles</a>
    <input class="btn btn-default" type="button" name="Accueil" value="Accueil" onclick="self.location.href='index.php'">
</center><
</html>
