<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="row">
    <div class="col s12">
        <div class="card blue lighten-2">
            <div class="card-content black-text">
                <span class="card-title">Utilisateurs de l'entreprise :</span>
                <div class="row justify-content-center">
                    <?php foreach ($entrepriseUsers as $user): ?>
                        <div class="col s12 m6 l4">
                            <div class="card-panel">
                                <img src="http://EcoRideUsers.test/assets/img/<?= $user['User_Photo']; ?>"
                                    alt="Photo de profil">
                                <p>Pseudo :
                                    <?= $user['User_Pseudo']; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="controller-home.php">Retour à la page home</a>
            </div>
        </div>
    </div>
</div>

                    </body>
</html>