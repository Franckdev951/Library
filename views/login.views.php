<?php include "../partials/header.php"; ?>


<section class="logIn">
    <form class="login" method="post" action="login.php">
        <h1>CONNECTEZ-VOUS !</h1>
        <hr />
        <label for="email">Email</label> <input type="email" />
        <label for="password">Mot de passe</label> <input type="password" />
        <input type="submit" name="connect" value="Se connecter" />
        <p>Vous n'avez pas de compte ? <a href="./signup.views.php">Inscrivez-Vous</a></p>
    </form>
</section>

 

<?php include "../partials/footer.php"; ?>