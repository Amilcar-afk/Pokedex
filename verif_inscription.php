<?php
  include('includes/config.php');
?>

<?php

  function verif_pwd($pwd){
    $size = strlen($pwd);
    $count_maj = 0;
    $count_min = 0;
    $count_num =0;

    for($i=0; $i < $size; $i++) {
      if($pwd[$i] >= 'a' && $pwd[$i] <= 'z'){
        $count_min++;
      }
      if($pwd[$i] >= 'A' && $pwd[$i] <= 'Z'){
        $count_maj++;
      }
      if($pwd[$i] >= '0' && $pwd[$i] <= '9'){
        $count_num++;
      }
    }

    if($count_num > 0 && $count_maj > 0 && $count_min > 0){
      return true;
    }else{
      return false;
    }
  }

  if(!isset($_POST['pseudo']) || empty($_POST['pseudo'])){
    header('location:inscription_connexion.php?msg= Veuillez saisir un pseudo');
    exit;
  }
  if(!isset($_POST['mail']) || empty($_POST['mail'])){
    header('location:inscription_connexion.php?msg= Veuillez saisir votre email');
    exit;
  }
  if(!isset($_POST['pwd']) || empty($_POST['pwd'])){
    header('location:inscription_connexion.php?msg= Veuillez saisir un mot-de-passe');
    exit;
  }

  if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
    header('location:inscription_connexion.php?msg=Format email non valide');
    exit;
  }
  if(strlen($_POST['pwd']) < 8){
    header('location:inscription_connexion.php?msg=mot-de-passe trop court');
    exit;
  }
  if(!verif_pwd($_POST['pwd'])){
    header('location:inscription_connexion.php?msg=mot-de-passe: 1 majuscule minimum, 1 minuscule minimum, 1 chiffre minimum');
    exit;
  }

  $req = $bdd->prepare('SELECT id FROM user WHERE pseudo = :pseudo');
  $req->execute(array(
    'pseudo' => $_POST['pseudo']
  ));
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  if (count($res) > 0) {
    header('location:inscription_connexion.php?msg=pseudo déja utilisé');
    exit;
  }

  $req = $bdd->prepare('SELECT id FROM user WHERE email = :mail');
  $req->execute(array(
    'mail' => $_POST['mail']
  ));
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  if (count($res) > 0) {
    header('location:inscription_connexion.php?msg=email déja associé');
    exit;
  }


  $salt = 'c0r0nAv1rUs';
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $mail = $_POST['mail'];
  $pwd = hash('sha256', $salt . $_POST['pwd']);

  $acceptable = [
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    ];



    /*if( ! in_array($_FILES['image']['type'], $acceptable)){
        header('location: addPokemon.php?msg=Le fichier nest pas une image !');
        exit;
    }*/

    //verification du poids du fichier

    $maxsize = 1024 * 1024; //limite a 1Mo
    if($_FILES['image']['size'] > $maxsize) {
        header('location: addPokemon.php?msg=Le fichier est trop volumineux!');
        exit;
    }
    //determination du chemin ou va etre enregistree l'image
    $path = 'uploads';
    //si le dossier nexiste pas, le creer
    if(!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $filename = $_FILES['image']['name']; // le nom d'origine

    // renommer le fichier pour eviter les doublons
    $temp = explode('.', $filename);
    $extension = end($temp); //recuper l'extension
    $timestamp = time();
    $filename = 'image-' . $timestamp . '.' . $extension; //attention, ne marche pas si 2 fichier sont uploader dans la meme seconde

    $chemin_image = $path . '/' . $filename; //definition du chemin definitive
    move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image);


  $q = 'INSERT INTO user (pseudo, email, password, image) VALUES (?, ?, ?, ?)';
  $req = $bdd->prepare($q);
  $req->execute([$pseudo,$mail,$pwd,$filename]);

  header('loaction:inscription_connexion.php');
?>
