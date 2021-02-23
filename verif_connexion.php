<?php
  include('includes/config.php');
?>

<?php

  $salt = 'c0r0nAv1rUs';
  $login = htmlspecialchars($_POST['pseudo']);
  $pwd = hash('sha256' ,$salt . $_POST['pwd']);

  $req = $bdd->prepare('SELECT pseudo FROM user WHERE pseudo = ? AND password = ?');
  $req->execute([$login,$pwd]);


  $res = $req->fetchAll(PDO::FETCH_ASSOC);

  if(count($res) > 0){
    session_start();
    $_SESSION['pseudo'] = $login;
    header('location:index.php');
    exit;
  }else{
    header('location:inscription_connexion.php?msg=utilisateur inexistant');
    exit;
  }

?>
