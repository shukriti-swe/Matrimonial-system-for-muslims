<sup class="badge bg-base-1 noti_badge msg_counter" style="display: none;">
        <!-- Counts Messages with JavaScript  --> </sup>
<div class="dropdown-menu dropdown-menu-right dropdown-scale" style="max-height: 300px;overflow: auto;">
        <h6 class="dropdown-header"><?php echo translate('messages') ?></h6>
        <?php
        $listed_messaging_members = $this->Crud_model->get_listed_messaging_members($this->session->userdata('member_id'));
        sort_array_of_array($listed_messaging_members, 'message_thread_time', SORT_DESC);
        foreach ($listed_messaging_members as $key => $messaging_member) {
                if ($this->db->get_where("member", array("member_id" => $messaging_member['member_id']))->row()->is_closed == 'no') {
                        if ($this->db->get_where('member', array('member_id' => $messaging_member['member_id']))->row()->member_id) {
                                $member = $this->session->userdata('member_id');
                                if (!$this->Crud_model->is_message_thread_seen($messaging_member['message_thread_id'], $member)) {
                                        $msg_counter++;
                                }
                                $messaging_member_info = $this->db->get_where('member', array('member_id' => $messaging_member['member_id']))->row();
        ?>
                                <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
                                <span class="dropdown-item" id="noti_item">
                                        <!-- <a href="<?= base_url() ?>home/profile/nav/messaging/<?= $messaging_member['message_thread_id'] ?>" style="color: #444"> -->
                                        <a href="<?= base_url() ?>home/chat/<?= $messaging_member_info->member_id ?>" onclick="initChat(true,<?= $messaging_member['message_thread_id'] ?>,this)" style="color: #444">
                                                <small class="sml_txt">
                                                        <?php
                                                        $msg_profile_image = $this->Crud_model->get_type_name_by_id('member', $messaging_member_info->member_id, 'profile_image');
                                                        $isProfileImgApproved = $this->Crud_model->get_type_name_by_id('member', $messaging_member_info->member_id, 'is_profile_img_approved');
                                                        if (file_exists('uploads/profile_image/' . $messaging_member_info->member_id.'/'.$msg_profile_image) && $isProfileImgApproved == 1) {
                                                        ?>
                                                                <img src="<?= base_url() ?>uploads/profile_image/<?= $messaging_member_info->member_id.'/'.$msg_profile_image ?>" class="dropdown-image rounded-circle">
                                                        <?php
                                                        } else {
                                                        ?>
                                                                <img src="<?= base_url() ?>uploads/profile_image/default.jpg" class="dropdown-image rounded-circle">
                                                        <?php
                                                        }
                                                        ?>
                                                        <span class=""><?= translate('last_conversation_with') ?> <a class="c-base-1" href="<?= base_url() ?>home/member_profile/<?= $messaging_member_info->member_id ?>"><?= $this->Crud_model->get_type_name_by_id('member', $messaging_member_info->member_id, 'display_member'); ?></a> <?= translate('in') ?> <br></span>
                                                        <small class="pull-right sml_txt" id="<?php echo "convoTime".$key; ?>" style="margin-top: -14px; padding-right: 19px;"><i class="c-base-1 fa fa-clock-o"></i> </small>
                                                </small>
                                        </a>
                                </span>
                                <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.07) !important; margin: 0 5%"></div>
                <?php
                        }
                }
                ?>
                <script>
                    $(document).ready(function(){
                        msgTime = "<?php echo $messaging_member['message_thread_time']; ?>";
                        let index = "<?php echo $key; ?>";
                        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
                        let dateObj = new Date(msgTime);
                        let month = monthNames[dateObj.getMonth()];
                        let day = String(dateObj.getDate()).padStart(2, '0');
                        let year = dateObj.getFullYear();
                        let timezoneDate = month  + '\n'+ day  + ', ' + year;
                        timezoneTime = new Date(msgTime).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

                        document.getElementById('convoTime'+index).innerHTML = timezoneTime +" "+ timezoneDate;
                    });
                </script>
                <?php 

            }
        if (count($listed_messaging_members) <= 0) {
                ?>
                <div class="text-center">
                        <small class="sml_txt">
                                <?php echo translate('no_messages_to_show') ?>
                        </small>
                </div>
        <?php
        }
        ?>
</div>

<script>
    function dateFunc(dateStr, index){
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        let dateObj = new Date(dateStr);
        let month = monthNames[dateObj.getMonth()];
        let day = String(dateObj.getDate()).padStart(2, '0');
        let year = dateObj.getFullYear();
        let timezoneDate = month  + '\n'+ day  + ', ' + year;
        timezoneTime = new Date(dateStr).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        $('.timezone'+index).html(timezoneTime +" "+ timezoneDate);
    }
</script>