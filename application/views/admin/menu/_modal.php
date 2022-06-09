<input type="hidden" name="" id="modalID">
<!--  -->
<div id="modalNewMenu" class="modal fade" tabindex="-1" aria-labelledby="modalNewMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNewMenuLabel">
                    Thêm menu mới
                </h5>
            </div>
            <div class="modal-body">
                <form id="form-add-menu" method="post" action="<?php echo site_url('admin/menu/add'); ?>">
                    <div class="form-group"><label for="menu-title">Title</label><input style="width: 100% !important;" type="text" name="title" required id="menu-title" class="form-control"></div>
                    <div class="form-group"><label for="menu-url">URL</label><input type="text" name="url" id="menu-url" class="form-control" required style="width: 100% !important;"></div>
                    <div class="form-group"><label for="menu-url">Icon</label><input type="text" name="icon" id="menu-icon" class="form-control" required style="width: 100% !important;"></div><input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                    <div class="modal-footer"><button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button><button id="add-menu" type="submit" class="btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Save changes</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modalEditItem" class="modal fade" tabindex="-1" aria-labelledby="modalEditItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditItemLabel">
                    Sửa menu
                </h5>
            </div>
            <div class="modal-body">
                <form id="form-edit-menu" method="post" action="<?php echo site_url('admin/menu/save'); ?>">
                    <div class="form-group">
                        <label for="menu-title">Title</label>
                        <input style="width: 100% !important;" id="ns-title" type="text" name="title" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="menu-url">URL</label>
                        <input type="text" name="url" id="ns-url" class="form-control" required style="width: 100% !important;">
                    </div>
                    <div class="form-group">
                        <label for="menu-icon">Icon</label>
                        <input type="text" name="icon" id="ns-icon" class="form-control" required style="width: 100% !important;">
                    </div>
                    <input type="hidden" id="ns-id" name="id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button id="edit-menu" type="submit" class="btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="modalDeleteItem" class="modal fade" tabindex="-1" aria-labelledby="modalDeleteItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteItemLabel">
                    Xóa item
                </h5>
            </div>
            <div class="modal-body">
                Bạn có muốn xóa item này ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="deleteItem btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Delete and changes</button>
            </div>
        </div>
    </div>
</div>
<!--  -->
<div id="modalEditGroup" class="modal fade" tabindex="-1" aria-labelledby="modalEditGroupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditGroupLabel">
                    Sửa tiêu đề nhóm
                </h5>
            </div>
            <div class="modal-body">
                <form id="form-edit-group" method="post" action="<?php echo site_url('admin/menu/group_edit'); ?>">
                    <div class="form-group">
                        <label for="menu-title">Title</label>
                        <input style="width: 100% !important;" id="ns-title" type="text" name="title" required class="form-control">
                    </div>
                    <input id="ns-id" type="hidden" name="id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="modalNewGroup" class="modal fade" tabindex="-1" aria-labelledby="modalNewGroupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNewGroupLabel">
                    Thêm nhóm mới
                </h5>
            </div>
            <div class="modal-body">
                <form id="form-add-group" method="post" action="<?php echo site_url('admin/menu/group_add'); ?>">
                    <div class="form-group">
                        <label for="menu-title">Title</label>
                        <input style="width: 100% !important;" id="ns-title" type="text" name="title" required class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modalDeleteGroup" class="modal fade" tabindex="-1" aria-labelledby="modalDeleteGroupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteGroupLabel">
                    Xóa item
                </h5>
            </div>
            <div class="modal-body">
                Bạn có muốn xóa Group này ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="deleteItem btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">Delete and changes</button>
            </div>
        </div>
    </div>
</div>