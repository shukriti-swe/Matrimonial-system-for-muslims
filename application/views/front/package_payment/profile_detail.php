<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Match Made Jannah is a matrimonial site for single muslims. We offer you many different types of people through Videos & Pictures. Find your soul mate with us!">
	<meta name="keywords" content=" Muslim Shaadi,Single Muslim">
	<meta name="author" content="Match Made In Jannah">
	<meta name="revisit-after" content="2 day(s)"><!-- Page loader -->
	<script src="<?php echo base_url() ?>template/front/vendor/pace/js/pace.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/vendor/pace/css/pace-minimal.css" type="text/css">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<!-- Plugins -->
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/vendor/swiper/css/swiper.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/vendor/hamburgers/hamburgers.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/vendor/animate/animate.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/vendor/lightgallery/css/lightgallery.min.css">
	<!-- Icons -->
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/fonts/font-awesome/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/fonts/ionicons/css/ionicons.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/fonts/line-icons/line-icons.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/fonts/line-icons-pro/line-icons-pro.css" type="text/css">
	<!-- Linea Icons -->
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/fonts/linea/arrows/linea-icons.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/fonts/linea/basic/linea-icons.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/fonts/linea/ecommerce/linea-icons.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/front/fonts/linea/software/linea-icons.css" type="text/css">
	<!-- Global style (main) -->
	<link id="stylesheet" type="text/css" href="<?php echo base_url() ?>template/front/css/global-style-pink.css" rel="stylesheet" media="screen">
	<!-- Custom style - Remove if not necessary -->
	<link type="text/css" href="<?php echo base_url() ?>template/front/css/custom-style.css" rel="stylesheet">
	<!-- Favicon -->


	<!-- SCRIPTS -->
	<!-- Core -->
	<script src="<?php echo base_url() ?>template/front/vendor/jquery/jquery.min.js"></script>


	<script>
		// script for tab steps
		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

			var href = $(e.target).attr('href');
			var $curr = $(".process-model  a[href='" + href + "']").parent();

			$('.process-model li').removeClass();

			$curr.addClass("active");
			$curr.prevAll().addClass("visited");
		});
		// end  script for tab steps
	</script>
	<!-- Google Analytics -->
	<script>
		(function(i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function() {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

		ga('create', " ", 'auto');
		ga('send', 'pageview');
	</script>
	<!-- End Google Analytics -->
	<!-- Favicon -->
	<link href="<?php echo base_url() ?>uploads/favicon/favicon_1558266051.png" rel="icon" type="image/png">
	<title>Single Matrimonial Site - Match Made In Jannah</title>
</head>

<body>
	<div class="modal fade" id="active_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" style="max-width: 400px; margin-top: 30vh;">
            <div class="modal-content">
                <div class="modal-header text-center" style="display: block; border-bottom: 1px solid transparent">
                        <span class="modal-title" id="modal_header"><?php echo translate('title') ?></span>
                        <button type="button" class="close" id="modal_close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body text-center" id="modal_body">
                        <div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i>
                                <p><?php echo translate('please_wait_...') ?></p>
                        </div>
                </div>
                <div class="text-center" id="modal_buttons">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><?php echo translate('close') ?></button>
                </div>
            </div>
        </div>
	</div>
	<style>
		#loading-center {
			width: 100%;
			height: 100%;
			position: relative;
		}

		#loading-center-absolute {
			position: absolute;
			left: 50%;
			top: 50%;
			height: 50px;
			width: 150px;
			margin-top: -25px;
			margin-left: -75px;

		}

		.object {
			width: 8px;
			height: 50px;
			margin-right: 5px;
			background-color: white;
			-webkit-animation: animate 1s infinite;
			animation: animate 1s infinite;
			float: left;
		}

		.object:last-child {
			margin-right: 0px;
		}

		.object:nth-child(10) {
			-webkit-animation-delay: 0.9s;
			animation-delay: 0.9s;
		}

		.object:nth-child(9) {
			-webkit-animation-delay: 0.8s;
			animation-delay: 0.8s;
		}

		.object:nth-child(8) {
			-webkit-animation-delay: 0.7s;
			animation-delay: 0.7s;
		}

		.object:nth-child(7) {
			-webkit-animation-delay: 0.6s;
			animation-delay: 0.6s;
		}

		.object:nth-child(6) {
			-webkit-animation-delay: 0.5s;
			animation-delay: 0.5s;
		}

		.object:nth-child(5) {
			-webkit-animation-delay: 0.4s;
			animation-delay: 0.4s;
		}

		.object:nth-child(4) {
			-webkit-animation-delay: 0.3s;
			animation-delay: 0.3s;
		}

		.object:nth-child(3) {
			-webkit-animation-delay: 0.2s;
			animation-delay: 0.2s;
		}

		.object:nth-child(2) {
			-webkit-animation-delay: 0.1s;
			animation-delay: 0.1s;
		}

		@-webkit-keyframes animate {

			50% {
				-ms-transform: scaleY(0);
				-webkit-transform: scaleY(0);
				transform: scaleY(0);
			}
		}

		@keyframes animate {
			50% {
				-ms-transform: scaleY(0);
				-webkit-transform: scaleY(0);
				transform: scaleY(0);
			}
		}

		#loading {
			background-color: #E91E63;
			height: 100%;
			width: 100%;
			position: fixed;
			z-index: 1050;
			margin-top: 0px;
			top: 0px;
		}
	</style>
	<div id="loading">
		<div id="loading-center">
			<div id="loading-center-absolute">
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
				<div class="object"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		//$(window).load(function() {
		$(document).ready(function(e) {
			$("#loading").delay(500).fadeOut(500);
			$("#loading-center").click(function() {
				$("#loading").fadeOut(500);
			});
		});
	</script>

	<div class="container">
		<div class="row">
			<!-- Alerts for Member actions -->
			<div class="col-lg-3 col-md-4" id="success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
				<div class="alert alert-success fade show" role="alert">
					<!-- Success Alert Content -->
				</div>
			</div>
			<div class="col-lg-3 col-md-4" id="danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
				<div class="alert alert-danger fade show" role="alert">
					<!-- Danger Alert Content -->
				</div>
			</div>
			<!-- Alerts for Member actions -->
		</div>
	</div>
	<!-- MAIN WRAPPER -->
	<div class="body-wrap">
		<div id="st-container" class="st-container">
			<?php

			foreach ($get_member as $member) :

				$basic_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'basic_info');
				$basic_info_data = json_decode($basic_info, true);

				$present_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'present_address');
				$present_address_data = json_decode($present_address, true);

				$family_info = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'family_info');
				$family_info_data = json_decode($family_info, true);

				$education_and_career = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'education_and_career');
				$education_and_career_data = json_decode($education_and_career, true);

				$physical_attributes = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'physical_attributes');
				$physical_attributes_data = json_decode($physical_attributes, true);

				$language = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'language');
				$language_data = json_decode($language, true);

				$hobbies_and_interest = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'hobbies_and_interest');
				$hobbies_and_interest_data = json_decode($hobbies_and_interest, true);

				$personal_attitude_and_behavior = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'personal_attitude_and_behavior');
				$personal_attitude_and_behavior_data = json_decode($personal_attitude_and_behavior, true);

				$residency_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'residency_information');
				$residency_information_data = json_decode($residency_information, true);

				$spiritual_and_social_background = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'spiritual_and_social_background');
				$spiritual_and_social_background_data = json_decode($spiritual_and_social_background, true);

				$life_style = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'life_style');
				$life_style_data = json_decode($life_style, true);

				$astronomic_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'astronomic_information');
				$astronomic_information_data = json_decode($astronomic_information, true);

				$astronomic_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'astronomic_information');
				$astronomic_information_data = json_decode($astronomic_information, true);

				$permanent_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'permanent_address');
				$permanent_address_data = json_decode($permanent_address, true);

				$additional_personal_details = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'additional_personal_details');
				$additional_personal_details_data = json_decode($additional_personal_details, true);

				$u_manglik = $spiritual_and_social_background_data[0]['u_manglik'];

				$partner_expectation = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'partner_expectation');
				$partner_expectation_data = json_decode($partner_expectation, true);
			?>

				<div class="st-pusher">
					<div class="st-content">
						<div class="st-content-inner">
							<div class="top-navbar align-items-center" style="border-bottom: 2px solid #db4c7f !important;">
								<div class="container">
									<div class="row align-items-center py-1">
										<div class="col-lg-12 col-md-7 col" style="margin-bottom: 5px;">
											<nav class="top-navbar-menu">
												<ul class="float-right top_bar_right">
													<li class="dropdown dropdown--style-2 dropdown--animated float-left" style="padding: 4px 0 8px 0;">
														<a href="<?php echo base_url() ?>/home/logout" class="btn btn-styled btn-xs btn-base-1 btn-shadow"><i class="fa fa-power-off"></i> Log Out</a>
													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
							<nav class="navbar navbar-expand-lg navbar-light bg-default navbar--link-arrow navbar--uppercase">
								<div class="container navbar-container">
									<!-- Brand/Logo -->
									<a class="navbar-brand" href="<?php echo base_url() ?>/home/logout">
										<img src="<?php echo base_url() ?>uploads/header_logo/header_logo_1558265578.png" class="img-fluid w-100">
									</a>
								</div>
							</nav>


							<div class="sticky-content">
								<script type="text/javascript">
									$(document).ready(function() {
										$('.set_langs').on('click', function() {
											var lang_url = $(this).data('href');
											$.ajax({
												url: lang_url,
												success: function(result) {
													location.reload();
												}
											});
										});
									});
								</script>
								<style type="text/css">
									@media (max-width: 991px) {
										.hidden_xs {
											display: none !important;
										}
									}

									@media (min-width: 992px) {
										.visible_xs {
											display: none !important;
										}
									}
								</style>

								<script>
									$(document).ready(function() {
										profile_load('', '');
									});

									function profile_load(page, sp) {
										// alert('here');
										if (typeof message_interval !== 'undefined') {
											clearInterval(message_interval);
										}
										if (page !== '') {
											$.ajax({
												url: "<?php echo base_url() ?>home/profile/" + page,
												success: function(response) {
													$("#profile_load").html(response);
													if (page == 'messaging') {
														$('body').find('#thread_' + sp).click();
													}
													// window.scrollTo(0, 0);
													if (sp != 'no') {
														$(".btn-back-to-top").click();
													}
												}
											});
										}
									}
								</script>
								<section class="slice sct-color-2">
									<div class="profile">
										<div class="container">
											<div class="d-flex justify-content-center">
												<div>
													<ul class="nav nav-tabs process-model" role="tablist">
														<li class="active"><a>
																1
															</a>
															<p>Submit Your <br>
																Details</p>
														</li>
														<li><a>
																2
															</a>
															<p>Choose Your <br>
																Package</p>
														</li>
													</ul>
												</div>
											</div>
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
											<div class="row cols-md-space cols-sm-space cols-xs-space">
												<!-- Alert for Ajax Profile Edit Section -->
												<div class="col-lg-3 col-md-4" id="ajax_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
													<div class="alert alert-success fade show" role="alert">
														You Have Successfully Edited Your Profile! </div>
												</div>
												<div class="col-lg-3 col-md-4" id="validation_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
													<div class="alert alert-success fade show" role="alert">
														<div id="introAlert"></div>
														<div id="basicInfoAlert"></div>
														<div id="howIlookAlert"></div>
														<div id="religionAlert"></div>
														<div id="emailVerificationAlert"></div>

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
												<div class="col-md-12 col-xs-12">
												<?php
													$isEmailVerified = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'is_email_verified');
													if ($isEmailVerified == 0) {
												?>
													<div class="alert alert-danger w-100" role="alert">
														After you complete your profile please check your email to verify.
													</div>
												<?php } ?>
												</div>											
												<div class="col-lg-12">
													<div class="widget">
														<div class="card z-depth-2-top" id="profile_load">
															<div class="card-title card-bg">
																<h4 class="heading heading-6 ">
																	MY PROFILE
																</h4>
															</div>
															<div class="card-body pt-2" style="padding: 1rem 0.5rem;">
																<!-- Contact information -->
																<div id="section_introduction">
																	<div class="mb-2 pl-3">
																		<b><?= translate('Member ID') . ' - ' ?></b><b class="c-base-1"><?= $get_member[0]->display_member ?></b>
																	</div>
																	<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
																		<div id="info_introduction">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					INTRODUCTION
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('introduction')">
																						<i class="ion-edit"></i>
																						<span class="tooltiptext">Edit</span>
																					</button>
																				</div>
																			</div>
																			<div class="table-full-width">
																				<div class="table-full-width">
																					<table class="table table-xs table-profile table-striped table-bordered table-responsive-sm">
																						<tbody>
																							<tr>
																								<td>
																									<p><?= $get_member[0]->introduction ?></p>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>

																		<div id="edit_introduction" style="display: none">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					INTRODUCTION
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow mb-1" onclick="save_section('introduction')"><i class="ion-checkmark"></i></button>
																					<button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow mb-1" onclick="load_section('introduction')"><i class="ion-close"></i></button>
																				</div>
																			</div>

																			<div class='clearfix'></div>
																			<form id="form_introduction" class="form-default" role="form">
																				<div class="row">
																					<div class="col-md-12">
																						<div class="form-group has-feedback">
																							<textarea name="introduction" class="form-control no-resize" rows="5"><?= $get_member[0]->introduction ?></textarea>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
																<div id="section_i_am_looking">
																	<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
																		<div id="info_i_am_looking">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					I AM LOOKING
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('i_am_looking')">
																						<i class="ion-edit"></i>
																						<span class="tooltiptext">Edit</span>
																					</button>
																				</div>
																			</div>
																			<div class="table-full-width">
																				<div class="table-full-width">
																					<table class="table table-xs table-profile table-striped table-bordered table-responsive-sm">
																						<tbody>
																							<tr>
																								<td>
																									<p><?= $get_member[0]->i_am_looking ?></p>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>

																		<div id="edit_i_am_looking" style="display: none">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					i_am_looking
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow mb-1" onclick="save_section('i_am_looking')"><i class="ion-checkmark"></i></button>
																					<button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow mb-1" onclick="load_section('i_am_looking')"><i class="ion-close"></i></button>
																				</div>
																			</div>

																			<div class='clearfix'></div>
																			<form id="form_i_am_looking" class="form-default" role="form">
																				<div class="row">
																					<div class="col-md-12">
																						<div class="form-group has-feedback">
																							<textarea name="i_am_looking" class="form-control no-resize" rows="5"><?= $get_member[0]->i_am_looking ?></textarea>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>  
																<div id="section_basic_info">
																	<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
																		<div id="info_basic_info">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					<!--Basic Information-->
																					PROFILE
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('basic_info')">
																						<i class="ion-edit"></i>
																						<span class="tooltiptext">Edit</span>
																					</button>
																				</div>
																			</div>
																			<div class="table-full-width">
																				<div class="table-full-width">
																					<table class="table table-xs table-profile table-striped table-bordered table-responsive-sm">
																						<tbody>
																							<tr>
																								<td class="td-label">
																									<span><?php echo translate('first_name') ?></span>
																								</td>
																								<td>
																									<?= $get_member[0]->first_name ?>
																								</td>
																								<td class="td-label">
																									<span><?php echo translate('last_name') ?></span>
																								</td>
																								<td>
																									<?= $get_member[0]->last_name ?>
																								</td>

																							</tr>
																							<tr>
																								<td class="td-label">
																									<span><?php echo translate('age') ?></span>
																								</td>
																								<td>
																									<?php
																									$calculated_age = (date('Y') - date('Y', $get_member[0]->date_of_birth));
																									echo $calculated_age;
																									?>
																								</td>
																								<td class="td-label">
																									<span><?php echo translate('email') ?></span>
																								</td>
																								<td>
																									<?= $get_member[0]->email ?>
																								</td>


																							</tr>
																							<tr>

																								<td class="td-label">
																									<span><?php echo translate('gender') ?></span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('gender', $get_member[0]->gender) ?>
																								</td>
																								<td class="td-label">
																									<span>Profession</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('profession', $basic_info_data[0]['profession']) ?>
																								</td>

																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>Date of birth</span>
																								</td>
																								<td>
																									<?= date('d/m/Y', $get_member[0]->date_of_birth) ?>
																								</td>
																								<td class="td-label">
																									<span>Residence</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('country', $basic_info_data[0]['residence']) ?>
																								</td>

																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>My Sect</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('sect', $basic_info_data[0]['my_sect']) ?>
																								</td>
																								<td class="td-label">
																									<span>Resident Status</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('resident_status', $basic_info_data[0]['resident_status']) ?>
																								</td>

																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>Grew Up</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('country', $basic_info_data[0]['grew_up']); ?>
																								</td>
																								<td class="td-label">
																									<span>Like To Marry</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('like_to_marry', $basic_info_data[0]['like_to_marry']) ?>
																								</td>

																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>
																										<!--<?php echo translate('mobile') ?>-->Phone</span>
																								</td>
																								<td><?= $get_member[0]->mobile ?></td>
																								<td class="td-label">
																									<span>1st Language</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('language', $basic_info_data[0]['first_language']) ?>

																								</td>

																							</tr>
																							<tr>
																								<td class="td-label">
																									<span><?php echo translate('marital_status') ?></span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('marital_status', $basic_info_data[0]['marital_status']) ?>
																								</td>
																								<td class="td-label">
																									<span>Disabilities</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('dissablities', $basic_info_data[0]['Disabilities']) ?>
																								</td>

																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>Living With</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('living_with', $basic_info_data[0]['living_with']) ?>
																								</td>
																								<td class="td-label">
																									<span>Profile Made</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('on_behalf', $basic_info_data[0]['profile_made']) ?>
																								</td>

																							</tr>


																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>

																		<div id="edit_basic_info" style="display: none;">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					PROFILE
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('basic_info')"><i class="ion-checkmark"></i></button>
																					<button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('basic_info')"><i class="ion-close"></i></button>
																				</div>
																			</div>

																			<div class='clearfix'></div>
																			<form id="form_basic_info" class="form-default" role="form">
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="first_name" class="text-uppercase c-gray-light"><?php echo translate('first_name') ?></label>
																							<input type="text" class="form-control no-resize" name="first_name" value="<?= $get_member[0]->first_name ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="last_name" class="text-uppercase c-gray-light"><?php echo translate('last_name') ?></label>
																							<input type="text" class="form-control no-resize" name="last_name" value="<?= $get_member[0]->last_name ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="age" class="text-uppercase c-gray-light">Age (Auto calculated from date of birth)</label>
																							<input disabled type="text" class="form-control no-resize" name="age" value="<?= (date('Y') - date('Y', $get_member[0]->date_of_birth)) ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="email" class="text-uppercase c-gray-light"><?php echo translate('email') ?></label>
																							<input type="hidden" name="old_email" value="<?= $get_member[0]->email ?>">
																							<input type="email" class="form-control no-resize" name="email" value="<?= $get_member[0]->email ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="first_name" class="text-uppercase c-gray-light"><?php echo translate('gender') ?></label>
																							<?php
																							echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $get_member[0]->gender, '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="profession" class="text-uppercase c-gray-light">Profession</label>
																							<?php
																							echo $this->Crud_model->select_html('profession', 'profession', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['profession'], '', '', '');
																							?>

																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>

																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="date_of_birth" class="text-uppercase c-gray-light">Born </label>
																							<input type="date" class="form-control no-resize" name="date_of_birth" value="<?= date('Y-m-d', $get_member[0]->date_of_birth) ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="residence" class="text-uppercase c-gray-light">Residence</label>
																							<?php

																							echo $this->Crud_model->select_html('country', 'residence', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $basic_info_data[0]['residence'], '', '', '');

																							?>

																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="my_sect" class="text-uppercase c-gray-light">My Sect</label>
																							<?php
																							echo $this->Crud_model->select_html('sect', 'my_sect', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['my_sect'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="resident_status" class="text-uppercase c-gray-light">Resident Status</label>
																							<?php
																							echo $this->Crud_model->select_html('resident_status', 'resident_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['resident_status'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="grew_up" class="text-uppercase c-gray-light">Grew Up</label>
																							<?php

																							echo $this->Crud_model->select_html('country', 'grew_up', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $basic_info_data[0]['grew_up'], '', '', '');

																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="like_to_marry" class="text-uppercase c-gray-light">Like To Marry</label>
																							<?php
																							echo $this->Crud_model->select_html('like_to_marry', 'like_to_marry', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['like_to_marry'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="mobile" class="text-uppercase c-gray-light">Phone</label>
																							<input type="hidden" name="old_mobile" value="<?= $get_member[0]->mobile ?>">
																							<input type="text" class="form-control no-resize" aria-describedby="text-feet" name="mobile" value="<?= $get_member[0]->mobile ?>">
																							<!--  <input type="text" class="form-control no-resize" name="mobile" value="<?= $get_member[0]->mobile ?>">-->
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="first_language" class="text-uppercase c-gray-light">1st Language</label>
																							<?php
																							echo $this->Crud_model->select_html('language', 'first_language', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['first_language'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>

																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="marital_status" class="text-uppercase c-gray-light">Marital Status</label>
																							<?php
																							echo $this->Crud_model->select_html('marital_status', 'marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['marital_status'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="Disabilities" class="text-uppercase c-gray-light">Disabilities</label>
																							<?php
																							echo $this->Crud_model->select_html('dissablities', 'Disabilities', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['Disabilities'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="living_with" class="text-uppercase c-gray-light">Living With</label>
																							<?php
																							echo $this->Crud_model->select_html('living_with', 'living_with', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['living_with'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-6">
																						<div class="form-group has-feedback">
																							<label for="profile_made" class="text-uppercase c-gray-light">Profile Made</label>
																							<?php
																							echo $this->Crud_model->select_html('on_behalf', 'profile_made', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info_data[0]['profile_made'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																			</form>
																		</div>
																	</div>
																	<script>
																		$(document).ready(function() {
																			$(".phone_mask").inputmask({
																				mask: "999-999-9999",
																				greedy: false,
																				definitions: {
																					'*': {
																						validator: "[0-9]"
																					}
																				}
																			});
																		});
																	</script>
																</div>
																<div id="section_physical_attributes">

																	<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
																		<div id="info_physical_attributes">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					HOW I LOOK
																				</h3>
																				<div class="pull-right">

																					<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('physical_attributes')">
																						<i class="ion-edit"></i>
																						<span class="tooltiptext">Edit</span>
																					</button>
																				</div>
																			</div>
																			<div class="table-full-width">
																				<div class="table-full-width">
																					<table class="table table-xs table-profile table-responsive-sm table-striped table-bordered table-slick">
																						<tbody>
																							<tr>
																								<td class="td-label">
																									<span>my height</span>
																								</td>
																								<td>
																									<?= $get_member[0]->height ?>
																								</td>
																								<td class="td-label">
																									<span>I Exercise</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('i_exercise', $physical_attributes_data[0]['exercise']) ?>
																								</td>
																								<td class="td-label">
																									<span>My Eye Color</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('eye_color', $physical_attributes_data[0]['eye_color']) ?>

																								</td>
																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>My Hair Color</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('hair_color', $physical_attributes_data[0]['hair_color']) ?>

																								</td>
																								<td class="td-label">
																									<span>My Complexion</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('complexion', $physical_attributes_data[0]['complexion']) ?>
																								</td>
																								<td class="td-label">
																									<span>My Body Type</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('body_type', $physical_attributes_data[0]['body_type']) ?>
																								</td>

																							</tr>

																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>

																		<div id="edit_physical_attributes" style="display: none">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					HOW I LOOK
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('physical_attributes')"><i class="ion-checkmark"></i></button>
																					<button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('physical_attributes')"><i class="ion-close"></i></button>
																				</div>
																			</div>

																			<div class='clearfix'></div>
																			<form id="form_physical_attributes" class="form-default" role="form">
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="height" class="text-uppercase c-gray-light"><?php echo translate('height') ?></label>
																							<input type="text" class="form-control no-resize height_mask" aria-describedby="text-feet" name="height" value="<?= $get_member[0]->height ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="exercise" class="text-uppercase c-gray-light">I EXERCISE</label>
																							<?php
																							echo $this->Crud_model->select_html('i_exercise', 'exercise', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['exercise'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="eye_color" class="text-uppercase c-gray-light"><?php echo translate('eye_color') ?></label>
																							<?php
																							echo $this->Crud_model->select_html('eye_color', 'eye_color', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['eye_color'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">

																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="hair_color" class="text-uppercase c-gray-light"><?php echo translate('hair_color') ?></label>
																							<?php
																							echo $this->Crud_model->select_html('hair_color', 'hair_color', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['hair_color'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="complexion" class="text-uppercase c-gray-light"><?php echo translate('complexion') ?></label>
																							<?php
																							echo $this->Crud_model->select_html('complexion', 'complexion', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['complexion'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type') ?></label>
																							<?php
																							echo $this->Crud_model->select_html('body_type', 'body_type', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['body_type'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>

																			</form>
																		</div>
																	</div>
																	<script>
																		$(document).ready(function() {
																			$(".height_mask").inputmask({
																				mask: "9'99\"",
																				greedy: false,
																				definitions: {
																					'*': {
																						validator: "[0-9]"
																					}
																				}
																			});
																		});
																	</script>
																</div>
																<div id="section_education_and_career">
																	<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
																		<div id="info_education_and_career">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					EDUCATION AND CAREER
																				</h3>
																				<div class="pull-right">

																					<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('education_and_career')">
																						<i class="ion-edit"></i>
																						<span class="tooltiptext">Edit</span>
																					</button>
																				</div>
																			</div>
																			<div class="table-full-width">
																				<div class="table-full-width">
																					<table class="table table-xs table-profile table-responsive-sm table-striped table-bordered table-slick">
																						<tbody>
																							<tr>
																								<td class="td-label">
																									<span>Education</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('education', $education_and_career_data[0]['highest_education']) ?>

																								</td>
																								<td class="td-label">
																									<span>I am Employed</span>
																								</td>
																								<td>
																									<?= $education_and_career_data[0]['i_am_employed'] ?>
																								</td>
																								<td class="td-label">
																									<span>My Job Title</span>
																								</td>
																								<td>
																									<?= $education_and_career_data[0]['my_job_title'] ?>
																								</td>
																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>My Company's Name</span>
																								</td>
																								<td>
																									<?= $education_and_career_data[0]['my_company_name'] ?>
																								</td>
																								<td class="td-label">
																									<span><?php echo translate('annual_income') ?></span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('annual_income', $education_and_career_data[0]['annual_income']) ?>
																								</td>
																								<td class="td-label">
																									<span>Years Worked</span>
																								</td>
																								<td>
																									<?= $education_and_career_data[0]['years_worked'] ?>
																								</td>

																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>I am Self Employed</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $education_and_career_data[0]['self_employed']) ?>
																								</td>
																								<td class="td-label">
																									<span>Years Owned</span>
																								</td>
																								<td>
																									<?= $education_and_career_data[0]['years_owned'] ?>
																								</td>

																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>

																		<div id="edit_education_and_career" style="display: none;">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					EDUCATION AND CAREER
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('education_and_career')"><i class="ion-checkmark"></i></button>
																					<button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('education_and_career')"><i class="ion-close"></i></button>
																				</div>
																			</div>

																			<div class='clearfix'></div>
																			<form id="form_education_and_career" class="form-default" role="form">
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="highest_education" class="text-uppercase c-gray-light">Education</label>
																							<?php
																							echo $this->Crud_model->select_html('education', 'highest_education', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['highest_education'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="i_am_employed" class="text-uppercase c-gray-light">I am Employed</label>
																							<input type="text" class="form-control no-resize" name="i_am_employed" value="<?= $education_and_career_data[0]['i_am_employed'] ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="my_job_title" class="text-uppercase c-gray-light">My Job Title</label>
																							<input type="text" class="form-control no-resize" name="my_job_title" value="<?= $education_and_career_data[0]['my_job_title'] ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="my_company_name" class="text-uppercase c-gray-light">My Company's Name</label>
																							<input type="text" class="form-control no-resize" name="my_company_name" value="<?= $education_and_career_data[0]['my_company_name'] ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="annual_income" class="text-uppercase c-gray-light"><?php echo translate('annual_income') ?> </label>

																							<?php
																							echo $this->Crud_model->select_html('annual_income', 'annual_income', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['annual_income'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="years_worked" class="text-uppercase c-gray-light">Years Worked</label>
																							<?php
																							echo $this->Crud_model->select_html('years', 'years_worked', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['years_worked'], '', '', '');
																							?>

																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="self_employed" class="text-uppercase c-gray-light">I am Self Employed</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'self_employed', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['self_employed'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<!-- <div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="annual_income_self" class="text-uppercase c-gray-light">Anmual Income </label>
																							<?php
																							//echo $this->Crud_model->select_html('annual_income', 'annual_income_self', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['annual_income_self'], '', '', '');
																							?>

																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div> -->
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="years_owned" class="text-uppercase c-gray-light">Years Owned</label>
																							<?php
																							echo $this->Crud_model->select_html('years', 'years_owned', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['years_owned'], '', '', '');
																							?>

																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>

																				</div>
																			</form>
																		</div>
																	</div>
																</div>
																<div id="section_astronomic_information">
																	<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
																		<div id="info_astronomic_information">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					MY RELIGION
																				</h3>
																				<div class="pull-right">

																					<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1 " onclick="edit_section('astronomic_information')">
																						<i class="ion-edit"></i>
																						<span class="tooltiptext">Edit</span>
																					</button>

																				</div>
																			</div>
																			<div class="table-full-width">
																				<div class="table-full-width">
																					<table class="table table-xs table-profile table-responsive-sm table-striped table-bordered table-slick">
																						<tbody>
																							<tr>
																								<td class="td-label">
																									As a Muslim, I am?</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('muslim_i_am', $astronomic_information_data[0]['muslim_i_am']) ?>

																								</td>
																								<td class="td-label">
																									<span>I am a Revert</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['revert']) ?>

																								</td>
																								<td class="td-label">
																									<span>I am a Convert</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['convert']) ?>

																								</td>
																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>Do I Keep Fast</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['do_i_fast']) ?>

																								</td>
																								<td class="td-label">
																									<span>Do I Pray</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['do_i_pray']) ?>

																								</td>
																								<td class="td-label">
																									<span>Do I Eat Halal</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['do_i_eat_halal']) ?>

																								</td>
																							</tr>
																							<tr>
																								<td class="td-label">
																									<span>For Women Only:<br /> Do I Wear Hiijab</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['women_only']) ?>

																								</td>
																								<td class="td-label">
																									<span>For Men Only:<br /> I Prefer My Wife To Wear</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('wife_wear', $astronomic_information_data[0]['wife_wear']) ?>

																								</td>

																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>

																		<div id="edit_astronomic_information" style="display: none;">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					MY RELIGION
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('astronomic_information')"><i class="ion-checkmark"></i></button>
																					<button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('astronomic_information')"><i class="ion-close"></i></button>
																				</div>
																			</div>

																			<div class='clearfix'></div>
																			<form id="form_astronomic_information" class="form-default" role="form">
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="muslim_i_am" class="text-uppercase c-gray-light">As a Muslim, I am?</label>
																							<?php
																							echo $this->Crud_model->select_html('muslim_i_am', 'muslim_i_am', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['muslim_i_am'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="revert" class="text-uppercase c-gray-light">I am a Revert</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'revert', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['revert'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="convert" class="text-uppercase c-gray-light">I am a Convert</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'convert', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['convert'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="do_i_fast" class="text-uppercase c-gray-light">Do I Keep Fast?</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'do_i_fast', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['do_i_fast'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="do_i_pray" class="text-uppercase c-gray-light">Do I Pray?</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'do_i_pray', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['do_i_pray'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="do_i_eat_halal" class="text-uppercase c-gray-light">Do I Eat Halal?</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'do_i_eat_halal', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['do_i_eat_halal'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>

																				</div>
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="women_only" class="text-uppercase c-gray-light">For Women Only: Do I Wear Hiijab</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'women_only', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['women_only'], '', '', '');
																							?>

																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="wife_wear" class="text-uppercase c-gray-light">For Men Only: I Prefer My Wife To Wear</label>
																							<?php
																							echo $this->Crud_model->select_html('wife_wear', 'wife_wear', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['wife_wear'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>


																				</div>
																			</form>
																		</div>
																	</div>
																</div>
																<div id="section_additional_personal_details">
																	<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
																		<div id="info_additional_personal_details">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					A LITTLE ABOUT ME
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('additional_personal_details')">
																						<i class="ion-edit"></i>
																						<span class="tooltiptext">Edit</span>
																					</button>
																				</div>
																			</div>
																			<div class="table-full-width">
																				<div class="table-full-width">
																					<table class="table table-xs table-profile table-responsive-sm table-striped table-bordered table-slick">
																						<tbody>
																							<tr>
																								<td class="td-label">
																									<span>I Was Born At</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('country', $additional_personal_details_data[0]['born_at']); ?>

																								</td>
																								<td class="td-label">
																									<span>I Want Children</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details_data[0]['want_children']) ?>

																								</td>
																								<td class="td-label">
																									<span>Do I Smoke</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no_seldom', $additional_personal_details_data[0]['do_i_smoke']) ?>

																								</td>
																							</tr>
																							<tr>

																							<tr>
																								<td class="td-label">
																									<span>I Grew Up In</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('country', $additional_personal_details_data[0]['grew_up_in']) ?>

																								</td>
																								<td class="td-label">
																									<span>I Have Children</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details_data[0]['have_children']) ?>
																								</td>
																								<td class="td-label">
																									<span>Do I Drink</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no_seldom', $additional_personal_details_data[0]['do_i_drink']) ?>
																								</td>
																							</tr>

																							<tr>
																								<td class="td-label">
																									<span>My Hobbies</span>
																								</td>
																								<td>

																									<?= $additional_personal_details_data[0]['my_hobbies'] ?>
																								</td>
																								<td class="td-label">
																									<span>I Believe In Polygamy</span>
																								</td>
																								<td>
																									<?= $this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details_data[0]['believe_in_polygamy']) ?>
																								</td>

																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>

																		<div id="edit_additional_personal_details" style="display: none;">
																			<div class="card-inner-title-wrapper pt-0">
																				<h3 class="card-inner-title pull-left">
																					A LITTLE ABOUT ME
																				</h3>
																				<div class="pull-right">
																					<button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('additional_personal_details')"><i class="ion-checkmark"></i></button>
																					<button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('additional_personal_details')"><i class="ion-close"></i></button>
																				</div>
																			</div>

																			<div class='clearfix'></div>
																			<form id="form_additional_personal_details" class="form-default" role="form">
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="born_at" class="text-uppercase c-gray-light">I Was Born At</label>
																							<?php

																							echo $this->Crud_model->select_html('country', 'born_at', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $additional_personal_details_data[0]['born_at'], '', '', '');

																							?>

																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="want_children" class="text-uppercase c-gray-light">I Want Children</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'want_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['want_children'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="do_i_smoke" class="text-uppercase c-gray-light">Do I Smoke</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no_seldom', 'do_i_smoke', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['do_i_smoke'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="grew_up_in" class="text-uppercase c-gray-light">I Grew Up In</label>
																							<?php
																							echo $this->Crud_model->select_html('country', 'grew_up_in', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['grew_up_in'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="have_children" class="text-uppercase c-gray-light">I Have Children</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'have_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['have_children'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="do_i_drink" class="text-uppercase c-gray-light">Do I Drink</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no_seldom', 'do_i_drink', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['do_i_drink'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="my_hobbies" class="text-uppercase c-gray-light">My Hobbies</label>
																							<input type="text" class="form-control no-resize" name="my_hobbies" value="<?= $additional_personal_details_data[0]['my_hobbies'] ?>">
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>
																					<div class="col-md-4">
																						<div class="form-group has-feedback">
																							<label for="believe_in_polygamy" class="text-uppercase c-gray-light">I Believe In Polygamy</label>
																							<?php
																							echo $this->Crud_model->select_html('yes_no', 'believe_in_polygamy', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['believe_in_polygamy'], '', '', '');
																							?>
																							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																							<div class="help-block with-errors"></div>
																						</div>
																					</div>

																				</div>
																		</div>
																		</form>
																	</div>
																</div>
															</div>
															<div id="section_partner_expectation">
																<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
																	<div id="info_partner_expectation">
																		<div class="card-inner-title-wrapper pt-0">
																			<h3 class="card-inner-title pull-left">
																				PARTNER EXPECTATION
																			</h3>
																			<div class="pull-right">
																				<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('partner_expectation')">
																					<i class="ion-edit"></i>
																					Edit
																				</button>
																			</div>
																		</div>
																		<div class="table-full-width">
																			<div class="table-full-width">
																				<table class="table table-xs table-profile table-responsive-sm table-striped table-bordered table-slick">
																					<tbody>
																						<tr>
																							<td class="td-label">
																								<span>Sect</span>
																							</td>
																							<td>
																								<?php if ($this->Crud_model->get_type_name_by_id('sect', $partner_expectation_data[0]['partner_caste']) == "") {
																									echo "I Dont Care";
																								} else {
																									echo $this->Crud_model->get_type_name_by_id('sect', $partner_expectation_data[0]['partner_caste']);
																								} ?>

																							</td>
																							<td class="td-label">
																								<span><?php echo translate('age') ?></span>
																							</td>
																							<td>
																								<?= $this->Crud_model->get_type_name_by_id('age_range', $partner_expectation_data[0]['partner_age']) ?>

																							</td>
																							<td class="td-label">
																								<span><?php echo translate('height') ?></span>
																							</td>
																							<td>
																								<?= $partner_expectation_data[0]['partner_height'] ?>
																							</td>


																						</tr>
																						<tr>
																							<td class="td-label">
																								<span><?php echo translate('marital_status') ?></span>
																							</td>
																							<td>
																								<?= $this->Crud_model->get_type_name_by_id('marital_status', $partner_expectation_data[0]['partner_marital_status']) ?>
																							</td>
																							<td class="td-label">
																								<span><?php echo translate('profession') ?></span>
																							</td>
																							<td>
																								<?php if ($this->Crud_model->get_type_name_by_id('profession', $partner_expectation_data[0]['partner_profession']) == "") {
																									echo "I Dont Care";
																								} else {
																									echo $this->Crud_model->get_type_name_by_id('profession', $partner_expectation_data[0]['partner_profession']);
																								} ?>

																							</td>
																							<td class="td-label">
																								<span><?php echo translate('education') ?></span>
																							</td>
																							<td>
																								<?php if ($partner_expectation_data[0]['partner_education'] == "") {
																									echo "I Dont Care";
																								} else {
																									echo $this->Crud_model->get_type_name_by_id('education', $partner_expectation_data[0]['partner_education']);
																								} ?>

																							</td>

																						</tr>

																						<tr>
																							<td class="td-label">
																								<span>Nationality</span>
																							</td>
																							<td>
																								<?php if ($this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_nationality']) == "") {
																									echo "I Dont Care";
																								} else {
																									echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_nationality']);
																								} ?>
																							</td>
																							<td class="td-label">
																								<span>Residence</span>
																							</td>
																							<td>
																								<?php if ($this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_country_of_residence']) == "") {
																									echo "I Dont Care";
																								} else {
																									echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_country_of_residence']);
																								} ?>
																							</td>
																							<td class="td-label">
																								<span>Resident Status</span>
																							</td>
																							<td>
																								<?php if ($this->Crud_model->get_type_name_by_id('resident_status', $partner_expectation_data[0]['partner_resident_status']) == "") {
																									echo "I Dont Care";
																								} else {
																									echo $this->Crud_model->get_type_name_by_id('resident_status', $partner_expectation_data[0]['partner_resident_status']);
																								} ?>

																							</td>


																						</tr>
																						<tr>
																							<td class="td-label">
																								<span>Disabilities</span>
																							</td>
																							<td>
																								<?= $this->Crud_model->get_type_name_by_id('yes_no', $partner_expectation_data[0]['partner_any_disability']) ?>
																							</td>
																							<td class="td-label">
																								<span>Have Children</span>
																							</td>
																							<td>
																								<?= $this->Crud_model->get_type_name_by_id('yes_no', $partner_expectation_data[0]['partner_have_children']) ?>
																							</td>
																							<td class="td-label">
																								<span>If Yes, How Many</span>
																							</td>
																							<td>
																								<?= $partner_expectation_data[0]['partner_children_how_many'] ?>
																							</td>


																						</tr>
																						<tr>
																							<td class="td-label">
																								<span><?php echo translate('body_type') ?></span>
																							</td>
																							<td>
																								<?php if ($this->Crud_model->get_type_name_by_id('body_type', $partner_expectation_data[0]['partner_body_type']) == "") {
																									echo "I Dont Care";
																								} else {
																									echo $this->Crud_model->get_type_name_by_id('body_type', $partner_expectation_data[0]['partner_body_type']);
																								} ?>
																							</td>
																							<td class="td-label">
																								<span>Born At</span>
																							</td>
																							<td>
																								<?php if ($this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_born_at']) == "") {
																									echo "I Dont Care";
																								} else {
																									echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_born_at']);
																								} ?>
																							</td>
																							<td class="td-label">
																								<span>1st Language</span>
																							</td>
																							<td>
																								<?= $this->Crud_model->get_type_name_by_id('language', $partner_expectation_data[0]['partner_1_language']); ?>
																							</td>
																						</tr>


																					</tbody>
																				</table>
																			</div>
																		</div>
																	</div>

																	<div id="edit_partner_expectation" style="display: none;">
																		<div class="card-inner-title-wrapper pt-0">
																			<h3 class="card-inner-title pull-left">
																				PARTNER EXPECTATION
																			</h3>
																			<div class="pull-right">
																				<button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('partner_expectation')"><i class="ion-checkmark"></i></button>
																				<button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('partner_expectation')"><i class="ion-close"></i></button>
																			</div>
																		</div>

																		<div class='clearfix'></div>
																		<form id="form_partner_expectation" class="form-default" role="form">
																			<div class="row">
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_caste" class="text-uppercase c-gray-light">Sect</label>
																						<?php
																						echo $this->Crud_model->select_html('sect', 'partner_caste', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_caste'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_age" class="text-uppercase c-gray-light"><?php echo translate('age') ?></label>
																						<?php
																						echo $this->Crud_model->select_html('age_range', 'partner_age', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_age'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_height" class="text-uppercase c-gray-light"><?php echo translate('height') ?></label>
																						<input type="text" class="form-control no-resize height_mask" aria-describedby="text-feet" name="partner_height" value="<?= $partner_expectation_data[0]['partner_height'] ?>">
																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>

																			</div>
																			<div class="row">
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_marital_status" class="text-uppercase c-gray-light"><?php echo translate('marital_status') ?></label>
																						<?php
																						echo $this->Crud_model->select_html('marital_status', 'partner_marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_marital_status'], '', '', '');
																						?>
																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_profession" class="text-uppercase c-gray-light"><?php echo translate('profession') ?></label>
																						<?php
																						echo $this->Crud_model->select_html('profession', 'partner_profession', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_profession'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_education" class="text-uppercase c-gray-light"><?php echo translate('education') ?></label>
																						<?php
																						echo $this->Crud_model->select_html('education', 'partner_education', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_education'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>

																			</div>
																			<div class="row">
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_nationality" class="text-uppercase c-gray-light">Nationality</label>
																						<?php

																						echo $this->Crud_model->select_html('country', 'partner_nationality', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation_data[0]['partner_nationality'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_country_of_residence" class="text-uppercase c-gray-light"><?php echo translate('country_of_residence') ?></label>
																						<?php
																						echo $this->Crud_model->select_html('country', 'partner_country_of_residence', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_country_of_residence'], '', '', '');
																						?>
																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_resident_status" class="text-uppercase c-gray-light">Resident Status</label>
																						<?php
																						echo $this->Crud_model->select_html('resident_status', 'partner_resident_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_resident_status'], '', '', '');
																						?>
																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>

																			</div>

																			<div class="row">
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_any_disability" class="text-uppercase c-gray-light"><?php echo translate('any_disability') ?></label>
																						<?php
																						echo $this->Crud_model->select_html('dissablities', 'partner_any_disability', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_any_disability'], '', '', '');
																						?>
																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_have_children" class="text-uppercase c-gray-light">Have Children</label>
																						<?php
																						echo $this->Crud_model->select_html('yes_no', 'partner_have_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_have_children'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_children_how_many" class="text-uppercase c-gray-light">If Yes, How Many</label>
																						<input type="text" class="form-control no-resize" name="partner_children_how_many" value="<?= $partner_expectation_data[0]['partner_children_how_many'] ?>">
																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>

																			</div>
																			<div class="row">
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type') ?></label>
																						<?php
																						echo $this->Crud_model->select_html('body_type', 'partner_body_type', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_body_type'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_born_at" class="text-uppercase c-gray-light">Born At</label>
																						<?php

																						echo $this->Crud_model->select_html('country', 'partner_born_at', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation_data[0]['partner_born_at'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																				<div class="col-md-4">
																					<div class="form-group has-feedback">
																						<label for="partner_1_language" class="text-uppercase c-gray-light">1st Language</label>
																						<?php

																						echo $this->Crud_model->select_html('language', 'partner_1_language', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation_data[0]['partner_1_language'], '', '', '');
																						?>

																						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																						<div class="help-block with-errors"></div>
																					</div>
																				</div>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
															<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3">
																<div class="pull-right">
																	<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="check_form()">
																		NEXT
																	</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
						</section>
						<script>
							function check_form()
							{
								var introduction_empty = true;
								var i_am_looking_empty = true;
								var basicInfo_empty = true;
								var physical_empty = true;
								var astronomic_empty = true;
								var emailStatus = checkEmailStatus();
								showAlert = true;

								$("#introAlert").text("");
								$("#basicInfoAlert").text("");
								$("#howIlookAlert").text("");
								$("#religionAlert").text("");
								$("#emailVerificationAlert").text("");

								$('#form_introduction textarea').each(function() {
									if ($.trim($(this).val()) == "" || $(this).val() == undefined) {
										$(this).addClass('border-danger');
										introduction_empty = false;
										return false;
									}
								});
								
								$('#form_i_am_looking textarea').each(function() {
									if ($.trim($(this).val()) == "" || $(this).val() == undefined) {
										$(this).addClass('border-danger');
										i_am_looking_empty = false;
										return false;
									}
								});

								$('#form_basic_info *').filter(':input').each(function() {
									if ($.trim($(this).val()) == "" || $(this).val() == undefined) {
										basicInfo_empty = false;
										$(this).addClass('border-danger');
										return false;
									}
								});

								$('#form_physical_attributes *').filter(':input').each(function() {
									if ($.trim($(this).val()) == "" || $(this).val() == undefined) {
										physical_empty = false;
										$(this).addClass('border-danger');
										return false;
									}
								});

								$('#form_astronomic_information *').filter(':input').each(function() {
									if ($.trim($(this).val()) == "" || $(this).val() == undefined) {
										if (this.name != 'women_only' && this.name != 'wife_wear') {
											astronomic_empty = false;
											$(this).addClass('border-danger');
											return false;
										}
									}
								});

								
								if (introduction_empty == false) {

									showAlert = false;

									$("#introAlert").text("Please submit an introduction.");

								}
								
								if (i_am_looking_empty == false) {

									showAlert = false;

									$("#introAlert").text("Please submit an I am looking.");

								}
								if (basicInfo_empty == false) {

									showAlert = false;

									$("#basicInfoAlert").text("Please submit your complete profile information.");

								}
								if (physical_empty == false) {

									showAlert = false;

									$("#howIlookAlert").text("Please submit complete information regarding how you look.");

								}
								if (astronomic_empty == false) {

									showAlert = false;

									$("#religionAlert").text("Please submit complete religion-specific information.");
								}
								if (emailStatus == 0)
								{
									showAlert = false;
									$("#emailVerificationAlert").text("You have just received an email from Match Made In Jannah please open to VERIFY!")
								}

								if (showAlert == false)
								{
									$('#validation_alert').show();

									setTimeout(function() {
										$('#validation_alert').hide();
									}, 7000);
								}

								if (introduction_empty != false && i_am_looking_empty != false && basicInfo_empty != false && physical_empty != false && astronomic_empty  != false && emailStatus != 0)
								{
									window.location.href = "<?php echo base_url() ?>home/package_plans";
								}
							}

							function checkEmailStatus()
							{
								var tmp;

								$.ajax({
									'async': false,
									url: "<?php echo base_url() ?>home/checkEmailStatus",
									success: function(response) {
										tmp = response
									},
									fail: function(error) {
										alert(error);
									}
								});
								return tmp;
							}

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
									url: "<?php echo base_url() ?>home/profile/unhide_section/" + section,
									cache: false,
									success: function(response) {
										$('#ajax_danger_alert').fadeOut('fast');
										$('#ajax_success_alert').show();
										$('.ajax_success_alert').html("This Section Is Successfully Showed");
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
									url: "<?php echo base_url() ?>home/profile/hide_section/" + section,
									cache: false,
									success: function(response) {
										$('#ajax_success_alert').fadeOut('fast');
										$('#ajax_danger_alert').show();
										$('.ajax_danger_alert').html("This Section Is Successfully Hidden");
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
									url: "<?php echo base_url() ?>home/profile/update_" + section,
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
						</script>
						<script>
							$(".prefered_country_edit").change(function() {
								var country_id = $(".prefered_country_edit").val();
								if (country_id == "") {
									$(".prefered_state_edit").html("<option value=''>Choose A Country First</option>");
								} else {
									$.ajax({
										url: "<?php echo base_url() ?>home/get_dropdown_by_id/state/country_id/" + country_id, // form action url
										type: 'POST', // form submit method get/post
										dataType: 'html', // request type html/json/xml
										cache: false,
										contentType: false,
										processData: false,
										success: function(data) {
											$(".prefered_state_edit").html(data);
										},
										error: function(e) {
											console.log(e)
										}
									});
								}
							});
							$(".prefered_religion_edit").change(function() {
								var religion_id = $(".prefered_religion_edit").val();
								if (religion_id == "") {
									$(".prefered_caste_edit").html("<option value=''>Choose A Religion First</option>");
									$(".prefered_sub_caste_edit").html("<option value=''>Choose A Caste First</option>");
								} else {
									$.ajax({
										url: "<?php echo base_url() ?>home/get_dropdown_by_id_caste/caste/religion_id/" + religion_id, // form action url
										type: 'POST', // form submit method get/post
										dataType: 'html', // request type html/json/xml
										cache: false,
										contentType: false,
										processData: false,
										success: function(data) {
											$(".prefered_caste_edit").html(data);
											$(".prefered_sub_caste_edit").html("<option value=''>Choose A Caste First</option>");
										},
										error: function(e) {
											console.log(e)
										}
									});
								}
							});
							$(".prefered_caste_edit").change(function() {
								var caste_id = $(".prefered_caste_edit").val();
								if (caste_id == "") {
									$(".prefered_sub_caste_edit").html("<option value=''>Choose A Caste First</option>");
								} else {
									$.ajax({
										url: "<?php echo base_url() ?>home/get_dropdown_by_id_caste/sub_caste/caste_id/" + caste_id, // form action url
										type: 'POST', // form submit method get/post
										dataType: 'html', // request type html/json/xml
										cache: false,
										contentType: false,
										processData: false,
										success: function(data) {
											$(".prefered_sub_caste_edit").html(data);
										},
										error: function(e) {
											console.log(e)
										}
									});
								}
							});
						</script>
						<style type="text/css">
							.xs_nav_item {
								text-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
							}
						</style>

					</div>
				</div>
		</div> <!-- END: st-pusher -->
	<?php endforeach ?>
	</div> <!-- END: st-pusher -->
	</div> <!-- END: st-container -->
	</div><!-- END: body-wrap -->
	<!-- SCRIPTS -->
	<!-- Core -->

	<script src="<?= base_url() ?>template/front/vendor/jquery/jquery.min.js"></script>

	<!-- SCRIPTS -->
	<!-- Core -->
	<script src="<?php echo base_url() ?>template/front/js/jquery.inputmask.bundle.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/popper/popper.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>template/front/js/vendor/jquery.easing.js"></script>
	<script src="<?= base_url() ?>template/front/js/ie10-viewport-bug-workaround.js"></script>
	<script src="<?= base_url() ?>template/front/js/slidebar/slidebar.js"></script>
	<script src="<?= base_url() ?>template/front/js/classie.js"></script>
	<!-- Bootstrap Extensions -->
	<script src="<?= base_url() ?>template/front/vendor/bootstrap-dropdown-hover/js/bootstrap-dropdown-hover.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/bootstrap-notify/bootstrap-growl.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/scrollpos-styler/scrollpos-styler.js"></script>
	<!-- Plugins -->
	<script src="<?= base_url() ?>template/front/vendor/flatpickr/flatpickr.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/footer-reveal/footer-reveal.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/sticky-kit/sticky-kit.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/swiper/js/swiper.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/paraxify/paraxify.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/viewport-checker/viewportchecker.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/milestone-counter/jquery.countTo.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/countdown/js/jquery.countdown.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/typed/typed.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/instafeed/instafeed.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/gradientify/jquery.gradientify.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/nouislider/js/nouislider.min.js"></script>
	<!-- Isotope -->
	<script src="<?= base_url() ?>template/front/vendor/isotope/isotope.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
	<!-- Light Gallery -->
	<script src="<?= base_url() ?>template/front/vendor/lightgallery/js/lightgallery.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/lightgallery/js/lg-thumbnail.min.js"></script>
	<script src="<?= base_url() ?>template/front/vendor/lightgallery/js/lg-video.js"></script>
	<!-- App JS -->
	<script src="<?= base_url() ?>template/front/js/wpx.app.js"></script>

</body>

</html>