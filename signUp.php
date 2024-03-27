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

// Initialisation de $requete à null
$requete = null;

// Create a new user
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    $corfirmMdp = $_POST['confirmMotDePasse'];
    if ($motDePasse != $corfirmMdp) {
        echo "Les mots de passe ne correspondent pas";
        return;
    } else {
        $motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);
    }

    $requete = $bdd->prepare("INSERT INTO utilisateur (nom, prenom, email, motDePasse) VALUES (:nom, :prenom, :email, :motDePasse)");
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':prenom', $prenom);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':motDePasse', $motDePasse);

    try {
        $requete->execute();
        echo "Inscription réussie";
    } catch (PDOException $e) {
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
