<!DOCTYPE html>
<html lang="en">
<?php if (!empty($__head)) echo $__head;
else $this->load->view('admin/__head'); ?>
<script>
    let base_url = '<?php echo base_url(); ?>';
    let __page     = '<?= $this->router->fetch_class(); ?>';
</script>

<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
    </div>
    <?php if (!empty($main)) echo $main; ?>
    <?php if (!empty($__script)) echo $__script;
    else $this->load->view('admin/__script'); ?>
</body>

</html>