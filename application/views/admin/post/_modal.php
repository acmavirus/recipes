<input type="hidden" name="" id="modalID">
<!--  -->
<div id="modalNewRow" class="modal fade" tabindex="-1" aria-labelledby="#modalNewRowLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNewRowLabel">Thêm bản ghi mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-row" method="post" action="<?php echo site_url('admin/' . $page . '/add'); ?>">
                    <?php if (!empty($listkey)) foreach ($listkey as $key) : if (in_array($key, ['id'])) continue; ?>
                        <div class="form-group">
                            <label for="<?php echo $key; ?>"><?php echo $key; ?></label>
                            <input type="text" class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>" aria-describedby="helpId" placeholder="" value="">
                        </div>
                    <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Save changes</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalEditRow" class="modal fade" tabindex="-1" aria-labelledby="#modalEditRowLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditRowLabel">Chỉnh sửa bản ghi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-row" method="post" action="<?php echo site_url('admin/' . $page . '/edit'); ?>">
                    <?php if (!empty($listkey)) foreach ($listkey as $key) : if (in_array($key, ['id'])) : ?>
                            <div class="form-group d-none">
                                <label for="<?php echo $key; ?>"><?php echo $key; ?></label>
                                <input type="text" class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>" aria-describedby="helpId" placeholder="" value="">
                            </div>
                        <?php else : ?>
                            <?php if (in_array($key, ['content'])) : ?>
                                <textarea id="elm1" name="content"></textarea>
                            <?php else : ?>
                                <div class="form-group">
                                    <label for="<?php echo $key; ?>"><?php echo $key; ?></label>
                                    <input type="text" class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>" aria-describedby="helpId" placeholder="" value="">
                                </div>
                            <?php endif; ?>
                    <?php endif;
                    endforeach; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Save changes</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalDeleteRow" class="modal fade" tabindex="-1" aria-labelledby="modalDeleteRowLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteRowLabel">
                    Xóa bản ghi
                </h5>
            </div>
            <div class="modal-body">
                Bạn có muốn xóa bản ghi này ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="deleteItem btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Delete and changes</button>
            </div>
        </div>
    </div>
</div>