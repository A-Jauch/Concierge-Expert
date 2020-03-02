<?php
include '../config.php';
$string = "";
$i = 0;
$variable = array();
foreach ($_POST as $key => $value) {
    $key = $value;
    $variable[$i] = $key;
    $i++;
}

if ( (isset($_POST['columName']) && !empty($_POST['columName']) ) &&
    ( isset($_POST['price']) && !empty($_POST['price']) ) && ( isset($_POST['description']) && !empty($_POST['description']) ) && isset($_FILES['image']) ) {

    $columName = $_POST['columName'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $variable[0];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name']; //Stockage temporaire du fichier
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];

    $fileExtension = explode('.', $fileName); //Scinde une chaîne de caractères en segments (qui sont séparés par un '.')
    $fileActualExtension = strtolower(end($fileExtension)); //end -> récupère la dernière valeur du tableau
    //strtolower -> renvoie une chaine en minuscule

    $allowed = array('jpg', 'jpeg', 'png');
    if (in_array($fileActualExtension, $allowed)) { //On cherche si le type est présent dans notre tableau
        if ($fileError === 0) {
            if ($fileSize < 3000000) { //La taille du fichier doit être inférieur a 3mb
                $fileNameNew = date('Y-m-d-H-i-s'); //Renvoie un identifiant unique
                $fileDestination = 'images/' . $fileNameNew . '.' . $fileActualExtension;
                move_uploaded_file($fileTmpName, $fileDestination);

                for($j=3 ; $j<count($variable)-1 ; $j++){
                  $test = $bdd->prepare("SELECT $variable[$j] FROM " . $variable[count($variable)-1]);
                  $test->execute();
                  $res = $test->getColumnMeta(0);
                  //echo $variable[$j] . " " . $res['native_type'];
                  if($res['native_type'] == "VAR_STRING"){
                    $res['native_type'] = "VARCHAR(255)";
                    $string .= "," . $variable[$j] . " " . $res['native_type'];
                  }else{
                    $string .= "," . $variable[$j] . " " . $res['native_type'];
                  }
                  //echo '<br>';
                }
                echo $string;

                $req = $bdd->prepare("CREATE TABLE " . $variable[0] . "(image VARCHAR(255), serviceName VARCHAR(255) PRIMARY KEY, price DOUBLE, description TEXT". $string . ")");
                $req->execute();

                $req2 = $bdd->prepare("INSERT INTO " . $variable[0] . "(image,serviceName, price, description) VALUES(:image,:serviceName, :price, :description)");
                $req2->execute(array(
                        'image' => htmlspecialchars($fileDestination),
                        'serviceName' => htmlspecialchars($variable[0]),
                        'price' => htmlspecialchars($variable[1]),
                        'description' => htmlspecialchars($variable[2])
                        for($k=0; $k<count($variable)-1 ; $k++){
                          $variable[$k] => htmlspecialchars($variable[$k])
                        }
                    )
                );

                $req3 = $bdd->prepare("INSERT INTO " . $variable[count($variable)-1] . "(name,image) VALUES(:name,:image)");
                $req3->execute(array(
                        'name' => htmlspecialchars($variable[0]),
                        'image' => htmlspecialchars($fileDestination)
                    )
                );

                //header('Location: ../../index.php');

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
        header('Location: reservation_back.php?error=empty');
        exit;
    }

?>
