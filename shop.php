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
            <div class="user-data col s12">
                <label>Game Store</label>
            </div>

            <div class="shop">
                <table class="shop-table">
                    <th>Item</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th></th>
                    <?php foreach($shop->Items() as $row): ?>
                        <tr>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['item_description']; ?></td>
                            <td><?php echo $row['item_price']; ?></td>
                            <td><a href="order.php?itemid=<?php echo $row['id']; ?>" class="btn small">Buy</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
