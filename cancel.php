<?php

include('header.php');

if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
{
    header('Location: login.php');
    exit;
}

?>

<?php $log->Action($_SESSION['username'], 'Cancel', 'Order was cancelled'); ?>
<div class="container">
    <div class="row">
        <div class="content col s12">
            <div class="user-data col s12">
                <label>Order Cancelled</label>
            </div>

            <div class="info-box col s12 m8">
                Your order has been cancelled for some reason.
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
