<input type="hidden" name="" id="modalID">
<!--  -->
<div id="modalNewRow" class="modal fade" aria-labelledby="#modalNewRowLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNewRowLabel">Thêm bản ghi mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('admin/' . $page . '/add'); ?>">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-content-tab" data-bs-toggle="pill" data-bs-target="#pills-content" type="button" role="tab" aria-controls="pills-content" aria-selected="true">CONTENT</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-content" role="tabpanel" aria-labelledby="pills-content-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <small id="status_title" class="text-danger"></small>
                                            <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <small id="status_description" class="text-danger"></small>
                                            <input type="text" class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <small id="status_slug" class="text-danger"></small>
                                            <input type="text" class="form-control" name="slug" id="slug" aria-describedby="helpId" placeholder="" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <small id="status_type" class="text-danger"></small>
                                            <input type="text" class="form-control" name="type" id="type" aria-describedby="helpId" placeholder="" value="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta title</label>
                                            <small id="status_meta_title" class="text-danger"></small>
                                            <input type="text" class="form-control" name="meta_title" id="meta_title" aria-describedby="helpId" placeholder="" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta description</label>
                                            <small id="status_meta_description" class="text-danger"></small>
                                            <input type="text" class="form-control" name="meta_description" id="meta_description" aria-describedby="helpId" placeholder="" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta keywords</label>
                                            <small id="status_meta_keywords" class="text-danger"></small>
                                            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" aria-describedby="helpId" placeholder="" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <small id="status_content" class="text-danger"></small>
                                            <textarea name="content" id="content" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
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