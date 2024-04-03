<?php 

// Comme on envoit/modifie des en-tetes successivement (avec les include et le header(location) plus bas)
// On crée à partir de cette ligne une zone tampon qui se termine après notre redirection 
// Cela permet d'envoyer en une seule pièce le code ci-dessous
ob_start();

include "../partials/header.php";
include "../config/db_config.php";
include "../utils/functions.php";

// On vérifie que le form ait été soumis
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // On vérifie que TOUS les champs soient bien remplis
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm'])) {

        // Pour name on échappe les carcatères spéciaux
        $name = htmlspecialchars($_POST['name']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];

        // Si les mdp sont les memes
        if ($password === $confirm) {
            // On vérifie le format de l'email 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Le format de l'email n'est pas bon";
                die();
            }

            // Expression régulières pour vérifier le format du mdp 
            $regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{12,}$/";
            // Fonction pour vérifier une regex sur une string preg_match()
            $passValid = preg_match($regex, $password);

            if ($passValid) {

                // Avant d'envoyer le mdp en bdd il faut le hasher !
                $hash = password_hash($password, PASSWORD_DEFAULT);

                // Avec checkExists (importée depuis functions.php) on vérifie si le name ou email 
                // n'existe pas déjà en BDD
                if (checkExists('name', $name, $pdo)) {    
                    $error = "Le nom est déjà pris";
                } else if (checkExists('email', $email, $pdo)) {
                    $error = "L'email est déjà pris";
                } else {
                    // Écrire une requete préparée avec pdo
                    $sql = "INSERT INTO utilisateurs(name, email, password) VALUES(?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute([$name, $email, $hash]);

                    // Afficher les erreurs si il y en a, sinon un message de succès 
                    if ($result) {
                        // On redirige vers une page de succès 
                        header('Location: ./signup-sucess.view.php');
                        // On termine notre zone tampon
                        ob_end_flush();
                    } else {
                        $error = "Erreur pendant l'ajout : " . $stmt->errorInfo();
                    } 
                }
            } else {
                $error = "Le format du mot de passe n'est pas le bon. Il doit faire 12 caractères au minimum et inclure une minuscule, une majuscule, un chiffre et un des caractères spéciaux suivants : #?!@$ %^&*-";
            }
        } else {
            $error = "Les mots de passe doivent etre identiques";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
} 
?>


<section class=signup>
    
    <form class="signup-form" method="POST" action="signUp.php">
        <h1>Inscrivez-vous</h1>
        <label for="nom">Nom</label>
        <input type="text" name="name" placeholder="Votre nom ici ..." required>

        <label for="firstname">Prénom</label>
        <input name="prenom" type="text" placeholder="Votre prénom ici.." required />
        
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Votre email ici ...">
        
        <label for="password">Mot de passe</label>
        <input type="password" name="motDePasse" placeholder="Votre mot de passe ici ...">
    
        <input type="password" name="confirm" placeholder="Votre confirmation du mot de passe...">
        
        <input class="submit" type="submit" name="submit" value="signup">

        <p> Vous avez déjà un compte ? <a href="./login.views.php">Connectez-Vous</a></p>
    </form>

    <form class="signup-form">
        <p id="heading">Inscrivez-Vous</p>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
            </svg>
            <input autocomplete="off" placeholder="Email" class="input-field" type="text">
        </div>
        <div class="field">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
            </svg>
            <input placeholder="Password" class="input-field" type="password">
        </div>
        <div class="btn">
            <button class="submit">Signup</button>
        </div>
        <p>Vous avez déja un compte ? <a href="./login.view.php">Connectez-Vous</a></p>
    </form>
</section>

<?php if (isset($error)) : ?> 
    <p class="error"><?= $error ?></p>
<?php endif ?>

<?php 

include "../partials/footer.php";

?>