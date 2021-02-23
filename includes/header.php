<?php session_start();?>
<link rel="stylesheet" type="text/css" href="css/header.css">

<header>
  <img src="images/logo.png" class="logo_h">

  <?php
      echo'<ul class="ul_header">';
        if(isset($_SESSION['pseudo'])){
          echo '<li class="accueil_link"><a href="index.php" >Accueil</a></li>';
          echo '<li><a href="collection.php">Collection</a></li>';
          echo '<li><a href="addPokemon.php">Ajouter un Pokemon</a></li>';
          echo '<li><a href="profil.php">Mon compte</a></li>';
          echo '<li><a href="deconnexion.php">Deconnexion</a></li>';
          echo '</ul>';
        }
        else {
          echo '<li class="accueil_link"><a href="index.php" >Accueil</a></li>';
          echo '<li><a href="collection.php">Collection</a></li>';
          echo '<li><a href="inscription_connexion.php">Inscription/Connexion</a></li>';
          echo '</ul>';
        }
    ?>
</header>
