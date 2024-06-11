<!DOCTYPE html>

<head>
    <title><?= $title ?></title>
    <style>
        img {
            max-height: 250px;
            max-width: 250px;
            margin: auto;
            padding: 0;
        }
    </style>
</head>

<body style="background-color: #fffdfd;">
    <div id="error_message"></div>
    <div style="display: flex; justify-content:center; align-items: center;">
        <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/js/jquery.min.js')  ?>"></script>
    </div>
    <img src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/images/wait.gif') ?>" />
    <?php
    $CI = &get_instance();
    $token_name = $CI->security->get_csrf_token_name();
    $csrf_hash  = $CI->security->get_csrf_hash();

    if ($type == 'stripe' && isset($_GET['amount'])) {

        $amount = $_GET['amount'];
    ?>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            //   $(document).ready(function() {
            const stripe = Stripe("<?= get_option('paymentmethod_stripe_api_publishable_key') ?>");
            $.post("<?= site_url(BETTING_MODULE_NAME . '/payment/stripe') ?>", {
                createCheckoutSession: 1,
                amount: <?= $amount ?>,
                "<?= $token_name ?>": '<?= $csrf_hash ?>'
            }, function(e) {
                var data = JSON.parse(e);
                if (data.sessionId) {
                    stripe.redirectToCheckout({
                        sessionId: data.sessionId,
                    }).then(handleResult);
                } else {
                    handleResult(e)
                }
            });
            //   });

            function handleResult(data) {
                var result = JSON.parse(data);
                if (result.error) {
                    $('#error_message').html('<div class="alert alert-danger">' + result.error.message + '</div>');
                    //alert_float('danger', result.error.message);
                }
            }
        </script>
    <?php }
    if ($type == 'coinbase'  && isset($_GET['amount'])) {
        $amount = $_GET['amount'];
    ?>
        <script>
            $.post("<?= site_url(BETTING_MODULE_NAME . '/payment/coinbase') ?>", {
                amount: <?= $amount ?>,
                "<?= $token_name ?>": '<?= $csrf_hash ?>'
            }, function(e) {
                //var data = JSON.parse(e);
                window.location.href = e;
            });

            <?php } ?>
        </script>
</body>