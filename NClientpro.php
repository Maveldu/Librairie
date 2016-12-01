



<html>


<head> 

        <meta charset="utf-8" />
        <title>Erreur Connection</title>
		<link rel="stylesheet" href="ajouter_article2.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

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

    </head>
	
<?php 
require_once('menu.php');

session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);

require_once('f_compte.php');
?>
<br/><br/>
<br/><br/>

<body>
<fieldset>
    <div id ="maincontent"> 
    <?php if(f_compte($bdd)!="clientpro") {
        echo "Vous devez être client pro pour acceder à cette fonctionnalité";
		echo "<br/>";
		echo "<br/>";
    }
		else{
			echo "Vous ne devez pas être ici";	
			echo "<br/>";
			echo "<br/>";
		}
		
	?>
	<input class="btn btn-default" type="button" name="Accueil" value="Accueil"
                               onclick="self.location.href='index.php'">
</body>