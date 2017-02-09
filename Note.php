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
    <script type="text/javascript" src="script_compte_pro.js"></script>
</head>
<body>
<center>
<div id="pge">
    <br/>
    <br/>
    <h2>Note pour l'administrateur</h2>
    <fieldset>
        <p id="cnt"></p>
        <textarea type="text" id="txa" ng-model="myName" placeholder="Ecrire une note à envoyer à l'administrateur" maxlength=255 cols="60" rows="5"  autofocus onkeyup="reste(this.value); " required></textarea>
        <br />
            <input class="btn btn-primary" type="submit" value="Envoyer" name="envoyer" id="envoyer">
            <input class="btn btn-primary" type="button" value ="Effacer" onclick="effacer()">
    </fieldset>
</div>
<script type="text/javascript">
    var maxChr=255; // limite max fixée
    function $(i){return document.getElementById(i)}
    function red(nbrChr){return Math.round(255*Math.pow(0.977,maxChr-nbrChr))}
    function countChr()
    {
        var len=$('txa').value.length;
        if (maxChr<len)
        {
            $('txa').value=$('txa').value.substr(0,maxChr);
            len=maxChr
        }
        $('cnt').innerHTML='<span style="color:rgb('+red(len)+',0,0)">'+len+' caractère'+(1<len?'s':'')+'</span> / '+maxChr;
        if (len<maxChr)
            $('cnt').className="";
        else
            $('cnt').className="bold";
    };

    (function()
    {
        $('txa').onkeyup=countChr;
        countChr();
    })();
</script>

<script type="text/javascript">
    function effacer()
    {
        document.getElementById("txa").value="";
    }
</script>
</center>
</body>
<?php
if (isset($_POST['envoyer'])) {
    $req = "SELECT NUM_NOTE FROM note WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT ='" . $_SESSION['id'] . "')";
    $TabNumNote = LireDonneesPDO1($bdd, $req);
    $Num_note = $TabNumNote['0']['NUM_NOTE'];
    $req = "INSERT INTO note VALUES(" . $Num_note . "," . $_POST['note'] . ",sysdate,0," . $Num_note . ",);";
    $res = ExecuterRequete($bdd, $req);
    echo"caca";
}
?>
