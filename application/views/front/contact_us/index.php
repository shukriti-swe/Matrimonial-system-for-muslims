<section class="slice sct-color-1">
	<?php if (!empty($success_alert)) : ?>
		<div class="col-6 ml-auto mr-auto" id="success_alert">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<?= $success_alert ?>
			</div>
		</div>
	<?php endif ?>
	<div class="card-title card-bg">
			<h3 class="heading heading-6">
			<?php echo translate('contact_us') ?>
			</h3>
		</div>
	<div class="container">

		<span class="clearfix"></span>
		<?php
		$contact_us_text = $this->db->get_where('frontend_settings', array('type' => 'contact_us_text'))->row()->value;
		// print_r($contact_us_text);die();
		?>


		<span class="space-xs-xl"></span>

		<div class="row justify-content-center">
			<div class="col-lg-8">
				<!-- Contact form -->
				<form class="form-default" role="form" method="POST" action="<?= base_url() ?>home/contact_us/send">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('your_name') ?></label>
								<input type="text" name="name" class="form-control form-control-md" required="" value="<?php (!empty($form_contents)) ? $form_contents['name'] : '' ;?>">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('email_address') ?></label>
								<input type="email" name="email" class="form-control form-control-md" required="" value="<?php (!empty($form_contents))?$form_contents:''; ?>">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('subject') ?></label>
								<input type="text" name="subject" class="form-control form-control-md" required="" value="<?php (!empty($form_contents))?$form_contents:''; ?>">
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback">
								<label for="" class="text-uppercase c-gray-light" style="color: black !important;font-weight: bold;"><?php echo translate('message') ?> <small class="text-danger sml_txt" style="text-transform: none;"><?= '(' . translate('max_300_characters') . ')' ?></small></label>
								<textarea name="message" class="form-control no-resize" rows="5" required="" maxlength="300"><?php (!empty($form_contents))?$form_contents:''; ?></textarea>
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<p style="margin-top: -17px;"><span>customers@matchmadeinjannah.com,</span>  	<span style="margin-left: 21px;">techelp@matchmadeinjannah.com, </span>  <span style="margin-left: 21px;"> success@matchmadeinjannah.com</span>                       </p>
						</div>
					</div>
					<?php
					if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') { ?>
						<div class="row">
							<div class="col-md-12">
								<?= $recaptcha_html ?>
							</div>
						</div>
					<?php } ?>
					<div class="mt-2 col-12">
						<?php if (!empty($captcha_incorrect) && $captcha_incorrect == TRUE) : ?>
							<p class="text-danger"><?= translate('captcha_incorrect') ?></p>
						<?php endif; ?>
					</div>
					<div class="">
						<button type="submit" class="btn btn-styled btn-base-1 mt-4"><?php echo translate('send_message') ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function() {
		setTimeout(function() {
			$('.alert-success').fadeOut('fast');
		}, 5000); // <-- time in milliseconds
	});
</script>