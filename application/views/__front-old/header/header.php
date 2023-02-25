<!-- MAIN WRAPPER -->
<div class="body-wrap">
    <div id="st-container" class="st-container">
        <div class="st-pusher">
            <div class="st-content">
                <div class="st-content-inner">
					<!-- Navbar -->
					<div id="myHeader">
						<div class="top-navbar align-items-center" style="border-bottom: 2px solid #db4c7f !important;">
						    <div class="container">
						        <div class="row align-items-center py-1" style="">
						            <div class="col-lg-4 col-md-5 col">
	                                    <nav class="top-navbar-menu" style="margin:0px !important;" hidden>
	                                        <ul class="top-menu" style="float: left !important;width: 40%;">
	                                            <li class="aux-languages dropdown">
		                                            <a class="pt-0 pb-0">
		                                            	<?php
						                                    if ($set_lang = $this->session->userdata('language')) {

						                                    } else {
						                                        $set_lang = $this->db->get_where('general_settings', array('type' => 'language'))->row()->value;
						                                    }
						                                    $lid = $this->db->get_where('site_language_list', array('db_field' => $set_lang))->row()->site_language_list_id;
						                                    $lnm = $this->db->get_where('site_language_list', array('db_field' => $set_lang))->row()->name;
						                                ?>
		                                            	<img src="<?=base_url()?>uploads/language_list_image/language_<?=$lid?>.jpg" style="width: 20px;margin-top: -2px">
		                                            	<span><?=$lnm?></span>
		                                            </a>
	                                                <ul id="auxLanguages" class="sub-menu">
	                                                	<?php
						                                    $langs = $this->db->get_where('site_language_list', array('status' => 'ok'))->result_array();
						                                    foreach ($langs as $row) {
						                                ?>
						                                    <li <?php if ($set_lang == $row['db_field']) { ?>class="active"<?php } ?> >
						                                        <a class="set_langs" data-href="<?php echo base_url(); ?>home/set_language/<?php echo $row['db_field']; ?>">
						                                            <img src="<?=base_url()?>uploads/language_list_image/language_<?=$row['site_language_list_id']?>.jpg" width="20px">
			                                                    	<span class="language"><?=$row['name']?></span>
						                                            <?php if ($set_lang == $row['db_field']) { ?>
						                                                <i class="fa fa-check"></i>
						                                            <?php } ?>
						                                        </a>
						                                    </li>
						                                <?php
						                                    }
						                                ?>
	                                                </ul>
	                                            </li>
	                                        </ul>
	                                        <ul class="top-menu" style="float: left !important;width: 60%;">
	                                            <li class="aux-languages dropdown">
		                                            <a class="pt-0 pb-0">
		                                            	<?php
								                            if($currency_id = $this->session->userdata('currency')){} else {
								                                $currency_id = $this->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
								                            }
								                            $symbol = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->symbol;
								                            $c_name = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->name;
								                        ?>
								                        <span><?=$c_name.' ('.$symbol.')'?></span>
		                                            </a>
	                                                <ul id="auxLanguages" class="sub-menu">
	                                                	<?php
								                            $currencies = $this->db->get_where('currency_settings',array('status'=>'ok'))->result_array();
								                            foreach ($currencies as $row)
								                            {
								                        ?>
								                            <li <?php if($currency_id == $row['currency_settings_id']){ ?>class="active"<?php } ?> >
								                                <a class="set_langs" data-href="<?php echo base_url(); ?>home/set_currency/<?php echo $row['currency_settings_id']; ?>">
								                                    <?php echo $row['name']; ?> (<?php echo $row['symbol']; ?>)
								                                    <?php if($currency_id == $row['currency_settings_id']){ ?>
								                                        <i class="fa fa-check"></i>
								                                    <?php } ?>
								                                </a>
								                            </li>
								                        <?php
								                            }
								                        ?>
	                                                </ul>
	                                            </li>
	                                        </ul>
	                                    </nav>
									</div>
						            <div class="col-lg-8 col-md-7 col" style="margin-bottom: 5px;">
						                <nav class="top-navbar-menu">
							                <ul class="float-right top_bar_right">

							                </ul>
						                </nav>
						            </div>
						        </div>
						    </div>
						</div>
						<nav class="navbar navbar-expand-lg navbar-light bg-default navbar--link-arrow navbar--uppercase">
						    <div class="container navbar-container">
						        <!-- Brand/Logo -->
						        <a class="navbar-brand" href="<?=base_url()?>home/">
						        	<?php
						        		$header_logo_info = $this->db->get_where('frontend_settings', array('type' => 'header_logo'))->row()->value;
	                                    $header_logo = json_decode($header_logo_info, true);
	                                    if (file_exists('uploads/header_logo/'.$header_logo[0]['image'])) {
	                                    ?>
	                                        <img src="<?=base_url()?>uploads/header_logo/<?=$header_logo[0]['image']?>" class="img-responsive" height="100%">
	                                    <?php
	                                    }
	                                    else {
	                                    ?>
	                                        <img src="<?=base_url()?>uploads/header_logo/default_image.png" class="img-responsive" height="100%">
	                                    <?php
	                                    }
	                                ?>
						        </a>
						        <div class="d-inline-block">
						            <!-- Navbar toggler  -->
						            <button class="navbar-toggler hamburger hamburger-js hamburger--spring" type="button" data-toggle="collapse" data-target="#navbar_main" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
						            <span class="hamburger-box">
						            <span class="hamburger-inner"></span>
						            </span>
						            </button>
						        </div>
						        <div class="collapse navbar-collapse align-items-center justify-content-end" id="navbar_main">
						            <!-- Navbar links -->
									<ul class="navbar-nav" data-hover="dropdown">
						                <li class="custom-nav">
						                <a class="nav-link <?php if($page == 'home'){?>nav_active<?php }?>" href="<?=base_url()?>home" aria-haspopup="true" aria-expanded="false">
										<i class="ionicons ion-ios-home-outline" style="display: block;text-align: center;font-size: 25px;"></i>
						                <?php echo translate('home')?></a>
						                </li>
						                <li class="custom-nav ">
						                <a class="nav-link <?php if($page == 'listing' || $page == 'member_profile'){?>nav_active<?php }?>" href="<?=base_url()?>home/listing/" aria-haspopup="true" aria-expanded="false">
										<i class="ionicons ion-ios-search" style="display: block;text-align: center;font-size: 25px;"></i>
						                <?php echo translate('Search')?></a>						               
						                </li>
						                <li class="custom-nav dropdown">
						                <a class="nav-link <?php if($page == 'plans' || $page == 'subscribe'){?>nav_active<?php }?>" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="ionicons ion-ios-cog-outline" style="display: block;text-align: center;font-size: 25px;"></i>
						                <?php echo translate('Services')?></a>
										 <ul class="dropdown-menu" style="border: 1px solid #f1f1f1 !important;">
						                    <li class="dropdown dropdown-submenu">
						                    <li>
						                    <a class="dropdown-item" href="<?=base_url()?>home/about_us">
						                    About Us</a><li>
						                    <a class="dropdown-item" href="<?=base_url()?>home/safety_tips">
						                    Safety Tips</a>
						                    </li>
						                    <li>
						                    <a class="dropdown-item" href="<?=base_url()?>home/warning">
						                    Warning and Suspensions</a>
						                    </li>
						                    <li>
						                    <a class="dropdown-item" href="<?=base_url()?>home/honesty">
						                    Honesty Is The Best Policy</a>
						                    </li>
						                    <li>
						                    <a class="dropdown-item" href="<?=base_url()?>home/faq">
						                    Helpful Questions</a>
						                    </li>
						                    <li>
						                    <a class="dropdown-item" href="<?=base_url()?>home/effective_communication">
						                    Effective Commuication</a>
						                    </li>
						                    
									</ul>
						                </li>
						                
						                                                        <?php
