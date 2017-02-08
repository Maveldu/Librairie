<html lang="fr" ng-app="NoteApp">
<link rel="icon" type="image/png" href="favicon.png"/>

<?php
session_start();
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
require_once 'menu.php';
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="angular/angular.min.js"></script>
    <script src="angular/angular-cookies.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>

</head>
<br><br><br><br>
<center>
<body ng-controller="NoteController as note">

<div id="content">

    <h2>Note pour l'administrateur</h2>
    <br>

    <div id="text">
        <textarea name="note"id="TEXTAREA" ng-model="messageNote" ng-trim="false" ng-change="analyse()" placeholder="Ecrire une note à envoyer à l'administrateur" maxlength=255 cols="60" rows="5"></textarea></div><br>

        <input class="btn btn-default" type="submit" name="envoyer" value="Envoyer"/>
        <button class="btn btn-default" ng-click="clear()">Effacer</button>

    <aside>Nombre de caractères restants :<b> {{ 255-counter }}</b></aside>

    </div>
</div>
<?php
if (isset($_POST['envoyer'])) {
    $req = "SELECT NUM_NOTE FROM note WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT ='" . $_SESSION['id'] . "')";
    $TabNumNote = LireDonneesPDO1($bdd, $req);
    $Num_note = $TabNumNote['0']['NUM_NOTE'];
    $req = "INSERT INTO note VALUES(" . $Num_note . "," . $_POST['note'] . ",sysdate,0," . $Num_note . ",);";
    $res = ExecuterRequete($bdd, $req);
}
?>
<script src="./module.js"></script>
</center>
</body>