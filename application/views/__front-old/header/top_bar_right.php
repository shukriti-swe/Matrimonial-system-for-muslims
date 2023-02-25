<?php
												if (!empty($this->session->userdata['member_id'])) {
													if($this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->row()->is_closed == 'yes'){ ?>
														<li class="dropdown dropdown--style-2 dropdown--animated float-left">
															<span class="badge badge-md badge-pill bg-danger" style="margin-top: 6px;">Account Closed</span>
														</li>
													<?php 
													}
												} 
											?>
											<?php
											if (!empty($this->session->userdata['member_id'])) {
												$noti_counter = 0;
												$msg_counter = 0;
												$notifications = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'notifications');
												$notification = json_decode($notifications, true);
												sort_array_of_array($notification, 'time', SORT_DESC);
											}
											
											if (!empty($this->session->userdata['member_id'])) {
											?>
												<!--Removed code from here-->
								                   
								                   <li class="dropdown dropdown--style-2 dropdown--animated float-left" style="padding: 4px 0 8px 0;">
                                                    <a href="<?= base_url() ?>home/profile" class="btn btn-styled btn-xs btn-base-1 btn-shadow">
                                                        <i class="fa fa-user"></i>
                                                                    <?php echo translate('my_profile') ?>
                                                                             </a>
								                    <!--Removed code from here-->
											<?php	
											}
											else {
											?>
													
											<?php
											}
											?>						                    
							                    <!--<li class="float-left pb-1">-->
												<?php
												if (!empty($this->session->userdata['member_id'])) {
												?>
							                    	<a href="<?=base_url()?>home/logout" class="btn btn-styled btn-xs btn-base-1 btn-shadow"><i class="fa fa-power-off"></i> <?php echo translate('log_out')?></a>
												<?php	
												}
												else{
												?>	
		                                            <a href="<?=base_url()?>home/login" class="btn btn-styled btn-xs btn-base-1 btn-shadow"><i class="fa fa-power-off"></i> <?php echo translate('log_in')?></a>
		                                            <a href="<?=base_url()?>home/registration" class="btn btn-styled btn-xs btn-base-1 btn-shadow"><i class="fa fa-user"></i> <?php echo translate('register')?></a>
												<?php
												}
												?>
		                                        </li>

						                    <script>
											    $(document).ready(function(){
											        if (isloggedin != "") {
											            var noti_count = "<?php if (!empty($noti_counter)){echo $noti_counter;}?>";
											            if (noti_count > 0) {
											                $('.noti_counter').show();
											                $('.noti_counter').html(noti_count);
											            }
											            var msg_count = "<?php if (!empty($msg_counter)){echo $msg_counter;}?>";
											            if (msg_count > 0) {
											                $('.msg_counter').show();
											                $('.msg_counter').html(msg_count);
											            }
											        }

											        $(".noti_click").click(function(){
											            var member_id = "<?=$this->session->userdata('member_id')?>";
											            if (member_id != "") {
											                $.ajax({
											                    type: "POST",
											                    url: "<?=base_url()?>home/refresh_notification/"+member_id,
											                    cache: false,
											                    success: function(response) {
											                        $('.noti_counter').hide();
											                        // $('#test').html(response);
											                    }
											                });
											            }
											        });

											    });

                                                function openChat() {
                                                    <?php $listed_messaging_members = $this->Crud_model->get_listed_messaging_members($this->session->userdata('member_id'));?>
                                                    var php_var = "<?php echo $listed_messaging_members[0]['member_id']; ?>";
                                                    window.location.href = "<?=base_url()?>home/chat/"+php_var;

                                                }
											</script>