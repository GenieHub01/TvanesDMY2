<?php
use yii\widgets\ListView;

$this->title = $title;
?>
<div class="inner-pag products-drop">

    <div class="container">

        <h1 class="first-titl">TURBO CHARGER
        </h1>

        <div class="all-products">

            <div class="search-filter">
                <div class="the-search">
                    <input type="search" class="filter-sear" placeholder="I want to buy ...">

                    <div class="search-results">
                        <a href="#">
                            <p class="eac-result not-found disp-no">Product not found!</p>
                        </a>
                        <div class="the-products">
                            <a href="#">
                                <p class="eac-result">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 145 1.9 N/A AR32302 105 N/A 701796-0001</p>
                            </a>
                            <a href="#">
                                <p class="eac-result ">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 145 1.9 N/A AR67501 EEC MIT KAT 8V 90 N/A VD130011</p>
                            </a>
                            <a href="#">
                                <p class="eac-result">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 146 1.9 N/A AR32302 105 N/A 701796-0001</p>
                            </a>
                            <a href="#">
                                <p class="eac-result">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 145 1.9 N/A AR32302 105 N/A 701796-0001</p>
                            </a>
                            <a href="#">
                                <p class="eac-result ">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 145 1.9 N/A AR67501 EEC MIT KAT 8V 90 N/A VD130011</p>
                            </a>
                            <a href="#">
                                <p class="eac-result">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 146 1.9 N/A AR32302 105 N/A 701796-0001</p>
                            </a>
                            <a href="#">
                                <p class="eac-result">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 145 1.9 N/A AR32302 105 N/A 701796-0001</p>
                            </a>
                            <a href="#">
                                <p class="eac-result ">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 145 1.9 N/A AR67501 EEC MIT KAT 8V 90 N/A VD130011</p>
                            </a>
                            <a href="#">
                                <p class="eac-result">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 146 1.9 N/A AR32302 105 N/A 701796-0001</p>
                            </a>
                            <a href="#">
                                <p class="eac-result">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 145 1.9 N/A AR32302 105 N/A 701796-0001</p>
                            </a>
                            <a href="#">
                                <p class="eac-result ">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 145 1.9 N/A AR67501 EEC MIT KAT 8V 90 N/A VD130011</p>
                            </a>
                            <a href="#">
                                <p class="eac-result">ELECTRONIC TURBO ACTUATOR FOR ALFA-ROMEO 146 1.9 N/A AR32302 105 N/A 701796-0001</p>
                            </a>
                        </div>

                    </div>

                </div>
            </div>

            <div class="num-results">
                <p class="showingg">Showing 1–12 of 29983 results</p>
            </div>

            <div class="all-sort">
                <div class="show-sort"><span>Default Sorting </span><svg class="svg-inline--fa fa-angle-down fa-w-10 updown-ico" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fas fa-angle-down updown-ico"></i> --></div>
                <ul class="the-sorts disp-no">
                    <li class="active">Default sorting</li>
                    <li>Sort by popularity</li>
                    <li>Sort by average rating</li>
                    <li>Sort by latest</li>
                    <li>Sort by price:low to high</li>
                    <li>Sort by price:high to low</li>
                </ul>
            </div>

            <!--start products -->


            <div class="row th-cards width-full">
                <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '/store/items/_item',
                    'layout' => "{items}",
                    'itemOptions' => ['tag' => false],
                    'options' => ['tag' => false],
                ]);
                ?>
            </div>

            <!--end products -->

            <div class="paginationn text-center">
                <?=
                \yii\bootstrap4\LinkPager::widget([
                    'pageCssClass' => 'page-item',
                    'linkOptions' => ['class' => 'page-link'],
                    'hideOnSinglePage' => true,
                    'pagination' => $dataProvider->pagination,
                    'options' => ['tag' => false]
                ])
                ?>
            </div>

        </div>


    </div>

</div>


