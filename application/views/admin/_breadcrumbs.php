<div class="page-content mt-0 mb-0 pb-0">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <?php if (!empty($breadcrumb)) : ?>
                        <h4 class="mb-sm-0 font-size-18"><?php if(!empty($breadcrumb['page'])) echo $breadcrumb['page']['title']; ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <?php foreach ($breadcrumb as $key => $item) : ?>
                                    <li class="breadcrumb-item">
                                        <a href="<?php if(!empty($item)) echo base_url($item['url']); ?>"><?php if(!empty($item)) echo $item['title']; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    <?php else : ?>
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">
                                    <a href="<?php echo base_url('admin'); ?>">Dashboard</a>
                                </li>
                            </ol>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>