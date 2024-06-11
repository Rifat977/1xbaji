<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/css/all.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/css/fontawesome.min.css')  ?>">
    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/css/bootstrap.min.css')  ?>">
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/js/jquery.min.js')  ?>"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-center flex-column align-items-center" style="height: 100vh">
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fa-solid fa-close fs-3 text-danger me-3"></i>
                <div>
                    Payment Canceled!
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="<?= base_url('betting') ?>" class="btn btn-primary">Back To Home</a>
            </div>
        </div>
    </div>
</body>

<script>
    // setInterval(window.location.href = '<?= base_url('betting') ?>', 5000);
</script>

</html>