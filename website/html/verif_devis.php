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
  }else{
    header('location:devis.php');
  }

  if( isset($_POST['firstName']) && !empty($_POST['firstName']) ){
    $firstName = $_POST['firstName'];
  }else{
    header('location:devis.php');
  }

  if( isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber']) ){
    $phoneNumber = $_POST['phoneNumber'];
  }else{
    header('location:devis.php');
  }

  if( isset($_POST['email']) && !empty($_POST['email']) ){
    $email = $_POST['email'];
  }

  if( isset($_POST['postalCode']) && !empty($_POST['postalCode']) ){
    $postalCode = $_POST['postalCode'];
  }else{
    header('location:devis.php');
  }

  if( isset($_POST['city']) && !empty($_POST['city']) ){
    $city = $_POST['city'];
  }else{
    header('location:devis.php');
  }

  // Création d'un mail
  $header="MIME-Version: 1.0\r\n";
  $header.='From: "Concierge Expert"<concierge-expert@gmail.com>'."\n";
  $header.='Content-Type:text/html; charset="utf-8"'."\n";
  $header.='Content-Transfer-Encoding: 8bit';

  $message='
  <html>
    <body>
      <div align="center">
        <img src="https://imgur.com/RkXnwYr" width="200px">
        <h1><b>Voici votre devis !</b></h1>
        <a href="https://imgur.com/4altbxl" download="devis">Télécharger votre devis</a>
      </div>
    </body>
  </html>
  ';

  mail($email,"Votre devis",$message, $header);

  // Enregistrement en base de données
  $reqDevis = $bdd -> prepare("INSERT INTO DEVIS(lastName,firstName,phoneNumber,email,postalCode,city,prestationType) VALUE(:lastName,:firstName,:phoneNumber,:email,:postalCode,:city,:prestationType)");
  $reqDevis -> execute(array(
      'lastName' => htmlspecialchars($lastName),
      'firstName' => htmlspecialchars($firstName),
      'phoneNumber' => htmlspecialchars($phoneNumber),
      'email' => htmlspecialchars($email),
      'postalCode' => htmlspecialchars($postalCode),
      'city' => htmlspecialchars($city),
      'prestationType' => htmlspecialchars($index)
    )
  );

  // Création du PDF
  $myPDF = new PDF();
  $myPDF->Header();
  $myPDF->Footer();
  $myPDF->Main($lastName,$firstName,$phoneNumber,$email,$postalCode,$city,$index);
  $myPDF->AliasNbPages();
  $myPDF->AddPage();
  $myPDF->SetFont('Times','',12);
  $myPDF->Output();

  header('Location: ../index.php');


 ?>
