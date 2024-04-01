<?php

$servername = "localhost";
$username = "root";
$password = "";
try {
    $bdd = new PDO("mysql:host=$servername;dbname=library-tp", $username, $password);
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur :" . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    if ($email != "" && $motDePasse != "") {
        $requete = $bdd->query("SELECT * FROM utilisateur WHERE email = '$email' AND motDePasse = '$motDePasse'");
        // Verify the password
        $requete = $bdd->query("SELECT * FROM utilisateur WHERE email = '$email'");
        $result = $requete->fetch();
        if ($result && password_verify($motDePasse, $result['motDePasse'])) {
            echo "Connexion réussie";
        } else {
            echo "Erreur lors de la connexion";
        }

        // $result = $requete->fetch();
        // if ($result['ID'] != false) {
        //     echo "Connexion réussie";
        // } else {
        //     echo "Erreur lors de la connexion";
        // }
    } else {
        echo "Veuillez remplir tous les champs";
    }
}



class Utilisateur
{
    private $nom;
    private $email;
    private $motDePasse;

    public function __construct($nom, $email, $motDePasse)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
    }

    public function inscription()
    {
        // Logique pour enregistrer l'utilisateur dans la base de données, par exemple
        echo "L'utilisateur $this->nom s'est inscrit avec l'adresse email $this->email.";
    }

    public function connexion()
    {
        // Logique pour vérifier les informations de connexion et autoriser l'accès, par exemple
        echo "L'utilisateur $this->nom s'est connecté.";
    }
}

class Livre
{
    private $titre;
    private $auteur;
    private $annee;

    public function __construct($titre, $auteur, $annee)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->annee = $annee;
    }

    public function afficherDetails()
    {
        echo "Titre: $this->titre | Auteur: $this->auteur | Année: $this->annee";
    }

    // Autres méthodes pour les livres peuvent être ajoutées ici
}

// Exemple d'utilisation
$utilisateur1 = new Utilisateur($nom, $email, $motDePasse);
$utilisateur1->inscription(); // Appel de la méthode inscription
echo "<br>";
$utilisateur1->connexion(); // Appel de la méthode connexion
echo "<br>";

$livre1 = new Livre($titre, $auteur, $annee);
$livre1->afficherDetails(); // Appel de la méthode afficherDetails
