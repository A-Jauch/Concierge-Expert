<?php

var_dump($_POST);

include '../config.php';

$i = 0;
$variable = array();
foreach ($_POST as $key => $value) {
    $key = $value;
    $variable[$i] = $key;
    $i++;
}

if ( (isset($_POST['columName']) && !empty($_POST['columName']) ) &&
    ( isset($_POST['price']) && !empty($_POST['price']) ) && ( isset($_POST['description']) && !empty($_POST['description']) ) && ( isset($_FILES['image']) && !empty($_FILES['image']) ) ) {

    $columName = $_POST['columName'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $variable[0];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name']; //Stockage temporaire du fichier
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];

    $fileExtension = explode('.', $image); //Scinde une chaîne de caractères en segments (qui sont séparés par un '.')
    $fileActualExtension = strtolower(end($fileExtension)); //end -> récupère la dernière valeur du tableau
    //strtolower -> renvoie une chaine en minuscule

    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($fileActualExtension, $allowed)) { //On cherche si le type est présent dans notre tableau
        if ($fileError === 0) {
            if ($fileSize < 3000000) { //La taille du fichier doit être inférieur a 3mb
                $fileNameNew = date('Y-m-d-H-i-s'); //Renvoie un identifiant unique
                $fileDestination = 'images/' . $fileNameNew . '.' . $fileActualExtension;
                move_uploaded_file($fileTmpName, $fileDestination);

                $req = $bdd->prepare("CREATE TABLE " . $variable[1] . "(image VARCHAR(255), serviceName VARCHAR(255) PRIMARY KEY, price DOUBLE, description TEXT)");
                $req->execute();

                $req2 = $bdd->prepare("INSERT INTO " . $variable[1] . "(image,serviceName, price, description) VALUES(:image, :serviceName, :price, :description)");
                $req2->execute(array(
                        'image' => htmlspecialchars($variable[0]),
                        'serviceName' => htmlspecialchars($variable[1]),
                        'price' => htmlspecialchars($variable[2]),
                        'description' => htmlspecialchars($variable[3])
                    )
                );

                $req3 = $bdd->prepare("INSERT INTO " . $variable[4] . "(name) VALUES(:name)");
                $req3->execute(array(
                        'name' => htmlspecialchars($variable[1])
                    )
                );

            } else {
                header('Location: reservation_back.php?error=size');
                exit;
            }
          } else {
              header('Location: reservation_back.php?error=corrupted');
              exit;
          }
      } else {
          header('Location: reservation_back.php?error=type');
          exit;
      }

    } else {
        echo '$_FILES : ' . $_FILES['image']['name'];
        //header('Location: reservation_back.php?error=empty');
        exit;
    }

?>
