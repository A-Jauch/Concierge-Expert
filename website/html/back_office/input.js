let columnName = document.getElementsByName("columnName").value;
let size = document.getElementsByName("size").value;
const firstData = document.getElementById("nameCategorie");
firstData.hidden =  true; //comme ça il y aura forcément une colonne dans notre bdd

function verify(){
  let select = document.getElementById("choice");
  let choice = select.selectedIndex;
  let value = select.options[choice].value;

  const container = document.getElementById("newInput");
  const input = document.createElement("input");

  const inputAdded = document.getElementById("inputAdded");

  console.log(value);

  if( value === "CHAR" || value === "VARCHAR"){
    if (inputAdded != null) {
      const parent = inputAdded.parentNode;
      parent.removeChild(inputAdded);
    }
    input.type="number";
    input.name="size";
    input.id="inputAdded";
    input.placeholder="Taille de la variable";
    container.appendChild(input);
  }

  else if( value === "DATE"){
    if (inputAdded != null) {
      const parent = inputAdded.parentNode;
      parent.removeChild(inputAdded);
    }
    /*input.type="date";
    input.name="date";
    input.id="inputAdded";
    container.appendChild(input);*/
  }

  else if( value === "TIMESTAMP"){
    if (inputAdded != null) {
      const parent = inputAdded.parentNode;
      parent.removeChild(inputAdded);
    };
    /*input.type="time";
    input.name="time";
    input.id="inputAdded";
    container.appendChild(input);*/
  }

  else if( value === "TEXT"){
    if (inputAdded != null) {
      const parent = inputAdded.parentNode;
      parent.removeChild(inputAdded);
    }
    /*input.type="text";
    input.name="text";
    input.id="inputAdded";
    input.placeholder="Entrez votre texte";
    container.appendChild(input);*/
  }

  else{
    if (inputAdded != null) {
      const parent = inputAdded.parentNode;
      parent.removeChild(inputAdded);
    };
  }
}

function deplacer(l1,l2,l3) {
 if (l1.options.selectedIndex>=0) {
   let option = new Option(l1.options[l1.options.selectedIndex].text,l1.options[l1.options.selectedIndex].value);
   l2.options[l2.options.length] = option;
   l1.options[l1.options.selectedIndex] = null;
   l3.options[l3.options.length] = option;
   l1.options[l1.options.selectedIndex] = null;
  }else{
     alert("Aucune option sélectionnée");
  }
}

function traitement(){
  newInput();
  deleteBdd();
}

function newInput() {

   let liste = document.getElementById("liste2");
   let listeLength = document.getElementById("liste2").options.length;
   const container = document.getElementById('newInput2');

   const br = document.createElement('br');
   const label = document.createElement('label');
   const input = document.createElement('input');

     for(let i=0; i<listeLength; i++){
       label.innerHTML = liste.options[i].text + " :";
       input.name = liste.options[i].text;
       input.placeholder = liste.options[i].text;
       input.value = liste.options[i].text;

       container.appendChild(label);
       container.appendChild(input);
       container.appendChild(br);
     }

}

// ALTER TABLE new DROP liste.options[i].value
function deleteBdd(){
  let nameCategorie = document.getElementById("inputHidden").value;
  let liste = document.getElementById("liste3");
  let listeLength = document.getElementById("liste3").options.length;
  let array = [];
    for(let i=0; i<listeLength; i++){
      array.push(liste.options[i].value);
      console.log(array[i]);
    }
  //AJAX

  const request = new XMLHttpRequest();
  request.open('POST','delete_column.php');
  request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  request.onreadystatechange = function(){
    if(request.readyState === 4){
      const accept = document.getElementById('accept');
      accept.innerHTML += request.responseText;
    }
  }
  request.send(`array=${array}&nameCategorie=${nameCategorie}`);

  /*for(let j=0; j<listeLength; j++){
    let containerValue = liste.options[j].value;
    console.log(containerValue);
    let container = document.getElementById(containerValue);
    console.log(container);
    const parent = container.parentNode;
    console.log(parent);
    parent.removeChild(container);
  }*/
}

function verifyColumn(){
  const field = document.getElementById("columnName");
  const fieldValue = document.getElementById("columnName").value;
  console.log(fieldValue);
  if( fieldValue == "" ){
    field.style="border: 1.5px solid red;";
  }else{
    field.style="border: 1px solid grey;";
  }
}

function addListe(){
  let nameCategorie = document.getElementById("inputHidden").value;
  console.log(nameCategorie);
  const request = new XMLHttpRequest();
  request.open('POST','verif_reservation.php');
  request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  request.onreadystatechange = function(){
    if(request.readyState === 4){
      const accept = document.getElementById('accept');
      accept.innerHTML += request.responseText;
    }
  }
  request.send(`name=${nameCategorie}`);
}

  /*const container = document.getElementById('accept');
  const inputHidden = document.createElement('input');
  input.type="hidden";
  input.name="nameCategorie";
  input.id="nameCategorie";
  container.appendChild(input);*/
