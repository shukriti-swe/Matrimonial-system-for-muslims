<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Email_model extends CI_Model {
        /*  
        *  Developed by: Active IT zone
        *  Date    : 18 September, 2017
        *  Active Matrimony CMS
        *  http://codecanyon.net/user/activeitezone
        */

        function __construct() {
            parent::__construct();
        }

        function password_reset_email($account_type = '', $id = '', $pass = '', $str = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));

            if ($query->num_rows() > 0) {

                $sub = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->subject;
                $to = $query->row()->email;
                if ($account_type == 'member') {
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                } else {
                    $to_name = $query->row()->name;
                }
                $email_body = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->body;
                $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                $email_body = str_replace('[[to]]', $to_name, $email_body);
                $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                $email_body = str_replace('[[package]]', $str, $email_body);
                $email_body = str_replace('[[password]]', $pass, $email_body);
                $email_body = str_replace('[[from]]', $from_name, $email_body);
                
                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body);
                return $send_mail;
            } else {
                return false;
            }
        }
   function account_activation($email = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

					$to = $email;

  
                    $email_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/><br/> Your account is activated please login and complete your profile to continue using Match Made In Jannah";
       
                
                $send_mail = $this->do_email($from, $from_name, $to, "Account Activation", $email_body);
                return $send_mail;

        }
    function new_account_notification($email = '', $name = '') {
				
                $this->load->database();
                $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
                if ($protocol == 'smtp') {
                    $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                } else if ($protocol == 'mail') {
                    $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
                }
    
                $to = $from;
                //echo '<pre>';
				//print_r($to);die();
                //please unblock the account from admin panel to allow the user to use his account
    			$email_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/><br/> A new user has been registered with name ".$name ." and email ".$email.".";
    			
    			$send_mail = $this->do_email($from, $from_name, "matchmadeadmi@gmail.com", "New User Registration", $email_body);
    			//$send_mail = $this->do_email($from, $from_name, "robelsust@pepisandbox.com", "New User Registration", $email_body);
    			//contact@aminmotiwala.com

    			return $send_mail;
            }
            
            function send_contact_us($email = '', $message = '') {
                $this->load->database();
                $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
                if ($protocol == 'smtp') {
                    $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                } else if ($protocol == 'mail') {
                    $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
                }
    
                $to = $from;
                
    			$email_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/><br/> There is a new message from: ".$email."  \nMessage: ".$message;
    			
    			//$send_mail = $this->do_email($from, $from_name, "contact@aminmotiwala.com", "New Contact Us Message", $email_body);
                $send_mail = $this->do_email($from, $from_name, "customers@matchmadeinjannah.com", "New Contact Us Message", $email_body);

    			return $send_mail;
            }
        function status_email($account_type = '', $id = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));

            if ($query->num_rows() > 0) {
                $sub = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->subject;
                $to = $query->row()->email;
                if ($account_type == 'user') {
                    $to_name = $query->row()->firstname . ' ' . $query->row()->lastname;
                } else {
                    $to_name = $query->row()->name;
                }
                if ($query->row()->status == 'approved') {
                    $status = "Approved";
                } else {
                    $status = "Postponed";
                }
                $email_body = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->body;
                $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                $email_body = str_replace('[[to]]', $to_name, $email_body);
                $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                $email_body = str_replace('[[email]]', $to, $email_body);
                $email_body = str_replace('[[status]]', $status, $email_body);
                $email_body = str_replace('[[from]]', $from_name, $email_body);

                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body);
                return $send_mail;
            } else {
                return false;
            }
        }

        function account_opening($account_type = '', $email = '', $pass = '', $encrptMemberIid = '') {

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {

                if ($account_type == 'member') {

                    $sub = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
                    //$to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                    $to_name = $query->row()->user_name;
                    $url = base_url()."home/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->body;
                    $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                    $email_body = str_replace('[[member_id]]', $encrptMemberIid, $email_body);
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[password]]', $pass, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }
                elseif ($account_type == 'admin') {
                    $sub = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->subject;
                    $to_name = $query->row()->name;
                    $role_type = $this->Crud_model->get_type_name_by_id('role', $query->row()->role);
                    $url = base_url()."admin/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->body;
                    $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[role_type]]', $role_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[password]]', $pass, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }
                
                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body);
                return $send_mail;
            } else {
                return false;
            }
        }

        function staff_account_add($account_type = '', $email = '', $pass = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $email;
            $query = $this->db->get_where($account_type, array('email' => $email));

            if ($query->num_rows() > 0) {
                $sub = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
                if ($account_type == 'member') {
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
                    $url = base_url()."home/login";

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->body;
                    $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[password]]', $pass, $email_body);
                    $email_body = str_replace('[[url]]', $url, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }
                
                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body);
                return $send_mail;
            } else {
                return false;
            }
        }

        function subscruption_email($account_type = '', $member_id = '', $plan_id = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $this->db->get_where('member', array('member_id' => $member_id))->row()->email;
            $package = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->name;
            $amount = $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->amount;
            $query = $this->db->get_where('member', array('email' => $to));

            if ($query->num_rows() > 0) {
                $sub = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->subject;
                if ($account_type == 'member') {

                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;

                    $email_body = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->body;
                    $email_body = str_replace('[[to]]', $to_name, $email_body);
                    $email_body = str_replace('[[sitename]]', $from_name, $email_body);
                    $email_body = str_replace('[[account_type]]', $account_type, $email_body);
                    $email_body = str_replace('[[email]]', $to, $email_body);
                    $email_body = str_replace('[[package]]', $package, $email_body);
                    $email_body = str_replace('[[amount]]', $amount, $email_body);
                    $email_body = str_replace('[[from]]', $from_name, $email_body);
                }
                $send_mail = $this->do_email($from, $from_name, $to, $sub, $email_body);
                return $send_mail;
            } else {
                return false;
            }
        }
        
        function newsletter($title = '', $text = '', $email = '', $from = '') {
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $this->do_email($from, $from_name, $email, $title, $text);
        }

        /* ***custom email sender*** */

        function do_email($from = '', $from_name = '', $to = '', $sub = '', $msg = '') {
		
			
            //temporary by rs need to be remove 
			$from='newest@therssoftware.com';
			$from_name='newest@therssoftware.com';
			//temporary ends
            $this->load->library('email');

            if($to == ''){
                echo 'Email receiver address is required';exit;
               // return false;
            }
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.therssoftware.com';
			$config['smtp_user'] = 'newest@therssoftware.com';
			$config['smtp_pass'] = 'PLJZQwjHq2b%';
			$config['smtp_port'] = '465';
			$config['smtp_crypto'] = 'ssl';
			
			$this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from($from, $from_name);
            $this->email->to($to);
            $this->email->subject($sub);
            $this->email->message($msg);

            if ($this->email->send()) {
				//echo 'hi';
               echo $this->email->print_debugger();
				
                return true;
            } else {
			
                echo $this->email->print_debugger();exit;
               // return false;
            }

        }
		
		function do_email_ads($from = '', $from_name = '', $to = '',$to_name = '', $sub = '', $msg = '') {
            
			//temporary by rs need to be remove 
			$from='newest@therssoftware.com';
			$from_name='newest@therssoftware.com';
			//temporary ends
			
            $this->load->library('email');

            if($to == ''){
                echo 'Email receiver address is required';exit;
               // return false;
            }
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.therssoftware.com';
			$config['smtp_user'] = 'newest@therssoftware.com';
			$config['smtp_pass'] = 'PLJZQwjHq2b%';
			$config['smtp_port'] = '465';
			$config['smtp_crypto'] = 'ssl';
			
			$this->email->initialize($config);
			$this->email->initialize();
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from($from, $from_name);
            $this->email->to($to,$to_name);
            $this->email->subject($sub);
            $this->email->message($msg);

            if ($this->email->send()) {
               // echo $this->email->print_debugger();
                return true;
            } else {
                echo $this->email->print_debugger();exit;
               // return false;
            }

        }

        function send_message_email($para1)
        {
          
            $date = date('Y-m-d H:i:s');
            $data['member_profile_id'] = $para1;
            $data['email_sent'] = 1;
            $data['type'] = 2;
            $data['email_date'] = $date;

            $this->db->insert('member_email', $data);

            $query = $this->db->get_where('email_template', array(
                'email_template_id' => 10
            ))->row();

            $email_row = $this->db->get_where('member', array(
                'member_id' => $para1
            ))->row();
            $email = $email_row->email;

            $email_body = $query->body;
            $to_name = $email_row->first_name;

            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $to_name, $email_body);


            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;

            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $system_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $this->do_email($from, $system_name, $email, $query->subject, $email_body);
        }
        
        function delete_account_email($para1){

            $date = date('Y-m-d H:i:s');
            $data['member_profile_id'] = $para1;
            $data['email_sent'] = 1;
            $data['type'] = 2;
            $data['email_date'] = $date;

            $this->db->insert('member_email', $data);

            $query = $this->db->get_where('email_template', array(
                'email_template_id' => 11
            ))->row();

            $email_row = $this->db->get_where('member', array(
                'member_id' => $para1
            ))->row();

            $email = $email_row->email;

            $email_body = $query->body;
            $to_name = $email_row->first_name . " " . $email_row->last_name;

            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $to_name, $email_body);

            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;

            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $system_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $this->do_email($from, $system_name, $email, $query->subject, $email_body);
        }

        function subscription_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 13))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 13))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

			 $for_admin_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/><p>A member is registerd with platinum pacakage. Member name is ".$name."</p>";

            $send_mail = $this->do_email($from, $from_name, "matchmadeadmi@gmail.com", "Registered & Activated Platinum Member",$for_admin_body);
			
            return $send_mail;
        }

        function bronze_activation_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 14))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 14))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

            return $send_mail;
        }

        function downgrade_to_bronze_due_to_nonPayment_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 12))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 12))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

            return $send_mail;
        }

        function incomplete_profile_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 8))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 8))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
            
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

            return $send_mail;
        }

        function subscription_suspended_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $from;
            
            $email_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/><br/> Dear ".$name ." You subscription has been suspended";
            
            $send_mail = $this->do_email($from, $from_name, $email, "Subscription Suspended", $email_body);            

            return $send_mail;
        }
		//added shvou
		function paypal_payment_success($title , $email , $amount,$duration,$by,$id ){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 30 ))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 30 ))->row()->body;

            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[business_name]]', $title, $email_body);
            $email_body = str_replace('[[duration]]', $duration, $email_body);
            $email_body = str_replace('[[amount]]', $amount, $email_body);
            $email_body = str_replace('[[by]]', $by, $email_body);
            $email_body = str_replace('[[id]]', $id, $email_body);
			//echo $email_body."<br>";
			$email = "customers@matchmadeinjannah.com";
            //$send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);
			$send_mail ="";
            return $send_mail;
        }
		
		 function advertisement_invoice_email($advertisements_id,$invoice_id){
            // echo $advertisements_id;
            // echo $invoice_id;

            $this->db->from('advertisements');
			$this->db->join('advertisements_payment', 'advertisements.advertisements_id = advertisements_payment.advertisement_id');
			$this->db->where('advertisements_id',	
							 $advertisements_id);
			$this->db->limit(1);
			$this->db->order_by('advertisements_id','desc');
			$variable = $this->db->get()->result();	
	   

            $this->db->where('subject','Advertisement Invoice');
	        $email_body=$this->db->get('email_template')->row();
			
            $change=["[[base_url]]","{name}","{invoice_number}","{bus_name}","{address}","{email}","{phone}","{package}","{payment_type}","{date}"];
            $change_to = [base_url(),$variable[0]->adviser_name,$invoice_id,$variable[0]->title,$variable[0]->address,$variable[0]->ads_email,$variable[0]->ads_phone,$variable[0]->duration,$variable[0]->payment_by,date('m-d-Y',strtotime($variable[0]->payment_date))];
			 
            $final_email_body=str_replace($change,$change_to,$email_body->body);

            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
	        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
		
	
            if ($protocol == 'smtp') {
                 $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }
            $sub=$email_body->subject; 
            $send_mail =$this->Email_model->do_email($from, $from_name, $variable[0]->ads_email, $sub, $final_email_body);
        }

		   function advertisement_invoice_email_to_admin($advertisements_id,$invoice_id)
        {

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $to = $from;
           
            //please unblock the account from admin panel to allow the user to use his account
            $email_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/>                  <br/>Advertisement payment for Match Made In Jannah, invoice #".$invoice_id." was successful.";

            $send_mail = $this->do_email($from, $from_name, "matchmadeadmi@gmail.com", "Advertisement Invoice", $email_body);
           
            //$send_mail = $this->do_email($from, $from_name, "contact@aminmotiwala.com", "New User Registration", $email_body);
            

            return $send_mail;
        }

        function photo_submission_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 15))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 15))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);
			$for_admin_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/><p>".$name." has upload a new Photo, please check... </p>";
            $send_mail = $this->do_email($from, $from_name, "customers@matchmadeinjannah.com", "New Photo Uploaded",$for_admin_body);
			//echo $send_mail;customers@matchmadeinjannah.com
            $send_mail = $this->do_email($from, $from_name, "matchmadeadmi@gmail.com", "New Photo Uploaded", $for_admin_body); 

            return $send_mail;
        }

        function video_submission_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 16))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 16))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);
            $send_mail = $this->do_email($from, $from_name, "customers@matchmadeinjannah.com", "New Video Uploaded", $email_body);
            $send_mail = $this->do_email($from, $from_name, "contact@aminmotiwala.com", "New Video Uploaded", $email_body); 

            return $send_mail;
        }

        function photo_approval_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 17))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 17))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

            return $send_mail;
        }

        function video_approval_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 18))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 18))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

            return $send_mail;
        }

        function photo_rejection_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 19))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 19))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

            return $send_mail;
        }

        function video_rejection_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 20))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 20))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

            return $send_mail;
        }

        function payment_failure_notification($email = '', $name = '') {
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 21))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 21))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
                        
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);            

            return $send_mail;
        }

        function advertisement_approval_notification($id = '', $email = '',$title='',$address='',$unique_id='',$duration="" ,$amount="", $start_date="", $end_date="",$register=""){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 22))->row()->subject;
			$adviser_name = $this->db->where('advertisements_id', $id)->get('advertisements')->row('adviser_name');
            $email_body = $this->db->get_where('email_template', array('email_template_id' => 22))->row()->body;
            $email_body = str_replace('[[name]]', $adviser_name, $email_body);
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $id, $email_body);
            $email_body = str_replace('[[title]]', $title, $email_body);
            $email_body = str_replace('[[address]]', $address, $email_body);
            $email_body = str_replace('[[unique_id]]', $unique_id, $email_body);
            $email_body = str_replace('[[DURATION]]', $duration, $email_body);
            $email_body = str_replace('[[AMOUNT]]', $amount, $email_body);
            $email_body = str_replace('[[APPROVED]]', $start_date, $email_body);
            $email_body = str_replace('[[DISPLAY]]', $start_date ." "."to"." ".$end_date, $email_body);
			$style = "style='border:1px solid'";
			$email_body = str_replace('[[REGISTER]]' ,$register, $email_body);
            echo $from;echo "<br>";
            echo $email;  ;echo "<br>";
            echo $sub;  ;echo "<br>";
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }

        function advertisement_send_url_notification($url = '', $email = '',$title='',$address='',$duration="" ,$amount="", $start_date="", $end_date=""){
			
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 24))->row()->subject;
			
            $adviser_name = $this->db->where('unique_id', $url)->get('advertisements')->row('adviser_name');
			$business_name = $this->db->where('unique_id', $url)->get('advertisements')->row('title');
			
            $email_body = $this->db->get_where('email_template', array('email_template_id' => 24))->row()->body;
            $email_body = str_replace('[[name]]', $adviser_name, $email_body);
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[id]]', $url, $email_body);
            $email_body = str_replace('[[title]]', $business_name, $email_body);
            $email_body = str_replace('[[address]]', $address, $email_body);
            $email_body = str_replace('[[email]]', $email, $email_body);
            $email_body = str_replace('[[DURATION]]', $duration, $email_body);
            $email_body = str_replace('[[AMOUNT]]', $amount, $email_body);
            $email_body = str_replace('[[APPROVED]]', $start_date, $email_body);
            $email_body = str_replace('[[DISPLAY]]', $start_date ."-".$end_date, $email_body);
           
			//echo '<pre>';
			//print_r($email_body);die();
            $send_mail = $this->do_email_ads($from, $from_name, $email,$adviser_name, $sub, $email_body);

            return $send_mail;
        }



        function advertisement_send_expired_notification($end_date = '', $email = '',$title=''){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 28))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 28))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[title]]', $title, $email_body);
            $email_body = str_replace('[[end_date]]', $end_date, $email_body);
            $email_body = str_replace('[[email]]', $email, $email_body);
            echo $email;  ;echo "<br>";
            echo $sub;  ;echo "<br>";
            echo $email_body;  ;echo "<br>";
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }

        function advertisement_reject_notification($id = '', $email = '',$title='',$address='',$unique_id=''){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 23))->row()->subject;
			$amount = $this->db->where('advertisement_id', $id)->order_by('ads_payment_id','desc')->limit(1)->get('advertisements_payment')->row('amount');
			$adviser_name = $this->db->where('advertisements_id', $id)->get('advertisements')->row('adviser_name');
			
            $email_body = $this->db->get_where('email_template', array('email_template_id' => 23))->row()->body;
            $email_body = str_replace('[[name]]', $adviser_name, $email_body);
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $id, $email_body);
            $email_body = str_replace('[[AMOUNT]]', $amount, $email_body);
            $email_body = str_replace('[[title]]', $title, $email_body);
            $email_body = str_replace('[[address]]', $address, $email_body);
            $email_body = str_replace('[[unique_id]]', $unique_id, $email_body);
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }
        function cover_pic_approval_notification($first_name , $last_name , $email , $plan_name , $id , $start_date , $end_date , $payment_date , $plan_id,$week,$display,$amount ){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }
            $sub = $this->db->get_where('email_template', array('email_template_id' => 26 ))->row()->subject;
            $email_body = $this->db->get_where('email_template', array('email_template_id' => 26 ))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $first_name , $email_body);
            $email_body = str_replace('[[ID]]', $plan_id , $email_body);
            $email_body = str_replace('[[WEEK]]', $week , $email_body);
            $email_body = str_replace('[[DISPLAY]]', $display , $email_body);
            $email_body = str_replace('[[AMOUNT]]', $amount , $email_body);
            $email_body = str_replace('[[PACKAGE]]', $plan_name , $email_body);
            $email_body = str_replace('[[PHOTO SHOWING]]', date("d-m-Y" , strtotime($start_date) )." - ".date("d-m-Y" , strtotime($end_date) ) , $email_body);
            $email_body = str_replace('[[PAID]]', date("d-m-Y" , strtotime($payment_date) ) , $email_body);
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);
            return $send_mail;
        }

        function cover_pic_send_notification( $name , $email ){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 27 ))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 27 ))->row()->body;

            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
			
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }

        function cover_pic_payment_notification( $name , $email , $plan_id ){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 25 ))->row()->subject;
            $plan_name = $this->db->get_where('cover_pic_plan', array('plan_id' => $plan_id ))->row()->name;
            $email_body = $this->db->get_where('email_template', array('email_template_id' => 25 ))->row()->body;

            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
            $email_body = str_replace('[[ Cover_pic_package ]]', $plan_name, $email_body);
			//echo $from;echo "<br>";
            //echo $email;  echo "<br>";
            //echo $email_body;  echo "<br>";
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }
        
        
        
        function send_blank_email($email ='',$name ='',$subject ='',$body =''){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $subject;
            $email_body = $body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
            echo $email;  echo "<br>";
            echo $sub;  echo "<br>";
            echo $email_body;  echo "<br>";
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);
            return $send_mail;
        }

        function CoverPic_approval_reject_mail($email,$name){
            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' =>31 ))->row()->subject;
            $email_body = $this->db->get_where('email_template', array('email_template_id' => 31))->row()->body;

            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $name, $email_body);
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);
            return $send_mail;
        }
		
		
        function advertisement_notification_to_admin($email='',$name='')
        {
        
                $this->load->database();
                $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
                if ($protocol == 'smtp') {
                    $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                } else if ($protocol == 'mail') {
                    $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
                }
    
                $to = $from;
               
                //please unblock the account from admin panel to allow the user to use his account
    			$email_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/>                  <br/> Advertisement has been created with name ".$name ." and email ".$email.".";

    			$send_mail = $this->do_email($from, $from_name, "matchmadeadmi@gmail.com", "New Advertisement Create", $email_body);
               
    			//$send_mail = $this->do_email($from, $from_name, "contact@aminmotiwala.com", "New User Registration", $email_body);
    			

    			return $send_mail;
        }


    }
    