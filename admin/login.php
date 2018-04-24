<?php

session_start();

include('inc/db.php');
include('inc/functions.php');

if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
    header('Location: index.php');
    exit;
}

$user = new User();

?>
<html>
<head>
    <title>PristonTale | Login</title>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans|Ropa+Sans|Roboto" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome-all.min.css" media="screen,projection">

    <style>
        .login-box
        {
            background-color: #FFF;
            border: 1px #EEE solid;
            margin-top: 50px;
            padding: 10px !important;
        }

        .btn
        {
            margin: 0px !important;
        }

        .response
        {
            margin-top: 10px;
            padding: 0px !important;
        }

        .message
        {
            height: 40px;
            padding: 10px;
            color: #EEE;
            text-align: center;
            border-radius: 3px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="content col s12 m6 l4 offset-m3 offset-l4">
            <div class="login-box col s12">
                <form method="POST">
                    <label>Username</label>
                    <input type="text" name="username" />

                    <label>Password</label>
                    <input type="password" name="password" />

                    <input type="submit" class="btn" name="login" value="Login" />
                </form>
            </div>

            <div class="response col s12">
                <?php if(isset($_POST['login'])): ?>
                    <?php if(!empty($_POST['username']) && !empty($_POST['password'])): ?>
                        <?php if($user->Login($_POST['username'], $_POST['password'])): ?>
                            <?php if($user->Access($_POST['username']) >= 3): ?>
                                <div class="message green">
                                    Logging in!
                                </div>
                                <?php

                                header('Location: index.php');
                                exit;

                                ?>
                            <?php else: ?>
                                <div class="message red">
                                    You dont have access!
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="message red">
                                Username or password was incorrect!
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="message red">
                            Please fill in all fields!
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <!-- Javascript -->
    <script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>
</html>
