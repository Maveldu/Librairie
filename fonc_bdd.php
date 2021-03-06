<?php
$session = "librairie4.0";
$usr = "root";
$mdp = "";
function OuvrirConnexion($session, $usr, $mdp)
{
    try {
        $conn = new PDO("mysql:host=localhost;dbname=$session", $usr, $mdp);
		$conn->exec("SET CHARACTER SET utf8");
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        echo "<br>Votre nom d'utilisateur ou votre mot de passe est &eacute;ronn&eacute;e, veuillez vous reconnecter...<br>";
        echo '<form action = \'<?php $_SERVER[\'PHP_SELF\'] ?>\' method=\'post\' enctype=\'application/x-www-form-urlencoded\'>
				<input type=\'submit\' value=\'Retour\'>
		  	</form>';
        die();
    }
    return $conn;
}

//---------------------------------------------------------------------------------------------
function ExecuterRequete($conn, $req)
{
    $res = $conn->exec($req);
    return $res;
}

//---------------------------------------------------------------------------------------------
function LireDonneesPDO1($conn, $req)
{
    $i = 0;
    foreach ($conn->query($req, PDO::FETCH_ASSOC) as $ligne) {
        $tab[$i++] = $ligne;
    }
    if(isset($tab)){
   		return $tab;
    }else{
    	return null;
    }
}

//---------------------------------------------------------------------------------------------
function LireDonneesPDO2($conn, $sql)
{
    $i = 0;
    $cur = $conn->query($sql);
    while ($ligne = $cur->fetch(PDO::FETCH_ASSOC))
        $tab[$i++] = $ligne;
    return $tab;
}

//---------------------------------------------------------------------------------------------
function LireDonneesPDO3($conn, $sql)
{
    $cur = $conn->query($sql);
    $tab = $cur->fetchall(PDO::FETCH_ASSOC);
    return $tab;
}

//---------------------------------------------------------------------------------------------
function FermerConnexion($conn)
{
    // DÈconnexion de la BDD
    unset($conn);
}

//---------------------------------------------------------------------------------------------

?>