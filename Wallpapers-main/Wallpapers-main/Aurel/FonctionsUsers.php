<?php
//include 'transMod.php';
// cette fonction cherche l'existence d'un client par son login
// et son mot de passe
// elle retourne soit une chaine vide
// soit nom,prénom,numcompte,solde

session_start();

function existe($login,$password){
    $information="";
	if (($handle = fopen("clients.csv", "r")) !== FALSE){
        while (($data = fgetcsv($handle)) !== FALSE){ 
            if ($data[0]==$login && $data[1]==$password){
                $information=$data[2].",".$data[3].",".$data[4].",".$data[5];
                $_SESSION['time']=time();
            break;
            }
        }
    fclose($handle);
    return $information;
    }
}

function ajouter($login,$password,$nom,$prenom){ // ajouter un utilisateur (fichier csv)
    $information="";
    $information=existe($login,$password);
    $newUser = array(array('$login', $password,$nom,$prenom));
    if($information==""){
        if(($fp = fopen("clients.csv", "a")) !== FALSE){ //le "a" permet d'ouvrir le fichier en mode 'append' (ajout)
            foreach($newUser as $field){
                fputcsv($fp, $field);
            }
        }
        fclose($fp);
    }
}

function supprimer($login, $password){ // supprimer un utilisateur  (fichier csv)
    $file = fopen("data.csv","r");
    $temp = fopen("temp.csv","w");

    $lineNumber = 1;
    while(!feof($file)) {
        $line = fgetcsv($file);
        if($line !== false) {
            if(($login == $line[0]) && ($password == $line[1])){
                return ($lineNumber);
            }
            else {
                $lineNumber++;
            }
        }
    }
    
    //une fois qu'on a identifié la ligne à supprimer, il faut la supprimer. 
    //on va donc parcourir une deuxième fois le fichier, le réécrire dans le fichier "temps.csv"

    $counter = 0;
    while(!feof($file)) {
        $line = fgets($file);
        $counter++;
        if($counter != $lineNumber) {
            fwrite($temp, $line);
        }
    }

    fclose($file);
    fclose($temp);

    unlink("data.csv");
    rename("temp.csv", "data.csv");



}
/*
function modifier(????){
    // modifier un utilisateur (fichier csv)
}

*/ 

// affichage des informations du client ou un message d'erreur
// on donne la définition de explode 

function informations($login,$password){
    $information=existe($login,$password); 
    if ($information!="" && isset($_SESSION['time'])){ 
        $t=time()-$_SESSION['time'];
        $champs = explode(",", $information);
        echo "<center><h4>Informations bancaires</h4></center>";
        echo "<br>"."Date : ".date('d/m/Y');
        echo "<br> Nom : ".$champs[0];
        echo "<br> Prénom : ".$champs[1];
        echo "<br> Numéro compte : ".$champs[2];
        echo "<br> Solde : ".$champs[3];
        //$nb_trans=nb_transaction($champs[2]);
        //echo "<br> Nombre de transactions : ".$nb_trans;
        if ($t>6) {
            session_destroy();
            header("Location:login.php");
          }
          else{ 
            $_SESSION['time']=time();   
          }
    }
    else {
	    echo "Login ou code secret erroné(s)";
        header("Location:login.php");
    }
}

// appel de la fonction principale.


/*
if (isset($_SESSION['time'])){
  $t=time()-$_SESSION['time'];
  if ($t>6) {
    session_destroy();
    header("Location:login.php");
  }
  else{ 
    echo "<h1> Page B </h1>";
    echo "<a href='a.php'> Go to page A </a><br>";
    echo "<a href='c.php'> Go to page C</a><br>";
    $_SESSION['time']=time();   
  }
}
else {
  header("Location:login.php");
}



*/


?>