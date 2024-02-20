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
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <div class="valign-wrapper">
        <div class="col s12">
            <div class="card red lighten-1">
                <div class="card-content black-text" id="divCards">
                    <span class="card-title">Utilisateurs de l'entreprise :</span>
                    <div class="justify-content-center align-items-center" style="height: 100%;">
                        <?php foreach ($entrepriseUsers as $user): ?>
                            <div class="col-centered">
                                <div class="card-panel blue-grey lighten-5">
                                    <img src="http://EcoRideUsers.test/assets/img/<?= $user['User_Photo']; ?>"
                                        alt="Photo de profil">
                                    <p class="center-align">Pseudo :
                                        <?= $user['User_Pseudo']; ?>
                                    </p>
                                    <!-- Switch -->
                                    <div class="switch">
                                        <label>
                                            Off
                                            <input data-user-id="<?= $user['User_ID'] ?>" type="checkbox"
                                                <?= $user['User_Validate'] == 1 ? "checked" : "" ?>>
                                            <span class="lever"></span>
                                            On
                                        </label>
                                    </div>
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
<script>
    document.addEventListener('click', e => {
        if (e.target.type == 'checkbox') {
            if (e.target.checked == false) {
                console.log('unvalidate')
                fetch(`controller-ajax.php?unvalidate=${e.target.dataset.userId}`)
            } else if (e.target.checked == true) {
                console.log('validate')
                fetch(`controller-ajax.php?validate=${e.target.dataset.userId}`)
            }
        }
    })

</script>

</html>