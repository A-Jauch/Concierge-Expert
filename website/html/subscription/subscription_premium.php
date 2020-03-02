<?php session_start();

require_once '../config.php';

if(isset($_SESSION['mail']) && !empty($_SESSION['mail'])) {
    $req = $bdd -> prepare('SELECT id FROM subscription WHERE idUser = ?');
    $req->execute(array($_SESSION['id']));
    $res = $req->fetch();

    if(empty($res)) {
        $date = date('Y-m-d');
        $req = $bdd -> prepare('INSERT INTO subscription(subscriptionType,idUser,dateStart) VALUES (:subscriptionType, :idUser, :dateStart)');
        $req -> execute(array(
                'subscriptionType' => 'premium',
                'idUser' => $_SESSION['id'],
                'dateStart' => $date
            )
        );
        header('location: ../subscription.php?error=succeed&sub=premium');
        exit;
    } else {
        header('location: ../subscription.php?error=subscribed');
        exit;
    }
} else {
    header('location: ../subscription.php?error=connected');
    exit;
}