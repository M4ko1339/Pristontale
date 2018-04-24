<?php

session_start();

include('inc/db.php');
include('inc/functions.php');

if(isset($_GET['logout']))
{
    if($_GET['logout'] == 'true')
    {
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

?>
<html>
<head>
    <title>PristonTale</title>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans|Ropa+Sans|Roboto" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/main.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" media="screen,projection">
</head>
<body>

<div class="header">
    <div class="header-banner center">
        <img src="img/banner.png">
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="header-menu">
                <ul class="main-menu">
                    <li><a href="index.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "index.php" || "")?"class=\"current-nav\"":""; ?>>Home</a></li>
                    <!--<li><a href="guides.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "guides.php")?"class=\"current-nav\"":""; ?>>Guides</a></li>-->
                    <li><a href="/forums">Forums</a></li>
                    <!--<li><a href="#">Leaderboards</a></li>-->
		    <li><a href="http://www.xtremetop100.com/in.php?site=1132364908">Vote</a></li>
		    <li><a href="https://discord.gg/tvAT567">Discord</a></li>
		    <li><a href="shop.php">Game Shop</a></li>
                    <!--<li><a href="clans.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "clans.php")?"class=\"current-nav\"":""; ?>>Clans</a></li>-->
                    <li><a href="download.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "download.php")?"class=\"current-nav\"":"class=\"green-text\""; ?>>Download Client</a></li>
                </ul>

                <ul class="account-menu">
                    <?php if(isset($_SESSION['username']) && isset($_SESSION['password'])): ?>
                        <li><a href="usercp.php">My Account</a></li>
                        <li><a href="?logout=true">Logout</a></a></li>
                    <?php else: ?>
                        <li><a href="login.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "login.php")?"class=\"current-nav\"":""; ?>>Login</a></li>
                        <li><a href="register.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "register.php")?"class=\"current-nav\"":""; ?>>Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="event-box green col s12">
                Pristontale.eu is now online!
            </div>
        </div>
    </div>
</div>
