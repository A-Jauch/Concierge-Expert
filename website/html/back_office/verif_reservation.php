<?php
  include '../config.php';

  var_dump($_POST);
  $nameCategorie = $_POST['nameCategorie'];
  /*$size = $_POST['size'];
  $time = $_POST['time'];
  $date = $_POST['date'];
  $text = $_POST['text'];*/

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
      header('Location: reservation_back.php');
    }else{
      echo "Entrez une taille valide";
      exit;
    }
  }

  if ($type === "TIMESTAMP"){
    if (isset($_POST['time']) && !empty($_POST['time'])){
      $time = $_POST['time'];
      $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type /*. "(" . $time . ")*/);
      $req->execute();
      header('Location: reservation_back.php');
    }else{
      echo "Entrez une date";
      exit;
    }
  }

  if ($type === "DATE"){
    if (isset($_POST['date']) && !empty($_POST['date'])){
      $date = $_POST['date'];
      $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type /*. "(" . $date . ")*/);
      $req->execute();
      header('Location: reservation_back.php');
    }else{
      echo "Entrez une date";
      exit;
    }
  }

  if ($type === "TEXT"){
    if (isset($_POST['text']) && !empty($_POST['text'])){
      $text = $_POST['text'];
      $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type /*. "(" . $text . ")*/);
      $req->execute();
      header('Location: reservation_back.php');
    }else{
      echo "Entrez un texte";
      exit;
    }
  }

  if ($type === "INT"){
    $newSize = 11;
    $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type . "(" . $newSize . ")");
    $req->execute();
    header('Location: reservation_back.php');
    exit;
  }

  if ($type === "DOUBLE"){
    $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type);
    $req->execute();
    header('Location: reservation_back.php');
    exit;
  }

?>
