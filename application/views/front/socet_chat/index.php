<?php
$urlId = $this->uri->segment('3');
$member_id = $_SESSION['member_id'];
$member = $this->db->where('member_id',$member_id)->get('member')->row();
//$image = 'a.jpg';
$image = $member->profile_image;
$isApproved=$member->is_profile_img_approved;
//echo "<pre>".$isApproved;
//echo "<pre>"; print_r($member);die();

?>
<style>
	.profile-stats{
		position:relative;
	}
	.profile-stats ul.send_chat_list{
		width:100%;
		max-height:240px;
		overflow-y:auto;
	}
	.send_chat_list li{
		display: flex;
		padding: 5px;
		align-items: center;
		border-bottom: 1px solid #f0f0f0;
	}
	.send_chat_list li .send_chat_list_img img{
		height: 32px;
		width: 32px;
		border-radius: 50%;
	}
	.send_chat_list li .fa-trash{
	    cursor: pointer;
	}
	.send_chat_list li a{
		display: flex; 
		margin: 0 !important;
		padding: 3px !important;
		margin-right: 5px !important;
	}
	.send_chat_list .send_chat_list_content{
	text-align: left;
    margin-left: 5px;
	}
	.send_chat_list .send_chat_list_content p{
		margin: 0;
		color: #000;
		line-height: 12px;
		font-size: 12px;
	}
	.send_chat_list .send_chat_list_content span{
		font-size: 10px;
		line-height: 10px;
	}
	.profile_img {
    height: 170px;
    width: 170px;
	}
	.chat_box_m{
		border:1px solid #000;
		border-top:none;
	    padding-bottom: 60px;
	}
	.chat_box_m > .chat{
		height:505px !important
	}
	.rightSection .persons{
		height:566px !important;
	}
	.rs_right_h {
    background: #e91e63;
    text-align: center;
    padding: 21px 0px;
    font-size: 24px;
    font-weight: bold;
    border: 1px solid #000;
    color: #fff;
    border-bottom: 2px solid #d31b5a;
		height: 79px
}
	#groups{
	border:1px solid #000;
	border-top:0px; 
	padding-bottom: 14px;
	}
	.leftSection .rs_border{
		border:1px solid #000 !important;
		margin-bottom: 15px;
	}
    
    .persons{
    margin-left:0;
        margin-bottom:10px;
    }
    .persons .person{
    overflow:hidden;
    }
    .top-navbar-menu .btn i{
    left:0;
    }
    .top-navbar-menu .btn{
    text-transform: inherit;
    }
	/*.leftSection, .rightSection  {
		padding:0;
    height:auto !important;
    }
    .middleSection {
    height:auto !important;
    }*/
	
    #chatBox{
    margin:0;
    }
	.btn-white.chats_sents{
		display:flex;
		justify-content:center;
	}
    .twemoji-textarea{
    outline: none;
    border: 2px solid #000;
    }
	.group_not_show{
	display:none;
	}
	.chat_box_defults .chat_box_m{
		padding-bottom: 160px;
	}
	.chat_box_defults .chat_box_m > .chat{
		 height: 404px !important;
	}
	.chat_box_defults #showHide{
	    border: none !important; 
		margin-top: 0px !important;
	}
	
	
	
    @media only screen and (max-width: 767px) {
      .rightSection{
            padding-right: 15px !important;
        padding-left: 15px !important;
      }
    }
	@media only screen and (min-width: 992px) and (max-width: 1198px) {
		.chat_box_m > .chat{
			height:489px !important
		}
		body .rightSection .persons{
			height:550px !important;
		}
	}
    .sendMessage{
        color: #000;
        font-size: 12px;
        background: #b8eaea;
        border-radius: 25px;
        margin-top: 5px;
        margin-bottom: 3px;
        text-transform: capitalize !important;
    }
	.chats_sents{
		width: 100%;
		font-size: 15px;
		font-weight: bold;
		background: #fff;
		border: none;
		color: #000;
	}
	.profile-stats b{
	font-weight:bold !important
	}
	body .new_pic_profile{
		height: 70px;
    	width: 70px;
	}
	@media only screen and (min-width: 768px) and (max-width: 1199px) {
		.rs_right_h{
			font-size:18px
		}
	}
	.upgrade_message {
		display: block;
		font-size: 14px;
		color: #e91e63;
		padding: 2px 0px;
	}
