<!-- Begin page -->
<div id="layout-wrapper">
   <?php $this->load->view('admin/_header'); ?>
   <!-- ========== Left Sidebar Start ========== -->
   <?php echo leftMenu(); ?>
   <!-- Left Sidebar End -->
   <!-- ============================================================== -->
   <!-- Start right Content here -->
   <!-- ============================================================== -->
   <div class="main-content">
      <?php $this->load->view('admin/_breadcrumbs'); ?>
      <?php echo (!empty($main)) ? $main : '<div class="text-center">no data</div>'; ?>
      <?php $this->load->view('admin/_footer'); ?>
   </div>
   <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- Right Sidebar -->
<?php $this->load->view('admin/_rightMenu'); ?>
<!-- /Right-bar -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>