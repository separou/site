<?php
function distance($x,$y){
    return sqrt($x**2 + $y**2);
}
$choix=$_GET["choix"];
$abs=$_GET["abscisse"];
$ord=$_GET["ordonnée"];
switch($choix){
    case "dist":
        echo "La distance entre le point (".$abs.",".$ord.") et l'origine du repère est : ".distance($abs,$ord);
        break;
    case "sin":
        echo "Le sinus de l'angle formé par le point (".$abs.",".$ord.") est : ".($ord/distance($abs,$ord));
        break;
    case "cos":
        echo "Le cosinus de l'angle formé par le point (".$abs.",".$ord.") est : ".($abs/distance($abs,$ord));
        break;
    case "tan":
        echo "La tangente de l'angle formé par le point (".$abs.",".$ord.") est : ".($ord/$abs);
        break;
    case "cer":
        $dist=distance($abs,$ord);
        if($dist<1){
            echo "Le point (".$abs.",".$ord.") est dans le cercle trigonométrique";
        }
        if($dist==1){
            echo "Le point (".$abs.",".$ord.") est sur le cercle trigonométrique";
        }
        if($dist>1){
            echo "Le point (".$abs.",".$ord.") est hors du cercle trigonométrique";
        }
        break;
    default:
        echo "rentre des points valides";
        break;
}
$abs=$abs+$ord;
echo $abs;
?>