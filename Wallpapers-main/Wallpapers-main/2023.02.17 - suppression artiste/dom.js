function changer(){
    d1=document.getElementById("d1").style;
    d2=document.getElementById("d2").style;
    d3=document.getElementById("d3").style;
    d1.background="blue";
    d2.visibility="hidden";
    d3.width="192px";
    d3.height="192px";
    d3.border="4px dashed green";
    document.getElementById('bt').style.display="none";
}

function ajouter(){
    var artiste=document.getElementById('add').value.trim();
    var lg=artiste.length;
    artiste=artiste.substr(0,1).toUpperCase()+artiste.substr(1,lg).toLowerCase();
    var select=document.getElementById('liste_artiste');
    for(i=0; i<select.length;i++){
        if(artiste == select.children[i].text){
            alert("artiste existe dans la base");
            return;
        }
    }
    var element=document.createElement('option');
    var texte=document.createTextNode(artiste);
    element.appendChild(texte);
    select.appendChild(element);
    alert("Insertion réussie");
    document.getElementById('add').value="";
}

function supprimer(){
    var artiste=document.getElementById('sup').value.trim();
    var lg=artiste.length-1;
    artiste=artiste.substr(0,1).toUpperCase()+artiste.substr(1,lg).toLowerCase();
    var select=document.getElementById('liste_artiste');
    for(i=0; i<select.length;i++){
        if(artiste == select.children[i].text && select.children[i].value!=0){
            select.removeChild(select.children[i]);
            alert("artiste supprimé");
            document.getElementById('sup').value="";
            return;
        }
    }
    alert("Artiste non inscrit dans la base");
}