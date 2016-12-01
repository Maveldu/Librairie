<?php


try
{
  $bdd = new PDO('mysql:host=localhost;dbname=librairie4.0;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
session_start();
?>



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
<?php require_once('menu.html');

?>
<br/><br/>
<br/><br/>

<body>
<fieldset>
    <div id ="maincontent"> 
    <?php if(isset($_SESSION['id'])) {
        echo "Vous devez être administrateur pour acceder à cette fonctionnalité";
    }
	?>
	<input type="button" name="retour" value="Retour" onclick="self.location.href='index.php'" style="background-color:#3cb371" style="color:white; font-weight:bold"onclick> 
</body>