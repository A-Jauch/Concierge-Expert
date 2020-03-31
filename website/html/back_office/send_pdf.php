<?php
require('fpdf.php');
$bdd = new PDO('mysql:host=localhost;dbname=concierge_expert','tedanvi','kLKLxEe8M1EfOdvG');

class PDF extends FPDF{

  private $lastName;
  private $firstName;
  private $phoneNumber;
  private $email;
  private $postalCode;
  private $city;
  private $index;

  // Getters
  public function getLastName(): string{
      return $this->lastName;
  }

  public function getFirstName(): string{
      return $this->firstName;
  }

  public function getPhoneNumber(): string{
      return $this->phoneNumber;
  }

  public function getPostalCode(): string{
      return $this->postalCode;
  }

  public function getEmail(): string{
      return $this->email;
  }

  public function getCity(): string{
      return $this->city;
  }

  public function getIndex(): string{
      return $this->index;
  }

  // En-tête
  function Header(){
      // Logo
      //$this->Image('../../img/logo.png',10,6,30);
      // Police Arial gras 15
      $this->SetFont('Arial','B',15);
      // Décalage à droite
      $this->Cell(80);
      // Titre
      $this->Cell(30,10,'Demande de devis',0,0,'C');
      // Saut de ligne
      $this->Ln(20);
  }

  // Corps de page
  function headerTable(){
    $this->SetFont('Times','B',12);
    $this->Cell(40,10,'Prenom',1,0,'C');
    $this->Cell(40,10,'Nom',1,0,'C');
    $this->Cell(30,10,'Telephone',1,0,'C');
    $this->Cell(40,10,'Adresse email',1,0,'C');
    $this->Cell(40,10,'Adresse postale',1,0,'C');
    $this->Ln();
  }

  function underTable($index){
    echo $index[0];
  }

  // Pied de page
  function Footer(){
      // Positionnement à 1,5 cm du bas
      $this->SetY(-15);
      // Police Arial italique 8
      $this->SetFont('Arial','I',8);
      // Numéro de page
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->headerTable();
  $pdf->underTable($_POST);
  $pdf->Output();

?>
