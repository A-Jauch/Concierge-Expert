<?php
require('fpdf.php');

class PDF extends FPDF{

  private $lastName;
  private $firstName;
  private $phoneNumber;
  private $email;
  private $postalCode;
  private $city;
  private $index;

  // Getter - Setter
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
      $this->Image('../../img/logo.png',10,6,30);
      // Police Arial gras 15
      $this->SetFont('Arial','B',15);
      // Décalage à droite
      $this->Cell(80);
      // Titre
      $this->Cell(30,20,'Voici votre devis',0,0,'C');
      // Saut de ligne
      $this->Ln(20);
  }

  // Corps de page
  function Main($lastName,$firstName,$phoneNumber,$email,$postalCode,$city,$index){

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

// Instanciation de la classe dérivée
/*$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Output();*/

?>
