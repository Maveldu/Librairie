<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie";
require_once 'menu.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="script_compte_pro.js"></script>*
</head>
<body>

<br/><br/><br/>

<div class="box">
    <a class="button" href="#popup1"> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>
</div>
<div id="popup1" class="overlay">
    <div class="popup">
        <h2>Message </h2>
        <a class="close" href="#"></a>
        <div class="content">
            Ici, c'est votre boite de reception de message. Ce sont donc toutes les notes et questions que vous posent les gérants.
        </div>
    </div>
</div>
<center>
    <form method="post">
        <?php
        $sql = "select IDENTIFIANT, NUMERO_COMPTE, TEXT, DATE_NOTE, SUPPR , NUM_NOTE from note join compte using (NUMERO_COMPTE) where SUPPR = 0 ";
        $tab = AfficherTabCompte($sql, $bdd);

        function AfficherTabCompte($sql, $bdd){


            $tab = $bdd->query($sql,PDO::FETCH_ASSOC);
            echo '<table border="1">';
            echo '<h1>Message</h1>';
            echo '<tr> <td> IDENTIFIANT</td> <td> NUMERO_COMPTE</td> <td> DATE D\'ENVOIE</td> <td>MESSAGE</td><td>SUPPRIMER</td></tr>';
            foreach($tab as $utilisateur){

                echo "<tr>
                  <td>",$utilisateur['IDENTIFIANT'],"</td>
                  <td>",$utilisateur['NUMERO_COMPTE'],"</td>
                  <td>",$utilisateur['DATE_NOTE'],"</td>
                  <td width='500px' style='word-wrap: break-word'><p>",$utilisateur['TEXT'],"</></td>
				  <td><input class='btn btn-default' type='submit' name='supprimer_",$utilisateur['NUM_NOTE'],"' value='Supprimer' id='suppr' onClick=\"getname(this)\"/></td>
                </tr>";
            }
            echo '</table>';
        }
        ?>

        <input type="checkbox" name="hidd" id="hid" value="" hidden>
        <?php
        if(isset($_POST['hidd'])){
            $explode = explode("_",$_POST['hidd']);
            $id_note = $explode[1];
            echo $id_note;
            if($explode[0] == "supprimer"){
                $sql1 = "DELETE FROM note WHERE NUM_NOTE=".$id_note;
                $bdd->exec($sql1);
                echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
                echo "supprimer";
            }
        }
        ?>
    </form>
    <br><br>
</center>
</body>
</html>