<!-- jQuery  -->
<script src="<?php echo base_url('/public/admin/') ?>js/jquery.min.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/modernizr.min.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/detect.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/fastclick.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/jquery.blockUI.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/waves.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url('/public/admin/') ?>js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url('public/admin/js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('public/admin/js/jquery.mjs.nestedSortable.js'); ?>"></script>
<script src="<?php echo base_url('/theme') ?>/plugins/tinymce/tinymce.min.js"></script>
<!-- App js -->
<script src="<?php echo base_url('/public/admin/') ?>js/app.js"></script>
<script src="<?php echo base_url("public/admin/js/" . $this->router->fetch_class() . ".js"); ?>"></script>
<script>
    $(document).ready(function() {
        if ($("#content").length > 0) {
            tinymce.init({
                selector: "textarea#content"
            });
        }
    });
</script>