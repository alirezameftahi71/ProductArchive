<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand fas fa-archive" href="<?php echo e(url('/')); ?>"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav-bar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/create')); ?>">Create</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if(auth()->guard()->check()): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('register')); ?>"><i class="fas fa-user-plus"></i>&nbsp;Register</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<?php /**PATH /data/data/com.termux/files/home/dev/www/ProductArchive/resources/views/layouts/navbar.blade.php ENDPATH**/ ?>