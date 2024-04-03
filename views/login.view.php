<?php 

ob_start();

include "../partials/header.php";
include "../config/db_config.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Le format de l'email n'est pas bon";
        die();
    }

    // Pour vérifier si un mail correspond en BDD
    $sql = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$email]);
    $result = $stmt->fetch();

    if (!$result) {
        $error = "L'email n''existe pas, veuillez vous enregistrer via notre Signup";
    } else {
        $hash = $result['password'];

        if (password_verify($password, $hash)) {
            // On peut démarrer une session
            session_start();
            $_SESSION['user'] = $result;
            $_SESSION['user']['logged'] = true;
            
            // On redirige vers une page home ou profile
            header('Location: ./profile.view.php');
            ob_end_flush();
        } else {
            $error = "Le mot de passe n'est pas le bon";
        }
    }
}
?>

<section>
    <form class="form">
        <p id="heading">Login</p>
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
            <button class="button1">Login</button>
        </div>
        <button class="button3">Forgot Password</button>
        <p>Vous n'avez pas de compte ? <a href="./signup.view.php">Inscrivez-Vous</a></p>
    </form>

</section>


<?php if (isset($error)) : ?> 
    <p class="error"><?= $error ?></p>
<?php endif ?>

<?php 

include "../partials/footer.php";

?>