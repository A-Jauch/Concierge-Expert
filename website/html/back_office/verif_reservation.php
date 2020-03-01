<?php
  include '../config.php';

  $nameCategorie = $_POST['name'];
  /*$size = $_POST['size'];
  $time = $_POST['time'];
  $date = $_POST['date'];
  $text = $_POST['text'];*/

  if (isset($_POST['columnName']) && !empty($_POST['columnName'])){
      $columnName = $_POST['columnName'];
    exit;
  }

  else if (isset($_POST['type']) && !empty($_POST['type'])){
      $type = $_POST['type'];
    exit;
  }

  else if ($type === "VARCHAR" || $type === "CHAR"){
    if (isset($_POST['size']) && !empty($_POST['size'])){
      $size = $_POST['size'];
      $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type . "(" . $size . ")");
      $req->execute();
    }else{
      echo "Entrez une taille valide";
      exit;
    }
  }

  else if ($type === "TIMESTAMP"){
    if (isset($_POST['time']) && !empty($_POST['time'])){
      $time = $_POST['time'];
      $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type /*. "(" . $time . ")*/);
      $req->execute();
    }else{
      echo "Entrez une date";
      exit;
    }
  }

  else if ($type === "DATE"){
    if (isset($_POST['date']) && !empty($_POST['date'])){
      $date = $_POST['date'];
      $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type /*. "(" . $date . ")*/);
      $req->execute();
    }else{
      echo "Entrez une date";
      exit;
    }
  }

  else if ($type === "TEXT"){
    if (isset($_POST['text']) && !empty($_POST['text'])){
      $text = $_POST['text'];
      $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type /*. "(" . $text . ")*/);
      $req->execute();
    }else{
      echo "Entrez un texte";
      exit;
    }
  }

  else if ($type === "INT"){
    $newSize = 11;
  $req = $bdd->prepare("ALTER TABLE " . $nameCategorie . " ADD " . $columnName . " ". $type . "(" . $newSize . ")");
    $req->execute();
    exit;
  }

?>
