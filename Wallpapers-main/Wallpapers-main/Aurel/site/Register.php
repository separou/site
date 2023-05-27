<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $Fname = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    function verifierConnexion($utilisateur, $motDePasse, $fichierCSV) {
        $line=0;
        if (($handle = fopen($fichierCSV, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $colonne1 = $data[0];
                $colonne2 = $data[1];
                if ($utilisateur == $colonne1 && $motDePasse == $colonne2) {
                    $_SESSION['line'] = $line;
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

    session_start();
    $_SESSION['user'] = $email;
    $_SESSION['mdp'] = $password;
    $_SESSION['Prenom'] = $Fname;
    $_SESSION['Nom'] = $Lname;
    
    // Ouverture du fichier CSV en mode ajout
    $file = fopen('base.csv', "a");
    
    // Écriture des données dans le fichier CSV
    fputcsv($file, array($email, $password, $Fname, $Lname));
    fclose($file);
    $fichierCSV = 'base.csv';
    verifierConnexion($email, $password, $fichierCSV);
    // Fermeture du fichier
    // Redirection vers une page de confirmation
    header("Location: confirmation.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="CSS/Register.css">
  <title>LandCreate - Inscription</title>
  <link rel="icon" href="PhotosSite/solution.png">
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="">
                    <h2>Register</h2>
                    <div class="inputbox">
                        <ion-icon name="First Name"></ion-icon>
                        <input type="text" required id="Fname" name="Fname">
                        <label for="Fname">First Name</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="Last Name"></ion-icon>
                        <input type="text" required id="Lname" name="Lname">
                        <label for="Lname">Last Name</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" required id="email" name="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" required id="password" name="password">
                        <label for="password">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember me</label>
                    </div>
                    <button><a href="confirmation.html">Register</a></button>
                </form>
            </div>
        </div>
    </section>
    </form>
</body>
</html>