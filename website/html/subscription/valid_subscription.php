<?php session_start();

require_once '../config.php';

if(isset($_SESSION['mail']) && !empty($_SESSION['mail'])) {
    $req = $bdd -> prepare('SELECT id FROM subscription WHERE idUser = ?');
    $req->execute(array($_SESSION['id']));
    $res = $req->fetch();

    $req2 = $bdd -> prepare('SELECT price FROM subscription_type WHERE name = ?');
    $req2->execute(array($_GET['subscription']));
    $res2 = $req->fetch();

    if(empty($res)) {
        $date = date('Y-m-d');
        $req = $bdd -> prepare('INSERT INTO subscription(subscriptionType,idUser,dateStart,price) VALUES (:subscriptionType, :idUser, :dateStart,:price)');
        $req -> execute(array(
                'subscriptionType' => $_GET['subscription'],
                'idUser' => $_SESSION['id'],
                'dateStart' => $date,
                'price' => $res2['price']
            )
        );
        echo 'ok';
        exit;
    } else {
        header('location: ../subscription.php?error=subscribed');
        exit;
    }
} else {
    header('location: ../subscription.php?error=connected');
    exit;
}
