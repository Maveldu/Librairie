<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8"/>
    <title>Ajout d'un fichier csv</title>
</head>

<?php

require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page
$i = 0;
$fichier = $_FILES['fichier']['name'];


if (is_file($fichier)) {
    $fp = fopen("$fichier", "r");
} else { // fichier inconnu
    echo "Fichier introuvable !<br>Importation stoppe."; ?>
    <br/><br/> <a href="menu.php" class="bouton">Retour au menu</a><br/><br/>
    <?php
    exit();
}
$req = $bdd->prepare('INSERT INTO article(ISBN_ISSN, ID_EDITEUR, TITRE, QUANTITE_STOCK, NOM_EDITEUR, COLLECTION, DATE_PARUTION, NUMERO_COLLECTION, EDITION, PRIX, RESUME, NOTE_GERANT, SUPPORT ) 
                        VALUES(:isbn, :idEditeur, :titre, :quantiteStock, :editeur, :collection, :dateParution, :numeroCollection, :edition, :prix, :resume, :noteGerant, :support)');
$reqa = $bdd->prepare('INSERT INTO ecrire(ID_AUTEUR, ISBN_ISSN) VALUES( :idauteur, :isbn)');

$count = count(file($fichier));
$liste = fgetcsv($fp, 1000, ';');
while (($liste = fgetcsv($fp, 1000, ';')) !== FALSE) {

    $i++;
    $val1 = $liste[0];
    $titre = $liste[1];
    $quantitestock = $liste[2];
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
    $isbn_issn = str_replace('-', '', $val1);
    $auteur = explode('-', $val2);
    $isbnEditeur = explode('-', $val1);

    $date = explode('/', $valdate);
    $date = array_reverse($date);
    $date = implode('-', $date);
    $date = date("Y-m-d", strtotime($date));
    $date = new DateTime($date);
    $date = $date->format('Y-m-d');

    $aut = $bdd->query('SELECT ID_AUTEUR FROM auteur WHERE NOM_AUTEUR = "' . $auteur[0] . '" AND PRENOM_AUTEUR = "' . $auteur[1] . '"');
    $ida = $aut->fetch();
    $idauteur = $ida['ID_AUTEUR'];


    $editeurExist = $bdd->query('SELECT ID_EDITEUR FROM editeur WHERE NOM = "' . $editeur . '"');
    $ligneResult = $editeurExist->rowCount();

    $isbnExist = $bdd->query('SELECT ISBN_ISSN FROM article WHERE ISBN_ISSN = "' . $isbn_issn . '"');
    $ligneResult2 = $isbnExist->rowCount();


    if (strlen($isbn_issn) == 10) {
        $isbnEditeur = $isbnEditeur[1];
    } else if (strlen($isbn_issn) == 13) {
        $isbnEditeur = $isbnEditeur[2];
    } else {
        echo 'var:' . $titre;
        echo 'L\'ISBN que vous essayez de rentrer à la ligne ' . $i . ' est incorrect, les lignes précèdentes ont été correctement rentrées';
        break;
    }

    $rep = $bdd->query('SELECT ID_EDITEUR AS id FROM editeur WHERE NOM = "' . $editeur . '"');
    $donnees = $rep->fetch();
    $idEditeur = ($donnees['id']);

    if ($ligneResult != 1) {
        echo 'L\'éditeur n\'existe pas ou est incorrect à la ligne ' . $i . ', les lignes précèdentes ont été correctement rentrées';
        include('form_ajouter_editeur.php');
        break;
    } else if ($ligneResult2 == 1) {
        echo 'L\'ISBN que vous essayez de rentrer à la ligne ' . $i . ' existe déjà, les lignes précèdentes ont été correctement rentrées';
        break;
    } else if ($isbnEditeur != $idEditeur) {
        echo 'L\'ISBN entré ne correspond pas à l\'éditeur à la ligne ' . $i . ', les lignes précèdentes ont été correctement rentrées';
        break;
    } else if (is_null($idauteur)) {
        echo 'L\'auteur n\'existe pas ou est incorrect à la ligne' . $i . ', les lignes précèdentes ont été correctement rentrées';
        break;
    } else {
        $req->execute(array(
            'isbn' => strip_tags($isbn_issn),
            'idEditeur' => strip_tags($idEditeur),
            'titre' => strip_tags($titre),
            'quantiteStock' => strip_tags($quantitestock),
            'editeur' => strip_tags($editeur),
            'collection' => strip_tags($collection),
            'dateParution' => strip_tags($date),
            'numeroCollection' => strip_tags($numerocollection),
            'edition' => strip_tags($edition),
            'prix' => strip_tags(str_replace(',', '.', $prix)),
            'resume' => strip_tags($resume),
            'noteGerant' => strip_tags($note),
            'support' => strip_tags($support)
        ));
        $reqa->execute(array(
            'idauteur' => strip_tags($idauteur),
            'isbn' => strip_tags($isbn_issn)
        ));
    }


}
fclose($fp);


if ($i == $count) {
    echo "Ajout dans la base de données effectué avec succès"; ?>
    <a href="menu.php" class="bouton">Retour au menu</a><br/><br/> <?php
} else {
    echo "Echec dans l'ajout dans la base de données"; ?>
    <a href="menu.php" class="bouton">Retour au menu</a><br/><br/><?php
}
?>
</html>

