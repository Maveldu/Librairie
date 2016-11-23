<?php

require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page



/*if(!isset($_POST['recherche_titre']))
{
    $_POST['recherche_titre']='';




}*/

if(!isset($_POST['recherche_titre']))
{

    $_POST['recherche_titre']='';

    $reponse = $bdd->query('SELECT * FROM article where TITRE like "%"'); //"%$_POST[recherche_titre]%"


    while ($donnees = $reponse->fetch())
    {
        ?>
            <p>
                <strong>Article</strong> : <?php echo $donnees['ISBN_ISSN']; ?><br />
                Titre : <?php echo $donnees['TITRE']; ?><br />
            </p>
        <?php
    }

    $reponse->closeCursor(); 

    ?>

    <form action="afficher_article.php" method="post">
        <p>
            Rechercher un titre: <input type="text" name="recherche_titre" /><input type="submit" value="Valider" />
        </p>
    </form>

<?php
}



else
{
    $recherche_titre=($_POST['recherche_titre']);
    $reponse = $bdd->query("SELECT * FROM article where TITRE like '$recherche_titre%'"); 


    while ($donnees = $reponse->fetch())
    {
        ?>
            <p>
                <strong>Article</strong> : <?php echo $donnees['ISBN']; ?><br />
                Titre : <?php echo $donnees['TITRE']; ?><br />
            </p>
        <?php
    }

    $reponse->closeCursor(); 

    ?>

    <form action="afficher_article.php" method="post">
        <p>
            Rechercher un titre: <input type="text" name="recherche_titre" /><input type="submit" value="Valider" />
        </p>
    </form>

<?php
}
?>

<a href="http://localhost/librairie/menu.php">Retour au menu</a>

