<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>sign in</title>
</head>
    

<body>
    <a href="../controllers/controller-signup.php"
        >S'inscrire</a>
    <div class="bodyConnect">

        <h1">SE CONNECTER</h1>



        <form  action="../controllers/controller-signin.php"
            method="post" novalidate>
            <label class="text-purple-200" for="email">Adresse mail :</label><br>
            <input
                type="text" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>" required> <span>
                <?= $errors['email'] ?? '' ?>
            </span><br>
            <label class="text-purple-200" for="motDePasse">Mot de passe :</label><br>
            <input
                type="password" id="motDePasse" name="motDePasse" required><span>
                <?= $errors['motDePasse'] ?? '' ?>
            </span><br>
            <p>
                <?= $errors['connexion'] ?? '' ?>
            </p>
            <div class="g-recaptcha" data-sitekey="6LcQiHEpAAAAAN5JBC8uUsjOkwrkCWU-kL3dBIBP"></div>
      <br/>
      <?= $errors['captcha'] ?? '' ?><br>
            <input
                type="submit" value="Se connecter">

        </form>


    </div>

</body>

</html>