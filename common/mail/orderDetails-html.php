<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$i = 1;
?>
<div class="verify-email">
    <th>#</th>
    <th>Product</th>
    <th>Price</th>
    <?php foreach ($items as $item): ?>
        <?= "<tr>" . $i . "</tr>>" ?>
        <?= "<tr>" . $item['title'] . "</tr>>" ?>
        <?= "<tr>" . $item['price'] . "</tr>>" ?>
        <?php $i++; ?>
    <?php endforeach; ?>
</div>
