<?php

// session_start();

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librairie</title>
    <script src="../views/scripts/livre.js" defer></script>
    <link rel="stylesheet" href="../views/style/tarace.css">
    <link rel="stylesheet" href="../views/style/button.css">
    <!-- <link rel="stylesheet" href="../views/style/tamere.css"> -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- <script src="../views/scripts/app.js"></script> -->
</head>
<body>
    <nav>
        <!-- <img class="burger-btn" src="../assets/icons/burger.png"> -->
        <ul class="menu">
            <li>
                <a href="../views/index.view.php">
                    <button class="hoverY" id="btnHome">
                            <img src="../assets/icone/accueil.png" alt=""></a>
                        <span></span>
                    </button>
                </a>
            </li>
            
            <li>
                <a href="../views/livres.view.php">
                    <button class="hoverY" id="btnIndex">
                        <img src="../assets/icone/livre.png" alt=""></a>
                        <span></span>
                    </button>
                </a>
            </li>

           
                <!-- <li><a href="../views/profile.view.php">Profile</a></li>
                <li><a href="../views/contact.view.php">Contact</a></li>
                <li><a href="../views/logout.php">Logout</a></li> -->
                
            
                <li>
                    <a href="../views/login.view.php">
                        <button class="hoverY" id="btnLogin">
                            <img src="../assets/icone/connexion-alt.png" alt=""></a>
                            <span></span>
                        </button>
                    </a>
                </li>
            
        </ul>
        
    </nav>
<div class="wrapper">

