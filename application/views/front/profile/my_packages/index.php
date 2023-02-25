<div class="card-title card-bg-c">
	<div class="d-flex">
		<div class="flex-fill">
			<button type="button" class="btn btn-light btn-sm btn-icon-only btn-shadow mt-2" onclick="return location.reload();">
				<span><i class="ion-arrow-left-c"></i></span> Back
			</button></div>
		<div class="flex-fill">
			<h4 class="heading heading-6 text-left">
				MY PACKAGE
			</h4>
		</div>
	</div>
</div>
<div class="col-lg-3 col-md-4" id="ajax_success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
	<div class="alert alert-success ajax_success_alert fade show" role="alert">
		<!-- Success Alert Content -->
	</div>
</div>
<div class="col-lg-3 col-md-4" id="alert_danger" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
	<div class="alert alert-danger fade show" role="alert">
		<!-- Danger Alert Content -->
	</div>
</div>
<div class="card-body">
	<section class="sct-color-1 pricing-plans pricing-plans--style-1">
		<div class="container">
			<?php
				
				$memberSince = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'member_since');
				$membership = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'membership');
				$billing_id = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'billing_id');
			
				$paypalSubscriptionId = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'paypal_subscription_id');

				if ($membership == 1) {
					$userPackage = "BRONZE";
			?>
				<div class="row p-2">
					<div class="col-sm-6 m-0 p-0">
						<div class="card-title card-bg-c">
							<h6 class="heading heading-6">
								YOUR CURRENT PACKAGE
							</h6>
						</div>
						<div class="single-prices">
							<div class="price-tags p-40">
								<h2>BRONZE</h2>
								<?php
									$plan_image = json_decode($plans[0]->image); 
									if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
								?>
								<div class="text-center">
									<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid img-thumbnail">
								</div>
								<?php } ?>
							</div>
							<div class="price-items space-142">
								<h4>BRONZE PACKAGE OFFERS</h4>
								<ol>
									<li>VIEW GALLERY UNLIMITED</li>
									<li>ADD (1) PICTURE</li>
									<li>SEND ONLY (3) PRE-SET MESSAGES</li>
								</ol>
							</div>
							<div class="price-footer pt-2">
								<h4>PACKAGE DETAILS</h4>
								<div class="d-flex align-self-baseline">
									<div class="w-50">
										<h6>USER PACKAGE</h6>
									</div>
									<div class="w-50">
										<h6><?=$userPackage?></h6>
									</div>
								</div>
								<div class="d-flex ">
									<div class="w-50">
										<h6>PRICE</h6>
									</div>
									<div class="w-50">
										<h6>$0</h6>
									</div>
								</div>
								<div class="d-flex ">
									<div class="w-50">
										<h6>TIME PERIOD</h6>
									</div>
									<div class="w-50">
										<h6>Limited</h6>
									</div>
								</div>
								<div class="d-flex ">
									<div class="w-50">
										<h6>REGISTRATION DATE</h6>
									</div>
									<div class="w-50">
										<h6><?php echo date('M-d-Y', strtotime($memberSince)); ?></h6>
									</div>
								</div>

							</div>

						</div>
					</div>
					<div class="col-sm-6 m-0 p-0">
						<div class="card-title card-bg-c">
							<h6 class="heading heading-6">
								UPGRADE TO PLATINUM
							</h6>
						</div>
						<div class="single-prices">
							<div class="price-tags">
								<h6 class="text-right">Most Popular</h6>
								<h2><span>(USD)</span> <?=currency('', 'def')?><?php echo $plans[1]->monthly_amount?> <span>per month</span> </h2>
								<?php
									$plan_image = json_decode($plans[1]->image); 
									if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
								?>
								<div class="text-center">
									<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid img-thumbnail">
								</div>
								<?php } ?>
								<p>Subscription renewed every month(s) thereafter</p>
							</div>
							<div class="price-items">
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
								<button type="submit" class="btn btn-styled btn-base-1 btn-md" onclick="profile_load('get_platinum')">Get Platinum</button>
							</div>
						</div>
					</div>
				</div>
			<?php 
				}
				elseif ($membership == 2) {
					$userPackage = "PLATINUM";
					
					if ($billing_id == 1) {
						$timePeriod = "Every 3 months";
						$price = currency('', 'def')." ".$plans[1]->quaterly_amount;

					}
					elseif ($billing_id == 2) {
						$timePeriod = "Every 6 months";
						$price = currency('', 'def')." ".$plans[1]->bi_annually_amount;
					}
					elseif ($billing_id == 3) {
						$timePeriod = "Every year";
						$price = currency('', 'def')." ".$plans[1]->yearly_amount;
					}
					elseif ($billing_id == 4) {
						$timePeriod = "Every Month";
						$price = currency('', 'def')." ".$plans[1]->monthly_amount;
					}
			?>
				<div class="row p-2">
					<div class="col-sm-6 m-0 p-0">
						<div class="card-title card-bg-c">
							<h6 class="heading heading-6">
								YOUR CURRENT PACKAGE
							</h6>

						</div>
						<div class="single-prices">
							<div class="price-tags">
								<h6 class="text-right">Most Popular</h6>
								<h2><span>(USD)</span> <?=currency('', 'def')?><?php echo $plans[1]->monthly_amount?> <span>per month</span> </h2>
								<?php
									$plan_image = json_decode($plans[1]->image); 
									if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
								?>
								<div class="text-center">
									<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid img-thumbnail">
								</div>
								<?php } ?>
								<p>Prescription renewed every month(s) thereafter</p>
							</div>
							<div class="price-items">
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

							<div class="price-footer pt-2">
								<h4>PACKAGE DETAILS</h4>
								<div class="d-flex align-self-baseline">
									<div class="w-50">
										<h6>USER PACKAGE</h6>
									</div>
									<div class="w-50">
										<h6><?=$userPackage?></h6>
									</div>
								</div>
								<div class="d-flex ">
									<div class="w-50">
										<h6>PRICE</h6>
									</div>
									<div class="w-50">
										<h6><?=$price?></h6>
									</div>
								</div>
								<div class="d-flex ">
									<div class="w-50">
										<h6>TIME PERIOD</h6>
									</div>
									<div class="w-50">
										<h6><?=$timePeriod?></h6>
									</div>
								</div>
								<div class="d-flex ">
									<div class="w-50">
										<h6>REGISTRATION DATE</h6>
									</div>
									<div class="w-50">
										<h6><?php echo date('M-d-Y', strtotime($memberSince)); ?></h6>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="col-sm-6 m-0 p-0">
						<div class="card-title card-bg-c">
							<h6 class="heading heading-6">
								DOWNGRADE TO BRONZE
							</h6>
						</div>
						<div class="single-prices">
							<div class="price-tags p-40">
								<h2>BRONZE</h2>
								<?php
									$plan_image = json_decode($plans[0]->image); 
									if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
								?>
								<div class="text-center">
									<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid img-thumbnail">
								</div>
								<?php } ?>
							</div>
							<div class="price-items">
								<h4>BRONZE PACKAGE OFFERS</h4>
								<ol>
									<li>VIEW GALLERY UNLIMITED</li>
									<li>ADD (1) PICTURE</li>
									<li>SEND ONLY (3) PRE-SET MESSAGES</li>
								</ol>
							</div>
							<div class="price-footer p-36">
								<h4>BRONZE</h4>
								<button type="submit" class="btn btn-styled btn-base-1 btn-md" data-toggle="modal" data-target="#reasonModal">Get Bronze</button>
							</div>
						</div>
					</div>
				</div>
			<?php 
				}
				elseif ($membership == 3) { 
			?>
				<div class="row p-2">
					<div class="col-sm-4 m-0 p-0">
						<div class="space-w p-t-b-40">
							<h2>YOUR CURRENT PACKAGE</h2>
						</div>
						<div class="single-prices">
							<div class="price-tags p-t-40 p-b-58">
								<h2>FREE</h2>
								<?php
									$plan_image = json_decode($plans[2]->image);
									if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
								?>
								<div class="text-center">
									<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid img-thumbnail">
								</div>
								<?php } ?>
							</div>
							<div class="price-items p-1">
								<h5>FREE PACKAGE OFFERS</h5>
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

							<div class="price-footer pt-2">
								<h4>PACKAGE DETAILS</h4>
								<div class="d-flex ">
									<div class="w-60">
										<h6>USER PACKAGE</h6>
									</div>
									<div class="w-40">
										<h6>FREE</h6>
									</div>
								</div>
								<div class="d-flex">
									<div class="w-60">
										<h6>PRICE</h6>
									</div>
									<div class="w-40">
										<h6>$0</h6>
									</div>
								</div>
								<div class="d-flex">
									<div class="w-60">
										<h6>TIME PERIOD</h6>
									</div>
									<div class="w-40">
										<h6>Limited</h6>
									</div>
								</div>
								<div class="d-flex">
									<div class="w-60">
										<h6>REGISTRATION DATE</h6>
									</div>
									<div class="w-40">
										<h6><?php echo date('M-d-Y', strtotime($memberSince)); ?></h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-8 m-0 p-0">
						<div class="space-w">
							<h2>SELECT <br> BRONZE OR PLATINUM</h2>
							<p>Your Free offer is limited, please select Bronze or Platinum <br>If you fail to respond you will be moved to the Bronze Package</p>
						</div>
						<div class="dis-flex">
							<div class="flex-fill">
								<div class="single-prices">
									<div class="price-tags p-t-40 p-b-58">
										<h2>BRONZE</h2>
										<?php
											$plan_image = json_decode($plans[0]->image); 
											if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
										?>
										<div class="text-center">
											<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid img-thumbnail">
										</div>
										<?php } ?>
									</div>
									<div class="price-items p-1">
										<h5>BRONZE PACKAGE OFFERS</h5>
										<ol>
											<li>VIEW GALLERY UNLIMITED</li>
											<li>ADD (1) PICTURE</li>
											<li>SEND ONLY (3) PRE-SET MESSAGES</li>
										</ol>
									</div>
									<div class="price-footer p-20">
										<h4>BRONZE</h4>
										<button type="submit" class="btn btn-styled btn-base-1 btn-md" data-toggle="modal" data-target="#reasonModal">Get Bronze</button>
									</div>
								</div>
								</di>
							</div>
							<div class="flex-fill">
								<div class="single-prices">
									<div class="price-tags">
										<h6 class="text-right fs-12">Most Popular</h6>
										<h2><span>(USD)</span> <?=currency('', 'def')?><?php echo $plans[1]->monthly_amount?> <span>per month</span> </h2>
										<?php
											$plan_image = json_decode($plans[1]->image); 
											if (file_exists('uploads/plan_image/'. $plan_image[0]->image)){ 
										?>
										<div class="text-center">
											<img src="<?= base_url() ?>uploads/plan_image/<?= $plan_image[0]->image ?>" alt="" class="img-fluid img-thumbnail">
										</div>
										<?php } ?>
										<p>Prescription renewed every <br> month(s) thereafter</p>
									</div>
									<div class="price-items p-1">
										<h5>PLATINUM PACKAGE OFFERS</h5>
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
									<div class="price-footer p-20">
										<h4>SELECT PAYMENT PLAN</h4>
										<button type="submit" class="btn btn-styled btn-base-1 btn-md" onclick="profile_load('get_platinum')">Get Platinum</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			
		</div>
