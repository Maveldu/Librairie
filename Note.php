<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
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
<form>
<center>
	<textarea name="note" id="note" cols="100" rows="17" placeholder="Entrez le text que vous souhaitez">
</textarea>
   <br>
   <br>
   <br>
   <input class="btn btn-default" type="button" name="sauvegarder" value="Sauvegarder"/>
   </form>
 
</center>
   </body>

   <?php
   if (isset($_POST['sauvegarder'])) :
   $bdd->exec('INSERT INTO note (TEXTE) VALUES(
					 \'' . strip_tags($_POST['note']) . '\'
					 )');
    echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
endif;
?>
