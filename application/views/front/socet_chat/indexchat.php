<?php
$urlId = $this->uri->segment('3');
$member_id = $_SESSION['member_id'];
$member = $this->db->where('member_id',$member_id)->get('member')->row();
$image = 'a.jpg';
//echo "<pre>"; print_r($member);die();

?>
<style>
	.btn-white.chats_sents{
		display:flex;
		justify-content:center;
	}
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
    .leftSection, .rightSection  {
    height:auto !important;
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
    .middleSection {
    height:auto !important;
    }
    #chatBox{
    margin:0;
    }
    .twemoji-textarea{
    outline: none;
    border: 2px solid #000;
    }
    @media only screen and (max-width: 767px) {
      .rightSection{
            padding-right: 15px !important;
        padding-left: 15px !important;
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
</style>
<section class="slice sct-color-2" style="margin-bottom: 15px">
    <div class="profile">
        <div class="container">
            <div class="row">
             <div class="leftSection col-md-3" style="padding: 0;">
                <!-- <div class="chat-search col-md-12" id="convStart"  style="cursor: pointer;">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" id="newMessage">
                       <div class="col-md-12" style="padding: 0;font-size: 18px;font-weight: bold"><span class="" style="padding: 0;sty"><i class="fa fa-edit fa-large" style="color: #388ded" ></i></span>  Start a conversation </div>
                    </div>
                </div>
                <div style="float:left; width: 100%"  id="groupDiv">
                    <ul class="persons" id="groups" >

                    </ul>
                </div> -->
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
                        <!-- <ul class="persons personsList" id="groupMembers" ></ul> -->


<style>.lg-outer #lg-download {display: none!important;}</style>
<div class="sidebar sidebar-inverse sidebar--style-1 bg-base-1 z-depth-2-top">
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
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 10px;">
                        <div  class='profile_img' id="groupMembers_"></div>
                    </div>
            </div>
        </div>
        <div class="profile-stats clearfix mt-2">
            <div class="stats-entry que" style="width: 40%;">
                <span class="stats-label text-uppercase text-left pl-2"><?php echo translate('age');?></span>
                <span class="stats-label text-uppercase text-left pl-2">PROFESSION</span>
                <span class="stats-label text-uppercase text-left pl-2">RESIDENCE</span>
                <span class="stats-label text-uppercase text-left pl-2">SECT</span>
            </div>
            <div class="stats-entry ans" id="groupMembers_details" style="width: 60%;margin-left: -5px;">

            </div>
        </div>
        </div>
    </div>
</div>
<style>.lg-outer #lg-download {display: none!important;}</style>
<div class="sidebar sidebar-inverse sidebar--style-1 bg-base-1 z-depth-2-top" style="margin-top:5px;">
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
                    <div style="border: 10px solid rgba(255, 255, 255, 0.1);width: 200px;border-radius: 50%;margin-top: 10px;">
                        <div  class='profile_img' id="groupMembers_" style="background-image: url(<?= base_url() ?>uploads/profile_image/<?= $member_id . "/" .$image.'?'.rand(999,99999999) ?>)"></div>
                    </div>
            </div>
        </div>
        <div class="profile-stats clearfix mt-2">
			<a href="#" class="btn btn-styled btn-sm btn-white chats_sents" id="chats_sents_id_" data-toggle="dropdown" aria-expanded="false">CHATS SENT &nbsp; &nbsp;<i class="fa fa-sort-down"></i></a>
			<ul class="dropdown-menu send_chat_list">
                 <li>
					<a href="#" class="dropdown-item">
						<div class="send_chat_list_img">
							<img src="http://wd.rssoft.win/matchmade/uploads/profile_image/428/a.jpg">
						</div>
						<div class="send_chat_list_content">
							<p>Hi test</p>
							<span>Today,12:30 PM</span>
						</div>
					</a>
					 <i class="fa fa-trash text-danger"></i>
				</li>
				<li>
					<a href="#" class="dropdown-item">
						<div class="send_chat_list_img">
							<img src="http://wd.rssoft.win/matchmade/uploads/profile_image/428/a.jpg">
						</div>
						<div class="send_chat_list_content">
							<p>Hi test 2</p>
							<span>August,15,2021 12:30 PM</span>
						</div>
					</a>
					 <i class="fa fa-trash text-danger"></i>
				</li>
				<li>
					<a href="#" class="dropdown-item">
						<div class="send_chat_list_img">
							<img src="http://wd.rssoft.win/matchmade/uploads/profile_image/428/a.jpg">
						</div>
						<div class="send_chat_list_content">
							<p>Hi test 3</p>
							<span>August,15,2021 12:30 PM</span>
						</div>
					</a>
					 <i class="fa fa-trash text-danger"></i>
				</li>
				<li>
					<a href="#" class="dropdown-item">
						<div class="send_chat_list_img">
							<img src="http://wd.rssoft.win/matchmade/uploads/profile_image/428/a.jpg">
						</div>
						<div class="send_chat_list_content">
							<p>Hi test 4</p>
							<span>August,15,2021 12:30 PM</span>
						</div>
					</a>
					 <i class="fa fa-trash text-danger"></i>
				</li>
				<li>
					<a href="#" class="dropdown-item">
						<div class="send_chat_list_img">
							<img src="http://wd.rssoft.win/matchmade/uploads/profile_image/428/a.jpg">
						</div>
						<div class="send_chat_list_content">
							<p>Hi test 5000</p>
							<span>August,15,2021 12:30 PM</span>
						</div>
					</a>
					 <i class="fa fa-trash text-danger"></i>
				</li>
			</ul>
        </div>
        </div>
    </div>
</div>
            </div>

            <div class="middleSection col-md-6" style="border:none">
                <div style="border: 1px solid black; overflow:hidden">
                    <div class="chat-search col-md-12 groupNameDiv" style="text-align: center;background:#e91e63;">
                        <div style="margin-top: 5px;margin-bottom: 5px;">
                            <span class="UserNames"  style="font-size: 24px;color:#fff;font-weight: bold;padding: 0"></span>
                        </div>
                   
                       <!-- <div id="editGroupName" class="col-md-2 col-xl-2 col-sm-2 col-xs-2" style="text-align: right;cursor: pointer;color: #1abc9c">
                           <i class="fa fa-pencil"></i>
                       </div> -->
                   </div>

                    <div class="chat col-md-12 col-xl-12 col-sm-12 col-xs-12 " style="overflow: scroll;overflow-x: hidden;" id="chatBox" ></div>

                    <?php 
                        $member_id = $this->session->userdata['member_id'];
                        $member = $this->db->where('member_id',$member_id)->get('member')->row();
                        $membership = $member->membership;
                    ?>
                    <form id="messageForm">
                         <div class="form-group col-md-10 col-xl-10 col-sm-8 col-xs-8 col-9" style="padding-top: 5px;padding-right: 5px" >
                            
                            <?php if ($membership == 1){ ?>
                                <div style="max-height: 50px;width: 100%;display: none">
                                <textarea style="max-height: 50px;width: 100%;display: none"  id="message" type="text" name="message" class="form-control" placeholder="Your message....."></textarea>
                                </div>
                               <div style="border: 2px solid #000;padding: 5px;border-radius: 4px;" id="showHide">
                                   <button class="btn btn-small sendMessage" id="" type="button" value="1">ASA,can we get to know one another?</button>
                                   <button class="btn btn-small sendMessage" id="" type="button" value="2">ASA,would you be interested in viewing my profile?</button>
                                   <button class="btn btn-small sendMessage" id="" type="button" value="3">Your profile looks greate! May we contact?</button>
                               </div>
                            <?php }else{ ?>
                                <textarea style="max-height: 50px;width: 100%"  id="message" type="text" name="message" class="form-control" placeholder="Type Here....."></textarea>
                            <?php } ?>
                               
                        </div>
                        <div class="form-group col-md-2 col-xl-2 col-sm-3 col-xs-4 col-3 pad-1" style="margin-top: 10px">
                            <!-- <img title="Send File" src="<?php echo base_url('template/front/assets/img/fileAttach.png')?>" id="fileIV1" style="float:left;cursor: pointer; width: 25px;height: 22px;margin-left: 0px;"> -->
                            <!-- <img title="Send Picture/Video" src="<?php echo base_url('template/front/assets/img/cam.png')?>" id="fileIV" style="float:left;cursor: pointer; width: 25px;height: 25px;margin-left: 10px;"> -->
                            <input type="file" class="hidden" id="messageFile1" name="documents" accept="application/pdf,application/msword,application/vnd.ms-excel,application/vnd.ms-powerpoint,text/csv,text/plain,application/zip,application/x-zip-compressed,audio/mp3,audio/x-ms-wma">
                            <input type="file" class="hidden" id="messageFile" name="pictureVideo" accept="video/3gpp,video/mp4,video/3gp,image/x-png,image/jpeg">
                            <!--<i id="sendMessage" class="fa fa-send fa-2x pad-5" style="color: #82d6d5;cursor: pointer; margin-left: 10px;width: 25px;height: 25px"></i>-->
                            <!-- <img title="Send Message" src="<?php echo base_url('template/front/assets/img/pp.png')?>" id="sendMessage" style="cursor: pointer; margin-left: 10px;width: 25px;height: 25px"> -->
                            <?php if ($membership != 1): ?>
                                
                                <button class="btn btn-small" style="background:#e91e63;color: #fff" id="sendMessage" type="button">Send</button>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>


            <div class="rightSection  col-md-3 persons2 " style="text-overflow: ellipsis;overflow-x: hidden;overflow-y: hidden;padding: 0;">
                <div style="border: 1px solid black; overflow:hidden">
                    <div class="chat-search col-md-12" id="convStart"  style="padding: 1px;background:#e91e63;color:#fff;">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" id="newMessage">
                           <div class="col-md-12" style="margin: 0;padding: 10px;font-size: 20px;font-weight: bold"><span class="" style="padding: 0;"><i class="fa fa-users" style="color: #fff;margin-right: 5px" ></i></span>CHAT LIST </div>
                        </div>
                    </div>
                    <div style="float:left; width: 100%"  id="groupDiv">
                        <ul class="persons" id="groups" >

                        </ul>
                    </div>
                    
                    
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
		
		$('#chats_sents_id').click(function(){
			var groupLimit = 30;
			let settings = {
                "async": true,
                "crossDomain": true,
                "url": "<?php echo base_url('imApi/getAllGroups?limit=') ?>"+groupLimit+"&start=0",
                "method": "GET",
            };


            $.ajax(settings).done(function (response) {
                let groups=response.response;
                totalGroup=response.status.total;
                if(groups.length<=0){
                    $('#addMember').attr('data-group',null);
                    $('#addMember').addClass("hidden");
                    chatBox.html('<img id="blankImg" src="<?php echo base_url('template/front/assets/img/nomess.png')?>" class="img-responsive blankImg" style="width:500px;margin-top: 20px;margin-bottom:40px">');
                    chatBox.addClass("text-center");
                    $('#groupMembers').html("");
                    $('#groupMembers_').html("");
                    $('#groupMembers_status').html("");
                    $('#groupMembers_name').html("");
                    $('#groupMembers_details').html("");

                    $('#groups').html('');
                    $("#editGroupName").addClass("hidden");
                    $('.UserNames').html('');
                }else{
                    $('#addMember').removeClass("hidden");
                    $("#editGroupName").removeClass("hidden");

                    printGroupList(groups);
                    // $("#groups li").first().trigger("click");
                    if(callback!=null|| callback!=""){
                        if(groups.length>0){
                            callback(true);
                        }else {
                            callback(false);
                        }

                    }else {
                        $("#groups li").first().trigger("click",[{update:true}]);
                    }
                }
            });
		})
		
		
        function printGroupList(groups){
    

            let html="";
            groupIds=[];

            time={};
            for(let i=0;i<groups.length;i++){
                groupIds.push(groups[i].groupId);
                time[groups[i].groupId]=groups[i].lastActive;
                html += " <li class=\"person\" data-chat=\"person1\" id='group_"+groups[i].groupId+"' data-mecreator="+groups[i].meCreator+" data-group=\""+groups[i].groupId+"\">";
                //groupImages[groups[i].groupId]=groups[i].groupImage;
                html +='<span id="groupImage_'+groups[i].groupId+'">';
                for (j=0;j<groups[i].groupImage.length;j++){

                    html += "<img class=\"img-responsive img-circle\" style=\"width: 40px; height: 40px;border-radius: 50%\" src=\""+groups[i].groupImage[j]+"\" >";
                }
                html +='</span>';
                html += "                        <span class=\"name\" id='groupName_"+groups[i].groupId+"' style=\"overflow: hidden\"><div>"+groups[i].groupName+"</div><\/span>";
                let date=moment(groups[i].lastActive,moment.ISO_8601).fromNow();

                html += "                        <span id='time_"+groups[i].groupId+"' class=\"time\">"+date+"<\/span>";
                if(groups[i].messageType==="text"){
                    let recentMessage=groups[i].recentMessage;
                    if(recentMessage===null){
                        recentMessage='';
                    }
                    html += "                        <span style='float: left;display:none;' id='messageType_"+groups[i].groupId+"' class=\"preview\">"+recentMessage+"<\/span>";
                }else{
                    let messageType=groups[i].messageType;
                    if(messageType===null){
                        messageType='';
                    }
                    html += "                        <span style='float: left' id='messageType_"+groups[i].groupId+"' class=\"preview\">"+messageType+"<\/span>";
                }
                if(groups[i].pendingMessage>0){
                    html += "                        <div style='' id='notice_"+groups[i].groupId+"' class=\"pad-2 notice text-center\" >New<\/div>";
                }else {
                    html += "                        <div style='' id='notice_"+groups[i].groupId+"' class=\"pad-2 notice hidden text-center\" ><\/div>";
                }

                html += "                    <\/li>";
            }
			console.log(html);
            $("#groups").html(html);
        }
		
    })
</script>
