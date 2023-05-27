<?php

$abs=$_GET["abscisse"];
$ord=$_GET["ordonnée"];
$choix=$_GET["choix"];
$distance=sqrt(pow($abs,2) + pow($ord,2));

if($choix == "Distance"){
    echo "La distance entre le point (".$abs.",".$ord.") et l'origine du repère est : ".$distance;
}
else if($choix == "Cosinus"){
    echo "Le cosinus de l'angle formé par le point (".$abs.",".$ord.") avec l'axe des abscisses est : ".($abs/$distance);
}
else if($choix == "Sinus"){
    echo "Le sinus de l'angle formé par le point (".$abs.",".$ord.") avec l'axe des ordonnées est : ".($ord/$distance);
}
else if($choix == "Tangente"){
    echo "La tangente de l'angle formé par le point (".$abs.",".$ord.") est : ".($abs/$ord);
}
else if($choix == "Dans le cercle trigonométrique ?"){
    if($distance<1){
        echo "Le point (".$abs.",".$ord.") est dans le cercle trigonométrique";
    }
    if($distance==1){
        echo "Le point (".$abs.",".$ord.") est sur le cercle trigonométrique";
    }
    if($distance>1){
        echo "Le point (".$abs.",".$ord.") est hors du cercle trigonométrique";
    }
}
else{
    echo "rentre des données valides";
}
?>