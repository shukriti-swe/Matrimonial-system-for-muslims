<?php include_once APPPATH . 'views/front/profile/profile_nav.php'; ?>
<section class="slice sct-color-2">
	<div class="profile">
		<div class="container">
			<?php //foreach ($get_member as $member):
			?>
			<div class="row cols-md-space cols-sm-space cols-xs-space">
				<?php 
				$showApprovalAlert = false;
				$profileImageApproved = $get_member[0]->is_profile_img_approved;
				if (!empty($get_member_gallery_items)) {
					for ($i=0; $i <count($get_member_gallery_items) ; $i++) { 
						if (in_array($get_member_gallery_items[$i]->is_approved == 2, $get_member_gallery_items) || $profileImageApproved == 2) { 
							$showApprovalAlert = true;
						}					
					}
				}
				else
				{
					if ($profileImageApproved == 2) {
						$showApprovalAlert = true;
					}
				}
				if ($showApprovalAlert == true) { ?>
					<div class="col-12" id="gallery_item_alert">
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<!-- Your picture / video is awaiting confirmation approval. No one else will be able to view it yet--> 
							Thank you for uploading your photo, it will now be screened.
						</div>
					</div>
				<?php } ?>
				<?php if (!empty($success_alert)) : ?>
					<div class="col-12" id="success_lg_alert">
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<?= $success_alert ?>
						</div>
					</div>
				<?php endif ?>
				<?php if (!empty($danger_alert)) : ?>
					<div class="col-12" id="danger_lg_alert">
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<?= $danger_alert ?>
						</div>
					</div>
				<?php endif ?>
				<!-- Alert for Ajax Profile Edit Section -->
				<div class="col-lg-3 col-md-4" id="ajax_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
					<div class="alert alert-success fade show" role="alert">
						<?php echo translate('you_have_successfully_edited_your_profile!') ?>
					</div>
				</div>
				<!-- Alert for Ajax Profile Edit Section -->
				<!-- Alert for Validating Ajax Profile Edit Section -->
				<div class="col-lg-3 col-md-4" id="ajax_validation_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
					<div class="alert alert-danger fade show" role="alert">
						</button>
						<span id="validation_info"></span>
					</div>
				</div>
				<!-- Alert for Validating Ajax Profile Edit Section -->
				<!-- Alerts for Member actions -->
				<div class="col-lg-3 col-md-4" id="ajax_success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
					<div class="alert alert-success ajax_success_alert fade show" role="alert">
						<!-- Success Alert Content -->
					</div>
				</div>
				<div class="col-lg-3 col-md-4" id="ajax_danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
					<div class="alert alert-danger ajax_danger_alert fade show" role="alert">
						<!-- Success Alert Content -->
					</div>
				</div>
				<!-- Alerts for Member actions -->
				<div class="col-lg-4">
					<?php include_once APPPATH . 'views/front/profile/left_panel.php'; ?>
				</div>
				<!--
                    <div class="visible_xs align-items-center">
                        <div class="container mb-4 text-center">
                            <ul class="inline-links inline-links--style-3">
                                <li>
                                    <a href="<?= base_url() ?>home/profile" class="c-base-1 xs_nav_item m_profile m_nav m_nav_active">
                                        <i class="fa fa-user"></i> <?php echo translate('profile') ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="c-base-1 xs_nav_item m_my_interests m_nav" onclick="profile_load('my_interests', 'no')">
                                        <i class="fa fa-heart"></i> <?php echo translate('my_interests') ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="c-base-1 xs_nav_item m_short_list m_nav" onclick="profile_load('short_list', 'no')">
                                        <i class="fa fa-list-ul"></i> <?php echo translate('shortlist') ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="c-base-1 xs_nav_item m_followed_users m_nav" onclick="profile_load('followed_users', 'no')">
                                        <i class="fa fa-star"></i> <?php echo translate('followed_users') ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="c-base-1 xs_nav_item m_messaging m_nav" onclick="profile_load('messaging', 'no')">
                                        <i class="fa fa-comments-o"></i> <?php echo translate('messaging') ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="c-base-1 xs_nav_item m_ignored_list m_nav" onclick="profile_load('ignored_list', 'no')">
                                        <i class="fa fa-ban"></i> <?php echo translate('ignored_list') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    -->

				<div class="col-lg-8" style="margin-bottom: -25px;">
					<div class="widget">
						<div class="card z-depth-2-top rs_card_home" id="profile_load">
							<div class="card-title card-bg">
								<h4 class="heading heading-6 ">
									MY PROFILE
								</h4>
							</div>
							<?php
							$privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
							$privacy_status_data = json_decode($privacy_status, true);
							?>
							<div class="card-body pt-2 rs_extra_h" style="padding: 1rem 0.5rem;">
								<!-- Contact information -->
								<div id="section_introduction">
									<?php include_once 'introduction.php'; ?>
								</div>
								<div id="section_i_am_looking">
									<?php include_once 'i_am_looking.php'; ?>
								</div>
							 
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 mt-2 rs_card_home" id="rs_extra_bottom_profile">
	<div class="widget">
						<div class="card z-depth-2-top" id="profile_load">
					 
							<?php
							$privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
							$privacy_status_data = json_decode($privacy_status, true);
							?>
							<div class="card-body pt-2" style="padding: 1rem 0.5rem;">
								<!-- Contact information -->
						 
						 
								<div id="section_basic_info">
									<?php include_once 'basic_info.php'; ?>
								</div>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes") {
								?>
									<div id="section_physical_attributes">
										<?php include_once 'physical_attributes.php'; ?>
									</div>
								<?php
								}
								?>

								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes") {
								?>
									<div id="section_education_and_career">
										<?php include_once 'education_and_career.php'; ?>
									</div>
								<?php
								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'astronomic_information'))->row()->value == "yes") {
								?>
									<div id="section_astronomic_information">
										<?php include_once 'astronomic_information.php'; ?>
									</div>
								<?php
								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'additional_personal_details'))->row()->value == "yes") {
								?>
									<div id="section_additional_personal_details">
										<?php include_once 'additional_personal_details.php'; ?>
									</div>
								<?php
								}
								?>
								<?php
								if ($this->db->get_where('frontend_settings', array('type' => 'partner_expectation'))->row()->value == "yes") {
								?>
									<div id="section_partner_expectation">
										<?php include_once 'partner_expectation.php'; ?>
									</div>
								<?php
								}
								?>
								<!--
                                    <?php
									/*
                                        if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_present_address">
                                            <?php include_once 'present_address.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>


                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_language">
                                            <?php include_once 'language.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'hobbies_and_interests'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_hobbies_and_interest">
                                            <?php include_once 'hobbies_and_interest.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'personal_attitude_and_behavior'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_personal_attitude_and_behavior">
                                            <?php include_once 'personal_attitude_and_behavior.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'residency_information'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_residency_information">
                                            <?php include_once 'residency_information.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_spiritual_and_social_background">
                                            <?php include_once 'spiritual_and_social_background.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'life_style'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_life_style">
                                            <?php include_once 'life_style.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>

                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'permanent_address'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_permanent_address">
                                            <?php include_once 'permanent_address.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'family_information'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_family_info">
                                            <?php include_once 'family_info.php'; ?>
                                        </div>
                                    <?php
                                        }
                                    ?>

                                    <?php
                                        if ($this->db->get_where('frontend_settings', array('type' => 'partner_expectation'))->row()->value == "yes") {
                                    ?>
                                        <div id="section_partner_expectation">
                                            <?php include_once 'partner_expectation.php'; ?>
                                        </div>
                                    <?php
                                        }*/
									?>
									-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php //endforeach
			?>
		</div>
	</div>
