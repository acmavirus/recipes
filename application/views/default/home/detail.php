<div class="container">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="d-flex flex-column flex-shrink-0 mt-4 mb-4 text-white content">
                <?php if (!empty($breadcrumb)) echo $breadcrumb; ?>
                <h2><?php echo $post['title']; ?></h2>
                <?php echo $post['content']; ?>
            </div>
        </div>
        <div class="col-md-4 col-12"><?php $this->load->view("default/home/_sidebar-left"); ?></div>
    </div>
</div>