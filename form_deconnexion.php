<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
if (isset($_POST['valider'])) {
    session_destroy();?>
    <script language="javascript">
        setTimeout("location.href = 'index.php'",1);
</script><?php
}
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
$titre = "Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>
<html>
<link rel="icon" type="image/png" href="favicon.png"/>
<style>

    .aucentre {
        text-align: center;
    }

    label {
        display: block;
        width: 150px;
        float: left;
    }

    body #maincontent {
        width: 90%;
        min-height: 400px;
    }

    #maincontent {
        padding: 32px 16px;
        max-width: 894px;
        min-width: 320px;
    }

    body #maincontent, body .pageSectionContainer, body #c_content {
        margin: 1 auto;
        margin-top: 0px;
        margin-right: auto;
        margin-bottom: 0px;
        margin-left: 400px;
    }


</style>

<br/><br/>
<br/><br/>

<body>
<fieldset style="width:500px;">
    <div>
        <p>
        <div id="maincontent">
            <form method="post">
                <?php
                if (isset($_SESSION['id'])) {
                    echo "<p> Voulez vous vraiment vous déconnecter " . $_SESSION['id'] . " ? </p>";
                    ?>
                    <input class="btn btn-default" type="submit" name="valider" value="Se déconnecter"/>
                    <input class="btn btn-default" type="button" name="Accueil" value="Accueil"
                           onclick="self.location.href='index.php'">
                    <?php
                } else {
                    echo "<p> Vous n'êtes pas connecté !</p>";
                }
                ?>

            </form>
        </div>
        </p>
    </div>
</fieldset>
</body>
</html>