</style>
<section class="slice sct-color-2" style="margin-bottom: 15px">
    <div class="profile">
        <div class="container">
            <div class="row">
             <div class="leftSection col-md-3" style="padding: 0;"> 
                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 text-center  person2 rightGroupImages" style="padding-top: 5px;display: flex;justify-content: center; display:none"   >
                    </div>
                    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 text-center pad-10" style="display:none" >
                        <h4 class="be-use-name" style="text-transform: uppercase; overflow: hidden; text-overflow: ellipsis ;display:none"></h4>
                    </div>
                    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 text-center pad-2" style="padding-bottom: 5px;display:none" >
                        <div class="preview be-user-info" style="font-size: 10px; padding-bottom:5px;border-bottom:1px solid rgba(0, 0, 0, .10) "></div>
                    </div>
                    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12  pad-5" style="cursor: pointer; display:none" id="addMember" data-group="">
                        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12 " style="padding-right: 0;"><i class="fa fa-plus" style="color: #388ded; margin-right:10px;padding: 16px; width: 45px;height: 45px; border-radius: 50px; border: 1px solid #388ded"></i><strong>Add new member</strong></div>
                    </div> 


<style>.lg-outer #lg-download {display: none!important;}</style>
<div class="sidebar rs_border sidebar-inverse sidebar--style-1 bg-base-1 z-depth-2-top">
    <div class="sidebar-object mb-0">
        <!-- Profile picture -->
        <div id="container">
        <div class="row">
            <div class="col-md-4" id="groupMembers_status">   
            </div>
            <div class="col-md-12">
                <div class="my_class" style="display:block;text-align:center;" id="groupMembers_name"></div>
            </div>
            <div class="profile-picture profile-picture--style-2" id="dp">
                    <div style="border: 5px solid rgba(255, 255, 255, 0.1);width:180px;border-radius: 50%;margin:auto; margin-top: 10px;">
                        <div  class='profile_img' id="groupMembers_" ></div>
                    </div>
            </div>
        </div>
        <div class="profile-stats clearfix mt-2">
            <div class="stats-entry que" style="width: 40%;">
                <span class="stats-label text-uppercase text-left pl-2"><b><?php echo translate('age');?></b></span>
                <span class="stats-label text-uppercase text-left pl-2"><b>PROFESSION</b></span>
                <span class="stats-label text-uppercase text-left pl-2"><b>RESIDENCE</b></span>
                <span class="stats-label text-uppercase text-left pl-2"><b>SECT</b></span>
            </div>
            <div class="stats-entry ans" id="groupMembers_details" style="width: 60%;margin-left: -5px;">

            </div>
        </div>
        </div>
    </div>
