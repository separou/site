<?php require('login.html'); ?>
<?php
include 'FonctionsUsers.php';
$login=$_GET['login'];
$password=$_GET['password'];
// appel de la fonction principale.
informations($login,$password);
?>