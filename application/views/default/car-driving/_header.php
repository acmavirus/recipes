<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-center">
    <?php echo returnLink('navbar-brand logo', base_url(), ''); ?>ACMATVIRUS</a>
</nav>
<ul class="license navbar navbar-dark bg-danger d-flex justify-content-center">
    <li class="nav-item active">
        <a class="nav-link" href="javascript:void(0);" data-license="-1">Hạng:</a>
    </li>
    <?php if (!empty($license)) foreach ($license as $key => $value) : ?>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);" data-license="<?php echo $key; ?>"><?php echo $value->ZNAME; ?></a>
            <ul class="content">
                <p><?php echo $value->ZCONTENT; ?></p>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>