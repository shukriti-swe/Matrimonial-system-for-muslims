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
                <h3 class="panel-title"><?php echo translate('chats_list')?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <table id="chats_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>
                                <?php echo translate('message_from')?>
                            </th>
                            <th>
                                <?php echo translate('message_to')?>
                            </th>
                            <th data-sortable="false">
                                <?php echo translate('message_text')?>
                            </th>
                            <th data-sortable="false">
                                <?php echo translate('message_time')?>
                            </th>
                            <th data-sortable="false">
                                <?php echo translate('Reply')?>
                            </th>
                            <!-- <th width="20%" data-sortable="false">
                                <?php //echo translate('options')?>
                            </th> -->
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--===================================================-->
        <!-- End Striped Table -->
    </div>
    <!--===================================================-->
    <!--End page content-->
</div>
<style>
    #validation_info p {
        margin: 0px;
        color: #DE1B1B;
    }
</style>
<!--Default Bootstrap Modal-->
<!--===================================================-->
<div class="modal fade" id="chats_modal" role="dialog" tabindex="-1" aria-labelledby="chats_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <!--Modal body-->
            <div class="modal-body" id="modal_body" style="word-wrap: break-word">

            </div>
            <div class="col-sm-12 text-center" id="validation_info" style="margin-top: -30px">

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                <!-- <button class="btn btn-primary btn-sm" id="save_contact_messages" value="0"><?php echo translate('save')?></button> -->
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Bootstrap Modal-->
<!--Default Bootstrap Modal For DELETE-->
<!--===================================================-->
<div class="modal fade"  id="delete_modal" role="dialog" tabindex="-1" aria-labelledby="delete_modal" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title"><?php echo translate('confirm_delete')?></h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <p><?php echo translate('are_you_sure_you_want_to_delete_this_message?')?></p>
                <div class="text-right">
                    <button data-dismiss="modal" class="btn btn-default btn-sm" type="button" id="modal_close"><?php echo translate('close')?></button>
                    <button class="btn btn-danger btn-sm" id="delete_message" value=""><?php echo translate('delete')?></button>
                </div>
            </div>

        </div>
    </div>
</div>
<!--===================================================-->
<!-- Modal -->
<div class="modal fade" id="sendReplyByFakeMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document" style="width: 30%;border:1px solid gray;border-radius: 5px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <input type="hidden" name="from_id" id="from_id" value="">
            <input type="hidden" name="to_id" id="to_id" value="">
            <input type="hidden" name="g_id" id="g_id" value="">
            <div class="form-group">
                <textarea class="form-control"  name="reply_message" id="reply_message" rows="3" style="border:1px solid gray;border-radius: 5px;" placeholder="type message here..."></textarea>
            </div>
            <div class="modal-footer" style="padding: 0;border: none;">
                <button type="button" id="send_message_by_fake" class="btn btn-primary right" style="border-radius: 5px;">Send</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--End Default Bootstrap Modal For DELETE-->
<script>
    function dateFunc(dateStr, index){
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        const days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        let dateObj = new Date(dateStr);
        let month = monthNames[dateObj.getMonth()];
        let day = String(dateObj.getDate()).padStart(2, '0');
        let dayStr = days[ dateObj.getDay() ];
        let year = dateObj.getFullYear();
        let timezoneDate = dayStr + ', ' + month  + '\n'+ day  + ', ' + year;
        timezoneTime = new Date(dateStr).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        $('.timezone'+index).html(timezoneTime +" "+ timezoneDate);
    }
</script>

<script>
    setTimeout(function() {
        $('#success_alert').fadeOut('fast');
        $('#danger_alert').fadeOut('fast');
    }, 5000); // <-- time in milliseconds
</script>
<script>
    $(document).ready(function () {
        $('#chats_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo base_url('admin/chats/list_data') ?>",
                "dataType": "json",
                "type": "POST",
                "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
            },
            "columns": [
                { "data": "message_from" },
                { "data": "message_to" },
                { "data": "message_text" },
                { "data": "message_time" },
                { "data": "reply" },
                // { "data": "options" },
            ],
            "drawCallback": function( settings ) {
                $('.add-tooltip').tooltip();
            },
            "createdRow": function( row, data, dataIndex){
                if (data.msgFromMembership == "4" || data.msgToMembership == "4") {
                    $(row).css('background-color', '#ff726f');
                }
            }
        });
    });
</script>
<script>
    function delete_message(id){
        $("#delete_message").val(id);
    }

    $("#delete_message").click(function(){
        $.ajax({
            url: "<?=base_url()?>admin/chats/delete/"+$("#delete_message").val(),
            success: function(response) {
                window.location.href = "<?=base_url()?>admin/chats";
            },
            fail: function (error) {
                debugger
                alert(error);
            }
        });
    })
</script>
<!-- added AS -->
<script>
   
    function sendMessage(t,f,m){

        $('#from_id').val(t);
        $('#to_id').val(f);
        $('#g_id').val(m);
    }


    $('#send_message_by_fake').click(function(){
       var from_id = $('#from_id').val();
       var to_id   = $('#to_id').val();
       var g_id    =  $('#g_id').val();
       var reply_message    =  $('#reply_message').val();

      formData = {'from_id': from_id, 'to_id': to_id, 'g_id': g_id,'reply_message':reply_message}

        $.ajax({
            type: 'POST',
            dataType:'text',
            data: formData,
            url: "<?=base_url()?>admin/fake_message_reply/",
            success: function(data){
                if (data == "success")
                {
                    window.location.href = "<?=base_url()?>admin/chats";
                }
            },
            fail: function (error) {
                alert(error);
            }
        });
    })



</script>