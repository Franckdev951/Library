<?php
include "../partials/header.php";
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
</section>

<?php include "../partials/footer.php"; ?>
