<!DOCTYPE html>
<html>
<head>
  <title>Se connecter</title>
  <meta charset="utf-8">
  <meta name="connexion" content="se connecter">
  <link rel="stylesheet" type="text/css" href="css/inscription_connexion.css">
</head>
<body>
  <?php include('includes/header.php') ?>
  <?php
			if(isset($_GET['msg'])){
				echo '<h3>' . htmlspecialchars($_GET['msg']) . '</h3>';
			}
        ?>
  <main>
    <br>
    <div class="div_inscrition">
      <form method="post" action="verif_inscription.php" enctype="multipart/form-data">
        <ul class="ul_inscription">
          <h1>Pas de compte? S'inscrire:</h1>
          <li><input class="input_text" size="50" type="text" name="pseudo" placeholder="Un pseudo*"></li><br>
          <li><input class="input_text" size="50"type="email" name="mail" placeholder="Votre adresse mail*"></li><br>
          <li><input class="input_text" size="50"type="password" name="pwd" placeholder="Un mot-de-passe*"></li><br>
          <li><label>image: </label><input size="50" type="file" name="image"></li><br>
          <li><input type="submit" name="button" value="Valider" class="button"></li>
        </ul>
      </form>
    </div>
    <div class="div_connexion">
      <form action="verif_connexion.php" method="post">
        <ul class="ul_connexion">
          <h1>Deja un compte? Se connecter:</h1>
          <li><input class="input_text" size="50"type="text" name="pseudo" placeholder="Votre pseudo*"></li><br>
          <li><input class="input_text" size="50"type="password" name="pwd" placeholder="Votre mot-de-passe*"></li><br>
          <li><input size="50"type="submit" name="button" value="Valider" class="button"></li>
        </ul>
    </form>
    </div>
  </main>
  <?php include('includes/footer.php') ?>
</body>
</html>
