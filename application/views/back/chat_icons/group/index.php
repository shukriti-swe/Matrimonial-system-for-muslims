<div id="content-container">
        <div id="page-head">
                <div id="page-title">
                        <h1 class="page-header text-overflow">
                                <?php echo translate('icons') ?>
                                <button data-target='#add_modal' data-toggle='modal' class='btn btn-success add-tooltip pull-right' data-toggle='tooltip' data-placement='top' title="<?= translate('add_icons') ?>">Add Icons</button>
                        </h1>
                </div>
                <ol class="breadcrumb">
                        <li><a href="#"><?php echo translate('home') ?></a></li>
                        <li class="active"><a href="#"><?php echo translate('icons') ?></a></li>
                </ol>
        </div>
        <div id="page-content">
                <div class="panel">
                        <?php if (!empty($this->session->flashdata('alert'))) : ?>
                                <div class="alert alert-danger" id="success_alert" style="display: block">
                                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                                        <?= $this->session->flashdata('alert') ?>
                                </div>
                        <?php endif ?>
                        <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('icons_list') ?></h3>
                        </div>
                        <div class="panel-body">
                                <table id="chatIconsTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                                <tr>
                                                        <th width="25%" data-sortable="false">
                                                                <?php echo translate('icon') ?>
                                                        </th>
                                                        <th>
                                                                <?php echo translate('title') ?>
                                                        </th>
                                                        <th>
                                                                <?php echo translate('head') ?>
                                                        </th>
                                                        <th>
                                                                <?php echo translate('Status') ?>
                                                        </th>
                                                        <th width="13%" data-sortable="false">
                                                                <?php echo translate('options') ?>
                                                        </th>
                                                </tr>
                                        </thead>
                                </table>
                        </div>
                </div>
        </div>
</div>

<div class="modal fade" id="view_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                        <!--Modal header-->
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                                <h4 class="modal-title"><?php echo translate('chat_icons_details') ?></h4>
                        </div>
                        <!--Modal body-->
                        <div class="modal-body">
                                <div id="ChatIconDetails">
                                        <p>Fetching data</p><i class="fa fa-spin fa-spinner"></i>
                                </div>
                                <div class="text-right">
                                        <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close') ?></button>
                                </div>
                        </div>

                </div>
        </div>
</div>
<div class="modal fade" id="edit_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
        <div class="modal-dialog" style="width: 400px;">
                <div class="modal-content">
                        <!--Modal header-->
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                                <h4 class="modal-title"><?php echo translate('edit_chat_icons') ?></h4>
                        </div>
                        <!--Modal body-->
                        <div class="modal-body">
                                <form class="form-horizontal" method="POST" action="<?= base_url('admin/group_icon_edit/') ?>do_add" enctype="multipart/form-data">
                                        <div id="ChatIconEdit">
                                        </div>
                                        <div class="text-right">
                                                <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close') ?></button>
                                                <button class="btn btn-primary btn-sm" type="submit" value=""><?php echo translate('confirm') ?></button>
                                        </div>
                                </form>
                        </div>

                </div>
        </div>
</div>
<div class="modal fade" id="delete_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
        <div class="modal-dialog" style="width: 400px;">
                <div class="modal-content">
                        <!--Modal header-->
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                                <h4 class="modal-title"><?php echo translate('confirm_delete') ?></h4>
                        </div>
                        <!--Modal body-->
                        <div class="modal-body">
                                <p><?php echo translate('are_you_sure_you_want_to_delete_this_icons?') ?></p>
                                <div class="text-right">
                                        <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close') ?></button>
                                        <button class="btn btn-danger btn-sm" onclick='ConfirmDel()'><?php echo translate('delete') ?></button>
                                </div>
                        </div>

                </div>
        </div>
</div>

