<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-sm-end">
                        <button id="openAdd" type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target="#modalNewRow">
                            <i class="mdi mdi-plus me-1"></i>
                            Thêm bản ghi
                        </button>
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
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check font-size-16 align-middle">
                                            <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                            <label class="form-check-label" for="transactionCheck01"></label>
                                        </div>
                                    </th>
                                    <?php if (!empty($listkey)) foreach ($listkey as $key) : ?>
                                        <?php if (in_array($key, $listkeyShow)) : ?>
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
                                                <a href="<?= getCatUrl($item['slug']); ?>" target="_blank" rel="noopener noreferrer" class="text-success">
                                                    <img src="/public/admin/icons/eye.svg" width="24px" height="24px" alt="eye">
                                                </a>
                                                <a href="javascript:void(0);" data-id="<?php echo $item['id']; ?>" class="text-success ml-2" data-bs-toggle="modal" data-bs-target="#modalNewRow">
                                                    <img src="/public/admin/icons/pen.svg" width="24px" height="24px" alt="pen">
                                                </a>
                                                <a href="javascript:void(0);" data-id="<?php echo $item['id']; ?>" class="text-danger ml-2" data-bs-toggle="modal" data-bs-target="#modalDeleteRow">
                                                    <img src="/public/admin/icons/bin.svg" width="24px" height="24px" alt="bin">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (!empty($pagination)) echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/' . $this->router->fetch_class() . '/_modal'); ?>