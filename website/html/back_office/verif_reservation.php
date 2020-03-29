<?php
include '../config.php';

$nameCategorie = $_POST['nameCategorie'];

if (isset($_POST['columnName']) && !empty($_POST['columnName'])){
  $columnName = $_POST['columnName'];
}

if (isset($_POST['type']) && !empty($_POST['type'])){
  $type = $_POST['type'];
}

if ($type === "VARCHAR" || $type === "CHAR"){
  if (isset($_POST['size']) && !empty($_POST['size'])){
    $size = $_POST['size'];
    $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type . "(" . $size . ")");
    $req->execute();
    header("Location: reservation_back.php?service=" . $_GET['service'] );
  }else{
    echo "Entrez une taille valide";
    exit;
  }
}

if ($type === "TIME"){
  $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type);
  $req->execute();
  header("Location: reservation_back.php?service=" . $_GET['service'] );
}else if ($type === "DATE"){
  $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type);
  $req->execute();
  header("Location: reservation_back.php?service=" . $_GET['service'] );
}else if ($type === "TEXT"){
  $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type);
  $req->execute();
  header("Location: reservation_back.php?service=" . $_GET['service'] );
}

if ($type === "INT"){
  $newSize = 11;
  $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type . "(" . $newSize . ")");
  $req->execute();
  header("Location: reservation_back.php?service=" . $_GET['service'] );
  exit;
}

if ($type === "DOUBLE"){
  $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type);
  $req->execute();
  header("Location: reservation_back.php?service=" . $_GET['service'] );
  exit;
}

?>
