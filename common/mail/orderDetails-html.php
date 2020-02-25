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
                <td>$i</td><td><?= $item['title'] ?></td><td><?=$item['price']?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</div>
