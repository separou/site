<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "reglog");

<?php
$servername = "localhost";
$username = "votre_nom_utilisateur_mysql";
$password = "votre_mot_de_passe_mysql";
$database = "votre_base_de_donnees_mysql";

// Connexion à MySQL
$conn = mysqli_connect($servername, $username, $password, $database);

// Vérification de la connexion
if (!$conn) {
  die("La connexion a échoué: " . mysqli_connect_error());
}
echo "Connecté avec succès à MySQL";
?>









