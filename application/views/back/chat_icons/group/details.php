<? print_r($data);?>
<table class="table-responsive icon_details">
        <tr>
                <td rowspan="3">
                        <img src="<?= $data->icon; ?>">
                </td>
                <th>Name</th>
                <td><?= $data->tittle; ?></td>
        </tr>
        <tr>
                <th>Head</th>
                <td><?= $data->parent; ?></td>
        </tr>
        <tr>
                <td colspan="2">
                        <?php if ($data->isActive) { ?>
                                <span class="badge badge-primary badge-block badge-sm">Active</span>
                        <?php } else { ?>
                                <span class="badge badge-danger badge-block badge-sm">Inactive</span>
                        <?php } ?>
                </td>
        </tr>
</table>
<style>
        .icon_details th {
                padding-right: 14px;
        }

        .icon_details td img {
                width: 100px;
                margin: 0 5px;
        }
</style>