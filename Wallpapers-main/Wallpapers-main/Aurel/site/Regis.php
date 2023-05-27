<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $login = $_POST["login"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    
    // Ouverture du fichier CSV en mode ajout
    $file = fopen("utilisateurs.csv", "a");
    
    // Écriture des données dans le fichier CSV
    fputcsv($file, array($login, $password, $email));
    
    // Fermeture du fichier
    fclose($file);
    
    // Redirection vers une page de confirmation
    header("Location: confirmation.html");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="Register.css">
  <title>LandCreate</title>
  <link rel="icon" href="solution.png">
</head>
<body>
    <section>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-box">
            <div class="form-value">
                <form action="">
                    <h2>Register</h2>
                    <div class="inputbox">
                        <ion-icon name="First Name"></ion-icon>
                        <input type="email" required id="login" name="login">
                        <label for="">First Name</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="Last Name"></ion-icon>
                        <input type="email" required>
                        <label for="">Last Name</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="email" required>
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember me</label>
                    </div>
                    <button><a href="Page-accueil-2.html">Register</a></button>
                </form>
            </div>
        </div>
    </form>
    </section>
</body>
</html>
