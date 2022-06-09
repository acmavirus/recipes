<table class="table align-middle table-nowrap mb-0">
    <thead class="table-light">
        <tr>
            <th style="width: 20px;">
                <div class="form-check font-size-16 align-middle">
                    <input class="form-check-input" type="checkbox" id="transactionCheck01">
                    <label class="form-check-label" for="transactionCheck01"></label>
                </div>
            </th>
            <?php if (!empty($listkey)) foreach ($listkey as $key) : ?>
                <th class="align-middle"><?php echo $key; ?></th>
            <?php endforeach; ?>
            <th class="align-middle">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($menu_groups)) foreach ($menu_groups as $key => $item) : $item = (array)$item; ?>
            <tr>
                <td>
                    <div class="form-check font-size-16">
                        <input class="form-check-input" type="checkbox" name="listid[]" value="<?php echo $item['id']; ?>">
                        <label class="form-check-label" for="transactionCheck02"></label>
                    </div>
                </td>
                <?php if (!empty($listkey)) foreach ($listkey as $key) : ?>
                    <td id="<?php echo $key; ?>" data-key="<?php echo $key; ?>"><?php echo $item[$key]; ?></td>
                <?php endforeach; ?>

                <td>
                    <div class="d-flex gap-3" id="action">
                        <a href="javascript:void(0);" data-id="<?php echo $item['id']; ?>" class="text-success" data-bs-toggle="modal" data-bs-target="#modalEditGroup"><i class="mdi mdi-pencil font-size-18"></i></a>
                        <a href="javascript:void(0);" data-id="<?php echo $item['id']; ?>" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteGroup"><i class="mdi mdi-delete font-size-18"></i></a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>