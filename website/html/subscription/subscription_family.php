<?php session_start();

require_once '../config.php';

if(isset($_SESSION['mail']) && !empty($_SESSION['mail'])) {
    $date = date('Y-m-d');
    $req = $bdd -> prepare('INSERT INTO subscription(subscriptionType,idUser,dateStart) VALUES (:subscriptionType, :idUser, :dateStart)');
    $req -> execute(array(
            'subscriptionType' => 'family',
            'idUser' => $_SESSION['id'],
            'dateStart' => $date
        )
    );
    header('location: ../subscription.php?error=succeed&sub=family');
    exit;
} else {
    header('location: ../subscription.php?error=connected');
    exit;
}