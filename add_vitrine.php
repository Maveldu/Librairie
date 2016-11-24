<?php

require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page


$isbn = str_replace('-', '', $_POST['vitrineadd']);
$num = $bdd->query('SELECT NUM from vitrine');
$count = $num->rowCount();
$count = $count + 1;
//echo $isbn;
$bdd->exec('INSERT INTO vitrine(ISBN_ISSN, NUM) VALUES(\'' . $isbn . '\'  ,    \'' . $count . '\'             );');
echo "Votre Photo a bien été ajouté à la vitrine."
?>
<html>
<input class="btn btn-default" type="button" name="Accueil" value="Accueil" onclick="self.location.href='index.php'">
</html>
