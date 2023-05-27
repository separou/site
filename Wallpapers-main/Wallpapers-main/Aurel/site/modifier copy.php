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
    $nomFichier = 'base.csv';
    $delimiteur = ';';
    session_start();
    // numéro la ligne à modifier
    $idLigneModif = $_SESSION['line'];

    // Ouvrir le fichier CSV en mode lecture et écriture
    $fichier = fopen($nomFichier, 'r+');

    // Parcourir le fichier ligne par ligne
    while (($ligne = fgets($fichier)) !== false) {
        $donnees = str_getcsv($ligne, $delimiteur);

        // Vérifier si c'est la ligne à modifier (par exemple, en comparant l'ID)
        if ($donnees[0] == $idLigneModif) {
            // Modifier les valeurs dans le tableau
            $donnees[1] = $_SESSION['user'];
            $donnees[2] = $_SESSION['mdp'];
            $donnees[3] = $_SESSION['Prenom'];
            $donnees[4] = $_SESSION['Nom'];

            // Réécrire la ligne modifiée dans le fichier CSV
            fseek($fichier, -strlen($ligne), SEEK_CUR); // Déplacer la position du curseur avant la ligne
            fputcsv($fichier, $donnees, $delimiteur); // Réécrire la ligne modifiée
            break; // Sortir de la boucle puisque la ligne a été trouvée et modifiée
        }
    }

    // Fermer le fichier
    fclose($fichier);


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