</div>
<style>.lg-outer #lg-download {display: none!important;}</style>
<div class="sidebar rs_border sidebar-inverse sidebar--style-1 bg-base-1 z-depth-2-top" style="margin-top:5px;">
    <div class="sidebar-object mb-0">
        <!-- Profile picture -->
        <div id="container">
        <div class="row">
            <div class="col-md-4" id="groupMembers_status">   
            </div>
            <div class="col-md-12">
                <div class="my_class" style="display:block;text-align:center;" id="groupMembers_name"></div>
            </div>
            <div class="profile-picture profile-picture--style-2" id="dp">
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 90px;border-radius: 50%;margin: auto;">
						<?php			 
						if($isApproved == 1){
						?>
                        <div  class='profile_img sssss new_pic_profile' id="groupMembers_" style="background-image: url(<?= base_url() ?>uploads/profile_image/<?= $member_id."/" .$image.'?'.rand(999,99999999) ?>)"></div>
						<?php
							}else{
							?>
						<div  class='profile_img sssss new_pic_profile' id="groupMembers_" style="background-image: url(<?= base_url() ?>uploads/profile_image/default.jpg)"></div>
						<?php }
						?>
                    </div>
            </div>
        </div>
        <div class="profile-stats clearfix mt-2 mb-2">
			 
			<a href="#" class="btn btn-styled btn-sm btn-white chats_sents" id="chats_sents_id_" data-toggle="dropdown" aria-expanded="false">CHATS SENT &nbsp; &nbsp;<i class="fa fa-sort-down"></i></a>
			<ul class="dropdown-menu send_chat_list" id="message_append">
                <?php
	                           $member_id = $this->session->userdata['member_id'];
							  //echo $member_id;
							 $all_sent_messages = $this->db->where('sender',$member_id)->group_by('receiver')->get('im_message');
							 
							 $results=$all_sent_messages->result();
							//if(!empty($results)){
							// echo "<pre>";print_r($results);
							 $i=0;
							 foreach($results as $messages_part){
								 
								 $find_member_id=$this->db->where('g_id',$messages_part->receiver)->where('u_id !=',$messages_part->sender)->get('im_group_members');
							$results2=$find_member_id->result();
								 foreach($results2 as $find_id){
								 $member_details_all= $this->db->where('member_id',$find_id->u_id)->get('member');
								$results3=$member_details_all->result();
								 foreach($results3 as $member_details){
				?>
								 <li>
					<a href="#" class="dropdown-item">
						
						
						<div class="send_chat_list_img">
							<img src="http://wd.rssoft.win/matchmade/uploads/profile_image/<?php echo $member_details->member_id;?>/<?php echo $member_details->profile_image;  ?>">
						</div>
						
						<div class="send_chat_list_content">
							<p><?php echo $member_details->display_member;  ?></p>
							<span>
								
							</span>
						</div>
					</a>
									 <input type="hidden" name="" class="sender_ids<?php echo $i;?>" value="<?php echo $messages_part->sender;?>">
					  <a class="delete_sent" href="#" data-index="<?php echo $i;?>" data-val="<?php echo $messages_part->receiver;?>"><i class="fa fa-trash text-danger"></i></a>
				</li>
							<?php  $i++;}}}
							// }
								?>
						
			
			</ul>
			<small>All chats are deleted after 10 days.</small>
			<!--<button class="btn btn-success btn-sm" id="delete_message">Delete Now</button> -->
        </div>
        </div>
    </div>
