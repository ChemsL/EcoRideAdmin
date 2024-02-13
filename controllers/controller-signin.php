<?php
session_start();
require_once '../config.php';
require_once '../models/admin.php';
require_once '../autoload.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // $remoteIp = $_SERVER['REMOTE_ADDR'];
    $secret = "6LcQiHEpAAAAAKCw6EBRQk47174rmRpEcglFfyEQ";
    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    $gRecaptchaResponse = $_POST['g-recaptcha-response'];
    // var_dump($gRecaptchaResponse);
    $resp = $recaptcha->setExpectedHostname('ecoRideAdmin.test')
        ->verify($gRecaptchaResponse);
        $recaptcha = false;
    if ($resp->isSuccess()) {
        $recaptcha = true;
        var_dump("success");
    } else {
        $errors['recaptcha'] = $resp->getErrorCodes();
        $recaptcha = false;
        var_dump($errors);
    }

    // Vérification des champs email et mot de passe
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $motDePasse = $_POST['motDePasse'];

    if (empty($email)) {
        $errors['email'] = 'Veuillez saisir votre email.';
    }

    if (empty($motDePasse)) {
        $errors['motDePasse'] = 'Veuillez saisir votre mot de passe.';
    }

    // Si le captcha est valide et les champs email et mot de passe sont corrects, procédez à la vérification de l'entreprise
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
            $errors['email'] = 'Entreprise inconnue.';
        }
    }
}

include_once '../views/view-signin.php';
?>