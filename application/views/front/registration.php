<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?=$this->db->get_where('general_settings', array('general_settings_id' => 24))->row()->value?>">
        <meta name="keywords" content="<?=$this->db->get_where('general_settings', array('general_settings_id' => 25))->row()->value?>">
        <meta name="author" content="<?=$this->db->get_where('general_settings', array('general_settings_id' => 26))->row()->value?>">
        <meta name="revisit-after" content="<?=$this->db->get_where('general_settings', array('general_settings_id' => 54))->row()->value?> day(s)">
        <title><?=$this->system_title?></title>
        <!-- Page loader -->
        <script src="<?=base_url()?>template/front/vendor/pace/js/pace.min.js"></script>
        <link rel="stylesheet" href="<?=base_url()?>template/front/vendor/pace/css/pace-minimal.css" type="text/css">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?=base_url()?>template/front/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <!-- Plugins -->
        <link rel="stylesheet" href="<?=base_url()?>template/front/vendor/swiper/css/swiper.min.css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/vendor/hamburgers/hamburgers.min.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/vendor/animate/animate.min.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/vendor/lightgallery/css/lightgallery.min.css">
        <!-- Icons -->
        <link rel="stylesheet" href="<?=base_url()?>template/front/fonts/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/fonts/ionicons/css/ionicons.min.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/fonts/line-icons/line-icons.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/fonts/line-icons-pro/line-icons-pro.css" type="text/css">
        <!-- Linea Icons -->
        <link rel="stylesheet" href="<?=base_url()?>template/front/fonts/linea/arrows/linea-icons.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/fonts/linea/basic/linea-icons.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/fonts/linea/ecommerce/linea-icons.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url()?>template/front/fonts/linea/software/linea-icons.css" type="text/css">
        <!-- Global style (main) -->
        <?php
            $theme_color = $this->db->get_where('frontend_settings', array('type' => 'theme_color'))->row()->value; 
            if ($theme_color == 'default-color') { ?>
                <link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style.css" rel="stylesheet" media="screen">
            <?php
            } elseif ($theme_color == 'pink') { ?>
                <link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-pink.css" rel="stylesheet" media="screen">
            <?php   
            } elseif ($theme_color == 'purple') { ?>
                <link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-purple.css" rel="stylesheet" media="screen">
            <?php   
            } elseif ($theme_color == 'light-blue') { ?>
                <link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-light-blue.css" rel="stylesheet" media="screen">
            <?php   
            } elseif ($theme_color == 'green') { ?>
                <link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-green.css" rel="stylesheet" media="screen">
            <?php   
            } elseif ($theme_color == 'dark') { ?>
                <link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-dark.css" rel="stylesheet" media="screen">
            <?php   
            } elseif ($theme_color == 'super-dark') { ?>
                <link id="stylesheet" type="text/css" href="<?=base_url()?>template/front/css/global-style-super-dark.css" rel="stylesheet" media="screen">
            <?php   
            }
        ?>
        <!-- Custom style - Remove if not necessary -->
        <link type="text/css" href="<?=base_url()?>template/front/css/custom-style.css" rel="stylesheet">
        <!-- Favicon -->
        <script src="<?=base_url()?>template/front/vendor/jquery/jquery.min.js"></script>
        
        <?php
            $favicon = $this->db->get_where('frontend_settings', array('type' => 'favicon'))->row()->value;
            $favicon = json_decode($favicon, true);
            if (!empty($favicon) && file_exists('uploads/favicon/'.$favicon[0]['image'])) {
        ?>
                <link href="<?=base_url()?>uploads/favicon/<?=$favicon[0]['image']?>" rel="icon" type="image/png">
        <?php
            }
            else {
        ?>
                <link href="<?=base_url()?>uploads/favicon/default_image.png" rel="icon" type="image/png">
        <?php
            }
        ?>
        
    </head>
    <body>
        <?php include 'preloader.php';?>
        <?php include_once 'header/header.php';?>
        <?php 
            $registration_image = $this->db->get_where('frontend_settings', array('type' => 'registration_image'))->row()->value;
            $registration_image_data = json_decode($registration_image, true);

        ?>
        <section class="slice-lg has-bg-cover bg-size-cover" style="background-image: url(<?=base_url()?>uploads/registration_image/<?=$registration_image_data[0]['image']?>); background-position: bottom bottom;">
            <span class="mask mask-dark--style-2"></span>
            <div class="container">
                <div class="row cols-xs-space align-items-center text-center text-md-left">
                    <div class="col-lg-6 col-md-10 ml-auto mr-auto">
                        <div class="form-card form-card--style-2 z-depth-3-top">
                            <div class="form-body">
                                <div class="text-center px-2">
                                    <h4 class="heading heading-4 strong-400 mb-4 font_light"><?=translate('create_your_account')?></h4>
                                </div>
                                <div style="color: #fff!important;font-weight: 400;font-size: 11px;text-align:center;margin:0">Your Name, DOB and Mobile No. will never be displayed, It is for office use only! </div>
                                <form class="form-default mt-4" id="register_form" method="post" action="<?=base_url()?>home/registration/add_info">
                                    <div class="row">
                                        <!--<div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('first_name')?></label>
                                                <input type="text" class="form-control form-control-sm" name="first_name" value="<?php if(!empty($form_contents)){echo $form_contents['first_name'];}?>" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('last_name')?></label>
                                                <input type="text" class="form-control form-control-sm" name="last_name" value="<?php if(!empty($form_contents)){echo $form_contents['last_name'];}?>">
                                            </div>
                                        </div>-->
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('user_name')?> <subs>*</subs></label>
                                                <input type="text" class="form-control form-control-sm" name="user_name" value="<?php if(!empty($form_contents)){echo $form_contents['user_name'];}?>" tabindex=1>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('email')?> <subs>*</subs></label>
                                                <input type="email" class="form-control form-control-sm" name="email" value="<?php if(!empty($form_contents)){echo $form_contents['email'];}?>" tabindex=2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('date_of_birth')?> <subs>*</subs></label>
                                                <input type="date" class="form-control form-control-sm" name="date_of_birth" value="<?php if(!empty($form_contents)){echo $form_contents['date_of_birth'];}?>" tabindex=3>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('mobile')?> <subs>*</subs></label>
                                                <input type="text" class="form-control form-control-sm" name="mobile" value="<?php if(!empty($form_contents)){echo $form_contents['mobile'];}?>" tabindex=4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('gender')?> <subs>*</subs></label>
                                                <?php 
                                                    if (!empty($form_contents)) {
                                                        echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['gender'], '', '', '', '',5);
                                                    }
                                                    else {
                                                        echo $this->Crud_model->select_html('gender', 'gender', 'name', 'add', 'form-control form-control-sm selectpicker', '', '', '', '','',5);
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('on_behalf')?> <subs>*</subs></label>
                                                <?php 
                                                    if (!empty($form_contents)) {
                                                        echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['on_behalf'], '', '', '', '',6);
                                                    }
                                                    else {
                                                        echo $this->Crud_model->select_html('on_behalf', 'on_behalf', 'name', 'add', 'form-control form-control-sm selectpicker', '', '', '', '','',6);
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                     
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label font_light"><?php echo translate('password')?> <subs>*</subs></label>
                                                <input type="password" class="form-control form-control-sm" name="password" tabindex=7>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label font_light"><?php echo translate('confirm_password')?>  <subs>*</subs></label>
                                                <input type="password" class="form-control form-control-sm" name="confirm_password" tabindex=8>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        if($this->Crud_model->get_settings_value('third_party_settings','captcha_status','value') == 'ok') {
                                    ?>
                                        <div class="row" style="margin-left: 16%;">
                                            <div class="col-md-12">
                                                <?=$recaptcha_html?>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="mt-1 col-12">
                                        <input type="checkbox" name="agree_terms">
                                        <small class="font_light"><?=translate('I_agree_to_Match_Made_In_Jannah')?> <a href="<?=base_url()?>home/terms_and_conditions" class="font_light"><?=translate('terms_and_conditions')?></a> & <a href="<?=base_url()?>home/privacy_policy" class="font_light">Privacy Policy</a></small>
                                        <div class="mt-2" style="color: #ccc !important">
                                            <?php
                                                echo validation_errors();
                                                if (!empty($captcha_incorrect) && $captcha_incorrect == TRUE): ?>
                                                    <p><?=translate('captcha_incorrect')?></p>
                                                <?php endif;
                                                if (!empty($disallowed_char)): ?>
                                                    <p><?=$disallowed_char;?></p>
                                            <?php endif; ?>
                                        </div>
                                        <style>
                                            p{
                                                margin: 0px;
                                                font-size: 12px;
                                                color: red;
                                            }
                                        </style>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom mt-2" style="width: 100%">
                                            <?php echo translate('register')?>
                                        </button>
                                        <div class="row pt-3">
                                            <div class="col-12 text-center" style="font-size: 12px;">
                                                <a class="font_light" href="<?=base_url()?>home/login" class=""><u><?php echo translate('log_in_page')?></u></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FOOTER -->
		<?php include_once'footer/footer.php';?>
        <!-- SCRIPTS -->
        <a href="#" class="back-to-top btn-back-to-top"></a>
        <!-- Core -->
        <script src="<?=base_url()?>template/front/vendor/popper/popper.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>template/front/js/vendor/jquery.easing.js"></script>
        <script src="<?=base_url()?>template/front/js/ie10-viewport-bug-workaround.js"></script>
        <script src="<?=base_url()?>template/front/js/slidebar/slidebar.js"></script>
        <script src="<?=base_url()?>template/front/js/classie.js"></script>
        <!-- Bootstrap Extensions -->
        <script src="<?=base_url()?>template/front/vendor/bootstrap-dropdown-hover/js/bootstrap-dropdown-hover.js"></script>
        <script src="<?=base_url()?>template/front/vendor/bootstrap-notify/bootstrap-growl.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/scrollpos-styler/scrollpos-styler.js"></script>
        <!-- Plugins -->
        <script src="<?=base_url()?>template/front/vendor/flatpickr/flatpickr.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/footer-reveal/footer-reveal.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/sticky-kit/sticky-kit.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/swiper/js/swiper.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/paraxify/paraxify.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/viewport-checker/viewportchecker.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/milestone-counter/jquery.countTo.js"></script>
        <script src="<?=base_url()?>template/front/vendor/countdown/js/jquery.countdown.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/typed/typed.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/instafeed/instafeed.js"></script>
        <script src="<?=base_url()?>template/front/vendor/gradientify/jquery.gradientify.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/nouislider/js/nouislider.min.js"></script>
        <!-- Isotope -->
        <script src="<?=base_url()?>template/front/vendor/isotope/isotope.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
        <!-- Light Gallery -->
        <script src="<?=base_url()?>template/front/vendor/lightgallery/js/lightgallery.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/lightgallery/js/lg-thumbnail.min.js"></script>
        <script src="<?=base_url()?>template/front/vendor/lightgallery/js/lg-video.js"></script>
        <!-- App JS -->
        <script src="<?=base_url()?>template/front/js/wpx.app.js"></script>
        <script src="<?=base_url()?>template/front/js/jquery.inputmask.bundle.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.top_bar_right').load('<?php echo base_url(); ?>home/top_bar_right');
                $('.phone_mask').inputmask({
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
    </body>
</html>