</div>
            </div>

            <div class="middleSection col-md-6" style="border:none">
                  <?php 
                        $member_id = $this->session->userdata['member_id'];
                        $member = $this->db->where('member_id',$member_id)->get('member')->row();
                        $membership = $member->membership;
                    ?>
					<div class="rs_right_h"> 
                            <span class="UserNames"  style="font-size: 24px;color:#fff;font-weight: bold;padding: 0"></span> 
					</div>
				<?php if ($membership == 1){ ?>
				<div class="chat_box_defults">
				<?php } ?>
					<div class="chat_box_m">
                    <div class="chat" style="overflow: scroll;overflow-x: hidden; width:100%;" id="chatBox" ></div>

                  
                    <form id="messageForm">
                         <div class="form-group col-md-10 col-xl-10 col-sm-8 col-xs-8 col-9" style="padding-top: 5px;padding-right: 5px" >
                            
                            <?php if ($membership == 1){ ?>
                                <div style="max-height: 50px;width: 100%;display: none">
                                <textarea style="max-height: 50px;width: 100%;display: none"  id="message" type="text" name="message" class="form-control" placeholder="Your message....."></textarea>
                                </div>
                               <div style="border: 2px solid #000;padding: 5px;border-radius: 4px; margin-top:70px" id="showHide">
                                   <button class="btn btn-small sendMessage" id="" type="button" value="1">ASA,can we get to know one another?</button>
                                   <button class="btn btn-small sendMessage" id="" type="button" value="2">ASA,would you be interested in viewing my profile?</button>
                                   <button class="btn btn-small sendMessage" id="" type="button" value="3">Your profile looks Great! May we Connect?</button>
								   <span  class="upgrade_message">UPGRADE to unlimited messages with Platinum!</span>
                               </div>
                            <?php }else{ ?>
                                <textarea style="max-height: 50px;width: 100%"  id="message" type="text" name="message" class="form-control" placeholder="Type Here....."></textarea>
                            <?php } ?>
                               
                        </div>
                        <div class="form-group col-md-2 col-xl-2 col-sm-3 col-xs-4 col-3 pad-1" style="margin-top: 10px"> 
                            <input type="file" class="hidden" id="messageFile1" name="documents" accept="application/pdf,application/msword,application/vnd.ms-excel,application/vnd.ms-powerpoint,text/csv,text/plain,application/zip,application/x-zip-compressed,audio/mp3,audio/x-ms-wma">
                            <input type="file" class="hidden" id="messageFile" name="pictureVideo" accept="video/3gpp,video/mp4,video/3gp,image/x-png,image/jpeg">
                           
                            <?php if ($membership != 1): ?>
                                
                                <button class="btn btn-small" style="background:#e91e63;color: #fff" id="sendMessage" type="button">Send</button>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
				<?php if ($membership == 1){ ?>
				</div>
				<?php } ?>
            </div>
         <?php 
	if(isset($get_member->member_id)){
				  $view_profiler_id2=$get_member->member_id; ?> 
			<input type="hidden" id="select_profiler_id2" name="profiler_id2" value="<?php echo $view_profiler_id2;?>">
			<?php 	}?>
           
				
            <div class="rightSection  col-md-3" style=" ">
				<div style="">
				
				</div>
					 <div class="rs_right_h"> 
						 <span class="" style="padding: 0;"><i class="fa fa-users" style="color: #fff;margin-right: 5px" ></i></span>
						 CHATS RECEIVED
					</div>  
                    <div style=" width: 100%"  id="groupDiv">
                        <ul class="persons" id="groups" > 
                        </ul>
                    </div>
                    
                    
                </div> 
        </div>
        </div>
    </div>
