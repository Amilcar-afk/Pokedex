<?php
session_start();
session_destroy();

// retour à l'index
header('location: index.php');
exit;
?>