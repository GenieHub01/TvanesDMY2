<?php
use yii\helpers\Html;
?>
    <script type='text/javascript'>
        window.onload = function() {
            Worldpay.useTemplateForm({
                'clientKey':'T_C_2fa0515c-3e10-45a9-b613-6484757aea1e',
                'form':'paymentForm',
                'paymentSection':'paymentSection',
                'display':'modal',
                'reusable':true,
                'callback': function(obj) {
                    if (obj && obj.token) {
                        var _el = document.createElement('input');
                        _el.value = obj.token;
                        _el.type = 'hidden';
                        _el.name = 'token';
                        document.getElementById('paymentForm').appendChild(_el);
                        document.getElementById('paymentForm').submit();
                    }
                }
            });
        }
    </script>
<form action="/site/pay" id="paymentForm" method="post">
    <!-- all other fields you want to collect, e.g. name and shipping address -->
    <?php echo Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []);?>
    <div id='paymentSection'></div>
    <div>
        <input type="submit" value="Place Order" onclick="Worldpay.submitTemplateForm()" />
    </div>
</form>
