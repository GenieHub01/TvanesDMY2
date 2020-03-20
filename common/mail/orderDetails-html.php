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
            <th>#</th>
            <th>Holding Deposit</th>
            <th><?= $holding_deposit ?></th>
        </tr>
        <tr>
            <th>#</th>
            <th>Tax</th>
            <th><?= $total_tax ?></th>
        </tr>
        <tr>
            <th>#</th>
            <th>Shipping</th>
            <th><?= $shipping_cost ?></th>
        </tr>
        <tr>
            <th>#</th>
            <th>Total</th>
            <th><?= $shipping_cost+$total_tax+$holding_deposit+$total_sum ?></th>
        </tr>
    </table>
</div>
