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
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="script_compte_pro.js"></script>
</head>
<body>
<br/><br/><br/>
<center>
    <form method="post">
        <?php
            $sql = "select NOM, PRENOM, NUMERO_COMMANDE, NUMERO_COMPTE, DATE_COMMANDE, ETAT_COMMANDE from commande join client using (NUMERO_COMPTE) where ETAT_COMMANDE = \"EN ATTENTE DE VALIDATION\" ";
            $tab = AfficherTabCompte($sql, $bdd);

            function AfficherTabCompte($sql, $bdd)
            {
                $tab = $bdd->query($sql, PDO::FETCH_ASSOC);
                echo '<table border="1">';
                echo '<h1>Commandes en attentes :</h1>';
                echo '<tr> <td>NOM</td> <td>PRENOM</td><td>NUMERO_COMPTE</td> <td>NUMERO_COMMANDE</td> <td>DATE_COMMANDE</td><td>ETAT_COMMANDE</td><td>VALIDE</td><td>REFUSE</td></tr>';
                foreach ($tab as $utilisateur) {
                $numcom=$utilisateur['NUMERO_COMMANDE'];
                    echo "<tr>
                  <td>", $utilisateur['NOM'], "</td>
                  <td>", $utilisateur['PRENOM'], "</td>
                  <td>", $utilisateur['NUMERO_COMPTE'], "</td>
                  <td>", $utilisateur['NUMERO_COMMANDE'],"
                  <input class=\"btn btn-default\" type=\"button\" name=\"Accueil\" value=\"Voir\" onclick=\"self.location.href = 'voir_commande.php?num=$numcom'\"/>
</td>
                  <td>", $utilisateur['DATE_COMMANDE'], "</td>
                  <td>", $utilisateur['ETAT_COMMANDE'], "</td>
                  <td><input class='btn btn-default' type='submit' name='valider_", $utilisateur['NUMERO_COMMANDE'], "' value='Valider' id='val' onClick=\"getname(this)\"/></td>
				  <td><input class='btn btn-default' type='submit' name='supprimer_", $utilisateur['NUMERO_COMMANDE'], "' value='Refusé' id='suppr' onClick=\"getname(this)\"/></td>
                </tr>";
                }
                echo '</table>';
            }

            ?>

            <?php

            if (isset($_POST['valider'])) :

            endif;
            if (isset($_POST['supprimer'])) :

                echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
            endif;
            echo "<br/>";
            ?>


            <input type="checkbox" name="hidd" id="hid" value="" hidden>
            <?php
            if (isset($_POST['hidd'])) {
                $explode = explode("_", $_POST['hidd']);
                $id_user = $explode[1];
                echo $id_user;
                if ($explode[0] == "valider") {
                    $sql = "UPDATE commande set ETAT_COMMANDE = \"VALIDE\" where NUMERO_COMMANDE=" . $id_user;
                    $bdd->exec($sql);
                    echo "<meta http-equiv='refresh' content='0; url='" . $_SERVER['PHP_SELF'] . "'>";
                } else if ($explode[0] == "supprimer") {
                    $sql1 = "UPDATE commande set ETAT_COMMANDE = \"REFUSE\" where NUMERO_COMMANDE=" . $id_user;
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