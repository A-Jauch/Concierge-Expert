<?php
  try {
    $bdd = new PDO('mysql:host=localhost:3308;dbname=concierge_expert','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  }
  catch(PDOException $error){
    echo ' Problème de connexion à la base de donnée '.$error;
    die();
  }
?>
