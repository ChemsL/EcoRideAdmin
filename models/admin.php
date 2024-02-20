<?php

class entreprise
{

    /**
     * Méthode pour créer un utilisateur.
     * @param string $nom Nom de l'entreprise
     * @param string $siret Prénom de l'entreprise
     * @param string $codePostal Pseudo de l'utilisateur
     * @param string $adresse Date de naissance de l'utilisateur
     * @param string $ville Adresse mail de l'utilisateur
     * @param string $email Mot de passe de l'utilisateur
     * @param string $motDePasse Entreprise de l'utilisateur
     */

    public static function create(string $nom, string $siret, string $codePostal, string $adresse, string $ville, string $email, string $motDePasse)
    {
        // Tentative de connexion à la base de données
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
        ;

        try {
            // Préparation de la requête SQL
            $requete = $connexion->prepare("INSERT INTO `entreprise` (Entreprise_Nom, Entreprise_siret, Entreprise_CP, Entreprise_adresse, Entreprise_Ville, Entreprise_Mail, Entreprise_MotDePasse) 
                                       VALUES (:nom, :siret, :codePostal, :adresse, :ville, :email, :motDePasse)");

            // Liaison des paramètres
            $requete->bindValue(':nom', htmlspecialchars($nom), PDO::PARAM_STR);
            $requete->bindValue(':siret', htmlspecialchars($siret), PDO::PARAM_STR);
            $requete->bindValue(':codePostal', htmlspecialchars($codePostal), PDO::PARAM_STR);
            $requete->bindValue(':adresse', $adresse, PDO::PARAM_STR);
            $requete->bindValue(':ville', $ville, PDO::PARAM_STR);
            $requete->bindValue(':email', $email, PDO::PARAM_STR);
            $requete->bindValue(':motDePasse', password_hash($motDePasse, PASSWORD_DEFAULT), PDO::PARAM_STR);


            // Exécution de la requête
            $requete->execute();
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
        }
    }
    /**
     * Methode permettant de récupérer les informations d'un utilisateur avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'utilisateur
     * 
     * @return bool
     */
    public static function checkMailExists(string $email): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `entreprise` WHERE `Entreprise_Mail` = :email";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':email', $email, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on vérifie si le résultat est vide car si c'est le cas, cela veut dire que le mail n'existe pas
            if (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
    /**
     * Methode permettant de récupérer les infos d'un utilisateur avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'utilisateur
     * 
     * @return array Tableau associatif contenant les infos de l'utilisateur
     */
    public static function getInfos(string $email): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `entreprise` WHERE `Entreprise_Mail` = :email";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':email', $email, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
    /**
     * Méthode pour récupérer le mot de passe d'un utilisateur par son email.
     * 
     * @param string $email Adresse mail de l'utilisateur
     * 
     * @return string|false Retourne le mot de passe si l'utilisateur est trouvé, sinon false.
     */
    public static function getPasswordByEmail(string $email)
    {
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $connexion->prepare("SELECT Entreprise_Motdepasse FROM utilisateur WHERE Entreprise_Mail = :email");
            $requete->bindValue(':email', $email, PDO::PARAM_STR);
            $requete->execute();

            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            return ($resultat !== false) ? $resultat['Entreprise_Motdepasse'] : false;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
    public static function updateProfile(int $Entreprise_ID, string $nom, string $siret, string $codePostal, string $adresse, string $ville, string $photo)
    {
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $connexion->prepare("UPDATE entreprise SET Entreprise_Nom = :Entreprise_Nom, Entreprise_siret = :Entreprise_siret, Entreprise_CP = :Entreprise_CP, Entreprise_adresse = :Entreprise_adresse, Entreprise_Ville = :Entreprise_Ville,Entreprise_IMG = :Entreprise_IMG WHERE Entreprise_ID = :Entreprise_ID");


            $requete->bindValue(':Entreprise_Nom', htmlspecialchars($nom), PDO::PARAM_STR);
            $requete->bindValue(':Entreprise_siret', htmlspecialchars($siret), PDO::PARAM_STR);
            $requete->bindValue(':Entreprise_CP', htmlspecialchars($codePostal), PDO::PARAM_STR);
            $requete->bindValue(':Entreprise_adresse', htmlspecialchars($adresse), PDO::PARAM_STR);
            $requete->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);
            $requete->bindValue(':Entreprise_Ville', htmlspecialchars($ville), PDO::PARAM_INT);
            $requete->bindValue(':Entreprise_IMG', htmlspecialchars($photo), PDO::PARAM_STR);
            $requete->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    public static function addPhoto(int $Entreprise_ID, string $photo)
    {
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $connexion->prepare("UPDATE entreprise SET Entreprise_Photo = :Entreprise_Photo WHERE Entreprise_ID = :Entreprise_ID");
            $requete->bindValue(':Entreprise_Photo', $photo, PDO::PARAM_STR);
            $requete->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);
            $requete->execute();

            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            return $resultat;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    public static function deleteAccount(int $Entreprise_ID)
    {
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            // Préparation de la requête SQL
            $requete = $connexion->prepare("DELETE FROM entreprise WHERE Entreprise_ID = :Entreprise_ID");
            $requete->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);

            // Exécution de la requête
            $requete->execute();

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données ou erreur d'insertion : " . $e->getMessage());
        }
    }

    public static function checkSiretExists(string $siret)
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT `Entreprise_siret` FROM `entreprise` WHERE `Entreprise_siret` = :Entreprise_siret";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':Entreprise_siret', $siret, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

}

class utilisateurs
{