<div class="modal fade" id="add_modal" role="dialog" tabindex="-1" aria-labelledby="add_modal" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                        <!--Modal header-->
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                                <h4 class="modal-title"><?php echo translate('add_chat_icons') ?></h4>
                        </div>
                        <!--Modal body-->
                        <div class="modal-body">
                                <form id="add_iconss" class="form-horizontal" method="POST" action="<?= base_url('admin/group_icon_add') ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                                <label class="col-sm-3 control-label"><b>Head <span class="text-danger">*</span></b></label>
                                                <div class="col-sm-8">
                                                        <select class="form-control" name="head">
                                                                <option value="0">Select Head</option>
                                                                <?php foreach ($heads as $row) { ?>
                                                                        <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                                                <?php } ?>
                                                        </select>
                                                </div>

                                                <div class="col-sm-12">
                                                        <label>
                                                                <input type="file" id="icons" name="icons[]" multiple="multiple">
                                                        </label>
                                                </div>
                                        </div>
                                        <ul class="ChatIconsOrigin">
                                                
                                        </ul>
                                        <div class="text-right">
                                                <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close') ?></button>
                                                <button class="btn btn-primary btn-sm" type="submit" value=""><?php echo translate('confirm') ?></button>
                                        </div>
                                </form>
                        </div>

                </div>
        </div>
</div>
<style>
        #ChatIconDetails>.fa-spinner,
        #ChatIconEdit>.fa-spinner {
                display: block;
                width: 60px;
                height: 60px;
                position: relative;
                margin: 40px auto;
                font-size: 60px
        }
        
        ul.ChatIconsOrigin {
                display: none;
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
                max-height: 150px;
                display: block;
        }
        ul.ChatIconsOrigin li input {
                width: 100%;
                display: block;
        }
</style>
<script>
        $(document).ready(function() {
                pageInit();
                var i = 0;
                $('#add_iconss').on('submit', function(e){
                        e.preventDefault();
                        if(i==0){
                                alert("Please Add Some Icons");
                        }else if( $("select[name=head]").val() == 0 ){
                                alert("Please Select Head");
                        }else{
                                $('#add_iconss').unbind().submit();
                        }
                });
                var inputLocalFont = document.getElementById("icons");
                inputLocalFont.addEventListener("change", previewImages, false); //bind the function to the input
                function previewImages() {
                        $('.ChatIconsOrigin').html('');
                        $('.ChatIconsOrigin').show();
                        var fileList = this.files;
                        var anyWindow = window.URL || window.webkitURL;
                        for (i = 0; i < fileList.length; i++) {
                                //get a blob to play with
                                var objectUrl = anyWindow.createObjectURL(fileList[i]);
                                // for the next line to work, you need something class="preview-area" in your html
                                $('.ChatIconsOrigin').append('<li><input type="text" name="icon_tittle['+i+']" /><img src="' + objectUrl + '" /></li>');
                                // get rid of the blob
                                window.URL.revokeObjectURL(fileList[i]);
                        }
                }
        });

        function pageInit() {
                $('#chatIconsTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                                "url": "<?php echo base_url('admin/group_icons_list') ?>",
                                "dataType": "json",
                                "type": "POST",
                                "data": {
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                }
                        },
                        "columns": [{
                                        "data": "icon"
                                },
                                {
                                        "data": "title"
                                },
                                {
                                        "data": "head"
                                },
                                {
                                        "data": "status"
                                },
                                {
                                        "data": "options"
                                },
                        ],
                        "drawCallback": function(settings) {
                                $('.add-tooltip').tooltip();
                        }
                });
        }

        function GetDetails(id) {
                $('#ChatIconDetails').html('<p>Fetching data</p><i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                        url: "<?= base_url('admin/chat_icons_group/') ?>" + id,
                        success: function(response) {
                                $('#ChatIconDetails').html(response);
                        },
                        fail: function(error) {
                                $('#ChatIconDetails').html("<h3>Data Cannot Found</h3>");
                        }
                });
        }
        var aa = '';

        function delIcons(id) {
                aa = id;
        }

        function ConfirmDel() {
                $.ajax({
                        url: "<?= base_url('admin/group_icons_del/') ?>" + aa,
                        success: function(response) {
                                $('#delete_modal').modal('toggle');
                                alert(response);
                        },
                        fail: function(error) {
                                alert('Invalid Refrence');
                        }
                });
        }

        function EditDetails(id) {
                $('#ChatIconEdit').html('<p>Fetching data</p><i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                        url: "<?= base_url('admin/group_icon_edit/') ?>" + id,
                        success: function(response) {
                                $('#ChatIconEdit').html(response);
                        },
                        fail: function(error) {
                                $('#ChatIconEdit').html("<h3>Data Cannot Found</h3>");
                        }
                });
        }
</script>