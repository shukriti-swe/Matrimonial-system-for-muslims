<?php
require_once FCPATH . 'vendor/autoload.php';
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
require APPPATH . 'libraries/REST_Controller.php';

class ImApi extends REST_Controller
{

    //for requesting model class and checking user authentication
    public function __construct()
    {
        
        parent::__construct();

        $this->load->model("Im_group_Model");
        $this->load->model("Im_group_members_Model");
        $this->load->model("Im_message_Model");
        $this->load->model("User_Model");
        $this->load->model("Im_receiver_Model");

        $headers = apache_request_headers();
        $member_id = $this->session->userdata('member_id');
        if (isset($member_id)) {
            if (!$this->User_Model->isValidToken($member_id)) {
                $response = array(
                    "stauts" => array(
                        "code" => REST_Controller::HTTP_UNAUTHORIZED,
                        "message" => "Unauthorized"
                    ),
                    "response" => null
                );
                $this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }
        } else {
            $response = array(
                "stauts" => array(
                    "code" => REST_Controller::HTTP_UNAUTHORIZED,
                    "message" => "Unauthorized"
                ),
                "response" => null
            );
            $this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }
        
        
    }
    public function getMembers_get()
    {
		
        //$headers = apache_request_headers();
        //$userId = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        $userId = $this->session->userdata('member_id');
        $g_id = $this->get("groupId",true);
        if ($g_id == null) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Error "
                ),
                "response" => "groupId is required"
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;
        }
        $membersInfo = array();

        $members = $this->Im_group_members_Model->getMembersWihoutSender($g_id, $userId);

        foreach ($members as $u_id) {
            $membersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
			
        }
		//print_r($membersInfo);

        $meCreator = $this->Im_group_Model->ifThisUserCreator($g_id, $userId);
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success"
            ),
            "response" => array(
                "meCreator" => $meCreator,
                "memberList" => $membersInfo
            )

        );
        // echo "<pre>";
        // print_r($response);die();
        // echo "</pre>";

        echo $this->response($response, REST_Controller::HTTP_OK);die();
    }

    // delete a member from the group
    public function deleteMember_post()
    {
        $headers = apache_request_headers();
        $userId = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        $this->form_validation->set_rules('memberId', 'memberId', 'required');
        $this->form_validation->set_rules('groupId', 'groupId', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Validation Error"
                ),
                "response" => validation_errors()
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;
        }
        $deletedMemberId = $this->post("memberId", true);
        $groupId = $this->post("groupId", true);
        $membersWithDeletedOne=array();
        if($this->Im_group_members_Model->ifExist($groupId,$deletedMemberId)) {
            $this->memberUpdate($userId, $groupId, $deletedMemberId, "delete");

            //$memberList=$this->Im_group_members_Model->getMembers($groupId);
            $meCreator = $this->Im_group_Model->ifThisUserCreator($groupId, $userId);
            if (!$meCreator) {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_UNAUTHORIZED,
                        "message" => "Error "
                    ),
                    "response" => "Can't delete member"
                );
                $this->response($response, REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }

            //$memberList=$this->Im_group_members_Model->getMembers($groupId);
            $membersWithDeletedOne = $this->Im_group_members_Model->getMembers($groupId);
            $this->Im_group_members_Model->delete($groupId, $deletedMemberId);
            $this->Im_receiver_Model->DeleteAll($groupId, $deletedMemberId);
        }
        $membersInfo = array();
        //$membersGroupInfo=array();
        $requestUseMembersInfo=array();

        $members = $this->Im_group_members_Model->getMembers($groupId);
        foreach ($members as $u_id) {
            $membersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
            //$membersGroupInfo[$u_id->u_id]=$this->getGroupInfo($groupId,$u_id->u_id);
        }
        $requestUserMembers=$this->Im_group_members_Model->getMembersWihoutSender($groupId,$userId);
        foreach ($requestUserMembers as $u_id) {
            $requestUseMembersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);

        }
        $creatorId = $this->Im_group_Model->get($groupId)->createdBy;
        $meCreator = false;
        if ($userId == $creatorId) {
            $meCreator = true;
        }
        $registerData = array(
            "_r" => $headers["Authorizationkeyfortoken"],
            "url" => base_url()
        );

        /*$updateData=array(
            "_r"=>$headers["Authorizationkeyfortoken"],
            "groupId"=>$groupId,
            "memberIds"=>$memberList
        );*/
        $client = new Client(new Version2X($this->config->item('socket_url')));
        $client->initialize();
        $client->emit("register", $registerData);

        foreach ($membersWithDeletedOne as $memberId) {
            $removeGroup = false;
            $newMembersInfo = array();
            if ($memberId->u_id === $deletedMemberId) {
                $removeGroup = true;
            }
            if (!$removeGroup) {
                $otherMembers = $this->Im_group_members_Model->getMembersWihoutSender($groupId, $memberId->u_id);
                foreach ($otherMembers as $u_id) {
                    $newMembersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
                    //$membersGroupInfo[$u_id->u_id]=$this->getGroupInfo($groupId,$u_id->u_id);
                }
            }

            $updateData = array(
                "_r" => $headers["Authorizationkeyfortoken"],
                "groupId" => $groupId,
                "memberId" => $memberId->u_id,
                "removeGroup" => $removeGroup,
                "groupInfo" => $this->getGroupInfo($groupId, $memberId->u_id),
                "memberList" => $newMembersInfo,


            );
            $client->emit("deleteMember", $updateData);
        }

        $client->close();
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success"
            ),
            "response" => array(
                "meCreator" => $meCreator,
                "memberList" => $requestUseMembersInfo,
                "groupInfo" => $this->getGroupInfo($groupId, $userId)
            )

        );
        $this->response($response, REST_Controller::HTTP_OK);
    }

    private function memberUpdate($userId, $groupId, $memberId, $updateType)
    {
        $headers = apache_request_headers();
        $receiverType = "group";
        $date = date('Y-m-d');
        $time = date("h:i:s");
        $date_time = date(DATE_ISO8601, time());
        $fileType = "update";
        $message = null;

        $recentMessage=$this->Im_message_Model->getRecentMessage($groupId);
        if ($updateType == "add") {
            $message = $memberId . " is added by " . $userId;
            $this->Im_receiver_Model->addPendingForNewMember($memberId,$groupId,$recentMessage->m_id);
        } else if ($updateType == "delete") {
            $message = $memberId . " is removed by " . $userId;
            $this->Im_receiver_Model->DeletePendingMessage($groupId,$memberId,$recentMessage->m_id);
        } else if ($updateType == "name") {
            $groupInfo = $this->Im_group_Model->get($groupId);
            $groupName = $groupInfo->name;
            $message = $userId . " change the group name to " . $groupName;
        }
        if ($message != null) {
            $this->Im_message_Model->insert($userId, $groupId, $message, $fileType,null, $receiverType, $date, $time, $date_time);
            $fullMessage = $this->Im_message_Model->getRecentMessageWithUpdate($groupId);
            $senderInfo = $this->User_Model->get_user($userId, null, null);

            $ios_date_time = date_format(date_create($fullMessage->date_time), DATE_ISO8601);

            $fullMessage->ios_date_time = $ios_date_time;
            $fullMessage->message = $this->processUpdate($fullMessage->message);
            $socketData = array(
                "_r" => $headers["Authorizationkeyfortoken"],
                "to" => $groupId,
                "receiversId" => [],
                "message" => $fullMessage,
                "sender" => $senderInfo,

            );
            $registerData = array(
                "_r" => $headers["Authorizationkeyfortoken"],
                "url" => base_url()
            );
            $client = new Client(new Version2X($this->config->item('socket_url')));
            $client->initialize();
            $client->emit("register", $registerData);
            $client->emit('sendMessage', $socketData);
            //$client->emit("updateMember",$response);
            $client->close();
        }
    }

    private function processUpdate($message)
    {

        $str = explode(" ", $message);

        if (is_numeric($str[0])) {
            $str[0] = $this->User_Model->getFirstName((int)$str[0]);
        }
        if (is_numeric($str[count($str) - 1])) {
            $str[count($str) - 1] = $this->User_Model->getFirstName((int)$str[count($str) - 1]);
        }

        return implode(" ", $str);
    }

    private function getGroupInfo($g_id, $userId)
    {
        $membersInfo = array();
        $groupImage = array();
        $groupInfo = $this->Im_group_Model->get($g_id);
        $lastActive = $groupInfo->lastActive;
        $groupName = $groupInfo->name;

        //$me=$this->User_Model->get_user($userId,null,null);
        $recentMessage = $this->Im_message_Model->getRecentMessage($g_id);
        $pendingMessages = $this->Im_receiver_Model->getGroupPendingMessage($g_id, $userId);

        $members = $this->Im_group_members_Model->getMembersWihoutSender($g_id, $userId);
        foreach ($members as $u_id) {
            $membersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
        }
        $totalMember = $this->Im_group_members_Model->getTotalGroupMember($g_id);
        if ($totalMember > 1) {
            if ($totalMember >= 4) {
                for ($i = 0; $i < 3; $i++) {
                    $groupImage[] = $membersInfo[$i]['profilePictureUrl'];
                }
            } else if ($totalMember >= 3) {
                for ($i = 0; $i < 2; $i++) {
                    $groupImage[] = $membersInfo[$i]['profilePictureUrl'];
                }
            } else if ($totalMember <= 2) {
                $groupImage[] = $membersInfo[0]['profilePictureUrl'];
            }
            $totalMember = $totalMember - 1;
        } else {
            $groupImage[] = base_url() . "template/front/assets/img/download.png";
            if ($groupName == null || $groupName == "" || $groupName == '""' || $groupName == "''") {
                $groupName = "No Member";
            }
        }

        if ($groupName == null || $groupName == "" || $groupName == '""' || $groupName == "''" || $groupName == "''") {
            $groupName = "";
            if ($totalMember <= 2) {
                for ($i = 0; $i < $totalMember; $i++) {
                    if ($i == ($totalMember - 1)) {
                        $groupName .= " " . $membersInfo[$i]['display_name'];
                    } else {
                        $groupName .= " " . $membersInfo[$i]['display_name'] . ",";
                    }
                }
            } elseif ($totalMember >= 3) {
                for ($i = 0; $i < $totalMember; $i++) {
                    if ($i == ($totalMember - 1)) {
                        $groupName .= " " . $membersInfo[$i]['display_name'];
                    } else {
                        $groupName .= " " . $membersInfo[$i]['display_name'] . ",";
                    }
                }
            } else {
                $groupName = "No Member";
            }
        }
        $lastActive = date_format(date_create($lastActive), DATE_ISO8601);
        $group = array(
            "groupId" => (int)$g_id,
            "groupImage" => $groupImage,
            "groupName" => trim($groupName),
            //"totalMember"=>$totalMember,
            "lastActive" => $lastActive,
            //"members"=>$membersInfo,
            //"me"=>$me,
            "recentMessage" => $recentMessage->message,
            "messageType" => $recentMessage->type,
            "pendingMessage" => $pendingMessages
            //"messageDateTime"=>$recentMessage->date_time,
        );
        return $group;
    }


    public function getGroups_get()
    {  //get all groups
        $headers = apache_request_headers();
		
		$view_profiler_id2 = $this->get("r_profiler_id", true);
        // $userId = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        // added
        $userId = $this->session->userdata('member_id');
        $limit = $this->get("limit", true);
        $start = $this->get("start", true);
        $profile_id = $this->get("profile_id", true);
        if( $start==null || $limit==null){
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "start and limit is required"
                )
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;
        }

        $group_ids = $this->Im_group_members_Model->getGroups($userId,$limit, $start);
	
		$pre_data_array=array();
		 $pre_data_array[]='';
		
		 if(isset($view_profiler_id2) && (int)$view_profiler_id2> 0){
			$get_profiler_data= $this->Im_group_members_Model->getGroupsId_for_profiler_r($view_profiler_id2,$userId);
			
			 $profiler_get_id=$get_profiler_data->g_id;
			
		foreach($group_ids as $key => $value){
			
		if($value->g_id==$profiler_get_id){
		$pre_data_array[0]=$value;
		}else{
		 $pre_data_array[]=$value;
		}
		} 
			 $group_ids=$pre_data_array;
		 }
	
		
		// echo "check";print_r($pre_data_array);echo "endcheck";
		/////
		//echo '<pre>';
		//print_r($group_ids);
		//die();
					
	
		 
        $group_ids_array = array();
        $gis_no = 0;
        foreach ($group_ids as $gis => $g_id) {
            $id = $g_id->g_id;
			//echo $id.'<br>';
			
            $reciverCheck = $this->db->where('receiver',$id)
                            ->where('sender !=',$userId)
                            ->where('message !=',null)
                            ->get('im_message')->result();
			
			if(count($reciverCheck) == 0){
			if(isset($profiler_get_id) && ($g_id->g_id==$profiler_get_id)){
         
                $group_ids_array[$gis_no]['g_id'] = $id;
                $gis_no = $gis_no + 1;
            
			}
			}elseif(count($reciverCheck) > 0){
                $group_ids_array[$gis_no]['g_id'] = $id;
                $gis_no = $gis_no + 1;
            }
		//echo $gis_no .'www<br>';
            
        }
        // echo "<pre>";print_r(json_decode(json_encode($group_ids_array))); die();
		$group_ids = json_decode(json_encode($group_ids_array));
        $groups = array();
        foreach ($group_ids as $g_id) {
            $membersInfo = array();
            $groupImage = array();
            $groupInfo = $this->Im_group_Model->get($g_id->g_id);
            $lastActive = $groupInfo->lastActive;
            $groupName = $groupInfo->name;
            $pendingMessages =0;

            
			$recentMessage = $this->Im_message_Model->getRecentMessage($g_id->g_id);
			
			
			
            if(isset($recentMessage->sender)){
            if((int)$recentMessage->sender!=(int)$userId){
                $pendingMessages = $this->Im_receiver_Model->getGroupPendingMessage($g_id->g_id, $userId);
            }}
            $members = $this->Im_group_members_Model->getMembersWihoutSender($g_id->g_id, $userId);
		
            foreach ($members as $u_id) {
               // $membersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
                $membersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
            }
            $totalMember = $this->Im_group_members_Model->getTotalGroupMember($g_id->g_id);
            if ($totalMember > 1) {
                if ($totalMember >= 4) {
                    for ($i = 0; $i < 3; $i++) {
                        $groupImage[] = $membersInfo[$i]['profilePictureUrl'];
                    }
                } else if ($totalMember >= 3) {
                    for ($i = 0; $i < 2; $i++) {
                        $groupImage[] = $membersInfo[$i]['profilePictureUrl'];
                    }
                } else if ($totalMember <= 2) {
                    $groupImage[] = $membersInfo[0]['profilePictureUrl'];
                }
                $totalMember = $totalMember - 1;
            } else {
                $groupImage[] = base_url() . "template/front/assets/img/download.png";
                if ($groupName == null || $groupName == "" || $groupName == '""' || $groupName == "''") {
                    $groupName = "No Member";
                }
            }

            if ($groupName == null || $groupName == "" || $groupName == '""' || $groupName == "''") {
                $groupName = "";
                if ($totalMember <= 2) {
                    for ($i = 0; $i < $totalMember; $i++) {
                        if ($i == ($totalMember - 1)) {
                            $groupName .= " " . $membersInfo[$i]['display_name'];
                        } else {
                            $groupName .= " " . $membersInfo[$i]['display_name'] . ",";
                        }
                    }
                } elseif ($totalMember >= 3) {
                    for ($i = 0; $i < $totalMember; $i++) {
                        if ($i == ($totalMember - 1)) {
                            $groupName .= " " . $membersInfo[$i]['display_name'];
                        } else {
                            $groupName .= " " . $membersInfo[$i]['display_name'] . ",";
                        }
                    }
                } else {
                    $groupName = "No Member";
                }
            }
            $lastActive = date_format(date_create($lastActive), DATE_ISO8601);
            $creatorId = $this->Im_group_Model->get($g_id->g_id)->createdBy;
            $meCreator = false;
            if ($userId == $creatorId) {
                $meCreator = true;
            }
			
			$reciver_check = $this->db->where('receiver',$g_id->g_id)
				->where('sender !=',$userId)
				->where('message !=',null)
				->get('im_message')->result();
			
            if ($recentMessage == null) {
                $groups[] = array(
                    "groupId" => (int)$g_id->g_id,
                    "groupImage" => $groupImage,
                    "groupName" => trim($groupName),
                    //"totalMember"=>$totalMember,
                    "lastActive" => $lastActive,
                    //"members"=>$membersInfo,
                    "meCreator" => $meCreator,
                    "recentMessage" => null,
                    "messageType" => null,
                    "pendingMessage" => $pendingMessages,
					"nstyle"=>(count($reciver_check) == 0 ? 'not_show':'')
                    //"messageDateTime"=>$recentMessage->date_time,
                );
            } else {
                $groups[] = array(
                    "groupId" => (int)$g_id->g_id,
                    "groupImage" => $groupImage,
                    "groupName" => trim($groupName),
                    //"totalMember"=>$totalMember,
                    "lastActive" => $lastActive,
                    //"members"=>$membersInfo,
                    "meCreator" => $meCreator,
                    "recentMessage" => $recentMessage->message,
                    "messageType" => $recentMessage->type,
                    "pendingMessage" => $pendingMessages,
					"nstyle"=>(count($reciver_check) == 0 ? 'not_show':'')
                    //"messageDateTime"=>$recentMessage->date_time,
                );
            }

        }
		
		
		
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success",
                "total"=>$this->Im_group_members_Model->getTotalGroups($userId)
            ),
            "response" => $groups
        );
  
        echo $this->response($response, REST_Controller::HTTP_OK);die();
    }
	
	


    public function getAllGroups_get()
    {  //get all groups
        $headers = apache_request_headers();
        // $userId = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        // added
		$view_profiler_id = $this->get("s_profiler_id", true);
	
        $userId = $this->session->userdata('member_id');
        $limit = $this->get("limit", true);
        $start = $this->get("start", true);
        $profile_id = $this->get("profile_id", true);
        if( $start==null || $limit==null){
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "start and limit is required"
                )
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;
        }

        $group_ids = $this->Im_group_members_Model->getGroups($userId,$limit, $start);
		
		/////
		 $pre_data_array=array();
		 $pre_data_array[]='';
		
		 if(isset($view_profiler_id)){
			$get_profiler_data= $this->Im_group_members_Model->getGroupsId_for_profiler($view_profiler_id,$userId);
			
			 $profiler_get_id=$get_profiler_data->g_id;
			 
		foreach($group_ids as $key => $value){
			
		if($value->g_id==$profiler_get_id){
		$pre_data_array[0]=$value;
		}else{
		 $pre_data_array[]=$value;
		}
		} 
	    
			$group_ids=$pre_data_array;
		 
		 }
		
	
		
     /////
        $group_ids_array = array();
        $gis_no = 0;
        foreach ($group_ids as $gis => $g_id) {
            $id = $g_id->g_id;
            $reciverCheck = $this->db->where('receiver',$id)
                            ->where('sender !=',$userId)
                            ->where('message !=',null)
                            ->get('im_message')->result();
            if(count($reciverCheck) == 0){
                $group_ids_array[$gis_no]['g_id'] = $id;
                $gis_no = $gis_no + 1;
            }
        }
        // echo "<pre>";print_r(json_decode(json_encode($group_ids_array))); die();
		$group_ids = json_decode(json_encode($group_ids_array));
        $groups = array();
        foreach ($group_ids as $g_id) {
            $membersInfo = array();
            $groupImage = array();
            $groupInfo = $this->Im_group_Model->get($g_id->g_id);
            $lastActive = $groupInfo->lastActive;
            $groupName = $groupInfo->name;
            $pendingMessages =0;

            
            $recentMessage = $this->Im_message_Model->getRecentMessage($g_id->g_id);
  //print_r($recentMessage);
			if(isset($recentMessage->sender)){
            if((int)$recentMessage->sender!=(int)$userId){
                $pendingMessages = $this->Im_receiver_Model->getGroupPendingMessage($g_id->g_id, $userId);
            }}
            $members = $this->Im_group_members_Model->getMembersWihoutSender($g_id->g_id, $userId);
          
            foreach ($members as $u_id) {
               // $membersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
                $membersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
            }
            $totalMember = $this->Im_group_members_Model->getTotalGroupMember($g_id->g_id);
            if ($totalMember > 1) {
                if ($totalMember >= 4) {
                    for ($i = 0; $i < 3; $i++) {
                        $groupImage[] = $membersInfo[$i]['profilePictureUrl'];
                    }
                } else if ($totalMember >= 3) {
                    for ($i = 0; $i < 2; $i++) {
                        $groupImage[] = $membersInfo[$i]['profilePictureUrl'];
                    }
                } else if ($totalMember <= 2) {
                    $groupImage[] = $membersInfo[0]['profilePictureUrl'];
                }
                $totalMember = $totalMember - 1;
            } else {
                $groupImage[] = base_url() . "template/front/assets/img/download.png";
                if ($groupName == null || $groupName == "" || $groupName == '""' || $groupName == "''") {
                    $groupName = "No Member";
                }
            }

            if ($groupName == null || $groupName == "" || $groupName == '""' || $groupName == "''") {
                $groupName = "";
                if ($totalMember <= 2) {
                    for ($i = 0; $i < $totalMember; $i++) {
                        if ($i == ($totalMember - 1)) {
                            $groupName .= " " . $membersInfo[$i]['display_name'];
                        } else {
                            $groupName .= " " . $membersInfo[$i]['display_name'] . ",";
                        }
                    }
                } elseif ($totalMember >= 3) {
                    for ($i = 0; $i < $totalMember; $i++) {
                        if ($i == ($totalMember - 1)) {
                            $groupName .= " " . $membersInfo[$i]['display_name'];
                        } else {
                            $groupName .= " " . $membersInfo[$i]['display_name'] . ",";
                        }
                    }
                } else {
                    $groupName = "No Member";
                }
            }
            $lastActive = date_format(date_create($lastActive), DATE_ISO8601);
            $creatorId = $this->Im_group_Model->get($g_id->g_id)->createdBy;
            $meCreator = false;
            if ($userId == $creatorId) {
                $meCreator = true;
            }
            if ($recentMessage == null) {
                $groups[] = array(
                    "groupId" => (int)$g_id->g_id,
                    "groupImage" => $groupImage,
                    "groupName" => trim($groupName),
                    //"totalMember"=>$totalMember,
                    "lastActive" => $lastActive,
                    //"members"=>$membersInfo,
                    "meCreator" => $meCreator,
                    "recentMessage" => null,
                    "messageType" => null,
                    "pendingMessage" => $pendingMessages,
                    //"messageDateTime"=>$recentMessage->date_time,
                );
            } else {
                $groups[] = array(
                    "groupId" => (int)$g_id->g_id,
                    "groupImage" => $groupImage,
                    "groupName" => trim($groupName),
                    //"totalMember"=>$totalMember,
                    "lastActive" => $lastActive,
                    //"members"=>$membersInfo,
                    "meCreator" => $meCreator,
                    "recentMessage" => $recentMessage->message,
                    "messageType" => $recentMessage->type,
                    "pendingMessage" => $pendingMessages,
                    //"messageDateTime"=>$recentMessage->date_time,
                );
            }

        }
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success",
                "total"=>$this->Im_group_members_Model->getTotalGroups($userId)
            ),
            "response" => $groups
        );
        // echo "<pre>";
        // print_r($response); die();
        echo $this->response($response, REST_Controller::HTTP_OK);die();
    }

    //get pending not pending messages

    public function changeGroupName_post()
    {
        $this->form_validation->set_rules('groupName', 'groupName', 'required');
        $this->form_validation->set_rules('groupId', 'groupId', 'required');
        $headers = apache_request_headers();
        $userId = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        if ($this->form_validation->run() == FALSE) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Validation Error"
                ),
                "response" => validation_errors()
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;
        }
        $groupName = $this->post("groupName", true);
        if ($groupName == "" || $groupName == '""' || $groupName == "''") {
            $groupName = null;
        }
        $groupId = $this->post("groupId", true);
        $this->Im_group_Model->update($groupId, $groupName);
        $memberList = $this->Im_group_members_Model->getMembers($groupId);


        /*$members=$this->Im_group_members_Model->getMembersWihoutSender($groupId,$userId);
        foreach ($members as $u_id){

        }*/

        $updateData = array(
            "_r" => $headers["Authorizationkeyfortoken"],
            "groupId" => $groupId,
            "memberIds" => $memberList,
            "groupName" => $groupName
        );
        $registerData = array(
            "_r" => $headers["Authorizationkeyfortoken"],
            "url" => base_url()
        );
        $client = new Client(new Version2X($this->config->item('socket_url')));
        $client->initialize();
        $client->emit("register", $registerData);
        $client->emit("updateGroupName", $updateData);
        $client->close();
        $this->memberUpdate($userId, $groupId, null, "name");
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success"
            ),
            "response" => null

        );
        $this->response($response, REST_Controller::HTTP_OK);
    }

    private function processSeen($m_id,$g_id,$senderId){

        $totalMember=(int)$this->Im_group_members_Model->getTotalGroupMember($g_id);
        $totalSeen=(int)$this->Im_receiver_Model->getTotalReceiver($m_id);
        if($totalSeen==null || $totalSeen==0){
            return null;
        }
        if($totalMember==2 && $totalSeen==2){
            return "Seen";
        }
        if($totalMember==$totalSeen && $totalMember!=1){
            return "Seen by Everyone";
        }
        else if ($totalMember==1){
            return null;
        }
        else{
            $membersIds=$this->Im_group_members_Model->getMembersWihoutSender($g_id,$senderId);
            $seen="Seen by ";
            $names=array();
            for ($i=0;$i<count($membersIds);$i++){
                $name=$this->User_Model->getFirstName($membersIds[$i]->u_id);
                if($this->Im_receiver_Model->isReceived($membersIds[$i]->u_id,$g_id,$m_id)){
                    $names[]=$name;
                }

            }
            if(count($names)!=0){
                return $seen.implode(",",$names);
            }
            else return null;
        }

    }

    public function getMessage_get()
    {
        $headers = apache_request_headers();
        //$r_id = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        $r_id = $this->session->userdata('member_id');

        $g_id = $this->get("groupId",true);
        $start = $this->get("start",true);
        $limit = $this->get("limit",true);

        if($g_id==null || $start==null || $limit==null){
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "groupId,start and limit is required"
                )
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;
        }

        $messages = $this->Im_message_Model->getMessage($g_id, $start, $limit); 
         //get messages
        $totalMessage = $this->Im_message_Model->getTotalMessage($g_id);
        $data = [];
        $recentMessage=$this->Im_message_Model->getRecentMessage($g_id);

        
        $this->Im_receiver_Model->update($r_id,$g_id,$recentMessage->m_id);

        foreach ($messages as $message) {
            //$seen=null;
            $senderProfile = $this->User_Model->get_user($message->sender, null, null);
            $ios_date_time = date_format(date_create($message->date_time), DATE_ISO8601);
            $message->ios_date_time = $ios_date_time;

            if ($message->type == "update") {
                $message->message = $this->processUpdate($message->message);
            }
//            if((int)$recentMessage->m_id==(int)$message->m_id && (int)$message->sender==$r_id){
                $seen=$this->processSeen($message->m_id,$g_id,$message->sender);
  //          }

            $data[] = array(
                "sender" => $senderProfile,
                "message" => $message,
                "seen"=>$seen,
            );


        }
        $registerData = array(
            //"_r" => $headers["Authorizationkeyfortoken"],
            "_r" => $r_id,
            "url" => base_url()
        );
        $seenData=array(
            "recentMessage"=>(int)$recentMessage->m_id,
        );
        
        
        $client = new Client(new Version2X($this->config->item('socket_url')));
        $client->initialize();
        $client->emit("register", $registerData);
        $client->emit('announceSeen',$seenData);
        //$client->emit("updateMember",$response);
        $client->close();

        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success"
            ),
            "totalMessage" => $totalMessage,
            "recentMessageId"=>(int)$recentMessage->m_id,
            "response" => array_reverse($data)

        );

        //echo json_encode($response, REST_Controller::HTTP_OK);die();

        echo $this->response($response, REST_Controller::HTTP_OK);

    }

    public function createGroupByMember_post()
    {
        $headers = apache_request_headers();
        $senderId = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        $date_time = date(DATE_ISO8601, time());
        $users = $this->post("userId");
        if ($users == null) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Error "
                ),
                "response" => "user ids are required"
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;
        } else {
            $users[] = $senderId;
        }


        $g_ids = array();
        $groupsIds = $this->Im_group_members_Model->getGroups($users, null, null);
        foreach ($groupsIds as $groupId) {
            $totalReceiver = $this->Im_group_members_Model->getTotalGroupMember($groupId->g_id);
            $getMembers = $this->Im_group_members_Model->getMembers($groupId->g_id);
            $member = array();
            foreach ($getMembers as $getMember) {
                $member[] = $getMember->u_id;
            }
            $diff = array_diff($member, $users);

            if (((int)$totalReceiver) == (count($users)) && count($diff) == 0) {
                $g_ids[] = $groupId->g_id;
                break;
            }
        }
        if (count($g_ids) > 0) {
            $receiverId = $g_ids[0];
        } else {
            $name = $this->post("g_name");
            if ($name == null || $name == "" || $name == '""' || $name == "''") {
                $name = null;
            }

            $receiverId = $this->Im_group_Model->insert($name, $date_time, $senderId);
            try {
                foreach ($users as $user) {
                    $this->Im_group_members_Model->insert($receiverId, $user);
                }
                // $this->Im_group_members_Model->insert($receiverId,$senderId);
            } catch (Exception $e) {
                $this->Im_group_members_Model->DeleteAll($receiverId);
                $this->Im_group_Model->DeleteAll($receiverId);
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_NOT_FOUND,
                        "message" => "Success"
                    ),
                    "response" => "User Not Found"

                );
                $this->response($response, REST_Controller::HTTP_NOT_FOUND);
                return;
            }

        }
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success"
            ),
            "response" => array(
                "groupId" => (int)$receiverId
            )

        );
        $this->response($response, REST_Controller::HTTP_OK);
    }



    public function sendMessage_post()
    {  // groupId(receiverId Id)(null), users[] if  groupId==null , g_name(null), file(Null) or message(null),date(yyyy-mm-dd),time(hh:mm:ss)
        $headers = apache_request_headers();
        //$senderId = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        $senderId = $this->session->userdata('member_id');
        $date = date('Y-m-d');
        $time = date("h:i:s");
        $date_time = date(DATE_ISO8601, time());
        $client = new \Emojione\Client(new \Emojione\Ruleset());
        $client->ascii = true;
        // $client->riskyMatchAscii=true; // if enable http:// also converted to emoji


        $receiverId = $this->post("groupId", true);
        if ($receiverId == null) {
            $users = $this->post("userId", true);
            if ($users == null) {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                        "message" => "Error "
                    ),
                    "response" => "Either userId or groupId is required,userId is an array"
                );
                $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
                return;

            }
            else if (!is_array($users)) {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                        "message" => "Error "
                    ),
                    "response" => "userId is not an array"
                );
                $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
                return;

            }
            else {
                $users[] = $senderId;
            }


            $g_ids = array();
            $groupsIds = $this->Im_group_members_Model->getGroups($users, null, null);
            foreach ($groupsIds as $groupId) {
                $totalReceiver = $this->Im_group_members_Model->getTotalGroupMember($groupId->g_id);
                $getMembers = $this->Im_group_members_Model->getMembers($groupId->g_id);
                $member = array();
                foreach ($getMembers as $getMember) {
                    $member[] = $getMember->u_id;
                }
                $diff = array_diff($member, $users);

                if (((int)$totalReceiver) == (count($users)) && count($diff) == 0) {
                    $g_ids[] = $groupId->g_id;
                    break;
                }
            }
            if (count($g_ids) > 0) {
                $receiverId = $g_ids[0];
            } else {
                $name = $this->post("g_name");
                if ($name == null || $name == "" || $name == '""' || $name == "''") {
                    $name = null;
                }

                $receiverId = $this->Im_group_Model->insert($name, $date_time, $senderId);
                foreach ($users as $user) {
                    $this->Im_group_members_Model->insert($receiverId, $user);
                }
                // $this->Im_group_members_Model->insert($receiverId,$senderId);
            }

        }
        $message = null;
        $image = null;
        $fileType = null;
        $actualFolderName = "./template/front/assets/im/group_$receiverId";
        $actualFileName=null;
        if (!is_dir($actualFolderName)) {
            mkdir($actualFolderName, 0777, true);
        }
        $config['upload_path'] = $actualFolderName;
        $config['allowed_types'] = '*';
        $config['file_name'] = date("mjYGis") . "im" . $this->User_Model->generateRandomString(5) . $receiverId;
        $config['max_size'] = '';


        $this->load->library('upload', $config);
        if (isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name'])) {
            if (!$this->upload->do_upload('file')) {
                $response = array(
                    "status" => array(
                        "code" => REST_Controller::HTTP_BAD_REQUEST,
                        "message" => "File upload Error"
                    ),
                    "response" => $this->upload->display_errors()
                );
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);

            } else {
                $actualFileName=$_FILES['file']['name']; //real file name
                //here $file_data receives an array that has all the info
                //pertaining to the upload, including 'file_name'
                $file_data = $this->upload->data();
                if ($file_data["file_type"] == "audio/mp3" || $file_data["file_type"] == "audio/mpeg3" || $file_data["file_type"] == "audio/mpg" || $file_data["file_type"] == "audio/mpeg") {
                    $image = $file_data['file_name'];
                    $fileType = "audio";
                } else if ($file_data["file_type"] == "video/mp4" || $file_data["file_type"] == "video/3gp" || $file_data["file_type"] == "video/3gpp" || $file_data["file_type"] == "video/*") {
                    exec("ffmpeg -i " . $file_data['full_path'] . " " . $file_data['file_path'] . $file_data['raw_name'] . ".mp4");
                    $image = $file_data['raw_name'] . '.' . 'mp4';
                    $fileType = "video";
                } else if($file_data["file_type"] == "image/png" || $file_data["file_type"] == "image/x-png" || $file_data["file_type"] == "image/jpeg"||$file_data["file_type"] == "image/pjpeg") {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $file_data['full_path']; //get original image
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 600;
                    $config['height'] = 600;
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        $response = array(
                            "status" => array(
                                "code" => REST_Controller::HTTP_BAD_REQUEST,
                                "message" => "File upload Error"
                            ),
                            "response" => $this->image_lib->display_errors()
                        );
                        $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
                    }
                    $image = $file_data['file_name'];
                    $fileType = "image";
                }else{
                    $image = $file_data['file_name'];
                    $fileType = "document";
                }

            }
            $message = $image;
        } else {
            $fileType = "text";
            $message = $this->post("message", true);
            $message = $client->asciiToUnicode($message);

        }
        $receiverType = "personal";
        $totalReceiver = $this->Im_group_members_Model->getTotalGroupMember($receiverId);
        if ($totalReceiver > 2) {
            $receiverType = "group";
        }

        $oldMessage=$this->Im_message_Model->getRecentMessage($receiverId);
        if($oldMessage!=null){
            $this->Im_receiver_Model->deleteByMessageId($oldMessage->m_id);
        }
        $memberIds = $this->Im_group_members_Model->getMembers($receiverId);
        $m_id = $this->Im_message_Model->insert($senderId, $receiverId, $message, $fileType,$actualFileName, $receiverType, $date, $time, $date_time);
        $fullMessage = $this->Im_message_Model->getRecentMessageWithUpdate($receiverId);
        $senderInfo = $this->User_Model->get_user($senderId, null, null);
        $this->Im_group_Model->updateLastActiveDate($receiverId, $date_time);


        $ios_date_time = date_format(date_create($fullMessage->date_time), DATE_ISO8601);

        $fullMessage->ios_date_time = $ios_date_time;

        $socketData = array(
            "_r" => $headers["Authorizationkeyfortoken"],
            "to" => $receiverId,
            "receiversId" => $memberIds,
            "message" => $fullMessage,
            "sender" => $senderInfo,

        );
        // echo "<pre>";
        // print_r($socketData);die();
        $registerData = array(
            "_r" => $headers["Authorizationkeyfortoken"],
            "url" => base_url()
        );
        $client = new Client(new Version2X($this->config->item('socket_url')));
        $client->initialize();
        $client->emit("register", $registerData);
        $client->emit('sendMessage', $socketData);
        //$client->emit("updateMember",$response);
        $client->close();
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success"
            ),
             "response" =>$this->getGroupInfo($receiverId,$senderId)

        );
        // echo "<pre>";
        // print_r($response);die();

        echo json_encode($response, REST_Controller::HTTP_OK);die();
        //$this->response($response, REST_Controller::HTTP_OK);
    }


    public function addGroupMember_post() //userId[] , groupId
    {
        $headers = apache_request_headers();
        $userId = $this->User_Model->getTokenToId($headers["Authorizationkeyfortoken"]);
        $this->form_validation->set_rules('userId[]', 'userId[]', 'required');
        $this->form_validation->set_rules('groupId', 'groupId', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Validation Error"
                ),
                "response" => validation_errors()
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;
        }
        $memberIds = $this->post("userId", true);
        $groupId = $this->post("groupId", true);
        if (!is_array($memberIds)) {
            $response = array(
                "status" => array(
                    "code" => REST_Controller::HTTP_NOT_ACCEPTABLE,
                    "message" => "Error "
                ),
                "response" => "userId is not an array"
            );
            $this->response($response, REST_Controller::HTTP_NOT_ACCEPTABLE);
            return;

        }

        foreach ($memberIds as $memberId) {
            if (!$this->Im_group_members_Model->ifExist($groupId, $memberId)) {
                $this->Im_group_members_Model->insert($groupId, $memberId);

                $this->memberUpdate($userId, $groupId, $memberId, "add");
            }

        }

        // $memberList=$this->Im_group_members_Model->getMembers($groupId);
        $membersInfo = array();
        $requestUseMembersInfo=array();

        $members = $this->Im_group_members_Model->getMembers($groupId);
        foreach ($members as $u_id) {
            $membersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);

        }
        $requestUserMembers=$this->Im_group_members_Model->getMembersWihoutSender($groupId,$userId);
        foreach ($requestUserMembers as $u_id) {
            $requestUseMembersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);

        }
        $creatorId = $this->Im_group_Model->get($groupId)->createdBy;
        $meCreator = false;
        if ($userId == $creatorId) {
            $meCreator = true;
        }
        $registerData = array(
            "_r" => $headers["Authorizationkeyfortoken"],
            "url" => base_url()
        );


        $client = new Client(new Version2X($this->config->item('socket_url')));
        $client->initialize();
        $client->emit("register", $registerData);

        foreach ($members as $memberId) {
            $otherMembers = $this->Im_group_members_Model->getMembersWihoutSender($groupId, $memberId->u_id);
            $newMembersInfo = array();
            foreach ($otherMembers as $u_id) {
                $newMembersInfo[] = $this->User_Model->get_user($u_id->u_id, null, null);
                //$membersGroupInfo[$u_id->u_id]=$this->getGroupInfo($groupId,$u_id->u_id);
            }
            $updateData = array(
                "_r" => $headers["Authorizationkeyfortoken"],
                "groupId" => $groupId,
                "memberId" => $memberId->u_id,
                "groupInfo" => $this->getGroupInfo($groupId, $memberId->u_id),
                "memberList" => $newMembersInfo,

            );
            $client->emit("addMember", $updateData);
        }
        $client->close();
        $response = array(
            "status" => array(
                "code" => REST_Controller::HTTP_OK,
                "message" => "Success"
            ),
            "response" => array(
                "meCreator" => $meCreator,
                "memberList" => $requestUseMembersInfo,
                "groupInfo" => $this->getGroupInfo($groupId, $userId)
            )

        );
        $this->response($response, REST_Controller::HTTP_OK);
    }


    public function getSetTokenValue_get(){
        $id = $this->get("id", true);
        $token = $this->User_Model->getToken($id);
        $response = array(
                        "status" => array(
                            "code" => REST_Controller::HTTP_OK,
                            "message" => "Success"
                        ),
                        "response" => $token
                    );
        return $this->response($response, REST_Controller::HTTP_OK);
    }


}