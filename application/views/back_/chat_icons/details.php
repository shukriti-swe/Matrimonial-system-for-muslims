<table class="table-responsive icon_details">
        <tr>
                <td rowspan="3">
                        <img src="<?= $data->thumbnails; ?>">
                </td>
                <th>Name</th>
                <td><?= translate($data->name); ?></td>
        </tr>
        <tr>
                <th>Icons</th>
                <td><?= $data->count; ?></td>
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
<ul class="ChatIconsOrigin">
        <?php foreach ($icons as $row) { ?>
                <li>
                        <img title="<?= $row->tittle; ?>" src="<?= $row->icon; ?>" />
                </li>
        <?php } ?>
</ul>
<style>
        .icon_details th {
                padding-right: 14px;
        }

        .icon_details td img {
                min-width: 100px;
                min-height: 100px;
                margin: 0 5px;
        }

        ul.ChatIconsOrigin {
                list-style: none;
                padding: 5px;
                overflow: auto;
                border: 1px solid #c1c1c1;
                white-space: nowrap;
        }

        ul.ChatIconsOrigin li {
                display: inline-block;
                width: calc(20% - 10px);
                max-height: 150px;
                margin: 2px 5px;
        }

        ul.ChatIconsOrigin li img {
                width: 100%;
                max-height: 150px
        }
</style>