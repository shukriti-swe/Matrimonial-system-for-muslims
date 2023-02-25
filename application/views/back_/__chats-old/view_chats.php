<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <div id="page-head">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow"><?php echo translate('chats')?></h1>

        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->
        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="#"><?php echo translate('home')?></a></li>
            <li class="active"><a href="#"><?php echo translate('chats')?></a></li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->
    </div>
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <?php if (!empty($success_alert)): ?>
                <div class="alert alert-success" id="success_alert" style="display: block">
                    <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                    <?=$success_alert?>
                </div>
            <?php endif ?>
            <?php if (!empty($danger_alert)): ?>
                <div class="alert alert-danger" id="danger_alert" style="display: block">
                    <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                    <?=$danger_alert?>
                </div>
            <?php endif ?>
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo translate('view_chats')?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php
                    foreach ($get_message as $row) {
                    ?>
                    <table class="table table-striped table-bordered dataTable no-footer">
                        <tr>
                            <th class="custom_td"><?php echo translate('message_to'); ?></th>
                            <td class="custom_td">
                                <?php echo $row->message_to ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('message_from'); ?></th>
                            <td class="custom_td">
                                <?php echo $row->message_from ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('message_text'); ?></th>
                            <td class="custom_td">
                                <?php echo $row->message_text?>
                            </td>
                        </tr>
                        <tr>
                            <th class="custom_td"><?php echo translate('message_time'); ?></th>
                            <td class="custom_td">
                                <?php echo date('d M,Y h:i:s', $row->timestamp); ?>
                            </td>
                        </tr>
                    </table>
                    <div class="col-sm-12 text-center">
                        <a href="<?=base_url()?>admin/chats" class="btn btn-danger btn-sm btn-labeled fa fa-step-backward"><?php echo translate('go_back')?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
        <!-- End Striped Table -->
    </div>
    <!--===================================================-->
    <!--End page content-->
</div>

