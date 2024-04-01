<?php
include "../partials/header.php";


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
// Create a new user
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];

    $requete = $bdd->prepare("INSERT INTO utilisateurs (nom, prenom, email, motDePasse) VALUES (:nom, :prenom, :email, :motDePasse)");
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

class Utilisateurs
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

?>

<form class="login" method="post" action="login.php">
    <h1>CONNECTEZ-VOUS</h1>
    <hr />
    <label for="email">email</label> <input type="email" />
    <label for="password">mot de passe</label> <input type="password" />
    <input type="submit" name="connect" value="Se connecter" />
    <p>Vous n'avez pas de compte ? <a href="./signup.views.php">Inscrivez-Vous</a></p>
</form>
 

<?php include "../partials/footer.php"; ?>