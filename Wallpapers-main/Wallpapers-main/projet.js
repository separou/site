function supprimer(){
        var recette=document.getElementById('sup').value.trim();
            var lg=recette.length-1;
            recette=recette.substr(0,1).toUpperCase()+recette.substr(1,lg).toLowerCase();
            var select=document.getElementById('liste_recette');
            for(i=0;i<select.length;i++)
                if (recette == select.children[i].text && select.children[i].value!=0) {
                    select.removeChild(select.children[i]);
                    alert("Recette supprimée!");
                    document.getElementById('sup').value="";
                    return;
                }
                alert("Recette non existante");
    }

function modifier(element) {
    var recette = prompt("Entrez la modification pour la recette :", element.textContent);
    if (recette !== null) {
    var lg = recette.length;
    recette = recette.substr(0, 1).toUpperCase() + recette.substr(1, lg).toLowerCase();
    var select = document.getElementById('liste_recette');
    for (var i = 0; i < select.length; i++){
      if (recette === select.children[i].text){
        alert("La recette existe déjà dans la liste");
        return;
      }
    }
    element.textContent = recette;
    alert("La recette a été modifiée avec succès !");
  }
}
function ajouter() {
  var recette = document.getElementById('add').value.trim();
  var lg = recette.length;
  recette = recette.substr(0, 1).toUpperCase() + recette.substr(1, lg).toLowerCase();
  var select = document.getElementById('liste_recette');
  for (var i = 0; i < select.length; i++) {
    if (recette === select.children[i].text) {
      alert("Recette déjà existante");
      return;
    }
  }
  var element = document.createElement('option');
  var texte = document.createTextNode(recette);
  element.appendChild(texte);
  select.appendChild(element);
  element.addEventListener('click', function(){
    modifier(this);
  });
  alert("Insertion réussie");
  document.getElementById('add').value = "";
}

//version avec parametre
function chargerCSV(){
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var lignes = this.responseText.split("\n");
                    for(var i = 0; i < lignes.length; i++){
                        if(lignes[i] !== ""){
                            var element = document.createElement('option');
                            var texte = document.createTextNode(lignes[i].trim());
                            element.appendChild(texte);
                            document.getElementById('liste_recette').appendChild(element);
                        }
                    }
                }
            };
            xhr.open("GET", "recettes.csv", true);
            xhr.send();
        }

    function supprimer(){
        var recette=document.getElementById('sup').value.trim();
            var lg=recette.length-1;
            recette=recette.substr(0,1).toUpperCase()+recette.substr(1,lg).toLowerCase();
            var select=document.getElementById('liste_recette');
            for(i=0;i<select.length;i++)
                if (recette == select.children[i].text && select.children[i].value!=0)
                {
                    select.removeChild(select.children[i]);
                    alert("Recette supprimée!");
                    document.getElementById('sup').value="";
                    return;
                }
                alert("Recette non inscrite dans la base");
    }

    function affiche(){
        var select=document.getElementById('liste_recette');
        var index=select.selectedIndex;
        var recette=select.children[index].text;
        var win = window.open("","_blank","width=500,height=500");
        win.document.write('<h1>'+recette+'</h1>');
        recette='../Dossier personnel/'+recette+".jpg";
    }

    function ajouter(){
      var recette = document.getElementById('add').value.trim();
      var lg = recette.length;
      recette = recette.substr(0, 1).toUpperCase() + recette.substr(1, lg).toLowerCase();
      var select = document.getElementById('liste_recette');
      for (var i = 0; i < select.length; i++) {
        if (recette === select.children[i].text) {
          alert("Recette existe dans la base");
          return;
        }
      }
      var element = document.createElement('option');
      var texte = document.createTextNode(recette);
      element.appendChild(texte);
      select.appendChild(element);
    }
