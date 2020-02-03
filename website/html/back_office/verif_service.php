<?php

include '../config.php';

$name = $_POST['name'];

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
        echo '<small> *You file is too big! </small><br>';
        exit;
      }
    } else {
      echo '<small> *There was an error uploading your file! </small><br>';
      exit;
    }
  } else {
    echo '<small> *You cannot upload files of this type! </small><br>';
    exit;
  }

} else {
  echo "<small> *You need to upload a file! </small><br>";
  header('Location:add_service.php?error=1');
  exit;
}

if (isset($name) && empty($name)){
  echo "<small> *Enter a service's name </small><br>";
}

if( isset($name) && !empty($name) ){
  /* Insertion des éléments dans la base de données*/

  $req = $bdd -> prepare("INSERT INTO SERVICE(name, image) VALUES (:name, :image)");
  $req -> execute(array(
      'name' => htmlspecialchars($name),
      'image' => htmlspecialchars($fileDestination)
    )
  );

  header('Location: ../../index.php');

}


 ?>
