<?php

include 'config.php';
require_once('back_office/send_pdf.php');

var_dump($_POST);

  if( isset($_POST['index']) && !empty($_POST['index']) ){
    $index = $_POST['index'];
  }else{
    header('location:devis.php');
  }

  if( isset($_POST['lastName']) && !empty($_POST['lastName']) ){
    $lastName = $_POST['lastName'];
  }else if( isset($_POST['firstName']) && !empty($_POST['firstName']) ){
    $firstName = $_POST['firstName'];
  }else if( isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber']) ){
    $phoneNumber = $_POST['phoneNumber'];
  }else if( isset($_POST['postalCode']) && !empty($_POST['postalCode']) ){
    $postalCode = $_POST['postalCode'];
  }else if( isset($_POST['city']) && !empty($_POST['city']) ){
    $city = $_POST['city'];
  }else{
    header('location:devis.php?error=empty');
  }

  if( isset($_POST['email']) && !empty($_POST['email']) ){
    $email = $_POST['email'];
  }

  header('location:back_office/send_pdf.php');
  exit;

 ?>
