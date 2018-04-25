<?php

include('header.php');

if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
{
    header('Location: login.php');
    exit;
}

$shop = new Shop();

?>

<div class="container">
    <div class="row">
        <div class="content col s12">
            <?php if(isset($_POST['name']) && !empty($_POST['name'])): ?>
                <?php if($shop->Order($_SESSION['username'], $_POST['name'], $_GET['itemid'])): ?>
                    <?php $log->Action($_SESSION['username'], 'Order', 'Bought item: ' . $_GET['itemid']); ?>
                    <div class="user-data col s12">
                        <label>Item has been bought!</label>
                    </div>

                    <div class="info-box col s12 m8">
                        Please contact an Administrator for your item.
                    </div>
                <?php else: ?>
                    <?php $log->Action($_SESSION['username'], 'Order', 'Not enough coins to buy item: ' . $_GET['itemid']); ?>
                    Not enough coins!
                <?php endif; ?>
            <?php else: ?>
                <?php if(isset($_GET['itemid']) && $shop->Check($_GET['itemid'])): ?>
                    <div class="user-data col s12">
                        <label>Order Information</label>
                    </div>

                    <div class="info-box col s12 m8">
                        <table class="order-table">
                            <?php foreach($shop->ItemID($_GET['itemid']) as $row): ?>
                                <tr>
                                    <td>Item Name</td>
                                    <td class="orange-text"><?php echo $row['item_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Item Cost</td>
                                    <td class="orange-text"><?php echo $row['item_price']; ?> Coins</td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                    <div class="user-data col s12">
                        <label>What character do you want the item on?</label>
                    </div>

                    <div class="donate-box">
                        <form method="POST">
                            <div class="input-field col s12">
                                <i class="fas fa-user prefix"></i>
                                <input type="text" name="name" id="icon_prefix" class="materialize-textbox">
                                <label for="icon_prefix">Character Name</label>
                            </div>

                            <div class="input-field col s12 center">
                                <input type="submit" class="btn" name="confirm" value="Confirm" />
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <?php $log->Action($_SESSION['username'], 'Order', 'Tried accessing a invalid item with parameter: ' . $_GET['itemid']); ?>
                    Item not found!
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
