<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2 d-flex align-items-center">
                            MENU
                        </div>
                        <div class="col-sm-10 d-flex justify-content-end">
                            <div class="dropdown mt-4 mt-sm-0 mr-2">
                                <div class="dropdown-menu">
                                    <?php foreach ($menu_groups as $menu) : ?>
                                        <a class="dropdown-item" href="<?php echo site_url('admin/menu/index'); ?>/<?php echo $menu->id; ?>"><?php echo $menu->title; ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="text-sm-end">
                                <form method="post" id="form-menu" action="<?php echo site_url('admin/menu/save_position'); ?>">
                                    <button type="submit" id="btn-save-menu" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                        <i class="mdi mdi-content-save me-1"></i>
                                        Lưu thay đổi
                                    </button>
                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light pl-2 mb-2 me-2" data-bs-toggle="modal" data-bs-target="#modalNewMenu">
                                        Thêm menu mới
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="ns-row" id="ns-header">
                        <div class="actions">Actions</div>
                        <div class="ns-url">URL</div>
                        <div class="ns-title">Title</div>
                    </div>
                    <ul id="easymm" class="ui-sortable">
                        <?php if (!empty($listmenu)) foreach ($listmenu as $key => $item) : ?>
                            <li id="menu-<?php echo $item->id; ?>" class="sortable">
                                <div class="ns-row" style="background-color: #000;">
                                    <div class="ns-title"><?php echo $item->title; ?></div>
                                    <div class="ns-url"><?php echo $item->url; ?></div>
                                    <input class="ns-icon d-none" value="<?php echo htmlentities($item->icon, ENT_COMPAT, 'UTF-8'); ?>">
                                    <div class="actions">
                                        <?php $this->load->view('admin/menu/_action'); ?>
                                        <input type="hidden" name="menu_id" value="<?php echo $item->id; ?>">
                                    </div>
                                </div>
                                <?php if (!empty($item->child)) : ?>
                                    <ul>
                                        <?php foreach ($item->child as $ckey => $citem) : ?>
                                            <li id="menu-<?php echo $citem->id; ?>" class="sortable">
                                                <div class="ns-row" style="background-color: #000;">
                                                    <div class="ns-title"><?php echo $citem->title; ?></div>
                                                    <div class="ns-url"><?php echo $citem->url; ?></div>
                                                    <input class="ns-icon d-none" value="<?php echo htmlentities($citem->icon, ENT_COMPAT, 'UTF-8'); ?>">
                                                    <div class="actions">
                                                        <?php $this->load->view('admin/menu/_action'); ?>
                                                        <input type="hidden" name="menu_id" value="<?php echo $citem->id; ?>">
                                                    </div>
                                                </div>
                                                <?php if (!empty($citem->child)) : ?>
                                                    <ul>
                                                        <?php foreach ($citem->child as $pkey => $pitem) : ?>
                                                            <li id="menu-<?php echo $pitem->id; ?>" class="sortable">
                                                                <div class="ns-row" style="background-color: #000;">
                                                                    <div class="ns-title"><?php echo $pitem->title; ?></div>
                                                                    <div class="ns-url"><?php echo $pitem->url; ?></div>
                                                                    <input class="ns-icon d-none" value="<?php echo htmlentities($pitem->icon, ENT_COMPAT, 'UTF-8'); ?>">
                                                                    <div class="actions">
                                                                        <?php $this->load->view('admin/menu/_action'); ?>
                                                                        <input type="hidden" name="menu_id" value="<?php echo $pitem->id; ?>">
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php else : ?>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else : ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/menu/_modal'); ?>