<?php 
    $user_id = $this->session->userdata('member_id');
    $this->db->select('im_receiver.m_id as message_thread_id,im_message.sender as member_id, im_receiver.time as message_thread_time')
        ->join('im_message', 'im_message.m_id = im_receiver.m_id','left')
        ->where("im_receiver.received",0)
        ->where("im_receiver.r_id",$user_id)
        ->where("im_message.sender !=",$user_id)
        ->where("im_message.message !=",'')
        ->group_by("im_receiver.g_id");
    $result =  $this->db->get('im_receiver')->result();

    foreach ($result as $key => $value) {

        $messaging_member_info = $this->db->get_where('member', array('member_id' => $value->member_id))->row();
        $message_time = date("g:i M j, Y", strtotime($value->message_thread_time));
     ?>

        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
           <span class="dropdown-item" id="noti_item">
            <a href="<?= base_url() ?>home/chat/<?= $messaging_member_info->member_id ?>" style="color: #444">
                <small class="sml_txt">
                    <img src="<?= base_url() ?>uploads/profile_image/<?= $messaging_member_info->member_id.'/'.$messaging_member_info->profile_image ?>" class="dropdown-image rounded-circle">
                    <span class=""><?= translate('last_conversation_with') ?> <a class="c-base-1" href="<?= base_url() ?>home/member_profile/<?= $messaging_member_info->member_id ?>"><?= $this->Crud_model->get_type_name_by_id('member', $messaging_member_info->member_id, 'display_member'); ?></a> <?= translate('in') ?> <br></span>
                    <small class="pull-right sml_txt" id="<?php echo "convoTime".$key; ?>" style="margin-top: -14px; padding-right: 19px;font-family: sans-serif; font-weight: 400px"><?= $message_time ?></small>
                </small>
            </a>
           </span>
           <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>

    <?php } ?> 