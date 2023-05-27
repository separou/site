<?php
    session_start();
    unset($_SESSION['user']);

    // Lire le contenu du fichier CSV
    $lines = file('base.csv');

    // Identifier la ligne à supprimer (par exemple, la ligne 3)
    $lineToDelete = $_SESSION['line']; // Notez que les indices de tableau commencent à 0

    // Supprimer la ligne du tableau
    if (isset($lines[$lineToDelete])) {
        unset($lines[$lineToDelete]);
    }

    // Réécrire le contenu mis à jour dans le fichier CSV
    file_put_contents('base.csv', implode('', $lines));

    session_unset();
    session_destroy();
    header("Location: confirmation_supp.html");

?>

<?php /*
    $line = 0;
        if (($handle = fopen($fichierCSV, "r+")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $colonne1 = $data[0];
                $colonne2 = $data[1];

                if ($utilisateur == $colonne1 && $motDePasse == $colonne2) {
                    fclose($handle);
                    return true; // Les informations de connexion sont valides
                }
                $line = $line + 1;
            }
        fclose($handle);
        }*/
?>