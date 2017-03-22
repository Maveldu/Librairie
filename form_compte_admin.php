<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Gestion gérants"; //Titre à changer sur chaque page
require_once 'menu.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="script_compte_pro.js"></script>
</head>
<body>
<br/><br/><br/>

<div class="box">
    <a class="button" href="#popup1"> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>
</div>
<div id="popup1" class="overlay">
    <div class="popup">
        <h2>Gestion comptes Gérants </h2>
        <a class="close" href="#">×</a>
        <div class="content">
            Ici, c'est la page de gestion des comptes Gérants. Vous pouvez donc supprimer n'importe quel gérant.
        </div>
    </div>
</div>
<center>
    <form method="post">
        <?php
        $sql = "select IDENTIFIANT, NUMERO_COMPTE from compte join compte_gerant using (NUMERO_COMPTE)";
        $tab = AfficherTabCompte($sql, $bdd);

             function AfficherTabCompte($sql, $bdd){


            $tab = $bdd->query($sql,PDO::FETCH_ASSOC);
            echo '<table border="1">';
            echo '<h1>Comptes en attente :</h1>';
            echo '<tr> <td> NUMERO COMPTE</td><td>IDENTIFIANT</td><td>SUPPRIMER</td></tr>';
            foreach($tab as $utilisateur){

                echo "<tr>
                  <td>",$utilisateur['NUMERO_COMPTE'],"</td>
                  <td>",$utilisateur['IDENTIFIANT'],"</td>
				  <td><input class='btn btn-default' type='submit' name='supprimer_",$utilisateur['NUMERO_COMPTE'],"' value='Supprimer' id='suppr' onClick=\"getname(this)\"/></td>
                </tr>";
            }
            echo '</table>';
        }
        ?>

        <input type="checkbox" name="hidd" id="hid" value="" hidden>
        <?php
        if(isset($_POST['hidd'])){
            $explode = explode("_",$_POST['hidd']);
            $id_user = $explode[1];
            echo $id_user;
             if($explode[0] == "supprimer"){
                $sql1 = "DELETE FROM compte_gerant WHERE NUMERO_COMPTE=".$id_user;
                $bdd->exec($sql1);
                echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
                echo "supprimer";
            }
        }
        ?>
    </form>
    <br><br>
    <a class="btn btn-primary" href="gestion_compte.php">Retour au menu "Gestion des Comptes"</a><br><br>

</center>
</body>
</html>