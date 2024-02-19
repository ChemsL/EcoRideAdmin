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

    <?php include_once('../assets/header.php') ?>

    <div class="container">

        <h2 class="date">
            <?php
            $dateDuJour = date("d-m-Y");
            echo "Date du jour : " . $dateDuJour;
            ?>
        </h2>
        <a href="../controllers/controller-profile.php" class="btn">Informations de l'entreprise</a>

        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Bienvenue
                            <?= $nom ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card lime lighten-1">
                    <div class="card-content white-text">
                        <span class="card-title">Nombre d'utilisateurs :
                            <?= $usersNumber ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card orange darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Nombre d'utilisateurs actifs :
                            <?= $actifsUsers ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card red accent-3">
                    <div class="card-content white-text">
                        <span class="card-title">Nombre de trajets :
                            <?= $totalTrajets ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
    <div class="col s12">
        <div class="card blue lighten-2">
            <div class="card-content black-text">
                <span class="card-title">5 derniers utilisateurs :</span>
                <div class="row justify-content-center">
                    <?php foreach ($lastFiveUsers as $user): ?>
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
                <a href="../controllers/controller-utilisateurs.php">Voir tout les utilisateur</a>
            </div>
        </div>
    </div>
</div>


        <div class="row">
            <div class="col s12">
                <div class="card purple accent-3">
                    <div class="card-content black-text">
                        <span class="card-title">5 derniers trajets :</span>
                        <ul class="collection">
                            <?php if ($lastFiveTrajets && count($lastFiveTrajets) > 0): ?>
                                <?php foreach ($lastFiveTrajets as $trajets): ?>
                                    <li class="collection-item">
                                        <span>Distance parcourue :
                                            <?= $trajets['Trajet_DistanceParcourue_KM_']; ?>
                                            KM
                                        </span>
                                        <span>Date :
                                            <?= $trajets['Trajet_Date']; ?>
                                        </span>
                                        <span>Temps :
                                            <?= $trajets['Trajet_Temps']; ?>
                                        </span>
                                        <span>Type de transport :
                                            <?= $trajets['TransportType_Name']; ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="collection-item">Aucun trajet trouvé.</li>
                            <?php endif; ?>


                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card lime darken-3">
                    <div class="card-content white-text">
                        <span class="card-title">Statistiques des moyens de transport :</span>
                        <canvas id="donutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <a href="../controllers/controller-deconnexion.php" class="waves-effect waves-light btn-large">Se
            déconnecter</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Données pour le graphique
        const data = {
            labels: [
                <?php foreach ($trajetsPourcentages as $trajet): ?>
                        '<?= $trajet['type_transport'] ?>',
                <?php endforeach; ?>
            ],
            datasets: [{
                label: 'Pourcentage',
                data: [
                    <?php foreach ($trajetsPourcentages as $trajet): ?>
                            <?= $trajet['pourcentage'] ?>,
                    <?php endforeach; ?>
                ],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(94, 255, 51)',
                    'rgb(255, 51, 233)'
                ],
                hoverOffset: 4
            }]
        };

        // Configuration du graphique
        const config = {
            type: 'doughnut',
            data: data,
        };

        // Création du graphique
        const donutChart = new Chart(document.getElementById('donutChart'), config);
    </script>


</body>

</html>