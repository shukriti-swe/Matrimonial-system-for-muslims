<div class="direct-chat-contacts">
    <ul class="contacts-list">
        <div class="pt-3 pb-2 text-center" style="border-bottom: 1px solid rgba(0, 0, 0, .15); margin: 0; width: 90% !important; margin-left: 5%;">
            <h4 class="card-inner-title text-uppercase c-base-1"><i class="fa fa-users"></i> <?php echo translate('new_messages')?></h4>
        </div>
        <?php
        $listed_messaging_members = $this->Crud_model->get_listed_messaging_members($this->session->userdata('member_id'));
        ?>
        <?php foreach ($listed_messaging_members as $listed_member): ?>

        <?php if($listed_member['member_id'] === $get_member[0]->member_id){ ?>
            <?php if (isset($this->db->get_where('member', array('member_id' => $listed_member['member_id']))->row()->member_id)):

                $member_info = $this->db->get_where('member', array('member_id' => $listed_member['member_id']))->row();
                $displayMember = $member_info->display_member;
                if ($member_info->is_closed=='no') {
                    ?>
                    <li>
                        <a onclick="open_message_box(<?=$listed_member['message_thread_id']?>,this,'<?=$displayMember?>')" id="thread_<?=$listed_member['message_thread_id']?>">
                            <?php
                            $images = json_decode($member_info->profile_image, true);
                            if (file_exists('uploads/profile_image/'.$images[0]['thumb'])) {
                                ?>
                                <img class="contacts-list-img" src="<?=base_url()?>uploads/profile_image/<?=$images[0]['thumb']?>">
                                <?php
                            }
                            else {
                                ?>
                                <img class="contacts-list-img" src="<?=base_url()?>uploads/profile_image/default_image.png">
                                <?php
                            }
                            ?>
                            <div class="contacts-list-info">
                            <span class="contacts-list-name" data-member="<?=$member_info->member_id?>">
                                <?=$member_info->display_member?>
                                <?php if($member_info->isOnline != 0 && $member_info->isOnline > strtotime(date('Y-m-d H:i:s')) ){ ?>
                                    <span class="onlineDot"></span>
                                <?php }else{ ?>
                                    <span class="offlineDot"></span>
                                <?php } ?>
                            </span>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            <?php endif ?>
            <?php } ?>
        <?php endforeach ?>
    </ul>
</div>

<script>
    $("document").ready(function() {
        <?php  $uri = $_SERVER['HTTP_REFERER']; ?>
        <?php  $uri = explode("/", $uri); ?>
        <?php $id = $uri[count($uri) - 1]; ?>
        var id = "<?php echo $id; ?>";

        $.ajax({
            type: "POST",
            data: {id: id},
            dataType: 'json',
            url: "<?= base_url() ?>home/get_message_thread/" + id ,
            cache: false,
            success: function(response) {
                var thread_id = response;
                open_message_box(thread_id,100);
            }
        });

    });
</script>