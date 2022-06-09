<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>
        <?php if (empty($page_title)) : ?>
            <?php echo  $this->settings->site_name; ?>
        <?php elseif (!empty($page_title)) : ?>
            <?php echo  $this->settings->site_name; ?> - <?php echo  $page_title; ?>
        <?php endif ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('/public/admin/') ?>images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('/public/admin/') ?>css/bootstrap-dark.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('/public/admin/') ?>css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('/public/admin/') ?>css/app-dark.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>