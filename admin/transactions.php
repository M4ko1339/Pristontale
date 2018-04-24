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
                    <th>Token</th>
                    <th>Payment ID</th>
                    <th>Payer ID</th>
                    <th>Amount</th>
                    <th>Order Date</th>

                    <?php foreach($admin->Transactions() as $row): ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['token']; ?></td>
                            <td><?php echo $row['payment_id']; ?></td>
                            <td><?php echo $row['payer_id']; ?></td>
                            <td class="green-text"><?php echo $row['amount']; ?> Euro</td>
                            <td><?php echo date('H:i - j.F, Y', $row['tdate']); ?></td>
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
