<?php 

// J'inclus la page sur laquelle je fais l'appel API pour récupérer les produits
include "../partials/header.php";

?> 

<section class="livre">
 
    <h1>Library</h1>

    <div class="search-bar">
        <form class="search">
            <input class="search-input" placeholder="Rechercher le livre" required="" type="text">
            <button class="reset" type="reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </form>
        <button class="submit" type="submit" >
            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            Go</button>
        <button class="fav">Mes Livres</button>
    </div>
    <ul class="list"></ul>
</section>

<?php include "../partials/footer.php"; ?>