</div>
</section>
</div>


<!-- Reason Modal -->
<div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" style="max-width: 400px; margin-top: 30vh;">
		<div class="modal-content">
			<div class="modal-header" style="display: block; border-bottom: 1px solid transparent">
				<span class="modal-title" id="modal_header"><?php echo translate('reason') ?> *</span>
				<button type="button" class="close" id="modal_close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center" id="modal_body">
				<textarea class="form-control form-control-sm" id="reason" rows="4" placeholder="Enter your reason"></textarea>
				<span id="reasonAlert" class="text-danger" style="display: none;">Enter your reason</span>
			</div>
			<br>
			<div class="text-center" id="modal_buttons">
				<button type="button" class="btn btn-styled btn-base-1 btn-sm w-25" onclick="cancelSubscription()"><?php echo translate('confirm') ?></button>
			</div>
		</div>
	</div>
</div>

<script>
	function cancelSubscription() {
		reason = $("#reason").val();
		if (reason.trim() != false) {
			$.ajax({
				type: 'POST',
				dataType: 'text',
				url: "<?= base_url() ?>home/cancelSubscription/" + reason,
				success: function(data) {
					$('#reasonModal').modal('hide');
					$("#ajax_success_alert").show();
					$(".ajax_success_alert").html("Your subscription has been cancelled");
					setTimeout(function() {
						$("#ajax_success_alert").hide();
						location.reload();
					}, 5000)
				},
				fail: function(error) {
					alert(error);
				}
			});
		} else {
			$("#reasonAlert").show();
		}
	}

	
</script>

