<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Mon Panier"; //Titre ‡ changer sur chaque page
require_once 'menu.php';



?>