</section>
<!-- Modals -->
<div id="addNewMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>
                <h4 class="modal-title myUpdateModalLabel" style="background-color: #75aef3">Add new member </h4>

                <div class="modal-body" >
                    <p><strong>Search members by there name</strong></p>
                    <div class="form-group">
                        <input type="text" id="addNewMemberInput" multiple class="form-control" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-small btn-round btn-skin-green"  data-toggle="modal" id="newMemberAddBtn">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="changeNameModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>
                <h4 class="modal-title myUpdateModalLabel" style="background-color: #75aef3">Change name </h4>
                <div class="modal-body" >
                    <p><strong>Give a new name</strong></p>
                    <div class="form-group">
                        <input type="text" id="groupName" class="form-control" placeholder="Group Name" required="required">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-small btn-round btn-skin-green"  data-toggle="modal" id="changeNameBtn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="newMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 6px;">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>
                <h4 id="myModalLabel" class="modal-title" style="background-color: #75aef3">Start a new conversation</h4>
                <div class="modal-body " id="newMModalBody" style="margin-bottom: 110px">
                    <form id="newMessageForm" role="form">
                        <div class="form-group m-bottom-20">
                            <input type="text" id="addMemberInput" multiple class="form-control" >
                        </div>
                        <div class="form-group col-md-12 col-xl-12 col-sm-12 col-xs-12 m-bottom-20" style="padding-top: 5px;padding-right: 5px; height: 90px" >
                            <textarea style="max-height: 100px; height: 90px border: 0"  id="newMessageText" type="text" name="message" class="form-control" placeholder="Your message....."></textarea>
                        </div>
                        <!--<div class="form-group col-md-2 col-xl-2 col-sm-2 col-xs-2 pad-1 m-bottom-20 " style="margin-top: 10px;">
                            <img src="<?php /*echo base_url('template/front/assets/img/i-camera.png')*/?>" id="newMessagefileIV"  style="float:left;cursor: pointer; width: 50px;height: 50px">
                            <input type="file" class="hidden" id="newMessageFile" name="file" accept="video/3gpp,video/mp4,video/3gp,image/x-png,image/jpeg">
                        </div>-->

                    </form>
                </div>
                <div class="modal-footer" style="background-color: white;">
                    <div class="form-group col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <a href="#" class="btn-primary btn-small btn-rounded btn-skin-green col-md-12 col-xl-12 col-sm-12 col-xs-12" id="newSendMessage"><i class="fa fa-envelope"></i>  Send</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="connectionErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" class="modal fade in" style="display: none;padding-right: 17px;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 6px;">
                <!--<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="oli oli-delete_sign"></i></span></button>-->
                <h4 id="myModalLabel" class="modal-title" style="background-color: #bc0200">Connection lost</h4>
                <div class="modal-body " >
                    <p>Connecting...</p>
                </div>
                <!--<div class="modal-footer" style="background-color: white;">
                    <div class="form-group col-md-12 col-xl-12 col-sm-12 col-xs-12">
                        <a href="#" class="btn-primary btn-small btn-rounded btn-skin-green col-md-12 col-xl-12 col-sm-12 col-xs-12" id="newSendMessage"><i class="fa fa-envelope"></i>  Send</a>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>

<script>
	 $(document).ready(function(){
		 $("body").delegate(".delete_sent", "click", function(e){
		  		e.preventDefault();
			   var id=$(this).attr('data-index');
			   var reciver_id=$(this).attr('data-val');
			   var sender_id=$('.sender_ids'+id).val();
			   $(this).parent().remove();
			  
	 	  $.ajax({
      url:"<?php echo base_url(); ?>home/delete_message_sent",
      method:"POST",
      data:{reciver_id:reciver_id,sender_id:sender_id},
      dataType:'JSON',
      success:function(data)
      {

		  

    }
			   
    }); 
		   });
  
		});

</script>
<script>
    $(document).ready(function(){
        setInterval(function() {
        var member = $("#statusChange").val();
        console.log(member);
            $.ajax({
                url: "<?php echo base_url()?>home/checkOnlinStatus/" + member,
                success: function(result){
                    var html_status = '';
                    if(result==1){
                        html_status += "<span style='float:left' class='online'> Online </span>";
                    }else {
                        html_status += "<span style='float:left;color:#e91e63' class='offline'>Offline</span>";
                    }
                    html_status += "<input type='hidden' name='statusChange' id='statusChange' value='"+member+"'>";
                    $('#groupMembers_status').html(html_status);
                }
            });
        }, 15000);


        $('.sendMessage').click(function(){
            var value = $(this).val();
            if (value == 1) {
                $('#message').text('ASA,can we get to know one another?');
            }else if(value == 2){
                $('#message').text('ASA,would you be interested in viewing my profile?');
            }else if(value == 3){
                $('#message').text('Your profile looks greate! May we contact?');

            }else{
                $('#message').val('');
            }
        })
		
	 $(document).ready(function(){	
        $('#delete_message').click(function(){
             $.ajax({
                url: "<?php echo base_url()?>home/delete_message/" + <?= $member_id; ?>,
                success: function(result){
                    location.reload();
                }
            });
        })
		
		
    });
	 });
	
	

	


</script>
