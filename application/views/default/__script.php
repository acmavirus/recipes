<!-- all plugins here -->
<script src="<?php echo base_url(VENDOR_PATH) ?>libs/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(VENDOR_PATH) ?>libs/fontawesome/js/all.min.js"></script>
<script src="<?php echo base_url(VENDOR_PATH) ?>/libs/amlich/jquery.amlich.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#amlich-calendar').amLich({
            type: 'calendar',
            tableWidth: '100%'
        });
    });
</script>
<!-- main js  -->
<script src="<?php echo base_url('/public/default/') ?>js/main.js"></script>
<script src="<?php echo base_url('/public/default/') ?>js/root.js"></script>