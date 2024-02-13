<?php 
session_start();
require_once '../config.php';
require_once '../models/admin.php';


if (!isset($_SESSION['entreprise'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: ../controllers/controller-signin.php');
    exit();
}
elseif (isset($_SESSION['entreprise'])) {
    $nom = $_SESSION['entreprise']['Entreprise_Nom'];
    $photo = $_SESSION['entreprise']['Entreprise_IMG'];
    $Entreprise_ID = $_SESSION['entreprise']['Entreprise_ID'];
    
    
$usersNumber = utilisateurs::countUsers($Entreprise_ID);
$actifsUsers = utilisateurs::countActifsUsers($Entreprise_ID);
$totalTrajets = utilisateurs::countTotalTrajets($Entreprise_ID);
$lastFiveUsers = utilisateurs::lastFiveUsers($Entreprise_ID);
$lastFiveTrajets = utilisateurs::lastFiveTrajets($Entreprise_ID);
}

include_once '../views/view-home.php';