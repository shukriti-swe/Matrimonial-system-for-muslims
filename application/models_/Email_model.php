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
                
                //please unblock the account from admin panel to allow the user to use his account
    			$email_body = "<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/><br/> A new user has been registered with name ".$name ." and email ".$email.".";
    			
    			$send_mail = $this->do_email($from, $from_name, "customers@matchmadeinjannah.com", "New User Registration", $email_body);
    			//$send_mail = $this->do_email($from, $from_name, "contact@aminmotiwala.com", "New User Registration", $email_body);
    			

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
                    $to_name = $query->row()->first_name . ' ' . $query->row()->last_name;
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
            
            $this->load->library('email');

            if($to == ''){
                echo 'Email receiver address is required';exit;
               // return false;
            }
			$this->email->initialize();
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            $this->email->from($from, $from_name);
            $this->email->to($to);
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
            $send_mail = $this->do_email($from, $from_name, "customers@matchmadeinjannah.com", "New Photo Uploaded", $email_body);
            $send_mail = $this->do_email($from, $from_name, "contact@aminmotiwala.com", "New Photo Uploaded", $email_body); 

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

        function advertisement_approval_notification($id = '', $email = ''){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 22))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 22))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $id, $email_body);
            echo $from;echo "<br>";
            echo $email;  ;echo "<br>";
            echo $sub;  ;echo "<br>";
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }

        function advertisement_send_url_notification($url = '', $email = ''){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 24))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 24))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[id]]', $url, $email_body);
            echo $email;  ;echo "<br>";
            echo $sub;  ;echo "<br>";
            echo $email_body;  ;echo "<br>";
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }

        function advertisement_reject_notification($id = '', $email = ''){

            $this->load->database();
            $from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
            $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
            if ($protocol == 'smtp') {
                $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

            $sub = $this->db->get_where('email_template', array('email_template_id' => 23))->row()->subject;

            $email_body = $this->db->get_where('email_template', array('email_template_id' => 23))->row()->body;
            $email_body = str_replace('[[base_url]]', base_url(), $email_body);
            $email_body = str_replace('[[to]]', $id, $email_body);
            echo $from;echo "<br>";
            echo $email;  ;echo "<br>";
            echo $sub;  ;echo "<br>";
            echo $email_body;  ;echo "<br>";
            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }


        function cover_pic_approval_notification($first_name , $last_name , $email , $plan_name , $id , $start_date , $end_date , $payment_date , $plan_id ){

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
            $email_body = str_replace('[[to]]', $first_name." ".$last_name , $email_body);
            $email_body = str_replace('[[ID]]', $plan_id , $email_body);

            $email_body = str_replace('[[PACKAGE]]', $plan_name , $email_body);
            $email_body = str_replace('[[PHOTO SHOWING]]', date("F d" , strtotime($start_date) )." - ".date("F d ,Y" , strtotime($end_date) ) , $email_body);
            $email_body = str_replace('[[PAID]]', date("F d ,Y" , strtotime($payment_date) ) , $email_body);

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

            $send_mail = $this->do_email($from, $from_name, $email, $sub, $email_body);

            return $send_mail;
        }


    }
    