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
											 
										</nav>
									</div>
									<div class="col-lg-8 col-md-7 col">
										<nav class="top-navbar-menu">
											<ul class="float-right top_bar_right">

											</ul>
										</nav>
									</div>
								</div>
							</div>
						</div>
						<nav class="navbar navbar-expand-lg navbar-light bg-default navbar--link-arrow navbar--uppercase">
							<ul style="list-style-type: none;padding: 0 10px;    margin-bottom: 30px;font-size: 25px;">
									<?php 
										 $social_media = $this->db->where('status','enable')->get('social_media_settings')->result();
									?>
									<?php foreach ($social_media as  $value) { ?>
							           <?php if ($value->title == 'facebook'): ?>
											<li style="display: inline;padding: 2px;"><a href="<?=$value->content?>" target="_blank"> <i class="fa fa-facebook-f"></i></a></li>
							           <?php endif ?>
							           <?php if ($value->title == 'instagram'): ?>
											<li style="display: inline;padding: 2px;"><a href="<?=$value->content?>"> <i class="fa fa-instagram"></i></a></li>
							           	
							           <?php endif ?>
							           <?php if ($value->title == 'twitter'): ?>
											<li style="display: inline;padding: 2px;"><a href="<?=$value->content?>"> <i class="fa fa-twitter"></i></a></li>
							           <?php endif ?>
							        <?php }?>
								</ul>
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
									<img src="<?=base_url()?>uploads/profile_image/default.jpg" class="img-responsive" height="100%">
									<?php
	                                    }
	                                ?>
								</a>
								<div class="d-inline-block">
									<!-- Navbar toggler  -->
									<button class="navbar-toggler hamburger hamburger-js hamburger--spring" type="button" data-toggle="collapse" data-target="#navbar_main"
										aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
										<span class="hamburger-box">
											<span class="hamburger-inner"></span>
										</span>
									</button>
								</div>
								<div class="collapse navbar-collapse align-items-center justify-content-end" id="navbar_main">
									<!-- Navbar links -->
									<ul class="navbar-nav" data-hover="dropdown">
										<li class="custom-nav">
											<a class="nav-link <?php if($page == 'home'){?>nav_active<?php }?>" href="<?=base_url()?>home" aria-haspopup="true"
												aria-expanded="false">
												<i class="ionicons ion-ios-home-outline" style="display: block;text-align: center;font-size: 25px;"></i>
												<?php echo translate('home')?></a>
										</li>
										<li class="custom-nav ">
											<a class="nav-link <?php if($page == 'listing' || $page == 'member_profile'){?>nav_active<?php }?>" href="<?=base_url()?>home/listing/"
												aria-haspopup="true" aria-expanded="false">
												<i class="ionicons ion-ios-search" style="display: block;text-align: center;font-size: 25px;"></i>
												<?php echo translate('Search')?></a>
										</li>
										<li class="custom-nav dropdown">
											<a class="nav-link <?php if($page == 'plans' || $page == 'subscribe'){?>nav_active<?php }?>" href="#" data-toggle="dropdown"
												aria-haspopup="true" aria-expanded="false">
												<i class="ionicons ion-ios-cog-outline" style="display: block;text-align: center;font-size: 25px;"></i>
												<?php echo translate('Services')?></a>
											<ul class="dropdown-menu" style="border: 1px solid #f1f1f1 !important;">
												<li class="dropdown dropdown-submenu">
												<li>
													<a class="dropdown-item" href="<?=base_url()?>home/about_us">
														About Us</a>
												<li>
													<a class="dropdown-item" href="<?=base_url()?>home/safety_tips">
														Safety Tips</a>
												</li>
												<li>
													<a class="dropdown-item" href="<?=base_url()?>home/warning">
														Warnings and Suspensions</a>
												</li>
												<li>
													<a class="dropdown-item" href="<?=base_url()?>home/honesty">
														Honesty Is The Best Policy</a>
												</li>
												<li>
													<a class="dropdown-item" href="<?=base_url()?>home/faq">
													Frequently Asked Questions</a>
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
											<a class="nav-link <?php if($page == 'contact_us'){?>nav_active<?php }?>" href="<?=base_url()?>home/contact_us" aria-haspopup="true"
												aria-expanded="false">
												<i class="ionicons ion-android-call" style="display: block;text-align: center;font-size: 25px;"></i>
												<?php echo translate('contact_us')?></a>
										</li>

										<?php
											$user_id = $this->session->userdata('member_id');
											$last_id_f = $this->db->where('from_id',$user_id)->where('to_id !=',$user_id)->order_by('igr_id','desc')->limit(1)->get('im_group_relation')->row();
										$last_id_t = $this->db->where('to_id',$user_id)->where('from_id !=',$user_id)->order_by('igr_id','desc')->limit(1)->get('im_group_relation')->row();
										if (isset($last_id_f) && !empty($last_id_f) ) {
											$r = $last_id_f->to_id;
										}else if(isset($last_id_t) && !empty($last_id_t)){

											$r = $last_id_t->from_id;
										}
										 if (!empty($user_id)) { ?>
										<li class="custom-nav dropdown dropdown--style-2 dropdown--animated">
											<a class="dropdown-icon dropdown-toggle has-notification" href="<?=base_url()?>home/chat/" data-toggle=""
												aria-expanded="false">
												<span class="badge badge-success" id="countMsId" style="width: 25px;height: 25px;border-radius: 50%;top: 10px;padding-top: 5px;display:none"></span>
												<i class=" fa fa-envelope-open-o" style="color: #E91E63; display: block;text-align: center;font-size: 20px;margin-top: 27.5px;"></i>
												<p style="color: #E91E63; font-size: 14px;">MESSAGES</p>
											</a>
											<?php //include 'messages.php'; ?>
										</li>


										<?php } else { ?>
										<!-- <li class="custom-nav g-pos-rev">
											<a href="#">
												<i class=" fa fa-envelope-open-o" style="color: #E91E63; display: block;text-align: center;font-size: 20px;margin-top: 27.5px;"></i>
												<p style="color: #E91E63; font-size: 14px;">MESSAGES</p>
											</a>
										</li> -->
										<?php } ?>

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
						<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function() {
				$.ajax({
					url: "<?php echo base_url()?>home/countmessage",
					success: function(result){
						if (result > 0) {
							$('#countMsId').show();
							$('#countMsId').html(result);
						}else{
							$('#countMsId').hide();
						}
					}
				});
			}, 5000);
		})
	</script>