    public static function countUsers(int $Entreprise_ID)
    {
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparation de la requête SQL
            $requete = $connexion->prepare("SELECT COUNT(User_ID) AS user_count FROM utilisateur WHERE Entreprise_ID = :Entreprise_ID");
            $requete->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);

            // Exécution de la requête
            $requete->execute();

            // Récupération du résultat
            $result = $requete->fetch(PDO::FETCH_ASSOC);

            $json_result = json_encode($result['user_count']);

            // Retourner le résultat
            return $json_result;

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données ou erreur d'insertion : " . $e->getMessage());
        }
    }

    public static function countActifsUsers(int $Entreprise_ID)
    {
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparation de la requête SQL
            $requete = $connexion->prepare("SELECT COUNT(DISTINCT utilisateur.User_ID) AS user_count FROM utilisateur INNER JOIN trajet ON utilisateur.User_ID = trajet.User_ID WHERE utilisateur.Entreprise_ID = :Entreprise_ID");
            $requete->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);

            // Exécution de la requête
            $requete->execute();

            // Récupération du résultat
            $result = $requete->fetch(PDO::FETCH_ASSOC);

            // Retourner le résultat
            return $result['user_count'];

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données ou erreur d'insertion : " . $e->getMessage());
        }
    }


    public static function countTotalTrajets(int $Entreprise_ID)
    {
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparation de la requête SQL
            $requete = $connexion->prepare("SELECT COUNT(trajet_id) AS trajet_count
            FROM trajet INNER JOIN utilisateur ON utilisateur.User_ID = trajet.User_ID WHERE Entreprise_ID = :Entreprise_ID");
            $requete->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);

            // Exécution de la requête
            $requete->execute();

            // Récupération du résultat
            $result = $requete->fetch(PDO::FETCH_ASSOC);

            // Retourner le résultat
            return $result['trajet_count'];

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données ou erreur d'insertion : " . $e->getMessage());
        }
    }
    public static function lastFiveUsers(int $Entreprise_ID)
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT User_Pseudo, User_Photo  
        FROM utilisateur 
        WHERE Entreprise_ID = :Entreprise_ID 
        ORDER BY User_ID DESC 
        LIMIT 5";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);


            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchALL(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    public static function entrepriseUsers(int $Entreprise_ID)
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * 
        FROM utilisateur 
        WHERE Entreprise_ID = :Entreprise_ID 
        ORDER BY User_ID DESC ";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);


            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchALL(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    public static function lastFiveTrajets(int $Entreprise_ID)
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT trajet.Trajet_DistanceParcourue_KM_, trajet.Trajet_Date, trajet.Trajet_Temps, transporttype.TransportType_Name
            FROM trajet 
            INNER JOIN transporttype ON trajet.TansportType_ID = transporttype.TansportType_ID
            INNER JOIN utilisateur ON utilisateur.User_ID = trajet.User_ID
            WHERE utilisateur.Entreprise_ID = :Entreprise_ID
            ORDER BY trajet.Trajet_Date DESC
            LIMIT 5";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);


            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchALL(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
    public static function getUserPhoto(int $User_ID, string $photoUser)
    {
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $connexion->prepare("SELECT User_Photo FROM utilisateur WHERE User_ID = :User_ID");
            $requete->bindValue(':User_Photo', $photoUser, PDO::PARAM_STR);
            $requete->bindValue(':User_ID', $User_ID, PDO::PARAM_INT);
            $requete->execute();

            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            return $resultat;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * méthode pour valider l'utilisateur
     * 
     * @param int $User_ID id de l'user
     * @return bool
     */
    public static function validate(int $User_ID): bool
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $sql = "UPDATE `utilisateur` SET `User_Validate` = 1 WHERE `User_ID` = :User_ID";
            $query = $db->prepare($sql);

            $query->bindValue(':User_ID', $User_ID, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();        }
    }

    /**
     * méthode pour désactiver l'utilisateur
     * 
     * @param int $User_ID id de l'user
     * @return bool
     */
    public static function unvalidate(int $User_ID): bool
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);
            $sql = "UPDATE `utilisateur` SET `User_Validate` = 0 WHERE `User_ID` = :User_ID";
            $query = $db->prepare($sql);

            $query->bindValue(':User_ID', $User_ID, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }


}

class trajets
{
    public static function trajetsPourcentages($Entreprise_ID)
    {

        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, USERPSEUDO, USERPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT transporttype.TransportType_Name AS type_transport, COUNT(trajet.TansportType_ID) AS nombre_trajets, 
            ROUND(COUNT(trajet.TansportType_ID) * 100.0 / (SELECT COUNT(*) FROM trajet), 2) AS pourcentage
            FROM trajet
            INNER JOIN transporttype ON trajet.TansportType_ID = transporttype.TansportType_ID
            NATURAL JOIN utilisateur
            WHERE Entreprise_ID = :Entreprise_ID
            GROUP BY trajet.TansportType_ID
            
            ";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            $query->bindValue(':Entreprise_ID', $Entreprise_ID, PDO::PARAM_INT);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchALL(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }

    }



}
