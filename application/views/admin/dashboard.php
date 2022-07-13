<!-- Begin page -->
<div id="wrapper">

   <!-- ========== Left Sidebar Start ========== -->
   <div class="left side-menu">
      <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
         <i class="mdi mdi-close"></i>
      </button>

      <div class="left-side-logo d-block d-lg-none">
         <div class="text-center">
            <a href="index.html" class="logo"><img src="<?php echo base_url('/public/admin/') ?>images/logo.png" height="20" alt="logo"></a>
         </div>
      </div>

      <div class="sidebar-inner slimscrollleft">
         <div id="sidebar-menu">
            <?php $this->load->view('admin/dashboard/left_menu'); ?>
         </div>
         <div class="clearfix"></div>
      </div> <!-- end sidebarinner -->
   </div>
   <!-- Left Sidebar End -->

   <!-- Start right Content here -->

   <div class="content-page">
      <!-- Start content -->
      <div class="content">

         <!-- Top Bar Start -->
         <div class="topbar">

            <div class="topbar-left	d-none d-lg-block">
               <div class="text-center">
                  <a href="<?php echo base_url('/admin') ?>" class="logo"><img src="<?php echo base_url('/public/admin/') ?>images/logo.png" height="22" alt="logo"></a>
               </div>
            </div>

            <nav class="navbar-custom">
               <ul class="list-inline float-right mb-0">
                  <li class="list-inline-item">
                     <button type="button" class="btn btn-success">
                        Thêm bản ghi
                     </button>
                     <button type="button" class="btn btn-default bg-white">
                        Lưu
                     </button>
                  </li>
                  <li class="list-inline-item dropdown notification-list nav-user">
                     <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?php echo base_url('/public/admin/') ?>images/users/avatar-6.jpg" alt="user" class="rounded-circle">
                        <span class="d-none d-md-inline-block ml-1">David M. Bailey <i class="mdi mdi-chevron-down"></i> </span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                        <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted"></i> My Wallet</a>
                        <a class="dropdown-item" href="#"><span class="badge badge-success float-right m-t-5">5</span><i class="dripicons-gear text-muted"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted"></i> Logout</a>
                     </div>
                  </li>
               </ul>
               <ul class="list-inline menu-left mb-0">
                  <li class="list-inline-item">
                     <button type="button" class="button-menu-mobile open-left waves-effect">
                        <i class="mdi mdi-menu"></i>
                     </button>
                  </li>
                  <li class="list-inline-item dropdown">
                     <div class="dropdown mt-4 mt-sm-0 mr-2">
                        <a href="#" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                           Hiển thị
                        </a>
                        <div class="dropdown-menu">
                           <?php foreach ($listkey as $key) : ?>
                              <div class="form-check font-size-16 align-middle">
                                 <input class="form-check-input" name="show" type="checkbox" value="<?php echo $key; ?>" <?php echo (in_array($key, $listkeyShow)) ? 'checked' : ''; ?>>
                                 <label class="form-check-label" for="<?php echo $key; ?>"><small><?php echo $key; ?></small></label>
                              </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </li>
               </ul>
            </nav>
         </div>
         <!-- Top Bar End -->

         <div class="page-content-wrapper ">
            <?= $main; ?>
         </div> <!-- Page content Wrapper -->

      </div> <!-- content -->
   </div>
   <!-- End Right content here -->
</div>
<!-- END wrapper -->