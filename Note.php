<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
require_once 'menu.php';
?>

<html>

	
<br/><br/>
<br/><br/>

<body>
<center>

   <input type="text" name="note" placeholder="Entrez le text que vous souhaitez">
   
</center>
   </body>