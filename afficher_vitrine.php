<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Articles dans la vitrine"; //Titre à changer sur chaque page
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
        <h2>Gestion des articles de la Vitrine </h2>
        <a class="close" href="#">×</a>
        <div class="content">
            Ici, c'est la page de gestion de la vitrine. Vous pouvez donc supprimer les images du caroussel qui est à l'accueil.
        </div>
    </div>
</div>
<center>
    <form method="post">
        <?php
        $sql = "select ISBN_ISSN, NUM , TITRE ,NOM_EDITEUR from vitrine join article using (ISBN_ISSN) ";
        $tab = AfficherTabCompte($sql, $bdd);

        function AfficherTabCompte($sql, $bdd){


            $tab = $bdd->query($sql,PDO::FETCH_ASSOC);
            echo '<table border="1">';
            echo '<h1>Articles actuellement dans la vitrine :</h1>';
            echo '<tr> <td> ISBN_ISSN</td><td>NUM</td><td>TITRE</td><td>NOM_EDITEUR</td><td>SUPPRIMER</td></tr>';
            foreach($tab as $utilisateur){

                echo "<tr>
                  <td>",$utilisateur['ISBN_ISSN'],"</td>
                  <td>",$utilisateur['NUM'],"</td>
                  <td>",$utilisateur['TITRE'],"</td>
                  <td>",$utilisateur['NOM_EDITEUR'],"</td>
				  <td><input class='btn btn-default' type='submit' name='supprimer_",$utilisateur['NUM'],"' value='Supprimer' id='suppr' onClick=\"getname(this)\"/></td>
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
                $sql1 = "DELETE FROM vitrine WHERE NUM=".$id_user;
                $bdd->exec($sql1);
                echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
                echo "supprimer";
            }
        }
        ?>
    </form>
    <br><br>
    <a class="btn btn-primary" href="index.php">Retour à l'accueil</a><br><br>

</center>
</body>
</html>