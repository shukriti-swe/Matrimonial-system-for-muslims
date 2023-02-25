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

	<!-- MAIN WRAPPER -->
	<div class="body-wrap">
		<div id="st-container" class="st-container">

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

								<section class="slice sct-color-2">

									<div class="profile">
										<div class="container">
												<div class="row p-2">
													<div class="col-md-12 col-xs-12 m-0 p-0 mt-20">
														<div class="card-title card-bg-c">
															<div class="d-flex">
																<div class="flex-fill">
																	<a href="<?=base_url()?>home/package_plans" type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2">
																		<span><i class="ion-arrow-left-c"></i></span> Back
																	</a></div>
																<div class="flex-fill">
																	<h4 class="heading heading-6 text-left">
																		PURCHASE PLATINUM
																	</h4>
																</div>
															</div>
														</div>
														<div class="col-sm-12 m-0 p-0">
															<div class="single-prices">
																<div class="price-tags">
																	<h6 class="text-right">Most Popular</h6>
																	<h2><span>(USD)</span> <?=currency('', 'def')?><?php echo $all_plans[1]->monthly_amount?> <span>per month</span> </h2>
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
																<div class="dis-flex">
																	<div class="flex-fill b-r ">
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
																	</div>
																	<div class="flex-fill">
																		<div class="price-items p-145">
																			<div class="p-65">
																				<h4>SELECT PAYMENT PLAN</h4>
																				<div class="form-checks">
																					<label class="form-check-labels">
																					 <input class="form-check-input" type="radio" name="billingType" id="quarterly" value="1" checked><?=currency('', 'def')?><?=$all_plans[1]->quaterly_amount?> Every 3 months
																					</label><br>
																					<label class="form-check-labels">
																					  <input class="form-check-input" type="radio" name="billingType" id="bi_annually" value="2"><?=currency('', 'def')?><?=$all_plans[1]->bi_annually_amount?> Every 6 months
																					</label><br>
																					<label class="form-check-labels">
																						  <input class="form-check-input" type="radio" name="billingType" id="annually" value="3"><?=currency('', 'def')?><?=$all_plans[1]->yearly_amount?> Every year
																					</label>
																				</div>
																				<!-- <div id="paypal-button-container1"></div>
																				<div id="paypal-button-container2" style="display: none;"></div>
																				<div id="paypal-button-container3" style="display: none;"></div> -->

																				<button
																				  style="background-color:#e91e63;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em;"
																				  id="quarterly_plan_btn"
																				  role="link"
																				  type="button"
																				>
																				  Subscribe to Quarterly Plan 
																				</button>

																				<button
																				  style="background-color:#e91e63;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em; display: none;"
																				  id="bi_annually_plan_btn"
																				  role="link"
																				  type="button"
																				>
																				  Subscribe to Bi Annually Plan
																				</button>

																				<button
																				  style="background-color:#e91e63;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em; display: none;"
																				  id="annually_plan_btn"
																				  role="link"
																				  type="button"
																				>
																				  Subscribe to Annually Plan
																				</button>

																				<div id="error-message"></div>
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
	<!-- SCRIPTS -->
	<script src="https://js.stripe.com/v3/"></script>

	<script>
		$('input[type=radio][name=billingType]').change(function() {
		    if (this.id == 'quarterly') {
				$("#quarterly_plan_btn").show();
				$("#bi_annually_plan_btn").hide();
				$("#annually_plan_btn").hide();
			} 
			else if (this.id == 'bi_annually') {
				$("#bi_annually_plan_btn").show();
				$("#quarterly_plan_btn").hide();
				$("#annually_plan_btn").hide();
			} 
			else if (this.id == 'annually') {
				$("#annually_plan_btn").show();
				$("#bi_annually_plan_btn").hide();
				$("#quarterly_plan_btn").hide();
			}
		});
	</script>

	<script>
		var success_url = '<?php echo base_url() . 'home/thankyou_page' ?>';
		var cancel_url = '<?php echo base_url() . 'home/profile' ?>';

		var quarterly_plan = '<?php echo QUARTERLY_PLAN_PRICE_KEY; ?>';
		var bi_annually_plan = '<?php echo BI_ANNUAL_PLAN_PRICE_KEY; ?>';
		var annual_plan = '<?php echo ANNUAL_PLAN_PRICE_KEY; ?>';

		var _key = '<?php echo STRIPE_KEY; ?>';
		var stripe = Stripe(_key);

		(function() {

		  var checkoutButton = document.getElementById('quarterly_plan_btn');
		  checkoutButton.addEventListener('click', function () {

		    stripe.redirectToCheckout({
		      lineItems: [{price: quarterly_plan, quantity: 1}],
		      mode: 'subscription',
		      successUrl: success_url+'/{CHECKOUT_SESSION_ID}',
		      cancelUrl: cancel_url,
		    })
		    .then(function (result) {
		      if (result.error) {
		        var displayError = document.getElementById('error-message');
		        displayError.textContent = result.error.message;
		      }
		    });
		  });
		})();

		(function() {

		  var checkoutButton = document.getElementById('bi_annually_plan_btn');
			checkoutButton.addEventListener('click', function () {
			    stripe.redirectToCheckout({
			      lineItems: [{price: bi_annually_plan, quantity: 1}],
			      mode: 'subscription',
			      successUrl: success_url+'/{CHECKOUT_SESSION_ID}',
			      cancelUrl: cancel_url,
			    })
			    .then(function (result) {
			      if (result.error) {
			        // If `redirectToCheckout` fails due to a browser or network
			        // error, display the localized error message to your customer.
			        var displayError = document.getElementById('error-message');
			        displayError.textContent = result.error.message;
			      }
			    });
			});
		})();

		(function() {

		  var checkoutButton = document.getElementById('annually_plan_btn');
		  checkoutButton.addEventListener('click', function () {
		    // When the customer clicks on the button, redirect
		    // them to Checkout.
		    stripe.redirectToCheckout({
		      lineItems: [{price: annual_plan, quantity: 1}],
		      mode: 'subscription',
		      successUrl: success_url+'/{CHECKOUT_SESSION_ID}',
		      cancelUrl: cancel_url,
		    })
		    .then(function (result) {
		      if (result.error) {
		        // If `redirectToCheckout` fails due to a browser or network
		        // error, display the localized error message to your customer.
		        var displayError = document.getElementById('error-message');
		        displayError.textContent = result.error.message;
		      }
		    });
		  });
		})();
	</script>

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