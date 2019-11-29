<?php
use yii\helpers\Html;
?>
<!--start header -->

<div class="header">
    <div class="h-overlay"></div>


    <div class="upper-cont">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="eac-contact"><i class="far fa-clock"></i> 10:00 AM To 5:00 PM</p>
                    <p class="eac-contact"><a href="mailto:info@turbovanesltd.com"><i class="far fa-envelope"></i> info@turbovanesltd.com</a></p>
                </div>

                <div class="col-md-6 text-right">
                    <p class="eac-contact"><a href="tel:0121 558 6868"><i class="fas fa-phone-alt"></i> 0121 558 6868</a></p>
                    <p class="eac-contact"><a href="https://www.facebook.com/turbovanesltd/"><i class="fab fa-facebook-f"></i></a> </p>
                    <p class="eac-contact"><a href="https://twitter.com/turbovanesltd"><i class="fab fa-twitter"></i></a> </p>
                    <p class="eac-contact"><a href="https://www.turbovanesltd.com/#"><i class="fab fa-linkedin-in"></i></a> </p>
                    <p class="eac-contact">
                        <?php if ((Yii::$app->user->isGuest)):?>
                            <a href="<?= \yii\helpers\Url::to('/login') ?>"><i class="fas fa-lock"></i> Login</a>
                        <?php else: ?>
                            <a href="<?= \yii\helpers\Url::to('/logout') ?>"><i class="fas fa-lock"></i> Logout</a>
                        <?php endif; ?>
                    </p>
                    <p class="eac-contact">
                        <?php if ((Yii::$app->user->isGuest)):?>
                            <a href="<?= \yii\helpers\Url::to('/signup') ?>"><i class="fas fa-user-plus"></i> Signup</a>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>


    </div>

    <!-- start navbar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?= \yii\helpers\Url::base(true);  ?>"><img src="/img/turbo-vanes-logo-new.png" class="th-logo" alt="turbo-vanes-logo-new"> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="toggle-menuu">
                        <i></i>
                        <i></i>
                        <i></i>
                      </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#">PRODUCTS <i class="fas fa-chevron-down down-ico"></i></a>

                        <div class="down-menu">
                            <p class="eac-item"><a href="<?= \yii\helpers\Url::toRoute('/store/turbo-actuator') ?>">TURBO ACTUATOR</a></p>
                            <p class="eac-item"><a href="position-sensor.html">TURBO ACTUATOR POSITION SENSOR
                                </a></p>
                            <p class="eac-item"><a href="turbo-charger.html">TURBO CHARGER</a></p>
                            <p class="eac-item"><a href="turbo-cleaner.html">TURBO CLEANER</a></p>
                        </div>

                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::toRoute('/site/about') ?>">ABOUT</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">SUPPORT <i class="fas fa-chevron-down down-ico"></i> <span class="sr-only">(current)</span></a>

                        <div class="down-menu">
                            <p class="eac-item"><a href="return-policy">RETURNS POLICY</a></p>
                            <p class="eac-item"><a href="turbo-problems">TURBO PROBLEMS</a></p>
                            <p class="eac-item"><a href="delivery">DELIVERY</a></p>
                        </div>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::toRoute('/site/news') ?>">NEWS</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::toRoute('/site/contact') ?>">CONTACT</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::toRoute('/site/faq') ?>">FAQS</a>
                    </li>

                    <?= \frontend\widgets\headerCart\HeaderCart::widget()?>

                    <li class="nav-item search-on">
                        <div class="nav-link" href="#"><i class="fas fa-search th-search"></i></div>


                        <div class="search-menu">
                            <input type="search" class="want-buy" placeholder="I want to buy...">

                            <i class="fas fa-search search-ico"></i>
                        </div>

                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!--end navbar -->
    <?
        if(!empty($this->context->brandList)) {
            echo $this->render('_front_page_header_bottom');
        }else {
            echo $this->render('_header_bottom');
        }

    ?>

</div>

<!--end header -->
