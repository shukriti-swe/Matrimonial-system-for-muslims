<!-- <div class="card-title">
    <h3 class="heading heading-6 strong-500">
        <b><?php //echo translate('messaging')?></b>
    </h3>
</div> -->
<!--<a href="#" class="heading heading-6 strong-500 closeChat float-right" onclick="closeChatBox()"><i class="ion-close" ></i></a>-->
<div class="card-body">
	<div class="row">
		<?php if ($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes') { ?>
			<div class="col-md-12">
				<p class="c-base-1 pt-4 text-center">"<?php echo translate('your_account_is_closed!_please_re-open_the_account_to_enable_messaging!') ?>"
				</p>
				<div class="text-center pt-2 pb-4">
					<a onclick="profile_load('reopen_account')" href="#" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom"><?php echo translate('re-open_account') ?></a>
				</div>
			</div>
		<?php } else { ?>
			<div class="col-md-8 mb-2">
				<!-- DIRECT CHAT -->
				<div id="profile_message_box">
					<?php include 'message_box.php'; ?>
				</div>
				<!--/.direct-chat -->
			</div>
			<!-- /.col -->
			<div class="col-md-4">
				<div id="messaging_member_list">
					<?php include 'member_list.php'; ?>
				</div>
				<style>
					.fs-12{
						font-size: 12px;
					}
				</style>
				<div class="list">
					<?php $membership = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'membership'); ?>
					<h6><b><u>Start Your Conversation</u></b></h6>
					<ol>
						<li>Click on the "New Messages" box</li>
						<li>To Send a Message:</li>
						<ul class="fs-12">
							<li>Platinum Member - Type your text</li>
							<li>Bronze Member - Please select your message</li>
						</ul>
						<li>Please click on the ID again to see if you have received a response</ul>
					</ol>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<script>
    $(document).ready(function(){
        $('.top_bar_right').load('<?php echo base_url(); ?>home/top_bar_right');
        window.addEventListener("keydown", checkKeyPressed, false);
        function checkKeyPressed(e) {
            if (e.keyCode == "13") {
                $(":focus").each(function() {
                    event.preventDefault();
                    $(this).closest('form').find('.enterer').click();
                });
            }
        }

        // $("#message_text").keyup(function(){
        //     if ($("#message_text").val().length != 0) {
        //         $("#msg_send_btn").removeAttr('disabled');
        //     }
        //     else {
        //         $("#msg_send_btn").attr('disabled', 'disabled');
        //     }
        // });
    });
</script>