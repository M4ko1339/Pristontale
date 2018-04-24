<?php

include('header.php');

?>

<div class="container">
    <div class="row">
        <div class="content col s12">
            <div class="content-box">
                <table>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Character Name</th>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Item Cost</th>
                    <th>Order Date</th>

                    <?php foreach($admin->Purchases() as $row): ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['item_id']; ?></td>
                            <td><?php echo $row['item_name']; ?></td>
                            <td class="green-text"><?php echo $row['item_price']; ?> Coins</td>
                            <td><?php echo date('H:i - j.F, Y', $row['order_date']); ?></td>
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
