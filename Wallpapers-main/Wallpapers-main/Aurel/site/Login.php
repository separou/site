<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fonction pour vérifier les informations de connexion
    function verifierConnexion($utilisateur, $motDePasse, $fichierCSV) {
        $line=0;
        if (($handle = fopen($fichierCSV, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $colonne1 = $data[0];
                $colonne2 = $data[1];
                $colonne3 = $data[2];
                $colonne4 = $data[3];

                if ($utilisateur == $colonne1 && $motDePasse == $colonne2) {
                    $_SESSION['line'] = $line;
                    $_SESSION['Prenom'] = $colonne3;
                    $_SESSION['Nom'] = $colonne4;
                    fclose($handle);
                    return true; // Les informations de connexion sont valides
                }
                $line=$line+1;
                $_SESSION['line'] = $line;
            }
        fclose($handle);
        }
        return false; // Les informations de connexion sont invalides
    }
    // Démarrer la session
    session_start();
    
    // Affecter une valeur à la variable de session
    $utilisateur = $_POST['email'];
    $_SESSION['user'] = $utilisateur;
    $password = $_POST['password'];
    $_SESSION['mdp'] = $password;
    $fichierCSV = 'base.csv';

    if (verifierConnexion($utilisateur, $password, $fichierCSV)) {
        header("Location: confirmation.html");
    } else {
       echo "Identifiants invalides.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="CSS/Login.css">
  <title>LandCreate - connection</title>
  <link rel="icon" href="PhotosSite/solution.png">
</head>
<body>
    <section>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-box">
            <div class="form-value">
                <form action="">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" required id="email" name="email">
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" required id="password" name="password">
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me <a href="#">Forget Password</a></label>
                      
                    </div>
                    <button>Log in</button>
                    <div class="register">
                        <p>Don't have a account <a href="Register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </form>
    </section>
</body>
</html>
