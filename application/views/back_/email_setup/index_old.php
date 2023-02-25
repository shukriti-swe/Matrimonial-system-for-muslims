<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
	<div id="page-head">
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow"><?php echo translate('email_setup')?></h1>

		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->
		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#"><?php echo translate('home')?></a></li>
			<li><a href="#"><?php echo translate('configurations')?></a></li>
			<li><a href="#"><?php echo translate('email_setup')?></a></li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->
	</div>
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		<div class="panel">
			<?php if (!empty($success_alert)): ?>
				<div class="alert alert-success" id="success_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$success_alert?>
	            </div>
			<?php endif ?>
			<?php if (!empty($danger_alert)): ?>
				<div class="alert alert-danger" id="danger_alert" style="display: block">
	                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
	                <?=$danger_alert?>
	            </div>
			<?php endif ?>
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo translate('email_setup')?></h3>
			</div>
			<div class="panel-body">

				<div class="tab-base tab-stacked-left">
		            <!--Nav tabs-->
		            <?php
                		$password_reset_email = $this->db->get_where('email_template', array('email_template_id' => 1))->result();
                		$package_purchase_email = $this->db->get_where('email_template', array('email_template_id' => 2))->result();
                		$account_opening_email = $this->db->get_where('email_template', array('email_template_id' => 4))->result();
                		$staff_opening_email = $this->db->get_where('email_template', array('email_template_id' => 5))->result();
                		$deleted_member_email = $this->db->get_where('email_template', array('email_template_id' => 6))->result();
                		$incomplete_profile_email = $this->db->get_where('email_template', array('email_template_id' => 8))->result();
                		$downgrade_to_bronze_email = $this->db->get_where('email_template', array('email_template_id' => 12))->result();
                		$platinum_subscription_email = $this->db->get_where('email_template', array('email_template_id' => 13))->result();
                		$bronze_subscription_email = $this->db->get_where('email_template', array('email_template_id' => 14))->result();
                		$photo_submission_email = $this->db->get_where('email_template', array('email_template_id' => 15))->result();
                		$video_submission_email = $this->db->get_where('email_template', array('email_template_id' => 16))->result();
                		$photo_approval_email = $this->db->get_where('email_template', array('email_template_id' => 17))->result();
                		$video_approval_email = $this->db->get_where('email_template', array('email_template_id' => 18))->result();
                		$photo_rejection_email = $this->db->get_where('email_template', array('email_template_id' => 19))->result();
                		$video_rejection_email = $this->db->get_where('email_template', array('email_template_id' => 20))->result();
                		$delete_account_email = $this->db->get_where('email_template', array('email_template_id' => 11))->result();
                		$paypal_payment_failure_email = $this->db->get_where('email_template', array('email_template_id' => 21))->result();
                		$no_pic_profile_email = $this->db->get_where('email_template', array('email_template_id' => 7))->result();
                		$interest_email = $this->db->get_where('email_template', array('email_template_id' => 10))->result();
                		$interest_email = $this->db->get_where('email_template', array('email_template_id' => 10))->result();
                		$ads_approval_email = $this->db->get_where('email_template', array('email_template_id' => 22))->result();
                		$ads_reject_email = $this->db->get_where('email_template', array('email_template_id' => 23))->result();
                		$ads_url_email = $this->db->get_where('email_template', array('email_template_id' => 24))->result();
                	?>
		            <ul class="nav nav-tabs" style="width: 145px;">
		                <li class="active">
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-1"><?php echo $password_reset_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-2"><?php echo $package_purchase_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-3"><?php echo $account_opening_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-4"><?php echo $staff_opening_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-5"><?php echo $deleted_member_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-7"><?php echo $incomplete_profile_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-8"><?php echo $downgrade_to_bronze_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-9"><?php echo $platinum_subscription_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-10"><?php echo $bronze_subscription_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-11"><?php echo $photo_submission_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-12"><?php echo $video_submission_email[0]->subject ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-13"><?php echo $photo_approval_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-22"><?php echo $ads_approval_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-14"><?php echo $video_approval_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-15"><?php echo $photo_rejection_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-23"><?php echo $ads_reject_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-24"><?php echo $ads_url_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-16"><?php echo $video_rejection_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-17"><?php echo $delete_account_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-18"><?php echo $paypal_payment_failure_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-19"><?php echo $no_pic_profile_email[0]->subject; ?></a>
		                </li>
		                <li>
		                    <a data-toggle="tab" style="color: black; font-weight: bold;" href="#tab-20"><?php echo $interest_email[0]->subject; ?></a>
		                </li>
		            </ul>
		
		            <!--Tabs Content-->
		            <div class="tab-content">
		                <div id="tab-1" class="tab-pane fade active in">
		                	<?php
		                	foreach ($password_reset_email as $value1) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/password_reset_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="password_reset_email_sub" value="<?=$value1->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="password_reset_email_body" style="height: 380px;"><?=$value1->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-2" class="tab-pane fade">
		                	<?php
		                	foreach ($package_purchase_email as $value2) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/package_purchase_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="account_approval_email_sub" value="<?=$value2->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="account_approval_email_body" style="height: 380px;"><?=$value2->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-3" class="tab-pane fade">
		                	<?php
		                	foreach ($account_opening_email as $value3) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/account_opening_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="account_opening_email_sub" value="<?=$value3->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="account_opening_email_body" style="height: 380px;"><?=$value3->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-4" class="tab-pane fade">
		                	<?php
		                	foreach ($staff_opening_email as $value4) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/staff_add_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="staff_add_email_sub" value="<?=$value4->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="staff_add_email_body" style="height: 380px;"><?=$value4->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-5" class="tab-pane fade">
		                	<?php
		                	foreach ($deleted_member_email as $value5) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/deleted_member_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="delete_member_email_sub" value="<?=$value5->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="delete_member_email_body" style="height: 380px;"><?=$value5->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-7" class="tab-pane fade">
		                	<?php
		                	foreach ($incomplete_profile_email as $value7) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/incomplete_profile_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="incomplete_profile_email_sub" value="<?=$value7->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="incomplete_profile_email_body" style="height: 380px;"><?=$value7->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-8" class="tab-pane fade">
		                	<?php
		                	foreach ($downgrade_to_bronze_email as $value8) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/downgrade_to_bronze_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="downgrade_to_bronze_email_sub" value="<?=$value8->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="downgrade_to_bronze_email_body" style="height: 380px;"><?=$value8->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-9" class="tab-pane fade">
		                	<?php
		                	foreach ($platinum_subscription_email as $value9) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/platinum_subscription_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="platinum_subscription_email_sub" value="<?=$value9->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="platinum_subscription_email_body" style="height: 380px;"><?=$value9->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-10" class="tab-pane fade">
		                	<?php
		                	foreach ($bronze_subscription_email as $value10) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/bronze_subscription_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="bronze_subscription_email_sub" value="<?=$value10->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="bronze_subscription_email_body" style="height: 380px;"><?=$value10->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-11" class="tab-pane fade">
		                	<?php
		                	foreach ($photo_submission_email as $value11) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/photo_submission_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="photo_submission_email_sub" value="<?=$value11->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="photo_submission_email_body" style="height: 380px;"><?=$value11->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-12" class="tab-pane fade">
		                	<?php
		                	foreach ($video_submission_email as $value12) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/video_submission_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="video_submission_email_sub" value="<?=$value12->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="video_submission_email_body" style="height: 380px;"><?=$value12->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-13" class="tab-pane fade">
		                	<?php
		                	foreach ($photo_approval_email as $value13) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/photo_approval_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="photo_approval_email_sub" value="<?=$value13->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="photo_approval_email_body" style="height: 380px;"><?=$value13->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-22" class="tab-pane fade">
		                	<?php
		                	foreach ($ads_approval_email as $value22) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/ads_approval_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="ads_approval_email_sub" value="<?=$value22->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="ads_approval_email_body" style="height: 380px;"><?=$value22->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-23" class="tab-pane fade">
		                	<?php
		                	foreach ($ads_reject_email as $value23) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/ads_reject_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="ads_reject_email_sub" value="<?=$value23->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="ads_reject_email_body" style="height: 380px;"><?=$value23->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-24" class="tab-pane fade">
		                	<?php
		                	foreach ($ads_url_email as $value24) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/ads_url_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="ads_url_email_sub" value="<?=$value24->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="ads_url_email_body" style="height: 380px;"><?=$value24->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>

		                <div id="tab-14" class="tab-pane fade">
		                	<?php
		                	foreach ($video_approval_email as $value14) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/video_approval_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="video_approval_email_sub" value="<?=$value14->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="video_approval_email_body" style="height: 380px;"><?=$value14->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-15" class="tab-pane fade">
		                	<?php
		                	foreach ($photo_rejection_email as $value15) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/photo_rejection_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="photo_rejection_email_sub" value="<?=$value15->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="photo_rejection_email_body" style="height: 380px;"><?=$value15->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-16" class="tab-pane fade">
		                	<?php
		                	foreach ($video_rejection_email as $value16) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/video_rejection_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="video_rejection_email_sub" value="<?=$value16->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="video_rejection_email_body" style="height: 380px;"><?=$value16->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-17" class="tab-pane fade">
		                	<?php
		                	foreach ($delete_account_email as $value16) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/delete_account_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="delete_account_email_sub" value="<?=$value16->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="delete_account_email_body" style="height: 380px;"><?=$value16->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-18" class="tab-pane fade">
		                	<?php
		                	foreach ($paypal_payment_failure_email as $value18) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/paypal_payment_failure_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="paypal_payment_failure_email_sub" value="<?=$value18->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="paypal_payment_failure_email_body" style="height: 380px;"><?=$value18->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-19" class="tab-pane fade">
		                	<?php
		                	foreach ($no_pic_profile_email as $value19) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/no_pic_profile_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="no_pic_profile_email_sub" value="<?=$value19->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="no_pic_profile_email_body" style="height: 380px;"><?=$value19->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
	                        <?php
	                    	}
	                        ?>
		                </div>
		                <div id="tab-20" class="tab-pane fade">
		                	<?php
		                	foreach ($interest_email as $value20) {
		                	?>
		                	<form class="form-horizontal" id="email_setup_form" method="POST" action="<?=base_url()?>admin/update_email_setup/interest_email">
			                	<div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('subject')?></b>
	                                </label>
	                                <div class="col-sm-8 col-sm-offse">
	                                	<input type="text" name="interest_email_sub" value="<?=$value20->subject?>" placeholder="" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group btm_border">
	                                <label class="col-sm-2 control-label" for="email_setup"><b><?=translate('email_body')?></b>
	                                </label>
	                                <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea" data-height="100" name="interest_email_body" style="height: 380px;"><?=$value20->body?></textarea>
	                                    <br>
	                                    <span class="text-danger">**N.B : <?=translate('Do Not Change The Variables Like')?> [[ ____ ]].**</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
									<div class="col-sm-offset-2 col-sm-9">
							        	<button type="submit" class="btn btn-primary btn-sm btn-labeled fa fa-save"><?php echo translate('submit')?></button>
									</div>
								</div>
	                        </form>
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
<script>
	setTimeout(function() {
	    $('#success_alert').fadeOut('fast');
	    $('#danger_alert').fadeOut('fast');
	}, 5000); // <-- time in milliseconds
</script>