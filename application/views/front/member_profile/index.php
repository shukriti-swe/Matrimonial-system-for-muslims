<section class="slice sct-color-2">
	<div class="profile">
		<div class="container">
			<div class="row cols-md-space cols-sm-space cols-xs-space">

				<!-- Alerts for Member actions -->
				<div class="col-lg-3 col-md-4" id="success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
					<div class="alert alert-success fade show" role="alert">
						<!-- Success Alert Content -->
						<!-- You have <b>Successfully</b> Edited your Profile! -->
					</div>
				</div>
				<div class="col-lg-3 col-md-4" id="danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
					<div class="alert alert-danger fade show" role="alert">
						<!-- Success Alert Content -->
						<!-- You have <b>Successfully</b> Edited your Profile! -->
					</div>
				</div>
				<!-- Alerts for Member actions -->
				<?php
				// Leading Json data
				$basic_info = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'basic_info');
				$basic_info_data = json_decode($basic_info, true);
				$i_am_looking = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'i_am_looking');
				$i_am_looking_data = json_decode($i_am_looking, true);

				$present_address = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'present_address');
				$present_address_data = json_decode($present_address, true);

				$education_and_career = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'education_and_career');
				$education_and_career_data = json_decode($education_and_career, true);

				$physical_attributes = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'physical_attributes');
				$physical_attributes_data = json_decode($physical_attributes, true);

				$language = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'language');
				$language_data = json_decode($language, true);

				$hobbies_and_interest = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'hobbies_and_interest');
				$hobbies_and_interest_data = json_decode($hobbies_and_interest, true);

				$personal_attitude_and_behavior = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'personal_attitude_and_behavior');
				$personal_attitude_and_behavior_data = json_decode($personal_attitude_and_behavior, true);

				$residency_information = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'residency_information');
				$residency_information_data = json_decode($residency_information, true);

				$spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'spiritual_and_social_background');
				$spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);

				$life_style = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'life_style');
				$life_style_data = json_decode($life_style, true);

				$astronomic_information = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'astronomic_information');
				$astronomic_information_data = json_decode($astronomic_information, true);

				$permanent_address = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'permanent_address');
				$permanent_address_data = json_decode($permanent_address, true);

				$family_info = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'family_info');
				$family_info_data = json_decode($family_info, true);

				$additional_personal_details = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'additional_personal_details');
				$additional_personal_details_data = json_decode($additional_personal_details, true);

				$partner_expectation = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'partner_expectation');
				$partner_expectation_data = json_decode($partner_expectation, true);

				$privacy_status = $this->Crud_model->get_type_name_by_id('member', $get_member[0]->member_id, 'privacy_status');
				$privacy_status_data = json_decode($privacy_status, true);
				?>
				<div class="col-lg-4">
					<?php include_once APPPATH . 'views/front/member_profile/left_panel.php'; ?>
				</div>
				<div class="col-lg-8">

					<div class="widget">
						<div class="card z-depth-2-top rs_card_home" id="profile_load">
							<div class="card-title card-bg">
								<h4 class="heading heading-6">
									PROFILE INFORMATION
								</h4>
							</div>
							<div class="card-body  pt-2 rs_extra_h" style="padding: 1.5rem 0.5rem;">
								<!-- Contact information -->
							
								<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
									<div id="section_introduction">
										<?php include_once 'introduction.php'; ?>
									</div>
								</div>
								
								<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
								<div id="section_i_am_looking">
									<?php include_once 'i_am_looking.php'; ?>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-12 mt-2 rs_card_home" id="rs_extra_bottom_profile">
					<div class="widget">
						<div class="card z-depth-2-top" id="profile_load">

							<div class="card-body pt-2" style="padding: 1rem 0.5rem;">

								<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
									<div id="section_basic_info">
										<?php include_once 'basic_info.php'; ?>
									</div>
								</div>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_physical_attributes">
											<?php include_once 'physical_attributes.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_present_address">
											<?php include_once 'present_address.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_education_and_career">
											<?php include_once 'education_and_career.php'; ?>
										</div>
									</div>
								<?php

								}
								?>

								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_language">
											<?php include_once 'language.php'; ?>
										</div>
									</div>
								<?php

								}
								?>

								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'personal_attitude_and_behavior'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_personal_attitude_and_behavior">
											<?php include_once 'personal_attitude_and_behavior.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'residency_information'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_residency_information">
											<?php include_once 'residency_information.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_spiritual_and_social_background">
											<?php include_once 'spiritual_and_social_background.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'life_style'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_life_style">
											<?php include_once 'life_style.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'astronomic_information'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_astronomic_information">
											<?php include_once 'astronomic_information.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'permanent_address'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_permanent_address">
											<?php include_once 'permanent_address.php'; ?>
										</div>
									</div>
								<?php

								}
								?>

								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'additional_personal_details'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_additional_personal_details">
											<?php include_once 'additional_personal_details.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'partner_expectation'))->row()->value == "yes") {

								?>
									<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
										<div id="section_partner_expectation">
											<?php include_once 'partner_expectation.php'; ?>
										</div>
									</div>
								<?php

								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	function open_message_box(thread_id, now) {

		$("#msg_body").html("<div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
		$("#msg_box_header").html("<a class='c-base-1' target='_blank' href='<?= base_url() ?>home/member_profile/" + $(now).find('.contacts-list-name').data('member') + "'>" + $(now).find('.contacts-list-name').html() + "</a>");
		$("#msg_refresh").html("<a onclick='refresh_msg(" + thread_id + ")'><i class='fa fa-refresh'></i> <?= translate('refresh') ?></a>");
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>home/get_messages/" + thread_id,
			cache: false,
			success: function(response) {
				/*clearInterval(message_interval);
				var message_interval =  setInterval(function(){
				                            $("#msg_body").load('<?= base_url() ?>home/get_messages/'+thread_id);
				                        }, 4000);*/
				$("#msg_body").removeAttr("style");
				$("#message_text").removeAttr('disabled');
				$("#message_text").val('');
				$("#msg_body").html(response);
			}
		});
	}
</script>

<style type="text/css">
	
.rs_card_home .feature.feature--boxed-border .card-inner-title-wrapper {
display: block;
    background: #efefef;
    text-align: center;
    padding: 8px;
    margin: -16px;
    overflow: hidden;
    margin-bottom: 20px;
    text-transform: uppercase;
    position: relative;
}
.rs_card_home .feature.feature--boxed-border .card-inner-title-wrapper .card-inner-title{
	float:none; 
	padding-top: 8px;
	    position: relative;
    top: 0;
}
.rs_card_home .feature.feature--boxed-border .card-inner-title-wrapper .pull-right{
	    position: relative;
    z-index: 1;
    top: 5px;
}
	.xs_nav_item {
		text-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
	}
	@media only screen and (min-width:1000px) {
    	.rs_extra_h .feature{
    	    height:220px;
			overflow: auto;
    	}
	}
</style>