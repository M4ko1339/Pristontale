<?php

include('header.php');

if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
{
    header('Location: login.php');
    exit;
}

$order = new Order();

?>

<div class="container">
    <div class="row">
        <div class="content col s12">
            <?php if(isset($_GET['order_id']) && $order->Check($_GET['order_id'])): ?>
                <div class="user-data col s12">
                    <label>Thank you for your contribution</label>
                </div>

                <div class="info-box col s12 m8">
                    <table class="donate-table">
                        <?php foreach($order->OrderID($_GET['order_id']) as $row): ?>
                            <tr>
                                <td>Order ID</td>
                                <td class="orange-text"><?php echo $row['order_id']; ?></td>
                            </tr>
                            <tr>
                                <td>Amount(EUR)</td>
                                <td class="green-text"><?php echo $row['amount']; ?></td>
                            </tr>
                            <tr>
                                <td>Coins</td>
                                <td class="blue-text"><?php echo $row['amount']*2; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                Order was not found!
            <?php endif; ?>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
