<?php

function f_compte($bdd, $charset = 'utf-8')
{

    if (isset($_SESSION['id'])) {
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM client WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        if ($req['nbr'] != 0) {
            return "client";
        }
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM compte_gerant WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        if ($req['nbr'] != 0) {
            return "gerant";
			}
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM compte_gerantP WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        if ($req['nbr'] != 0) {
            return "admin";
        }
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM compte_fournisseur WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        if ($req['nbr'] != 0) {
            return "fournisseur";
        }
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM compte_client_pro WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        if ($req['nbr'] != 0) {
            return "clientpro";
        }

    }
}

function is_admin($bdd, $charset = 'utf-8')
{
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM compte_gerantP WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        return ($req['nbr'] != 0);
}

function is_client($bdd, $charset = 'utf-8')
{
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM client WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        return ($req['nbr'] != 0);
}

function is_gerant($bdd, $charset = 'utf-8')
{
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM compte_gerant WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        return ($req['nbr'] != 0);
}

function is_fournisseur($bdd, $charset = 'utf-8')
{
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM compte_fournisseur WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        return ($req['nbr'] != 0);
}

function is_clientpro($bdd, $charset = 'utf-8')
{
        $count = $bdd->prepare("SELECT COUNT(*) AS nbr FROM compte_fournisseur WHERE NUMERO_COMPTE=(SELECT NUMERO_COMPTE from compte where IDENTIFIANT = '" . $_SESSION['id'] . "')");
        $count->execute(array($_SESSION['id']));
        $req = $count->fetch(PDO::FETCH_ASSOC);
        return ($req['nbr'] != 0);
}
?>
