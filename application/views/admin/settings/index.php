<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 d-flex">
                            <div class="dropdown mt-4 mt-sm-0 mr-2">
                                <a href="#" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hiển thị <i class="mdi mdi-chevron-down"></i>
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
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end">
                                <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target="#modalNewRow">
                                    <i class="mdi mdi-plus me-1"></i>
                                    Thêm bản ghi
                                </button>
                            </div>
                        </div><!-- end col-->
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
                    <div class="table-responsive" id="tableContent" style="overflow: auto;">
                        <table class="table align-middle mb-4">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check font-size-16 align-middle">
                                            <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                            <label class="form-check-label" for="transactionCheck01"></label>
                                        </div>
                                    </th>
                                    <?php if (!empty($listkey)) foreach ($listkey as $key) : if (in_array($key, $listkeyShow)) : ?>
                                            <th class="align-middle <?php echo $key; ?>"><?php echo $key; ?></th>
                                        <?php else : ?>
                                            <th class="d-none align-middle <?php echo $key; ?>"><?php echo $key; ?></th>
                                    <?php endif;
                                    endforeach; ?>
                                    <th class="align-middle">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($listview)) foreach ($listview as $key => $item) : $item = (array)$item; ?>
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox" name="listid[]" value="<?php echo $item['id']; ?>">
                                                <label class="form-check-label" for="transactionCheck02"></label>
                                            </div>
                                        </td>
                                        <?php if (!empty($listkey)) foreach ($listkey as $key) : if (in_array($key, $listkeyShow)) : ?>
                                                <td class="<?php echo $key; ?>" data-key="<?php echo $key; ?>"><?php echo htmlentities($item[$key]); ?></td>
                                            <?php else : ?>
                                                <td class="d-none <?php echo $key; ?>" data-key="<?php echo $key; ?>"><?php echo htmlentities($item[$key]); ?></td>
                                        <?php endif;
                                        endforeach; ?>
                                        <td>
                                            <div class="d-flex gap-3" id="action">
                                                <a href="javascript:void(0);" data-id="<?php echo $item['id']; ?>" class="text-success" data-bs-toggle="modal" data-bs-target="#modalEditRow"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                <a href="javascript:void(0);" data-id="<?php echo $item['id']; ?>" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteRow"><i class="mdi mdi-delete font-size-18"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!empty($pagination)) echo $pagination['links']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/'.$page.'/_modal'); ?>