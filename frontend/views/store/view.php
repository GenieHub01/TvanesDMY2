<?php
/**
 * @var $model \frontend\models\Goods
 */

$this->title = $model->title;
$this->registerJsFile('@web/js/jquery.zoom.js', ['depends' => 'yii\web\JqueryAsset', 'position' => \yii\web\View::POS_END]);
$this->registerJsFile('@web/js/the-product.js', ['depends' => 'yii\web\JqueryAsset', 'position' => \yii\web\View::POS_END]);
?>
<div class="inner-pag">

    <div class="container">

        <div class="row">
            <div class="col-md-9">
                <div class="row">

                    <!-- start product img -->
                    <div class="col-md-6 th-imgg">
                        <div class="zoom-ico" data-toggle="modal" data-target=".big-image">
                            <i class="fas fa-search"></i>
                        </div>
                        <div  id="hov-img">
                            <?if ($model->images):?>
                                <?foreach ($model->images as $image):?>
                                    <?= \yii\helpers\Html::img($image,['class'=>'prod-img']) ?>
                                <?endforeach;?>
                            <?endif;?>
                        </div>

                        <div class="modal fade bd-example-modal-xl big-image" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <i class="fas fa-times close-ico"  data-dismiss="modal"></i>
                                    <?if ($model->images):?>
                                        <?foreach ($model->images as $image):?>
                                            <?= \yii\helpers\Html::img($image,['class'=>'al-img']) ?>
                                        <?endforeach;?>
                                    <?endif;?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- end product img -->
                    <div class="col-md-6 product-det">
                        <h1 class="prod-detail">
                            <?= $model->title ?>
                            <p class="prod-pric"><?= Yii::$app->formatter->asCurrency($model->price) ?></p>
                        </h1>

                        <div class="prod-inps">

                            <input type="number" id="qty" name="qty" class="num-prods" value="1">
                            <?= \yii\helpers\Html::a('Add To Cart','#',['class'=>'add-cart hvr-bounce-to-top add_to_cart ','data-id'=>$model->id])  ?>
                        </div>

                        <p class="category">Category: <a href="#"><?= $model->category_string ?></a></p>

                    </div>
                </div>


                <div class="all-about">
                    <div class="about-cat">
                        <button class="eac-cate active description">DESCRIPTION</button>
                        <button class="eac-cate additional">ADDITIONAL INFORMATION</button>
                        <button class="eac-cate reviews">REVIEWS (0)</button>
                    </div>

                    <div class="inner-ab description">
                        <h1 class="cate-title">DESCRIPTION</h1>
                        <p class="about-det"><?= $model->description ?></p>
                    </div>


                    <div class="inner-ab additional disp-no">
                        <h1 class="cate-title">ADDITIONAL INFORMATION</h1>
                        <table class="info-table">
                            <tbody>
                            <tr>
                                <th>Make</th>
                                <td><a href="#"><?= $model->brand ?></a></td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td><a href="#"><?= $model->model ?></a></td>
                            </tr>
                            <tr>
                                <th>Car Year</th>
                                <td><a href="#">2011 </a></td>
                            </tr>
                            <tr>
                                <th>Engine Capacity</th>
                                <td><a href="#"><?= $model->engine_capacity ?></a></td>
                            </tr>
                            <tr>
                                <th>Fuel</th>
                                <td><a href="#"><?= $model->fuel ?></a></td>
                            </tr>
                            <tr>
                                <th>Engine Type</th>
                                <td><a href="#"><?= $model->engine_type ?></a></td>
                            </tr>
                            <tr>
                                <th>Engine Power	</th>
                                <td><a href="#"><?= $model->engine_power ?></a></td>
                            </tr>
                            <? if ($model->part_number_list): ?>
                                <tr>
                                    <th>Part Number List
                                    </th>
                                    <td><a href="#"><?= join(',',$model->part_number_list) ?></a></td>
                                </tr>
                            <? endif; ?>
                            <? if ($model->comparison_number_list): ?>
                                <tr>
                                    <th>Comparison Number List
                                    </th>
                                    <td><a href="#"><?= join(',',$model->comparison_number_list) ?></a></td>
                                </tr>
                            <? endif; ?>
                            <tr>
                                <th>Additional Information</th>
                                <td><a href="#"><?= $model->add_info ?></a></td>
                            </tr>
                            <tr>
                                <th>OEM- Exchange</th>
                                <td><a href="#"><?= $model->oem_exchange ?></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="inner-ab reviews disp-no">
                        <h1 class="cate-title">REVIEWS</h1>

                        <p class="about-det">There are no reviews yet.</p>
                        <p class="about-det">Only logged in customers who have purchased this product may leave a review.</p>
                    </div>

                </div>

            </div>
            <div class="col-md-3 category-list">
                <h1 class="category-stat">PRODUCT CATEGORIES</h1>

                <ul class="th-listt">
                    <a href="turbo-actuator.html">
                        <li class="eac-catt">Turbo Actuator</li>
                    </a>

                    <a href="position-sensor.html">
                        <li class="eac-catt">Turbo Actuator Position Sensor</li>
                    </a>

                    <a href="turbo-actuator.html">
                        <li class="eac-catt">Turbo Actuator</li>
                    </a>

                    <a href="turbo-charger.html">
                        <li class="eac-catt">Turbo Charger</li>
                    </a>

                    <a href="turbo-cleaner.html">
                        <li class="eac-catt">Turbo Cleaner</li>
                    </a>

                    <a href="turbo-vanes.html">
                        <li class="eac-catt">Turbo Vanes Ltd</li>
                    </a>
                </ul>

            </div>
        </div>


    </div>

</div>