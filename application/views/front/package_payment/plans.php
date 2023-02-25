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
			<div class="col-lg-3 col-md-4" id="alert_danger" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
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
			<div class="st-pusher">
				<div class="st-content">
					<div class="st-content-inner">
						<!-- Navbar -->
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

							<section class="slice sct-color-1">
								<div class="container">
									<div class="row">
										<div class="container">
											<div class="row justify-content-md-center">
												<div>
													<ul class="nav nav-tabs process-model" role="tablist">
														<li class="active"><a>
																1
															</a>
															<p>Submit Your <br>
																Details</p>
														</li>
														<li class="active"><a>
																2
															</a>
															<p>Choose Your <br>
																Package</p>
														</li>
													</ul>
												</div>

											</div>

											<div class="row p-2">
												<div class="col-sm-12 col-xs-12 m-0 p-0">
													<div class="card-title card-bg">
														<h4 class="heading heading-6 ">
															MEMBERSHIP PACKAGES
														</h4>
													</div>
												</div>
												<div class="col-sm-6 m-0 p-0">

													<div class="single-prices">
														<div class="price-tags p-52">
															<h2>FREE</h2>
															<?php
																$plan_image = json_decode($all_plans[0]->image); 
																if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
															?>
															<div class="text-center">
																<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid  img-thumbnail">
															</div>
															<?php } ?>
														</div>
														<div class="price-items p-145">
															<h4>BRONZE PACKAGE OFFERS</h4>
															<ol>
																<li>VIEW GALLERY UNLIMITED</li>
																<li>ADD (1) PICTURE</li>
																<li>SEND ONLY (3) PRE-SET MESSAGES</li>
															</ol>
														</div>
														<div class="price-footer p-36">
															<h4>FREE</h4>
															<button type="submit" class="btn btn-styled btn-base-1 btn-md" onclick="isProfileCompleted(1)">Get Bronze</button>
														</div>
													</div>
												</div>
												<div class="col-sm-6 m-0 p-0">

													<div class="single-prices">
														<div class="price-tags">
															<h6 class="text-right">Most Popular</h6>
															<h2><span>(USD)</span> <?=currency('', 'def')?><?php echo $all_plans[1]->monthly_amount?> <span> per month</span> </h2>
															<?php
																$plan_image = json_decode($all_plans[1]->image); 
																if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
															?>
															<div class="text-center">
																<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid img-thumbnail">
															</div>
															<?php } ?>
															<p>Prescription renewed every month(s) thereafter</p>
														</div>
														<div class="price-items p-145">
															<h4>PLATINUM PACKAGE OFFERS</h4>
															<ol>
																<li> VIEW GALLERY UNLIMITED</li>
																<li>SEND INSTANT MESSAGES UNLIMITED</li>
																<li>RECEIVE & RESPOND TO MESSAGES</li>
																<li>VIEW WHO LIKED YOU</li>
																<li>SEND EMOJIS UNLIMITED</li>
																<li>ADD 3-4 PICTURES</li>
																<li>E-MAIL SENT WHEN INTEREST SHOWN</li>
																<li>LIKES LIST UNLIMITED</li>
																<li>INTEREST E-MAIL SENT</li>
															</ol>
														</div>
														<div class="price-footer p-36">
															<h4>SELECT PAYMENT PLAN</h4>
															<a href="<?=base_url()?>home/platinum_plan" type="submit" class="btn btn-styled btn-base-1 btn-md">Get Platinum</a>
														</div>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="pull-left mt-3 mb-3">
													<a class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" href="<?= base_url() ?>home/profile_detail">
														<i class="ion-arrow-left-c"></i> BACK
													</a>

												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div> <!-- END: st-pusher -->
			</div> <!-- END: st-pusher -->
		</div> <!-- END: st-container -->
	</div><!-- END: body-wrap -->

	<script>
		$(document).ready(function() {
			setTimeout(function() {
				$('.alert-success').fadeOut('fast');
			}, 5000); // <-- time in milliseconds
		});

		function isProfileCompleted(membership) {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() ?>home/markProfileCompleted/" + membership,
				cache: false,
				success: function(response) {
					if (response == "true") {
						window.location.href = "<?php echo base_url() ?>home/profile";
					}
				},
				fail: function(error) {
					alert(error);
				}
			});
		}
	</script>

	<!-- SCRIPTS -->
	<!-- Core -->
	<script src="<?php echo base_url() ?>template/front/vendor/popper/popper.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/js/vendor/jquery.easing.js"></script>
	<script src="<?php echo base_url() ?>template/front/js/ie10-viewport-bug-workaround.js"></script>
	<script src="<?php echo base_url() ?>template/front/js/slidebar/slidebar.js"></script>
	<script src="<?php echo base_url() ?>template/front/js/classie.js"></script>
	<!-- Bootstrap Extensions -->
	<script src="<?php echo base_url() ?>template/front/vendor/bootstrap-dropdown-hover/js/bootstrap-dropdown-hover.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/bootstrap-notify/bootstrap-growl.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/scrollpos-styler/scrollpos-styler.js"></script>
	<!-- Plugins -->
	<script src="<?php echo base_url() ?>template/front/vendor/flatpickr/flatpickr.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/footer-reveal/footer-reveal.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/sticky-kit/sticky-kit.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/swiper/js/swiper.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/paraxify/paraxify.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/viewport-checker/viewportchecker.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/milestone-counter/jquery.countTo.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/countdown/js/jquery.countdown.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/typed/typed.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/instafeed/instafeed.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/gradientify/jquery.gradientify.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/nouislider/js/nouislider.min.js"></script>
	<!-- Isotope -->
	<script src="<?php echo base_url() ?>template/front/vendor/isotope/isotope.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
	<!-- Light Gallery -->
	<script src="<?php echo base_url() ?>template/front/vendor/lightgallery/js/lightgallery.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/lightgallery/js/lg-thumbnail.min.js"></script>
	<script src="<?php echo base_url() ?>template/front/vendor/lightgallery/js/lg-video.js"></script>
	<!-- App JS -->
	<script src="<?php echo base_url() ?>template/front/js/wpx.app.js"></script> <a href="#" class="btn-shadow back-to-top btn-back-to-top"></a>
	<button class="open_modal" style="display: none">Open</button>

</body>

</html>