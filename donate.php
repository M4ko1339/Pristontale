<?php

include('header.php');

if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
{
    header('Location: login.php');
    exit;
}

?>

<div class="container">
    <div class="row">
        <div class="content col s12">
            <div class="user-data col s12">
                <label>Donate for Coins</label>
            </div>

            <div class="donate-box">
                <form method="POST" action="checkout.php">
                    <div class="input-field col s12">
                        <i class="fas fa-euro-sign prefix"></i>
                        <input type="text" name="amount" id="icon_prefix" class="materialize-textbox">
                        <label for="icon_prefix">Amount (€1 = 2 Coins)</label>
                    </div>

                    <div class="input-field col s12 center">
                        <input type="submit" class="btn" name="donate" value="Donate" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
