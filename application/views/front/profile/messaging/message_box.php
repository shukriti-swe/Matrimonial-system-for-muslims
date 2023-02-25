<style>
	#message_form div {
		z-index: 111 !important;
	}
</style>


<div class="card direct-chat direct-chat-warning">
	<div class="card-header with-border card-bg">
		<h4 class="card-inner-title">
			<span id="msg_box_header">CHAT ROOM</span>
		</h4>
		<div class="pull-right">
			<small id="msg_refresh">
			</small>
		</div>
	</div>
	<div class="card-body">
		<!-- Conversations are loaded here -->
		<div class="direct-chat-messages" id="msg_body" style="height: 100px">

		</div>
	</div>
	<div class="card-footer" style="padding: 5px 0; ">
		<form class="form-default" id="message_form" name="message_form">
			<?php
				 $fromMember_id = $this->session->userdata('member_id');
				 $membership = $this->Crud_model->get_type_name_by_id('member', $fromMember_id, 'membership');
				 if($membership == 1){
			 ?>
				<span>Click to send a message:</span><br>

				<a><span class="badge badge-pill badge-light p-2 mb-2" id="msgText1" onclick="sendSelectedMsg($(this).text())">ASA, can we get to know one another?</span></a>
				<a><span class="badge badge-pill badge-light p-2 mb-2" id="msgText2" onclick="sendSelectedMsg($(this).text())">ASA, would you be interested in viewing my profile?</span></a>
				<a><span class="badge badge-pill badge-light p-2 mb-2" id="msgText3" onclick="sendSelectedMsg($(this).text())">Your profile looks great! May we connect?</span></a>
				<input type="hidden" id="msg_text" name="message_text" class="form-control" value="">
				<div class="input-group-btn">
					<button type="button" class="btn btn-base-1 btn-sm btn-flat enterer" id="msg_send_btn"  style="display: none">Send</button>
				</div>
			<?php
			}
			else
			{
			?>
			<div class="d-flex ">
	  			<div class="w-100">
	  				<div class="input-group">
						<?php
							$member_id = $get_member[0]->member_id;
							$is_deleted = $this->Crud_model->get_type_name_by_id('member', $member_id, 'is_deleted');

							$logInMemberMembership = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');

                            $otherMemberMembership = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'membership');

							if ( ($is_deleted == 0) && ($logInMemberMembership != 4 || $otherMemberMembership != 4) ) { ?>

							<textarea id="message_text" name="message_text" class="form-control" placeholder="Type Message ..." style="z-index: 2;" rows="3"></textarea>

						<?php } else { ?>

							<input type="text" disabled placeholder="Type Message ..." value="" class="form-control" style="z-index: 2; background: #D3D3D3">
						<?php } ?>
					</div>
	  			</div>
	  			<div class="flex-shrink-1">
	  				<div class="input-group-btn">
						<button type="button" class="btn btn-base-1 btn-flat enterer " id="msg_send_btn" onclick="sendSelectedMsg(this.id)">Send</button>
					</div>
				</div>
			</div>
		</form>
		<!-- <div class="input-group-btn">
			<button type="button" class="btn btn-base-1 btn-flat enterer fs-10" id="msg_send_btn" onclick="sendSelectedMsg(this.id)" style="width: 60px">Send</button>
		</div> -->
		<?php } ?>
	</div>
</div>

<script>
	function sendSelectedMsg(param)
    {
        if (param != "msg_send_btn")
        {
            // console.log(param);
            $("#msg_text").val(param)
            $("#msg_send_btn").trigger('click');
        }
    }
</script>