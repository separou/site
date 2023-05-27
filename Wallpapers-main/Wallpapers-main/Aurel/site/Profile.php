<!DOCTYPE html>
<html>
<head>
    <title>LandCreate - Profil</title>
    <link rel="icon" href="PhotosSite/solution.png">
    <style>
        /* Styles CSS pour centrer le contenu */
        .info1{
            display: flex;
            justify-content: center;
            height: 10vh;
        }
        .main{
            background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url(PhotosSite/fond_profile.JPG);
            color: white;
        }
        .tableauinfo{
            margin: 0 auto;
            padding-top: 50px;
        }
        tr th{
            padding-left: 20px;
            padding-right: 20px;
        }
        .boutonsup{
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 10px;
        }
        .boutonsup:hover{
            background-color: green;
        }
        .boutonmod{
            position: fixed;
            bottom: 20px;
            left: 20px;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 10px;
        }
        .boutonmod:hover{
            background-color: blueviolet;
        }
    </style>
    <script>
        function ConfirmSuppression() {
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ?");
      
            if (confirmation) {
              // Code à exécuter si l'utilisateur clique sur "Oui"
            } else {
              // Code à exécuter si l'utilisateur clique sur "Non"
              alert("Suppression annulée.");
            }
          }
    </script>
</head>
<body class="main">
    <!-- Affichage des informations au milieu de la page -->
    <div class="info1">
        <h1>Informations personnelles</h1>
    </div>
    <?php
    // Démarrer la session
    session_start();
    // Utilisation de la variable de session déclarée dans login.php
    $email = $_SESSION['user'];
    $line = $_SESSION['line'];
    $prenom = $_SESSION['Prenom'];
    $nom = $_SESSION['Nom'];
    $donnees = array(
        array($nom, $prenom, $email, $line)
    );
?>
<table class="tableauinfo">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>N° ligne</th>
    </tr>
    <?php foreach ($donnees as $row): ?>
    <tr>
        <?php foreach ($row as $value): ?>
        <td style="text-align: center;"><?php echo $value; ?></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
</table>
    <br>
    <a href="suppression.php" class="boutonsup" onclick="ConfirmSuppression()">Supprimer le compte</a> <!-- modifier la redirections -->
    <a href="modifier.php" class="boutonmod">Modifier le compte</a> <!-- modifier la redirections -->
</body>
</html>