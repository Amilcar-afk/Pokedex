<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <?php
            include('includes/header.php');
        ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/collection.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i&display=swap" rel="stylesheet">
    <title>Collection</title>
  </head>
  <body>
      <main>
        <h1>TOUS LES POKEMONS</h1>
        <div id="collection">

        <?php

          $resp = $bdd->query('SELECT nom, pv, attaque, defense, vitesse, image FROM pokemon ORDER BY nom');

          while($data = $resp->fetch(PDO::FETCH_ASSOC)) { ?>
            <article class="articleCollection">
                <div class="divCollection">
                  <h3> <?php echo $data['nom']; ?> </h3>
                  <p> <?php echo "PV : " . $data['pv']; ?> </p>
                  <p> <?php echo "Attaque : " . $data['attaque']; ?> </p>
                  <p> <?php echo "Défense : " . $data['defense']; ?> </p>
                  <p> <?php echo "Vitesse : " . $data['pv']; ?> </p>
                </div>
              <img src="<?php echo "pokemon/" . $data['image']; ?>" alt="pokemon" class="imgCollection">
            </article>
        <?php
          }
        ?>
        </div>
      </main>
  </body>
  <?php
        include('includes/footer.php');
    ?>
</html>
