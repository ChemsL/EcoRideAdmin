<?php

require_once '../config.php';
require_once '../models/admin.php';

$showform = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST["nom"];
    $siret = $_POST["siret"];
    $codePostal = $_POST["codePostal"];
    $adresse = $_POST["adresse"];
    $ville = $_POST["ville"];
    $email = $_POST["email"];
    $motDePasse = $_POST["motDePasse"];

    $motDePasse = $_POST["motDePasse"];
    $cguChecked = isset($_POST["cgu"]) && $_POST["cgu"] === "on";

    $erreurs = array();

    if (empty($nom) || !preg_match("/^[a-zA-Z0-9\s]+$/", $nom)) {
        $erreurs[] = '<i class="bi bi-exclamation-triangle-fill"></i>' . "Merci de renseigner le nom de l'entreprise.";
    }

    if (empty($siret) || !preg_match("/^\d{14}$/", $siret)) {
        $erreurs[] = '<i class="bi bi-exclamation-triangle-fill"></i>' . "Merci de renseigner un numéro de SIRET valide composé de 14 chiffres.";
    }

    if (empty($codePostal) || !preg_match("/^\d{5}$/", $codePostal)) {
        $erreurs[] = '<i class="bi bi-exclamation-triangle-fill"></i>' . "Merci de renseigner le code postale valide composé de 5 chiffres.";
    }

    if (empty($adresse)) {
        $erreurs[] = '<i class="bi bi-exclamation-triangle-fill"></i>' . "Merci de bien vouloir renseigner une adresse valide.";
    }

    if (empty($ville) || !preg_match("/^[a-zA-Z0-9\s\-]+$/", $ville)) {
        $erreurs[] = '<i class="bi bi-exclamation-triangle-fill"></i>' . "Merci de bien vouloir renseigner la ville.";
    }


    if (empty($motDePasse) || strlen($motDePasse) < 8) {
        $erreurs[] = '<i class="bi bi-exclamation-triangle-fill"></i>' . "Le mot de passe doit avoir au moins 8 caractères.";
    }
    $motDePasseConfirmation = $_POST["mot_de_passe_confirmation"];

    if (empty($motDePasseConfirmation) || $motDePasseConfirmation !== $motDePasse) {
        $erreurs[] = '<i class="bi bi-exclamation-triangle-fill"></i>' . "La confirmation du mot de passe ne correspond pas.";
    }

    if (!$cguChecked) {
        $erreurs[] = '<i class="bi bi-exclamation-triangle-fill"></i>' . "Veuillez accepter les CGU pour continuer.";
    }
var_dump($erreurs);
    if (empty($erreurs)) {

        $nom = $_POST["nom"];
        $siret = $_POST["siret"];
        $codePostal = $_POST["codePostal"];
        $adresse = $_POST["adresse"];
        $ville = $_POST["ville"];
        $email = $_POST["email"];
        $motDePasse = $_POST["motDePasse"];

        entreprise::create($nom, $siret, $codePostal, $adresse, $ville, $email, $motDePasse);
        $showform = false;

         header("Location: controller-signin.php");
    }
}



?>

<?php include '../views/view-signup.php' ?>