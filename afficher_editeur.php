<html>
<link rel="icon" type="image/png" href="favicon.png"/>
</html>
<?php
session_start();
require_once 'fonc_bdd.php';
$bdd=OuvrirConnexion($session, $usr, $mdp);
$titre="Librairie"; //Titre ‡ changer sur chaque page
require_once 'menu.php';
?>

<br/><br/>
<br/><br/>
    <fieldset><legend class="center-block text-center"><h2>Liste des éditeurs</h2></legend>
	<div class="mon_centre">
    <p class="center-block text-center"> <h1>Faire une recherche par:</h1> </p>
    <form method="post">
      <input id="radio" type= "radio" name="radio" value="NOM" checked> Nom
      <input id="radio" type= "radio" name="radio" value="ID_EDITEUR"> Numero
    </form>
	</div>

<form class="ajax" method="post" autocomplete="off">

  <p>
    <label for="q">Rechercher un editeur</label><input type="text" name="q" id="q" />
  </p>
</form>
<div id="results"><?php include 'ajax-search-editeur.php' ?></div>

</fieldset>



<?php

if (isset($_POST['delete'])) :
   $bdd->exec( 'DELETE FROM article WHERE ID_EDITEUR = "' .$_POST['delete']. '"' );
   $bdd->exec( 'DELETE FROM editeur WHERE ID_EDITEUR = "' .$_POST['delete']. '"' );
   echo "<meta http-equiv='refresh' content='0; url='".$_SERVER['PHP_SELF']."'>";
endif;
?>


<script type="text/javascript">
$(document).ready( function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
  $('#q').keyup( function(){
    $field = $(this);
    $('#results').html('');
    $('#ajax-loader').remove();
    var elements = document.getElementsByName("radio");
    var j;
    for(var i = 0; i < elements.length; i++ ){
      if(elements[i].checked){
        j = elements[i].value;
      }
    }

      $.ajax({
    type : 'POST', // envoi des données en GET ou POST
    url : 'ajax-search-editeur.php' , // url du fichier de traitement
    data : {q: $(this).val(), radio: j} , // données à envoyer en  GET ou POST
    beforeSend : function() { // traitements JS à faire AVANT l'envoi
    $field.after('<img src="ajax-loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
  },
  success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
    $('#ajax-loader').remove(); // on enleve le loader
    $('#results').html(data); // affichage des résultats dans le bloc
  }
      });

  });
});
</script>