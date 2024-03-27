 <nav>
        <img class="burger-btn" src="/assets/icons/burger.png">
        <ul class="menu">
            <li><a href="/">Home</a></li>
            <li><a href="contact">Contact</a></li>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['logged']) :  ?> 

                <li><a href="products">Products</a></li>
                <li><a href="profile">Profile</a></li>
                <li><a href="logout">Logout</a></li>
            
            <?php else : ?>
                <li><a href="signup">Signup</a></li>
                <li><a href="login">Login</a></li>
            <?php endif ?>
        </ul>
        <p class="title-nav"><b>PHP ESHOP</b></p>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['logged']) :  ?> 
            <li><a href="cart"><img class="cart-btn" src="/assets/icons/shopping-cart.png"></a>
        <?php endif ?>
    </nav>
    <div class="wrapper">
