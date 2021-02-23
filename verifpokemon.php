<?php
require('includes/config.php');
session_start();
$q = 'SELECT id FROM user WHERE pseudo = ?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['pseudo']]);
$id_user = $req->fetch();
//verifier que le nom n'est pas déja pris

$q = 'SELECT id FROM pokemon WHERE nom = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['login']]);
$results = $req->fetchAll();

if(count($results) > 0){ //tableau non vide: nom déja utilisé
	header('location: addPokemon.php?msg=nom already exist');
	exit;
}

//htmlspecialchars pour empecher la faille XSS
$nom = htmlspecialchars($_POST['nom']);
$pv = htmlspecialchars($_POST['pv']);
$attaque = htmlspecialchars($_POST['attaque']);
$defense = htmlspecialchars($_POST['defense']);
$vitesse = htmlspecialchars($_POST['vitesse']);

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
$path = 'pokemon';
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
var_dump($_FILES['image']['tmp_name']);
move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image);





//requete préparée
$q = 'INSERT INTO pokemon (nom,pv,attaque,defense,vitesse,image,id_user) VALUES (?, ?, ?, ?, ?, ?, ?)';
$req = $bdd->prepare($q);
$req->execute([$nom,$pv,$attaque,$defense,$vitesse,$filename,$id_user[0]]);


header('location: profil.php');
exit;

?>
