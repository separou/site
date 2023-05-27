<?php
// Options du menu déroulant
$options = array(
    "Nom",
    "Prénom",
    "Adresse mail",
    "Mot de passe"
);

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $optionChoisie = $_POST["option"];
    $modification = $_POST["modification"];
    session_start();

    // Stockage de la modification dans une variable appropriée
    switch ($optionChoisie) {
        case "Nom":
            $nom = $modification;
            $_SESSION['Nom'] = $modification;
            break;
        case "Prénom":
            $prenom = $modification;
            $_SESSION['Prenom'] = $modification;
            break;
        case "Adresse mail":
            $mail = $modification;
            $_SESSION['user'] = $modification;
            break;
        case "Mot de passe":
            $mdp = $modification;
            $_SESSION['mdp'] = $modification;
            break;
        default:
            // Option invalide
            break;
    }
    
    // ... changement des données dans le fichier de base de données ...

    // Paramètres du fichier CSV
    $fichierCSV = 'base.csv';
    $delimiteur = ';';
    // numéro la ligne à modifier
    $idLigneModif = $_SESSION['line'];

    // Parcourir le fichier ligne par ligne
    if (($handle = fopen($fichierCSV, "r+")) !== FALSE) { //ouverture du fichier en lecture et écriture
        $line=0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($line == $idLigneModif) {
                $colonne1 = $_SESSION['user'];
                $colonne2 = $_SESSION['mdp'];
                $colonne3 = $_SESSION['Prenom'];
                $colonne4 = $_SESSION['Nom'];
                fputcsv($fichierCSV, array($colonne1, $colonne2, $colonne3, $colonne4));
                fclose($fichierCSV);
            }
            $line = $line + 1;
        }
        fclose($handle);
    } else {
        return false; //la réécriture des données dans le fichier csv n'a pas fonctionné
    }


    // Réinitialisation des valeurs pour permettre d'autres modifications
    $optionChoisie = "";
    $modification = "";

    //message de confirmation
    $confirmation = "Modification du profil effectuée avec succès";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>LandCreate - Édition profil</title>
    <link rel="icon" href="PhotosSite/solution.png">
    <script>
        <?php
            if(!empty($confirmation)){
                echo "alert('$confirmation')";
                header("Location: profile.php");
            }
        ?>
    </script>
    <style>
        #titre{
            text-align: center;
        }
        .main{
            background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url(PhotosSite/fond_profile.JPG);
            color: white;
        }
        #modification, #option, #confirm{
            border-radius: 10px;
        }
        #boutonRetour{
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 10px;
        }
        #boutonRetour:hover{
            background-color: green;
        }
        #selection{
            padding-top: 40px;
            padding-left: 10px;
        }
    </style>
</head>
<body class="main">
    <h1 id="titre">Modifier votre profil</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="selection">
        <label for="option">Choisissez ce que vous souhaitez modifier :</label>
        <select name="option" id="option">
            <?php
            // Affichage des options du menu déroulant
            foreach ($options as $option) {
                echo "<option value=\"$option\">$option</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="modification">Saisissez la modification :</label>
        <input type="text" name="modification" id="modification">
        <br><br>
        <input type="submit" value="Modifier" id="confirm">
        <br><br>
        <a href="Profile.php" id="boutonRetour">Retour à la page du profil</a>
    </form>
</body>
</html>
