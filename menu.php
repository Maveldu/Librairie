<?php
require_once 'fonc_bdd.php';
$bdd = OuvrirConnexion($session, $usr, $mdp);
require_once 'f_compte.php';
?>
<!DOCTYPE html>
<html>
<link rel="icon" type="image/png" href="favicon.png"/>


<head>
    <title>Librairie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css.map">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js""></script>
	<script type="text/javascript" src="bootstrap/js/npm.js""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
    <style>
        body {
            font: 400 15px/1.8 Lato, sans-serif;
            color: #777;
			background-color:white;
			background-image:url(fond.jpg);
			background-repeat:no-repeat;
			background-attachment:fixed;
			center top no-repeat;
			position: relative;
		}
		
        h3, h4 {
            margin: 10px 0 30px 0;
            letter-spacing: 10px;
            font-size: 20px;
            color: #111;
        }

        .container {
            padding: 80px 120px;
        }

        .person {
            border: 10px solid transparent;
            margin-bottom: 25px;
            width: 80%;
            height: 80%;
            opacity: 0.7;
        }

        .person:hover {
            border-color: #f1f1f1;
        }

        .carousel-inner img {
            width: 100%; /* Set width to 100% */
            margin: auto;
        }

        .carousel-caption h3 {
            color: #fff !important;
        }

        @media (max-width: 600px) {
            .carousel-caption {
                display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
            }
        }

        .bg-1 {
            background: #2d2d30;
            color: #bdbdbd;
        }

        .bg-1 h3 {
            color: #fff;
        }

        .bg-1 p {
            font-style: italic;
        }

        .list-group-item:first-child {
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }

        .list-group-item:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .thumbnail {
            padding: 0 0 15px 0;
            border: none;
            border-radius: 0;
        }

        .thumbnail p {
            margin-top: 15px;
            color: #555;
        }

        .btn {
            padding: 10px 20px;
            background-color: #333;
            color: #f1f1f1;
            border-radius: 0;
            transition: .2s;
        }

        .btn:hover, .btn:focus {
            border: 1px solid #333;
            background-color: #fff;
            color: #000;
        }

        .modal-header, h4, .close {
            background-color: #333;
            color: #fff !important;
            text-align: center;
            font-size: 30px;
        }

        .modal-header, .modal-body {
            padding: 40px 50px;
        }

        .nav-tabs li a {
            color: #777;
        }

        #googleMap {
            width: 100%;
            height: 400px;
        }
		
		
		#monlogo  img{
		-webkit-transition:-webkit-transform .9s; // Chrome Safari
		-moz-transition:-moz-transform .9s;       // Mozilla
		-o-transition:-o-transform .9s;           // Opéra
		-ms-transition:-ms-transform .9s;         // IE
		transition:transform .9s;
		}
 
		#monlogo  img:hover{
		-webkit-transform:rotate(720deg); 
		-moz-transform:rotate(720deg);
		-o-transform:rotate(720deg); 
		-ms-transform:rotate(720deg); 
		transform:rotate(720deg);
		}
		
        .navbar {
            font-family: Montserrat, sans-serif;
            margin-bottom: 0;
            background-color: #2d2d30;
            border: 0;
            font-size: 11px !important;
            letter-spacing: 4px;
            opacity: 0.9;
        }

        .navbar li a, .navbar .navbar-brand {
            color: #d5d5d5 !important;
        }

        .navbar-nav li a:hover {
            color: #fff !important;
        }

        .navbar-nav li.active a {
            color: #fff !important;
            background-color: #29292c !important;
        }

        .navbar-default .navbar-toggle {
            border-color: transparent;
        }

        .open .dropdown-toggle {
            color: #fff;
            background-color: #555 !important;
        }

        .dropdown-menu li a {
            color: #000 !important;
        }

        .dropdown-menu li a:hover {
            background-color: red !important;
        }

        footer {
            background-color: #2d2d30;
            color: #f5f5f5;
        }

        footer a {
            color: #f5f5f5;
        }

        footer a:hover {
            color: #777;
            text-decoration: none;
        }

        .form-control {
            border-radius: 0;
        }

        textarea {
            resize: none;
        }

		.button {
		font-size: 1em;
		padding: 10px;
		color: black;
		border: 2px solid blue;
		border-radius: 20px/50px;
		text-decoration: none;
		cursor: pointer;
		transition: all 0.3s ease-out;
		}
		
		.button:hover {
		background: blue;
		color:white ;
		}

		.overlay {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background: rgba(0, 0, 0, 0.7);
		transition: opacity 500ms;
		visibility: hidden;
		opacity: 0;
		}
		.overlay:target {
		visibility: visible;
		opacity: 1;
		}

		.popup {
		margin: 70px auto;
		padding: 20px;
		background: #fff;
		border-radius: 5px;
		width: 30%;
		position: relative;
		transition: all 5s ease-in-out;
		}

		.popup h2 {
		margin-top: 0;
		color: #333;
		font-family: Tahoma, Arial, sans-serif;
		}
		.popup .close {
		position: absolute;
		top: 20px;
		right: 30px;
		transition: all 200ms;
		font-size: 30px;
		font-weight: bold;
		text-decoration: none;
		color: #333;
		}
		.popup .close:hover {
		color: white;
		
		}
		.popup .content {
		max-height: 30%;
		overflow: auto;
}
    </style>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<div id="background">
<nav class="navbar navbar-default navbar-fixed-top">
    <div style="float:left; width:70px;">
        <a href="index.php">
		
			<div id="monlogo"> 
            <img src="logo.png" alt="logo" title="Accueil" id="logo" width="60" height="60"/>
			</div>
        </a>
    </div>
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="index.php">Accueil</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">AFFICHER
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="form_afficher_article.php">Article</a></li>
                        <li><a href="afficher_editeur.php">Éditeur</a></li>
                        <li><a href="afficher_auteur.php">Auteur</a></li>
						<?php if (f_compte($bdd)=="admin") { ?>
						<li><a href="afficher_vitrine.php">Vitrine</a></li>
						<?php } ?>
                    </ul>
                </li>
					<?php if (f_compte($bdd)=="admin") { ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">AJOUTER
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="form_ajouter_article.php">Article</a></li>
                            <li><a href="form_ajouter_editeur.php">Éditeur</a></li>
                            <li><a href="form_ajouter_auteur.php">Auteur</a></li>
                            <li><a href="form_csvImport.php">CSV</a></li>
                            <li><a href="photo.php">Photo vitrine</a></li>
							<li><a href="Note.php">Note</a></li>
                        </ul>
                    </li>
					
					 <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">COMPTE
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="form_creer_admin.php">Admin</a></li>
                            <li><a href="form_compte_client_pro.php">Client pro</a></li>
                            <li><a href="form_compte_fournisseur.php">Fournisseur</a></li>
                        </ul>
                    </li>
					
					 <?php } ?>
					<?php if (isset($_SESSION['id'])) { ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"
                           href="#"><?php echo strtoupper($_SESSION['id']); ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
							<li><a href="MonCompte.php">Mon Compte</a></li>
                            <li><a href="form_deconnexion.php">Se déconnecter</a></li>
							<?php if (f_compte($bdd)=="admin") { ?>
							<li><a href="afficher_vitrine.php">Message</a></li>
							<li><a href="afficher_vitrine.php">Gestion de compte</a></li>
                                <li><a href="form_commande.php">Gestion des commandes</a></li>
							<?php } ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="mon_panier.php">MON PANIER</a>
                    </li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">MON COMPTE
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="form_inscription.php"> S'inscrire</a></li>
                            <li><a href="form_connexion.php"> Se connecter</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>