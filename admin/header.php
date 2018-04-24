<?php

session_start();

include('inc/db.php');
include('inc/functions.php');

if(!isset($_SESSION['username']) && !isset($_SESSION['password']))
{
    header('Location: login.php');
    exit;
}

$admin = new Admin();
$user  = new User();

$user->Logout();

?>
<html>
<head>
    <title>PristonTale | AdminCP</title>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans|Ropa+Sans|Roboto" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome-all.min.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/admincp.css" media="screen,projection">
</head>
<body>

<div class="header-strip">
    <div class="container">
        <div class="row">
            <div class="header-logo col s12 m3">
                Pristontale | AdminCP
            </div>

            <div class="header-menu col s12 m9">
                <ul>
                    <li><a href="index.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "index.php" || "")?"class=\"current-nav\"":""; ?>>Tools</a></li>
                    <li><a href="transactions.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "transactions.php")?"class=\"current-nav\"":""; ?>>Transactions</a></li>
                    <li><a href="purchases.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "purchases.php")?"class=\"current-nav\"":""; ?>>Purchases</a></li>
                    <li><a href="?logout=true" class="red-text">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
