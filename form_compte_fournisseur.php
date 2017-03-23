<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Gestion Fournisseurs"; //Titre à changer sur chaque page
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
    <a class="button" href="#popup1"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>
</div>
<div id="popup1" class="overlay">
    <div class="popup">
        <h2>Gestion compte fournisseur </h2>
        <a class="close" href="#">×</a>
        <div class="content">
            Ici, c'est la page de validation des comptes "Fournisseur". En validant, le compte fournisseur sera actif.
        </div>
    </div>
</div>
<center>
    <form method="post">
        <?php
        $sql = "select IDENTIFIANT, NUMERO_COMPTE, ADRESSE, CODE_POSTALE, VILLE , ID_EDITEUR from compte join compte_fournisseur using (NUMERO_COMPTE) where VALIDE = 0 ";
        $tab = AfficherTabCompte($sql, $bdd);

        function AfficherTabCompte($sql, $bdd){


            $tab = $bdd->query($sql,PDO::FETCH_ASSOC);
            echo '<table border="1">';
            echo '<h1>Comptse en attente :</h1>';
            echo '<tr> <td> IDENTIFIANT</td> <td> NUMERO_COMPTE</td> <td> ADRESSE</td><td>CODE_POSTAL</td><td>VILLE</td><td>ID_EDITEUR</td><td>VALIDER</td><td>SUPPRIMER</td></tr>';
            foreach($tab as $utilisateur){

                echo "<tr>
                  <td>",$utilisateur['IDENTIFIANT'],"</td>
                  <td>",$utilisateur['NUMERO_COMPTE'],"</td>
                  <td>",$utilisateur['ADRESSE'],"</td>
                  <td>",$utilisateur['CODE_POSTALE'],"</td>
                  <td>",$utilisateur['VILLE'],"</td>
                  <td>",$utilisateur['ID_EDITEUR'],"</td>
                  <td><input class='btn btn-default' type='submit' name='valider_",$utilisateur['NUMERO_COMPTE'],"' value='Valider' id='val' onClick=\"getname(this)\"/></td>
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
            if($explode[0] == "valider"){
                $sql = "UPDATE compte_fournisseur set VALIDE = 1 where NUMERO_COMPTE=".$id_user;
                $bdd->exec($sql);
                echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
            }
            else if($explode[0] == "supprimer"){
                $sql1 = "DELETE FROM compte_fournisseur WHERE NUMERO_COMPTE=".$id_user;
                $bdd->exec($sql1);
                echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
                echo "supprimer";
            }
        }
        ?>
    </form>
    <br><br>

    <form method="post">
        <?php
        $sq2 = "select IDENTIFIANT, NUMERO_COMPTE, ADRESSE, CODE_POSTALE, VILLE , ID_EDITEUR, VALIDE from compte join compte_fournisseur using (NUMERO_COMPTE) where VALIDE = 1 ";
        $tab = AfficherTabCompte2($sq2, $bdd);

        function AfficherTabCompte2($sq2, $bdd){


            $tab = $bdd->query($sq2,PDO::FETCH_ASSOC);
            echo '<table border="1">';
            echo'<h1> Comptes validés : <h1>';
            echo '<tr> <td> IDENTIFIANT</td> <td> NUMERO_COMPTE</td> <td> ADRESSE</td><td>CODE_POSTAL</td><td>VILLE</td><td>ID_EDITEUR</td><td>VALIDE</td><td>ANNULER</td></tr>';
            foreach($tab as $utilisateur){

                echo "<tr>
                  <td>",$utilisateur['IDENTIFIANT'],"</td>
                  <td>",$utilisateur['NUMERO_COMPTE'],"</td>
                  <td>",$utilisateur['ADRESSE'],"</td>
                  <td>",$utilisateur['CODE_POSTALE'],"</td>
                  <td>",$utilisateur['VILLE'],"</td>
                  <td>",$utilisateur['ID_EDITEUR'],"</td>
				  <td>",$utilisateur['VALIDE'],"</td>
				  <td><input class='btn btn-default' type='submit' name='attente_",$utilisateur['NUMERO_COMPTE'],"' value='Annuler' id='val' onClick=\"getname2(this)\"/></td>
                </tr>";
            }
            echo '</table>';
        }
        ?>

        <input type="checkbox" name="hidde" id="hide" value="" hidden>
        <?php
        if(isset($_POST['hidde'])){
            $explode = explode("_",$_POST['hidde']);
            $id_user = $explode[1];
            echo $id_user;
            if($explode[0] == "attente"){
                $sq2 = "UPDATE compte_fournisseur set VALIDE = 0 where NUMERO_COMPTE=".$id_user;
                $bdd->exec($sq2);
                echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
            }
        }
        ?>
    </form>
    <br><br>
    <a class="btn btn-primary" href="gestion_compte.php">Retour au menu "Gestion des Comptes"</a><br><br>
</center>
</body>
</html>