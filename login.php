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
    private $prenom;
    private $email;

    public function __construct($nom, $prenom, $email)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
    }

    // Getters and Setters for each property
    // ...
}

class Livre
{
    private $titre;
    private $auteur;
    private $isbn;

    public function __construct($titre, $auteur, $isbn)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->isbn = $isbn;
    }

    // Getters and Setters for each property
    // ...
}
// Crée une instance des classes
$user = new Utilisateur("Doe", "John", "john.doe@example.com");
$book = new Livre("The Great Book", "John Doe", "123-4567890123");

// Use the objects
// echo "User: " . $user->getNom() . " " . $user->getPrenom() . ", Email: " . $user->getEmail();
// echo "Book: " . $book->getTitre() . " by " . $book->getAuteur() . ", ISBN: " . $book->getIsbn();