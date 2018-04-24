<?php

include('header.php');

if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
{
    header('Location: login.php');
    exit;
}

$user = new User();

?>

<div class="container">
    <div class="row">
        <div class="content col s12">
            <div class="menu-line col s12">
                <ul>
                    <li><a href="usercp.php"          <?php echo (basename($_SERVER["PHP_SELF"]) == "usercp.php")?"class=\"current-nav\"":""; ?>>Overview</a></li>
                    <li><a href="change-email.php"    <?php echo (basename($_SERVER["PHP_SELF"]) == "change-email.php")?"class=\"current-nav\"":""; ?>>Change Email</a></li>
                    <li><a href="change-password.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "change-password.php")?"class=\"current-nav\"":""; ?>>Change Password</a></li>
                </ul>
            </div>

            <div class="user-data col s12">
                <label>Account Information</label>
            </div>

            <div class="user-data col s12 m6 l3">
                <i class="fas fa-user"></i> <?php echo ucfirst($user->UserCP($_SESSION['username'], 'userid')); ?>
            </div>

            <div class="user-data col s12 m6 l3">
                <i class="fas fa-envelope"></i> <?php echo $user->UserCP($_SESSION['username'], 'email'); ?>
            </div>

            <div class="user-data col s12 m6 l3">
                <i class="fas fa-shopping-cart"></i> <?php echo $user->Balance($_SESSION['username']); ?> Coins
            </div>

            <div class="user-data col s12 m6 l3">
                <i class="fas fa-server"></i> <?php echo $_SERVER['REMOTE_ADDR']; ?>
            </div>

            <div class="user-data col s12">
                <label>Account Options</label>
            </div>

            <div class="user-data col s12 m6 l3">
                <a href="change-email.php"><i class="fas fa-envelope"></i> Change Email</a>
            </div>

            <div class="user-data col s12 m6 l3">
                <a href="change-password.php"><i class="fas fa-lock"></i> Change Password</a>
            </div>

            <div class="user-data col s12 m6 l3">
                <a href="donate.php"><i class="fas fa-euro-sign"></i> Donate for coins</a>
            </div>

            <div class="user-data col s12 m6 l3">
                <a href="shop.php"><i class="fas fa-shopping-cart"></i> Game Store</a>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
