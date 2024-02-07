<?php
session_start();
require_once '../config.php';
require_once '../models/admin.php';



$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifiez si l'email est défini dans $_POST
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $motDePasse = $_POST['motDePasse'];

    // Vérifiez si l'email est vide
    if (empty($email)) {
        $errors['email'] = 'Veuillez saisir votre email.';
    }

    // Vérifiez si le mot de passe est vide
    if (empty($motDePasse)) {
        $errors['motDePasse'] = 'Veuillez saisir votre mot de passe.';
    }
    if (empty($errors)) {
        // Vérifiez si l'email existe dans la base de données
        if (entreprise::checkMailExists($email)) {
            // Récupérez les informations de l'entreprise
            $entrepriseInfos = entreprise::getInfos($email);

            if (password_verify($motDePasse, $entrepriseInfos['Entreprise_Motdepasse'])) {
                // Stockez les informations de l'entreprise dans la session
                $_SESSION['entreprise'] = $entrepriseInfos;


                header('Location: ../controllers/controller-home.php');
                exit();
            } else {
                $errors['connexion'] = 'Mot de passe incorrect.';
            }
        } else {
            $errors['email'] = 'Entreprise inconnu.';
        }
    }
}


include_once '../views/view-signin.php';