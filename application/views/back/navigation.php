 <!--MAIN NAVIGATION-->
<style type="text/css">
	.notification {
	  position: relative;
	  display: inline-block;
	  border-radius: 2px;
	}


	.notification .notification-value {
	    position: absolute;
	    top: -2px;
	    right: -27px;
	    padding: 2px 3px;
	    border-radius: 50%;
	    background-color: red;
	    color: white;
	    height: 20px;
	    width: 20px;
	}

	.member-notification {
	  position: relative;
	  display: inline-block;
	  border-radius: 2px;
	}


	.member-notification .member-notification-value {
	  position: absolute;
	  top: -10px;
	  right: -30px;
	  padding: 5px 10px;
	  border-radius: 50%;
	  background-color: red;
	  color: white;
	}

	
</style>
<!--===================================================-->
<nav id="mainnav-container">
<div id="mainnav">
	<!--Menu-->
	<!--================================-->
	<div id="mainnav-menu-wrap">
		<div class="nano">
			<div class="nano-content">
				<ul id="mainnav-menu" class="list-group">
					<li <?php if($page_name=="dashboard"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin">
							<i class="fa fa-home"></i>
							<span class="menu-title"><?php echo translate('dashboard')?></span>
						</a>
					</li>
					<?php 
					$noti = $this->db->where('highlight_new_member',1)->count_all_results('member');
					$noti_platinum = $this->db->where('highlight_new_member',1)->where('membership',2)->where('isProfileCompleted',1)->count_all_results('member');
					$noti_bronze = $this->db->where('highlight_new_member',1)->where('membership',1)->where('isProfileCompleted',1)->count_all_results('member');
					$noti_free = $this->db->where('highlight_new_member',1)->where('membership',3)->where('isProfileCompleted',1)->count_all_results('member');
					$noti_fake = $this->db->where('highlight_new_member',1)->where('membership',4)->where('isProfileCompleted',1)->count_all_results('member');
					$noti_incomlete = $this->db->where('highlight_new_member',1)->where('isProfileCompleted',0)->count_all_results('member');

					if ($this->Crud_model->admin_permission('members')){
                            ?>
					<li <?php if($page_name=="bronze_members"||$page_name=="platinum_members"|| $page_name=="deleted_members" || $page_name=="all_members" || $page_name=="free_members" || $page_name=="fake_members" || $page_name=="incomplete_profiles"){ ?> class="active-sub active" <?php } ?>>
						<a href="#">
							<i class="fa fa-users"></i>
							<span class="menu-title"><?php echo translate('members')?></span>
							<i class="arrow"></i>
								<?php if ($noti > 0): ?>
									<span class="badge badge-success" style="background: red"> <?= $noti; ?> </span>
								<?php endif ?>
						</a>
						<!--Submenu-->
						<ul class="collapse">
							<?php
							
							if ($this->Crud_model->admin_permission('all_members')){
                            ?>
							    <li <?php if($page_name=="all_members"){ ?> class="active-link" <?php } ?>>
									<a href="<?=base_url()?>admin/members/all_members"><i class="fa fa-user"></i><?php echo translate('all_members')?>
									</a>
								</li>
							<?php } if ($this->Crud_model->admin_permission('platinum_members')){?>
    							<li <?php if($page_name=="platinum_members"){ ?> class="active-link" <?php } ?>>
    								<a href="<?=base_url()?>admin/members/platinum_members"><i class="fa fa-user"></i><?php echo translate('platinum_members')?> 
    									
    									<?php if ($noti_bronze > 0): ?>
											<span class="badge badge-success" style="background: red"> <?= $noti_platinum; ?> </span>
										<?php endif ?>
    								</a>
    							</li>
							<?php
							 } if ($this->Crud_model->admin_permission('bronze_members')){?>
    							<li <?php if($page_name=="bronze_members"){ ?> class="active-link" <?php } ?>>
    								<a href="<?=base_url()?>admin/members/bronze_members"><i class="fa fa-user-o"></i><?php echo translate('bronze_members')?>
    								<?php if ($noti_bronze > 0): ?>
										<span class="badge badge-success" style="background: red"> <?= $noti_bronze; ?> </span>
									<?php endif ?>
    							</a>
    							</li>
							<?php } if ($this->Crud_model->admin_permission('free_members')){?>
								<li <?php if($page_name=="free_members"){ ?> class="active-link" <?php } ?>>
									<a href="<?=base_url()?>admin/members/free_members"><i class="fa fa-user"></i><?php echo translate('free_members')?>
									
									</a>
								</li>
							<?php } if ($this->Crud_model->admin_permission('incomplete_profiles')){?>
    							<li <?php if($page_name=="incomplete_profiles"){ ?> class="active-link" <?php } ?>>
									<a href="<?=base_url()?>admin/members/incomplete_profiles"><i class="fa fa-user"></i><?php echo translate('incomplete_profiles')?>
									<?php if ($noti_incomlete > 0): ?>
										<span class="badge badge-success" style="background: red"> <?= $noti_incomlete; ?> </span>
									<?php endif ?>
									</a>
								</li>
							<?php } if ($this->Crud_model->admin_permission('fake_members')){?>
								<li <?php if($page_name=="fake_members"){ ?> class="active-link" <?php } ?>>
									<a href="<?=base_url()?>admin/members/fake_members"><i class="fa fa-user"></i><?php echo translate('fake_members')?>
									
									</a>
								</li>
							<?php } if ($this->Crud_model->admin_permission('disabled_members')){ ?>
							    <li <?php if($page_name=="disabled_members"){ ?> class="active-link" <?php } ?>>
    								<a href="<?=base_url()?>admin/disabled_members"><i class="fa fa-user-times"></i><?php echo translate('disabled_members')?></a>
    							</li>
    						<?php } ?>
						</ul>
					</li>
					<?php } ?>

					<?php 
					
					$notification = count($this->Crud_model->filter_one('cover_pic_payment' , 'start_date' , null)) ;
					if ($this->Crud_model->admin_permission('picture_video_approval')){
                            ?>
					<li <?php if($page_name=="picture_video_approval"||$page_name=="CoverPic_approval"){ ?> class="active-sub active" <?php } ?>>
						<a href="#">
							<i class="fa fa-users"></i>
							<span class="menu-title"><?php echo translate('Photo Screening')?></span>
							<i class="arrow"></i>
							
							<?php if ($notification != 0 || APPROVAL_COUNT != 0): ?>	
								<span class="badge badge-success" style="background: red"> <?= (APPROVAL_COUNT + $notification); ?> </span>
							<?php endif ?>
						</a>
						<!--Submenu-->
						<ul class="collapse">
							<?php
							if ($this->Crud_model->admin_permission('picture_video_approval')){
                            ?>
								<li <?php if($page_name=="picture_video_approval"){ ?> class="active-link" <?php } ?>>
									<a href="<?=base_url()?>admin/picture_video_approval">
										<i class="fa fa-book"></i>
										<span class="menu-title notification"><?php echo translate('picture_/_video_approval') ?>
										<?php if (APPROVAL_COUNT != 0) { ?>
												<span class="notification-value"><?= APPROVAL_COUNT; ?></span>
										 <?php }?></span>
									</a>
								</li>
							<?php } if ( $this->Crud_model->admin_permission('CoverPic_approval') ){
			                            ?>
								<li <?php if($page_name=="CoverPic_approval"){ ?> class="active-link" <?php } ?>>
									<a href="<?=base_url()?>admin/CoverPic_approval">
										<i class="fa fa-book"></i>
										<span class="menu-title"><?php echo translate('CoverPic_approval')?></span>&nbsp;
										<span class="badge badge-danger" style="background: red"> <?= $notification; ?> </span>
									</a>
								</li>
    						<?php } ?>
						</ul>
					</li>

				    <?php }
				    $ads_notification = count($this->db->where('status',3)->where('payment_status !=',0)->get('advertisements')->result());
				     if ($this->Crud_model->admin_permission('advertisement')){ ?>
							<li <?php if($page_name=="advertisements"){ ?> class="active-link" <?php } ?>>

								<a href="<?=base_url()?>admin/advertisements">
									<i class="fa fa-circle-o"></i> 
									<span class="menu-title"><?php echo translate('advertisements')?></span>&nbsp;  
									
									<?php if ($ads_notification != 0) { ?>
									<span class="badge badge-danger" style="background: red" id="countAdvertisement"> <?= $ads_notification; ?> </span>
									<?php }?></span>
								</a>
							</li>
					<?php }if ($this->Crud_model->admin_permission('earnings')){
                            ?>
					<li <?php if($page_name=="earnings"||$page_name=="ads_earnings"|| $page_name=="coverPic_earnings"){ ?> class="active-sub active" <?php } ?>>
						<a href="#">
							<i class="fa fa-usd"></i>
							<span class="menu-title"><?php echo translate('earnings')?></span>
							<i class="arrow"></i>
						</a>
						<!--Submenu-->
						<ul class="collapse">
							
							<?php if ($this->Crud_model->admin_permission('earnings')){ ?>
							<li <?php if($page_name=="earnings"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/earnings">
									<i class="fa fa-usd"></i>
									<span class="menu-title"><?php echo translate('platinum_earnings')?></span>
								</a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('earnings')){ ?>
							<li <?php if($page_name=="ads_earnings"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/ads_earnings">
									<i class="fa fa-usd"></i>
									<span class="menu-title"><?php echo translate('advertisement_earnings')?></span>
								</a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('earnings')){?>
							<li <?php if($page_name=="coverPic_earnings"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/coverPic_earnings">
									<i class="fa fa-usd"></i>
									<span class="menu-title"><?php echo translate('Cover_picture_earnings')?></span>
								</a>
							</li>
    						<?php } ?>
						</ul>
					</li>
					<?php }if ($this->Crud_model->admin_permission('advertisement')){
                            ?>
					<li <?php if($page_name=="packages"||$page_name=="coverPic"|| $page_name=="ads_plan"){ ?> class="active-sub active" <?php } ?>>
						<a href="#">
							<i class="fa fa-users"></i>
							<span class="menu-title"><?php echo translate('packages')?></span>
							<i class="arrow"></i>
						</a>
						<!--Submenu-->
						<ul class="collapse">
							
						<?php if ($this->Crud_model->admin_permission('platinum_plans')){
		                            ?>
							<li <?php if($page_name=="packages"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/packages">
									<i class="fa fa-book"></i>
									<span class="menu-title"><?php echo translate('platinum_packages')?></span>
								</a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('cover_pic')){?>
							<li <?php if($page_name=="coverPic"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/coverPic">
									<i class="fa fa-picture-o"></i>
									<span class="menu-title"><?php echo translate('cover_picture_packages')?></span>
								</a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('advertisement')){?>
							<li <?php if($page_name=="ads_plan"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/ads_plan">
									<i class="fa fa-picture-o"></i>
									<span class="menu-title"><?php echo translate('advertisement_packages')?></span>
								</a>
							</li>
    						<?php } ?>
						</ul>
					</li>
					<!-- added AS -->
					<?php
						$this->db->select('im_receiver.serial,membership');
                        $this->db->from('im_receiver');
        				$this->db->join('member','member.member_id =im_receiver.r_id','left');
        				$this->db->join('im_message','im_message.m_id =im_receiver.m_id','left');
                        $this->db->where('member.membership',4);
                        $this->db->where('im_receiver.received',0);
                        $this->db->where('im_message.sender != im_receiver.r_id');
                        $result =  $this->db->get();
						 //echo "<pre>";
						 //print_r($result);die();
                        $fakeMessage = $result->num_rows();
					?>
					 <?php } if ($this->Crud_model->admin_permission('chats')){?>
                        <li <?php if($page_name=="chats"){ ?> class="active-link" <?php } ?>>
                            <a href="<?=base_url()?>admin/chats">
                                <i class="fa fa-comments-o"></i>
                                <span class="menu-title"><?php echo translate('chats')?>
								    <span class="badge badge-success" style="background: red"> <?= $fakeMessage; ?> </span>
								</span>
                            </a>
                        </li>
			
				
									
					<li <?php if($page_name=="paypal_plan"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin/paypal_plans"><i class="fa fa-circle-o"></i>Paypal Plan</a>
					</li>
			
			
					<?php } if ($this->Crud_model->admin_permission('contact_messages')){ ?>
					<li <?php if($page_name=="contact_messages"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin/contact_messages">
							<i class="fa fa-envelope-o"></i>
							<span class="menu-title"><?php echo translate('contact_messages')?></span>
						</a>
					</li>
					<?php } if ($this->Crud_model->admin_permission('general_settings')){ ?>
					<li <?php if($page_name=="general_settings"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin/general_settings">
							<i class="fa fa-cog"></i>
							<span class="menu-title"><?php echo translate('general_settings')?></span>
						</a>
					</li>
					
					<?php } if ($this->Crud_model->admin_permission('general_settings')){ ?>
					<li <?php if($page_name=="social_media_setting"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin/social_media_setting">
							<i class="fa fa-cog"></i>
							<span class="menu-title"><?php echo translate('social_media_setting')?></span>
						</a>
					</li>
					<?php } if ($this->Crud_model->admin_permission('frontend_settings')){?>
					<li <?php if($page_name=="header"||$page_name=="pages"||$page_name=="footer"||$page_name=="theme_color_settings"){ ?> class="active-sub active" <?php } ?>>
						<a href="#">
							<i class="fa fa-desktop"></i>
							<span class="menu-title"><?php echo translate('frontend_settings')?></span>
							<i class="arrow"></i>
						</a>
						<!--Submenu-->
						<ul class="collapse">
							<?php if ($this->Crud_model->admin_permission('choose_theme_color')){?>
							<li <?php if($page_name=="theme_color_settings"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/theme_color_settings"><i class="fa fa-paint-brush"></i><?php echo translate('choose_theme_color')?></a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('frontend_appearances')){?>
							<li <?php if($page_name=="header"||$page_name=="pages"||$page_name=="footer"){ ?> class="active-sub active" <?php } ?>>
								<a href="<?=base_url()?>admin/frontend_appearances"><i class="fa fa-window-restore"></i><?php echo translate('frontend_appearances')?><i class="arrow"></i></a>
								<!--Submenu-->
								<ul class="collapse">
									<?php if ($this->Crud_model->admin_permission('header')){?>
									<li <?php if($page_name=="header"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/frontend_appearances/header"><i class="fa fa-circle-o"></i><?php echo translate('header')?></a>
									</li>
									<?php } if ($this->Crud_model->admin_permission('pages')){?>
									<li  <?php if($page_name=="pages"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/frontend_appearances/pages"><i class="fa fa-circle-o"></i><?php echo translate('pages')?></a>
									</li>
									<?php } if ($this->Crud_model->admin_permission('footer')){?>
									<li  <?php if($page_name=="footer"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/frontend_appearances/footer"><i class="fa fa-circle-o"></i><?php echo translate('footer')?></a>
									</li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</li>
					<?php } if ($this->Crud_model->admin_permission('configuration')){?>
					<li <?php if($page_name=="religion"||$page_name=="caste"||$page_name=="sub_caste"||$page_name=="language"||$page_name=="country"||$page_name=="state"||$page_name=="city"||$page_name=="family_value"||$page_name=="family_status"||$page_name=="payments"||$page_name=="social_media_comments"||$page_name=="faq" ||$page_name=="email_setup"||$page_name=="captcha_settings" || $page_name=="google_analytics_settings" ||$page_name=="msg91" || $page_name=="twilio" ||$page_name=="on_behalf" ||$page_name=="currency_configure" ||$page_name=="currency_set" ||$page_name=="profile_sections" || $page_name=="profession"  || $page_name=="sect" || $page_name=="maritalstatus"  || $page_name=="i_exercise" || $page_name=="complexion"  || $page_name=="eye_color" || $page_name=="hair_color"  || $page_name=="body_type" ){ ?> class="active-sub active" <?php } ?>>
						<a href="#">
							<i class="fa fa-cogs"></i>
							<span class="menu-title"><?php echo translate('configurations')?></span>
							<i class="arrow"></i>
						</a>
						<!--Submenu-->
						<ul class="collapse">
							<?php if ($this->Crud_model->admin_permission('member_profile')){?>
							<li <?php if($page_name=="religion"|| $page_name=="caste"|| $page_name=="sub_caste" || $page_name=="language"||$page_name=="country"||$page_name=="state"||$page_name=="city"||$page_name=="family_value" ||$page_name=="family_status" ||$page_name=="on_behalf" || $page_name=="profession" || $page_name=="sect" || $page_name=="maritalstatus"  || $page_name=="i_exercise" || $page_name=="complexion"  || $page_name=="eye_color" || $page_name=="hair_color"  || $page_name=="body_type" || $page_name == "advertisements"){ ?> class="active-sub active" <?php } ?>>
								<a href="#"><i class="fa fa-user-plus"></i><?php echo translate('profile_attributes')?><i class="arrow"></i></a>
								<!--Submenu-->
								<ul class="collapse">
									<?php
						                if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
						                ?>
									<?php if ($this->Crud_model->admin_permission('religion')){?>
									<li <?php if($page_name=="religion"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/religion"><i class="fa fa-circle-o"></i><?php echo translate('religion')?></a>
									</li>
									<?php } if ($this->Crud_model->admin_permission('caste')){?>
									<li <?php if($page_name=="caste"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/caste"><i class="fa fa-circle-o"></i><?php echo translate('caste')?></a>
									</li>
									<?php } if ($this->Crud_model->admin_permission('sub_caste')){?>
									<li <?php if($page_name=="sub_caste"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/sub_caste"><i class="fa fa-circle-o"></i><?php echo translate('sub_-Caste')?></a>
									</li>
								<?php } ?>
								<?php
					                if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
					                ?>
									<?php } if ($this->Crud_model->admin_permission('language')){?>
									<li  <?php if($page_name=="language"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/language"><i class="fa fa-circle-o"></i><?php echo translate('language')?></a>
									</li>
								<?php } }?>
								<?php
					                if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes") {
					                ?>
									<?php if ($this->Crud_model->admin_permission('country')){?>
									<li  <?php if($page_name=="country"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/country"><i class="fa fa-circle-o"></i><?php echo translate('country')?></a>
									</li>
									<?php } if ($this->Crud_model->admin_permission('state')){?>
									<li  <?php if($page_name=="state"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/state"><i class="fa fa-circle-o"></i><?php echo translate('state')?></a>
									</li>
									
									<!-- <?php } if ($this->Crud_model->admin_permission('family_value')){?> -->
									
									<?php } if ($this->Crud_model->admin_permission('city')){?>
									<li  <?php if($page_name=="city"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/city"><i class="fa fa-circle-o"></i><?php echo translate('city')?></a>
									</li>
									<?php } ?>
								<?php } ?>
								<?php
					                if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
					                ?>
									<li <?php if($page_name=="family_value"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/family_value"><i class="fa fa-circle-o"></i><?php echo translate('family_value')?></a>
									</li>
									<li <?php if($page_name=="family_status"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/family_status"><i class="fa fa-circle-o"></i><?php echo translate('family_status')?></a>
									</li>
									<?php } ?>
									<li <?php if($page_name=="on_behalf"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/on_behalf"><i class="fa fa-circle-o"></i><?php echo translate('on_behalf')?></a>
									</li>
									<li <?php if($page_name=="profession"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/profession"><i class="fa fa-circle-o"></i>Profession</a>
									</li>
									<li <?php if($page_name=="sect"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/sect"><i class="fa fa-circle-o"></i>My Sect</a>
									</li>
									<li <?php if($page_name=="maritalstatus"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/maritalstatus"><i class="fa fa-circle-o"></i>Marital Status</a>
									</li>
									<li <?php if($page_name=="i_exercise"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/i_exercise"><i class="fa fa-circle-o"></i>I Exercise</a>
									</li>
									<li <?php if($page_name=="complexion"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/complexion"><i class="fa fa-circle-o"></i>Complexion</a>
									</li>
									
									<li <?php if($page_name=="eye_color"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/eye_color"><i class="fa fa-circle-o"></i>Eye Color</a>
									</li>
									<li <?php if($page_name=="hair_color"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/hair_color"><i class="fa fa-circle-o"></i>Hair Color</a>
									</li>
									
									<li <?php if($page_name=="body_type"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/body_type"><i class="fa fa-circle-o"></i>Body Type</a>
									</li>	
									
									<li <?php if($page_name=="education"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/education"><i class="fa fa-circle-o"></i>Education</a>
									</li>								
									
								</ul>
							</li>
							<?php } if ($this->Crud_model->admin_permission('profile_sections')){?>
							<li <?php if($page_name=="profile_sections"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/profile_sections"><i class="fa fa-address-card-o"></i><?php echo translate('profile_sections')?></a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('social_media_comments')){?>
							<li <?php if($page_name=="social_media_comments"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/social_media_comments"><i class="fa fa-comments-o"></i><?php echo translate('social_media_comments')?></a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('payments')){?>
							<li <?php if($page_name=="payments"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/payments"><i class="fa fa-credit-card-alt"></i><?php echo translate('payments')?></a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('email_setup')){?>
							<li <?php if($page_name=="email_setup"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/email_setup"><i class="fa fa-envelope"></i><?php echo translate('email_setup')?></a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('captcha_settings')){?>
							<li <?php if($page_name=="captcha_settings"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/captcha_settings"><i class="fa fa-retweet"></i><?php echo translate('captcha_settings')?></a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('google_analytics_settings')){?>
							<li <?php if($page_name=="google_analytics_settings"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/google_analytics_settings"><i class="fa fa-bar-chart"></i><?php echo translate('google_analytics_settings')?></a>
							</li>
							<?php } if ($this->Crud_model->admin_permission('sms_settings')){?>
							<li <?php if($page_name=="twilio" || $page_name=="msg91"){ ?> class="active-sub active" <?php } ?>>
								<a href="<?=base_url()?>admin/sms_settings"><i class="fa fa-window-restore"></i><?php echo translate('sms_settings')?><i class="arrow"></i></a>
								<!--Submenu-->
								<ul class="collapse">
									<li <?php if($page_name=="twilio" ){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/sms_settings/twilio"><i class="fa fa-circle-o"></i><?php echo translate('twilio')?></a>
									</li>
									<li <?php if($page_name=="msg91"){ ?> class="active-link" <?php } ?>>
										<a href="<?=base_url()?>admin/sms_settings/msg91"><i class="fa fa-circle-o"></i><?php echo translate('msg91')?></a>
									</li>
								</ul>
							</li>
							<?php } if ($this->Crud_model->admin_permission('faq')){?>
							<li <?php if($page_name=="faq"){ ?> class="active-link" <?php } ?>>
								<a href="<?=base_url()?>admin/faq"><i class="fa fa-question-circle"></i><?php echo translate('FAQ')?></a>
							</li>
							<?php } ?>
						</ul>
					</li>
					<?php } if ($this->Crud_model->admin_permission('send_sms')){?>
					<li <?php if($page_name=="send_sms"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin/send_sms">
							<i class="fa fa-mobile"></i>
							<span class="menu-title"><?php echo translate('send_SMS')?></span>
						</a>
					</li>
					<?php } if ($this->Crud_model->admin_permission('language')){?>
					<li <?php if($page_name=="manage_language"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin/manage_language">
							<i class="fa fa-language"></i>
							<span class="menu-title"><?php echo translate('language')?></span>
						</a>
					</li>
					<?php } if ($this->Crud_model->admin_permission('manage_admin')){?>
					<li <?php if($page_name=="manage_admin"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin/manage_admin">
							<i class="fa fa-lock"></i>
							<span class="menu-title"><?php echo translate('manage_admin_profile')?></span>
						</a>
					</li>
					<?php } if ($this->Crud_model->admin_permission('seo_settings')){?>
					<li <?php if($page_name=="seo_settings"){ ?> class="active-link" <?php } ?>>
						<a href="<?=base_url()?>admin/seo_settings">
							<i class="fa fa-search"></i>
							<span class="menu-title"><?php echo translate('SEO_settings')?></span>
						</a>
					</li>
				 <?php } if ($this->Crud_model->admin_permission('staffs_panel')){?>
					<li <?php if ($page_name == "role" || $page_name == "admin") { ?> class="active-link" <?php } ?> >
                        <a href="#">
                            <i class="fa fa-user-circle"></i>
                            <span class="menu-title">
                                <?php echo translate('staffs_panel'); ?>
                            </span>
                            <i class="fa arrow"></i>
                        </a>
                        <ul class="collapse <?php if ($page_name == "admin" || $page_name == "role") { ?> in <?php } ?>" >
                            <?php if ($this->Crud_model->admin_permission('all_staffs')){?>  
                            <li <?php if ($page_name == "admin") { ?> class="active-link" <?php } ?> >
                                <a href="<?php echo base_url(); ?>admin/admins/">
                                    <i class="fa fa-users"></i>
                        			<?php echo translate('all_staffs'); ?>
                                </a>
                            </li> 
                            <?php } if ($this->Crud_model->admin_permission('manage_roles')){?>
                            <li <?php if ($page_name == "role") { ?> class="active-link" <?php } ?> >
                                <a href="<?php echo base_url(); ?>admin/role/">
                                    <i class="fa fa-sliders"></i>
                            <?php echo translate('manage_roles'); ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } if ($this->Crud_model->admin_permission('online_knowledge_base')){?>
                    <li>
						<a href="https://activeitzone.com/index.php/product/active-matrimonial-cms/knowledge-base" target="_blank">
							<i class="fa fa-lightbulb-o"></i>
							<span class="menu-title"><?php echo translate('online_knowledge_base')?></span>
						</a>
					</li>
						<?php } if ($this->Crud_model->admin_permission('activasion')){?>
					<li>
						<a href="https://activeitzone.com/check/" target="_blank">
							<i class="fa fa-check"></i>
							<span class="menu-title"><?php echo translate('activation')?></span>
						</a>
					</li>
                                        <?php } ?>
                                        
                                        <!-- Mubassir Working -->
                                        <li>
						<a href="#" target="_blank">
							<i class="fa fa-wechat"></i>
							<span class="menu-title"><?php echo translate('chat_icons')?></span>
                                                        <i class="fa arrow"></i>
                                                </a>
                                                <ul class="collapse" >
                                                        <li>
                                                                <a href="<?php echo base_url(); ?>admin/chat_icons/">
                                                                        <i class="fa fa-users"></i>
                                                                        <?php echo translate('icons'); ?>
                                                                </a>
                                                        </li> 
                                                        <li>
                                                                <a href="<?php echo base_url(); ?>admin/chat_icons_group/">
                                                                        <i class="fa fa-users"></i>
                                                                        <?php echo translate('view_icons'); ?>
                                                                </a>
                                                        </li> 
                                                </ul>
                                        </li>
                                        <!-- // Mubassir Working -->
				</ul>
			</div>
		</div>
	</div>
	<!--================================-->
	<!--End menu-->
</div>
</nav>
<script type="text/javascript">
	$(document).ready(function(){
		setInterval(function() {
			$.ajax({
				url: "<?php echo base_url()?>admin/countAdvertisement",
				success: function(result){
					if (result > 0) {
						$('#countAdvertisement').html(result);
					}else{
					}
				}
			});
		}, 30000);
	})
</script>
<!--===================================================-->
<!--END MAIN NAVIGATION-->