if (!empty($this->session->userdata['member_id'])) {
    $noti_counter = 0;
    $msg_counter = 0;
    $notifications = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'notifications');
    $notification = json_decode($notifications, true);
    sort_array_of_array($notification, 'time', SORT_DESC);
}
?>
						                
						                <li class="custom-nav">
						                <a class="nav-link <?php if($page == 'contact_us'){?>nav_active<?php }?>" href="<?=base_url()?>home/contact_us" aria-haspopup="true" aria-expanded="false">
										<i class="ionicons ion-android-call" style="display: block;text-align: center;font-size: 25px;"></i>
						                <?php echo translate('contact_us')?></a>
						                </li>
						                    </li>
                                        <?php  if (!empty($this->session->userdata['member_id'])) { ?>

                                        <li class="custom-nav dropdown dropdown--style-2 dropdown--animated">
                                            <a class="dropdown-icon dropdown-toggle has-notification" href="#" data-toggle=""
                                               aria-expanded="false">
                                                <i class=" fa fa-envelope-open-o" style="color: #E91E63; display: block;text-align: center;font-size: 20px;margin-top: 27.5px;"></i>
                                                <p style="color: #E91E63; font-size: 14px;">MESSAGES</p> </a>
                                            <?php include 'messages.php'; ?>
                                        </li>

                                        <?php } else { ?>
                                        <li class="">
                                            <a class="dropdown-icon dropdown-toggle" href="#" data-toggle=""
                                               aria-expanded="false">
                                                <i class=" fa fa-envelope-open-o" style="color: #E91E63; display: block;text-align: center;font-size: 20px;margin-top: 27.5px;"></i>
                                                <p style="color: #E91E63; font-size: 14px;">MESSAGES</p> </a>
                                        </li>
                                   <?php     } ?>
						                
						            </ul>
						        </div>
						    </div>
						</nav>
					</div>
					<div class="sticky-content">
						<?php
							$sticky_header = $this->db->get_where('frontend_settings', array('type' => 'sticky_header'))->row()->value;
							if ($sticky_header == 'yes') { ?>
							<script type="text/javascript">
								window.onscroll = function() {
								    scrollFunction();
								};
								var header = document.getElementById("myHeader");
								var sticky = header.offsetTop;

								function scrollFunction() {
								    if (window.pageYOffset > sticky) {
								        header.classList.add("sticky-header");
								    } else {
								        header.classList.remove("sticky-header");
								    }
								}
							</script>
						<?php } ?>
						<script type="text/javascript">
						    $(document).ready(function () {
						        $('.set_langs').on('click', function () {
						            var lang_url = $(this).data('href');
						            $.ajax({url: lang_url, success: function (result) {
						                    location.reload();
						                }});
						        });
						    });
						</script>
