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
                        <i class="fas fa-envelope prefix"></i>
                        <input type="text" name="email" id="icon_prefix" class="materialize-textbox">
                        <label for="icon_prefix">Email</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="fas fa-lock prefix"></i>
                        <input type="password" name="password" id="icon_prefix" class="materialize-textbox">
                        <label for="icon_prefix">Password</label>
                    </div>

                    <div class="input-field col s12">
                        <i class="fas fa-lock prefix"></i>
                        <input type="password" name="repassword" id="icon_prefix" class="materialize-textbox">
                        <label for="icon_prefix">Re Password</label>
                    </div>

                    <div class="input-field col s12">
                        <center><div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_CLIENT; ?>"></div></center>
                    </div>

                    <div class="input-field col s12 center">
                        <input type="submit" class="btn" name="register" value="Register">
                    </div>
                </form>
            </div>

            <div class="response">
                <?php if(isset($_POST['register'])): ?>
                    <?php if(!empty(
                        $_POST['username'] ||
                        $_POST['email'] ||
                        $_POST['password'] ||
                        $_POST['repassword']
                    )): ?>
                        <?php if($_POST['password'] == $_POST['repassword']): ?>
                            <?php if(preg_match("/[a-zA-Z0-9-_]+@+[a-zA-Z0-9]+\.+[a-zA-Z]{2,8}/", $_POST['email'])): ?>
                                <?php if(preg_match("/^[a-zA-Z0-9]{2,8}$/", $_POST['username'])): ?>
                                    <?php if(preg_match("/^[a-zA-Z0-9]{2,8}$/", $_POST['password'])): ?>
                                        <?php if(!$user->Duplicate($_POST['username'])): ?>
                                            <?php if($user->Captcha($_SERVER['REMOTE_ADDR'])): ?>
                                                <?php $user->Register($_POST['username'], $_POST['email'], $_POST['password']); ?>
                                                <div class="messagebox col s12 green">
                                                    Successfully registered!
                                                </div>
                                            <?php else: ?>
                                                <div class="messagebox col s12 red">
                                                    Captcha was incorrect!
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="messagebox col s12 red">
                                                Username already in use!
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="messagebox col s12 red">
                                            Password must be between 2-8 characters long!
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="messagebox col s12 red">
                                        Username must be between 2-8 characters long!
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="messagebox col s12 red">
                                    Email is not valid!
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="messagebox col s12 red">
                                Passwords dont match!
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
