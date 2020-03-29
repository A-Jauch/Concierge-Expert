<?php

  try {
    $bdd = new PDO('mysql:host=localhost;dbname=concierge_expert','tedanvi','kLKLxEe8M1EfOdvG',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  }
  catch(PDOException $error){
    echo ' Problème de connexion à la base de donnée '.$error;
    die();
  }
?>