</section>
<?php if (isset($cover_pic_redirect)): ?>
<?php if ($cover_pic_redirect == 1): ?>
    <script>
        $(document).ready(function(){
			var page = "cover_pic_packages";
			$("#rs_extra_bottom_profile").hide();
			$.ajax({
				url: "<?=base_url()?>home/profile/"+page,
				success: function(response) {
					$("#profile_load").html(response);
				}
			});
        });
    </script>
<?php endif ?>
<?php endif ?>
<script>
	$(document).ready(function() {
		setTimeout(function() {
			$('#success_lg_alert').fadeOut('fast');
			$('#danger_lg_alert').fadeOut('fast');
		}, 5000); // <-- time in milliseconds
	});
</script>
<script>
	
	<?php if (isset($_GET['thanks'])): ?>
	<?php if ($_GET['thanks'] == 2): ?>
		$(document).ready(function(){
			 $("#rs_extra_bottom_profile").hide();
		$.ajax({
                url: "<?=base_url()?>home/profile/cover_pic_packages",
                success: function(response) {
                    $("#profile_load").html(response);
                    if(page == 'messaging'){
                       // $('body').find('#thread_'+sp).click();
                    }
                    // window.scrollTo(0, 0);
                    if (sp != 'no') {
                        $(".btn-back-to-top").click();
                    }
                }
            });
	});
	<?php endif ?>
	<?php endif ?>
	var isloggedin = "<?= $this->session->userdata('member_id') ?>";
	var member_id = "<?= $this->session->userdata('member_id') ?>";
	var email = "<?= $this->session->userdata('member_email') ?>";
	
	
	$(document).ready(function(){
		let settings={
            "async": true,
            "crossDomain": true,
            "url": "<?php echo base_url('imApi/getSetTokenValue?id=') ?>"+member_id,
            "method": "GET",
            "headers": {
                "authorization": "Basic YWRtaW46MTIzNA==",
                "cache-control": "no-cache",
                "postman-token": "eb27c011-391a-0b70-37c5-609bcd1d7b6d"
            },
            "processData": false,
            "contentType": false

        };
        $.ajax(settings).done(function (data) {
        	localStorage.removeItem("_r");
        	var	responseToken= data.response;
        	console.log(responseToken);
            localStorage.setItem("_r",responseToken);

        })
	})
	// Script for Editing Profile with Ajax
	function edit_section(section) {
		$('#info_' + section).hide();
		$('#edit_' + section).show();
	}

	function load_section(section) {

		$('#info_' + section).show();
		$('#edit_' + section).hide();
	}

	function unhide_section(section) {
		$('#section_' + section).find('.form-control').prop('readonly', true);
		$('#section_' + section).find('.btn').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>home/profile/unhide_section/" + section,
			cache: false,
			success: function(response) {
				$('#ajax_danger_alert').fadeOut('fast');
				$('#ajax_success_alert').show();
				$('.ajax_success_alert').html("<?= translate('this_section_is_successfully_showed') ?>");
				setTimeout(function() {
					$('#ajax_success_alert').fadeOut('fast');
				}, 3000); // <-- time in milliseconds
				$('#section_' + section).find('.form-control').prop('readonly', false);
				$('#section_' + section).find('.btn').prop('disabled', false);
				$('#unhide_' + section).hide();
				$('#hide_' + section).show();
			},
			fail: function(error) {
				alert(error);
			}
		});
	}

	function hide_section(section) {
		$('#section_' + section).find('.form-control').prop('readonly', true);
		$('#section_' + section).find('.btn').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>home/profile/hide_section/" + section,
			cache: false,
			success: function(response) {
				$('#ajax_success_alert').fadeOut('fast');
				$('#ajax_danger_alert').show();
				$('.ajax_danger_alert').html("<?= translate('this_section_is_successfully_hidden') ?>");
				setTimeout(function() {
					$('#ajax_danger_alert').fadeOut('fast');
				}, 3000); // <-- time in milliseconds
				$('#section_' + section).find('.form-control').prop('readonly', false);
				$('#section_' + section).find('.btn').prop('disabled', false);
				$('#unhide_' + section).show();
				$('#hide_' + section).hide();
			},
			fail: function(error) {
				alert(error);
			}
		});
	}

	function save_section(section) {
		// For Safety Disabling Section Elements for Slow Internet Connections
		$('#section_' + section).find('.form-control').prop('readonly', true);
		$('#section_' + section).find('.btn').prop('disabled', true);

		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>home/profile/update_" + section,
			cache: false,
			data: $('#form_' + section).serialize(),
			success: function(response) {
				// alert($('#form_'+section).serialize());

				if (IsJsonString(response)) {
					// Re_Enabling the Elements
					$('#section_' + section).find('.form-control').prop('readonly', false);
					$('#section_' + section).find('.btn').prop('disabled', false);
					// Displaying Validation Error for ajax submit
					// alert('TRUE');
					var JSONArray = $.parseJSON(response);
					var html = "";
					$.each(JSONArray, function(row, fields) {
						// alert(fields['ajax_error']);
						html = fields['ajax_error'];
					});
					$('#validation_info').html(html);
					$('#ajax_validation_alert').show();
					setTimeout(function() {
						$('#ajax_validation_alert').fadeOut('fast');
					}, 5000); // <-- time in milliseconds
				} else {
					// Loading the specific Section Area
					// alert('FALSE');
					$('#section_' + section).html(response);
					$('#ajax_alert').show();
					setTimeout(function() {
						$('#ajax_alert').fadeOut('fast');
					}, 5000); // <-- time in milliseconds
				}

			},
			fail: function(error) {
				alert(error);
			}
		});
	}

	function IsJsonString(str) {
		try {
			JSON.parse(str);
		} catch (e) {
			return false;
		}
		return true;
	}


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

	function refresh_msg(thread_id) {
		$(".contacts-list").find("#thread_" + thread_id).click();
	}

	function load_all_msg(thread_id) {
		$("#msg_body").html("<div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
		// $("#message_text").attr('disabled', true);
		// $("#msg_send_btn").attr('disabled', true);
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>home/get_messages/" + thread_id + "/all_msg",
			cache: false,
			success: function(response) {
				// $("#message_text").removeAttr('disabled');
				// $("#msg_send_btn").removeAttr('disabled');
				$("#msg_body").html(response);
			}
		});
	}

	function msg_send(thread, from, to) {
		if ($("#message_text").val().length != 0) {
			var form_data = ($("#message_form").serialize());
			// $("#message_text").attr('disabled', 'disabled');
			// $("#msg_send_btn").attr('disabled', 'disabled');
			$("#msg_send_btn").html("<i class='fa fa-refresh fa-spin'></i>");
			$.ajax({
				type: "POST",
				url: "<?= base_url() ?>home/send_message/" + thread + "/" + from + "/" + to,
				data: form_data,
				success: function(response) {
					// alert('done');
					// $("#message_text").removeAttr('disabled');
					// $("#message_text").val('');
					$("#msg_send_btn").html("<?php echo translate('send') ?>");
					$.ajax({
						type: "POST",
						url: "<?= base_url() ?>home/get_messages/" + thread,
						cache: false,
						success: function(response) {
							$("#msg_body").html(response);
						}
					});
				}
			});
		}
	}
</script>
<style type="text/css">
	.xs_nav_item {
		text-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
	}
	@media only screen and (min-width:1000px) {
    	.rs_extra_h .feature{
    	    min-height:172px;
    	    max-height:172px;
    	    overflow: scroll;
    	}
	}
</style>