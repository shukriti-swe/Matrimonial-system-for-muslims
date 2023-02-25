<?php

class User_Model extends CI_Model
{
    public $userSecret;
    public $firstName;
    public $lastName;
    public $userEmail;
    public $userPassword;
    public $userMobile;
    public $userDateOfBirth;
    public $userGender;
    public $userStatus;
    public $userVerification;
    public $lastModified;

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->library('encryption');
    }

    public function get_last_ten_entries()
    {
        //$query = $this->db->get('users', 10);
        $query = $this->db->get('member', 10);
        return $query->result();
    }

    public function get_user($id,$start,$limit)
    {
        if ($start == null && $limit == null) {
            $array = array('member_id' => $id);
            $this->db->where($array);
            // $query = $this->db->get('users');
            $query = $this->db->get('member');

            if($query->row('profile_image')!=null){
                if ($query->row('profile_image') == "default.jpg") {
                    $url = base_url()."uploads/profile_image/".$query->row()->profile_image;
                    
                }else{

                    $url = base_url()."uploads/profile_image/".$id.'/'.$query->row()->profile_image;
                }
            }
            else{
                $url = base_url()."template/front/assets/img/download.png";
            }
			if($query->row('is_profile_img_approved')== 2){
			$url = base_url()."template/front/assets/img/download.png";
			}
			
			
            $calculated_age = (date('Y') - date('Y', $query->row('date_of_birth')));
            $basic_info = $this->Crud_model->get_type_name_by_id('member', $id, 'basic_info');
            $basic_info_data = json_decode($basic_info, true);
            $profession = $this->Crud_model->get_type_name_by_id('profession', $basic_info_data[0]['profession']);
            $my_sect = $this->Crud_model->get_type_name_by_id('sect', $basic_info_data[0]['my_sect']);
            if (isset($my_sect) && !empty($my_sect)) {
                $my_s = $my_sect;
            }else{
                $my_s ="";
            }
            if (isset($profession) && !empty($profession)) {
                $my_p = $profession;
            }else{
                $my_p ="";
            }
            if ($basic_info_data[0]['residence']) {
               $sql ="SELECT name FROM country WHERE country_id =".$basic_info_data[0]['residence'];$q = $this->db->query($sql);
                if ($q->num_rows() > 0){
                    foreach ($q->result() as $row){
                        $countryName = $row->name;
                        if (isset($countryName) && !empty($countryName)) {
                            $cName =$countryName ;
                            
                        }else{
                            $cName ='';
                        }
                    }
                }
            }else{
                $cName ='';
            }
           $profileData = array(
               'userId' =>(int)$query->row('member_id'),
               'firstName' =>$query-> row('first_name'),
               'lastName'=>$query->row('last_name'),
               'userEmail'=>$query->row('email'),
               'userAddress'=>$query->row('present_address'),
               'userMobile'=>$query-> row('mobile'),
               'userStatus'=>(int) $query-> row('profile_status'),
               'userGender'=>$query-> row('gender'),
               'profilePictureUrl' => $url,
               'active'=>(int)$query->row('isOnline'),
               'userAge'=>$calculated_age,
               'residence'=>$cName,
               'profession'=>$my_p,
               'my_sect'=>$my_s,
               'display_name' =>$query->row('display_member'),

           );
            return $profileData;
        } else {

            $query = $this->db->get('member', $limit, $start);
            return $query->result();
        }
    }
    public function get_Active_user($id,$start,$limit)
    {
        if ($start == null && $limit == null) {
            $array = array('member_id' => $id);
            $this->db->where($array);
            $this->db->where("isOnline <>",0);
            $query = $this->db->get('member');

            if($query->row('profile_image')!=null){
                $url = base_url()."uploads/profile_image/".$id.'/'.$query->row()->profile_image;
            }
            else{
                $url = base_url()."template/front/assets/img/download.png";
            }

            $profileData = array(
               'userId' =>(int)$query-> row('member_id'),
               'firstName' =>$query-> row('first_name'),
               'lastName'=>$query->row('last_name'),
               'userEmail'=>$query->row('email'),
               'userAddress'=>$query->row('present_address'),
               'userMobile'=>$query-> row('mobile'),
               'userStatus'=>(int) $query-> row('profile_status'),
               'userGender'=>$query-> row('gender'),
               'profilePictureUrl' => $url,
               'active'=>(int)$query->row('isOnline'),
               'display_name' =>$query->row('display_member'),

            );
            return $profileData;
        } else {

            $query = $this->db->get('member', $limit, $start);
            return $query->result();
        }
    }

    public function getAllUser($userId){
        $users=[];
        $this->db->select("*");
        $this->db->where("profile_status=",1);
        $this->db->where("member_id <>",$userId);

        $query = $this->db->get('member_id');
        foreach ($query->result() as $user){
            if($user->profile_image!=null){
                $url = base_url()."uploads/profile_image/".$user->member_id.'/'.$user->profile_image;
            }
            else{
                $url = base_url()."template/front/assets/img/download.png";
            }

            $profileData = array(
                'userId' =>(int)$user->member_id,
                'firstName' =>$user->first_name,
                'lastName'=>$user->last_name,
                'display_name'=>$user->display_member,
                'userEmail'=>$user->email,
                'userAddress'=>$user->present_address,
                'userMobile'=>$user->mobile,
                'userStatus'=>(int)$user->profile_status,
                'userGender'=>$user->gender,
                'profilePictureUrl' => $url

            );
            $users[]=$profileData;
        }
        return $users;
    }

    public function filterUser($userIds,$key){
        $users=[];
        $this->db->select("*");
        $this->db->where("userType=",1);
        if($userIds!=null){
            $this->db->where_in("userId",$userIds);
        }
        $this->db->group_start();
        $this->db->like("firstName",$key);
        $this->db->or_like("lastName",$key);
        $this->db->group_end();
        $this->db->where("userStatus <>",0);
        $this->db->where("userVerification <>",0);
        $query = $this->db->get('users');
        foreach ($query->result() as $user){
            if($user->userProfilePicture!=null){
                $url = base_url()."assets/userImage/".$user->userProfilePicture;
            }
            else{
                $url = base_url()."assets/img/download.png";
            }

            $profileData = array(
                'userId' =>(int)$user->userId,
                'firstName' =>$user->firstName,
                'lastName'=>$user->lastName,
                'userEmail'=>$user->userEmail,
                'userAddress'=>$user->userAddress,
                'userMobile'=>$user-> userMobile,
                'userStatus'=>(int) $user-> userStatus,
                'userGender'=>$user-> userGender,
                'profilePictureUrl' => $url,
                'display_name'=>$user->display_member,

            );
            $users[]=$profileData;
        }
        return $users;
    }

    public function getAllActiveUser($userId,$limit,$start){
        $users=[];
        $this->db->select("*");
        $this->db->where("isOnline=",1);
        $this->db->where("member_id <>",$userId);
        $this->db->where("profile_status <>",0);
        $query = $this->db->get('member',$limit,$start);
        foreach ($query->result() as $user){
            if($user->profile_image!=null){
                $check_url = "./uploads/profile_image/".$user->member_id.'/'.$user->profile_image;

                if (file_exists($check_url)) {
                    $url = base_url()."uploads/profile_image/".$user->member_id.'/'.$user->profile_image;
                }else{

                    $url = base_url()."template/front/assets/img/download.png";
                }
            }
            else{
                $url = base_url()."template/front/assets/img/download.png";
            }

            $profileData = array(
                'userId' =>(int)$user->member_id,
                'firstName' =>$user->first_name,
                'lastName'=>$user->last_name,
                'userEmail'=>$user->email,
                'userAddress'=>$user->present_address,
                'userMobile'=>$user->mobile,
                'userStatus'=>(int) $user->profile_status,
                'userGender'=>$user->gender,
                'profilePictureUrl' => $url,

                'display_name'=>$user->display_member,

            );
            $users[]=$profileData;
        }
        return $users;
    }

    public function getFirstName($id)
    {
        // $array = array('userId' => $id);
        $array = array('member_id' => $id);
        $this->db->where($array);
        $query = $this->db->get('member');

        return $query->row("display_member");
    }


    public function insert_entry($clientSecret, $firstName, $lastName, $userEmail, $userPassword,$userAddress,$userMobile,$userType,$userStatus)
    {
        if($userPassword == null){
            $changedPassword = null;
        }
        else {
            $changedPassword = password_hash($userPassword,PASSWORD_BCRYPT); // default cost for BCRYPT to 12
        }
        $this->userSecret = $clientSecret;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userEmail = $userEmail;
        $this->userPassword = $changedPassword;
        $this->userAddress = $userAddress;
        $this->userMobile=$userMobile;
        $this->userType = $userType;
        $this->userStatus =1;
        $this->userVerification = 1;
        $this->lastModified = date('Y-m-d G:i:s');
        $this->db->insert("users", $this);
    }

    public function update_entry($userId,$firstName,$lastName,$userMobile,$userAddress,$userDateOfBirth,$userGender)
    {
        //$changedPassword= $this->encrypt->encode($userPassword);
        $changes = array(
            'firstName'=> $firstName,
            'lastName' => $lastName,
            'userMobile' => $userMobile,
            'userAddress' => $userAddress,
            'userDateOfBirth' => date('Y-m-d',strtotime($userDateOfBirth)),
            'userGender' => $userGender,
            'lastModified' => date('Y-m-d G:i:s')

        );
        $this->db->where('userId', $userId);
        $this->db->update('users',$changes );


        $query = $this->User_Model->get_user($userId,null,null);
        return $query;
    }

    public function update_password($userId,$newPassword)
    {
        $changedPassword = password_hash($newPassword, PASSWORD_BCRYPT); //default cost for BCRYPT to 12
        $updatingArray=  array('userPassword' => $changedPassword);
        $this->db->where('userId', $userId);
        $this->db->update('users',$updatingArray );

        $query = $this->User_Model->get_user($userId,null,null);
        return $query;

    }

    public function update_type($id,$type)
    {
        $newType = array('userType' => $type);
        $this->db->where('userId', $id);
        $this->db->update('users',$newType );

        return $this;

    }

    public function update_token($id,$token)
    {
        $newToken = array('userSecret' => $token);
        $this->db->where('userId', $id);
        $this->db->update('users',$newToken );

        return $this;

    }

    public function update_picture($id,$picture)
    {
        $this->unlinkFile($id);
        $picName = array('userProfilePicture' => $picture);
        $this->db->where('userId', $id);
        $this->db->update('users',$picName );

        $this->db->where('userId', $id);
        $query = $this->db->get('users');
        $url = base_url()."assets/userImage/".$query->row()->userProfilePicture;

        return $url;

    }
    public function unlinkFile($id){
        $this->db->where('userId', $id);
        $query = $this->db->get('users');
        $image=$query->row()->userProfilePicture;;
        if($image==null){return;}
        $path="assets/userImage/" . $image;
        unlink($path);
    }

    public function deactivate_entry($id)
    {
        $newStatus = array('isOnline' => 0);
        $this->db->where('member_id', $id);
        $this->db->update('member',$newStatus );

        $query = $this->User_Model->get_user($id,null,null);
        return $query;
    }

    public function activate_entry($email)
    {
        $newStatus = array('isOnline' => 1);
        $this->db->where('email', $email);
        $this->db->update('member',$newStatus );

        $this->db->where('email', $email);
        $query = $this->db->get('member');
        return $query->row();
    }

    public function saveResetToken($token,$email)
    {
        $resetToken = array('userResetToken' => $token);
        $this->db->where('userEmail', $email);
        $this->db->update('users',$resetToken );

        $this->db->where('userEmail', $email);
        $query = $this->db->get('users');

        if($query->row('userProfilePicture')!=null){
            $url = base_url()."assets/userImage/".$query->row()->userProfilePicture;
        }
        else{
            $url = base_url()."assets/img/download.png";
        }

        $encryptToken = $this->jwt->encode(array(
            'resetKey' =>  $query->row()->userResetToken,
            'issuedAt' => date(DATE_ISO8601, strtotime("now")),
            'userName' => $query->row()->firstName." ".$query->row()->lastName,
            'profilePicture'=>$url,
            'userEmail' => $query->row()->userEmail,
            'userId' => $query->row()->userId
        ), $this->config->item("CONSUMER_SECRET"));
        return $encryptToken;

    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }



    function ifExist($email)
    {
        $this->db->where('userEmail', $email);
        $this->db->from('users');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function userExist($id)
    {
        $this->db->where('userId', $id);
        $this->db->from('users');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function checkUser($email, $password)
    {
        $this->db->where('userEmail', $email);
        $query = $this->db->get('users');
        $savedPassword = $query->row()->userPassword;
        //$realPassword = $this->encryption->decrypt($savedPassword);

        if(password_verify($password,$savedPassword)){

            return true;
        }
        return false;
    }

    function checkUserPassword($id, $password)
    {
        $this->db->where('userId', $id);
        $query = $this->db->get('users');
        $savedPassword = $query->row()->userPassword;
        //$realPassword = $this->encrypt->decode($savedPassword);

        if(password_verify($password,$savedPassword)){

            return true;
        }
        return false;
    }

    public function getUserId($email)
    {
        $this->db->where('userEmail', $email);
        $query = $this->db->get('users');

        return $query->row()->userId;
    }

    public function getToken($id)
    {
        $this->db->where('member_id', $id);
        $query = $this->db->get('member');
        if($query->row('profile_image')!=null){
            $url = base_url()."uploads/profile_image/".$id.'/'.$query->row()->profile_image;
        }
        else{
            $url = base_url()."template/front/assets/img/download.png";
        }
        $token = $this->jwt->encode(array(
            'consumerKey' =>  $query->row()->userSecret,
            'issuedAt' => date(DATE_ISO8601, strtotime("now")),
            'userName' => $query->row()->first_name." ".$query->row()->last_name,
            'profilePicture'=>$url,
            'userEmail' => $query->row()->email,
            'userId' => $query->row()->member_id,
            'userType' => 1
        ), $this->config->item("CONSUMER_SECRET"));

        return $token;
    }

    function isValidToken($token)
    {

        try {
            // $value = $this->jwt->decode($token, $this->config->item("CONSUMER_SECRET"));
            // $this->db->where('userSecret', $value->consumerKey);
            // $this->db->from('users');
            $this->db->where('member_id', $token);
            $this->db->from('member');
            if ($this->db->count_all_results() == 0) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            // echo 'Message: ' .$e->getMessage();
            return false;
        }

    }

    function checkResetToken($token)
    {
        try {
            $value = $this->jwt->decode($token, $this->config->item("CONSUMER_SECRET"));
            $this->db->where('userResetToken', $value->resetKey);
            $this->db->from('users');
            if ($this->db->count_all_results() == 0) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            // echo 'Message: ' .$e->getMessage();
            return false;
        }

    }

    function checkVerification($email)
    {
        $this->db->where('userEmail', $email);
        $query = $this->db->get('users');

        if($query->row()->userVerification == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function adminBlock($email){
        $this->db->where('userEmail', $email);
        $query = $this->db->get('users');
        if($query->row()->userVerification == 1 && $query->row()->userStatus==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function verifyEmail($key,$id,$userStatus)
    {
        $verification = array('userVerification' => 1, 'userSecret'=> $key, 'userStatus' => $userStatus);
        $this->db->where('userId', $id);
        $this->db->update('users',$verification );
    }

    function getTokenToId($token)
    {
        // $value = $this->jwt->decode($token, $this->config->item("CONSUMER_SECRET"));
        // $this->db->where('userSecret', $value->consumerKey);
        $this->db->where('member_id', $token);
        $query =$this->db->get('member');
        return (int)$query->row('member_id');
    }

    function getTokenToType($token)
    {
        // $value = $this->jwt->decode($token, $this->config->item("CONSUMER_SECRET"));
        // $this->db->where('userSecret', $value->consumerKey);
        // $query =$this->db->get('users');

        $value = $this->session->userdata('member_id');
        // $this->db->where('userSecret', $value->consumerKey);
        $this->db->where('member_id', $value);
        $query =$this->db->get('member');
        return $query->row('membership');
    }

    function ifInvited($email)
    {
        $this->db->where('userEmail', $email);
        $query = $this->db->get('users');

        if($query->row()->userStatus == 2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getTotalUser(){
        $this->db->select("count(member_id) as total");
        $query = $this->db->get('member');
        return $query->row()->total;
    }

    public function arrayToObject($d){
        if(is_array($d)){
            return (object)array_map(__FUNCTION__,$d);
        }
        else{
            return $d;
        }
    }
}