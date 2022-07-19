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
<script src="<?php echo base_url("public/admin/js/".$this->router->fetch_class().".js"); ?>"></script>
<script>
    $(document).ready(function() {
        if ($("#content").length > 0) {
            tinymce.init({
                selector: "textarea#content",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [{
                        title: 'Bold text',
                        inline: 'b'
                    },
                    {
                        title: 'Red text',
                        inline: 'span',
                        styles: {
                            color: '#ff0000'
                        }
                    },
                    {
                        title: 'Red header',
                        block: 'h1',
                        styles: {
                            color: '#ff0000'
                        }
                    },
                    {
                        title: 'Example 1',
                        inline: 'span',
                        classes: 'example1'
                    },
                    {
                        title: 'Example 2',
                        inline: 'span',
                        classes: 'example2'
                    },
                    {
                        title: 'Table styles'
                    },
                    {
                        title: 'Table row 1',
                        selector: 'tr',
                        classes: 'tablerow1'
                    }
                ]
            });
        }
    });
</script>