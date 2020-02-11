<?php

var_dump($_POST);

include '../config.php';

$name = $_POST['name'];
$price = $_POST['price'];
$add_index = $_POST['add_index'];

if(isset($_FILES['image']) && !empty($_FILES['image'])){

  /* Récupérer le fichier contenu dans l'input de type file */

  $fileName = $_FILES['image']['name'];
  $fileTmpName = $_FILES['image']['tmp_name']; //Stockage temporaire du fichier
  $fileType = $_FILES['image']['type'];
  $fileSize = $_FILES['image']['size'];
  $fileError = $_FILES['image']['error'];

  $fileExtension = explode('.', $fileName); //Scinde une chaîne de caractères en segments (qui sont séparés par un '.')
  $fileActualExtension = strtolower(end($fileExtension)); //end -> récupère la dernière valeur du tableau
  //strtolower -> renvoie une chaine en minuscule

  $allowed = array('jpg', 'jpeg' ,'png');
  if (in_array($fileActualExtension,$allowed)) { //On cherche si le type est présent dans notre tableau
    if ($fileError === 0) {
      if ($fileSize < 3000000) { //La taille du fichier doit être inférieur a 3mb
        $fileNameNew = date('Y-m-d-H-i-s'); //Renvoie un identifiant unique
        $fileDestination = 'images/' . $fileNameNew . '.' . $fileActualExtension ;
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        echo '<small> *Le fichier est trop volumineux ! </small><br>';
        exit;
      }
    } else {
      echo '<small> *Il y a une erreur avec le fichier! </small><br>';
      exit;
    }
  } else {
    echo '<small> *Vous ne pouvez pas insérer ce type de fichier ! </small><br>';
    exit;
  }

} else {
  echo "<small> *Vous avez besoin d'insérer une image ! </small><br>";
  header('Location:add_service.php?error=1');
  exit;
}

if (isset($price) && empty($price)){
  echo "<small> *Entrez un tarif</small><br>";
}

if (isset($name) && empty($name)){
  echo "<small> *Entrez le nom d'un service </small><br>";
}

if( isset($name) && !empty($name) ){
  /* Insertion des éléments dans la base de données*/

  $req = $bdd -> prepare("INSERT INTO SERVICE(name, image, price, add_index) VALUES (:name, :image, :price, :add_index)");
  $req -> execute(array(
      'name' => htmlspecialchars($name),
      'image' => htmlspecialchars($fileDestination),
      'price' => htmlspecialchars($price),
      'add_index' => htmlspecialchars($add_index)
    )
  );

  header('Location: ../../index.php');

}


 ?>
