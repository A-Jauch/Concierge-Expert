<?php session_start();

if(isset($_SESSION['mail']) && !empty($_SESSION['mail'])) {

} else {
    header('location: ../subscription.php?error=connected');
    exit;
}