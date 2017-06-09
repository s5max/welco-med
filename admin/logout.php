<?php
session_start();

if(isset($_GET['logout']) && $_GET['logout'] == 'yes'){
    // Détruit les entrées "nom", "prenom" et "email" de $_SESSION
    unset($_SESSION['id'], $_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'], $_SESSION['role']); 

    header('Location:../home.php'); // Redirige vers la page voulu
    die(); // On stoppe tout, juste pour être sur :-)
}