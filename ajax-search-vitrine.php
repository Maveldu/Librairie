<script type="text/javascript" src="\js\jquery-latest.js"></script>


<?php
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page

if (isset($_POST['q'])) {

    if ($_POST['radio'] != "MOTCLES") {

        $result = $bdd->query('SELECT TITRE , COUVERTURE , DATE_PARUTION , RESUME, ISBN_ISSN, QUANTITE_STOCK, PRIX, NOM_EDITEUR, COLLECTION, NUMERO_COLLECTION, SUPPORT, NOTE_GERANT, MOTCLES
                             FROM article join vitrine using (ISBN_ISSN)
                             WHERE  ISBN_ISSN in (select ISBN_ISSN from vitrine) and ' . $_POST['radio'] . ' LIKE \'' . safe($_POST['q']) . '%\'
                            LIMIT 0,20');
    } else {

        $motcle = str_replace(' ', '', $_POST['q']);
        $motcles = explode(',', $motcle);
        $preparation = 'SELECT TITRE , COUVERTURE , DATE_PARUTION , RESUME, ISBN_ISSN, QUANTITE_STOCK, PRIX, NOM_EDITEUR, COLLECTION, NUMERO_COLLECTION, SUPPORT, NOTE_GERANT, MOTCLES
                          FROM article join vitrine using (ISBN_ISSN)
                             WHERE  ISBN_ISSN in (select ISBN_ISSN from vitrine) and  ';

        for ($i = 0; $i < count($motcles); $i++) {
            if ($i + 1 == count($motcles)) {
                $preparation = $preparation . 'MOTCLES LIKE \'%' . $motcles[$i] . '%\'';
            } else {
                $preparation = $preparation . 'MOTCLES LIKE \'%' . $motcles[$i] . '%\' AND ';
            }
        }
        $result = $bdd->query($preparation);

    }
} else {
    $result = $bdd->query('SELECT TITRE , COUVERTURE , DATE_PARUTION , RESUME, ISBN_ISSN, QUANTITE_STOCK, PRIX, NOM_EDITEUR, COLLECTION, NUMERO_COLLECTION, SUPPORT, NOTE_GERANT, MOTCLES
                             FROM article join vitrine using (ISBN_ISSN)
                             WHERE  ISBN_ISSN in (select ISBN_ISSN from vitrine)
                            LIMIT 0,20');
}
// affichage d'un message "pas de résultats"
if (count($result) == 0) {
    ?>
    <h3 style="text-align:center; margin:10px 0;">Pas de résultats pour cette recherche</h3>
    <?php
} else {
    // parcours et affichage des résultats
    echo '<hr/>';
    while ($post = $result->fetch()) {
        $titre = $post['TITRE'];

        $isbn = $post['ISBN_ISSN'];

        $imgname = './couverture/' . $isbn . '.jpg';

        if (file_exists($imgname)) {
            $img = $isbn . ".jpg";
        } else {
            $img = "sans-image.jpg";
        }

        /* if(isset($post['Couverture'])){
           $img = $post['Couverture'];
         }
         else{
           $img = "sans-image.jpg";
         }*/

        ?>

        <?php echo '<form id="page_article" action="page_article.php" method="post">
            <input type="hidden" name="isbn" value="' . $isbn . '"/>
            ';
        echo $isbn; ?>


        <div class="article-result">
            <fieldset style="float:left; height:75px;width:75px;margin-right:20px;padding:0px;">
                <a href='#' onclick='myFunction()' name="isbn"
                   value=" <?php echo $isbn; ?>"><?php echo '<img src="./couverture/' . $img . '" style="width:75px;height:75px;padding:0px;border:1px;"/>'; ?></a>
            </fieldset>
            <div style="position:relative">
                </br>

                <a href='#' onclick='myFunction()' name="isbn"
                   value=" <?php echo $isbn; ?>"> <?php echo '<h3><p>' . ($titre) . '</p></h3>'; ?></a>
                </form>


                <p class="isbn">ISBN/ISSN:<?php echo($isbn); ?></p>
            </div>
            </br>
            <?php if (isset($post['DATE_PARUTION'])) {
                ?><p class="date">Date de
                parution:<?php echo date("d-m-Y", strtotime($post['DATE_PARUTION'])); ?></p><?php
            } ?>
            <?php if (isset($post['NOM_EDITEUR'])) {
                ?><p class="editeur"><?php echo 'editeur:' . $post['NOM_EDITEUR']; ?></p><?php
            }
            $result2 = $bdd->query('SELECT NOM_AUTEUR, PRENOM_AUTEUR FROM auteur WHERE ID_AUTEUR = (SELECT ID_AUTEUR FROM ecrire WHERE ISBN_ISSN =' . $isbn . ') ');
            while ($post2 = $result2->fetch()) {
                if (isset($post2['NOM_AUTEUR'])) {
                    echo "<p class='auteur'>auteur:" . $post2['NOM_AUTEUR'] . " " . $post2['PRENOM_AUTEUR'] . "</p>";
                }
            }

            if ($post['COLLECTION'] != ''){
            ?><p class="collection">Collection: <?php echo $post['COLLECTION'] . ", ";
                }
                if ($post['NUMERO_COLLECTION'] != '0') {
                    ?> numero: <?php echo $post['NUMERO_COLLECTION'] . ", ";
                }
                if ($post['SUPPORT'] != '') {
                    ?> version <?php echo $post['SUPPORT'];
                } ?></p>

            <?php
            if (f_compte($bdd)=="admin") {
                echo "<form method='post'>
              <input  type='image' src='delete.png'   name='delete'   align='right' width='32' height='32' value='" . $isbn . "' /></form>
              <form action='form_modifier_article.php' method='post'>
              <input  type='image' src='modifier.png' name='modifier' align='right' width='32' height='32' value='" . $isbn . "'/></h3>
            </form>
              <form action='add_vitrine.php' method='post'>
              <input  type='image' src='ajouter.png' name='vitrineadd' align='right' width='20' height='20' value='" . $isbn . "'/></h3>
            </form>";
            }
            if (f_compte($bdd)=="client") {
                echo "
                  
            <form  action='form_ajouter_article_panier.php'  method='post'>           
            <input  type='texte' name='ajouter article' style ='float: right' size='5' value='1'/>
            <input  type='image' src='addart.png' name='ajouter article' align='right' width='32' height='32' value='" . $isbn . "'/>
            </form>";  
            }
            ?>
            <p class="prixqte"><?php echo "prix:" . $post['PRIX'] . "€ Qté:";
                if ($post['QUANTITE_STOCK'] != '') {
                    echo $post['QUANTITE_STOCK'];
                } else echo '0'; ?></p>
            <?php if ($post['RESUME'] != '') {
                ?><p class="resume">
                <?php echo $post['RESUME']; ?>
                </p><?php }
            if ($post['NOTE_GERANT'] != ''){
            ?><p class="note">Note du gérant: <?php echo $post['NOTE_GERANT'];
                } ?></p>
            <?php
            if ($post['MOTCLES'] != ''){
            ?><p class="motcles">Mots-clés: <?php echo $post['MOTCLES'];
                } ?></p>
        </div>
        <hr/>
        <?php
    }
}

// <?php $post['TITRE'] ? >

/*****
 * fonctions
 *****/


function safe($var)
{
    $var = addslashes($var);
    $var = trim($var);
    $var = htmlspecialchars($var);
    return $var;
}

?>

<script>
    function myFunction() {
        document.getElementById("page_article").submit();
    }
</script>

<style type="text/css">
    .article-result {
        line-height: 10px;

    }

    a {
        text-decoration: none;
    }

    .resume {
        width: 500px;
        overflow: auto;
        height: auto;
        line-height: 20px;
        border: dotted;
        border-width: 1px;
    }

    ​
</style>