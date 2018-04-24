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
                <label>Change Email</label>
            </div>

            <form method="POST">
                <div class="input-field col s12">
                    <i class="fas fa-envelope prefix"></i>
                    <input type="text" name="email" id="icon_prefix" class="materialize-textbox">
                    <label for="icon_prefix">New Email</label>
                </div>

                <div class="input-field col s12">
                    <center><div class="g-recaptcha" data-sitekey="6Lcov0cUAAAAAODiqQ1GnEAhPKDxzS0LiX4hdAd4"></div></center>
                </div>

                <div class="input-field col s12 center">
                    <input type="submit" class="btn" name="change" value="Change Email">
                </div>
            </form>

            <div class="response">
                <?php if(isset($_POST['change'])): ?>
                    <?php if(!empty(
                        $_POST['email']
                    )): ?>
                        <?php if(preg_match("/[a-zA-Z0-9-_]+@+[a-zA-Z0-9]+\.+[a-zA-Z]{2,7}/", $_POST['email'])): ?>
                            <?php if($user->Captcha($_SERVER['REMOTE_ADDR'])): ?>
                                <?php if($user->ChangeEmail($_SESSION['username'], $_POST['email'])): ?>
                                    <div class="messagebox col s12 green">
                                        Email has been changed!
                                    </div>
                                <?php else: ?>
                                    <div class="messagebox col s12 red">
                                        Email could not be changed!
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="messagebox col s12 red">
                                    Captcha was incorrect!
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="messagebox col s12 red">
                                Email is not valid!
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="messagebox col s12 red">
                            Fields cant be empty!
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
