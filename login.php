<?php

include('header.php');

$user = new User();

?>

<div class="container">
    <div class="row">
        <div class="content col s12">
            <div class="usercp col s12">
                <form method="POST">
                    <div class="input-field col s12">
                        <i class="fas fa-user prefix"></i>
                        <input type="text" name="username" id="icon_prefix" class="materialize-textbox">
                        <label for="icon_prefix">Username</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="fas fa-lock prefix"></i>
                        <input type="password" name="password" id="icon_prefix" class="materialize-textbox">
                        <label for="icon_prefix">Password</label>
                    </div>

                    <div class="input-field col s12">
                        <center><div class="g-recaptcha" data-sitekey="6Lcov0cUAAAAAODiqQ1GnEAhPKDxzS0LiX4hdAd4"></div></center>
                    </div>

                    <div class="input-field col s12 center">
                        <input type="submit" class="btn" name="login" value="Login">
                    </div>
                </form>
            </div>

            <div class="response">
                <?php if(isset($_POST['login'])): ?>
                    <?php if(!empty(
                        $_POST['username'] ||
                        $_POST['password']
                    )): ?>
                        <?php if(preg_match("/^[a-zA-Z0-9]{2,8}$/", $_POST['username'])): ?>
                            <?php if(preg_match("/^[a-zA-Z0-9]{2,8}$/", $_POST['password'])): ?>
                                <?php if($user->Captcha($_SERVER['REMOTE_ADDR'])): ?>
                                    <?php if($user->Login($_POST['username'], $_POST['password'])): ?>
                                        <?php header('Location: usercp.php'); ?>
                                        <?php exit; ?>
                                    <?php else: ?>
                                        <div class="messagebox col s12 red">
                                            <?php $log->Action($_POST['username'], 'Login', 'Tried logging in with invalid credentials: ' . $_POST['username'] . ':' . $_POST['password']); ?>
                                            Wrong username or password!
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="messagebox col s12 red">
                                        <?php $log->Action($_POST['username'], 'Login', 'Tried logging in with invalid captcha'); ?>
                                        Captcha was incorrect!
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="messagebox col s12 red">
                                    <?php $log->Action($_POST['username'], 'Login', 'Tried logging in with invalid password format: ' . $_POST['password']); ?>
                                    Wrong username or password!
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="messagebox col s12 red">
                                <?php $log->Action($_POST['username'], 'Login', 'Tried logging in with invalid username format: ' . $_POST['username']); ?>
                                Wrong username or password!
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
