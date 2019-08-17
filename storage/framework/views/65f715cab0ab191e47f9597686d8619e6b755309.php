<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>The Archive</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="app" class="container-fluid">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="loading">
        <div class="spinner-border">
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>
<?php /**PATH /data/data/com.termux/files/home/dev/www/ProductArchive/resources/views/layouts/site.blade.php ENDPATH**/ ?>