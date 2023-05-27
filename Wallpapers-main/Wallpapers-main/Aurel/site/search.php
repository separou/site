<?php
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    
    // Chemin vers le fichier CSV
    $csvFile = 'base_photos.csv';

    // Lecture du fichier CSV et récupération des suggestions
    $suggestions = array();
    if (($handle = fopen($csvFile, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $value = $data[0]; // Première colonne du CSV
            if (stripos($value, $keyword) !== false) {
                $suggestions[] = $value;
            }
        }
        fclose($handle);
    }

    // Affichage des suggestions
    if (!empty($suggestions)) {
        foreach ($suggestions as $suggestion) {
            echo '<li>' . $suggestion . '</li>';
        }
    } else {
        echo '<li>No suggestions found</li>';
    }
}
?>