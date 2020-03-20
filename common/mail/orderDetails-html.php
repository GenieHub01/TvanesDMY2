<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$i = 1;
?>
<div class="verify-email">
    <table>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Price</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?=$i ?></td><td><?= $item['title'] ?></td><td><?=$item['price']?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
        <tr>
            <td>#</td>
            <td>Holding Deposit</td>
            <td><?= $holding_deposit ?></td>
        </tr>
        <tr>
            <td>#</td>
            <td>Tax</td>
            <td><?= $total_tax ?></td>
        </tr>
        <tr>
            <td>#</td>
            <td>Shipping</td>
            <td><?= $shipping_cost ?></td>
        </tr>
        <tr>
            <td>#</td>
            <td>Total</td>
            <td><?= $shipping_cost+$total_tax+$holding_deposit+$total_sum ?></td>
        </tr>
    </table>
</div>
