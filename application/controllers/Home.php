<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

        /*
     *  Developed by: Active IT zone
     *  Date    : 18 September, 2017
     *  Active Matrimony CMS
     *  http://codecanyon.net/user/activeitezone
     */

        function __construct()
        {
            parent::__construct();
			$this->load->helper('string');
            $this->load->library('paypal');
            $this->load->library('pum');
            $this->system_name = $this->Crud_model->get_type_name_by_id('general_settings', '1', 'value');
            $this->system_email = $this->Crud_model->get_type_name_by_id('general_settings', '2', 'value');
            $this->system_title = $this->Crud_model->get_type_name_by_id('general_settings', '3', 'value');
            $cache_time  =  $this->db->get_where('general_settings', array('type' => 'cache_time'))->row()->value;
            if (!$this->input->is_ajax_request()) {
                    $this->output->set_header('HTTP/1.0 200 OK');
                    $this->output->set_header('HTTP/1.1 200 OK');
                    $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
                    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
                    $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
                    $this->output->set_header('Pragma: no-cache');
                    $this->output_cache();
                    if (
                            $this->router->fetch_method() == 'index' ||
                            $this->router->fetch_method() == 'listing' ||
                            $this->router->fetch_method() == 'plans' ||
                            $this->router->fetch_method() == 'stories' ||
                            $this->router->fetch_method() == 'contact_us' ||
                            $this->router->fetch_method() == 'faq' ||
                            $this->router->fetch_method() == 'terms_and_conditions' ||
                            $this->router->fetch_method() == 'privacy_policy' ||
                            $this->router->fetch_method() == 'email_verification_success'
                    ) {
                            $this->output->cache($cache_time);
                    }
            }
			// ---------------------
            //$token = $this->db->where('id',1)->get('paypal_access_token')->row();
            //$expires_in = $token->expires_in;

            //if (time() > $expires_in) {
               // redirect(base_url() . 'PaypalController/generalAccesstoken');
           // }
			//$access_token = $this->db->where('id',1)->get('paypal_access_token')->row();
			//define('PAYPAL_ACCESS_TOKEN',$access_token->access_token);
			
            setcookie('lang', $this->session->userdata('language'), time() + (86400), "/");
        }
	
        private function generateDisplayMember()
        {

                $allMembers = $this->db->get('member')->result();

                foreach ($allMembers as $memberRecord) {
                        $displayMember = strtoupper(substr($memberRecord->first_name, 0, 1)) . strtoupper(substr($memberRecord->last_name, 0, 1)) . $memberRecord->member_id;
                        echo  $displayMember;
                        $this->db->where('member_id', $memberRecord->member_id);
                        $data = array(
                                'display_member' => $displayMember
                        );
                        $this->db->update('member', $data);
                }
                die();
        }

        public function index()
        {
            //echo "string";die();
            if (isset($this->session->userdata['member_id'])) {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    $page_data['social_media'] = $this->db->where('status','enable')->get('social_media_settings')->result();
                    $page_data['title'] = $this->system_title;
                    $page_data['top'] = "home.php";
                    $page_data['page'] = "home";
                    $page_data['bottom'] = "home.php";
                    $page_data['all_genders'] = $this->db->get('gender')->result();
                    $page_data['all_religions'] = $this->db->get('religion')->result();
                    $page_data['all_languages'] = $this->db->get('language')->result();
                    $max_premium_member_num = $this->db->get_where('frontend_settings', array('type' => 'max_premium_member_num'))->row()->value;
                    $max_story_num = $this->db->get_where('frontend_settings', array('type' => 'max_story_num'))->row()->value;
                    // $page_data['premium_members'] = $this->db->query("SELECT * FROM `member` WHERE membership = 2 OR membership = 3 OR membership = 4 AND is_blocked = 'no' AND is_closed = 'no' AND is_deleted = '0' ORDER BY rand() LIMIT $max_premium_member_num")->result();
                    $page_data['premium_members'] = $this->db->query("SELECT * FROM `member` WHERE membership = 2 OR membership = 3 OR membership = 4 AND is_blocked = 'no' AND is_closed = 'no' AND is_deleted = '0' ORDER BY rand() LIMIT 4")->result();
                    $page_data['happy_stories'] = $this->db->get_where('happy_story', array('approval_status' => 1), $max_story_num)->result();
                    $page_data['all_plans'] = $this->db->get("plan")->result();
                    $this->load->view('front/index', $page_data);
                }
            }
            else
            {
                $page_data['social_media'] = $this->db->where('status','enable')->get('social_media_settings')->result();
                $page_data['title'] = $this->system_title;
                $page_data['top'] = "home.php";
                $page_data['page'] = "home";
                $page_data['bottom'] = "home.php";
                $page_data['all_genders'] = $this->db->get('gender')->result();
                $page_data['all_religions'] = $this->db->get('religion')->result();
                $page_data['all_languages'] = $this->db->get('language')->result();
                $max_premium_member_num = $this->db->get_where('frontend_settings', array('type' => 'max_premium_member_num'))->row()->value;
                $max_story_num = $this->db->get_where('frontend_settings', array('type' => 'max_story_num'))->row()->value;
                $page_data['premium_members'] = $this->db->query("SELECT * FROM `member` WHERE membership = 2 OR membership = 3 OR membership = 4 AND is_blocked = 'no' AND is_closed = 'no' AND is_deleted = '0' ORDER BY rand() LIMIT 4")->result();
                $page_data['happy_stories'] = $this->db->get_where('happy_story', array('approval_status' => 1), $max_story_num)->result();
                $page_data['all_plans'] = $this->db->get("plan")->result();
                $this->load->view('front/index', $page_data);
            }
        }

        function member_permission()
        {
                $login_state = $this->session->userdata('login_state');
                if ($login_state == 'yes') {
                        $member_id = $this->session->userdata('member_id');
                        if ($member_id == NULL) {
                                return FALSE;
                        } else {
                                // $this->db->where('member_id', $member_id)->update('member', array('isOnline' => strtotime(date('Y-m-d H:i:s', strtotime('+30 minute')))));
                                $this->db->where('member_id', $member_id)->update('member', array('isOnline' => 1));
                                $this->db->where('member_id', $member_id)->update('member', array('isOnlineTimezone' => gmdate('Y-m-d\TH:i:s.').'000Z'));
                                return TRUE;
                        }
                } else {
                        return FALSE;
                }
        }

        function listing($para1 = "", $para2 = "")
        {
            if (isset($this->session->userdata['member_id'])) 
            {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    if ($para1 == "") {
                        $page_data['title'] = "Listing Page || " . $this->system_title;
                        $page_data['top'] = "listing.php";
                        $page_data['page'] = "listing";
                        $page_data['bottom'] = "listing.php";
                        $page_data['nav_dropdown'] = "all_members";
                        $page_data['home_search'] = "false";

                        $page_data['home_gender'] = "";
                        $page_data['home_religion'] = "";
                        $page_data['home_caste'] = "";
                        $page_data['home_sub_caste'] = "";
                        $page_data['home_language'] = "";
                        $page_data['min_height'] = "";
                        $page_data['max_height'] = "";
                        $page_data['search_member_type'] = "all";
                        recache();
                        $this->load->view('front/index', $page_data);
                    }
                    elseif ($para1 == "home_search") {
                            $page_data['title'] = "Listing Page || " . $this->system_title;
                            $page_data['top'] = "listing.php";
                            $page_data['page'] = "listing";
                            $page_data['bottom'] = "listing.php";
                            $page_data['nav_dropdown'] = "";
                            $page_data['home_search'] = "true";

                            $page_data['home_gender'] = $this->input->post('gender');
                            $page_data['age_range'] = $this->input->post('age_range');
                            $page_data['country'] = $this->input->post('country');

                            $page_data['aged_from'] = $this->input->post('aged_from');
                            $page_data['aged_to'] = $this->input->post('aged_to');
                            $page_data['home_religion'] = $this->input->post('religion');
                            $page_data['home_caste'] = $this->input->post('caste');
                            $page_data['home_sub_caste'] = $this->input->post('sub_caste');
                            $page_data['home_language'] = $this->input->post('language');
                            $page_data['min_height'] = $this->input->post('min_height');
                            $page_data['max_height'] = $this->input->post('max_height');
                            $page_data['profession'] = $this->input->post('profession');
                            $page_data['search_member_type'] = "all";
                            recache();
                            $this->load->view('front/index', $page_data);
                    }
                    elseif ($para1 == "premium_members") {
                            $page_data['title'] = "Premium Members || " . $this->system_title;
                            $page_data['top'] = "listing.php";
                            $page_data['page'] = "listing";
                            $page_data['bottom'] = "listing.php";
                            $page_data['member_type'] = "premium_members";
                            $page_data['nav_dropdown'] = "premium_members";
                            $page_data['home_search'] = "false";

                            $page_data['home_gender'] = "";
                            $page_data['home_religion'] = "";
                            $page_data['home_caste'] = "";
                            $page_data['home_sub_caste'] = "";
                            $page_data['home_language'] = "";
                            $page_data['min_height'] = "";
                            $page_data['max_height'] = "";
                            $page_data['search_member_type'] = "all";
                            recache();
                            $this->load->view('front/index', $page_data);
                    }
                    elseif ($para1 == "free_members") {
                            $page_data['title'] = "Free Members || " . $this->system_title;
                            $page_data['top'] = "listing.php";
                            $page_data['page'] = "listing";
                            $page_data['bottom'] = "listing.php";
                            $page_data['member_type'] = "free_members";
                            $page_data['nav_dropdown'] = "free_members";
                            $page_data['home_search'] = "false";
                            $page_data['home_gender'] = "";
                            $page_data['home_religion'] = "";
                            $page_data['home_caste'] = "";
                            $page_data['home_sub_caste'] = "";
                            $page_data['home_language'] = "";
                            $page_data['min_height'] = "";
                            $page_data['max_height'] = "";
                            $page_data['search_member_type'] = "all";
                            recache();
                            $this->load->view('front/index', $page_data);
                    }
                }
            }
            else
            {
                if ($para1 == "") {
                        $page_data['title'] = "Listing Page || " . $this->system_title;
                        $page_data['top'] = "listing.php";
                        $page_data['page'] = "listing";
                        $page_data['bottom'] = "listing.php";
                        $page_data['nav_dropdown'] = "all_members";
                        $page_data['home_search'] = "false";

                        $page_data['home_gender'] = "";
                        $page_data['home_religion'] = "";
                        $page_data['home_caste'] = "";
                        $page_data['home_sub_caste'] = "";
                        $page_data['home_language'] = "";
                        $page_data['min_height'] = "";
                        $page_data['max_height'] = "";
                        $page_data['search_member_type'] = "all";
                        recache();
                        $this->load->view('front/index', $page_data);
                }
                elseif ($para1 == "home_search") {
                        $page_data['title'] = "Listing Page || " . $this->system_title;
                        $page_data['top'] = "listing.php";
                        $page_data['page'] = "listing";
                        $page_data['bottom'] = "listing.php";
                        $page_data['nav_dropdown'] = "";
                        $page_data['home_search'] = "true";

                        $page_data['home_gender'] = $this->input->post('gender');
                        $page_data['age_range'] = $this->input->post('age_range');
                        $page_data['country'] = $this->input->post('country');

                        $page_data['aged_from'] = $this->input->post('aged_from');
                        $page_data['aged_to'] = $this->input->post('aged_to');
                        $page_data['home_religion'] = $this->input->post('religion');
                        $page_data['home_caste'] = $this->input->post('caste');
                        $page_data['home_sub_caste'] = $this->input->post('sub_caste');
                        $page_data['home_language'] = $this->input->post('language');
                        $page_data['min_height'] = $this->input->post('min_height');
                        $page_data['max_height'] = $this->input->post('max_height');
                        $page_data['profession'] = $this->input->post('profession');
                        $page_data['search_member_type'] = "all";
                        recache();
                        $this->load->view('front/index', $page_data);
                }
                elseif ($para1 == "premium_members") {
                        $page_data['title'] = "Premium Members || " . $this->system_title;
                        $page_data['top'] = "listing.php";
                        $page_data['page'] = "listing";
                        $page_data['bottom'] = "listing.php";
                        $page_data['member_type'] = "premium_members";
                        $page_data['nav_dropdown'] = "premium_members";
                        $page_data['home_search'] = "false";

                        $page_data['home_gender'] = "";
                        $page_data['home_religion'] = "";
                        $page_data['home_caste'] = "";
                        $page_data['home_sub_caste'] = "";
                        $page_data['home_language'] = "";
                        $page_data['min_height'] = "";
                        $page_data['max_height'] = "";
                        $page_data['search_member_type'] = "all";
                        recache();
                        $this->load->view('front/index', $page_data);
                }
                elseif ($para1 == "free_members") {
                        $page_data['title'] = "Free Members || " . $this->system_title;
                        $page_data['top'] = "listing.php";
                        $page_data['page'] = "listing";
                        $page_data['bottom'] = "listing.php";
                        $page_data['member_type'] = "free_members";
                        $page_data['nav_dropdown'] = "free_members";
                        $page_data['home_search'] = "false";
                        $page_data['home_gender'] = "";
                        $page_data['home_religion'] = "";
                        $page_data['home_caste'] = "";
                        $page_data['home_sub_caste'] = "";
                        $page_data['home_language'] = "";
                        $page_data['min_height'] = "";
                        $page_data['max_height'] = "";
                        $page_data['search_member_type'] = "all";
                        recache();
                        $this->load->view('front/index', $page_data);
                }
            }
        }

        function member_profile($para1 = "", $para2 = "")
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                $member_id_user = $this->session->userdata('member_id');
                if ($this->db->get_where("member", array("member_id" => $member_id_user))->row()->is_blocked == 'yes') {
                        $this->session->set_flashdata('alert', 'blocked');

                        redirect(base_url() . 'home/profile', 'refresh');
                } else if ($para1 != "" || $para1 != NULL) {
                        $is_valid = $this->db->get_where("member", array("member_id" => $para1))->row()->member_id;
                        if (!$is_valid) {
                                redirect(base_url() . 'home', 'refresh');
                        }
                        if ($this->db->get_where("member", array("member_id" => $para1))->row()->is_closed == 'yes') {
                                redirect(base_url() . 'home', 'refresh');
                        }
                        $member_id = $this->session->userdata('member_id');
                        $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                        $ignored_ids = json_decode($ignored_ids, true);

                        if (!in_array($para1, $ignored_ids) && $para1 != $member_id) {
								$checkTodayMail = $this->db->where('interest_by',$member_id)
												->where('interest_from',$para1)
												->where('date',date('Y-m-d'))
												->get('interest_mail_details')
												->row();
								if(!isset($checkTodayMail)){
                    				$send = $this->Email_model->send_message_email($para1);
									$upData['interest_by']   = $member_id;
									$upData['interest_from'] = $para1;
									$upData['date']          = date('Y-m-d');
									$this->db->insert('interest_mail_details',$upData);
								}
                                $page_data['title'] = "Member Profile || " . $this->system_title;
                                $page_data['top'] = "profile.php";
                                $page_data['page'] = "member_profile";
                                $page_data['bottom'] = "profile.php";
                                $page_data['social_media'] = $this->db->where('status','enable')->get('social_media_settings')->result();
                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $para1))->result();

                                $this->load->view('front/index', $page_data);
                        } else {
                                redirect(base_url() . 'home/listing', 'refresh');
                        }
                } else {
                        redirect(base_url() . 'home/listing', 'refresh');
                }
        }

    function chat($para1 = "", $para2 = "")
    {

		//echo $para1 .' '. $para2;die();
		
        if ($this->member_permission() == FALSE) {
            redirect(base_url() . 'home/login', 'refresh');
        }
        $member_id_user = $this->session->userdata('member_id');
        if ($this->db->get_where("member", array("member_id" => $member_id_user))->row()->is_blocked == 'yes') {
            $this->session->set_flashdata('alert', 'blocked');

            redirect(base_url() . 'home/profile', 'refresh');
        } else if ($para1 != "" || $para1 != NULL) {
            $is_valid = $this->db->get_where("member", array("member_id" => $para1))->row()->member_id;
            if (!$is_valid) {
                redirect(base_url() . 'home', 'refresh');
            }
            if ($this->db->get_where("member", array("member_id" => $para1))->row()->is_closed == 'yes') {
                redirect(base_url() . 'home', 'refresh');
            }
            $member_id = $this->session->userdata('member_id');
            $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
            $ignored_ids = json_decode($ignored_ids, true);

            if (!in_array($para1, $ignored_ids) && $para1 != $member_id) {

                    // echo "string";die();
                $page_data['title'] = "Member Profile || " . $this->system_title;
                $page_data['top'] = "chat.php";
                $page_data['page'] = "socet_chat";
                $page_data['bottom'] = "chat.php";
                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $para1))->row();
                
                $get_member = $this->db->get_where("member", array("member_id" => $para1))->row();
                $recieve_user = $get_member->member_id;
                $gender_receiver = $get_member->gender;
                $receiver_display_member = $get_member->display_member;
				
                $gender_sender = $this->db->get_where("member", array("member_id" => $member_id_user))->row('gender');
                $sender_display_member = $this->db->get_where("member", array("member_id" => $member_id_user))->row('display_member');
				
                if ($gender_receiver  == $gender_sender) {
                   redirect(base_url() . 'home/listing', 'refresh');
                }
				
                $get_gpr = $this->db
                        ->where('im_group_relation.from_id =', $member_id_user)
                        ->where('im_group_relation.to_id =', $recieve_user)
                        ->get('im_group_relation')->result();

                $get_gpr2 = $this->db
                        ->where("im_group_relation.to_id =", $member_id_user)
                        ->where("im_group_relation.from_id =", $recieve_user)
                        ->get('im_group_relation')->result();
//is_array($get_gpr) || is_array($get_gpr2) && 
                if (count($get_gpr) == 0 && count($get_gpr2) == 0) {

                    $gp['createdBy'] = $member_id_user;
                    $gp['lastActive'] = date('Y-m-d G:i:s');
                    $this->db->insert('im_group',$gp);
                    $insert_id = $this->db->insert_id();

                    $gpm['g_id'] = $insert_id;
                    $gpm['u_id'] = $recieve_user;
                    $gpm['display_member'] = $receiver_display_member;

                    $gpm2['g_id'] = $insert_id;
                    $gpm2['u_id'] = $member_id_user;
                    $gpm2['display_member'] = $sender_display_member;

                    $this->db->insert('im_group_members',$gpm);
                    $this->db->insert('im_group_members',$gpm2);
                    $this->db->insert('im_group_relation',['from_id'=>$member_id_user,'to_id'=>$recieve_user,'g_id'=>$insert_id]);
                    //$this->db->insert('im_message',['sender'=>$member_id_user,'receiver'=>$insert_id]);
					$this->db->insert('im_message',['sender'=>$member_id_user,'receiver'=>$insert_id,'date'=>date('Y-m-d'),'time'=>date("h:i:s"),'date_time'=> date(DATE_ISO8601, time()),'receiver_type'=>'personal']);
                    $m_id = $this->db->insert_id();
                    $this->Email_model->send_message_email($recieve_user);
                    $this->db->insert('im_receiver',['g_id'=>$insert_id,'m_id'=>$m_id,'r_id'=>$recieve_user]);

       
                }



                $page_data["date"]=date('Y-m-d');
                $page_data["formatedDate"]=date('l, M j, Y');

                // echo "<pre>";
                //     print_r($page_data['formatedDate']);
                //     die();
                $this->load->view('front/index', $page_data);
            } else {
                redirect(base_url() . 'home/listing', 'refresh');
            }
        } else {
			$page_data['title'] = "Member Profile || " . $this->system_title;
            $page_data['top'] = "chat.php";
            $page_data['page'] = "socet_chat";
            $page_data['bottom'] = "chat.php";
            $page_data["date"]=date('Y-m-d');
            $page_data["formatedDate"]=date('l, M j, Y');
            $this->load->view('front/index', $page_data);
        }
    }
	
	
	function chatlist($para1 = "", $para2 = "")
    {
   // echo $para1;die();
        if ($this->member_permission() == FALSE) {
            redirect(base_url() . 'home/login', 'refresh');
        }
        $member_id_user = $this->session->userdata('member_id');
        if ($this->db->get_where("member", array("member_id" => $member_id_user))->row()->is_blocked == 'yes') {
            $this->session->set_flashdata('alert', 'blocked');

            redirect(base_url() . 'home/profile', 'refresh');
        } else if ($para1 != "" || $para1 != NULL) {
            $is_valid = $this->db->get_where("member", array("member_id" => $para1))->row()->member_id;
            if (!$is_valid) {
                redirect(base_url() . 'home', 'refresh');
            }
            if ($this->db->get_where("member", array("member_id" => $para1))->row()->is_closed == 'yes') {
                redirect(base_url() . 'home', 'refresh');
            }
            $member_id = $this->session->userdata('member_id');
            $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
            $ignored_ids = json_decode($ignored_ids, true);

            if (!in_array($para1, $ignored_ids) && $para1 != $member_id) {

                    // echo "string";die();
                $page_data['title'] = "Member Profile || " . $this->system_title;
                $page_data['top'] = "chat.php";
                $page_data['page'] = "socet_chat/chat";
                $page_data['bottom'] = "chatlist.php";
                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $para1))->row();
                
                $get_member = $this->db->get_where("member", array("member_id" => $para1))->row();
                $recieve_user = $get_member->member_id;
                $gender_receiver = $get_member->gender;
                $receiver_display_member = $get_member->display_member;
				
                $gender_sender = $this->db->get_where("member", array("member_id" => $member_id_user))->row('gender');
                $sender_display_member = $this->db->get_where("member", array("member_id" => $member_id_user))->row('display_member');
				
                if ($gender_receiver  == $gender_sender) {
                   redirect(base_url() . 'home/listing', 'refresh');
                }
				
                $get_gpr = $this->db
                        ->where('im_group_relation.from_id =', $member_id_user)
                        ->where('im_group_relation.to_id =', $recieve_user)
                        ->get('im_group_relation')->result();

                $get_gpr2 = $this->db
                        ->where("im_group_relation.to_id =", $member_id_user)
                        ->where("im_group_relation.from_id =", $recieve_user)
                        ->get('im_group_relation')->result();
//is_array($get_gpr) || is_array($get_gpr2) && 
                if (count($get_gpr) == 0 && count($get_gpr2) == 0) {

                    $gp['createdBy'] = $member_id_user;
                    $gp['lastActive'] = date('Y-m-d G:i:s');
                    $this->db->insert('im_group',$gp);
                    $insert_id = $this->db->insert_id();

                    $gpm['g_id'] = $insert_id;
                    $gpm['u_id'] = $recieve_user;
                    $gpm['display_member'] = $receiver_display_member;

                    $gpm2['g_id'] = $insert_id;
                    $gpm2['u_id'] = $member_id_user;
                    $gpm2['display_member'] = $sender_display_member;

                    $this->db->insert('im_group_members',$gpm);
                    $this->db->insert('im_group_members',$gpm2);
                    $this->db->insert('im_group_relation',['from_id'=>$member_id_user,'to_id'=>$recieve_user,'g_id'=>$insert_id]);
                    //$this->db->insert('im_message',['sender'=>$member_id_user,'receiver'=>$insert_id]);
					$this->db->insert('im_message',['sender'=>$member_id_user,'receiver'=>$insert_id,'date'=>date('Y-m-d'),'time'=>date("h:i:s"),'date_time'=> date(DATE_ISO8601, time()),'receiver_type'=>'personal']);
                    $m_id = $this->db->insert_id();
                    $this->Email_model->send_message_email($recieve_user);
                    $this->db->insert('im_receiver',['g_id'=>$insert_id,'m_id'=>$m_id,'r_id'=>$recieve_user]);

       
                }



                $page_data["date"]=date('Y-m-d');
                $page_data["formatedDate"]=date('l, M j, Y');
//print_r($page_data['get_member']);die();
                // echo "<pre>";
                //     print_r($page_data['formatedDate']);
                //     die();
                $this->load->view('front/index', $page_data);
            } else {
                redirect(base_url() . 'home/listing', 'refresh');
            }
        } else {
			$page_data['title'] = "Member Profile || " . $this->system_title;
			
            $page_data['top'] = "chat.php";
            $page_data['page'] = "socet_chat/chat";
            $page_data['bottom'] = "chatlist.php";
            $page_data["date"]=date('Y-m-d');
            $page_data["formatedDate"]=date('l, M j, Y');
            $this->load->view('front/index', $page_data);
        }
    }

        function ajax_member_list($para1 = "", $para2 = "")
        {
                $this->load->library('Ajax_pagination');

                $config_base_url = base_url() . 'home/ajax_member_list/';
                if ($para2 == "free_members") {
                        if ($this->member_permission() == FALSE) {
                                $config['total_rows'] = $this->db->get_where('member', array('membership' => 1, 'is_blocked' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->num_rows();
                        } elseif ($this->member_permission() == TRUE) {
                                $member_id = $this->session->userdata('member_id');
                                //For Ignored Members
                                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                                $ignored_ids = json_decode($ignored_ids, true);
                                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                                $ignored_by_ids = json_decode($ignored_by_ids, true);
                                if (empty($ignored_by_ids)) {
                                        array_push($ignored_by_ids, 0);
                                }
                                if (!empty($ignored_ids)) {
                                        $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('membership' => 1, 'member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->num_rows();
                                } else {
                                        $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('membership' => 1, 'member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->num_rows();
                                }
                        }
                }
                elseif ($para2 == "premium_members") {
                        if ($this->member_permission() == FALSE) {
                                $config['total_rows'] = $this->db->get_where('member', array('membership' => 2, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->num_rows();
                        } elseif ($this->member_permission() == TRUE) {
                                $member_id = $this->session->userdata('member_id');
                                //For Ignored Members
                                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                                $ignored_ids = json_decode($ignored_ids, true);
                                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                                $ignored_by_ids = json_decode($ignored_by_ids, true);
                                if (empty($ignored_by_ids)) {
                                        array_push($ignored_by_ids, 0);
                                }
                                if (!empty($ignored_ids)) {
                                        $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('membership' => 2, 'member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->num_rows();
                                } else {
                                        $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('membership' => 2, 'member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->num_rows();
                                }
                        }
                }
                elseif ($para2 == "search") {
                        $config_base_url = base_url() . 'home/ajax_member_list/search/';
                        $all_result = array();
                        if ($this->member_permission() == FALSE) {
                                $cond = array('is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2);
                                $all_id = $this->db->order_by('membership', 'DESC')->select('member_id')->where($cond)->get('member')->result();
                        } elseif ($this->member_permission() == TRUE) {
                                $member_id = $this->session->userdata('member_id');
                                //For Ignored Members
                                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                                $ignored_ids = json_decode($ignored_ids, true);
                                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                                $ignored_by_ids = json_decode($ignored_by_ids, true);
                                if (empty($ignored_by_ids)) {
                                        array_push($ignored_by_ids, 0);
                                }
                                if (!empty($ignored_ids)) {
                                        $this->db->order_by('membership', 'DESC');
                                        $all_id = $this->db->select('member_id')->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->result();

                                } else {
                                        $all_id = $this->db->select('member_id')->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->result();
                                }
                        }
                        foreach ($all_id as $row) {
                            $all_result[] = $row->member_id;
                        }
                        $gender   = $this->input->post('gender');
                        $member_profile_id   = $this->input->post('member_id');
                        $marital_status = $this->input->post('marital_status');
                        $religion = $this->input->post('religion');
                        $caste    = $this->input->post('caste');
                        $sub_caste = $this->input->post('sub_caste');
                        $language = $this->input->post('language');
                        $country  = $this->input->post('country');
                        $state    = $this->input->post('state');
                        $city     = $this->input->post('city');
                        $profession     = $this->input->post('profession');
                        $education     = $this->input->post('education');
                        $sect     = $this->input->post('sect');
                        $age_range     = $this->input->post('age_range');


                        if (!empty($age_range)) {
                                $by_age_range = $this->db->select('name')->get_where('age_range', array('age_range_id' => $age_range))->result();
                                foreach ($by_age_range as $by_age_range) {
                                        $age_range = $by_age_range->name;
                                        $aged_from = substr($age_range, 0, 2);
                                        $aged_to = substr($age_range, strpos($age_range, " to ") + 4, 2);
                                }
                        }
                        if (!empty($aged_from)) {
                                $from_year = date('Y') - ($aged_from - 1);
                                $from_date = $from_year . "-01-01";
                                $sql_aged_from = strtotime($from_date);
                        }
                        if (!empty($aged_to)) {
                                $to_year = date('Y') - $aged_to;
                                $to_date = $to_year . "-01-01";
                                $sql_aged_to = strtotime($to_date);
                        }

                        $min_height = $this->input->post('min_height');
                        $max_height = $this->input->post('max_height');
                        $search_member_type = $this->input->post('search_member_type');


                        $by_gender = array();
                        $by_member_profile_id = array();
                        $by_marital_status = array();
                        $by_religion = array();
                        $by_caste = array();
                        $by_sub_caste = array();
                        $by_language = array();
                        $by_country = array();
                        $by_state = array();
                        $by_city = array();
                        $by_profession = array();
                        $by_education = array();
                        $by_sect = array();
                        $by_age = array();
                        $by_height = array();
                        $by_member_type = array();

                        $all_array = array();

                        if (isset($gender) && $gender != "") {
                                $by_genders = $this->db->select('member_id')->get_where('member', array('gender' => $gender))->result();
                                foreach ($by_genders as $by_genders) {
                                        $by_gender[] = $by_genders->member_id;
                                }
                        } else {
                                $by_gender = $all_result;
                        }

                        if (isset($member_profile_id) && $member_profile_id != "") {
                                $by_member_profile_ids = $this->db->select('member_id')->get_where('member', array('display_member' => $member_profile_id))->result();
                                foreach ($by_member_profile_ids as $by_member_profile_ids) {
                                        $by_member_profile_id[] = $by_member_profile_ids->member_id;
                                }
                        } else {
                                $by_member_profile_id = $all_result;
                        }

                        if (isset($profession) && $profession != "") {
                                $this->db->select('member_id')->like('basic_info', '"profession":"' . $profession . '"', 'both');
                                $by_professions = $this->db->get('member')->result();
                                foreach ($by_professions as $by_professions) {
                                        $by_profession[] = $by_professions->member_id;
                                }
                        } else {
                                $by_profession = $all_result;
                        }

                        if (isset($education) && $education  != "") {
                                $this->db->select('member_id')->like('education_and_career', '"highest_education":"' . $education . '"', 'both');
                                $by_educations = $this->db->get('member')->result();
                                foreach ($by_educations as $by_educations) {
                                        $by_education[] = $by_educations->member_id;
                                }
                        } else {
                                $by_education = $all_result;
                        }

                        if (isset($sect) && $sect  != "") {
                                $this->db->select('member_id')->like('basic_info', '"my_sect":"' . $sect . '"', 'both');
                                $by_sects = $this->db->get('member')->result();
                                foreach ($by_sects as $by_sects) {
                                        $by_sect[] = $by_sects->member_id;
                                }
                        } else {
                                $by_sect = $all_result;
                        }

                        if (isset($marital_status) && $marital_status != "") {
                                $this->db->select('member_id')->like('basic_info', '"marital_status":"' . $marital_status . '"', 'both');
                                $by_marital_statuss = $this->db->get('member')->result();
                                foreach ($by_marital_statuss as $by_marital_statuss) {
                                        $by_marital_status[] = $by_marital_statuss->member_id;
                                }
                        } else {
                                $by_marital_status = $all_result;
                        }

                        if (isset($religion) && $religion != "") {
                                $this->db->select('member_id')->like('spiritual_and_social_background', '"religion":"' . $religion . '"', 'both');
                                $by_religions = $this->db->get('member')->result();
                                foreach ($by_religions as $by_religions) {
                                        $by_religion[] = $by_religions->member_id;
                                }
                        } else {
                                $by_religion = $all_result;
                        }

                        if (isset($caste) && $caste != "") {
                                $this->db->select('member_id')->like('spiritual_and_social_background', '"caste":"' . $caste . '"', 'both');
                                $by_castes = $this->db->get('member')->result();
                                foreach ($by_castes as $by_castes) {
                                        $by_caste[] = $by_castes->member_id;
                                }
                        } else {
                                $by_caste = $all_result;
                        }

                        if (isset($sub_caste) && $sub_caste != "") {
                                $this->db->select('member_id')->like('present_address', '"sub_caste":"' . $sub_caste . '"', 'both');
                                $by_sub_caste = $this->db->get('member')->result();
                                foreach ($by_sub_caste as $by_sub_caste) {
                                        $by_sub_caste[] = $by_sub_caste->member_id;
                                }
                        } else {
                                $by_sub_caste = $all_result;
                        }

                        if (isset($language) && $language != "") {
                                $this->db->select('member_id')->like('language', '"mother_tongue":"' . $language . '"', 'both');
                                $by_languages = $this->db->get('member')->result();
                                foreach ($by_languages as $by_languages) {
                                        $by_language[] = $by_languages->member_id;
                                }
                        } else {
                                $by_language = $all_result;
                        }

                        if (isset($country) && $country != "") {
                                $this->db->select('member_id')->like('basic_info', '"residence":"' . $country . '"', 'both');
                                $by_countries = $this->db->get('member')->result();
                                foreach ($by_countries as $by_countries) {
                                        $by_country[] = $by_countries->member_id;
                                }
                        } else {
                                $by_country = $all_result;
                        }

                        if (isset($state) && $state != "") {
                                $this->db->select('member_id')->like('present_address', '"state":"' . $state . '"', 'both');
                                $by_states = $this->db->get('member')->result();
                                foreach ($by_states as $by_states) {
                                        $by_state[] = $by_states->member_id;
                                }
                        } else {
                                $by_state = $all_result;
                        }

                        if (isset($city) && $city != "") {
                                $this->db->select('member_id')->like('present_address', '"city":"' . $city . '"', 'both');
                                $by_cities = $this->db->get('member')->result();
                                foreach ($by_cities as $by_cities) {
                                        $by_city[] = $by_cities->member_id;
                                }
                        } else {
                                $by_city = $all_result;
                        }

                        if (isset($sql_aged_from) && isset($sql_aged_to)) {

                                $by_ages = $this->db->select('member_id')->get_where('member', array('date_of_birth <=' => $sql_aged_from, 'date_of_birth >=' => $sql_aged_to))->result();
                                foreach ($by_ages as $by_ages) {
                                        $by_age[] = $by_ages->member_id;
                                }
                        } else {
                                $by_age = $all_result;
                        }

                        if (isset($min_height) && isset($max_height)) {
                                $by_heights = $this->db->select('member_id')->get_where('member', array('height >=' => $min_height, 'height <=' => $max_height))->result();
                                foreach ($by_heights as $by_heights) {
                                        $by_height[] = $by_heights->member_id;
                                }
                        } else {
                                $by_height = $all_result;
                        }

                        if (isset($search_member_type)) {
                                if ($search_member_type == "free_members") {
                                        $by_members_type = $this->db->select('member_id')->get_where('member', array('membership' => 1))->result();
                                } elseif ($search_member_type == "premium_members") {
                                        $by_members_type = $this->db->select('member_id')->get_where('member', array('membership' => 2))->result();
                                } elseif ($search_member_type == "all") {
                                        $by_members_type = $all_id;
                                }
                                foreach ($by_members_type as $by_members_type) {
                                        $by_member_type[] = $by_members_type->member_id;
                                }
                        } else {
                                $by_members_type = $all_id;
                        }

                        $all_array = array_intersect($by_gender, $by_member_profile_id, $by_marital_status, $by_profession, $by_education, $by_sect, $by_religion, $by_caste, $by_sub_caste, $by_language, $by_country, $by_state, $by_city, $by_age, $by_height, $by_member_type);

                        $config['total_rows'] = count($all_array);
                } elseif ($para2 == "") {
                        if ($this->member_permission() == FALSE) {
                                $cond = array('is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2);
                                $config['total_rows'] = $this->db->where($cond)->count_all_results('member');
                        } elseif ($this->member_permission() == TRUE) {
                                $member_id = $this->session->userdata('member_id');
                                //For Ignored Members
                                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                                $ignored_ids = json_decode($ignored_ids, true);
                                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                                $ignored_by_ids = json_decode($ignored_by_ids, true);
                                if (empty($ignored_by_ids)) {
                                        array_push($ignored_by_ids, 0);
                                }
                                if (!empty($ignored_ids)) {
                                    $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->num_rows();
                                } else {
                                    $config['total_rows'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->num_rows();
                                }
                        }
                }

                // pagination

                $config['base_url'] = $config_base_url;
                $config['per_page'] = 12;
                $config['uri_segment'] = 5;
                $config['cur_page_giv'] = $para1;
                if ($para2 == "search") {
                        $function = "filter_members('0', 'search')";
                } else {
                        $function = "filter_members('0')";
                }
                $config['first_link'] = '&laquo;';
                $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['first_tag_close'] = '</a></li>';

                $rr = ($config['total_rows'] - 1) / $config['per_page'];

                $last_start = floor($rr) * $config['per_page'];
                if ($para2 == "search") {
                        $function = "filter_members('" . $last_start . "', 'search')";
                } else {
                        $function = "filter_members('" . $last_start . "')";
                }
                $config['last_link'] = '&raquo;';
                $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['last_tag_close'] = '</a></li>';

                if ($para2 == "search") {
                        $function = "filter_members('" . ($para1 - $config['per_page']) . "', 'search')";

                } else {
                        $function = "filter_members('" . ($para1 - $config['per_page']) . "')";
                }
                $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['prev_tag_close'] = '</a></li>';

                if ($para2 == "search") {
                        $function = "filter_members('" . ($para1 + $config['per_page']) . "', 'search')";
                } else {
                        $function = "filter_members('" . ($para1 - $config['per_page']) . "')";
                }

                $config['next_link'] = '>';
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['next_tag_close'] = '</a></li>';

                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';

                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

                if ($para2 == "search") {
                        $function = "filter_members(((this.innerHTML-1)*" . $config['per_page'] . "), 'search')";
                } else {
                        $function = "filter_members(((this.innerHTML-1)*" . $config['per_page'] . "))";
                }
                $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['num_tag_close'] = '</a></li>';
                $this->ajax_pagination->initialize($config);

                if ($para2 == "free_members") {
                        if ($this->member_permission() == FALSE) {
                                $page_data['get_all_members'] = $this->db->get_where('member', array('membership' => 1, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2), $config['per_page'], $para1)->result();
                        } elseif ($this->member_permission() == TRUE) {
                                $member_id = $this->session->userdata('member_id');
                                //For Ignored Members
                                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                                $ignored_ids = json_decode($ignored_ids, true);
                                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                                $ignored_by_ids = json_decode($ignored_by_ids, true);
                                if (empty($ignored_by_ids)) {
                                        array_push($ignored_by_ids, 0);
                                }
                                if (!empty($ignored_ids)) {
                                        $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('membership' => 1, 'member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2), $config['per_page'], $para1)->result();
                                } else {
                                        $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('membership' => 1, 'member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2), $config['per_page'], $para1)->result();
                                }
                        }
                } elseif ($para2 == "premium_members") {
                        if ($this->member_permission() == FALSE) {
                                $page_data['get_all_members'] = $this->db->get_where('member', array('membership' => 2, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2), $config['per_page'], $para1)->result();
                        } elseif ($this->member_permission() == TRUE) {
                                $member_id = $this->session->userdata('member_id');
                                //For Ignored Members
                                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                                $ignored_ids = json_decode($ignored_ids, true);
                                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                                $ignored_by_ids = json_decode($ignored_by_ids, true);
                                if (empty($ignored_by_ids)) {
                                        array_push($ignored_by_ids, 0);
                                }
                                if (!empty($ignored_ids)) {
                                        $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('membership' => 2, 'member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2), $config['per_page'], $para1)->result();
                                } else {
                                        $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('membership' => 2, 'member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2), $config['per_page'], $para1)->result();
                                }
                        }
                } elseif ($para2 == "search") {
                        $all_result = array();
                        if ($this->member_permission() == FALSE) {
                                $cond = array('is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2);
                                $this->db->order_by('membership', 'DESC');
                                $all_id = $this->db->select('member_id')->where($cond)->get('member')->result();
                        } elseif ($this->member_permission() == TRUE) {
                                $member_id = $this->session->userdata('member_id');
                                //For Ignored Members
                                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                                $ignored_ids = json_decode($ignored_ids, true);
                                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                                $ignored_by_ids = json_decode($ignored_by_ids, true);
                                if (empty($ignored_by_ids)) {
                                        array_push($ignored_by_ids, 0);
                                }
                                if (!empty($ignored_ids)) {
                                        $this->db->order_by('membership', 'DESC');
                                        $all_id = $this->db->select('member_id')->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->result();

                                } else {
                                        $this->db->order_by('membership', 'DESC');
                                        $all_id = $this->db->select('member_id')->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2))->result();
                                }
                        }
                        foreach ($all_id as $row) {
                                $all_result[] = $row->member_id;
                        }

                        if (isset($gender) && $gender != "") {
                                $by_genders = $this->db->select('member_id')->get_where('member', array('gender' => $gender))->result();
                                foreach ($by_genders as $by_genders) {
                                        $by_gender[] = $by_genders->member_id;
                                }
                        } else {
                                $by_gender = $all_result;
                        }

                        if (isset($member_profile_id) && $member_profile_id != "") {
                                $by_member_profile_ids = $this->db->select('member_id')->get_where('member', array('member_profile_id' => $member_profile_id))->result();
                                foreach ($by_member_profile_ids as $by_member_profile_ids) {
                                        $by_member_profile_id[] = $by_member_profile_ids->member_id;
                                }
                        } else {
                                $by_member_profile_id = $all_result;
                        }

                        if (isset($marital_status) && $marital_status != "") {
                                $this->db->select('member_id')->like('education_and_career', '"marital_status":"' . $marital_status . '"', 'both');
                                $by_marital_statuss = $this->db->get('member')->result();
                                foreach ($by_marital_statuss as $by_marital_statuss) {
                                        $by_marital_status[] = $by_marital_statuss->member_id;
                                }
                        } else {
                                $by_marital_status = $all_result;
                        }

                        if (isset($profession) && $profession != "") {
                                $this->db->select('member_id')->like('basic_info', '"profession":"' . $profession . '"', 'both');
                                $by_professions = $this->db->get('member')->result();
                                foreach ($by_professions as $by_professions) {
                                        $by_profession[] = $by_professions->member_id;
                                }
                        } else {
                                $by_profession = $all_result;
                        }

                        if (isset($education) && $education  != "") {
                                $this->db->select('member_id')->like('education_and_career', '"highest_education":"' . $education . '"', 'both');
                                $by_educations = $this->db->get('member')->result();
                                foreach ($by_educations as $by_educations) {
                                        $by_education[] = $by_educations->member_id;
                                }
                        } else {
                                $by_education = $all_result;
                        }
                        if (isset($sect) && $sect  != "") {
                                $this->db->select('member_id')->like('basic_info', '"my_sect":"' . $education . '"', 'both');
                                $by_sects = $this->db->get('member')->result();
                                foreach ($by_sects as $by_sects) {
                                        $by_sect[] = $by_sects->member_id;
                                }
                        } else {
                                $by_sect = $all_result;
                        }

                        if (isset($religion) && $religion != "") {
                                $this->db->select('member_id')->like('spiritual_and_social_background', '"religion":"' . $religion . '"', 'both');
                                $by_religions = $this->db->get('member')->result();
                                foreach ($by_religions as $by_religions) {
                                        $by_religion[] = $by_religions->member_id;
                                }
                        } else {
                                $by_religion = $all_result;
                        }

                        if (isset($caste) && $caste != "") {
                                $this->db->select('member_id')->like('spiritual_and_social_background', '"caste":"' . $caste . '"', 'both');
                                $by_castes = $this->db->get('member')->result();
                                foreach ($by_castes as $by_castes) {
                                        $by_caste[] = $by_castes->member_id;
                                }
                        } else {
                                $by_caste = $all_result;
                        }
                        if (isset($sub_caste) && $sub_caste != "") {
                                $this->db->select('member_id')->like('spiritual_and_social_background', '"sub_caste":"' . $sub_caste . '"', 'both');
                                $by_sub_castes = $this->db->get('member')->result();
                                foreach ($by_sub_castes as $by_sub_castes) {
                                        $by_sub_caste[] = $by_sub_castes->member_id;
                                }
                        } else {
                                $by_sub_caste = $all_result;
                        }

                        if (isset($language) && $language != "") {
                                $this->db->select('member_id')->like('language', '"mother_tongue":"' . $language . '"', 'both');
                                $by_languages = $this->db->get('member')->result();
                                foreach ($by_languages as $by_languages) {
                                        $by_language[] = $by_languages->member_id;
                                }
                        } else {
                                $by_language = $all_result;
                        }

                        if (isset($country) && $country != "") {
                                $this->db->select('member_id')->like('basic_info', '"residence":"' . $country . '"', 'both');
                                $by_countries = $this->db->get('member')->result();
                                foreach ($by_countries as $by_countries) {
                                        $by_country[] = $by_countries->member_id;
                                }
                        } else {
                                $by_country = $all_result;
                        }

                        if (isset($state) && $state != "") {
                                $this->db->select('member_id')->like('present_address', '"state":"' . $state . '"', 'both');
                                $by_states = $this->db->get('member')->result();
                                foreach ($by_states as $by_states) {
                                        $by_state[] = $by_states->member_id;
                                }
                        } else {
                                $by_state = $all_result;
                        }

                        if (isset($city) && $city != "") {
                                $this->db->select('member_id')->like('present_address', '"city":"' . $city . '"', 'both');
                                $by_cities = $this->db->get('member')->result();
                                foreach ($by_cities as $by_cities) {
                                        $by_city[] = $by_cities->member_id;
                                }
                        } else {
                                $by_city = $all_result;
                        }

                        if (isset($sql_aged_from) && isset($sql_aged_to)) {
                                $by_ages = $this->db->select('member_id')->get_where('member', array('date_of_birth <=' => $sql_aged_from, 'date_of_birth >=' => $sql_aged_to))->result();
                                foreach ($by_ages as $by_ages) {
                                        $by_age[] = $by_ages->member_id;
                                }
                        } else {
                                $by_age = $all_result;
                        }

                        if (isset($min_height) && isset($max_height)) {
                                $by_heights = $this->db->select('member_id')->get_where('member', array('height >=' => $min_height, 'height <=' => $max_height))->result();
                                foreach ($by_heights as $by_heights) {
                                        $by_height[] = $by_heights->member_id;
                                }
                        } else {
                                $by_height = $all_result;
                        }

                        if (isset($search_member_type)) {
                                if ($search_member_type == "free_members") {
                                        $by_members_type = $this->db->select('member_id')->get_where('member', array('membership' => 1))->result();
                                } elseif ($search_member_type == "premium_members") {
                                        $by_members_type = $this->db->select('member_id')->get_where('member', array('membership' => 2))->result();
                                } elseif ($search_member_type == "all") {
                                        $by_members_type = $all_id;
                                }
                                foreach ($by_members_type as $by_members_type) {
                                        $by_member_type[] = $by_members_type->member_id;
                                }
                        } else {
                                $by_members_type = "all";
                        }

                        $all_array = array_intersect($by_gender, $by_member_profile_id, $by_profession, $by_education, $by_sect, $by_marital_status, $by_religion, $by_caste, $by_sub_caste, $by_language, $by_country, $by_state, $by_city, $by_age, $by_height, $by_member_type);

                        if (count($all_array) != 0) {
                                $this->db->where_in('member_id', $all_array);
                                $cond = array('is_blocked' => 'no', 'is_closed' => 'no', 'hide_profile' => 2);
                                $page_data['get_all_members'] = $this->db->order_by('membership', 'DESC')->where($cond)->get('member', $config['per_page'], $para1)->result();
                        } else {
                                $page_data['get_all_members']  = array();
                        }
                } elseif ($para2 == "") {
                        if ($this->member_permission() == FALSE) {
                                $cond = array('is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2);
                                $page_data['get_all_members'] = $this->db->order_by('membership', 'DESC')->where($cond)->get('member', $config['per_page'], $para1)->result();
                        } elseif ($this->member_permission() == TRUE) {
                                $member_id = $this->session->userdata('member_id');
                                //For Ignored Members
                                $ignored_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
                                $ignored_ids = json_decode($ignored_ids, true);
                                $ignored_by_ids = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                                $ignored_by_ids = json_decode($ignored_by_ids, true);
                                if (empty($ignored_by_ids)) {
                                        array_push($ignored_by_ids, 0);
                                }
                                if (!empty($ignored_ids)) {
                                        $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_ids)->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2), $config['per_page'], $para1)->result();
                                } else {
                                        $page_data['get_all_members'] = $this->db->where_not_in('member_id', $ignored_by_ids)->get_where('member', array('member_id !=' => $member_id, 'is_blocked' => 'no', 'is_closed' => 'no', 'is_deleted' => '0', 'hide_profile' => 2), $config['per_page'], $para1)->result();
                                }
                        }
                }

                $page_data['count'] = $config['total_rows'];

                $this->load->view('front/listing/members', $page_data);
        }

        function top_bar_right()
        {
            $this->load->view('front/header/top_bar_right');
        }

        function safety_tips()
        {
            if (isset($this->session->userdata['member_id'])) 
            {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    $page_data['title'] = "Safety Tips || " . $this->system_title;
                    $page_data['top'] = "safety_tips.php";
                    $page_data['page'] = "Safety_Tips";
                    $page_data['bottom'] = "safety_tips.php";

                    $this->load->view('front/index', $page_data);
                }
            }
            else
            {
                $page_data['title'] = "Safety Tips || " . $this->system_title;
                $page_data['top'] = "safety_tips.php";
                $page_data['page'] = "Safety_Tips";
                $page_data['bottom'] = "safety_tips.php";

                $this->load->view('front/index', $page_data);
            }
        }
        function effective_communication()
        {
            if (isset($this->session->userdata['member_id'])) 
            {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    $page_data['title'] = "Effective Communication || " . $this->system_title;
                    $page_data['top'] = "effective_communication.php";
                    $page_data['page'] = "effective_communication";
                    $page_data['bottom'] = "effective_communication.php";
                    $page_data['effective'] = $this->db->get_where('general_settings', array('type' => 'privacy_policy'))->row()->value;

                    $this->load->view('front/index', $page_data);
                }
            }
            else
            {
                $page_data['title'] = "Effective Communication || " . $this->system_title;
                $page_data['top'] = "effective_communication.php";
                $page_data['page'] = "effective_communication";
                $page_data['bottom'] = "effective_communication.php";
                $page_data['effective'] = $this->db->get_where('general_settings', array('type' => 'privacy_policy'))->row()->value;

                $this->load->view('front/index', $page_data);
            }
        }
        function honesty()
        {
            if (isset($this->session->userdata['member_id'])) 
            {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    $page_data['title'] = "Honesty Is The Best Policy || " . $this->system_title;
                    $page_data['top'] = "honesty.php";
                    $page_data['page'] = "honesty";
                    $page_data['bottom'] = "honesty.php";

                    $this->load->view('front/index', $page_data);
                }
            }
            else
            {
                $page_data['title'] = "Honesty Is The Best Policy || " . $this->system_title;
                $page_data['top'] = "honesty.php";
                $page_data['page'] = "honesty";
                $page_data['bottom'] = "honesty.php";

                $this->load->view('front/index', $page_data);
            }
        }
        function add_interest($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                $member = $this->session->userdata('member_id');
                $express_interest = $this->Crud_model->get_type_name_by_id('member', $member, 'express_interest');
                if ($express_interest > 0) {
                        $interests = $this->Crud_model->get_type_name_by_id('member', $member, 'interest');
                        $interest = json_decode($interests, true);
                        if (empty($interest)) {
                                $interest = array();
                                $interest[] = array('id' => $member_id, 'status' => 'pending', 'time' => time());
                        }
                        if (!in_assoc_array($member_id, 'id', $interest)) {
                                $interest[] = array('id' => $member_id, 'status' => 'pending', 'time' => time());
                        }
                        $this->db->where('member_id', $member);
                        $this->db->update('member', array('interest' => json_encode($interest)));

                        // Subtracting a Remaining Interest
                        $express_interest = $express_interest - 1;
                        $this->db->where('member_id', $member);
                        $this->db->update('member', array('express_interest' => $express_interest));
                        recache();

                        // Updating the interest into the chosen Member
                        $member_interests = $this->Crud_model->get_type_name_by_id('member', $member_id, 'interested_by');
                        $member_interest = json_decode($member_interests, true);

                        $notifications = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
                        $notification = json_decode($notifications, true);

                        if (empty($member_interest)) {
                                $member_interest = array();
                                $member_interest[] = array('id' => $member, 'status' => 'pending', 'time' => time());
                                $notification[] = array('by' => $member, 'type' => 'interest_expressed', 'status' => 'pending', 'is_seen' => 'no', 'time' => time());
                        }
                        if (!in_assoc_array($member, 'id', $member_interest)) {
                                $member_interest[] = array('id' => $member, 'status' => 'pending', 'time' => time());
                                $notification[] = array('by' => $member, 'type' => 'interest_expressed', 'status' => 'pending', 'is_seen' => 'no', 'time' => time());
                        }

                        $this->db->where('member_id', $member_id);
                        $this->db->update('member', array('interested_by' => json_encode($member_interest), 'notifications' => json_encode($notification)));
                        recache();
                }
        }

        function accept_interest($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }

                $member = $this->session->userdata('member_id');
                // For Updating User's interested_by
                $interested_by = $this->Crud_model->get_type_name_by_id('member', $member, 'interested_by');
                $interested_by = json_decode($interested_by, true);
                $new_interested_by = array();
                if (!empty($interested_by)) {
                        foreach ($interested_by as $value1) {
                                // print_r($value1)."<br>";
                                if ($value1['id'] != $member_id) {
                                        array_push($new_interested_by, $value1);
                                } elseif ($value1['id'] == $member_id) {
                                        array_push($new_interested_by, array('id' => $value1['id'], 'status' => 'accepted', 'time' => time()));
                                }
                                // print_r($new_interested_by)."<br>";
                        }
                }
                // For Updating User's notifications
                $user_notifications = $this->Crud_model->get_type_name_by_id('member', $member, 'notifications');
                $user_notifications = json_decode($user_notifications, true);
                $new_user_notification = array();
                if (empty($user_notifications)) {
                        // print_r($user_notifications)."<br>";
                        array_push($new_user_notification, array('by' => $member_id, 'type' => 'accepted_interest', 'status' => 'accepted', 'is_seen' => 'no', 'time' => time()));
                        // print_r($new_user_notification);
                }
                if (!empty($user_notifications)) {
                        foreach ($user_notifications as $value2) {
                                // print_r($value2)."<br>";
                                if ($value2['by'] != $member_id) {
                                        array_push($new_user_notification, $value2);
                                } elseif ($value2['by'] == $member_id) {
                                        array_push($new_user_notification, array('by' => $value2['by'], 'type' => 'interest_expressed', 'status' => 'accepted', 'is_seen' => 'no', 'time' => time()));
                                }
                                // print_r($new_user_notification);
                        }
                }
                $this->db->where('member_id', $member);
                $this->db->update('member', array('interested_by' => json_encode($new_interested_by), 'notifications' => json_encode($new_user_notification)));

                // For Updating Member's interest
                $interest = $this->Crud_model->get_type_name_by_id('member', $member_id, 'interest');
                $interest = json_decode($interest, true);
                $new_interest = array();
                if (!empty($interest)) {
                        foreach ($interest as $value3) {
                                // print_r($value3)."<br>";
                                if ($value3['id'] != $member) {
                                        array_push($new_interest, $value3);
                                } elseif ($value3['id'] == $member) {
                                        array_push($new_interest, array('id' => $value3['id'], 'status' => 'accepted', 'is_seen' => 'no', 'time' => time()));
                                }
                                // print_r($new_interest)."<br>";
                        }
                }
                // For Updating Member's notifications
                $member_notifications = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
                $member_notifications = json_decode($member_notifications, true);
                // print_r($member_notifications)."<br>";
                array_push($member_notifications, array('by' => $member, 'type' => 'accepted_interest', 'status' => 'accepted', 'is_seen' => 'no', 'time' => time()));
                // print_r($member_notifications);

                $this->db->where('member_id', $member_id);
                $this->db->update('member', array('interest' => json_encode($new_interest), 'notifications' => json_encode($member_notifications)));
                recache();
                $aa = $this->db->get_where('message_thread', array('message_thread_from' => $member_id, 'message_thread_to' => $member))->num_rows() > 0 ? false : true;
                $bb = $this->db->get_where('message_thread', array('message_thread_from' => $member, 'message_thread_to' => $member_id))->num_rows() > 0 ? false : true;
                if ($aa && $bb) {
                        $this->enable_message($member_id);
                }
        }

        function reject_interest($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }

                $member = $this->session->userdata('member_id');
                // For Updating User's interested_by
                $interested_by = $this->Crud_model->get_type_name_by_id('member', $member, 'interested_by');
                $interested_by = json_decode($interested_by, true);
                $new_interested_by = array();
                if (!empty($interested_by)) {
                        foreach ($interested_by as $value1) {
                                // print_r($value1)."<br>";
                                if ($value1['id'] != $member_id) {
                                        array_push($new_interested_by, $value1);
                                }
                                /*elseif ($value1['id'] == $member_id) {
                    array_push($new_interested_by, array('id'=>$value1['id'], 'status'=>'rejected', 'time'=>time()));
                }*/
                                // print_r($new_interested_by)."<br>";
                        }
                }
                // For Updating User's notifications
                $user_notifications = $this->Crud_model->get_type_name_by_id('member', $member, 'notifications');
                $user_notifications = json_decode($user_notifications, true);
                $new_user_notification = array();
                if (empty($user_notifications)) {
                        // print_r($user_notifications)."<br>";
                        array_push($new_user_notification, array('by' => $member_id, 'type' => 'rejected_interest', 'status' => 'rejected', 'is_seen' => 'no', 'time' => time()));
                        // print_r($new_user_notification);
                }
                if (!empty($user_notifications)) {
                        foreach ($user_notifications as $value2) {
                                // print_r($value2)."<br>";
                                if ($value2['by'] != $member_id) {
                                        array_push($new_user_notification, $value2);
                                } elseif ($value2['by'] == $member_id) {
                                        array_push($new_user_notification, array('by' => $value2['by'], 'type' => 'interest_expressed', 'status' => 'rejected', 'is_seen' => 'no', 'time' => time()));
                                }
                                // print_r($new_user_notification);
                        }
                }
                $this->db->where('member_id', $member);
                $this->db->update('member', array('interested_by' => json_encode($new_interested_by), 'notifications' => json_encode($new_user_notification)));

                // For Updating Member's interest
                $interest = $this->Crud_model->get_type_name_by_id('member', $member_id, 'interest');
                $interest = json_decode($interest, true);
                $new_interest = array();
                if (!empty($interest)) {
                        foreach ($interest as $value3) {
                                // print_r($value3)."<br>";
                                if ($value3['id'] != $member) {
                                        array_push($new_interest, $value3);
                                }
                                /*elseif ($value3['id'] == $member) {
                    array_push($new_interest, array('id'=>$value3['id'], 'status'=>'rejected', 'time'=>time()));
                }*/
                                // print_r($new_interest)."<br>";
                        }
                }
                // For Updating Member's notifications
                $member_notifications = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
                $member_notifications = json_decode($member_notifications, true);
                // print_r($member_notifications)."<br>";
                array_push($member_notifications, array('by' => $member, 'type' => 'rejected_interest', 'status' => 'rejected', 'is_seen' => 'no', 'time' => time()));
                // print_r($member_notifications);

                $this->db->where('member_id', $member_id);
                $this->db->update('member', array('interest' => json_encode($new_interest), 'notifications' => json_encode($member_notifications)));
                recache();
        }

        function enable_message($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
				
                $member = $this->session->userdata('member_id');
                $direct_messages = $this->Crud_model->get_type_name_by_id('member', $member, 'direct_messages');

                $enablerMembership = $this->Crud_model->get_type_name_by_id('member', $member, 'membership');
                $receiverMembership = $this->Crud_model->get_type_name_by_id('member', $member_id, 'membership');

                if ($direct_messages > 0) 
                {
                    if ($enablerMembership == 1 && $receiverMembership == 1) {
                        $data['message_thread_from'] = $member;
                        $data['message_thread_to'] = $member_id;
                        $data['message_thread_time'] = time();
                        $data['message_thread_timezone'] = gmdate('Y-m-d\TH:i:s.').'000Z';
                        $data['thread_viewable_from'] = 1;

                        $this->db->insert('message_thread', $data);
                        $insert_id = $this->db->insert_id();

                        $result = array();
                        array_push($result, $insert_id);

                        echo json_encode($result);
                    }
                    elseif (($enablerMembership == 2 && $receiverMembership == 1) || ($enablerMembership == 1 && $receiverMembership == 2)) {
                        $data['message_thread_from'] = $member;
                        $data['message_thread_to'] = $member_id;
                        $data['message_thread_time'] = time();
                        $data['message_thread_timezone'] = gmdate('Y-m-d\TH:i:s.').'000Z';
                        $data['thread_viewable_from'] = 1;

                        $this->db->insert('message_thread', $data);
                        $insert_id = $this->db->insert_id();

                        $result = array();
                        array_push($result, $insert_id);

                        echo json_encode($result);
                    }
                    elseif (($enablerMembership == 1 && $receiverMembership == 3) || ($enablerMembership == 3 && $receiverMembership == 1)) {
                        $data['message_thread_from'] = $member;
                        $data['message_thread_to'] = $member_id;
                        $data['message_thread_time'] = time();
                        $data['message_thread_timezone'] = gmdate('Y-m-d\TH:i:s.').'000Z';
                        $data['thread_viewable_from'] = 1;

                        $this->db->insert('message_thread', $data);
                        $insert_id = $this->db->insert_id();

                        $result = array();
                        array_push($result, $insert_id);

                        echo json_encode($result);
                    }
                    else
                    {
                        $data['message_thread_from'] = $member;
                        $data['message_thread_to'] = $member_id;
                        $data['message_thread_time'] = time();
                        $data['message_thread_timezone'] = gmdate('Y-m-d\TH:i:s.').'000Z';
                        $data['thread_viewable_from'] = 1;
                        $data['thread_viewable_to'] = 1;

                        $this->db->insert('message_thread', $data);
                        $insert_id = $this->db->insert_id();

                        $result = array();
                        array_push($result, $insert_id);

                        echo json_encode($result);
                    }
                }
        }

        function threadViewableTo($thread_viewable_to, $thread_id)
        {
            $this->db->where('message_thread_id', $thread_id);
            $this->db->update('message_thread', array('thread_viewable_to' => $thread_viewable_to));

            $result = array();
            array_push($result, $thread_id);

            echo json_encode($result);
        }

        function get_messages($message_thread_id, $get_all = '')
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                if ($get_all == "") {
                        $member = $this->session->userdata('member_id');
                        $member_position = $this->Crud_model->message_thread_member_position($message_thread_id, $member);
                        $this->db->where('message_thread_id', $message_thread_id);
                        $this->db->update('message_thread', array('message_' . $member_position . '_seen' => 'yes'));
                        recache();

                        $page_data['message_thread_id'] = $message_thread_id;
                        // $messages_query = $this->db->query("SELECT * FROM message WHERE message_thread_id = $message_thread_id AND message_time <=UNIX_TIMESTAMP() AND message_time>=(SELECT UNIX_TIMESTAMP()- 60*60*24*7) ORDER BY message_time");
                        // print_r($get_all);exit;
                        $membership = $this->Crud_model->get_type_name_by_id('member', $member, 'membership');

                        $messages_query = $this->db->query("SELECT *, mem.membership as mem_membership, mem1.membership as mem1_membership FROM  message AS mess 
                            LEFT JOIN member AS mem ON mess.message_from = mem.member_id
                            LEFT JOIN member AS mem1 ON mess.message_to = mem1.member_id
                            WHERE message_thread_id = $message_thread_id 
                            AND message_time <= UNIX_TIMESTAMP() 
                            AND message_time >= (SELECT
                            UNIX_TIMESTAMP() - 60 * 60 * 24 * 14) ORDER BY message_time");
 
                        $page_data['message_count'] = $messages_query->num_rows();
                        if ($page_data['message_count'] <= 50) {
                                $page_data['messages'] = $messages_query->result();
                        } else {
                                $limit_from = $page_data['message_count'] - 50;
                                $limit_amount = 50;
                                // $page_data['messages'] = $this->db->order_by('message_time')->limit($limit_amount, $limit_from)->get_where('message', array('message_thread_id' => $message_thread_id))->result();
                                $page_data['messages'] = $this->db->query("SELECT *, mem.membership as mem_membership, mem1.membership as mem1_membership FROM  message AS mess 
                                    LEFT JOIN member AS mem ON mess.message_from = mem.member_id
                                    LEFT JOIN member AS mem1 ON mess.message_to = mem1.member_id 
                                    WHERE message_thread_id = $message_thread_id
                                    AND message_time <= UNIX_TIMESTAMP() 
                                    AND message_time >= (SELECT
                                    UNIX_TIMESTAMP() - 60 * 60 * 24 * 14) ORDER BY message_time")->result();
                        }
                } elseif ($get_all == "all_msg") {
                        $member = $this->session->userdata('member_id');
                        $member_position = $this->Crud_model->message_thread_member_position($message_thread_id, $member);
                        $this->db->where('message_thread_id', $message_thread_id);
                        $this->db->update('message_thread', array('message_' . $member_position . '_seen' => 'yes'));
                        recache();

                        $page_data['message_thread_id'] = $message_thread_id;
                        $messages_query = $this->db->query("SELECT * FROM message WHERE message_thread_id = $message_thread_id AND message_time <=UNIX_TIMESTAMP() AND message_time>=(SELECT UNIX_TIMESTAMP()- 60*60*24*7) ORDER BY message_time");
                        $page_data['messages'] = $messages_query->result();
                        $page_data['message_count'] = 0; // to set the frontend variable for not displaying SHOW ALL MSG
                }

                $this->load->view('front/profile/messaging/messages', $page_data);
        }

        function send_message($message_thread_id, $message_from, $message_to)
        {
                $checkMembership = $this->Crud_model->get_type_name_by_id('member', $message_to, 'membership');
                // print_r($message_thread_id);exit;
                if ($checkMembership == 4) {
                    $whereCond1 = array('message_thread_from' => $message_from, 'message_thread_to' => $message_to);
                    $whereCond2 = array('message_thread_from' => $message_to, 'message_thread_to' => $message_from);
                    $this->db->where($whereCond1);
                    $this->db->or_where($whereCond2);
                    $this->db->update('message_thread', array('is_fake_message' => 2));
                    // echo $this->db->last_query();exit;
                }
                $sql = $this->db->query('SELECT message_id FROM message WHERE message_from = ' . $message_from . " AND message_to = " . $message_to);
                if($sql->num_rows() == 0){
                   $this->Email_model->send_message_email($message_to);
                }

                $data['message_thread_id'] = $message_thread_id;
                $data['message_from'] = $message_from;
                $data['message_to'] = $message_to;
                $data['message_text'] = $this->input->post('message_text');
                $data['message_time'] = time();
                $data['timezone_datetime'] = gmdate('Y-m-d\TH:i:s.').'000Z';

                $this->db->insert('message', $data);

                $member_position = $this->Crud_model->message_thread_member_position($message_thread_id, $message_to);
                $this->db->where('message_thread_id', $message_thread_id);
                $this->db->update('message_thread', array('message_' . $member_position . '_seen' => '', 'message_thread_time' => time(), 'message_thread_timezone' => gmdate('Y-m-d\TH:i:s.').'000Z'));
                recache();
        }

        function add_shortlist($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                $member = $this->session->userdata('member_id');
                $shortlists = $this->Crud_model->get_type_name_by_id('member', $member, 'short_list');
                $shortlisted = json_decode($shortlists, true);
                if (empty($shortlisted)) {
                        $shortlisted = array();
                        array_push($shortlisted, $member_id);
                }
                if (!in_array($member_id, $shortlisted)) {
                        array_push($shortlisted, $member_id);
                }
                $this->db->where('member_id', $member);
                $this->db->update('member', array('short_list' => json_encode($shortlisted)));
                recache();
        }

        function remove_shortlist($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                $member = $this->session->userdata('member_id');
                $shortlists = $this->Crud_model->get_type_name_by_id('member', $member, 'short_list');
                $shortlisted = json_decode($shortlists, true);
                // $key = array_search($member_id, $shortlisted);
                if (empty($shortlisted)) {
                        $shortlisted = array();
                }
                // unset($shortlisted[$key]);
                $new_array = array();
                foreach ($shortlisted as $value) {
                        if ($value != $member_id) {
                                array_push($new_array, $value);
                        }
                }
                $shortlisted = $new_array;
                $this->db->where('member_id', $member);
                $this->db->update('member', array('short_list' => json_encode($shortlisted)));
                recache();
        }

        function add_follow($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                $member = $this->session->userdata('member_id');
                $follows = $this->Crud_model->get_type_name_by_id('member', $member, 'followed');
                $followed = json_decode($follows, true);
                if (empty($followed)) {
                        $followed = array();
                        array_push($followed, $member_id);

                        $follower = $this->Crud_model->get_type_name_by_id('member', $member_id, 'follower');
                        $follower = $follower + 1;
                        $this->db->where('member_id', $member_id);
                        $this->db->update('member', array('follower' => $follower));
                }
                if (!in_array($member_id, $followed)) {
                        array_push($followed, $member_id);

                        $follower = $this->Crud_model->get_type_name_by_id('member', $member_id, 'follower');
                        $follower = $follower + 1;
                        $this->db->where('member_id', $member_id);
                        $this->db->update('member', array('follower' => $follower));
                }
                $this->db->where('member_id', $member);
                $this->db->update('member', array('followed' => json_encode($followed)));
                recache();
        }

        function add_unfollow($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                $member = $this->session->userdata('member_id');
                $follows = $this->Crud_model->get_type_name_by_id('member', $member, 'followed');
                $followed = json_decode($follows, true);
                // $key = array_search($member_id, $followed);
                if (empty($followed)) {
                        $followed = array();
                }
                // unset($followed[$key]);
                $new_array = array();
                foreach ($followed as $value) {
                        if ($value != $member_id) {
                                array_push($new_array, $value);
                        }
                }
                $followed = $new_array;
                $this->db->where('member_id', $member);
                $this->db->update('member', array('followed' => json_encode($followed)));

                $follower = $this->Crud_model->get_type_name_by_id('member', $member_id, 'follower');
                $follower = $follower - 1;
                $this->db->where('member_id', $member_id);
                $this->db->update('member', array('follower' => $follower));
                recache();
        }

        function add_ignore($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                $member = $this->session->userdata('member_id');
                $ignores = $this->Crud_model->get_type_name_by_id('member', $member, 'ignored');
                $ignored_bys = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
                $ignored = json_decode($ignores, true);
                $ignored_by = json_decode($ignored_bys, true);
                // FOR Logged in USER
                if (empty($ignored)) {
                        $ignored = array();
                        array_push($ignored, $member_id);
                } elseif (!empty($ignored)) {
                        if (!in_array($member_id, $ignored)) {
                                array_push($ignored, $member_id);
                        }
                }
                $this->db->where('member_id', $member);
                $this->db->update('member', array('ignored' => json_encode($ignored)));

                // FOR IGNORED USER
                if (empty($ignored_by)) {
                        $ignored_by = array();
                        array_push($ignored_by, $member);
                } elseif (!empty($ignored_by)) {
                        if (!in_array($member, $ignored_by)) {
                                array_push($ignored_by, $member);
                        }
                }
                $this->db->where('member_id', $member_id);
                $this->db->update('member', array('ignored_by' => json_encode($ignored_by)));
                recache();
        }

        function do_unblock($member_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                $member = $this->session->userdata('member_id');
                $ignores = $this->Crud_model->get_type_name_by_id('member', $member, 'ignored');
                $ignored = json_decode($ignores, true);
                if (empty($ignored)) {
                        $ignored = array();
                }
                $new_array = array();
                foreach ($ignored as $value) {
                        if ($value != $member_id) {
                                array_push($new_array, $value);
                        }
                }
                $ignored = $new_array;
                $this->db->where('member_id', $member);
                $this->db->update('member', array('ignored' => json_encode($ignored)));
                recache();
        }

        function paypal_cancel_cover_pic()
        {
            $this->session->set_flashdata('alert', 'paypal_cancel');
            redirect(base_url() . 'home/profile/', 'refresh');
        }

        function paypal_success_cover_pic()
        {
            
            $data['value'] = "buying cover pic package";
			$data['cover_pics_cleck'] = 1;
			print_data($data);die();
            $this->load->view('front/custom_thank_you' , $data);
        }

        function profile($para1 = "", $para2 = "", $para3 = "")
        {
			
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                if ($para1 == "" || $para1 == "nav" || $para1 == "platinumPlan") {
                        $page_data['title'] = "Profile || " . $this->system_title;

                        $page_data['top'] = "profile.php";
                        $page_data['page'] = "profile/dashboard";
                        $page_data['bottom'] = "profile.php";
                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')  ))->result();
                        $page_data['get_member_gallery_items'] = $this->db->get_where("gallery_items", array("member_id" => $this->session->userdata('member_id')))->result();
					
                        if ($this->session->flashdata('alert') == "edit")
                        {
                            $page_data['success_alert'] = translate("you_have_successfully_edited_your_profile!");
                        }
                        elseif ($this->session->flashdata('alert') == "edit_image")
                        {
                            $page_data['_success_alert'] = translate("Congratulations! Your Profile Photo is Uploaded, it will be screened now.");
                        }
                        elseif ($this->session->flashdata('alert') == "add_gallery")
                        {
                            $page_data['success_alert'] = translate("you_have_successfully_added_the_photo_into_your_gallery!");
                        }
                        elseif ($this->session->flashdata('alert') == "failed")
                        {
                            $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
                        }
                        elseif ($this->session->flashdata('alert') == "size_error")
                        {
                            $page_data['danger_alert'] = translate("upload_failed. image_size_exceeds_2MB!");
                        }
                        elseif ($this->session->flashdata('alert') == "add_story")
                        {
                            $page_data['success_alert'] = translate("you_have_successfully_added_your_story._please_wait_till_it_is_approved!");
                        }
                        elseif ($this->session->flashdata('alert') == "failed_add_story")
                        {
                            $page_data['danger_alert'] = translate("failed_to_add_your_story!");
                        }
                        elseif ($this->session->flashdata('alert') == "blocked")
                        {
                            $page_data['danger_alert'] = translate("please_complete_your_profile");
                        }
                        elseif ($this->session->flashdata('alert') == "add_video")
                        {
                            $page_data['success_alert'] = translate("you_have_successfully_added_a_video");
                        }
                        elseif ($this->session->flashdata('alert') == "video_error")
                        {
                                $page_data['danger_alert'] = translate("failed_to_upload_your_video._make_sure_the_video_is_MP4 and 30 sec long!");
                        }
                        elseif ($this->session->flashdata('success') == "complete_your_profile")
                        {
                            $page_data['success_alert'] = translate("please_complete_your_profile");
                        }elseif ($this->session->flashdata('alert') == "paypal_success") { // rakesh
                                $page_data['success_alert'] = translate("your_payment_via_paypal_has_been_successfull!");
                        }elseif ($this->session->flashdata('alert') == "stripe_success") { // rakesh
                                $page_data['success_alert'] = translate("your_payment_via_stripe_has_been_successfull!");
                        }elseif ($this->session->flashdata('alert') == "upload_cover_pic_for_approval") { // rakesh
                                $page_data['success_alert'] = translate("Congratulations your Cover Photo is Uploaded, it will now be screened.");
                        }

                        
                        $page_data['load_nav']  = $para2;
                        $page_data['sp_nav']    = $para3;
                        $this->load->view('front/index', $page_data);
                } elseif ($para1 == "followed_users") {
                        $this->load->view('front/profile/followed_users/index');
                } elseif ($para1 == "cover_pic_packages") {
                    // rakesh
                        $this->load->view('front/profile/coverPic/index');
                } elseif ($para1 == "cover_pic_packages_") {
                    // rakesh
                        $this->load->view('front/profile/coverPic/index');
                } elseif ($para1 == "cover_pic_uplod_send") {
                    // rakesh

                    $this->db->from("cover_pics");
                    $this->db->limit(1);
                    $this->db->order_by('cover_pics_id',"DESC");
                    $this->db->where('status', 0 );
                    $this->db->where('member_id', $this->session->userdata('member_id') );
                    $query = $this->db->get();
                    $page_data['data_variable'] = $query->result_array();

                    $this->load->view('front/profile/coverPic/add_cover_pic' , $page_data);
                } elseif ($para1 == "cover_pic_uplod_delete") {
                    // rakesh

                    $this->db->from("cover_pics");
                    $this->db->limit(1);
                    $this->db->order_by('cover_pics_id',"DESC");
                    $this->db->where('status', 0 );
                    $this->db->where('member_id', $this->session->userdata('member_id') );
                    $query = $this->db->get()->result_array();

                    if (count($query)) {
                        $page_data['data_variable'] = $query;
                        $this->load->view('front/profile/coverPic/delete' , $page_data);
                    }else{
                        echo "<b>  Add Picture First </b>";
                    }

                } elseif ($para1 == "cover_pic_uplod_edit") {
                    // rakesh

                    $this->db->from("cover_pics");
                    $this->db->limit(1);
                    $this->db->order_by('cover_pics_id',"DESC");
                    $this->db->where('status', 0 );
                    $this->db->where('member_id', $this->session->userdata('member_id') );
                    $query = $this->db->get();
                    $page_data['data_variable'] = $query->result_array();

                    $this->load->view('front/profile/coverPic/edit' , $page_data);
                } elseif ($para1 == "messaging") {
                        $user_id = $this->session->userdata('member_id');
                        $page_data['listed_messaging_members'] = $this->Crud_model->get_listed_messaging_members($user_id);
                        $this->load->view('front/profile/messaging/index', $page_data);
                } elseif ($para1 == "short_list") {
                        $this->load->view('front/profile/short_list/index');
                } elseif ($para1 == "my_interests") {
                        $this->load->view('front/profile/my_interests/index');
                } elseif ($para1 == "ignored_list") {
                        $this->load->view('front/profile/ignored_list/index');
                } elseif ($para1 == "my_packages") {
                    $page_data['plans'] = $this->db->query("SELECT * FROM plan")->result();
                    $this->load->view('front/profile/my_packages/index', $page_data);
                } elseif ($para1 == "payments") {
                        $page_data['payments_info'] = $this->db->order_by("purchase_datetime", "desc")->get_where('package_payment', array('member_id' => $this->session->userdata('member_id')))->result();
                        $this->load->view('front/profile/payments/index', $page_data);
                } elseif ($para1 == "change_pass") {
                        $this->load->view('front/profile/change_password/index');
                }elseif ($para1 == "get_platinum") {
                    $page_data['plans'] = $this->db->query("SELECT * FROM plan")->result();
                    $this->load->view('front/profile/get_platinum/index', $page_data);
                }elseif ($para1 == "billing") {

                    if ($para2 == "billingData") {
                        $columns = array(
                                0 => 'due_date',
                                1 => 'invoice_no',
                                2 => 'billing_period',
                                3 => 'amount_paid',
                                4 => 'action',
                        );
                        $limit = $this->input->post('length');
                        $start = $this->input->post('start');
                        $order = 0;
                        $dir = "desc";
                        $table = 'earning';

                        $totalData = $this->Crud_model->allbilling_count($table, $this->session->userdata('member_id'));
                        
                        $totalFiltered = $totalData;
                        $member_id = $this->session->userdata('member_id');

                        if (empty($this->input->post('search')['value'])) {
                                $rows = $this->Crud_model->allbillings($table, $limit, $start, $order, $dir,$member_id);
                        } else {
                                $search = $this->input->post('search')['value'];

                                $rows =  $this->Crud_model->billing_search($table, $limit, $start, $search, $order, $dir,$member_id);

                                $totalFiltered = $this->Crud_model->billing_search_count($table, $search,$member_id);
                        }

                        $data = array();
                        if (!empty($rows)) {
                                // if ($dir == 'asc') {
                                //         $i = $start + 1;
                                // } elseif ($dir == 'desc') {
                                //         $i = $totalFiltered - $start;
                                // }
                                foreach ($rows as $key => $row) {
                                        $nestedData['due_date'] = "<span class='timezone".$key."'>" .$row->payment_process_date."</span><script type='text/javascript'>dateFunc('".$row->payment_process_date. "', ".$key.");</script>";
                                        $nestedData['invoice_no'] = $row->invoice_no;
                                        $nestedData['billing_period'] = $row->billing_cycle;
                                        $nestedData['amount_paid'] = currency('', 'def') . $row->amount;
                                        $nestedData['action'] = "<a href='".base_url()."home/generateInvoice/".$row->invoice_no."/".$row->member_display_id."/".$row->member_first_name."/".$row->member_last_name."/".$row->member_mobile."/".date('d-M-Y', strtotime($row->payment_process_date))."/".date('d-M-Y', strtotime($row->next_billing_date))."/".$row->package."/".$row->billing_cycle."/".$row->amount."' id='btn_".$row->invoice_no."' >Download</a>";
                                        
                                        $data[] = $nestedData;
                                        // if ($dir == 'asc') {
                                        //         $i++;
                                        // } elseif ($dir == 'desc') {
                                        //         $i--;
                                        // }
                                }
                        }

                        $json_data = array(
                                "draw"            => intval($this->input->post('draw')),
                                "recordsTotal"    => intval($totalData),
                                "recordsFiltered" => intval($totalFiltered),
                                "data"            => $data
                        );
                        
                        echo(json_encode($json_data));exit;
                    }

                    $this->load->view('front/profile/billing/index');
                } elseif ($para1 == "picture_privacy") {
                        $this->load->view('front/profile/picture_privacy/index');
                } elseif ($para1 == "close_account") {
                        if ($para2 == "yes") {
                                $data['is_closed'] = $para2;
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                        } elseif ($para2 == "no") {
                                $data['is_closed'] = $para2;
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                        } else {
                                $this->load->view('front/profile/close_account/index');
                        }
                } elseif ($para1 == "reopen_account") {
                        if ($para2 == "yes") {
                                $data['is_closed'] = 'no';
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                        } elseif ($para2 == "no") {
                                $data['is_closed'] = 'yes';
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                        } else {
                                $this->load->view('front/profile/reopen_account/index');
                        }
                } elseif ($para1 == "photos") {
                        $this->load->view('front/profile/photos/index');
                } elseif ($para1 == "videos") {
                         $this->load->view('front/profile/videos/index');
                // } elseif ($para1 == "gallery") {
                //         $this->load->view('front/profile/gallery/index');
                } elseif ($para1 == "gallery_upload") {
                        $this->load->view('front/profile/gallery_upload/index');
                } elseif ($para1 == "video_upload") {
                        $this->load->view('front/profile/video_upload/index');
                } elseif ($para1 == "photo_video_privacy") {
                        $this->load->view('front/profile/photo_video_privacy/index');
                } elseif ($para1 == "delete_account") {
                        $this->load->view('front/profile/delete_account/index');
                } elseif ($para1 == "hide_profile") {
                        $this->load->view('front/profile/hide_profile/index');
                } elseif ($para1 == "happy_story") {
                        $this->load->view('front/profile/happy_story/index');
                } elseif ($para1 == "edit_full_profile") {
                        $page_data['title'] = "Edit Profile || " . $this->system_title;
                        $page_data['top'] = "profile.php";
                        $page_data['page'] = "profile/edit_full_profile";
                        $page_data['bottom'] = "profile.php";
                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();

                        $page_data['load_nav']  = $para2;
                        $page_data['sp_nav']    = $para3;

                        $this->load->view('front/index', $page_data);
                } elseif ($para1 == "update_all") {
                        $this->form_validation->set_rules('introduction', 'Introduction', 'required');

                        $this->form_validation->set_rules('first_name', 'First Name', 'required');
                        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
                        $this->form_validation->set_rules('gender', 'Gender', 'required');
                        $this->form_validation->set_rules('on_behalf', 'On Behalf', 'required');
                        if ($this->input->post('old_email') != $this->input->post('email')) {
                                $this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]|valid_email', array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
                        }
                        if ($this->input->post('old_mobile') != $this->input->post('mobile')) {
                                $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[member.mobile]', array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
                        }
                        $this->form_validation->set_rules('marital_status', 'Marital Status', 'required');

                        $this->form_validation->set_rules('country', 'Country', 'required');
                        $this->form_validation->set_rules('state', 'State', 'required');
                        // $this->form_validation->set_rules('city', 'City', 'required');

                        $this->form_validation->set_rules('highest_education', 'Highest Education', 'required');
                        $this->form_validation->set_rules('occupation', 'Occupation', 'required');

                        $this->form_validation->set_rules('mother_tongue', 'Mother Tongue', 'required');

                        $this->form_validation->set_rules('birth_country', 'Birth Country', 'required');
                        $this->form_validation->set_rules('citizenship_country', 'Citizenship Country', 'required');

                        $this->form_validation->set_rules('religion', 'Religion', 'required');

                        $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');

                        $this->form_validation->set_rules('permanent_country', 'Permanent Country', 'required');
                        $this->form_validation->set_rules('permanent_state', 'Permanent State', 'required');
                        // $this->form_validation->set_rules('permanent_city', 'Permanent City', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $page_data['form_contents'] = $this->input->post();
                                $page_data['title'] = "Edit Profile || " . $this->system_title;
                                $page_data['top'] = "profile.php";
                                $page_data['page'] = "profile/edit_full_profile";
                                $page_data['bottom'] = "profile.php";
                                $page_data['load_nav']  = $para2;
                                $page_data['sp_nav']    = $para3;
                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $this->load->view('front/index', $page_data);
                        } else {
                                $data['first_name'] = $this->input->post('first_name');
                                $data['last_name'] = $this->input->post('last_name');
                                $data['gender'] = $this->input->post('gender');
                                $data['email'] = $this->input->post('email');
                                $data['mobile'] = $this->input->post('mobile');
                                $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));
                                $data['height'] = $this->input->post('height');
                                $data['introduction'] = $this->input->post('introduction');
                                $data['i_am_looking'] = $this->input->post('i_am_looking');


                                // ------------------------------------Basic Info------------------------------------ //
                                $basic_info[] = array(
                                        'marital_status'                =>        $this->input->post('marital_status'),
                                        'number_of_children'        =>        $this->input->post('number_of_children'),
                                        'area'                                        =>        $this->input->post('area'),
                                        'on_behalf'             =>  $this->input->post('on_behalf')
                                );
                                $data['basic_info'] = json_encode($basic_info);
                                // ------------------------------------Basic Info------------------------------------ //

                                // ------------------------------------Present Address------------------------------------ //
                                $present_address[] = array(
                                        'country'                =>  $this->input->post('country'),
                                        'city'                                        =>        $this->input->post('city'),
                                        'state'                                        =>        $this->input->post('state'),
                                        'postal_code'                        =>        $this->input->post('postal_code')
                                );
                                $data['present_address'] = json_encode($present_address);
                                // ------------------------------------Present Address------------------------------------ //

                                // ------------------------------------Education & Career------------------------------------ //
                                $education_and_career[] = array(
                                        'highest_education'        =>  $this->input->post('highest_education'),
                                        'occupation'                                        =>        $this->input->post('occupation'),
                                        'annual_income'                                        =>        $this->input->post('annual_income')
                                );
                                $data['education_and_career'] = json_encode($education_and_career);
                                // ------------------------------------Education & Career------------------------------------ //

                                // ------------------------------------ Physical Attributes------------------------------------ //
                                $physical_attributes[] = array(
                                        'weight'     =>        $this->input->post('weight'),
                                        'eye_color'                                =>        $this->input->post('eye_color'),
                                        'hair_color'                        =>        $this->input->post('hair_color'),
                                        'complexion'                        =>        $this->input->post('complexion'),
                                        'blood_group'                        =>        $this->input->post('blood_group'),
                                        'body_type'                                =>        $this->input->post('body_type'),
                                        'body_art'                                =>        $this->input->post('body_art'),
                                        'any_disability'                =>        $this->input->post('any_disability')
                                );
                                $data['physical_attributes'] = json_encode($physical_attributes);
                                // ------------------------------------ Physical Attributes------------------------------------ //

                                // ------------------------------------ Language------------------------------------ //
                                $language[] = array(
                                        'mother_tongue'                        =>  $this->input->post('mother_tongue'),
                                        'language'                                =>        $this->input->post('language'),
                                        'speak'                                        =>        $this->input->post('speak'),
                                        'read'                                        =>        $this->input->post('read')
                                );
                                $data['language'] = json_encode($language);
                                // ------------------------------------ Language------------------------------------ //

                                // ------------------------------------Hobbies & Interest------------------------------------ //
                                $hobbies_and_interest[] = array(
                                        'hobby'            =>  $this->input->post('hobby'),
                                        'interest'                                =>  $this->input->post('interest'),
                                        'music'                                        =>        $this->input->post('music'),
                                        'books'                                        =>        $this->input->post('books'),
                                        'movie'                                        =>        $this->input->post('movie'),
                                        'tv_show'                                =>        $this->input->post('tv_show'),
                                        'sports_show'                        =>        $this->input->post('sports_show'),
                                        'fitness_activity'                =>        $this->input->post('fitness_activity'),
                                        'cuisine'                                =>        $this->input->post('cuisine'),
                                        'dress_style'                        =>        $this->input->post('dress_style')
                                );
                                $data['hobbies_and_interest'] = json_encode($hobbies_and_interest);
                                // ------------------------------------Hobbies & Interest------------------------------------ //

                                // ------------------------------------ Personal Attitude & Behavior------------------------------------ //
                                $personal_attitude_and_behavior[] = array(
                                        'affection'        =>  $this->input->post('affection'),
                                        'humor'             =>        $this->input->post('humor'),
                                        'political_view'    =>        $this->input->post('political_view'),
                                        'religious_service' =>        $this->input->post('religious_service')
                                );
                                $data['personal_attitude_and_behavior'] = json_encode($personal_attitude_and_behavior);
                                // ------------------------------------ Personal Attitude & Behavior------------------------------------ //

                                // ------------------------------------Residency Information------------------------------------ //
                                $residency_information[] = array(
                                        'birth_country'        =>  $this->input->post('birth_country'),
                                        'residency_country'                =>        $this->input->post('residency_country'),
                                        'citizenship_country'        =>        $this->input->post('citizenship_country'),
                                        'grow_up_country'                =>        $this->input->post('grow_up_country'),
                                        'immigration_status'        =>        $this->input->post('immigration_status')
                                );
                                $data['residency_information'] = json_encode($residency_information);
                                // ------------------------------------Residency Information------------------------------------ //

                                // ------------------------------------Spiritual and Social Background------------------------------------ //
                                $spiritual_and_social_background[] = array(
                                        'religion'        =>  $this->input->post('religion'),
                                        'caste'                                        =>        $this->input->post('caste'),
                                        'sub_caste'                                =>        $this->input->post('sub_caste'),
                                        'ethnicity'                                =>        $this->input->post('ethnicity'),
                                        'personal_value'                =>        $this->input->post('personal_value'),
                                        'family_value'                        =>        $this->input->post('family_value'),
                                        'u_manglik'             =>  $this->input->post('u_manglik'),
                                        'community_value'                =>        $this->input->post('community_value'),
                                        'family_status'         =>  $this->input->post('family_status')
                                );
                                $data['spiritual_and_social_background'] = json_encode($spiritual_and_social_background);
                                // ------------------------------------Spiritual and Social Background------------------------------------ //

                                // ------------------------------------ Life Style------------------------------------ //
                                $life_style[] = array(
                                        'diet'                                =>  $this->input->post('diet'),
                                        'drink'                                        =>        $this->input->post('drink'),
                                        'smoke'                                        =>        $this->input->post('smoke'),
                                        'living_with'                        =>        $this->input->post('living_with')
                                );
                                $data['life_style'] = json_encode($life_style);
                                // ------------------------------------ Life Style------------------------------------ //

                                // ------------------------------------ Astronomic Information------------------------------------ //
                                $astronomic_information[] = array(
                                        'muslim_i_am'        =>  $this->input->post('muslim_i_am'),
                                        'revert'                                        =>        $this->input->post('revert'),
                                        'convert'                                        =>        $this->input->post('convert'),
                                        'do_i_fast'                                =>        $this->input->post('do_i_fast'),
                                        'do_i_eat_halal'                                =>        $this->input->post('do_i_eat_halal'),
                                        'women_only'                                =>        $this->input->post('women_only'),
                                        'wife_wear'                                =>        $this->input->post('wife_wear'),
                                );
                                $data['astronomic_information'] = json_encode($astronomic_information);
                                // ------------------------------------ Astronomic Information------------------------------------ //

                                // ------------------------------------Permanent Address------------------------------------ //
                                $permanent_address[] = array(
                                        'permanent_country'        =>  $this->input->post('permanent_country'),
                                        'permanent_city'                                =>        $this->input->post('permanent_city'),
                                        'permanent_state'                                =>        $this->input->post('permanent_state'),
                                        'permanent_postal_code'                        =>        $this->input->post('permanent_postal_code')
                                );
                                $data['permanent_address'] = json_encode($permanent_address);
                                // ------------------------------------Permanent Address------------------------------------ //

                                // ------------------------------------Family Information------------------------------------ //
                                $family_info[] = array(
                                        'father'                                =>  $this->input->post('father'),
                                        'mother'                                =>        $this->input->post('mother'),
                                        'brother_sister'                =>        $this->input->post('brother_sister')
                                );
                                $data['family_info'] = json_encode($family_info);
                                // ------------------------------------Family Information------------------------------------ //

                                // ------------------------------------ Additional Personal Details------------------------------------ //
                                $additional_personal_details[] = array(
                                        'home_district'        =>  $this->input->post('home_district'),
                                        'family_residence'                                =>        $this->input->post('family_residence'),
                                        'fathers_occupation'                        =>        $this->input->post('fathers_occupation'),
                                        'special_circumstances'                        =>        $this->input->post('special_circumstances')
                                );
                                $data['additional_personal_details'] = json_encode($additional_personal_details);
                                // ------------------------------------ Additional Personal Details------------------------------------ //

                                // ------------------------------------ Partner Expectation------------------------------------ //
                                $partner_expectation[] = array(
                                        'general_requirement'        =>  $this->input->post('general_requirement'),
                                        'partner_age'                                                =>        $this->input->post('partner_age'),
                                        'partner_height'                                        =>        $this->input->post('partner_height'),
                                        'partner_weight'                                        =>        $this->input->post('partner_weight'),
                                        'partner_marital_status'                        =>        $this->input->post('partner_marital_status'),
                                        'with_children_acceptables'                        =>        $this->input->post('with_children_acceptables'),
                                        'partner_country_of_residence'                =>        $this->input->post('partner_country_of_residence'),
                                        'partner_religion'                                        =>        $this->input->post('partner_religion'),
                                        'partner_caste'                                                =>        $this->input->post('partner_caste'),
                                        'partner_complexion'                                =>        $this->input->post('partner_complexion'),
                                        'partner_education'                 =>        $this->input->post('partner_education'),
                                        'partner_profession'                                =>        $this->input->post('partner_profession'),
                                        'partner_drinking_habits'                        =>        $this->input->post('partner_drinking_habits'),
                                        'partner_smoking_habits'                        =>        $this->input->post('partner_smoking_habits'),
                                        'partner_diet'                                                =>        $this->input->post('partner_diet'),
                                        'partner_body_type'                                        =>        $this->input->post('partner_body_type'),
                                        'partner_personal_value'                        =>        $this->input->post('partner_personal_value'),
                                        'manglik'                                                        =>        $this->input->post('manglik'),
                                        'partner_any_disability'                        =>        $this->input->post('partner_any_disability'),
                                        'partner_mother_tongue'                                =>        $this->input->post('partner_mother_tongue'),
                                        'partner_family_value'                                =>        $this->input->post('partner_family_value'),
                                        'prefered_country'                                        =>        $this->input->post('prefered_country'),
                                        'prefered_state'                                        =>        $this->input->post('prefered_state'),
                                        'prefered_status'                                        =>        $this->input->post('prefered_status')
                                );
                                $data['partner_expectation'] = json_encode($partner_expectation);
                                // ------------------------------------ Partner Expectation------------------------------------ //

                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'edit');
                                        redirect(base_url() . 'home/profile', 'refresh');
                                }
                        }
                } elseif ($para1 == "update_introduction") {
                        $this->form_validation->set_rules('introduction', 'Introduction', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                $data['introduction'] = $this->input->post('introduction');
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();
                                recache();
                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $this->load->view('front/profile/dashboard/introduction', $page_data);
                        }
                } elseif ($para1 == "update_i_am_looking") {
                        $this->form_validation->set_rules('i_am_looking', 'i_am_looking', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                $data['i_am_looking'] = $this->input->post('i_am_looking');
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();
                                recache();
                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $this->load->view('front/profile/dashboard/i_am_looking', $page_data);
                        }
                }  elseif ($para1 == "update_basic_info") {
                        $this->form_validation->set_rules('first_name', 'First Name', 'required');
                        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
                        $this->form_validation->set_rules('gender', 'Gender', 'required');
                        $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');

                        if ($this->input->post('old_email') != $this->input->post('email')) {
                                $this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]|valid_email', array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
                        }


                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                $data['first_name'] = $this->input->post('first_name');
                                $data['last_name'] = $this->input->post('last_name');
                                $data['gender'] = $this->input->post('gender');
                                $data['email'] = $this->input->post('email');
                                $data['mobile'] = $this->input->post('mobile');
                                $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));

                                // ------------------------------------Basic Info------------------------------------ //
                                $basic_info[] = array(
                                        'residence'                =>        $this->input->post('residence'),
                                        'resident_status'        =>        $this->input->post('resident_status'),
                                        'my_sect'                                        =>        $this->input->post('my_sect'),
                                        'like_to_marry'             =>  $this->input->post('like_to_marry'),
                                        'grew_up'             =>  $this->input->post('grew_up'),
                                        'first_language'             =>  $this->input->post('first_language'),
                                        'second_language'             =>  $this->input->post('second_language'),
                                        'marital_status'             =>  $this->input->post('marital_status'),
                                        'Disabilities'             =>  $this->input->post('Disabilities'),
                                        'living_with'             =>  $this->input->post('living_with'),
                                        'profile_made'             =>  $this->input->post('profile_made'),
                                        'profession'             =>  $this->input->post('profession')

                                );
                                $data['basic_info'] = json_encode($basic_info);
                                //$data['display_member'] = strtoupper(substr($this->input->post('first_name'), 0, 1)) . strtoupper(substr($this->input->post('last_name'), 0, 1)) . $this->session->userdata('member_id');
							
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();

                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $this->load->view('front/profile/dashboard/basic_info', $page_data);
                        }
                } elseif ($para1 == "update_present_address") {
                        $this->form_validation->set_rules('country', 'Country', 'required');
                        $this->form_validation->set_rules('state', 'State', 'required');
                        // $this->form_validation->set_rules('city', 'City', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                // ------------------------------------Present Address------------------------------------ //
                                $present_address[] = array(
                                        'country'        =>  $this->input->post('country'),
                                        'city'                  =>  $this->input->post('city'),
                                        'state'                 =>  $this->input->post('state'),
                                        'postal_code'           =>  $this->input->post('postal_code')
                                );
                                $data['present_address'] = json_encode($present_address);

                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();

                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                                $this->load->view('front/profile/dashboard/present_address', $page_data);
                        }
                } elseif ($para1 == "update_education_and_career") {
                        $this->form_validation->set_rules('highest_education', 'Highest Education', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                // ------------------------------------Education & Career------------------------------------ //
                                $education_and_career[] = array(
                                        'highest_education' =>  $this->input->post('highest_education'),
                                        'i_am_employed'                    =>  $this->input->post('i_am_employed'),
                                        'annual_income'                 =>  $this->input->post('annual_income'),
                                        'my_job_title'                 =>  $this->input->post('my_job_title'),
                                        'my_company_name'                 =>  $this->input->post('my_company_name'),
                                        'years_worked'                 =>  $this->input->post('years_worked'),
                                        'self_employed'                 =>  $this->input->post('self_employed'),
                                        'years_owned'                 =>  $this->input->post('years_owned'),
                                        'annual_income_self'                 =>  $this->input->post('annual_income_self')
                                );
                                $data['education_and_career'] = json_encode($education_and_career);
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();

                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                                $this->load->view('front/profile/dashboard/education_and_career', $page_data);
                        }
                } elseif ($para1 == "update_physical_attributes") {
                        // ------------------------------------ Physical Attributes------------------------------------ //
                        $physical_attributes[] = array(
                                'weight'     =>        $this->input->post('weight'),
                                'eye_color'                                =>        $this->input->post('eye_color'),
                                'hair_color'                        =>        $this->input->post('hair_color'),
                                'complexion'                        =>        $this->input->post('complexion'),
                                'blood_group'                        =>        $this->input->post('blood_group'),
                                'body_type'                                =>        $this->input->post('body_type'),
                                'body_art'                                =>        $this->input->post('body_art'),
                                'any_disability'                =>        $this->input->post('any_disability'),
                                'exercise'                =>        $this->input->post('exercise')
                        );
                        $data['height'] = $this->input->post('height');
                        $data['physical_attributes'] = json_encode($physical_attributes);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                        $this->load->view('front/profile/dashboard/physical_attributes', $page_data);
                } elseif ($para1 == "update_language") {
                        $this->form_validation->set_rules('mother_tongue', 'Mother Tongue', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                // ------------------------------------ Language------------------------------------ //
                                $language[] = array(
                                        'mother_tongue'         =>  $this->input->post('mother_tongue'),
                                        'language'              =>  $this->input->post('language'),
                                        'speak'                 =>  $this->input->post('speak'),
                                        'read'                  =>  $this->input->post('read')
                                );
                                $data['language'] = json_encode($language);
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();

                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                                $this->load->view('front/profile/dashboard/language', $page_data);
                        }
                } elseif ($para1 == "update_hobbies_and_interest") {
                        // ------------------------------------Hobbies & Interest------------------------------------ //
                        $hobbies_and_interest[] = array(
                                'hobby'            =>  $this->input->post('hobby'),
                                'interest'                                =>  $this->input->post('interest'),
                                'music'                                        =>        $this->input->post('music'),
                                'books'                                        =>        $this->input->post('books'),
                                'movie'                                        =>        $this->input->post('movie'),
                                'tv_show'                                =>        $this->input->post('tv_show'),
                                'sports_show'                        =>        $this->input->post('sports_show'),
                                'fitness_activity'                =>        $this->input->post('fitness_activity'),
                                'cuisine'                                =>        $this->input->post('cuisine'),
                                'dress_style'                        =>        $this->input->post('dress_style')
                        );
                        $data['hobbies_and_interest'] = json_encode($hobbies_and_interest);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                        $this->load->view('front/profile/dashboard/hobbies_and_interest', $page_data);
                } elseif ($para1 == "update_personal_attitude_and_behavior") {
                        // ------------------------------------ Personal Attitude & Behavior------------------------------------ //
                        $personal_attitude_and_behavior[] = array(
                                'affection'        =>  $this->input->post('affection'),
                                'humor'             =>        $this->input->post('humor'),
                                'political_view'    =>        $this->input->post('political_view'),
                                'religious_service' =>        $this->input->post('religious_service')
                        );
                        $data['personal_attitude_and_behavior'] = json_encode($personal_attitude_and_behavior);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                        $this->load->view('front/profile/dashboard/personal_attitude_and_behavior', $page_data);
                } elseif ($para1 == "update_residency_information") {
                        $this->form_validation->set_rules('birth_country', 'Birth Country', 'required');
                        $this->form_validation->set_rules('citizenship_country', 'Citizenship Country', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                // ------------------------------------Residency Information------------------------------------ //
                                $residency_information[] = array(
                                        'birth_country'    =>  $this->input->post('birth_country'),
                                        'residency_country'     =>  $this->input->post('residency_country'),
                                        'citizenship_country'   =>  $this->input->post('citizenship_country'),
                                        'grow_up_country'       =>  $this->input->post('grow_up_country'),
                                        'immigration_status'    =>  $this->input->post('immigration_status')
                                );
                                $data['residency_information'] = json_encode($residency_information);
                                // ------------------------------------Residency Information------------------------------------ //
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();

                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                                $this->load->view('front/profile/dashboard/residency_information', $page_data);
                        }
                } elseif ($para1 == "update_spiritual_and_social_background") {
                        $this->form_validation->set_rules('religion', 'Religion', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                // ------------------------------------Spiritual and Social Background------------------------------------ //
                                $spiritual_and_social_background[] = array(
                                        'religion'   =>  $this->input->post('religion'),
                                        'caste'                 =>  $this->input->post('caste'),
                                        'sub_caste'             =>  $this->input->post('sub_caste'),
                                        'ethnicity'             =>  $this->input->post('ethnicity'),
                                        'personal_value'        =>  $this->input->post('personal_value'),
                                        'family_value'          =>  $this->input->post('family_value'),
                                        'u_manglik'             =>  $this->input->post('u_manglik'),
                                        'community_value'       =>  $this->input->post('community_value'),
                                        'family_status'          =>  $this->input->post('family_status')
                                );
                                $data['spiritual_and_social_background'] = json_encode($spiritual_and_social_background);
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();

                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                                $this->load->view('front/profile/dashboard/spiritual_and_social_background', $page_data);
                        }
                } elseif ($para1 == "update_life_style") {
                        // ------------------------------------ Life Style------------------------------------ //
                        $life_style[] = array(
                                'diet'                                =>  $this->input->post('diet'),
                                'drink'                                        =>        $this->input->post('drink'),
                                'smoke'                                        =>        $this->input->post('smoke'),
                                'living_with'                        =>        $this->input->post('living_with')
                        );
                        $data['life_style'] = json_encode($life_style);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                        $this->load->view('front/profile/dashboard/life_style', $page_data);
                } elseif ($para1 == "update_astronomic_information") {

                        // ------------------------------------ Astronomic Information------------------------------------ //
                        $astronomic_information[] = array(
                                'muslim_i_am'    =>  $this->input->post('muslim_i_am'),
                                'revert'                 =>  $this->input->post('revert'),
                                'convert'             =>  $this->input->post('convert'),
                                'do_i_fast'             =>  $this->input->post('do_i_fast'),
                                'do_i_pray'             =>  $this->input->post('do_i_pray'),
                                'do_i_eat_halal'             =>  $this->input->post('do_i_eat_halal'),
                                'women_only'             =>  $this->input->post('women_only'),
                                'wife_wear'             =>  $this->input->post('wife_wear')
                        );

                        $data['astronomic_information'] = json_encode($astronomic_information);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                        $this->load->view('front/profile/dashboard/astronomic_information', $page_data);
                } elseif ($para1 == "update_permanent_address") {
                        $this->form_validation->set_rules('permanent_country', 'Permanent Country', 'required');
                        $this->form_validation->set_rules('permanent_state', 'Permanent State', 'required');
                        // $this->form_validation->set_rules('permanent_city', 'Permanent City', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                // ------------------------------------Permanent Address------------------------------------ //
                                $permanent_address[] = array(
                                        'permanent_country'    =>  $this->input->post('permanent_country'),
                                        'permanent_city'                =>  $this->input->post('permanent_city'),
                                        'permanent_state'               =>  $this->input->post('permanent_state'),
                                        'permanent_postal_code'         =>  $this->input->post('permanent_postal_code')
                                );
                                $data['permanent_address'] = json_encode($permanent_address);
                                $this->db->where('member_id', $this->session->userdata('member_id'));
                                $result = $this->db->update('member', $data);
                                recache();

                                $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                                $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                                $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                                $this->load->view('front/profile/dashboard/permanent_address', $page_data);
                        }
                } elseif ($para1 == "update_family_info") {
                        // ------------------------------------Family Information------------------------------------ //
                        $family_info[] = array(
                                'father'                                =>  $this->input->post('father'),
                                'mother'                                =>        $this->input->post('mother'),
                                'brother_sister'                =>        $this->input->post('brother_sister')
                        );
                        $data['family_info'] = json_encode($family_info);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                        $this->load->view('front/profile/dashboard/family_info', $page_data);
                } elseif ($para1 == "update_additional_personal_details") {
                        // ------------------------------------ Additional Personal Details------------------------------------ //
                        $additional_personal_details[] = array(
                                'born_at'        =>  $this->input->post('born_at'),
                                'want_children'                                =>        $this->input->post('want_children'),
                                'do_i_smoke'                        =>        $this->input->post('do_i_smoke'),
                                'grew_up_in'                        =>        $this->input->post('grew_up_in'),
                                'have_children'                        =>        $this->input->post('have_children'),
                                'do_i_drink'                        =>        $this->input->post('do_i_drink'),
                                'my_hobbies'                        =>        $this->input->post('my_hobbies'),
                                'believe_in_polygamy'                        =>        $this->input->post('believe_in_polygamy'),
                                'spouse_is'                        =>        $this->input->post('spouse_is'),
                                'my_personalities'                        =>        $this->input->post('my_personalities'),
                                'disabilities'                        =>        $this->input->post('disabilities'),
                                'relocate'                        =>        $this->input->post('relocate'),
                        );
                        $data['additional_personal_details'] = json_encode($additional_personal_details);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                        $this->load->view('front/profile/dashboard/additional_personal_details', $page_data);
                } elseif ($para1 == "update_partner_expectation") {
                        // ------------------------------------ Partner Expectation------------------------------------ //
                        $partner_expectation[] = array(
                                'partner_age'                                                =>        $this->input->post('partner_age'),
                                'partner_height'                                        =>        $this->input->post('partner_height'),
                                'partner_marital_status'                        =>        $this->input->post('partner_marital_status'),
                                'partner_country_of_residence'                =>        $this->input->post('partner_country_of_residence'),
                                'partner_caste'                                                =>        $this->input->post('partner_caste'),
                                'partner_education'                 =>        $this->input->post('partner_education'),
                                'partner_profession'                                =>        $this->input->post('partner_profession'),
                                'partner_body_type'                                        =>        $this->input->post('partner_body_type'),
                                'partner_any_disability'                        =>        $this->input->post('partner_any_disability'),
                                'partner_born_at'                        =>        $this->input->post('partner_born_at'),
                                'partner_nationality'                        =>        $this->input->post('partner_nationality'),
                                'partner_resident_status'                        =>        $this->input->post('partner_resident_status'),
                                'partner_1_language'                        =>        $this->input->post('partner_1_language'),
                                'partner_have_children'                        =>        $this->input->post('partner_have_children'),
                                'partner_children_how_many'                        =>        $this->input->post('partner_children_how_many'),
                                'partner_profession'                        =>        $this->input->post('partner_profession'),
                                'partner_2_language'                        =>        $this->input->post('partner_2_language')
                        );
                        $data['partner_expectation'] = json_encode($partner_expectation);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $page_data['privacy_status_data'] = json_decode($privacy_status, true);
                        $this->load->view('front/profile/dashboard/partner_expectation', $page_data);
                } elseif ($para1 == "update_image") {
           
                        if ($_FILES['file']['name'] !== '') {

                            $id = $this->session->userdata('member_id');
                            $path = $_FILES['file']['name'];
                            $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);

                            if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                    $this->Crud_model->file_up_main("file", "profile", $id, '', '', $ext);

                                }

                        }
                        
                        if ($_FILES['profile_image']['name'] !== '') {
                                $id = $this->session->userdata('member_id');
                                $path = $_FILES['profile_image']['name'];
                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);

                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                    if ($_FILES['profile_image']['size']>2000000 || $_FILES['profile_image']['size'] == 0) {

                                        $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                                            if ($isProfileCompleted == 0) {
                                                $this->session->set_flashdata('alert', 'size_error');
                                                redirect(base_url() . 'home/profile_detail', 'refresh');
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('alert', 'size_error');
                                                redirect(base_url() . 'home/profile', 'refresh');
                                            }
                                        
                                    }
                                    else
                                    {
			
                                        $this->Crud_model->file_up("profile_image", "profile", $id, '', '', $ext);

                                        // $imageName = $_FILES['profile_image']['name'];
                                        $imageName = str_replace(" ", "_", $_FILES['profile_image']['name']);

                                        $memberId = $this->session->userdata('member_id');

                                        $data['profile_image'] = $imageName;
                                        $data['is_profile_img_approved'] = 2; // pending for admin approval
                                        $data['profile_img_uploaded_date'] = date('Y-m-d H:i:s');

                                        $this->db->where('member_id', $memberId);
                                        $result = $this->db->update('member', $data);

                                        $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $memberId")->result();

                                        $this->Email_model->photo_submission_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);

                                        recache();

                                        $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                                        if ($isProfileCompleted == 0) {
                                            $this->session->set_flashdata('alert', 'edit_image');
                                            redirect(base_url() . 'home/profile_detail', 'refresh');
                                        }
                                        else
                                        {
                                            $this->session->set_flashdata('alert', 'edit_image');
                                            redirect(base_url() . 'home/profile', 'refresh');
                                        }
                                        
                                    }
                                }
                                else 
                                {
                                    $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                                    if ($isProfileCompleted == 0) {
                                        $this->session->set_flashdata('alert', 'failed');
                                        redirect(base_url() . 'home/profile_detail', 'refresh');
                                    }
                                    else
                                    {
                                        $this->session->set_flashdata('alert', 'failed');
                                        redirect(base_url() . 'home/profile', 'refresh');
                                    }  
                                }
                        }
                } elseif ($para1 == "update_password") {
                        $user_id = $this->session->userdata('member_id');
                        $current_password = sha1($this->input->post('current_password'));
                        $new_password = sha1($this->input->post('new_password'));
                        $confirm_password = sha1($this->input->post('confirm_password'));
                        $plain_password = $this->input->post('new_password');
                        $prev_password = $this->db->get_where('member', array('member_id' => $user_id))->row()->password;
                        if ($prev_password == $current_password) {
                                // if ($new_password == $current_password) {
                                //         $ajax_error[] = array('ajax_error'  =>  "<p>" . translate('new_password_and_current_password_are_same') . "!</p>");
                                //         echo json_encode($ajax_error);
                                // }
                                if ($new_password == $confirm_password) {
                                        $this->db->where('member_id', $user_id);
                                        $this->db->update('member', array('password' => $new_password, "plain_password" => $plain_password));
                                        echo "true";
                                        $this->logout();
                                        recache();
                                } else {
                                        $ajax_error[] = array('ajax_error'  =>  "<p>" . translate('new_password_does_not_matched_with_confirm_password') . "!</p>");
                                        echo json_encode($ajax_error);
                                }
                        } else {
                            echo "false";
                                // $ajax_error[] = array('ajax_error'  =>  "<p>" . translate('invalid_current_password') . "!</p>");
                                // echo json_encode($ajax_error);
                        }
                } elseif ($para1 == "unhide_section") {
                        // ------------------------------------ Unhide Section------------------------------------ //
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $privacy_status_data = json_decode($privacy_status, true);
                        foreach ($privacy_status_data as $key => $value) {
                                if ($key == $para2) {
                                        $privacy_status_data[0][$para2] = 'yes';
                                }
                        }
                        $data['privacy_status'] = json_encode($privacy_status_data);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $this->load->view('front/profile/dashboard/additional_personal_details', $page_data);
                } elseif ($para1 == "hide_section") {
                        // ------------------------------------ Unhide Section------------------------------------ //
                        $privacy_status = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'privacy_status');
                        $privacy_status_data = json_decode($privacy_status, true);
                        foreach ($privacy_status_data as $key => $value) {
                                if ($key == $para2) {
                                        $privacy_status_data[0][$para2] = 'no';
                                }
                        }
                        $data['privacy_status'] = json_encode($privacy_status_data);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();

                        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
                        $this->load->view('front/profile/dashboard/additional_personal_details', $page_data);
                } elseif ($para1 == "update_pic_privacy") {

                        $pic_privacy[] = array(
                                'profile_pic_show'     =>  $this->input->post('profile_pic_show'),
                                'gallery_show'             =>  $this->input->post('gallery_show'),
                                'video_show'     =>  $this->input->post('gallery_video')
                        );
                        $data['pic_privacy'] = json_encode($pic_privacy, true);
                        $this->db->where('member_id', $this->session->userdata('member_id'));
                        $result = $this->db->update('member', $data);
                        recache();
                }
        }

        function stories($para1 = "", $para2 = "", $para3 = "")
        {
                if ($para1 == "") {
                        $page_data['title'] = "Happy Stories || " . $this->system_title;
                        $page_data['top'] = "stories.php";
                        $page_data['page'] = "stories";
                        $page_data['bottom'] = "stories.php";
                        $page_data['all_happy_stories'] = $this->db->get_where("happy_story", array("approval_status" => 1))->result();
                        $this->load->view('front/index', $page_data);
                } elseif ($para1 == "story_detail") {
                        $page_data['title'] = "Story Detail || " . $this->system_title;
                        $page_data['top'] = "story_detail.php";
                        $page_data['page'] = "story_detail";
                        $page_data['bottom'] = "story_detail.php";
                        $page_data['get_story'] = $this->db->get_where("happy_story", array("happy_story_id" => $para2, "approval_status" => 1))->result();
                        if ($page_data['get_story']) {
                                $this->load->view('front/index', $page_data);
                        } else {
                                redirect(base_url() . 'home/stories', 'refresh');
                        }
                } elseif ($para1 == "add") {
                        $member_id = $this->session->userdata('member_id');
                        $data['title'] = $this->input->post('title');
                        $data['description'] = $this->input->post('description');
                        $data['post_time'] = strtotime($this->input->post('post_time'));
                        $data['partner_name'] = $this->input->post('partner_name');
                        $data['posted_by'] = $member_id;
                        $data['approval_status'] = "0";
                        $data['image'] = '[]';

                        $this->db->insert('happy_story', $data);
                        $id = $this->db->insert_id();

                        $images = array();
                        foreach ($_FILES['image']['name'] as $i => $row) {
                                if ($_FILES['image']['name'][$i] !== '') {
                                        $ib = $i + 1;
                                        $path = $_FILES['image']['name'][$i];
                                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                                        $img = 'happy_story_' . $id . '_' . $ib . '.jpg';
                                        $img_thumb = 'happy_story_' . $id . '_' . $ib . '_thumb.jpg';
                                        $images[] = array('index' => $i, 'img' => $img, 'thumb' => $img_thumb);
                                }
                        }

                        $this->Crud_model->file_up("image", "happy_story", $id, 'multi');
                        $data1['image'] = json_encode($images);
                        $this->db->where('happy_story_id', $id);
                        $result = $this->db->update('happy_story', $data1);
                        recache();

                        if ($this->input->post('upload_method') == 'upload') {
                                $data_v['timestamp'] = time();
                                $data_v['story_video_uploader_id'] = $this->session->userdata('member_id');
                                $data_v['story_id'] = $id;
                                $data_v['type'] = 'upload';
                                $data_v['from'] = 'local';
                                $data_v['video_link'] = '';
                                $data_v['video_src'] = '';
                                $this->db->insert('story_video', $data_v);
                                $v_id = $this->db->insert_id();
                                $video = $_FILES['upload_video']['name'];
                                $ext = pathinfo($video, PATHINFO_EXTENSION);
                                move_uploaded_file($_FILES['upload_video']['tmp_name'], 'uploads/story_video/story_video_' . $v_id . '.' . $ext);
                                $data_v['video_src'] = 'uploads/story_video/story_video_' . $v_id . '.' . $ext;
                                $this->db->where('story_video_id', $v_id);
                                $this->db->update('story_video', $data_v);
                                recache();
                        } elseif ($this->input->post('upload_method') == 'share') {
                                $data_v['timestamp'] = time();
                                $data_v['story_video_uploader_id'] = $this->session->userdata('member_id');
                                $data_v['story_id'] = $id;
                                $data_v['type'] = 'share';
                                $data_v['from'] = $this->input->post('site');
                                $data_v['video_link'] = $this->input->post('video_link');
                                $code = $this->input->post('vl');
                                if ($this->input->post('site') == 'youtube') {
                                        $data_v['video_src'] = 'https://www.youtube.com/embed/' . $code;
                                } else if ($this->input->post('site') == 'dailymotion') {
                                        $data_v['video_src'] = '//www.dailymotion.com/embed/video/' . $code;
                                } else if ($this->input->post('site') == 'vimeo') {
                                        $data_v['video_src'] = 'https://player.vimeo.com/video/' . $code;
                                }
                                $this->db->insert('story_video', $data_v);
                                recache();
                        }

                        if ($result) {
                                $this->session->set_flashdata('alert', 'add_story');
                                redirect(base_url() . 'home/profile', 'refresh');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_add_story');
                                redirect(base_url() . 'home/profile', 'refresh');
                        }
                } elseif ($para1 == 'preview') {
                        if ($para2 == 'youtube') {
                                echo '<iframe width="400" height="300" src="https://www.youtube.com/embed/' . $para3 . '" frameborder="0"></iframe>';
                        } else if ($para2 == 'dailymotion') {
                                echo '<iframe width="400" height="300" src="//www.dailymotion.com/embed/video/' . $para3 . '" frameborder="0"></iframe>';
                        } else if ($para2 == 'vimeo') {
                                echo '<iframe src="https://player.vimeo.com/video/' . $para3 . '" width="400" height="300" frameborder="0"></iframe>';
                        }
                }
        }
        function about_us($para1 = "", $para2 = "", $para3 = "")
        {
            if (isset($this->session->userdata['member_id'])) 
            {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    $page_data['title'] = "About Us|| " . $this->system_title;
                    $page_data['top'] = "about_us.php";
                    $page_data['page'] = "about_us";
                    $page_data['bottom'] = "about_us.php";
                    $this->load->view('front/index', $page_data);
                }
            }
            else
            {
                $page_data['title'] = "About Us|| " . $this->system_title;
                $page_data['top'] = "about_us.php";
                $page_data['page'] = "about_us";
                $page_data['bottom'] = "about_us.php";
                $this->load->view('front/index', $page_data);
            }
            
        }
        function helpful_questions($para1 = "", $para2 = "", $para3 = "")
        {

                $page_data['title'] = "Helpful Question || " . $this->system_title;
                $page_data['top'] = "help.php";
                $page_data['page'] = "help";
                $page_data['bottom'] = "help.php";


                $this->load->view('front/index', $page_data);
        }
        function warning($para1 = "", $para2 = "", $para3 = "")
        {
            if (isset($this->session->userdata['member_id'])) 
            {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    $page_data['title'] = "Warning and Suspensions || " . $this->system_title;
                    $page_data['top'] = "warning.php";
                    $page_data['page'] = "warning";
                    $page_data['bottom'] = "warning.php";


                    $this->load->view('front/index', $page_data);
                }
            }
            else
            {
                $page_data['title'] = "Warning and Suspensions || " . $this->system_title;
                $page_data['top'] = "warning.php";
                $page_data['page'] = "warning";
                $page_data['bottom'] = "warning.php";


                $this->load->view('front/index', $page_data);
            }
        }


        function video_upload()
        {
                $this->load->helper('string');

                if (isset($_FILES['video']['name']) && $_FILES['video']['name'] == '') {
                  redirect(base_url() . 'home/profile', 'refresh');
                }

                if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {

                    $memberId = $this->session->userdata('member_id');

                    $dir = './video/' . $memberId;
                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    $date = date("ymd");
                    $configVideo['upload_path'] = $dir;
                    $configVideo['max_size'] = '10000';
                    $configVideo['allowed_types'] = 'mp4|3gp|ogg|wmv|webm|flv|avi';
                    $configVideo['overwrite'] = FALSE;
                    $configVideo['remove_spaces'] = TRUE;
                    $video_name = random_string('numeric', 7) . $date;
                    $configVideo['file_name'] = $video_name;

                    $this->load->library('upload', $configVideo);
                    $this->upload->initialize($configVideo);
                    if (!$this->upload->do_upload('video'))
                    {
                        $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                        if ($isProfileCompleted == 0) {
                            $this->session->set_flashdata('alert', 'video_error');
                            $this->session->video_error = $this->upload->display_errors();
                            redirect(base_url() . 'home/profile_detail', 'refresh');
                        }
                        else
                        {
                            $this->session->set_flashdata('alert', 'video_error');
                            $this->session->video_error = $this->upload->display_errors();
                            redirect(base_url() . 'home/profile', 'refresh');
                        }
                    }
                    else
                    {
                        $videoDetails = $this->upload->data();

                        $videoExt = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);

                        $data['member_id'] = $memberId;
                        $data['item_name'] = $video_name.'.'.$videoExt;
                        $data['item_type'] = "gallery_video";
                        $data['uploaded_date'] = date('Y-m-d H:i:s');

                        $result = $this->db->insert('gallery_items', $data);
                        $lastItem_id = $this->db->insert_id();

                        $updateData['is_approved'] = 2; // Pending for admin approval
                        $this->db->where('item_id', $lastItem_id);
                        $this->db->update('gallery_items', $updateData);
                        recache();

                        $data1['video_gallery'] = 0;
                        $this->db->where('member_id', $memberId);
                        $this->db->update('member', $data1);

                        $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                        $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $memberId")->result();

                        $this->Email_model->video_submission_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);

                        if ($isProfileCompleted == 0) {
                            $this->session->set_flashdata('alert', 'add');
                            $this->session->set_flashdata('alert', 'add_video');
                            redirect(base_url() . 'home/profile_detail', 'refresh');
                        }
                        else
                        {
                            $this->session->set_flashdata('alert', 'add');
                            $this->session->set_flashdata('alert', 'add_video');
                            redirect(base_url() . 'home/profile', 'refresh');
                        }
                    }
                }
        }

        function gallery_upload($para1)
        {

            if ($this->member_permission() == FALSE) {
                redirect(base_url() . 'home/login', 'refresh');
            }

            if ($para1 == "add") {
                $member_id = $this->session->userdata('member_id');
                $photo_gallery_amount = $this->db->get_where('member', array('member_id' => $member_id))->row()->photo_gallery;
                if ($photo_gallery_amount > 0) {
                    if ($_FILES['image']['name'] !== '' && $_FILES['image']['size']<=2000000 && $_FILES['image']['size'] != 0)
                    {
                        $allowedExt = array('.jpg', '.JPG', '.jpeg','.JPEG', '.png', '.PNG');
                        $filename = $_FILES['image']['name'];
                        $ext = '.' . pathinfo($filename, PATHINFO_EXTENSION);
                        if (!in_array($ext, $allowedExt))
                        {
                            $this->session->set_flashdata('alert', 'failed');
                        }
                        else
                        {
                            $memberId = $this->session->userdata('member_id');

                            $dir = './uploads/gallery_image/' . $memberId;
                            if (!file_exists($dir)) {
                                mkdir($dir, 0777, true);
                            }
                            move_uploaded_file($_FILES['image']['tmp_name'], $dir ."/". $_FILES['image']['name']);

                            $itemName = $_FILES['image']['name'];

                            $data['member_id'] = $memberId;
                            $data['item_name'] = $itemName;
                            $data['item_type'] = "gallery_image";
                            $data['image_title'] = $this->input->post('title');
                            $data['uploaded_date'] = date('Y-m-d H:i:s');

                            $result = $this->db->insert('gallery_items', $data);
                            $lastItem_id = $this->db->insert_id();

                            $updateData['is_approved'] = 2; // Pending for admin approval
                            $this->db->where('item_id', $lastItem_id);
                            $this->db->update('gallery_items', $updateData);

                            $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $memberId")->result();

                            $this->Email_model->photo_submission_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);
                            
                            recache();

                        }
                        if (isset($result)) {
                            $data1['photo_gallery'] = $photo_gallery_amount - 1;
                            $this->db->where('member_id', $memberId);
                            $this->db->update('member', $data1);
                            recache();

                            $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                            if ($isProfileCompleted == 0) {
                                $this->session->set_flashdata('alert', 'add_gallery');
                                redirect(base_url() . 'home/profile_detail', 'refresh');
                            }
                            else
                            {
                                $this->session->set_flashdata('alert', 'add_gallery');
                                redirect(base_url() . 'home/profile', 'refresh');
                            }
                        }
                        else
                        {
                            $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                            if ($isProfileCompleted == 0) {
                                $this->session->set_flashdata('alert', 'failed');
                                redirect(base_url() . 'home/profile_detail', 'refresh');
                            }
                            else
                            {
                                $this->session->set_flashdata('alert', 'failed');
                                redirect(base_url() . 'home/profile', 'refresh');
                            }
                        }
                    }
                    else
                    {
                        $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                        if ($isProfileCompleted == 0) {
                            $this->session->set_flashdata('alert', 'size_error');
                            redirect(base_url() . 'home/profile_detail', 'refresh');
                        }
                        else
                        {
                            $this->session->set_flashdata('alert', 'size_error');
                            redirect(base_url() . 'home/profile', 'refresh');
                        }
                        
                    }

                }
                else
                {
                    redirect(base_url() . 'home/profile', 'refresh');
                }
            }
    }

        function delete_gallery_img($index)
        {
            $member_id = $this->session->userdata('member_id');
            $image_name = $this->db->get_where('gallery_items', array('item_id' => $index))->row()->item_name;

            $this->db->where('item_id', $index);
            $this->db->delete('gallery_items');
            unlink('uploads/gallery_image/'. $member_id . "/" . $image_name);

            $photo_gallery_amount = $this->db->get_where('member', array('member_id' => $member_id))->row()->photo_gallery;
            
            $data1['photo_gallery'] = $photo_gallery_amount + 1;
            $this->db->where('member_id', $member_id);
            $this->db->update('member', $data1);

            recache();
        }

        function delete_gallery_video($index)
        {
            $member_id = $this->session->userdata('member_id');

            $video_name = $this->db->get_where('gallery_items', array('item_id' => $index))->row()->item_name;

            $this->db->where('item_id', $index);
            $this->db->delete('gallery_items');
            unlink('video/'. $member_id . "/" . $video_name);

            $videoGalleryQuota = $this->Crud_model->get_type_name_by_id('member', $member_id, 'video_gallery');

            $data1['video_gallery'] = $videoGalleryQuota + 1;

            $this->db->where('member_id', $member_id);
            $this->db->update('member', $data1);
            recache();
        }

        function ajax_story_list($para1 = "", $para2 = "")
        {
                $this->load->library('Ajax_pagination');

                $config['total_rows'] = $this->db->get_where('happy_story', array('approval_status' => 1))->num_rows();

                // pagination
                $config['base_url'] = base_url() . 'home/ajax_story_list/';
                $config['per_page'] = 3;
                $config['uri_segment'] = 5;
                $config['cur_page_giv'] = $para1;

                $function = "filter_stories('0')";
                $config['first_link'] = '&laquo;';
                $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['first_tag_close'] = '</a></li>';

                $rr = ($config['total_rows'] - 1) / $config['per_page'];
                $last_start = floor($rr) * $config['per_page'];
                $function = "filter_stories('" . $last_start . "')";
                $config['last_link'] = '&raquo;';
                $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['last_tag_close'] = '</a></li>';

                $function = "filter_stories('" . ($para1 - $config['per_page']) . "')";
                $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['prev_tag_close'] = '</a></li>';

                $function = "filter_stories('" . ($para1 + $config['per_page']) . "')";
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['next_tag_close'] = '</a></li>';

                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';

                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

                $function = "filter_stories(((this.innerHTML-1)*" . $config['per_page'] . "))";
                $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['num_tag_close'] = '</a></li>';
                $this->ajax_pagination->initialize($config);

                $page_data['get_all_stories'] = $this->db->get_where('happy_story', array('approval_status' => 1), $config['per_page'], $para1)->result();

                $page_data['count'] = $config['total_rows'];

                $this->load->view('front/stories/stories', $page_data);
        }

        function ajax_my_interest_list($para1 = "", $para2 = "")
        {
                $this->load->library('Ajax_pagination');

                $total_interests = json_decode($this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'interest'), true);
                $config['total_rows'] = count($total_interests);

                // pagination
                $config['base_url'] = base_url() . 'home/ajax_my_interest_list/';
                $config['per_page'] = 10;
                $config['uri_segment'] = 5;
                $config['cur_page_giv'] = $para1;

                $function = "filter_my_interets('0')";
                $config['first_link'] = '&laquo;';
                $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['first_tag_close'] = '</a></li>';

                $rr = ($config['total_rows'] - 1) / $config['per_page'];
                $last_start = floor($rr) * $config['per_page'];
                $function = "filter_my_interets('" . $last_start . "')";
                $config['last_link'] = '&raquo;';
                $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['last_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
                $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['prev_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['next_tag_close'] = '</a></li>';

                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';

                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

                $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
                $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['num_tag_close'] = '</a></li>';
                $this->ajax_pagination->initialize($config);
                $total_interests_ids = array();
                foreach ($total_interests as $total_interest) {
                        array_push($total_interests_ids, $total_interest['id']);
                }
                if (count($total_interests) != 0) {
                        $page_data['express_interest_members'] = $this->db->from('member')->where_in('member_id', $total_interests_ids)->limit($config['per_page'], $para1)->get()->result();
                        $page_data['array_total_interests'] = $total_interests;
                } else {
                        $page_data['express_interest_members'] = NULL;
                }
                $page_data['count'] = $config['total_rows'];


                $this->load->view('front/profile/my_interests/ajax_interest', $page_data);
        }

        function ajax_short_list($para1 = "", $para2 = "")
        {

                $this->load->library('Ajax_pagination');

                $total_shortlist = json_decode($this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'short_list'), true);
                $config['total_rows'] = count($total_shortlist);

                // pagination
                $config['base_url'] = base_url() . 'home/ajax_short_list/';
                $config['per_page'] = 10;
                $config['uri_segment'] = 5;
                $config['cur_page_giv'] = $para1;

                $function = "filter_my_interets('0')";
                $config['first_link'] = '&laquo;';
                $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['first_tag_close'] = '</a></li>';

                $rr = ($config['total_rows'] - 1) / $config['per_page'];
                $last_start = floor($rr) * $config['per_page'];
                $function = "filter_my_interets('" . $last_start . "')";
                $config['last_link'] = '&raquo;';
                $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['last_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
                $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['prev_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['next_tag_close'] = '</a></li>';

                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';

                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

                $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
                $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['num_tag_close'] = '</a></li>';
                $this->ajax_pagination->initialize($config);
                if (count($total_shortlist) != 0) {
                        $page_data['express_shortlist_members'] = $this->db->from('member')->where_in('member_id', $total_shortlist)->limit($config['per_page'], $para1)->get()->result();
                } else {
                        $page_data['express_shortlist_members'] = NULL;
                }
                $page_data['count'] = $config['total_rows'];

                $this->load->view('front/profile/short_list/ajax_shortlist', $page_data);
        }

        function ajax_followed_list($para1 = "", $para2 = "")
        {

                $this->load->library('Ajax_pagination');

                $total_followed_list = json_decode($this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'followed'), true);
                $config['total_rows'] = count($total_followed_list);

                // pagination
                $config['base_url'] = base_url() . 'home/ajax_followed_list/';
                $config['per_page'] = 10;
                $config['uri_segment'] = 5;
                $config['cur_page_giv'] = $para1;

                $function = "filter_my_interets('0')";
                $config['first_link'] = '&laquo;';
                $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['first_tag_close'] = '</a></li>';

                $rr = ($config['total_rows'] - 1) / $config['per_page'];
                $last_start = floor($rr) * $config['per_page'];
                $function = "filter_my_interets('" . $last_start . "')";
                $config['last_link'] = '&raquo;';
                $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['last_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
                $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['prev_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['next_tag_close'] = '</a></li>';

                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';

                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

                $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
                $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['num_tag_close'] = '</a></li>';
                $this->ajax_pagination->initialize($config);
                if (count($total_followed_list) != 0) {
                        $page_data['followed_members_data'] = $this->db->from('member')->where_in('member_id', $total_followed_list)->limit($config['per_page'], $para1)->get()->result();
                } else {
                        $page_data['followed_members_data'] = NULL;
                }

                $page_data['count'] = $config['total_rows'];

                $this->load->view('front/profile/followed_users/ajax_followed_list', $page_data);
        }

        function ajax_ignored_list($para1 = "", $para2 = "")
        {

                $this->load->library('Ajax_pagination');

                $total_ignored = json_decode($this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'ignored'), true);
                $config['total_rows'] = count($total_ignored);

                // pagination
                $config['base_url'] = base_url() . 'home/ajax_followed_list/';
                $config['per_page'] = 10;
                $config['uri_segment'] = 5;
                $config['cur_page_giv'] = $para1;

                $function = "filter_my_interets('0')";
                $config['first_link'] = '&laquo;';
                $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['first_tag_close'] = '</a></li>';

                $rr = ($config['total_rows'] - 1) / $config['per_page'];
                $last_start = floor($rr) * $config['per_page'];
                $function = "filter_my_interets('" . $last_start . "')";
                $config['last_link'] = '&raquo;';
                $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['last_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
                $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['prev_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['next_tag_close'] = '</a></li>';

                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';

                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

                $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
                $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['num_tag_close'] = '</a></li>';
                $this->ajax_pagination->initialize($config);
                if (count($total_ignored) != 0) {
                        $page_data['ignored_members_data'] = $this->db->from('member')->where_in('member_id', $total_ignored)->limit($config['per_page'], $para1)->get()->result();
                } else {
                        $page_data['ignored_members_data'] = NULL;
                }

                $page_data['count'] = $config['total_rows'];

                $this->load->view('front/profile/ignored_list/ajax_ignored', $page_data);
        }

        function ajax_payment_list($para1 = "", $para2 = "")
        {

                $this->load->library('Ajax_pagination');

                $total_payment = $this->db->order_by("purchase_datetime", "desc")->get_where('package_payment', array('member_id' => $this->session->userdata('member_id')))->result();
                $config['total_rows'] = count($total_payment);

                // pagination
                $config['base_url'] = base_url() . 'home/ajax_followed_list/';
                $config['per_page'] = 10;
                $config['uri_segment'] = 5;
                $config['cur_page_giv'] = $para1;

                $function = "filter_my_interets('0')";
                $config['first_link'] = '&laquo;';
                $config['first_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['first_tag_close'] = '</a></li>';

                $rr = ($config['total_rows'] - 1) / $config['per_page'];
                $last_start = floor($rr) * $config['per_page'];
                $function = "filter_my_interets('" . $last_start . "')";
                $config['last_link'] = '&raquo;';
                $config['last_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['last_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 - $config['per_page']) . "')";
                $config['prev_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['prev_tag_close'] = '</a></li>';

                $function = "filter_my_interets('" . ($para1 + $config['per_page']) . "')";
                $config['next_link'] = '>';
                $config['next_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['next_tag_close'] = '</a></li>';

                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';

                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
                $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

                $function = "filter_my_interets(((this.innerHTML-1)*" . $config['per_page'] . "))";
                $config['num_tag_open'] = '<li class="page-item"><a class="page-link" onClick="' . $function . '">';
                $config['num_tag_close'] = '</a></li>';
                $this->ajax_pagination->initialize($config);

                $page_data['payments_info'] = $this->db->order_by("purchase_datetime", "desc")->get_where('package_payment', array('member_id' => $this->session->userdata('member_id')), $config['per_page'], $para1)->result();
                $page_data['array_total_payment'] = $total_payment;

                $page_data['count'] = $config['total_rows'];
                $page_data['page']  = $para1;

                $this->load->view('front/profile/payments/ajax_payment', $page_data);
        }


        function output_cache($val = TRUE)
        {
                $get_ranger = config_key_provider('config');
                $get_ranger_val = config_key_provider('output');
                $analysed_val = config_key_provider('background');
                @$ranger = $get_ranger($analysed_val);
                if (isset($ranger)) {
                        if ($ranger > $get_ranger_val() - 345678) {
                                $val = 0;
                        }
                }
                if ($val !== 0) {
                        $this->cache_setup();
                }
        }

        function contact_us($para1 = "", $para2 = "")
        {
            if (isset($this->session->userdata['member_id'])) 
            {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                    $this->load->library('recaptcha');
                    }
                    if ($para1 == "") {
                        $page_data['title'] = "Contact Us || " . $this->system_title;
                        $page_data['top'] = "contact_us.php";
                        $page_data['page'] = "contact_us";
                        $page_data['bottom'] = "contact_us.php";
                        if ($this->session->flashdata('alert') == "success") {
                                $page_data['success_alert'] = translate("your_message_has_been_successfully_sent!");
                        }
                        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                $page_data['recaptcha_html'] = $this->recaptcha->render();
                        }
                        $this->load->view('front/index', $page_data);
                    }
                    if ($para1 == 'send') {
                        $safe = 'yes';
                        $char = '';
                        foreach ($_POST as $row) {
                                if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                                        $safe = 'no';
                                        $char = $match[0];
                                }
                        }
                        $this->form_validation->set_rules('name', 'Name', 'required');
                        $this->form_validation->set_rules('subject', 'Subject', 'required');
                        $this->form_validation->set_rules('message', 'Message', 'required');
                        $this->form_validation->set_rules('email', 'Email', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                // echo validation_errors();
                        } 
                        else 
                        {
                            if ($safe == 'yes') {
                                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                            $captcha_answer = $this->input->post('g-recaptcha-response');
                                            $response = $this->recaptcha->verifyResponse($captcha_answer);
                                            if ($response['success']) {
                                                    $data['name'] = $this->input->post('name', true);
                                                    $data['subject'] = $this->input->post('subject');
                                                    $data['email'] = $this->input->post('email');
                                                    $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                                                    $data['view'] = 'no';
                                                    $data['timestamp'] = time();
                                                    $this->db->insert('contact_message', $data);

                                                    $this->Email_model->send_contact_us($data['email'], $data['message']);
													
													$con_data['contact_send'] = 1;
													$con_data['value'] = 'contact_send';
													$this->load->view('front/custom_thank_you' , $con_data);
                                            } else {
                                                    $page_data['title'] = "Contact Us || " . $this->system_title;
                                                    $page_data['top'] = "contact_us.php";
                                                    $page_data['page'] = "contact_us";
                                                    $page_data['bottom'] = "contact_us.php";

                                                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                                            $page_data['recaptcha_html'] = $this->recaptcha->render();
                                                    }
                                                    $page_data['captcha_incorrect'] = TRUE;
                                                    $page_data['form_contents'] = $this->input->post();
                                                    $this->load->view('front/index', $page_data);
                                            }
                                    } else {
                                            $data['name'] = $this->input->post('name', true);
                                            $data['subject'] = $this->input->post('subject');
                                            $data['email'] = $this->input->post('email');
                                            $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                                            $data['view'] = 'no';
                                            $data['timestamp'] = time();
                                            $this->db->insert('contact_message', $data);

                                            $this->session->set_flashdata('alert', 'success');

                                            $this->Email_model->send_contact_us($data['email'], $data['message']);

                                            redirect(base_url() . 'home/contact_us', 'refresh');
                                    }
                            } else {
                                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                            }
                        }
                    }
                }
            }
            else
            {
                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                    $this->load->library('recaptcha');
                }
                if ($para1 == "") {
                    $page_data['title'] = "Contact Us || " . $this->system_title;
                    $page_data['top'] = "contact_us.php";
                    $page_data['page'] = "contact_us";
                    $page_data['bottom'] = "contact_us.php";
                    if ($this->session->flashdata('alert') == "success") {
                            $page_data['success_alert'] = translate("your_message_has_been_successfully_sent!");
                    }
                    if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                            $page_data['recaptcha_html'] = $this->recaptcha->render();
                    }
                    $this->load->view('front/index', $page_data);
                }
                if ($para1 == 'send') {
                    $safe = 'yes';
                    $char = '';
                    foreach ($_POST as $row) {
                            if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                                    $safe = 'no';
                                    $char = $match[0];
                            }
                    }
                    $this->form_validation->set_rules('name', 'Name', 'required');
                    $this->form_validation->set_rules('subject', 'Subject', 'required');
                    $this->form_validation->set_rules('message', 'Message', 'required');
                    $this->form_validation->set_rules('email', 'Email', 'required');

                    if ($this->form_validation->run() == FALSE) {
                            // echo validation_errors();
                    } 
                    else 
                    {
                        if ($safe == 'yes') {
                                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                        $captcha_answer = $this->input->post('g-recaptcha-response');
                                        $response = $this->recaptcha->verifyResponse($captcha_answer);
                                        if ($response['success']) {
                                                $data['name'] = $this->input->post('name', true);
                                                $data['subject'] = $this->input->post('subject');
                                                $data['email'] = $this->input->post('email');
                                                $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                                                $data['view'] = 'no';
                                                $data['timestamp'] = time();
                                                $this->db->insert('contact_message', $data);

                                                $this->Email_model->send_contact_us($data['email'], $data['message']);
												
												$cdata['contact_send'] = 1;
												$cdata['value'] = 'contact';
												$this->load->view('front/custom_thank_you' ,$cdata);
                                                //echo 'sent';
                                        } else {
                                                $page_data['title'] = "Contact Us || " . $this->system_title;
                                                $page_data['top'] = "contact_us.php";
                                                $page_data['page'] = "contact_us";
                                                $page_data['bottom'] = "contact_us.php";

                                                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                                        $page_data['recaptcha_html'] = $this->recaptcha->render();
                                                }
                                                $page_data['captcha_incorrect'] = TRUE;
                                                $page_data['form_contents'] = $this->input->post();
                                                $this->load->view('front/index', $page_data);
                                        }
                                } else {
                                        $data['name'] = $this->input->post('name', true);
                                        $data['subject'] = $this->input->post('subject');
                                        $data['email'] = $this->input->post('email');
                                        $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                                        $data['view'] = 'no';
                                        $data['timestamp'] = time();
                                        $this->db->insert('contact_message', $data);

                                        $this->session->set_flashdata('alert', 'success');

                                        $this->Email_model->send_contact_us($data['email'], $data['message']);

                                        redirect(base_url() . 'home/contact_us', 'refresh');
                                }
                        } else {
                                echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                        }
                    }
                }
            }
        }
	
        function contact_message_send(){
            $data['value'] = "contact_send";
            $data['contact_send'] = 1;
            $this->load->view('front/custom_thank_you' , $data);
        }

        function process_payment()
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/login', 'refresh');
                }
                if ($this->input->post('payment_type') == 'paypal') {
                        $member_id = $this->session->userdata('member_id');
                        $payment_type = $this->input->post('payment_type');
                        $plan_id = $this->input->post('plan_id');
                        $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
                        $package_name = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->name;

                        $data['plan_id']            = $plan_id;
                        $data['member_id']          = $member_id;
                        $data['payment_type']       = 'Paypal';
                        $data['payment_status']     = 'due';
                        $data['payment_details']    = 'none';
                        $exchange = exchange('usd');
                        $amount = $amount / $exchange;
                        $data['amount']             = $amount;
                        $data['purchase_datetime']  = time();

                        $paypal_email = $this->Crud_model->get_settings_value('business_settings', 'paypal_email', 'value');

                        $this->db->insert('package_payment', $data);
                        $payment_id = $this->db->insert_id();

                        $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;

                        $this->session->set_userdata('payment_id', $payment_id);

                        /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                        $this->paypal->add_field('rm', 2);
                        $this->paypal->add_field('cmd', '_xclick');
                        $this->paypal->add_field('business', $paypal_email);
                        $this->paypal->add_field('item_name', $package_name);
                        $this->paypal->add_field('amount', $amount);
                        $this->paypal->add_field('currency_code', 'USD');
                        $this->paypal->add_field('custom', $payment_id);

                        $this->paypal->add_field('notify_url', base_url() . 'home/paypal_ipn');
                        $this->paypal->add_field('cancel_return', base_url() . 'home/paypal_cancel');
                        $this->paypal->add_field('return', base_url() . 'home/paypal_success');

                        // submit the fields to paypal
                        $this->paypal->submit_paypal_post();
                } else if ($this->input->post('payment_type') == 'stripe') {
                        if ($this->input->post('stripeToken')) {
                                $member_id = $this->session->userdata('member_id');
                                $payment_type = $this->input->post('payment_type');
                                $plan_id = $this->input->post('plan_id');
                                $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
                                $exchange = exchange('usd');
                                $amount = $amount / $exchange;


                                require_once(APPPATH . 'libraries/stripe-php/init.php');
                                $stripe_api_key = $this->db->get_where('business_settings', array('type' => 'stripe_secret_key'))->row()->value;
                                \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                                $user_email = $this->session->userdata('member_email');

                                $user = \Stripe\Customer::create(array(
                                        'email' => $user_email, // member email id
                                        'card'  => $_POST['stripeToken']
                                ));

                                $charge = \Stripe\Charge::create(array(
                                        'customer'  => $user->id,
                                        'amount'    => ceil($amount * 100),
                                        'currency'  => 'USD'
                                ));
                                if ($charge->paid == true) {
                                        $user = (array) $user;
                                        $charge = (array) $charge;

                                        $data['plan_id']            = $plan_id;
                                        $data['member_id']          = $member_id;
                                        $data['payment_type']       = 'Stripe';
                                        $data['payment_status']     = 'paid';
                                        $data['payment_details']    = "User Info: \n" . json_encode($user, true) . "\n \n Charge Info: \n" . json_encode($charge, true);
                                        $data['amount']             = $amount;
                                        $data['purchase_datetime']  = time();
                                        $data['expire']             = 'no';

                                        $this->db->insert('package_payment', $data);
                                        $payment_id = $this->db->insert_id();

                                        $data1['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
                                        $data1['payment_timestamp'] = time();

                                        $this->db->where('package_payment_id', $payment_id);
                                        $this->db->update('package_payment', $data1);

                                        $payment = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();
                                        $prev_express_interest =  $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->express_interest;
                                        $prev_direct_messages = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->direct_messages;
                                        $prev_photo_gallery = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->photo_gallery;

                                        $data2['membership'] = 2;
                                        $data2['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->express_interest;
                                        $data2['direct_messages'] = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->direct_messages;
                                        $data2['photo_gallery'] = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->photo_gallery;

                                        $package_info[] = array(
                                                'current_package'   => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id),
                                                'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id, 'amount'),
                                                'payment_type'      => $data['payment_type'],
                                        );
                                        $data2['package_info'] = json_encode($package_info);

                                        $this->db->where('member_id', $payment->member_id);
                                        $this->db->update('member', $data2);
                                        recache();

                                        if ($this->Email_model->subscruption_email('member', $payment->member_id, $payment->plan_id)) {
                                                //$this->session->set_flashdata('alert', 'email_sent');
                                        } else {
                                                $this->session->set_flashdata('alert', 'not_sent');
                                        }

                                        $this->session->set_flashdata('alert', 'stripe_success');
                                        redirect(base_url() . 'home/invoice/' . $payment->package_payment_id, 'refresh');
                                } else {
                                        $this->session->set_flashdata('alert', 'stripe_failed');
                                        redirect(base_url() . 'home/plans', 'refresh');
                                }
                        }
                } else if ($this->input->post('payment_type') == 'pum') {
                        $member_id = $this->session->userdata('member_id');
                        $payment_type = $this->input->post('payment_type');
                        $plan_id = $this->input->post('plan_id');
                        $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
                        $package_name = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->name;
                        $member_name = $this->db->get_where('member', array('member_id' => $member_id))->row()->first_name;
                        $member_email = $this->db->get_where('member', array('member_id' => $member_id))->row()->email;
                        $member_phone = $this->db->get_where('member', array('member_id' => $member_id))->row()->mobile;

                        $data['plan_id']            = $plan_id;
                        $data['member_id']          = $member_id;
                        $data['payment_type']       = 'payUMoney';
                        $data['payment_status']     = 'due';
                        $data['payment_details']    = 'none';
                        $data['amount']             = $amount;
                        $data['purchase_datetime']  = time();

                        $pum_merchant_key = $this->Crud_model->get_settings_value('business_settings', 'pum_merchant_key', 'value');
                        $pum_merchant_salt = $this->Crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

                        $this->db->insert('package_payment', $data);
                        $payment_id = $this->db->insert_id();

                        $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;

                        $this->session->set_userdata('payment_id', $payment_id);

                        /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                        $this->pum->add_field('key', $pum_merchant_key);
                        $this->pum->add_field('txnid', substr(hash('sha256', mt_rand() . microtime()), 0, 20));
                        $this->pum->add_field('amount', $amount);
                        $this->pum->add_field('firstname', $member_name);
                        $this->pum->add_field('email', $member_email);
                        $this->pum->add_field('phone', $member_phone);
                        $this->pum->add_field('productinfo', 'Package Purchage : ' . $package_name);
                        $this->pum->add_field('service_provider', 'payu_paisa');
                        $this->pum->add_field('udf1', $payment_id);

                        $this->pum->add_field('surl', base_url() . 'home/pum_success');
                        $this->pum->add_field('furl', base_url() . 'home/pum_failure');

                        // submit the fields to pum
                        $this->pum->submit_pum_post();
                }
        }

        /* FUNCTION: Verify paypal payment by IPN*/
        function paypal_ipn()
        {
                if ($this->paypal->validate_ipn() == true) {

                        $payment_id                = $_POST['custom'];
                        $payment                   = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();
                        $data['payment_details']   = json_encode($_POST);
                        $data['purchase_datetime'] = time();
                        $data['payment_code']      = date('Ym', $data['purchase_datetime']) . $payment_id;
                        $data['payment_timestamp'] = time();
                        $data['payment_type']      = 'Paypal';
                        $data['payment_status']    = 'paid';
                        $data['expire']            = 'no';
                        $this->db->where('package_payment_id', $payment_id);
                        $this->db->update('package_payment', $data);

                        $prev_express_interest =  $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->express_interest;
                        $prev_direct_messages = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->direct_messages;
                        $prev_photo_gallery = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->photo_gallery;

                        $data1['membership'] = 2;
                        $data1['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->express_interest;
                        $data1['direct_messages'] = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->direct_messages;
                        $data1['photo_gallery'] = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->photo_gallery;

                        $package_info[] = array(
                                'current_package'   => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id),
                                'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id, 'amount'),
                                'payment_type'      => $data['payment_type'],
                        );
                        $data1['package_info'] = json_encode($package_info);

                        $this->db->where('member_id', $payment->member_id);
                        $this->db->update('member', $data1);
                        recache();

                        if ($this->Email_model->subscruption_email('member', $payment->member_id, $payment->plan_id)) {
                                //echo 'email_sent';
                        } else {
                                //echo 'email_not_sent';
                                $this->session->set_flashdata('alert', 'not_sent');
                        }
                }
        }

        /* FUNCTION: Loads after cancelling paypal*/
        function paypal_cancel()
        {
                $payment_id = $this->session->userdata('payment_id');
                $this->db->where('package_payment_id', $payment_id);
                $this->db->delete('package_payment');
                recache();
                $this->session->set_userdata('payment_id', '');
                $this->session->set_flashdata('alert', 'paypal_cancel');
                redirect(base_url() . 'home/plans', 'refresh');
        }

        /* FUNCTION: Loads after successful paypal payment*/
        function paypal_success()
        {
                $this->session->set_flashdata('alert', 'paypal_success');
                redirect(base_url() . 'home/invoice/' . $this->session->userdata('payment_id'), 'refresh');
                $this->session->set_userdata('payment_id', '');
        }

        /* FUNCTION: Verify paypal payment by IPN*/
        function pum_success()
        {
                $status         =   $_POST["status"];
                $firstname      =   $_POST["firstname"];
                $amount         =   $_POST["amount"];
                $txnid          =   $_POST["txnid"];
                $posted_hash    =   $_POST["hash"];
                $key            =   $_POST["key"];
                $productinfo    =   $_POST["productinfo"];
                $email          =   $_POST["email"];
                $udf1           =   $_POST['udf1'];
                $salt           =   $this->Crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

                if (isset($_POST["additionalCharges"])) {
                        $additionalCharges = $_POST["additionalCharges"];
                        $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
                } else {
                        $retHashSeq = $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
                }
                $hash = hash("sha512", $retHashSeq);

                if ($hash != $posted_hash) {
                        $payment_id = $this->session->userdata('payment_id');
                        $this->db->where('package_payment_id', $payment_id);
                        $this->db->delete('package_payment');
                        recache();
                        $this->session->set_userdata('payment_id', '');
                        $this->session->set_flashdata('alert', 'pum_fail');
                        redirect(base_url() . 'home/plans', 'refresh');
                } else {
                        $payment_id                = $_POST['udf1'];
                        $payment                   = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();
                        $data['payment_details']   = json_encode($_POST);
                        $data['purchase_datetime'] = time();
                        $data['payment_code']      = date('Ym', $data['purchase_datetime']) . $payment_id;
                        $data['payment_timestamp'] = time();
                        $data['payment_type']      = 'PayUMoney';
                        $data['payment_status']    = 'paid';
                        $data['expire']            = 'no';
                        $this->db->where('package_payment_id', $payment_id);
                        $this->db->update('package_payment', $data);

                        $prev_express_interest =  $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->express_interest;
                        $prev_direct_messages = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->direct_messages;
                        $prev_photo_gallery = $this->db->get_where('member', array('member_id' => $payment->member_id))->row()->photo_gallery;

                        $data1['membership'] = 2;
                        $data1['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->express_interest;
                        $data1['direct_messages'] = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->direct_messages;
                        $data1['photo_gallery'] = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $payment->plan_id))->row()->photo_gallery;

                        $package_info[] = array(
                                'current_package'   => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id),
                                'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $payment->plan_id, 'amount'),
                                'payment_type'      => $data['payment_type'],
                        );
                        $data1['package_info'] = json_encode($package_info);

                        $this->db->where('member_id', $payment->member_id);
                        $this->db->update('member', $data1);
                        recache();

                        if ($this->Email_model->subscruption_email('member', $payment->member_id, $payment->plan_id)) {
                                //echo 'email_sent';
                        } else {
                                //echo 'email_not_sent';
                                $this->session->set_flashdata('alert', 'not_sent');
                        }
                        $this->session->set_flashdata('alert', 'pum_success');
                        redirect(base_url() . 'home/invoice/' . $this->session->userdata('payment_id'), 'refresh');
                        $this->session->set_userdata('payment_id', '');
                }
        }

        /* FUNCTION: Verify paypal payment by IPN*/
        function pum_failure()
        {
                $payment_id = $this->session->userdata('payment_id');
                $this->db->where('package_payment_id', $payment_id);
                $this->db->delete('package_payment');
                recache();
                $this->session->set_userdata('payment_id', '');
                $this->session->set_flashdata('alert', 'pum_fail');
                redirect(base_url() . 'home/plans', 'refresh');
        }


        function cache_setup()
        {
                $cache_markup = loaded_class_select('8:29:9:1:15:5:13:6:20');
                $write_cache = loaded_class_select('14:1:10:13');
                $cache_markup .= loaded_class_select('24');
                $cache_markup .= loaded_class_select('8:14:1:10:13');
                $cache_markup .= loaded_class_select('3:4:17:14');
                $cache_convert = config_key_provider('load_class');
                $currency_convert = config_key_provider('output');
                $background_inv = config_key_provider('background');
                @$cache = $write_cache($cache_markup, '', base_url());
                if ($cache) {
                        $cache_convert($background_inv, $currency_convert());
                }
        }

        function faq()
        {
            if (isset($this->session->userdata['member_id'])) 
            {
                $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                if ($isProfileCompleted == 0) {
                    redirect(base_url() . 'home/profile_detail', 'refresh');
                }
                else
                {
                    $page_data['title'] = "Contact Us || " . $this->system_title;
                    $page_data['top'] = "faq.php";
                    $page_data['page'] = "faq";
                    $page_data['bottom'] = "faq.php";

                    $this->load->view('front/index', $page_data);
                }
            }
            else
            {
                $page_data['title'] = "Contact Us || " . $this->system_title;
                $page_data['top'] = "faq.php";
                $page_data['page'] = "faq";
                $page_data['bottom'] = "faq.php";

                $this->load->view('front/index', $page_data);
            }
        }

        function terms_and_conditions()
        {
                $page_data['title'] = "Contact Us || " . $this->system_title;
                $page_data['top'] = "terms_and_conditions.php";
                $page_data['page'] = "terms_and_conditions";
                $page_data['bottom'] = "terms_and_conditions.php";
                $page_data['terms_and_conditions'] = $this->db->get_where('general_settings', array('type' => 'terms_conditions'))->row()->value;

                $this->load->view('front/index', $page_data);
        }

        function privacy_policy()
        {
                $page_data['title'] = "Privacy Policy || " . $this->system_title;
                $page_data['top'] = "privacy_policy.php";
                $page_data['page'] = "privacy_policy";
                $page_data['bottom'] = "privacy_policy.php";
                $page_data['privacy_policy'] = $this->db->get_where('general_settings', array('type' => 'privacy_policy'))->row()->value;

                $this->load->view('front/index', $page_data);
        }

        function login()
        {
                if ($this->member_permission() == TRUE) {
                        redirect(base_url() . 'home/', 'refresh');
                }
                if ($this->member_permission() == TRUE) {
                        redirect(base_url() . 'home/', 'refresh');
                } else {
                        $page_data['social_media'] = $this->db->where('status','enable')->get('social_media_settings')->result();
                        $page_data['page'] = "login";
                        $page_data['login_error'] = "";
                        if ($this->session->flashdata('alert') == "login_error") {
                                $page_data['login_error'] = translate('your_email_or_password_is_invalid!');
                        } elseif ($this->session->flashdata('alert') == "blocked") {
                                $page_data['login_error'] = translate('you_have_been_blocked_by_the_admin');
                        } elseif ($this->session->flashdata('alert') == "not_sent") {
                                $page_data['login_error'] = translate('error_sending_email');
                        } elseif ($this->session->flashdata('alert') == "not_sent") {
                                $page_data['login_error'] = translate('the_email_you_have_entered_is_invalid');
                        } elseif ($this->session->flashdata('alert') == "email_sent") {
                                $page_data['sent_email'] = translate('please_check_your_email_for_new_password');
                        } elseif ($this->session->flashdata('alert') == "register_success") {
                                $page_data['register_success'] = translate('you_have_registered_successfully._please_log_in_to_continue');
                        }
                        $this->load->view('front/login', $page_data);
                }
        }

        function check_login()
        {
            if ($this->member_permission() == TRUE) {
                    redirect(base_url() . 'home/', 'refresh');
            }
            else
            {
                $username = $this->input->post('email');
                $password = sha1($this->input->post('password'));

                $remember_me = $this->input->post('remember_me');

                $result = $this->Crud_model->check_login('member', $username, $password);

                $data = array();
                if ($result)
                {
                    if ($result->is_blocked == "no") {
                        $data['login_state'] = 'yes';
                        $data['member_id'] = $result->member_id;
                        $data['member_name'] = $result->first_name;
                        $data['member_email'] = $result->email;

                        if ($remember_me == 'checked') {
                                $this->session->set_userdata($data);
                                setcookie('cookie_member_id', $this->session->userdata('member_id'), time() + (1296000), "/");
                                setcookie('cookie_member_name', $this->session->userdata('member_name'), time() + (1296000), "/");
                                setcookie('cookie_member_email', $this->session->userdata('member_email'), time() + (1296000), "/");
                        } else {
                                $this->session->set_userdata($data);
                            // $this->session->set_userdata('login_state','yes');
                            // $this->session->set_userdata('member_id', $result->member_id);
                            // $this->session->set_userdata('member_name', $result->first_name);
                            // $this->session->set_userdata('member_email', $result->email);
                        }

                        $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

                        if ($isProfileCompleted == 1) {
                            redirect(base_url() . 'home/profile', 'refresh');
                        }
                        else
                        {
                            redirect(base_url() . 'home/profile_detail', 'refresh');
                        }


                    }
                    elseif ($result->is_blocked == "yes") {
                        $this->session->set_flashdata('alert', 'blocked');
                        redirect(base_url() . 'home/login', 'refresh');
                    }
                }
                else
                {
                    $this->session->set_flashdata('alert', 'login_error');
                    redirect(base_url() . 'home/login', 'refresh');
                }
            }
        }


        function profile_detail()
        {
            $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')))->result();
            $page_data['get_member_gallery_items'] = $this->db->get_where("gallery_items", array("member_id" => $this->session->userdata('member_id')))->result();
            if ($this->session->flashdata('alert') == "edit") {
                    $page_data['success_alert'] = translate("you_have_successfully_edited_your_profile!");
            } elseif ($this->session->flashdata('alert') == "edit_image") {
                    $page_data['success_alert'] = translate("you_have_successfully_edited_your_profile_image!");
            } elseif ($this->session->flashdata('alert') == "add_gallery") {
                    $page_data['success_alert'] = translate("you_have_successfully_added_the_photo_into_your_gallery!");
            } elseif ($this->session->flashdata('alert') == "add_gallery"){
                $page_data['success_alert'] = translate("you_have_successfully_added_the_photo_into_your_gallery!");
            }
            elseif ($this->session->flashdata('alert') == "failed"){
                $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
            }
            elseif ($this->session->flashdata('alert') == "size_error")
            {
                $page_data['danger_alert'] = translate("upload_failed. image_size_exceeds_2MB!");
            }
            elseif ($this->session->flashdata('alert') == "video_error")
            {
                $page_data['danger_alert'] = translate("failed_to_upload_your_video._make_sure_the_video_is_MP4 and 30 sec long!");
            } elseif ($this->session->flashdata('alert') == "add_story") {
                    $page_data['success_alert'] = translate("you_have_successfully_added_your_story._please_wait_till_it_is_approved!");
            } elseif ($this->session->flashdata('alert') == "failed_add_story") {
                    $page_data['danger_alert'] = translate("failed_to_add_your_story!");
            } elseif ($this->session->flashdata('alert') == "blocked") {
                    $page_data['danger_alert'] = translate("please_complete_your_profile");
            } elseif ($this->session->flashdata('success') == "complete_your_profile") {
                    $page_data['success_alert'] = translate("please_complete_your_profile");
            }

            $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

            if ($this->session->member_id != "" && $isProfileCompleted == 0) {
                $this->load->view('front/package_payment/profile_detail', $page_data);
            }
            else
            {
                redirect(base_url() . 'home/profile', 'refresh');
            }
        }

        function package_plans()
        {
            $page_data['all_plans'] = $this->db->get("plan")->result();

            $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

            if ($this->session->member_id != "" && $isProfileCompleted == 0) {
                $this->load->view('front/package_payment/plans', $page_data);
            }
            else
            {
                redirect(base_url() . 'home/profile', 'refresh');
            }
        }

        function platinum_plan()
        {
            $page_data['all_plans'] = $this->db->query("SELECT * FROM plan")->result();

            $isProfileCompleted = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'isProfileCompleted');

            if ($this->session->member_id != "" && $isProfileCompleted == 0) {
                $this->load->view('front/package_payment/platinum_plan', $page_data);
            }
            else
            {
                redirect(base_url() . 'home/profile', 'refresh');
            }
        }

        function markProfileCompleted($membership)
        {
            $member_id = $this->session->userdata['member_id'];
            $data['membership'] = $membership;
            $data['isProfileCompleted'] = 1;
            $data['photo_gallery'] = 1;

            $this->db->where('member_id', $member_id);
            $this->db->update('member', $data);

            $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $member_id")->result();

            $this->Email_model->bronze_activation_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);
            recache();

            echo "true";
        }

        function forget_pass($para1 = "")
        {

                    if ($para1 == "") {
                            $page_data['page'] = "forget_pass";

                            $this->load->view('front/forget_pass', $page_data);
                    } 
                    else if ($para1 == 'forget') {
                        $this->form_validation->set_rules('email', 'Email', 'required');

                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error'  =>  validation_errors());
                                echo json_encode($ajax_error);
                        } 
                        else 
                        {
                            $query = $this->db->get_where('member', array(
                                    'email' => $this->input->post('email')
                            ));
                            if ($query->num_rows() > 0) {
                                $member_id = $query->row()->member_id;

                                $package = $query->row()->membership;
                                if ($package == 1) {
                                    $membership = "Bronze";
                                }
                                elseif ($package == 2) {
                                    $membership = "Platinum";
                                }
                                elseif ($package == 3) {
                                    $membership = "Free";
                                }
                                elseif ($package == 4) {
                                    $membership = "Fake";
                                }
                                $plain_password = substr(md5(rand()), 0, 7);
                                $password = sha1($plain_password);
                                $data['plain_password'] = $plain_password;
                                $data['password'] = $password;

                                $this->Email_model->password_reset_email('member', $member_id, $plain_password, $membership);
                                $this->db->where('member_id', $member_id);
                                $this->db->update('member', $data);
                                recache();
                                $this->session->set_flashdata('alert', 'email_sent');
                            } 
                            else 
                            {
                                $this->session->set_flashdata('alert', 'no_email');
                            }

                            redirect(base_url() . 'home/login', 'refresh');
                        }
                }
        }

        function logout()
        {
                setcookie("cookie_member_id", "", time() - 3600, "/");
                setcookie("cookie_member_name", "", time() - 3600, "/");
                setcookie("cookie_member_email", "", time() - 3600, "/");
                $member_id = $this->session->userdata('member_id');
                $this->db->where('member_id', $member_id)->update('member', array('isOnline' => 0));
                $this->session->unset_userdata('login_state');
                $this->session->unset_userdata('member_id');
                $this->session->unset_userdata('member_name');
                $this->session->unset_userdata('member_email');

                // $this->session->sess_destroy();

                redirect(base_url() . 'home/', 'refresh');
        }

        function registration($para1 = "")
        {
                if ($this->member_permission() == TRUE) {
                        redirect(base_url() . 'home/', 'refresh');
                } else {
                        $page_data['social_media'] = $this->db->where('status','enable')->get('social_media_settings')->result();
                        recache();
                        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                $this->load->library('recaptcha');
                        }
                        // --------------------Check for Disallowed Characters-------------------- //
                        $safe = 'yes';
                        $char = '';
                        foreach ($_POST as $check => $row) {
                                if (preg_match('/[\'^":()}{#~><>|=¬]/', $row, $match)) {
                                        if ($check !== 'password' && $check !== 'confirm_password') {
                                                $safe = 'no';
                                                $char = $match[0];
                                        }
                                }
                        }
                        // --------------------Check for Disallowed Characters-------------------- //
                        if ($para1 == "") {
                                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                        $page_data['recaptcha_html'] = $this->recaptcha->render();
                                }
                                $page_data['page'] = "registration";
                                $this->load->view('front/registration', $page_data);
                        } elseif ($para1 == "add_info") {
                                //$this->form_validation->set_rules('first_name', 'First Name', 'required');
                                //$this->form_validation->set_rules('last_name', 'Last Name', 'required');
                                $this->form_validation->set_rules('user_name', 'User Name', 'required');
                                $this->form_validation->set_rules('gender', 'Gender', 'required');
                                $this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]|valid_email', array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
                                $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required|callback_validate_age');
                                $this->form_validation->set_rules('on_behalf', 'On Behalf', 'required');
                                $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
                                $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
                                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
                                $this->form_validation->set_rules('agree_terms', 'Agree Terms', 'required', array('required' => 'You must agree to the Terms & Conditions and Privacy Policy to continue.'));

                                if ($this->form_validation->run() == FALSE) {
                                        if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                                $page_data['recaptcha_html'] = $this->recaptcha->render();
                                        }
                                        $page_data['page'] = "registration";
                                        $page_data['form_contents'] = $this->input->post();
                                        $this->load->view('front/registration', $page_data);
                                } else {
                                        if ($safe == 'yes') {
                                            $data['highlight_new_member'] = 1;
                                                // ------------------------------------Profile Image------------------------------------ //
                                                $profile_image[] = array(
                                                        'profile_image'    =>  'default.jpg',
                                                        'thumb'         =>  'default_thumb.jpg'
                                                );
                                                $profile_image = json_encode($profile_image);
                                                // ------------------------------------Profile Image------------------------------------ //

                                                // ------------------------------------Basic Info------------------------------------ //
                                                $basic_info[] = array(
                                                        'on_behalf'             => '',
                                                        'residence'                =>        '',
                                                        'resident_status'        =>        '',
                                                        'my_sect'                                        =>        '',
                                                        'like_to_marry'             =>  '',
                                                        'grew_up'             =>  '',
                                                        'first_language'             =>  '',
                                                        'second_language'             =>  '',
                                                        'marital_status'             =>  '',
                                                        'Disabilities'             =>  '',
                                                        'living_with'             =>  '',
                                                        'profession'             =>  '',
                                                        'profile_made'             =>  ''

                                                );
                                                $basic_info = json_encode($basic_info);
                                                // ------------------------------------Basic Info------------------------------------ //

                                                // ------------------------------------Present Address------------------------------------ //
                                                $present_address[] = array(
                                                        'country'        => '',
                                                        'city'                  => '',
                                                        'state'                 => '',
                                                        'postal_code'           => ''
                                                );
                                                $present_address = json_encode($present_address);
                                                // ------------------------------------Present Address------------------------------------ //

                                                // ------------------------------------Education & Career------------------------------------ //
                                                $education_and_career[] = array(
                                                        'highest_education' => '',
                                                        'i_am_employed'                    => '',
                                                        'annual_income'                 => '',
                                                        'my_job_title'                 => '',
                                                        'my_company_name'                 => '',
                                                        'years_worked'                 => '',
                                                        'self_employed'                 => '',
                                                        'years_owned'                 => '',
                                                        'annual_income_self'                 => ''
                                                );
                                                $education_and_career = json_encode($education_and_career);
                                                // ------------------------------------Education & Career------------------------------------ //

                                                // ------------------------------------ Physical Attributes------------------------------------ //
                                                $physical_attributes[] = array(
                                                        'weight'     => '',
                                                        'eye_color'             => '',
                                                        'hair_color'            => '',
                                                        'complexion'            => '',
                                                        'blood_group'           => '',
                                                        'body_type'             => '',
                                                        'body_art'              => '',
                                                        'any_disability'        => '',
                                                        'exercise'        => ''
                                                );
                                                $physical_attributes = json_encode($physical_attributes);
                                                // ------------------------------------ Physical Attributes------------------------------------ //

                                                // ------------------------------------ Language------------------------------------ //
                                                $language[] = array(
                                                        'mother_tongue'         => '',
                                                        'language'              => '',
                                                        'speak'                 => '',
                                                        'read'                  => ''
                                                );
                                                $language = json_encode($language);
                                                // ------------------------------------ Language------------------------------------ //

                                                // ------------------------------------Hobbies & Interest------------------------------------ //
                                                $hobbies_and_interest[] = array(
                                                        'hobby'     => '',
                                                        'interest'              => '',
                                                        'music'                 => '',
                                                        'books'                 => '',
                                                        'movie'                 => '',
                                                        'tv_show'               => '',
                                                        'sports_show'           => '',
                                                        'fitness_activity'      => '',
                                                        'cuisine'               => '',
                                                        'dress_style'           => ''
                                                );
                                                $hobbies_and_interest = json_encode($hobbies_and_interest);
                                                // ------------------------------------Hobbies & Interest------------------------------------ //

                                                // ------------------------------------ Personal Attitude & Behavior------------------------------------ //
                                                $personal_attitude_and_behavior[] = array(
                                                        'affection'   => '',
                                                        'humor'                 => '',
                                                        'political_view'        => '',
                                                        'religious_service'     => ''
                                                );
                                                $personal_attitude_and_behavior = json_encode($personal_attitude_and_behavior);
                                                // ------------------------------------ Personal Attitude & Behavior------------------------------------ //

                                                // ------------------------------------Residency Information------------------------------------ //
                                                $residency_information[] = array(
                                                        'birth_country'    => '',
                                                        'residency_country'     => '',
                                                        'citizenship_country'   => '',
                                                        'grow_up_country'       => '',
                                                        'immigration_status'    => ''
                                                );
                                                $residency_information = json_encode($residency_information);
                                                // ------------------------------------Residency Information------------------------------------ //

                                                // ------------------------------------Spiritual and Social Background------------------------------------ //
                                                $spiritual_and_social_background[] = array(
                                                        'religion'   => '',
                                                        'caste'                 => '',
                                                        'sub_caste'             => '',
                                                        'ethnicity'             => '',
                                                        'u_manglik'             => '',
                                                        'personal_value'        => '',
                                                        'family_value'          => '',
                                                        'community_value'       => '',
                                                        'family_status'         =>  ''
                                                );
                                                $spiritual_and_social_background = json_encode($spiritual_and_social_background);
                                                // ------------------------------------Spiritual and Social Background------------------------------------ //

                                                // ------------------------------------ Life Style------------------------------------ //
                                                $life_style[] = array(
                                                        'diet'                => '',
                                                        'drink'                 => '',
                                                        'smoke'                 => '',
                                                        'living_with'           => ''
                                                );
                                                $life_style = json_encode($life_style);
                                                // ------------------------------------ Life Style------------------------------------ //

                                                // ------------------------------------ Astronomic Information------------------------------------ //
                                                $astronomic_information[] = array(
                                                        'muslim_i_am'    => '',
                                                        'revert'                 => '',
                                                        'convert'                 => '',
                                                        'do_i_fast'             => '',
                                                        'do_i_pray'             => '',
                                                        'do_i_eat_halal'             => '',
                                                        'women_only'             => '',
                                                        'wife_wear'             => '',
                                                );
                                                $astronomic_information = json_encode($astronomic_information);
                                                // ------------------------------------ Astronomic Information------------------------------------ //

                                                // ------------------------------------Permanent Address------------------------------------ //
                                                $permanent_address[] = array(
                                                        'permanent_country'    => '',
                                                        'permanent_city'                => '',
                                                        'permanent_state'               => '',
                                                        'permanent_postal_code'         => ''
                                                );
                                                $permanent_address = json_encode($permanent_address);
                                                // ------------------------------------Permanent Address------------------------------------ //

                                                // ------------------------------------Family Information------------------------------------ //
                                                $family_info[] = array(
                                                        'father'             => '',
                                                        'mother'                => '',
                                                        'brother_sister'        => ''
                                                );
                                                $family_info = json_encode($family_info);
                                                // ------------------------------------Family Information------------------------------------ //

                                                // --------------------------------- Additional Personal Details--------------------------------- //
                                                $additional_personal_details[] = array(
                                                        'born_at'  => '',
                                                        'want_children'              => '',
                                                        'do_i_smoke'            => '',
                                                        'grew_up_in'         => '',
                                                        'have_children'         => '',
                                                        'do_i_drink'         => '',
                                                        'my_hobbies'         => '',
                                                        'believe_in_polygamy'         => '',
                                                        'spouse_is'         => '',
                                                        'my_personalities'         => '',
                                                        'disabilities'         => '',
                                                        'relocate'         => '',
                                                );
                                                $additional_personal_details = json_encode($additional_personal_details);
                                                // --------------------------------- Additional Personal Details--------------------------------- //

                                                // ------------------------------------ Partner Expectation------------------------------------ //
                                                $partner_expectation[] = array(
                                                        'partner_caste'    => '',
                                                        'partner_age'                       => '',
                                                        'partner_height'                       => '',
                                                        'partner_marital_status'                       => '',
                                                        'partner_profession'                       => '',
                                                        'partner_education'                       => '',
                                                        'partner_nationality'                       => '',
                                                        'partner_country_of_residence'                       => '',
                                                        'partner_resident_status'                       => '',
                                                        'partner_any_disability'                       => '',
                                                        'partner_have_children'                       => '',
                                                        'partner_children_how_many'                       => '',
                                                        'partner_body_type'                       => '',
                                                        'partner_born_at'                       => '',
                                                        'partner_1_language'                       => ''

                                                );
                                                $partner_expectation = json_encode($partner_expectation);
                                                // ------------------------------------ Partner Expectation------------------------------------ //

                                                // ------------------------------------Privacy Status------------------------------------ //
                                                $privacy_status[] = array(
                                                        'present_address'                 => 'no',
                                                        'education_and_career'            => 'no',
                                                        'physical_attributes'             => 'no',
                                                        'language'                        => 'no',
                                                        'hobbies_and_interest'            => 'no',
                                                        'personal_attitude_and_behavior'  => 'no',
                                                        'residency_information'           => 'no',
                                                        'spiritual_and_social_background' => 'no',
                                                        'life_style'                      => 'no',
                                                        'astronomic_information'          => 'no',
                                                        'permanent_address'               => 'no',
                                                        'family_info'                     => 'no',
                                                        'additional_personal_details'     => 'no',
                                                        'partner_expectation'             => 'yes'
                                                );
                                                $privacy_status = json_encode($privacy_status);
                                                // ------------------------------------Privacy Status------------------------------------ //

                                                // ------------------------------------Pic Privacy Status------------------------------------ //
                                                $pic_privacy[] = array(
                                                        'profile_pic_show'        => 'all',
                                                        'gallery_show'            => 'premium',
                                                        'video_show'              => 'premium'

                                                );
                                                $data_pic_privacy = json_encode($pic_privacy);
                                                // ------------------------------------Pic Privacy Status------------------------------------ //

                                                // --------------------------------- Additional Personal Details--------------------------------- //
                                                // $package_info[] = array(
                                                //         'current_package'   => $this->Crud_model->get_type_name_by_id('plan', '1'),
                                                //         'package_price'     => $this->Crud_model->get_type_name_by_id('plan', '1', 'amount'),
                                                //         'payment_type'      => 'None',
                                                // );
                                                // $package_info = json_encode($package_info);
                                                // --------------------------------- Additional Personal Details--------------------------------- //

                                                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                                        $captcha_answer = $this->input->post('g-recaptcha-response');
                                                        $response = $this->recaptcha->verifyResponse($captcha_answer);
                                                        if ($response['success']) {
                                                                $data['first_name'] ='';
                                                                $data['last_name'] = '';
                                                                $data['user_name'] = $this->input->post('user_name');
                                                                $data['gender'] = $this->input->post('gender');
                                                                $data['email'] = $this->input->post('email');
                                                                $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));
                                                                $data['height'] = 0.00;
                                                                $data['mobile'] = $this->input->post('mobile');
                                                                $data['plain_password'] = $this->input->post('password');
                                                                $data['password'] = sha1($this->input->post('password'));
                                                                $data['profile_image'] = 'default.jpg';
                                                                $data['introduction'] = '';
                                                                $data['i_am_looking'] = '';
                                                                $data['basic_info'] = $basic_info;
                                                                $data['present_address'] = $present_address;
                                                                $data['family_info'] = $family_info;
                                                                $data['education_and_career'] = $education_and_career;
                                                                $data['physical_attributes'] = $physical_attributes;
                                                                $data['language'] = $language;
                                                                $data['hobbies_and_interest'] = $hobbies_and_interest;
                                                                $data['personal_attitude_and_behavior'] = $personal_attitude_and_behavior;
                                                                $data['residency_information'] = $residency_information;
                                                                $data['spiritual_and_social_background'] = $spiritual_and_social_background;
                                                                $data['life_style'] = $life_style;
                                                                $data['astronomic_information'] = $astronomic_information;
                                                                $data['permanent_address'] = $permanent_address;
                                                                $data['additional_personal_details'] = $additional_personal_details;
                                                                $data['partner_expectation'] = $partner_expectation;
                                                                $data['interest'] = '[]';
                                                                $data['short_list'] = '[]';
                                                                $data['followed'] = '[]';
                                                                $data['ignored'] = '[]';
                                                                $data['ignored_by'] = '[]';
                                                                $data['gallery'] = '[]';
                                                                $data['happy_story'] = '[]';
                                                                // $data['package_info'] = $package_info;
                                                                $data['payments_info'] = '[]';
                                                                $data['interested_by'] = '[]';
                                                                $data['follower'] = 0;
                                                                $data['notifications'] = '[]';
                                                                $data['membership'] = 1;
                                                                $data['is_closed'] = 'no';
                                                                $data['profile_status'] = 1;
                                                                $data['member_since'] = date("Y-m-d h:m:s");
                                                                $data['express_interest'] = $this->db->get_where('plan', array('plan_id' => 1))->row()->express_interest;
                                                                $data['direct_messages'] = $this->db->get_where('plan', array('plan_id' => 1))->row()->direct_messages;
                                                                $data['photo_gallery'] = $this->db->get_where('plan', array('plan_id' => 1))->row()->photo_gallery;
                                                                $data['video_gallery'] = 1;
                                                                $data['profile_completion'] = 0;
                                                                $data['is_blocked'] = 'no';
                                                                $data['privacy_status'] = $privacy_status;
                                                                $data['pic_privacy'] = $data_pic_privacy;
                                                                $data['isOnlineTimezone'] = gmdate('Y-m-d\TH:i:s.').'000Z';

                                                                $this->db->insert('member', $data);
                                                                $insert_id = $this->db->insert_id();
                                                                $member_profile_id = strtoupper(substr(hash('sha512', rand()), 0, 8)) . $insert_id;

                                                                $this->db->where('member_id', $insert_id);
                                                                $this->db->update('member', array('member_profile_id' => $member_profile_id));

                                                                $displayMember = strtoupper(substr($this->input->post('user_name'), 0, 2)) . $insert_id;
                                                                $encryptedMemberId = sha1($insert_id);

                                                                $this->db->where('member_id', $insert_id);
                                                                $upDateData = array(
                                                                        'display_member' => $displayMember,
                                                                        'encrypted_member_id' => $encryptedMemberId
                                                                );
                                                                $this->db->update('member', $upDateData);

                                                                recache();

                                                                // $msg = 'done';
                                                                if ($this->Email_model->account_opening('member', $data['email'], $this->input->post('password'),$encryptedMemberId) == false) {
                                                                        //$msg = 'done_but_not_sent';
                                                                } else {
                                                                        //$msg = 'done_and_sent';
                                                                }

                                                                // $msg = 'done';
                                                                if ($this->Email_model->new_account_notification($data['email'], $data['first_name'] . " " . $data['last_name'])) {
                                                                        //$msg = 'done_but_not_sent';
                                                                } else {
                                                                        //$msg = 'done_and_sent';
                                                                }

                                                                $this->session->set_flashdata('alert', 'register_success');
                                                                // redirect(base_url().'home/login', 'refresh');
                                                        } else {
                                                                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                                                        $page_data['recaptcha_html'] = $this->recaptcha->render();
                                                                }
                                                                $page_data['page'] = "registration";
                                                                $page_data['form_contents'] = $this->input->post();
                                                                $page_data['captcha_incorrect'] = TRUE;

                                                                $this->load->view('front/registration', $page_data);
                                                        }
                                                } else {
                                                        $data['first_name'] = $this->input->post('first_name');
                                                        $data['last_name'] = $this->input->post('last_name');
                                                        $data['gender'] = $this->input->post('gender');
                                                        $data['email'] = $this->input->post('email');
                                                        $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));
                                                        $data['height'] = 0.00;
                                                        $data['mobile'] = $this->input->post('mobile');
                                                        $data['plain_password'] = $this->input->post('password');
                                                        $data['password'] = sha1($this->input->post('password'));
                                                        $data['profile_image'] = 'default.jpg';
                                                        $data['introduction'] = '';
                                                        $data['i_am_looking'] = '';
                                                        $data['basic_info'] = $basic_info;
                                                        $data['present_address'] = $present_address;
                                                        $data['family_info'] = $family_info;
                                                        $data['education_and_career'] = $education_and_career;
                                                        $data['physical_attributes'] = $physical_attributes;
                                                        $data['language'] = $language;
                                                        $data['hobbies_and_interest'] = $hobbies_and_interest;
                                                        $data['personal_attitude_and_behavior'] = $personal_attitude_and_behavior;
                                                        $data['residency_information'] = $residency_information;
                                                        $data['spiritual_and_social_background'] = $spiritual_and_social_background;
                                                        $data['life_style'] = $life_style;
                                                        $data['astronomic_information'] = $astronomic_information;
                                                        $data['permanent_address'] = $permanent_address;
                                                        $data['additional_personal_details'] = $additional_personal_details;
                                                        $data['partner_expectation'] = $partner_expectation;
                                                        $data['interest'] = '[]';
                                                        $data['short_list'] = '[]';
                                                        $data['followed'] = '[]';
                                                        $data['ignored'] = '[]';
                                                        $data['ignored_by'] = '[]';
                                                        $data['gallery'] = '[]';
                                                        $data['happy_story'] = '[]';
                                                        // $data['package_info'] = $package_info;
                                                        $data['payments_info'] = '[]';
                                                        $data['interested_by'] = '[]';
                                                        $data['follower'] = 0;
                                                        $data['notifications'] = '[]';
                                                        $data['membership'] = 1;
                                                        $data['profile_status'] = 1;
                                                        $data['is_closed'] = 'no';
                                                        $data['member_since'] = date("Y-m-d h:m:s");
                                                        $data['express_interest'] = $this->db->get_where('plan', array('plan_id' => 1))->row()->express_interest;
                                                        $data['direct_messages'] = $this->db->get_where('plan', array('plan_id' => 1))->row()->direct_messages;
                                                        $data['photo_gallery'] = $this->db->get_where('plan', array('plan_id' => 1))->row()->photo_gallery;
                                                        $data['video_gallery'] = 1;
                                                        $data['profile_completion'] = 0;
                                                        $data['is_blocked'] = 'no';
                                                        $data['privacy_status'] = $privacy_status;
                                                        $data['pic_privacy'] = $data_pic_privacy;
                                                        $data['isOnlineTimezone'] = gmdate('Y-m-d\TH:i:s.').'000Z';

                                                        $this->db->insert('member', $data);
                                                        $insert_id = $this->db->insert_id();
                                                        $member_profile_id = strtoupper(substr(hash('sha512', rand()), 0, 8)) . $insert_id;
                                                        $encryptedMemberId = sha1($insert_id);

                                                        $this->db->where('member_id', $insert_id);
                                                        $this->db->update('member', array('member_profile_id' => $member_profile_id));
                                                        $displayMember = strtoupper(substr($this->input->post('first_name'), 0, 1)) . strtoupper(substr($this->input->post('last_name'), 0, 1)) . $insert_id;

                                                        $encryptedMemberId = sha1($insert_id);

                                                        $this->db->where('member_id', $insert_id);
                                                        $upDateData = array(
                                                                'display_member' => $displayMember,
                                                                'encrypted_member_id' => $encryptedMemberId
                                                        );
                                                        $this->db->update('member', $upDateData);
                                                        recache();

                                                        // $msg = 'done';
                                                        if ($this->Email_model->account_opening('member', $data['email'], $this->input->post('password'), $encryptedMemberId) == false) {
                                                                //$msg = 'done_but_not_sent';
                                                        } else {
                                                                //$msg = 'done_and_sent';
                                                        }

                                                        // $msg = 'done';
                                                        if ($this->Email_model->new_account_notification($data['email'], $data['first_name'] . " " . $data['last_name'])) {
                                                                //$msg = 'done_but_not_sent';
                                                        } else {
                                                                //$msg = 'done_and_sent';
                                                        }

                                                        $this->session->set_flashdata('alert', 'register_success');
                                                        // redirect(base_url().'home/login', 'refresh');
                                                }

                                                // login to complete profile

                                                $username = $this->input->post('email');
                                                $password = sha1($this->input->post('password'));

                                                $result = $this->Crud_model->check_login('member', $username, $password);

                                                $data = array();
                                                if ($result) {

                                                        $data['login_state'] = 'yes';
                                                        $data['member_id'] = $result->member_id;
                                                        $data['member_name'] = $result->first_name;
                                                        $data['member_email'] = $result->email;

                                                        $this->session->set_userdata($data);
                                                        // $this->session->set_flashdata('success', 'complete_your_profile');

                                                        redirect(base_url() . 'home/profile_detail', 'refresh');
                                                }


                                                // end login to complete profile
                                        } else {
                                                if ($this->Crud_model->get_settings_value('third_party_settings', 'captcha_status', 'value') == 'ok') {
                                                        $page_data['recaptcha_html'] = $this->recaptcha->render();
                                                }
                                                $page_data['form_contents'] = $this->input->post();
                                                $page_data['disallowed_char'] =  translate('disallowed_charecter') . ' " ' . $char . ' " ' . translate('in_the_POST');
                                                $page_data['page'] = "registration";
                                                $this->load->view('front/registration', $page_data);
                                        }
                                }
                        }
                }
        }

        function view_payment_detail($para1)
        {
                $detail = $this->db->get_where('package_payment', array('package_payment_id' => $para1))->row()->payment_details;
                if ($detail != 'none') {
                        echo "<p class='text-left' Style='word-wrap: break-word'>" . $detail . "<p>";
                } else {
                        echo "<p class='text-center'><b>" . translate('no_details_available') . "</b><p>";
                }
        }

        function get_dropdown_by_id($table, $field, $id)
        {
                $options = $this->db->get_where($table, array($field => $id))->result();
                $table_id = $table . "_id";
                echo "<option value=''>" . translate('choose_one') . "</option>";
                foreach ($options as $value) {
                        echo "<option value=" . $value->$table_id . ">" . $value->name . "</option>";
                }
        }

        function get_dropdown_by_id_caste($table, $field, $id, $caste = "")
        {
                $options = $this->db->get_where($table, array($field => $id))->result();
                $table_id = $table . "_id";
                $table_name = $table . "_name";

                echo "<option value=''>" . translate('choose_one') . "</option>";
                foreach ($options as $value) {
                        if ($value->$table_id == $caste) {
                                echo "<option value=" . $value->$table_id . " selected>" . $value->$table_name . "</option>";
                        } else {
                                echo "<option value=" . $value->$table_id . ">" . $value->$table_name . "</option>";
                        }
                }
        }


        function get_dropdown_by_id_sub_caste($table, $field, $id, $sub_caste = "")
        {
                $options = $this->db->get_where($table, array($field => $id))->result();
                if (count($options) > 0) {
                        $table_id = $table . "_id";
                        $table_name = $table . "_name";

                        echo "<option value=''>" . translate('choose_one') . "</option>";
                        foreach ($options as $value) {
                                if ($value->$table_id == $sub_caste) {
                                        echo "<option value=" . $value->$table_id . " selected>" . $value->$table_name . "</option>";
                                } else {
                                        echo "<option value=" . $value->$table_id . ">" . $value->$table_name . "</option>";
                                }
                        }
                } else {
                        return false;
                }
        }

        function set_language($lang)
        {
                $this->session->set_userdata('language', $lang);
                recache();
                $page_data['page_name'] = "home";
        }

        function set_currency($currency)
        {
                $this->session->set_userdata('currency', $currency);
                recache();
        }

        function invoice($payment_id)
        {
                if ($this->member_permission() == FALSE) {
                        redirect(base_url() . 'home/', 'refresh');
                }
                $payment_status = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row()->payment_status;
                if ($payment_status == 'paid') {
                        $member_id = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row()->member_id;
                        if ($member_id == $this->session->userdata('member_id')) {
                                $page_data['title'] = translate('payment_invoice') . " || " . $this->system_title;
                                $page_data['top'] = "invoice.php";
                                $page_data['page'] = "invoice";
                                $page_data['bottom'] = "invoice.php";
                                $page_data['get_payment'] = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->result();

                                if ($this->session->flashdata('alert') == "paypal_success") {
                                        $page_data['success_alert'] = translate("your_payment_via_paypal_has_been_successfull!");
                                } elseif ($this->session->flashdata('alert') == "stripe_success") {
                                        $page_data['success_alert'] = translate("your_payment_via_stripe_has_been_successfull!");
                                } elseif ($this->session->flashdata('alert') == "pum_success") {
                                        $page_data['success_alert'] = translate("your_payment_via_payUMoney_has_been_successfull!");
                                } elseif ($this->session->flashdata('alert') == "not_sent") {
                                        $page_data['danger_alert'] = translate("error_sending_email!");
                                }


                                $this->load->view('front/index', $page_data);
                        } else {
                                redirect(base_url() . 'home/', 'refresh');
                        }
                } else {
                        redirect(base_url() . 'home/', 'refresh');
                }
        }

        function refresh_notification($member_id)
        {
                $notifications = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
                $notifications = json_decode($notifications, true);
                $updated_notifications = array();
                if (!empty($notifications)) {
                        foreach ($notifications as $notification) {
                                $updated_notifications[] = array('by' => $notification['by'], 'type' => $notification['type'], 'status' => $notification['status'], 'is_seen' => 'yes', 'time' => $notification['time']);
                        }
                        $this->db->where('member_id', $member_id);
                        $this->db->update('member', array('notifications' => json_encode($updated_notifications)));
                        recache();
                }
        }

    function get_user_profile($member_id, $get_all = '')
    {

        //echo $member_id;
        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $member_id))->result();

        //ho "<pre>";
        //print_r($page_data);
        $this->load->view('/front/chat/left_panel.php', $page_data);



    }

     function get_message_thread($from_member_id)
    {

        if($from_member_id == "home"){
        $listed_messaging_members = $this->Crud_model->get_listed_messaging_members($this->session->userdata('member_id'));
        $threadID = $listed_messaging_members[0]['message_thread_id'];
        } else{
        $to_member_id = $this->session->userdata('member_id');
        $sql = $this->db->query('SELECT message_thread_id FROM message_thread WHERE message_thread_to = ' . $to_member_id . " AND message_thread_from = " . $from_member_id);

        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $row)
            {
                 $threadID = $row->message_thread_id;
             }
        }
        else{
            $query = $this->db->query('SELECT message_thread_id FROM message_thread WHERE message_thread_to = ' . $from_member_id . " AND message_thread_from = " . $to_member_id);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row)
                {
                    $threadID = $row->message_thread_id;
                }
            }
        }
        }

        // echo json_encode($threadID);

    }

     public function toggleBtn($to_member)
    {
        //block
        if ($to_member) {
            $by_member = $this->session->userdata('member_id');
            $this->db->select('*');
            $this->db->from('interest_or_block');
            $this->db->where('to_member', $to_member);
            $this->db->where('by_member', $by_member);
            $row = $this->db->get()->row();

            //for 1st timers
            if ($row == null) {
                $data['block_status'] = 1;
                $data['to_member'] = $to_member;
                $data['by_member'] = $by_member;
                $this->db->insert('interest_or_block', $data);
            } elseif ($row != null && intval($row->interest_status) != null && intval($row->block_status) == null) {
                $data['block_status'] = 1;
                $this->db->where('to_member', $to_member);
                $this->db->where('by_member', $by_member);
                $this->db->update('interest_or_block', $data);
            }
        }
    }


    public function toggleInterest($to_member)
    {
        if ($to_member) {
            $by_member = $this->session->userdata('member_id');
            $this->db->select('*');
            $this->db->from('interest_or_block');
            $this->db->where('to_member', $to_member);
            $this->db->where('by_member', $by_member);
            $row = $this->db->get()->row();

            //for 1st timers
            if ($row == null) {
                $data['interest_status'] = 2;
                $data['to_member'] = $to_member;
                $data['by_member'] = $by_member;
                $this->db->insert('interest_or_block', $data);
            } elseif ($row != null && intval($row->interest_status) == null && intval($row->block_status) != null) {
                $data['interest_status'] = 2;
                $this->db->where('to_member', $to_member);
                $this->db->where('by_member', $by_member);
                $this->db->update('interest_or_block', $data);
            }
        }
    }

    public function unblock()
    {
        $value = $_POST['value'];
        $id = $_POST['id'];
                    // print_r($id);exit;
        //separate first & last name
        if ($value) {
//            $var = explode("%20", $value);
//
//            $firstname = $var[0];
//            $lastname = $var[1];

            //take out the member ID from this name
            $this->db->select('member_id');
            $this->db->from('member');
            $this->db->where('display_member', $value);
//            $this->db->where('first_name', $firstname);
//            $this->db->where('last_name', $lastname);
            $row = $this->db->get()->result();

            //verify if this user is blocked by current User
            foreach ($row as $member) {

                $by_member = $this->session->userdata('member_id');
                $this->db->select('*');
                $this->db->from('interest_or_block');
                $this->db->where('to_member', intval($member->member_id));
                $this->db->where('by_member', $by_member);
                $person = $this->db->get()->row();

                //if that person is present
                if ($person) {
                    if($id == 1){
                        //verify if that person is blocked
                        if ($person->block_status == 1 && $person->interest_status != null) {
                            $data['block_status'] = null;
                            $this->db->where('to_member', $person->to_member);
                            $this->db->where('by_member', $by_member);
                            $this->db->update('interest_or_block', $data);

                        } elseif ($person->block_status == 1 && $person->interest_status == null) {
                            $this->db->where('to_member', $person->to_member);
                            $this->db->where('by_member', $by_member);
                            $this->db->delete('interest_or_block');
                        }
                    }
                    if($id == 2){
                        //verify if that person is interested
                        if ($person->interest_status == 2 && $person->block_status != null) {
                            $data['interest_status'] = null;
                            $this->db->where('to_member', $person->to_member);
                            $this->db->where('by_member', $by_member);
                            $this->db->update('interest_or_block', $data);
                        } elseif ($person->interest_status == 2 && $person->block_status == null) {
                            $this->db->where('to_member', $person->to_member);
                            $this->db->where('by_member', $by_member);
                            $this->db->delete('interest_or_block');
                        }
                    }
                }
            }
        }
    }

    public function hideProfile()
    {
        $user_id = $this->session->userdata('member_id');
        $current_password = sha1($this->input->post('current_password'));
        $prev_password = $this->db->get_where('member', array('member_id' => $user_id))->row()->password;

        if ($this->input->post('current_password') == ''){
            $msg = 'Current password field must not be empty!';
            echo json_encode($msg);
            return false;
        }

        if ($prev_password != $current_password) {
            $msg = 'Invalid Password!';
            echo json_encode($msg);
        } elseif (isset($_POST['hide']) && isset($_POST['show'])) {
            $msg = 'Please select only one option!';
            echo json_encode($msg);
        } elseif (!isset($_POST['hide']) && !isset($_POST['show'])) {
            $msg = 'Please select one option!';
            echo json_encode($msg);
        } else {

            $this->db->select('*');
            $this->db->from('member');
            $this->db->where('member_id', $user_id);
            $row = $this->db->get()->row();

//            if ($row->hide_profile == 1 && isset($_POST['hide'])){
//                $msg = 'Your profile is already hidden!';
//                echo json_encode($msg);
//            }

            if ($row) {

                if (isset($_POST['hide'])) {
                    $data['hide_profile'] = 1;
                    $this->db->where('member_id', $user_id);
                    $this->db->update('member', $data);
                } else if (isset($_POST['show'])) {
                    $data['hide_profile'] = 2;
                    $this->db->where('member_id', $user_id);
                    $this->db->update('member', $data);
                }
                $msg = 'Success!';
                echo json_encode($msg);
            }
        }
    }

    public function deleteAccount($member)
    {
        if ($member) {

            $this->db->select('member_profile_id');
            $this->db->from('member');
            $this->db->where('member_id', $member);
            $row = $this->db->get()->row();
            //take member_profile_ID from here

            if (isset($row)) {
                $this->Email_model->delete_account_email($member);
            }
        }
    }


 public function reason()
    {
        $reasons = implode(" & ",$_POST['reasons']);
        $user_id = $this->session->userdata('member_id');
        // $current_password = sha1($this->input->post('current_password'));
        $current_password = sha1($_POST['currentPassword']);
        $prev_password = $this->db->get_where('member', array('member_id' => $user_id))->row()->password;

        if ($prev_password != $current_password) {
            echo 'Invalid_Password';
            exit;
        } else {
            // if (isset($_POST['delete'])) {
                if (isset($_POST['thank'])) {
                    $data['reason'] = "I found someone";
                } elseif (isset($_POST['busy'])) {
                    $data['reason'] = "Too busy to look";
                } elseif (isset($_POST['interested'])) {
                    $data['reason'] = "Not interested";
                } elseif (isset($_POST['personal'])) {
                    $data['reason'] = "Personal reasons";
                } elseif (isset($_POST['back'])) {
                    $data['reason'] = "In a relationship";
                }
                $data['is_deleted'] = true;
                $data['member_id'] = $this->session->userdata('member_id');
                $this->db->insert('is_deleted', $data);
                $updateData['is_deleted'] = 1;
                $this->db->where('member_id', $this->session->userdata('member_id'));
                $this->db->update('member', $updateData);
                
                $this->createDeletedMember($user_id);

                $membership = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'membership');
                if ($membership == 2) {
                    $this->cancelSubscription($reasons);
                }
                
                $this->Email_model->delete_account_email($user_id);

                $this->db->query("DELETE FROM message WHERE message_from = $user_id OR message_to = $user_id");
                $this->db->query("DELETE FROM message_thread WHERE message_thread_from = $user_id OR message_thread_to = $user_id");
                
                $this->Email_model->delete_account_email($user_id);
                
                $tables = array('member', 'gallery_items');
                $this->db->where('member_id', $user_id);
                $this->db->delete($tables);
                
                $this->session->sess_destroy();
                exit;
        }
    }
    
    function createDeletedMember($member_id)
    {
        // Add the record in delete_member table
        $data['member_id'] = $member_id;
        $data['member_profile_id'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'member_profile_id');
        $data['first_name'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'first_name');
        $data['last_name'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'last_name');
        $data['gender'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'gender');
        $data['email'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'email');
        $data['mobile'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'mobile');
        $data['is_closed'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'is_closed');
        $data['date_of_birth'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'date_of_birth');
        $data['height'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'height');
        $data['plain_password'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'plain_password');
        $data['password'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'password');
        $data['profile_image'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'profile_image');
        $data['is_profile_img_approved'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'is_profile_img_approved');
        $data['introduction'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'introduction');
        $data['i_am_looking'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'i_am_looking');
        
        $data['basic_info'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'basic_info');
        $data['present_address'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'present_address');
        $data['education_and_career'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'education_and_career');
        $data['physical_attributes'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'physical_attributes');
        $data['language'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'language');
        $data['hobbies_and_interest'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'hobbies_and_interest');
        $data['personal_attitude_and_behavior'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'personal_attitude_and_behavior');
        $data['residency_information'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'residency_information');
        $data['spiritual_and_social_background'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'spiritual_and_social_background');
        $data['life_style'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'life_style');
        $data['astronomic_information'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'astronomic_information');
        $data['permanent_address'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'permanent_address');
        $data['family_info'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'family_info');
        $data['additional_personal_details'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'additional_personal_details');
        $data['partner_expectation'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'partner_expectation');
        $data['interest'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'interest');
        $data['short_list'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'short_list');
        $data['followed'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'followed');
        $data['ignored'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored');
        $data['ignored_by'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'ignored_by');
        $data['gallery'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'gallery');
        $data['happy_story'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'happy_story');
        $data['package_info'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'package_info');
        $data['payments_info'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'payments_info');
        $data['interested_by'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'interested_by');
        $data['follower'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'follower');
        $data['membership'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'membership');
        $data['notifications'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'notifications');
        $data['profile_status'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'profile_status');
        $data['member_since'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'member_since');
        $data['express_interest'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'express_interest');
        $data['direct_messages'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'direct_messages');
        $data['photo_gallery'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'photo_gallery');
        $data['profile_completion'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'profile_completion');
        $data['is_blocked'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'is_blocked');
        $data['privacy_status'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'privacy_status');
        $data['pic_privacy'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'pic_privacy');
        $data['display_member'] = $this->Crud_model->get_type_name_by_id('member', $member_id, 'display_member');

        $this->db->insert('deleted_member', $data);
        recache();

        echo "true";
    }

    public function email_verification($encryptMemberId = "")
    {
        $page_data['title'] = "Email Verification || " . $this->system_title;
        $page_data['encryptMemberId'] = $encryptMemberId;

        if ($encryptMemberId != "") {

            $this->load->view('front/email_verification_success', $page_data);
        }
        else
        {
            redirect(base_url() . 'home', 'refresh');
        }
    }

    public function email_verified()
    {
        $encryptMemberId = $_POST['encryptMemberId'];

        $updateData['is_email_verified'] = 1;
        $this->db->where('encrypted_member_id', $encryptMemberId);
        $this->db->update('member', $updateData);

        echo true;
    }

    function createMemberSubscription($subscribtionId, $membership)
    {
        $member_id = $this->session->userdata('member_id');

        $updateData['paypal_subscription_id'] = $subscribtionId;
        $updateData['membership'] = $membership;
        $updateData['isProfileCompleted'] = 1;
        $updateData['photo_gallery'] = 3;

        $this->db->where('member_id', $member_id);
        $this->db->update('member', $updateData);

        $messageThread = $this->db->query("SELECT * FROM message_thread WHERE message_thread_from = $member_id")->result();
        
        if (!empty($messageThread)) {
            $updateThread['thread_viewable_to'] = 1;

            $this->db->where('message_thread_from', $member_id);
            $this->db->update('message_thread', $updateThread);
        }

        $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $member_id")->result();

        $this->Email_model->subscription_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);

        recache();
    }

    function updateSubscriptionBillingType($billingType)
    {
        $member_id = $this->session->userdata('member_id');

        $updateData['billing_id'] = $billingType;

        $this->db->where('member_id', $member_id);
        $this->db->update('member', $updateData);
    }

    function cancelSubscription($reason)
    {
        $member_id = $this->session->userdata('member_id');
        $subscribtionId = $this->Crud_model->get_type_name_by_id('member', $member_id, 'paypal_subscription_id');

        $paid_by = $this->Crud_model->get_type_name_by_id('member', $member_id, 'paid_by');

        if ($paid_by == "paypal" ) {
			$access_token = $this->db->where('id',1)->get('paypal_access_token')->row();
			define('PAYPAL_ACCESS_TOKEN',$access_token->access_token);
			
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/billing/subscriptions/".$subscribtionId."/cancel" ,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".PAYPAL_ACCESS_TOKEN,
                "Content-Type: application/json"
              ),
            ));


        }else{
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.stripe.com/v1/subscriptions/".$subscribtionId ,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "DELETE",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".STRIPE_SECRET_KEY,
                "Content-Type: application/json"
              ),
            ));

        }

        

        $response = curl_exec($curl);
		
        //echo "<pre>";print_r($response);
        curl_close($curl);

        // Move member on broze package
        $data['membership'] = 1;
        $data['billing_id'] = NULL;
        $data['photo_gallery'] = 1;

        $this->db->where('member_id', $member_id);
        $this->db->update('member', $data);

        // Hide all pictures except 1st one
        $galleryData = $this->db->query("SELECT * FROM gallery_items WHERE member_id = $member_id AND item_type = 'gallery_image' ORDER BY uploaded_date")->result();
        
        for ($i = 0; $i < count($galleryData); $i++)
        {
            $itemId = $galleryData[$i]->item_id;
            
            if ($i != 0) {
                $upDateData['is_approved'] = 3;

                $this->db->where('item_id', $itemId);
                $this->db->update('gallery_items', $upDateData);
            }
        }

        $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $member_id")->result();

        $this->Email_model->bronze_activation_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);

        echo $response;
    }

    function getSubscriptionDetails($subscribtionId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.stripe.com/v1/subscriptions/". $subscribtionId,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".STRIPE_SECRET_KEY,
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);

        $memberData = $this->db->get_where('member', array('paypal_subscription_id' => $subscribtionId))->row();

        $date = date('Y-m-d H:i:s');

        $status = $result->status;
        $package = "Platinum";
        $amount = number_format(($result->items->data[0]->plan->amount /100), 2, '.', ' ');
        $paymentProcessDate = date('Y-m-d\TH:i:s.', $result->start_date).'000Z';
        $productId = $result->items->data[0]->plan->product;
        $invoiceNo = $this->getInvoiceNo();

        if ($status == "active") {
            $earningStatus = "active";
        }
        elseif ($status == "incomplete") {
            $earningStatus = "incomplete";
            $this->Email_model->subscription_suspended_notification($memberData->email, $memberData->first_name . " " . $memberData->last_name);
        }
        elseif ($status == "canceled") {
            $earningStatus = "canceled";
        }

        else
        {
            $this->Email_model->payment_failure_notification($memberData->email, $memberData->first_name . " " . $memberData->last_name);
        }

        if ($productId == ANNUAL_PLAN) {
            $billingCycle = "Annually";
            $nextBillingDate = date('Y-m-d H:i:s', strtotime("+12 months", strtotime($date)));
            $dueDate = date('Y-m-d H:i:s', strtotime("+12 months", strtotime($date)));
        }
        elseif($productId == BI_ANNUAL_PLAN) {
            $billingCycle = "Bi-annually";
            $nextBillingDate = date('Y-m-d H:i:s', strtotime("+6 months", strtotime($date)));
            $dueDate = date('Y-m-d H:i:s', strtotime("+6 months", strtotime($date)));
        }
        elseif($productId == QUARTERLY_PLAN) {
            $billingCycle = "Quarterly";
            $nextBillingDate = date('Y-m-d H:i:s', strtotime("+3 months", strtotime($date)));
            $dueDate = date('Y-m-d H:i:s', strtotime("+3 months", strtotime($date)));
        }elseif($productId == DAILY_PLAN) {
            $billingCycle = "Monthly";
            $nextBillingDate = date('Y-m-d H:i:s', strtotime("+1 months", strtotime($date)));
            $dueDate = date('Y-m-d H:i:s', strtotime("+1 months", strtotime($date)));
        }

        $data['member_id'] = $memberData->member_id;
        $data['invoice_no'] = $invoiceNo;
        $data['package'] = $package;
        $data['billing_cycle'] = $billingCycle;
        $data['amount'] = $amount;
        $data['status'] = $earningStatus;
        $data['payment_process_date'] = $paymentProcessDate;
        $data['next_billing_date'] = $nextBillingDate;
        $data['due_date'] = $paymentProcessDate;

        $insert = $this->db->insert('earning', $data);

        // if ($insert) {
            $updateData['subscription_date'] = date('Y-m-d H:i:s');
            $updateData['next_billing_date'] = $nextBillingDate;
            $updateData['paid_by'] = 'stripe';
            $this->db->where('member_id', $memberData->member_id);
            $this->db->update('member', $updateData);
        // } 
        
        return $result;
    }

    function getAllSubscripionIds()
    {
        $date = date('Y-m-d');
        $result = $this->db->query("SELECT paypal_subscription_id from member WHERE membership = 2 AND next_billing_date like '".$date."%'")->result();
        
        for($i=0;$i<count($result);$i++){
            $subsID = $result[$i]->paypal_subscription_id;
            $this->getSubscriptionDetails($subsID);
        }
    }
    
    function checkAndUpdateAllSubscripions()
    {
        $result = $this->db->query("SELECT MAX(e.earning_id) as earning_id, m.paypal_subscription_id, m.member_id FROM member AS m LEFT JOIN earning AS e ON e.`member_id` = m.`member_id` WHERE m.membership IN (1, 2, 3, 4) AND e.`status` = 'active' group by m.member_id order by e.earning_id DESC;")->result();
        
        for($i=0;$i<count($result);$i++){
            $subsID = $result[$i]->paypal_subscription_id;
            $memberID = $result[$i]->member_id;
            
            if($memberID != "" && $subsID != "")
            {
                $this->updateSubscriptionDetails($subsID, $memberID);
            }
        }
    }

    function updateSubscriptionDetails($subscribtionId, $memberID)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.stripe.com/v1/subscriptions/". $subscribtionId,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".STRIPE_SECRET_KEY,
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);

        $status = $result->status;
        
        if ($status == "canceled") {
            $earningStatus = "canceled";
            
            $fetchLastRec = $this->db->query("SELECT * FROM earning WHERE member_id = ".$memberID." AND status = 'active' order by earning_id desc limit 1;")->row();

            if($fetchLastRec){
                $data['status'] = $earningStatus;
                $this->db->where('earning_id', $fetchLastRec->earning_id);
                $this->db->update('earning', $data);
            }
        }

        return true;
    }

    function cancelSubscriptionBySystem()
    {
        $result = $this->db->query("SELECT member_id, paypal_subscription_id, next_billing_date from member WHERE membership = 2 AND next_billing_date IS NOT NULL")->result();
        
        for($i=0;$i<count($result);$i++){
            $subsID = $result[$i]->paypal_subscription_id;
            $memberId = $result[$i]->member_id;

            $nextBillingDate = date('Y-m-d', strtotime("+7 day", strtotime($result[$i]->next_billing_date)));
            $now = time();
            $todayDate = date('Y-m-d', $now);

            if($nextBillingDate == $todayDate) {

                // $reason = "Subscription canceled by MMIJ due to non payment";
               
                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.stripe.com/v1/subscriptions/".$subsID ,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "DELETE",
                  CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer ".STRIPE_SECRET_KEY,
                    "Content-Type: application/json"
                  ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                // Move member on broze package
                $data['membership'] = 1;
                $data['billing_id'] = NULL;
                $data['paypal_subscription_id'] = NULL;
                $data['next_billing_date'] = NULL;
                $data['photo_gallery'] = 1;

                $this->db->where('member_id', $memberId);
                $this->db->update('member', $data);

                $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $memberId")->result();

                $this->Email_model->downgrade_to_bronze_due_to_nonPayment_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);

                echo $response;
            }
            // else
            // {
            //     echo 'Safe.<br>';
            //     echo $memberId. "=> ". $nextBillingDate;
            // }
        }
    }

    function generateInvoice($invoiceNo,$memberId,$memberFirstName,$memberLastName,$memberMoble,$issueDate,$nextBillingDate,$subsPlan,$billPeriod,$amount)
    {
        $memberName = str_replace('%20', ' ', ucfirst($memberFirstName)) . " " . str_replace('%20', ' ', ucfirst($memberLastName));

        $strHTML = '<style>
            * { padding: 0; font-size: 13px; font-family: Arial, sans-serif; }
            body { position: relative;}
            .clearfix:after { content: ""; display: table; clear: both; }
            .waterMark { position: fixed; left: 0; right: 0; top: 0; bottom: 0; margin: auto; width: 1050px; height: 480px; padding: 50px;}
            .w20 { width: 20%; }
            .w100 { width: 100%; }
            .clrBlue { color: #a41c20; }
            .red { color: red;}
            .marginBottom20 { margin-bottom: 20px; }
            .marginTop50 { margin-top: 2px; }
            .borderBottomGrey { border-bottom: 1px solid #AAAAAA; }
            .borderTopBlue { border-top: 1px solid #a41c20; }
            .borderBottomBlack { border-bottom: 1px solid #000; }
            .font12 { font-size: 12px; }
            .fltLeft { float: left; }
            .fltRight { float: right; }
            .companyDetails { border-right: 1px solid #000; border-bottom: 1px solid #000; }
            .companyDetailsTD { border-left: 1px solid #000; padding:3px; border-top: 1px solid #000; font-size: 9px !important;}
            .footer { width: 100%; height: 30px; position: fixed; left: 0; bottom: 0; border-top: 1px solid #AAAAAA; padding: 8px 0; }
            @page {}
            table {
              width: 100%;
              border-collapse: collapse;
              border-spacing: 0;
              margin-bottom: 15px;
              vertically-allign:top;
              font-size: 10px !important;
            }
            .currencyPrice::first-letter {
             float: left;
            }
        .customers {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        .customers td, .customers th {
          border: 1px solid #ddd;
          padding: 8px;
          color: white;
          font-size:12px;

        }

        .customers tr:nth-child(even){background-color: #fff;}

        .customers tr:hover {background-color: #fff;}

        .customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #E91E63;
          color: white;
          font-size:12px;

        }
        .w-f {
            color: #000 !important;
        }

            </style>
            <div>
            <div class="borderBottomGrey marginBottom20 clearfix">
              <div style="float:left;text-align:left;width: 45%;">
                <img src="' . base_url() . '/uploads/header_logo/header_logo_1558265578.jpg" width="auto" height="70" alt="Logo" />
              </div>
              <div style="float:right;text-align:right;width: 55%;">
                <h1 class="clrBlue"> Invoice # '.$invoiceNo.'</h1>
                <div class="date">Payment Due: '.date('M-d-Y', strtotime($issueDate)).'</div>
                <div class="date">Paid: '.date('M-d-Y', strtotime($issueDate)).'</div>
              </div>
              <br/><br/>
            </div>
            <br/><br/>
            <div class="borderBottomGrey marginBottom20 clearfix">
            <div style="float:left;text-align:left;width: 350px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td style="width:160px;padding:3px 0;">CUSTOMER ID:</td>
                <td class="borderBottomBlack"> '.$memberId.'</td>
              </tr>
              <tr>
                <td style="width:160px;padding:3px 0;">CUSTOMER NAME:</td>
                <td class="borderBottomBlack"> '.$memberName.'</td>
              </tr>
              <tr>
                <td style="width:160px;padding:3px 0;">CUSTOMER PHONE:</td>
                <td class="borderBottomBlack"> '.$memberMoble.'</td>
              </tr>
            </table>
            </div>
            <br/><br/>
            </div>
            <br/><br/>
          
          <table class="customers" cellspacing="0" cellpadding="0"  >
                  <tr class="font12" style=" text-align:center; background-color: #E91E63;">
                <td style="width:20%;text-align:center;">Subscription Plan</td>
     
                <td style="width:20%;text-align:center;">Billing Period</td>
            
                <td  style="width:60%;text-align:center;">Amount</td>
     
              </tr>
           
                <tr class="font12">
              <td style="color:#000; text-align:center;">' . $subsPlan . '</td>
              <td style="color:#000;text-align:center;">' . $billPeriod . '</td>
              <td style="color:#000;text-align:center;">$' . $amount . '</td>
              </tr>
           
            </table>

              <table>
              <tr>
                     <td style="width:80%"></td>
                <td style="color:#a41c20;" class="borderTopBlue" align="right"><h3 class="clrBlue">TOTAL AMOUNT:</h3></td>&nbsp;
                <td style="font-size:13px;color:#a41c20;" align="right" class="borderTopBlue"><h3 class="clrBlue">$'.$amount.'</h3></td>
              </tr>
            </table>
            <br/><br/>
            <br>
            <div class="clearfix"></div><br/>
            <div style="text-align:center;">This is a computer generated invoice. No signature is required.</div>
            <br>
            <br>
            </div>';

            include (APPPATH.'libraries/MPDF/mpdf.php');
            ob_start();
            $mpdf = new mPDF('',
                        'A4',    // format - A4, for example, default ''
                        '10px',     // font size - default 0
                        'Arial',    // default font family,
                        '5',
                        '5',
                        '6',
                        '6',
                        '9',
                        '9',
                        'P'
                    );
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML(
                '<watermarkimage src="'.base_url().'uploads/header_logo/header_logo_1558265578.jpg" alpha="0.2"  />'
            );
            $mpdf->showWatermarkImage = true;
            $mpdf->useSubstitutions = false;
            $mpdf->WriteHTML($strHTML);
            $pdfFileName = "Invoice_" . $invoiceNo . ".pdf";
            $pdfFileNameNew  = './' . INVOICE_PDF_FILES_FOLDER . $pdfFileName;
            $mpdf->Output($pdfFileNameNew);

            ## DOWNLOAD FILE
            $absolutePath = $pdfFileNameNew;

            $pathParts = pathinfo($absolutePath);
            $fileName = $pathParts['basename'];

            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $fileType = finfo_file($fileInfo, $absolutePath);
            finfo_close($fileInfo);

            $fileSize = filesize($absolutePath);

            header('Content-Length: ' . $fileSize);
            header('Content-Type: ' . $fileType);
            header('Content-Disposition: attachment; filename=' . $fileName);

            ob_clean();
            flush();
            readfile($absolutePath);
            unlink($absolutePath);
            die();
    }

    function getInvoiceNo( $type = 'alnum', $length = 4 )
    {
        switch ( $type ) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string) $type;
                break;
        }


        $crypto_rand_secure = function ( $min, $max ) {
            $range = $max - $min;
            if ( $range < 0 ) return $min; // not so random...
            $log    = log( $range, 2 );
            $bytes  = (int) ( $log / 8 ) + 1; // length in bytes
            $bits   = (int) $log + 1; // length in bits
            $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes( $bytes ) ) );
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ( $rnd >= $range );
            return $min + $rnd;
        };

        $token = "";
        $max   = strlen( $pool );
        for ( $i = 0; $i < $length; $i++ ) {
            $token .= $pool[$crypto_rand_secure( 0, $max )];
        }
        return "mm".$token;
    }

    function incompleteProfile()
    {
        $result = $this->db->query("SELECT member_id, member_since, email, first_name, last_name, user_name from member WHERE isProfileCompleted = 0")->result();

        for($i=0;$i<count($result);$i++){

            $memberId = $result[$i]->member_id;
            
            $todayDate = date_create(); // today's date
            $registrationDate = date_create($result[$i]->member_since);

            $interval = date_diff($todayDate, $registrationDate);
            $days = $interval->format('%d');

            if($days >= 3) {
                $this->Email_model->incomplete_profile_notification($result[$i]->email, $result[$i]->user_name);
            }
        }
    }

    function checkEmailStatus()
    {
        $isEmailVerified = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'is_email_verified');

        echo $isEmailVerified;
    }

    function validate_age($then)
    {
        $min = strtotime($then);
        $check = strtotime(date('Y-m-d', strtotime('-18 years')));
        if($check < $min)  {
            $this->form_validation->set_message('validate_age', 'You must be 18 years old to register.');
            return false;
        }
        else {
            return true;
        }
    }

    function catchWebhook()
    {
        require_once('vendor/autoload.php');
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey(STRIPE_KEY);

        // You can find your endpoint's secret in your webhook settings
        $endpoint_secret = STR_PAY_SUCCESS_WEBHOOK;

        
        
        $file = 'stripe_'.time().rand(9,9999).'.txt';
        $payload = @file_get_contents('php://input');
        file_put_contents($file, $payload);
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        //$payload = file_get_contents('stripe_16089819818951.txt');
        $y = json_decode($payload);
        
        
    
       
        try {
          $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
          );
         // echo "<pre>";print_r($event);
        } catch(\UnexpectedValueException $e) {
          // Invalid payload
         // var_dump($e);
          http_response_code(400);
          exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
          // Invalid signature
          //var_dump($e);
          http_response_code(400);
          exit();
        }

        // Handle the checkout.session.completed event
        if ($event->type == 'checkout.session.completed') {
          $session = $event->data->object;

          // Fulfill the purchase...
          #handle_checkout_session($session);
          
          $this->checkEventType($event->type, $event);
        }

        http_response_code(200);
    }

    public function handle_customer_created($customer)
    {
        $data['data'] = json_encode($session);
          $data['type'] = $type;
          $this->db->insert('test', $data);
          unset($data);
    }

    public function handle_customer_deleted($customer)
    {
        $data['data'] = json_encode($session);
          $data['type'] = $type;
          $this->db->insert('test', $data);
          unset($data);

    }

    public function handle_product_created($product)
    {
        $data['data'] = json_encode($session);
          $data['type'] = $type;
          $this->db->insert('test', $data);
          unset($data);
    }

    public function handle_plan_created($plan)
    {
        $data['data'] = json_encode($session);
          $data['type'] = $type;
          $this->db->insert('test', $data);
          unset($data);
    }

    public function handle_plan_deleted($plan)
    {
        $data['data'] = json_encode($session);
          $data['type'] = $type;
          $this->db->insert('test', $data);
          unset($data);

    }

    public function handle_customer_subscription_created($subscription)
    {
        $data['data'] = json_encode($session);
          $data['type'] = $type;
          $this->db->insert('test', $data);
          unset($data);
    }

    public function handle_customer_subscription_deleted($subscription)
    {
        $data['data'] = json_encode($session);
          $data['type'] = $type;
          $this->db->insert('test', $data);
          unset($data);
    }
    
    function thankyou_page_paypal(){
        $subscriptionID = $_GET['subscription_id'];
        $ba_token = $_GET['ba_token'];
        $token = 'ba_token='.$ba_token;
        $check = $this->db->where('subscription_id',$subscriptionID)->where('token',$token)->get('paypal_subscription')->result_array();
		$check2 = $this->db->where('subscription_id',$subscriptionID)->where('token',$token)->get('paypal_subscription')->row();
        if(count($check) > 0){
			$type = $check2->type;
            if ($type == 'CoverPicture') {
                $data['cover_pic'] = 1;
            }elseif ($type == 'Advertisement') {
                $data['advertisement'] = 1;
            }elseif ($type == 'Membership') {
                $data['membership'] = 1;
            }else{
				 $data['cover_pic'] = 2;
			}
            $this->load->view('front/thank_you',$data);
        }else{
            $this->profile();
        }
        
    }

    function thankyou_page($session_id = "")
    {
        $page_data['sessionId'] = $session_id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.stripe.com/v1/checkout/sessions/".$session_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".STRIPE_SECRET_KEY,
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);

        $subscription_id = $result->subscription;
        $membership = 2;

        $this->createMemberSubscription($subscription_id, $membership);

        $subscriptionDetails = $this->getSubscriptionDetails($subscription_id);

        if ($subscriptionDetails->items->data[0]->plan->product == QUARTERLY_PLAN) {
            $billingType = 1;
        }
        elseif ($subscriptionDetails->items->data[0]->plan->product == BI_ANNUAL_PLAN) {
            $billingType = 2;
        }
        elseif ($subscriptionDetails->items->data[0]->plan->product == ANNUAL_PLAN) {
            $billingType = 3;
        }
        elseif ($subscriptionDetails->items->data[0]->plan->product == DAILY_PLAN) {
            $billingType = 4;
        }
        
        $this->updateSubscriptionBillingType($billingType);
        
        $this->load->view('front/thank_you', $page_data);
    }

    function paypal_notify_membership()
    {
        $file = 'paypal_4.txt';
        $current = json_encode($_POST);
        file_put_contents($file, $current);
         
         $product_id = explode("_", $_POST['custom'])[0];
         $member_id = explode("_", $_POST['custom'])[1];

         if ($_POST['payment_status'] == "Completed" ) {
            
            $_POST['custom'] = $product_id;
            
            $subscription_id = $_POST['subscr_id'];
            $membership = 2;
            
            $this->createMemberSubscriptionPaypal($member_id , $subscription_id, $membership);

            $subscriptionDetails = $this->getSubscriptionDetailsPaypal($member_id , $_POST['custom'] , $_POST['payment_gross'] , $_POST['payment_date'] , $_POST['subscr_id'] , json_encode($_POST) );

            if ( $_POST['custom'] == 1 ) {
                $billingType = 1;
            }
            elseif ($_POST['custom'] == 2 ) {
                $billingType = 2;
            }
            elseif ( $_POST['custom'] == 3 ) {
                $billingType = 3;
            }
            elseif ( $product_id == 4 ) {
                $billingType = 4;
            }
            
            $this->PayPalupdateSubscriptionBillingType($billingType , $member_id );
        }
        
    }
    
    function PayPalupdateSubscriptionBillingType($billingType , $member_id)
    {
        $member_id = $member_id;

        $updateData['billing_id'] = $billingType;
        $updateData['paid_by'] = "paypal";

        $this->db->where('member_id', $member_id);
        $this->db->update('member', $updateData);
    }


    function createMemberSubscriptionPaypal($member_id , $subscribtionId, $membership)
    {
        $member_id = $member_id;

        $updateData['paypal_subscription_id'] = $subscribtionId;
        $updateData['membership'] = $membership;
        $updateData['isProfileCompleted'] = 1;
        $updateData['photo_gallery'] = 3;

        $this->db->where('member_id', $member_id);
        $this->db->update('member', $updateData);

        $messageThread = $this->db->query("SELECT * FROM message_thread WHERE message_thread_from = $member_id")->result();
        
        if (!empty($messageThread)) {
            $updateThread['thread_viewable_to'] = 1;

            $this->db->where('message_thread_from', $member_id);
            $this->db->update('message_thread', $updateThread);
        }

        $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $member_id")->result();

         $this->Email_model->subscription_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);

        recache();
    }


    function getSubscriptionDetailsPaypal($member_id, $productId , $amount , $payment_date ,$subscribtionId, $transection_num  , $details   )
    {
        $memberData = $this->db->get_where('member', array('member_id' => $member_id))->row();

        $date = date('Y-m-d H:i:s');

        $package = "Platinum";
        $amount = $amount;
        $paymentProcessDate = $payment_date;
        

        if ($productId == 3) {
            $billingCycle = "Annually";
            $nextBillingDate = date('Y-m-d H:i:s', strtotime("+12 months", strtotime($date)));
            $dueDate = date('Y-m-d H:i:s', strtotime("+12 months", strtotime($date)));
        }
        elseif($productId == 2) {
            $billingCycle = "Bi-annually";
            $nextBillingDate = date('Y-m-d H:i:s', strtotime("+6 months", strtotime($date)));
            $dueDate = date('Y-m-d H:i:s', strtotime("+6 months", strtotime($date)));
        }
        elseif($productId == 1) {
            $billingCycle = "Quarterly";
            $nextBillingDate = date('Y-m-d H:i:s', strtotime("+3 months", strtotime($date)));
            $dueDate = date('Y-m-d H:i:s', strtotime("+3 months", strtotime($date)));
        }
        elseif($productId == 0) {
            $billingCycle = "Monthly";
            $nextBillingDate = date('Y-m-d H:i:s', strtotime("+1 months", strtotime($date)));
            $dueDate = date('Y-m-d H:i:s', strtotime("+1 months", strtotime($date)));
        }

        $data['member_id'] = $memberData->member_id;
        $data['invoice_no'] = $subscribtionId;
        $data['package'] = $package;
        $data['billing_cycle'] = $billingCycle;
        $data['amount'] = $amount;
        $data['status'] = "active";
        $data['payment_process_date'] = $paymentProcessDate;
        $data['next_billing_date'] = $nextBillingDate;
        $data['due_date'] = $paymentProcessDate;
        $data['payment_by'] = "PayPal";
        $data['details']    = $details;
        $data['trns_id']    = $transection_num;
        // echo "<pre>"; 
        // print_r($data);
        
        // die();
        // $check_trns_id = $this->db->where('trns_id',$transection_num)->get('earning');
        // if(count($check_trns_id) == 0){  
        // }
        
        $insert = $this->db->insert('earning', $data);
        if ($insert) {
            $updateData['subscription_date'] = date('Y-m-d H:i:s');
            $updateData['next_billing_date'] = $nextBillingDate;
            $this->db->where('member_id', $memberData->member_id);
            $this->db->update('member', $updateData);
        } 
    }

    function paypal_notify_cover_pic()
    {
        $file = 'paypalCover.txt';
        $current = json_encode($_POST);
        file_put_contents($file, $current);
        
        if ($_POST['payment_status'] == "Completed") {
            $data['member_plan_id'] = explode("_",$_POST['custom'])[1];
            $data['member_id'] = explode("_",$_POST['custom'])[0];
            $data['client_date'] = explode("_",$_POST['custom'])[2];
            $data['amount'] = $_POST['payment_gross'];
            $data['payment_date'] = date("Y-m-d");
            $data['details'] = json_encode($_POST);
            $data['payment_by'] = "Paypal";

            $cover_pic_plan = $this->db->get_where('cover_pic_plan', array('plan_id' => $_POST['custom'])[1] )->row();
            $day = $cover_pic_plan->week * 7;

            $nextBillingDate = date('Y-m-d', strtotime("+".$day." days"));
            $data['payment_expire_date'] = $nextBillingDate;


            $this->Email_model->cover_pic_payment_notification($_SESSION['member_name'] , $_SESSION['member_email'] , $data['member_plan_id'] );

            $this->db->insert('cover_pic_payment', $data);
        }
    }

    function coverPic_stripe_payment($plan_id , $amount , $date , $session_id )
    {
        $page_data['sessionId'] = $session_id;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.stripe.com/v1/checkout/sessions/".$session_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".STRIPE_SECRET_KEY,
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);

        $data['stripe_customer_id'] = $result->customer;
        $data['stripe_subscription_id'] = $result->subscription;
        $data['member_plan_id'] = $plan_id;
        $data['member_id'] = $this->session->userdata('member_id');
        $data['amount'] = $amount;
        $data['payment_date'] = date( "Y-m-d" );
        
        $data['client_date'] = date( "Y-m-d" , strtotime($date) );
        $data['payment_by'] = "Stripe";
        $data['trns_id'] = $session_id;

        $ck_trns_id = $this->db->get_where('cover_pic_payment', array('trns_id' => $session_id))->row();

        if ($ck_trns_id == "") {
            $cover_pic_plan = $this->db->get_where('cover_pic_plan', array('plan_id' => $plan_id))->row();
            $day = $cover_pic_plan->week * 7;

            $nextBillingDate = date('Y-m-d', strtotime("+".$day." days"));
            $data['payment_expire_date'] = $nextBillingDate;

            $date = date( "Y-m-d" , strtotime($date) );

            $this->db->insert('cover_pic_payment', $data);

            $this->Email_model->cover_pic_payment_notification($_SESSION['member_name'] , $_SESSION['member_email'] , $data['member_plan_id'] );
        
        }
        
        $data['value'] = "buying cover pic package";
		$data['cover_pics_cleck'] = 1;
        $this->load->view('front/custom_thank_you' , $data);

    }

    function paypal_success_membership()
    {
        $this->load->view('front/thank_you');
    }

    function sendCover_pic()
    {
        // print_r($_FILES['image']['name']); die(); 

        if ($_FILES['image']['name'] !== '') {
            $path = $_FILES['image']['name'];

            $id = time();
            $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                    $this->Crud_model->file_upCover("image", "plan", $id, '', '', $ext);
                    $images[] = array('image' => $id. "-".  $_FILES['image']['name'] );
                    $data['image'] = json_encode($images);
            } else {
                    $this->session->set_flashdata('alert', 'failed_image');
                    redirect(base_url() . 'home/profile', 'refresh');
            }

            $ads = $this->db->where('member_id', $this->session->userdata('member_id'))->where('cover_pic_payment_id' , null)->where('status !=',  1)->order_by("cover_pics_id" , 'DESC')->limit(1)->get('cover_pics')->result();
        }

        $data['member_id'] = $this->session->userdata('member_id');
        $data['status'] = 0;

        if (count($ads)) {
            $this->db->where('cover_pics_id', $ads[0]->cover_pics_id );
            $result = $this->db->update('cover_pics', $data);
			$this->db->where('member_id',$this->session->userdata('member_id'))->where('start_date',null)->order_by('cover_pic_payment_id','desc')->update('cover_pic_payment',['image_reject' => 0]);
        }else{
            
            $this->db->insert('cover_pics', $data);
        }

        $this->Email_model->cover_pic_send_notification($_SESSION['member_name'] , $_SESSION['member_email'] );
        
        
        echo json_encode(["success"=>"success"]);
        // $this->session->set_flashdata('alert', 'upload_cover_pic_for_approval');
        // redirect(base_url() . 'home/profile', 'refresh');


    }

    function cover_pic_uplod_update()
    {
        if ($_FILES['image']['name'] !== '') {
            $path = $_FILES['image']['name'];

            $id = time();
            $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
            if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                    $this->Crud_model->file_upCover("image", "plan", $id, '', '', $ext);
                    $images[] = array('image' => $id. "-".  $_FILES['image']['name'] );
                    $data['image'] = json_encode($images);
            } else {
                    $this->session->set_flashdata('alert', 'failed_image');
                    redirect(base_url() . 'home/profile', 'refresh');
            }
        }

        $this->db->where('cover_pics_id', $_POST['cover_pics_id'] );
        $result = $this->db->update('cover_pics', $data);

        $this->session->set_flashdata('alert', 'upload_cover_pic_for_approval');
        redirect(base_url() . 'home/profile', 'refresh');
    }

    function cover_pic_uplod_delete()
    {
        $data['image'] = null;

        $this->db->where('cover_pics_id', $_POST['cover_pics_id'] );
        $result = $this->db->update('cover_pics', $data);

        $this->session->set_flashdata('alert', 'upload_cover_pic_for_approval');
        redirect(base_url() . 'home/profile', 'refresh');
    }

    function adsdetails($id){
            

        $ads = $this->db->where('unique_id',$id)->get('advertisements')->result();

        if (!empty($ads)) {
            $page_data['title'] = "Ads Details || " . $this->system_title;
            $page_data['top'] = "advertisement.php";
            $page_data['page'] = "ads_details";
            $page_data['bottom'] = "advertisement.php";
            $page_data['ads'] = $this->db->get_where('advertisements', array('unique_id' => $id))->row();

            $this->load->view('front/index', $page_data);
        }else{
            redirect(base_url() . 'home', 'refresh');
        }


    }

    function ads_edit($id){
        $page_data['title'] = "Ads Details || " . $this->system_title;
        $page_data['top'] = "advertisement.php";
        $page_data['page'] = "ads_details";
        $page_data['bottom'] = "advertisement.php";
        $page_data['ads'] = $this->db->get_where('advertisements', array('unique_id' => $id))->row();

        $this->load->view('front/edit_ads', $page_data);
    }

    function updateAdvertisement(){
		//print_r($_FILES['file']['name']);
		//print_r($this->input->post());die();
		if(isset($_FILES['file']['name'])){
			if ($_FILES['file']['name'] !== '') {
			$id = time().rand(000,999);
			$path = $_FILES['file']['name'];
			$ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
				if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
					$this->Crud_model->file_upAdvertisement("file", "plan", $id, '', '', $ext);
					$images = $id.$ext;
					$data['company_logo'] = $images;
				}else{
					echo 'logo_error';die();
					//$ajax_error[] = array('ajax_error' => 'Image must be upload JPEG,JPG & PNG !!');
					//echo json_encode($ajax_error);
				}
			}
		}
        $this->form_validation->set_rules('title', 'advertisements title', 'required');
        $this->form_validation->set_rules('address', 'advertisements address', 'required');
        $this->form_validation->set_rules('ads_phone', 'advertisements address', 'required');
        $this->form_validation->set_rules('city_state', 'advertisements city_state', 'required');
        $this->form_validation->set_rules('ads_email', 'advertisements ads_email', 'required');
        if ($this->form_validation->run() == FALSE) {
                $ajax_error[] = array('ajax_error' => validation_errors());
                echo json_encode($ajax_error);
        } else {
                $id = $this->input->post('id');
                $data['title'] = $this->input->post('title');
                $data['address'] = $this->input->post('address');
                $data['ads_phone'] = $this->input->post('ads_phone');
                $data['city_state'] = $this->input->post('city_state');
                $data['ads_email'] = $this->input->post('ads_email');
                $data['company_url'] = $this->input->post('company_url');
                $data['adviser_name'] = $this->input->post('adviser_name');
			    $data['color'] = $this->input->post('color');
                $data['status'] = 3;
                $this->db->where('advertisements_id', $id);
                $result = $this->db->update('advertisements', $data);
				echo 'success';
                //echo json_encode('success');
                // if ($result) {
                //         $this->session->set_flashdata('alert', 'edit');
                // } else {
                //         $this->session->set_flashdata('alert', 'failed_edit');
                // }
        }
        // $id = $this->input->post('id');
        // $data['title'] = $this->input->post('title');
        // $data['address'] = $this->input->post('address');
        // $data['status'] = 3;
        // $this->db->where('advertisements_id',$id)->update('advertisements',$data);
        // echo json_encode('success');
    }


    function paypal_cancel_advertise()
    {
        $this->session->set_flashdata('alert', 'paypal_cancel');
        redirect(base_url() . 'home/profile/', 'refresh');
    }

    function paypalAdvertisementSuccess($word)
    {
        $data['value'] = $word;
        $this->load->view('front/custom_thank_you' , $data);
    }

    function paypalAdvertisementNotify()
    {

        if ($_POST['payment_status'] == "Completed") {

            $data['payment_status'] = "Cash";
            $data['advertisement_id'] = explode("_",$_POST['custom'])[0];
            $data['payment_by'] = "paypal";
            $data['amount'] = $_POST['payment_gross'];
            $data['trns_id'] = $_POST['txn_id'];
            $data['payment_date'] = date("Y-m-d");
            $data['details'] = json_encode($_POST);

            $duration = explode("_",$_POST['custom'])[1];

            $date = date('Y-m-d');
            $date = date('Y-m-d', strtotime('+'.$duration.' month', strtotime($date)));

            $data['payment_expire_date'] = $date;

            $this->db->where('advertisement_id', explode("_",$_POST['custom'])[0] );
            $this->db->update('advertisements_payment', $data );

            

            $dataTwo['start_date'] = date("Y-m-d");
            $dataTwo['end_date'] = $date;
            $dataTwo['status'] = 3;

            $this->db->where('advertisements_id', explode("_",$_POST['custom'])[0] );
            $this->db->update('advertisements', $dataTwo );
            
        }
    }

    function advertisement_stripe_payment($advertisements_id , $amount , $duration , $session_id,$renew="")
    {

        $page_data['sessionId'] = $session_id;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.stripe.com/v1/checkout/sessions/".$session_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".STRIPE_SECRET_KEY,
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);

        $amount = $result->amount_total / 100;

        $data['payment_status'] = "completed";
        $data['advertisement_id'] = $advertisements_id;
        $data['payment_by'] = "Stripe";
        $data['amount'] = $amount;
        $data['trns_id'] = $session_id;
        $data['payment_date'] = date("Y-m-d");
        $data['details'] = json_encode($result);
        $data['customer_id'] = $result->customer;
        $data['subscription_id'] = $result->subscription;

        $date = date('Y-m-d');
        $date = date('Y-m-d', strtotime('+'.$duration.' month', strtotime($date)));
		
		 if($renew == 1){
                $this->db->where('advertisements_id',$advertisements_id);
                $result = $this->db->get('advertisements')->row();
                $date = date('Y-m-d', strtotime('+'.$duration.' month', strtotime($result->end_date)));
			 	$dataTwo['status'] = 8;
        }
        $data['payment_expire_date'] = $date;
        $ck_trns_id = $this->db->get_where('advertisements_payment', array('trns_id' => $session_id))->row();

        if ($ck_trns_id == "") {
            //$this->db->where('advertisement_id', $advertisements_id );
            $this->db->insert('advertisements_payment', $data );

            $dataTwo['start_date'] = date("Y-m-d");
            $dataTwo['end_date'] = $date;
	
            $dataTwo['expired_status']  = 0;
            $dataTwo['payment_status']  = 1;
            $this->db->where('advertisements_id', $advertisements_id );
            $this->db->update('advertisements', $dataTwo );
			
			$this->db->where('advertisements_id',$advertisements_id);
            $result = $this->db->get('advertisements')->row();
			
			$token=random_string('alnum', 8);
            $datathree['advertisements_id']=$advertisements_id;
			$datathree['reg_date']=date("Y-m-d");
            $datathree['random_key']=$token;
            $this->db->insert('invoices',$datathree);    
 
            $this->db->where('advertisements_id',$advertisements_id);
			$this->db->limit(1);
			$this->db->order_by('id','desc');
			$query=$this->db->get('invoices');
			$all_invoice=$query->result();
      
            $this->Email_model->advertisement_invoice_email($advertisements_id,$all_invoice[0]->id);
			$this->Email_model->advertisement_invoice_email_to_admin($advertisements_id,$all_invoice[0]->id);
            $this->Email_model->paypal_payment_success($result->title , $result->ads_email,$amount,$duration,"Stripe",$result->unique_id);
        }

        $data_['value'] = "advertisement";
		$data_['advertisement'] = "advertisement";
        $this->load->view('front/custom_thank_you' , $data_);
    }

     function advertisement(){

        if ($this->input->post('submit') != "submit") {
            $page_data['title'] = "Ads Details || " . $this->system_title;
            $page_data['top'] = "advertisement.php";
            $page_data['page'] = "advertisement";
            $page_data['bottom'] = "advertisement.php";
            $page_data['ads_plans'] = $this->db->get('advertisement_plans')->result();
            $this->load->view('front/index', $page_data);
        }elseif ($this->input->post('submit') == "submit") {
            $this->form_validation->set_rules('adviser_name', 'name', 'required');
            $this->form_validation->set_rules('title', 'name of bussiness', 'required');
            $this->form_validation->set_rules('address', 'advertisements address', 'required');
            $this->form_validation->set_rules('advertisement_plans_id', 'advertisements plan', 'required');
            $this->form_validation->set_rules('ads_email', 'advertisements email', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required');
			$this->form_validation->set_rules('company_url', 'Company URL', 'callback_company_url');
            if ($this->form_validation->run() == FALSE) {
                $page_data['title'] = "Ads Details || " . $this->system_title;
                $page_data['top'] = "advertisement.php";
                $page_data['page'] = "advertisement";
                $page_data['bottom'] = "advertisement.php";
                $page_data['ads_plans'] = $this->db->get('advertisement_plans')->result();
                $this->load->view('front/index', $page_data);
            } else {
				
                $data['adviser_name'] = $this->input->post('adviser_name');
                $data['title'] = $this->input->post('title');
                $data['ads_phone'] = $this->input->post('phone');
                $data['address'] = $this->input->post('address');
                $data['city_state'] = $this->input->post('city_state');
                $data['advertisement_plans_id'] = $this->input->post('advertisement_plans_id');
                $plan_id = $this->input->post('advertisement_plans_id');
                $data['company_url'] = $this->input->post('company_url');
                $plan_data = $this->db->where('id',$plan_id)->get('advertisement_plans')->row();
                $data['duration'] = $plan_data->duration;
                $data['ads_email'] = $this->input->post('ads_email');
				$data['color'] = $this->input->post('color');
                $email = $this->input->post('ads_email');
                $duration = $plan_data->duration;;
                $data['start_date'] = date('Y-m-d');
                $start_date = date('Y-m-d');
                $date = strtotime($start_date);
                $data['end_date'] = date("Y-m-d", strtotime('+'.$duration. 'month', $date));
                // generate unique ID 
                $this->load->helper('string');
                $unique_id = random_string('alnum',12);
                $data['unique_id'] = 'AdsID_'.$unique_id;
                $data['status'] = 3;
				//echo "<pre>";print_r($data);
				if ($_FILES['company_logo']['error'] == 0 && $_FILES['company_logo']['name'] !== "") {
                    $path = $_FILES['company_logo']['name'];
                    $id = time().rand(000,999);
                    $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                            $this->Crud_model->file_upAdvertisement("company_logo", "plan", $id, '', '', $ext);
                            $images = $id.$ext;
                            $data['company_logo'] = $images;
						
						$result = $this->db->insert('advertisements', $data);
                    	$insert_id = $this->db->insert_id();
					
                    	$this->Email_model->advertisement_send_url_notification($data['unique_id'],$email);
                    	if ($result) {
                       		redirect(base_url().'home/advertisement_payment_page/AdsID_'.$unique_id);
                    	} else {
                            $this->session->set_flashdata('alert', 'failed_add');
                    	}
						
                    } else {
						
                		$page_data['adviser_name'] = $this->input->post('adviser_name');
                        $page_data['ads_title'] = $this->input->post('title');
                        $page_data['ads_phone'] = $this->input->post('phone');
                        $page_data['address'] = $this->input->post('address');
                        $page_data['city_state'] = $this->input->post('city_state');
                        $page_data['advertisement_plans_id'] = $this->input->post('advertisement_plans_id');
                        $page_data['company_url'] = $this->input->post('company_url');

                        $page_data['ads_email'] = $this->input->post('ads_email');
                        $page_data['title'] = "Ads Details || " . $this->system_title;
                        $page_data['failed_image'] = "Please upload JPEG, JPG & PNG only !!";
                        $page_data['top'] = "advertisement.php";
                        $page_data['page'] = "advertisement";
                        $page_data['bottom'] = "advertisement.php";
                        $page_data['ads_plans'] = $this->db->get('advertisement_plans')->result();
                        $this->load->view('front/index', $page_data);
                    }

                }else{
                    $result = $this->db->insert('advertisements', $data);
                    
                    $insert_id = $this->db->insert_id();
                    $this->Email_model->advertisement_send_url_notification($data['unique_id'],$email);
					
                    if ($this->Email_model->advertisement_notification_to_admin($data['ads_email'], $data['adviser_name'])) 
                    {
                        //$msg = 'done_but_not_sent';
                       
                    }
                    if ($result) {
                        redirect(base_url().'home/advertisement_payment_page/AdsID_'.$unique_id);
                    } else {
                            $this->session->set_flashdata('alert', 'failed_add');
                    }

                }
            }
        }


    }
	
       public function company_url($str)
        {
		   $result = substr($str, 0, 4);
		   if($result!='http'){
		     $this->form_validation->set_message('company_url', 'Please provide valid url like https://www.test.com');
		    return FALSE;
		   }else{
		   return TRUE;
		   }
		
		
        }

    function advertisement_payment_page($id ="",$renew_id=""){

        $page_data['title'] = "Ads Payment Details || " . $this->system_title;
        $page_data['top'] = "advertisement.php";
        $page_data['page'] = "advertisement-payment";
        $page_data['bottom'] = "advertisement.php";
        $page_data['ads_details'] = $this->db->where('unique_id',$id)->get('advertisements')->row();
		$page_data['re_id']=$renew_id;
        $data = $this->db->where('unique_id',$id)->get('advertisements')->row();
        if (!empty($data)) {
            $this->load->view('front/index', $page_data);
        }else{
         redirect(base_url() . 'home', 'refresh');
        }

    }

    public function checkEventType($type, $event)
    {
        switch ($type) {
            case 'checkout.session.completed':
                $this->handle_checkout_session($event->data->object, $type);
                break;
            case 'customer.created':
                $this->handle_customer_created($event->data->object, $type);
                break;
            case 'customer.deleted':
                $this->handle_customer_deleted($event->data->object, $type);
                break;
            case 'product.created':
                $this->handle_product_created($event->data->object, $type);
                break;
            case 'plan.created':
                $this->handle_plan_created($event->data->object, $type);
                break;
            case 'plan.deleted':
                $this->handle_plan_deleted($event->data->object, $type);
                break;
            case 'customer.subscription.created':
                $this->handle_customer_subscription_created($event->data->object, $type);
                break;
            case 'customer.subscription.deleted':
                $this->handle_customer_subscription_deleted($event->data->object, $type);
                break;
        }
    }

    public function handle_checkout_session($session, $type)
    {
        $data['member_id'] = $this->session->userdata('member_id');
        $data['data'] = $session;
        $data['type'] = $type;
        $data['subs_id'] = $session->subscription;
        $data['date'] = date('Y-m-d H:i:s');
        
        
       //echo "<pre>";print_r($data);
        //cover pic & advertisement

       $cover_pics_subs_ids = $this->db->order_by('cover_pic_payment_id', 'DESC')->where("stripe_subscription_id", $session->subscription )->limit(1)->get('cover_pic_payment')->result_array();

        if ( count($cover_pics_subs_ids) ) {
            $cover_picsPayment = $cover_pics_subs_ids[0];
            $cover_picsPayment['payment_date'] = date("Y-m-d");

            $cover_pic_plan = $this->db->get_where('cover_pic_plan', array('plan_id' => $cover_picsPayment['member_plan_id'] ))->row();
            $day = $cover_pic_plan->week * 7;

            $nextBillingDate = date('Y-m-d', strtotime("+".$day." days"));
            $cover_picsPayment['payment_expire_date'] = $nextBillingDate;
            unset($cover_picsPayment['cover_pic_payment_id']);  
            echo "<pre>";print_r($cover_picsPayment);die();
            $this->db->insert('cover_pic_payment', $cover_picsPayment);

            $cover_pics_data = $this->db->order_by('cover_pics_id', 'DESC')->where("cover_pic_payment_id", $cover_pics_subs_ids[0]['cover_pic_payment_id'] )->where("member_id", $cover_pics_subs_ids[0]['member_id'] )->limit(1)->get('cover_pics')->result_array();

            $end_date = $cover_pics_data[0]['end_date']; 

            $date = strtotime($end_date);
            $start_date = date("Y-m-d" , strtotime( $date));

            if (count($cover_pics_data)) {

                $date = $start_date;
                $date = strtotime($date);
                $date = strtotime("+".$day." day", $date);
                $end_date = date('Y-m-d', $date);

                $cover_pics_data_update['end_date'] = $end_date;

                $this->db->where('cover_pics_id', $cover_pics_data[0]['cover_pics_id'] );
                $this->db->update('cover_pics', $cover_pics_data_update );

            }
        }


        //&advertisement

        $cover_pics_subs_ids = $this->db->order_by('ads_payment_id', 'DESC')->where("subscription_id", $session->subscription )->limit(1)->get('advertisements_payment')->result_array();
        echo count($cover_pics_subs_ids);
        if ( count($cover_pics_subs_ids)) {
            $cover_picsPayment = $cover_pics_subs_ids[0];
            $cover_picsPayment['payment_date'] = date("Y-m-d");
            $cover_pic_plan = $this->db->get_where('advertisements', array('advertisements_id' => $cover_pics_subs_ids[0]['advertisement_id'] ))->row();
            $day = $cover_pic_plan->duration;
            $nextBillingDate = date('Y-m-d', strtotime("+".$day." month"));
            $cover_picsPayment['payment_expire_date'] = $nextBillingDate;
            unset($cover_picsPayment['ads_payment_id']);  
            echo "<pre>";print_r($cover_picsPayment);
            $this->db->insert('advertisements_payment', $cover_picsPayment);

            $start_date = date("Y-m-d");

            $date = $start_date;
            $date = strtotime($date);
            $date = strtotime("+".$day." month", $date);
            $end_date = date('Y-m-d', $date);

            $cover_pics_data_update['end_date'] = $end_date;
            $cover_pics_data_update['expired_status'] = 0;
            $cover_pics_data_update['payment_status'] = 1;

            $this->db->where('advertisements_id', $cover_picsPayment['advertisement_id'] );
            $this->db->update('advertisements', $cover_pics_data_update );

        }

        $this->db->insert('test', $data);
        unset($data);  
    }
    
    function paypalWebhook()
    {
		//echo $_SESSION['member_name'] ;echo $_SESSION['member_email'];die();
        $file = 'paypal__'.time().rand(9,9999).'.txt';
        $x = file_get_contents('php://input');
        file_put_contents($file, $x);
        //$x = file_get_contents('paypal__16118282285265.txt');
        $y = json_decode($x);
        $event_type = $y->event_type;
        
        if($event_type == "PAYMENT.SALE.COMPLETED"){
            $resource = $y->resource;
            $subscrib_id = $resource->billing_agreement_id;
            $amount = $y->resource->amount->total;
            $trns_id =  $y->resource->id;
            $payment_date = $y->create_time;
           
            $paypal_subscription = $this->db->where('subscription_id',$subscrib_id)->get('paypal_subscription')->row();
            
            $type = $paypal_subscription->type;
            $member_id = $paypal_subscription->member_id;
            $token = $paypal_subscription->token;
            $planID = $paypal_subscription->plan_id;
            
            if($type =="Advertisement"){
                if($amount==100){
                    $duration = 6;
                }else if($amount==150){
                    $duration = 12;
                }
				
				
                if($planID == 'P-8DY248131L1800107MCJXQNQ'){
                    $duration = 6;
                }else if($planID == 'P-22G76871LG661705JMCJX4DI'){
                    $duration = 12;
                }
				
                $get_advertisement = $this->db->order_by('ads_payment_id', 'DESC')->where("subscription_id", $subscrib_id )->limit(1)->get('advertisements_payment')->result_array();
    
                if ( count($get_advertisement) ) {
                    $ck_trns_id = $this->db->where('trns_id',$trns_id)->get('advertisements_payment');
                    if (count($ck_trns_id) == 0) {
                        $data_insert['payment_status'] = "completed";
                        $data_insert['advertisement_id'] = $member_id;
                        $data_insert['payment_by'] = "paypal";
                        $data_insert['amount'] = $amount;
                        $data_insert['trns_id'] = $trns_id;
                        $data_insert['payment_date'] = date("Y-m-d");
                        $data_insert['details'] = json_encode($y);
                        $data_insert['subscription_id'] = $subscrib_id;
                        $data_insert['customer_id'] = $member_id;
                        //$duration = explode("_",$data['custom'])[2];
                        $date = date('Y-m-d');
                        $date = date('Y-m-d', strtotime('+'.$duration.' month', strtotime($date)));
                        $data_insert['payment_expire_date'] = $date;
                        // echo "2nd:<br>";
                        // echo "<pre>"; 
                        // print_r($data_insert);
                        $this->db->insert('advertisements_payment', $data_insert );
                        
                        $dataTwo['start_date'] = date("Y-m-d");
                        $dataTwo['end_date'] = $date;
                        $dataTwo['status'] = 3;
                        $dataTwo['expired_status']  = 0;
                        $dataTwo['payment_status']  = 1;
        
                        $this->db->where('advertisements_id',$member_id);
                        $this->db->update('advertisements', $dataTwo );
						
						$this->db->where('advertisements_id',$member_id);
                    	$result = $this->db->get('advertisements')->row();
                   		$this->Email_model->paypal_payment_success($result->title , $result->ads_email,$amount,$duration,"Paypal",$result->unique_id);
                    }
                }else{
    
                    $data_insert['payment_status'] = "completed";
                    $data_insert['advertisement_id'] = $member_id;
                    $data_insert['payment_by'] = "paypal";
                    $data_insert['amount'] = $amount;
                    $data_insert['trns_id'] = $trns_id;
                    $data_insert['payment_date'] = date("Y-m-d");
                    $data_insert['details'] = json_encode($y);
                    $data_insert['subscription_id'] = $subscrib_id;
                    $data_insert['customer_id'] = $member_id;
                    //$duration = explode("_",$data['custom'])[2];
                    $date = date('Y-m-d');
                    $date = date('Y-m-d', strtotime('+'.$duration.' month', strtotime($date)));
                    $data_insert['payment_expire_date'] = $date;
                    $this->db->insert('advertisements_payment', $data_insert );
                    echo "1st: <br>";
                    echo "<pre>"; 
                    print_r($data_insert);
                    //die();
        
                    $dataTwo['start_date'] = date("Y-m-d");
                    $dataTwo['end_date'] = $date;
                    $dataTwo['status'] = 3;
                    $dataTwo['expired_status']  = 0;
                    $dataTwo['payment_status']  = 1;
    
                    $this->db->where('advertisements_id',$member_id);
                    $this->db->update('advertisements', $dataTwo );
					
					$this->db->where('advertisements_id',$member_id);
                    $result = $this->db->get('advertisements')->row();
                    $this->Email_model->paypal_payment_success($result->title , $result->ads_email,$amount,$duration,"Paypal",$result->unique_id );
    
                }
            }
            // end advertisement
            // start cover picture
            if($type =="CoverPicture"){
                $memberDetails = $this->db->where('member_id',$member_id)->get('member')->row();
                $name = $memberDetails->first_name.' '.$memberDetails->last_name;
                $email = $memberDetails->email;
                if($amount == 50){
                    $member_plan_id = 5;
                    $duration = 7;
                }else if($amount == 100){
                    $member_plan_id = 7;
                    $duration = 14;
                }
				
				
				
                if($planID == 'P-2N19376019288693FMAB6MGA'){
                    $member_plan_id = 5;
                    $duration = 7;
                }else if($planID == 'P-4XC57865DE037205MMAB6MZQ'){
                    $member_plan_id = 7;
                    $duration = 14;
                }
				
				
                $client_date = $y->create_time;
                
                $cover_pics_subs_ids = $this->db->order_by('cover_pic_payment_id', 'DESC')->where("stripe_subscription_id", $subscrib_id  )->limit(1)->get('cover_pic_payment')->result_array();

                if ( count($cover_pics_subs_ids) ) {
                    $ck_trns_id = $this->db->get_where('cover_pic_payment', array('trns_id' => $trns_id))->row();
					
                    if ($ck_trns_id =="") {
                        $data_insert['member_plan_id'] = $member_plan_id;
                        $data_insert['member_id'] = $member_id;
                        $data_insert['client_date'] = date('Y-m-d', strtotime($client_date));
                        $data_insert['amount'] = $amount;
                        $data_insert['payment_date'] = date("Y-m-d");
                        $data_insert['details'] = json_encode($y);
                        $data_insert['payment_by'] = "Paypal";
    
                        $cover_pic_plan = $this->db->get_where('cover_pic_plan', array('plan_id' => $member_plan_id ))->row();
                        $day = $cover_pic_plan->week * 7;
    
                        $nextBillingDate = date('Y-m-d', strtotime("+".$duration." days"));
                        $data_insert['payment_expire_date'] = $nextBillingDate;
                        $data_insert['stripe_subscription_id'] = $subscrib_id;
                        $data_insert['stripe_customer_id'] = $member_id;
                        $data_insert['trns_id'] = $trns_id;
    
                        $this->db->insert('cover_pic_payment', $data_insert);
    
                        $this->Email_model->cover_pic_payment_notification($name, $email,$member_plan_id );
                        
    
                        $cover_pics_data = $this->db->order_by('cover_pics_id', 'DESC')->where("cover_pic_payment_id", $cover_pics_subs_ids[0]['cover_pic_payment_id'] )
                        ->where("member_id", $cover_pics_subs_ids[0]['member_id'] )->limit(1)->get('cover_pics')->result_array();
    
                        $end_date = $cover_pics_data[0]['end_date']; 
    
                        $date = strtotime($end_date);
                        $start_date = date("Y-m-d" , strtotime( $date));
    
                        if (count($cover_pics_data)) {
                            $date = $start_date;
                            $date = strtotime($date);
                            $date = strtotime("+".$duration." day", $date);
                            $end_date = date('Y-m-d', $date);
    
                            $cover_pics_data_update['end_date'] = $end_date;
    
                            $this->db->where('cover_pics_id', $cover_pics_data[0]['cover_pics_id'] );
                            $this->db->update('cover_pics', $cover_pics_data_update );
    
                        }
    
                    }
                }else{
                    $data_insert['member_plan_id'] = $member_plan_id;
                    $data_insert['member_id'] = $member_id;
                    $data_insert['client_date'] = date('Y-m-d', strtotime($client_date));
                    $data_insert['amount'] = $amount;
                    $data_insert['payment_date'] = date("Y-m-d");
                    $data_insert['details'] = json_encode($y);
                    $data_insert['payment_by'] = "Paypal";

                    $cover_pic_plan = $this->db->get_where('cover_pic_plan', array('plan_id' => $member_plan_id ))->row();
                    $day = $cover_pic_plan->week * 7;

                    $nextBillingDate = date('Y-m-d', strtotime("+".$duration." days"));
                    $data_insert['payment_expire_date'] = $nextBillingDate;
                    $data_insert['stripe_subscription_id'] = $subscrib_id;
                    $data_insert['stripe_customer_id'] = $member_id;
                    $data_insert['trns_id'] = $trns_id;
				 
                    $this->db->insert('cover_pic_payment', $data_insert);
                    
                    $this->Email_model->cover_pic_payment_notification($name, $email,$member_plan_id );
                } 
                
            }
            
            // start membership
            if ( $type =="Membership") {
				
                if($amount = 5){
                    $product_id = 0;
                }else if($amount = 15){
                    $product_id = 1;
                }else if($amount = 30){
                    $product_id = 2;
                }else if($amount = 50){
                    $product_id = 3;
                }
				
				if($planID == 'P-4N705238PK397611UMAB7P5Y'){
                    $product_id = 0;
                }else if($planID == 'P-43J88522GX8635343MAB7RCI'){
                    $product_id = 1;
                }else if($planID == 'P-8D4066048N4523633MAB7SFA'){
                    $product_id = 2;
                }else if($planID == 'P-8VB60781S06723334MAB7TNQ'){
                    $product_id = 3;
                }
                
                //$subscription_id = $data['recurring_payment_id'];
                $subscription_id = $subscrib_id;
                $membership = 2;
                
                $check_trns_id = $this->db->where('trns_id',$trns_id)->get('earning')->result();
            // echo "<pre>"; 
            // print_r(count($check_trns_id));die();
                if(count($check_trns_id) == 0){  
                    
                    $this->createMemberSubscriptionPaypal($member_id , $subscription_id, $membership);
                    //$subscriptionDetails = $this->getSubscriptionDetailsPaypal($member_id , $product_id , $data['payment_gross'] , $data['payment_date'] , $data['recurring_payment_id'] , json_encode($data) );
                    
                    $subscriptionDetails = $this->getSubscriptionDetailsPaypal($member_id , $product_id , $amount , $payment_date , $subscription_id,$trns_id , json_encode($y) );
        
                    if ( $product_id == 1 ) {
                        $billingType = 1;
                    }
                    elseif ($product_id == 2 ) {
                        $billingType = 2;
                    }
                    elseif ( $product_id == 3 ) {
                        $billingType = 3;
                    }
                    elseif ( $product_id == 0 ) {
                        $billingType = 4;
                    }
                    
                    $this->PayPalupdateSubscriptionBillingType($billingType , $member_id );
                    
                }
                
               
            }
            
            
            
        }
        

        // if ($type == "cover" && $data['payment_status'] == "Completed" ) {

        //     $member_plan_id = explode("_",$data['custom'])[2];
        //     $member_id = explode("_",$data['custom'])[1];
        //     $client_date = explode("_",$data['custom'])[3];

        //     $cover_pics_subs_ids = $this->db->order_by('cover_pic_payment_id', 'DESC')->where("stripe_subscription_id", $subscription_id  )->limit(1)->get('cover_pic_payment')->result_array();

        //     if ( count($cover_pics_subs_ids) ) {

        //         $ck_trns_id = $this->db->get_where('cover_pic_payment', array('trns_id' => $trns_id))->row();

        //         if ($ck_trns_id =="") {

        //             $cover_picsPayment = $cover_pics_subs_ids[0];
        //             $cover_picsPayment['payment_date'] = date("Y-m-d");
        //             $cover_pic_plan = $this->db->get_where('cover_pic_plan', array('plan_id' => $cover_picsPayment['member_plan_id'] ))->row();
        //             $day = $cover_pic_plan->week * 7;
        //             $nextBillingDate = date('Y-m-d', strtotime("+".$day." days"));
        //             $cover_picsPayment['payment_expire_date'] = $nextBillingDate;
        //             unset($cover_picsPayment['cover_pic_payment_id']);  

        //             $this->db->insert('cover_pic_payment', $cover_picsPayment);

        //             $cover_pics_data = $this->db->order_by('cover_pics_id', 'DESC')->where("cover_pic_payment_id", $cover_pics_subs_ids[0]['cover_pic_payment_id'] )->where("member_id", $cover_pics_subs_ids[0]['member_id'] )->limit(1)->get('cover_pics')->result_array();

        //             $end_date = $cover_pics_data[0]['end_date']; 

        //             $date = strtotime($end_date);
        //             $start_date = date("Y-m-d" , strtotime( $date));

        //             if (count($cover_pics_data)) {
        //                 $date = $start_date;
        //                 $date = strtotime($date);
        //                 $date = strtotime("+".$day." day", $date);
        //                 $end_date = date('Y-m-d', $date);

        //                 $cover_pics_data_update['end_date'] = $end_date;

        //                 $this->db->where('cover_pics_id', $cover_pics_data[0]['cover_pics_id'] );
        //                 $this->db->update('cover_pics', $cover_pics_data_update );

        //             }

        //         }
        //     }else{

        //         if ($data['payment_status'] == "Completed") {
        //             $data_insert['member_plan_id'] = explode("_",$data['custom'])[2];
        //             $data_insert['member_id'] = explode("_",$data['custom'])[1];
        //             $data_insert['client_date'] = date('Y-m-d', strtotime($client_date));
        //             $data_insert['amount'] = $data['payment_gross'];
        //             $data_insert['payment_date'] = date("Y-m-d");
        //             $data_insert['details'] = json_encode($data);
        //             $data_insert['payment_by'] = "Paypal";

        //             $cover_pic_plan = $this->db->get_where('cover_pic_plan', array('plan_id' => $member_plan_id ))->row();
        //             $day = $cover_pic_plan->week * 7;

        //             $nextBillingDate = date('Y-m-d', strtotime("+".$day." days"));
        //             $data_insert['payment_expire_date'] = $nextBillingDate;
        //             $data_insert['stripe_subscription_id'] = $subscription_id;
        //             $data_insert['stripe_customer_id'] = $data['payer_id'];
        //             $data_insert['trns_id'] = $data['txn_id'];

        //             $this->db->insert('cover_pic_payment', $data_insert);

        //             $this->Email_model->cover_pic_payment_notification($_SESSION['member_name'] , $_SESSION['member_email'] , explode("_",$data['custom'])[2] );
        //         }
        //     }  
        // }
        

        if($event_type == "BILLING.SUBSCRIPTION.ACTIVATED"){
            
            $payment_date = $y->create_time;
            $resource = $y->resource;
            $subscrib_id = $resource->id;
            $plan_id = $resource->plan_id;
            
            $paypal_subscription = $this->db->where('subscription_id',$subscrib_id)->get('paypal_subscription')->row();
            
            $type = $paypal_subscription->type;
            $member_id = $paypal_subscription->member_id;
            $token = $paypal_subscription->token;
            
            
            // if ($type =="Advertisement") {
                    
            //     if ($plan_id == PAYPAL_SIX_MONTH_ADS_PLAN_ID) {
            //           $amount = 100;
            //           $duration = 6;
            //         }else if($plan_id == PAYPAL_TWELVE_MONTH_ADS_PLAN_ID){
            //           $amount = 150;
            //           $duration = 12;
            //         }
                    
            //     $get_advertisement = $this->db->order_by('ads_payment_id', 'DESC')->where("subscription_id", $subscrib_id )->limit(1)->get('advertisements_payment')->result_array();
    
            //     if ( count($get_advertisement) ) {
            //         $ck_trns_id = $this->db->get_where('advertisements_payment', array('trns_id' => $token))->row();
            //         if ($ck_trns_id == "") {
                        
            //             $cover_picsPayment = $get_advertisement[0];
            //             $cover_picsPayment['payment_date'] = date("Y-m-d");
            //             $cover_pic_plan = $this->db->get_where('advertisements', array('advertisements_id' => $get_advertisement[0]['advertisement_id'] ))->row();
            //             $day = $cover_pic_plan->duration;
            //             $nextBillingDate = date('Y-m-d', strtotime("+".$day." month"));
            //             $cover_picsPayment['payment_expire_date'] = $nextBillingDate;
            //             unset($cover_picsPayment['ads_payment_id']);  
    
            //             $this->db->insert('advertisements_payment', $cover_picsPayment);
    
            //             $start_date = date("Y-m-d");
    
            //             $date = $start_date;
            //             $date = strtotime($date);
            //             $date = strtotime("+".$day." month", $date);
            //             $end_date = date('Y-m-d', $date);
    
            //             $cover_pics_data_update['end_date'] = $end_date;
            //             $cover_pics_data_update['expired_status'] = 0;
            //             $cover_pics_data_update['payment_status'] = 1;
            //             $this->db->where('advertisements_id', $cover_picsPayment['advertisement_id'] );
            //             $this->db->update('advertisements', $cover_pics_data_update );
            //         }
            //     }else{
    
            //         $data_insert['payment_status'] = "completed";
            //         $data_insert['advertisement_id'] = $member_id;
            //         $data_insert['payment_by'] = "paypal";
            //         $data_insert['amount'] = $amount;
            //         $data_insert['trns_id'] = '';
            //         $data_insert['payment_date'] = date("Y-m-d");
            //         $data_insert['details'] = json_encode($y);
            //         $data_insert['subscription_id'] = $subscrib_id;
            //         $data_insert['customer_id'] = $plan_id;
            //         //$duration = explode("_",$data['custom'])[2];
            //         $date = date('Y-m-d');
            //         $date = date('Y-m-d', strtotime('+'.$duration.' month', strtotime($date)));
            //         $data_insert['payment_expire_date'] = $date;
            //         echo "<br>";
            //         echo "<pre>"; 
            //         print_r($data_insert);
            //         die();
            //         $this->db->insert('advertisements_payment', $data_insert );
                    
    
            //         $dataTwo['start_date'] = date("Y-m-d");
            //         $dataTwo['end_date'] = $date;
            //         $dataTwo['status'] = 3;
            //         $dataTwo['expired_status']  = 0;
            //         $dataTwo['payment_status']  = 1;
    
            //         $this->db->where('advertisements_id',$member_id);
            //         $this->db->update('advertisements', $dataTwo );
    
    
            //         if ($data['payment_status'] == "Completed") { 
            //         }
    
    
            //     }
            // }
            
            
            // if ( $type =="Membership") {
            
            
            //     if($plan_id == PAYPAL_PER_MONTH_PLAN_ID){
            //         $product_id = 0;
            //         $amount = 5;
            //     }else if($plan_id == PAYPAL_THREE_MONTH_PLAN_ID){
            //         $product_id = 1;
            //         $amount = 15;
            //     }else if($plan_id == PAYPAL_SIX_MONTH_PLAN_ID){
            //         $product_id = 2;
            //         $amount = 30;
            //     }else if($plan_id == PAYPAL_TWELVE_MONTH_PLAN_ID){
            //         $product_id = 3;
            //         $amount = 50;
            //     }
                
            //     //$subscription_id = $data['recurring_payment_id'];
            //     $subscription_id = $subscrib_id;
            //     $membership = 2;
    
            //     $this->createMemberSubscriptionPaypal($member_id , $subscription_id, $membership);
            //     //$subscriptionDetails = $this->getSubscriptionDetailsPaypal($member_id , $product_id , $data['payment_gross'] , $data['payment_date'] , $data['recurring_payment_id'] , json_encode($data) );
                
            //     $subscriptionDetails = $this->getSubscriptionDetailsPaypal($member_id , $product_id , $amount , $payment_date , $subscription_id , json_encode($y) );
    
            //     if ( $product_id == 1 ) {
            //         $billingType = 1;
            //     }
            //     elseif ($product_id == 2 ) {
            //         $billingType = 2;
            //     }
            //     elseif ( $product_id == 3 ) {
            //         $billingType = 3;
            //     }
            //     elseif ( $product_id == 0 ) {
            //         $billingType = 4;
            //     }
                
            //     $this->PayPalupdateSubscriptionBillingType($billingType , $member_id );
                
            //     // echo "<pre>"; 
            //     // print_r($type);
                
            //     // die();
                
               
            // }
        }

    }
    

    

    public function get_all_premium_member(){
        $max_premium_member_num = $this->db->get_where('frontend_settings', array('type' => 'max_premium_member_num'))->row()->value;
        $max_story_num = $this->db->get_where('frontend_settings', array('type' => 'max_story_num'))->row()->value;
        $page_data['premium_members'] = $this->db->query("SELECT * FROM `member` WHERE membership = 2 OR membership = 3 OR membership = 4 AND is_blocked = 'no' AND is_closed = 'no' AND is_deleted = '0' ORDER BY rand() LIMIT $max_premium_member_num")->result();

        $this->load->view('front/home/premium_all_members', $page_data);
    }
	
	public function countmessage(){
      $user_id = $this->session->userdata('member_id');
      $this->db->select('im_receiver.m_id as message_thread_id,im_message.sender as member_id, im_receiver.time as message_thread_time')
          ->join('im_message', 'im_message.m_id = im_receiver.m_id','left')
          ->where("im_receiver.r_id",$user_id)
          ->where("im_receiver.received",0)
          ->where("im_message.sender !=",$user_id)
          ->where("im_message.message !=",'')
          ->group_by("im_receiver.g_id");
      $result =  $this->db->get('im_receiver')->result();
      $messageCount = count($result);
      if ($messageCount < 100) {
        echo $msgc = $messageCount;
      }else{
        echo "99+";
      }
    }



    public function countmessage_body(){
        $this->load->view('front/header/msg_body');
    }


    public function checkOnlinStatus($memberID){
        $members = $this->db->where('member_id',$memberID)->get('member');
		$results=$members->result();
		foreach($results as $member){
        $id = $member->isOnline;
		}
        echo $id;
    }
	
	public function coverPic_page_redirect(){
        $page_data['top'] = "profile.php";
        $page_data['page'] = "profile/dashboard";
        $page_data['bottom'] = "profile.php";
        $page_data['cover_pic_redirect'] = 1;
        $page_data['get_member'] = $this->db->get_where("member", array("member_id" => $this->session->userdata('member_id')  ))->result();
        $page_data['get_member_gallery_items'] = $this->db->get_where("gallery_items", array("member_id" => $this->session->userdata('member_id')))->result();
        $this->load->view('front/index',$page_data);
    }
	
		  
	


    public function delete_message(){
        $id =  $this->session->userdata('member_id');
        $date = date('Y-m-d');
        $date2 = date('Y-m-d', strtotime($date. ' - 10 days'));

        $previes_msgs = $this->db->where('sender',$id)->where('date <',$date2)->get('im_message')->result_array();
        foreach ($previes_msgs as $key => $value) {
            $msgID = $value['m_id'];
            $this->db->where('m_id',$msgID)->delete('im_message');
            $this->db->where('m_id',$msgID)->delete('im_receiver');
        }
        echo 'success';
    }
	
			public function delete_message_sent(){
            $reciver_id=$this->input->post('reciver_id');
		    $sender_id=$this->input->post('sender_id');
       
           
          $this->db->where('receiver',$reciver_id)->where('sender',$sender_id)->where('receiver',$reciver_id)->delete('im_message');
         
				
			$all_messages = $this->db->where('sender',$sender_id)->group_by('receiver')->get('im_message');
			$results=$all_messages->result();
				$sent_members=array();
				$total=array();
			foreach($results as $messages_part){
					 $find_member_id=$this->db->where('g_id',$messages_part->receiver)->where('u_id !=',$messages_part->sender)->get('im_group_members')->row();
				
			
			$member_details= $this->db->where('member_id',$find_member_id->u_id)->get('member');
			$results2=$member_details->result();
			 
			$receiver_id=$messages_part->receiver;
			// $sent_members[]=$receiver_id;	
			
			$sent_members['receiver_id']=$receiver_id;
			$sent_members['main']=$results2;
				print_r($sent_members['main']);echo"";
				$total[]=$sent_members;
			}
				// print_r($total);
				echo json_encode($total);
			}
	
    
}