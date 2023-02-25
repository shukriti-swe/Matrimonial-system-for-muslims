<?php foreach ($premium_members as $premium_member): ?>
<?php
    $basic_info = $this->Crud_model->get_type_name_by_id('member', $premium_member->member_id, 'basic_info');
    $basic_info_data = json_decode($basic_info, true);

?>
    <div class="swiper-slide" data-swiper-autoplay="2000">
        <div class="block block--style-5">
            <div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member p-2" >
             <h3 class="heading heading-5 premium_heading" style="TEXT-ALIGN: center;"><?=$premium_member->display_member?></h3>
                <div class="profile-picture profile-picture--style-2">
                    <center>
                        <?php
                            $image = json_decode($premium_member->profile_image, true);
                            if (file_exists('uploads/profile_image/'.$premium_member->member_id.'/'.$premium_member->profile_image)) {
                            ?>
                            <?php
                                $pic_privacy = $premium_member->pic_privacy;
                                $pic_privacy_data = json_decode($pic_privacy, true);
                                $is_premium = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                                if($pic_privacy_data[0]['profile_pic_show']=='only_me'){
                                    if($premium_member->member_id != $this->session->userdata('member_id')){

                            ?>
                                <img loading="lazy" src="<?=base_url()?>uploads/profile_image/default.jpg" style='border-radius: 50%; width: 130px;height: 130px;margin:0px' >
                              
                            <?php }else{ ?>
                                <img loading="lazy" src="<?=base_url()?>uploads/profile_image/<?=$premium_member->member_id.'/'.$premium_member->profile_image?>" style='border-radius: 50%; width: 130px;height: 130px;margin:-5px' >
                                
                                <?php } }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium>=2) {
                                ?>
                                    <img loading="lazy" src="<?=base_url()?>uploads/profile_image/<?=$premium_member->member_id.'/'.$premium_member->profile_image?>" style='border-radius: 50%; width: 130px;height: 130px;margin:-5px' >
                                
                                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='premium' and $is_premium==1) {
                                ?>
                                    <img loading="lazy" src="<?=base_url()?>uploads/profile_image/default.jpg" style='border-radius: 50%; width: 130px;height: 130px;margin:0px' >
                                <?php }elseif ($pic_privacy_data[0]['profile_pic_show']=='all') {
                                ?>
                                <img loading="lazy" src="<?=base_url()?>uploads/profile_image/<?=$premium_member->member_id.'/'.$premium_member->profile_image?>" style='border-radius: 50%; width: 140px;height: 140px;margin:-5px'>
                               
                            <?php }else{ ?>
                                <img loading="lazy" src="<?=base_url()?>uploads/profile_image/default.jpg" style='border-radius: 50%; width: 130px;height: 130px;margin:0px' >
                            <?php }
                            }
                            else {
                            ?>
                               <img loading="lazy" src="<?=base_url()?>uploads/profile_image/default.jpg" style='border-radius: 50%; width: 130px;height: 130px;margin:0px'>
                            <?php
                            }
                        ?>
                    </center>
                </div>
                <div class="card-body text-center">
                    <div style="font-size: 13px;TEXT-ALIGN: left;">
                    <span class=""><b>Age:</b> <?php  $calculated_age = (date('Y') - date('Y', $premium_member->date_of_birth));   echo $calculated_age;  ?></span><br>
                    <span class=""><b>State:</b>  <?php echo $this->Crud_model->get_type_name_by_id('country', $basic_info_data[0]['grew_up'])?></span><br/>
                    <span class=""><b>Profession:</b>  <?php echo $this->Crud_model->get_type_name_by_id('profession', $basic_info_data[0]['profession'])?></span><br/>
                    <span class=""><b>Gender:</b>
                        <?php
                            $this->db->select('gender.name');
                            $this->db->from('gender');
                            $this->db->join('member', 'member.gender = gender.gender_id');
                            $this->db->where('member.gender', $premium_member->gender);
                            $query = $this->db->get();
                            if (!empty($query->num_rows()))
                            {
                                //Use row() to get a single result
                                $gender = $query->row();
                                echo $gender->name;
                            }
                        ?>
                    </span><br/>
                    
                    </div>
                    <?php if($premium_member->member_id == $this->session->userdata('member_id')){ ?>
                        <a href="<?=base_url()?>home/profile" class="btn btn-styled btn-xs btn-base-1 z-depth-2-bottom mt-2 text-white"><?=translate('full_profile')?></a>
                    <?php } else { ?>
                        <a class="btn btn-styled btn-xs btn-base-1 z-depth-2-bottom mt-2 text-white" onclick="return goto_profile(<?=$premium_member->member_id?>)"><?=translate('full_profile')?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>