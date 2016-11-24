<script type="text/javascript" src="\js\jquery-latest.js"></script>
<head>

        <meta charset="utf-8" />

        <link rel="stylesheet" href="Style.css" />

</head>
<?php

require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page


 if(isset($_POST['q']))
 {
    $result = $bdd->query( 'SELECT ID_AUTEUR, NOM_AUTEUR, PRENOM_AUTEUR
                             FROM auteur
                             WHERE  NOM_AUTEUR LIKE \'' . safe( $_POST['q'] ) . '%\'
                            LIMIT 0,20' );
 }
 else
 {
    $result = $bdd->query( 'SELECT ID_AUTEUR, NOM_AUTEUR, PRENOM_AUTEUR
                             FROM auteur
                            LIMIT 0,20' );
 }
// affichage d'un message "pas de résultats"
if( count( $result ) == 0 )
{
?>
    <h3 style="text-align:center; margin:10px 0;">Pas de résultats pour cette recherche</h3>
<?php
}
else
{
    // parcours et affichage des résultats
    echo '<hr/>';
    while( $post = $result->fetch() )
    {
        $id_auteur = $post['ID_AUTEUR'];
    ?>
        <div class="article-result">

            <h3><p><?php echo ( $post['NOM_AUTEUR']." ".$post['PRENOM_AUTEUR'] ); ?></p>
            </h3>
            <?php
        if(isset($_SESSION['id']))
        {
            echo "<form method='post'>
              <input action='afficher_auteur.php' type='image' src='delete.png'   name='delete'   align='right' width='32' height='32' value='".$id_auteur."' />
              </h3>
            </form>";
        } ?>
            <p class="id">IDENTIFIANT:<?php echo $id_auteur; ?></p>
        </div>
        <hr/>
    <?php
    }
}

// <?php $post['TITRE'] ? >
 
/*****
fonctions
*****/
function safe($var)
{
	$var = addcslashes($var, '%_');
	$var = trim($var);
	$var = htmlspecialchars($var);
	return $var;
}
?>


