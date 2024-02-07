<body>



    <a href="../controllers/controller-signin.php"
        class="lg:w1-6 sm:w-1/4 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 mt-20 mx-0">Se
        connecter</a>

    <div class="bodyInscription">
        <h1>S'INSCRIRE</h1>

        <?php if ($showform) { ?>


            <form class="flex justify-center items-center flex-col" action="" method="post" novalidate>

                <label class="text-purple-200" for="nom">Nom de l'entreprise:</label><br>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-1/4 sm:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" id="nom" name="nom" value="<?php if (!empty($nom)) {
                        echo $nom;
                    } ?>" required><br>

                <label class="text-purple-200" for="siret">Numéro de siret de l'entreprise:</label><br>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-1/4 sm:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" id="siret" name="siret" value="<?php if (!empty($siret)) {
                        echo $siret;
                    } ?>" required><br>

                <label class="text-purple-200" for="codePostal">Code postale :</label><br>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-1/4 sm:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" id="codePostal" name="codePostal" value="<?php if (!empty($codePostal)) {
                        echo $codePostal;
                    } ?>" required><br>

                <label class="text-purple-200" for="adresse">Adresse :</label><br>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-1/4 sm:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" id="adresse" name="adresse" value="<?php if (!empty($adresse)) {
                        echo $adresse;
                    } ?>" required><br>


                <label class="text-purple-200" for="ville">Ville :</label><br>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-1/4 sm:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" id="ville" name="ville" value="<?php if (!empty($ville)) {
                        echo $ville;
                    } ?>" required><br>


                <label class="text-purple-200" for="email">Email :</label><br>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-1/4 sm:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="email" id="email" name="email" value="<?php if (!empty($email)) {
                        echo $email;
                    } ?>" required><br>

                <label class="text-purple-200" for="motDePasse">Mot de passe :</label><br>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-1/4 sm:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="password" id="motDePasse" name="motDePasse" required><br>

                <label class="text-purple-200" for="mot_de_passe_confirmation">Confirmer le mot de passe :</label><br>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-1/4 sm:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="password" id="mot_de_passe_confirmation" name="mot_de_passe_confirmation" required><br>

            <?php } ?>


            <label for="cgu">Accepter les CGU :</label>
            <input type="checkbox" id="cgu" name="cgu" required>
            <label for="cgu">J'ai lu et j'accepte les CGU.</label><br>


            <input
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm lg:w-1/4 sm:w-1/2 px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                type="submit" value="S'inscrire">

            <?php
            // Affichage des erreurs s'il y en a
            if (!empty($erreurs)) {
                echo "<div class='errors' >";
                foreach ($erreurs as $erreur) {
                    echo "<p>$erreur</p>";
                }
                echo "</div>";
                $nom;
            }
            ?>

        </form>

    </div>

</body>

</html>