<?php
session_start();

require_once"../models/admin.php";

if (!isset($_SESSION['entreprise'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: ../controllers/controller-signin.php');
    exit();
}else{
    $entreprise_ID = $_SESSION['entreprise']['Entreprise_ID'];
    $photo = $_SESSION['entreprise']['Entreprise_IMG'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['delete'] === 'delete') {
        $Entreprise_ID = $_SESSION['entreprise']['Entreprise_ID'];

        entreprise::deleteAccount($Entreprise_ID);

        session_unset();
        session_destroy();

        header("Location: controller-signin.php");
        exit();
    }}




include_once"../views/view-profile.php";