<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

        /*	
	 *	Developed by: Active IT zone
	 *	Date	: 18 September, 2017
	 *	Active Matrimony CMS
	 *	http://codecanyon.net/user/activeitezone
	 */

        function __construct()
        {
                parent::__construct();
                $this->system_name = $this->Crud_model->get_type_name_by_id('general_settings', '1', 'value');
                $this->system_email = $this->Crud_model->get_type_name_by_id('general_settings', '2', 'value');
                $this->system_title = $this->Crud_model->get_type_name_by_id('general_settings', '3', 'value');

                $result1 = $this->db->where('is_approved',2)->count_all_results('gallery_items');
                $result2 = $this->db->where('is_profile_img_approved',2)->count_all_results('member');
                $result = $result1 + $result2;
                define('APPROVAL_COUNT', $result);
                
                $new_member_count = $this->db->where('status',1)->count_all_results('count_new_member');
                define('MEMBER_COUNT', $new_member_count);

        }

        public function index()
        {
			
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "dashboard.php";
                        $page_data['folder'] = "dashboard";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "dashboard.php";
                        $page_data['page_name'] = "dashboard";
                        $page_data['total_members'] = $this->db->get_where('member', array("is_deleted = " => 0))->num_rows();
                        $page_data['total_bronze_members'] = $this->db->get_where('member', array('membership' => 1, "is_deleted = " => 0))->num_rows();
                        $page_data['total_premium_members'] = $this->db->get_where('member', array('membership' => 2, "is_deleted = " => 0))->num_rows();
                        $page_data['total_free_members'] = $this->db->get_where('member', array('membership' => 3, "is_deleted = " => 0))->num_rows();
                        $page_data['total_fake_members'] = $this->db->get_where('member', array('membership' => 4, "is_deleted = " => 0))->num_rows();
                        $page_data['total_earnings'] = $this->db->select_sum('amount')->get('earning')->row()->amount;

                        $last_month_timestamp = date('Y-m-d H:i:s', strtotime("-1 months"));
                        $page_data['last_month_earnings'] = $this->db->select_sum('amount')->get_where('earning', array('payment_process_date >=' => $last_month_timestamp))->row()->amount;

                        $last_3_months_timestamp = date('Y-m-d H:i:s', strtotime("-3 months"));
                        $page_data['last_3_months_earnings'] = $this->db->select_sum('amount')->get_where('earning', array('payment_process_date >=' => $last_3_months_timestamp))->row()->amount;

                        $half_yearly_timestamp = date('Y-m-d H:i:s', strtotime("-6 months"));
                        $page_data['half_yearly_earnings'] = $this->db->select_sum('amount')->get_where('earning', array('payment_process_date >=' => $half_yearly_timestamp))->row()->amount;

                        $last_year_timestamp = date('Y-m-d H:i:s', strtotime("-12 months"));
                        $page_data['yearly_earnings'] = $this->db->select_sum('amount')->get_where('earning', array('payment_process_date >=' => $last_year_timestamp))->row()->amount;

                        //get advertisement earning reports

                        $page_data['total_ads_earnings'] = $this->db->select_sum('amount')->get('advertisements_payment')->row()->amount;
                        $ads_last_month_timestamp = date('Y-m-d H:i:s', strtotime("-1 months"));
                        $page_data['ads_last_month_earnings'] = $this->db->select_sum('amount')->get_where('advertisements_payment', array('payment_date >=' => $ads_last_month_timestamp))->row()->amount;

                        $ads_last_3_months_timestamp = date('Y-m-d H:i:s', strtotime("-3 months"));
                        $page_data['ads_last_3_months_earnings'] = $this->db->select_sum('amount')->get_where('advertisements_payment', array('payment_date >=' => $ads_last_3_months_timestamp))->row()->amount;

                        $ads_half_yearly_timestamp = date('Y-m-d H:i:s', strtotime("-6 months"));
                        $page_data['ads_half_yearly_earnings'] = $this->db->select_sum('amount')->get_where('advertisements_payment', array('payment_date >=' => $ads_half_yearly_timestamp))->row()->amount;

                        $ads_last_year_timestamp = date('Y-m-d H:i:s', strtotime("-12 months"));
                        $page_data['ads_yearly_earnings'] = $this->db->select_sum('amount')->get_where('advertisements_payment', array('payment_date >=' => $ads_last_year_timestamp))->row()->amount;


                        //get advertisement earning reports

                        $page_data['total_coverPic_earnings'] = $this->db->select_sum('amount')->get('cover_pic_payment')->row()->amount;
                        $coverPic_last_month_timestamp = date('Y-m-d H:i:s', strtotime("-1 months"));
                        $page_data['coverPic_last_month_earnings'] = $this->db->select_sum('amount')->get_where('cover_pic_payment', array('payment_date >=' => $coverPic_last_month_timestamp))->row()->amount;

                        $coverPic_last_3_months_timestamp = date('Y-m-d H:i:s', strtotime("-3 months"));
                        $page_data['coverPic_last_3_months_earnings'] = $this->db->select_sum('amount')->get_where('cover_pic_payment', array('payment_date >=' => $coverPic_last_3_months_timestamp))->row()->amount;

                        $coverPic_half_yearly_timestamp = date('Y-m-d H:i:s', strtotime("-6 months"));
                        $page_data['coverPic_half_yearly_earnings'] = $this->db->select_sum('amount')->get_where('cover_pic_payment', array('payment_date >=' => $coverPic_half_yearly_timestamp))->row()->amount;

                        $coverPic_last_year_timestamp = date('Y-m-d H:i:s', strtotime("-12 months"));
                        $page_data['coverPic_yearly_earnings'] = $this->db->select_sum('amount')->get_where('cover_pic_payment', array('payment_date >=' => $ads_last_year_timestamp))->row()->amount;




                        $page_data['total_stories'] = $this->db->get('happy_story')->num_rows();
                        $page_data['approved_stories'] = $this->db->get_where('happy_story', array('approval_status' => 1))->num_rows();
                        $page_data['pending_stories'] = $this->db->get_where('happy_story', array('approval_status' => 0))->num_rows();


                        $this->load->view('back/index', $page_data);
                }
        }

        function admin_permission()
        {
                $admin_id = $this->session->userdata('admin_id');
                if ($admin_id == NULL) {
                        return FALSE;
                } else {
                        return TRUE;
                }
        }
        function admins($para1 = '', $para2 = '')
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title']         = "Admin || " . $this->system_title;

                        if ($para1 == '') {
                                $page_data['top']                 = "member_configure/index.php";
                                $page_data['folder']         = "admin";
                                $page_data['file']                 = "index.php";
                                $page_data['bottom']         = "member_configure/index.php";
                                $this->db->where_not_in('admin_id', 1);
                                $page_data['all_admins'] = $this->db->get("admin")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "admin";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_admin") {
                                $page_data['top']                 = "members/index.php";
                                $page_data['folder']         = "admin";
                                $page_data['file']                 = "add_admin.php";
                                $page_data['bottom']         = "members/index.php";
                                $page_data['page_name'] = "admin";
                                if ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                }

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "edit_admin") {
                                $page_data['top']                 = "members/index.php";
                                $page_data['folder']         = "admin";
                                $page_data['file']                 = "edit_admin.php";
                                $page_data['bottom']         = "members/index.php";
                                $page_data['page_name'] = "admin";

                                $page_data['admin_data'] = $this->db->get_where('admin', array(
                                        'admin_id' => $para2
                                ))->result_array();

                                if ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                }

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'Name', 'required');
                                $this->form_validation->set_rules('email', 'Email', 'required');
                                $this->form_validation->set_rules('phone', 'Phone No.', 'required');
                                $this->form_validation->set_rules('role', 'role', 'required');


                                if ($this->form_validation->run() == FALSE) {
                                        $page_data['top']                 = "members/index.php";
                                        $page_data['folder']         = "admin";
                                        $page_data['file']                 = "add_admin.php";
                                        $page_data['bottom']         = "members/index.php";
                                        $page_data['page_name'] = "admin";

                                        $page_data['form_contents'] = $this->input->post();

                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");

                                        $this->load->view('back/index', $page_data);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $data['email'] = $this->input->post('email');
                                        $data['phone'] = $this->input->post('phone');
                                        $data['address'] = $this->input->post('address');
                                        $password = substr(hash('sha512', rand()), 0, 7);
                                        $data['password'] = sha1($password);
                                        $data['role'] = $this->input->post('role');
                                        $data['timestamp'] = time();
                                        $result = $this->db->insert('admin', $data);

                                        $this->Email_model->account_opening('admin', $data['email'], $password);

                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                                redirect(base_url() . 'admin/admins', 'refresh');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                                redirect(base_url() . 'admin/admins', 'refresh');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'Name', 'required');
                                $this->form_validation->set_rules('email', 'Email', 'required');
                                $this->form_validation->set_rules('phone', 'Phone No.', 'required');
                                $this->form_validation->set_rules('role', 'role', 'required');


                                if ($this->form_validation->run() == FALSE) {
                                        $page_data['top']                 = "members/index.php";
                                        $page_data['folder']         = "admin";
                                        $page_data['file']                 = "edit_admin.php";
                                        $page_data['bottom']         = "members/index.php";
                                        $page_data['page_name'] = "admin";

                                        $page_data['form_contents'] = $this->input->post();

                                        $page_data['admin_data'] = $this->db->get_where('admin', array(
                                                'admin_id' => $para2
                                        ))->result_array();

                                        $page_data['danger_alert'] = translate("failed_to_update_the_data!");

                                        $this->load->view('back/index', $page_data);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $data['email'] = $this->input->post('email');
                                        $data['phone'] = $this->input->post('phone');
                                        $data['address'] = $this->input->post('address');

                                        $data['role'] = $this->input->post('role');
                                        $data['timestamp'] = time();
                                        $this->db->where('admin_id', $para2);
                                        $result = $this->db->update('admin', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                                redirect(base_url() . 'admin/admins', 'refresh');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                                redirect(base_url() . 'admin/admins', 'refresh');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('admin_id', $para2);
                                $result = $this->db->delete('admin');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function role($para1 = '', $para2 = '')
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title']         = "Admin || " . $this->system_title;

                        if ($para1 == '') {
                                $page_data['top']                 = "member_configure/index.php";
                                $page_data['folder']         = "role";
                                $page_data['file']                 = "index.php";
                                $page_data['bottom']         = "member_configure/index.php";
                                $page_data['all_roles'] = $this->db->get("role")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "role";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_role") {
                                $page_data['top']                 = "members/index.php";
                                $page_data['folder']         = "role";
                                $page_data['file']                 = "add_role.php";
                                $page_data['bottom']         = "members/index.php";
                                $page_data['page_name'] = "role";
                                $page_data['all_permissions'] = $this->db->get('permission')->result_array();

                                if ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                }

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "edit_role") {
                                $page_data['top']                 = "members/index.php";
                                $page_data['folder']         = "role";
                                $page_data['file']                 = "edit_role.php";
                                $page_data['bottom']         = "members/index.php";
                                $page_data['page_name'] = "role";
                                $page_data['all_permissions'] = $this->db->get('permission')->result_array();
                                $page_data['role_data'] = $this->db->get_where('role', array('role_id' => $para2))->result_array();

                                if ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                }

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'Role Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $page_data['top']                 = "members/index.php";
                                        $page_data['folder']         = "role";
                                        $page_data['file']                 = "add_role.php";
                                        $page_data['bottom']         = "members/index.php";
                                        $page_data['page_name'] = "role";
                                        $page_data['all_permissions'] = $this->db->get('permission')->result_array();

                                        $page_data['form_contents'] = $this->input->post();
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");

                                        $this->load->view('back/index', $page_data);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $data['permission'] = json_encode($this->input->post('permission'));
                                        $data['description'] = $this->input->post('description');
                                        $result = $this->db->insert('role', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                                redirect(base_url() . 'admin/role', 'refresh');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                                redirect(base_url() . 'admin/role', 'refresh');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'Role Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $page_data['top']                 = "members/index.php";
                                        $page_data['folder']         = "role";
                                        $page_data['file']                 = "edit_role.php";
                                        $page_data['bottom']         = "members/index.php";
                                        $page_data['page_name'] = "role";
                                        $page_data['all_permissions'] = $this->db->get('permission')->result_array();
                                        $page_data['role_data'] = $this->db->get_where('role', array('role_id' => $para2))->result_array();

                                        $page_data['form_contents'] = $this->input->post();
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");

                                        $this->load->view('back/index', $page_data);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $data['permission'] = json_encode($this->input->post('permission'));
                                        $data['description'] = $this->input->post('description');

                                        $this->db->where('role_id', $para2);
                                        $this->db->update('role', $data);
                                        recache();

                                        $this->session->set_flashdata('alert', 'edit');
                                        redirect(base_url() . 'admin/role', 'refresh');
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('role_id', $para2);
                                $result = $this->db->delete('role');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function members($para1 = "", $para2 = "", $para3 = "", $para4 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($this->session->flashdata('alert') == "block") {
                                $page_data['danger_alert'] = translate("you_have_successfully_blocked_this_member!");
                        } elseif ($this->session->flashdata('alert') == "unblock") {
                                $page_data['success_alert'] = translate("you_have_successfully_unlocked_this_member!");
                        } elseif ($this->session->flashdata('alert') == "delete") {
                                $page_data['success_alert'] = translate("you_have_successfully_deleted_this_member!");
                        } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                $page_data['danger_alert'] = translate("failed_to_delete_this_member!");
                        }
                        if ($para2 == "list_data") {
                                if ($para1 == "bronze_members") {
                                        $columns = array(
                                                0 => '',
                                                1 => 'display_member',
                                                2 => 'first_name',
                                                3 => 'follower',
                                                4 => 'member_since',
                                                5 => 'email',
                                                6 => 'password',
                                                7 => 'member_id',
                                                //5 => 'is_deleted',
                                        );
                                } elseif ($para1 == "platinum_members" || $para1 == "all_members" ||$para1 == "free_members" || $para1 == "fake_members" ||$para1 == "incomplete_profiles") {
                                        $columns = array(
                                                0 => '',
                                                1 => 'display_member',
                                                2 => 'first_name',
                                                3 => 'follower',
                                                4 => 'member_since',
                                                5 => 'email',
                                                6 => 'password',
                                                7 => 'member_id',
                                                //5 => 'is_deleted',
                                        );
                                }

                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];

                                if ($para1 == "bronze_members") {
                                        $member_type = 1;
                                } 
                                elseif ($para1 == "platinum_members") {
                                        $member_type = 2;
                                }
                                elseif ($para1 == "all_members") {
                                        $member_type = "all";
                                }

                                elseif ($para1 == "free_members") {
                                        $member_type = 3;
                                }

                                elseif ($para1 == "fake_members") {
                                        $member_type = 4;
                                }

                                elseif ($para1 == "incomplete_profiles") {
                                        $member_type = "incomplete";
                                }
							
								//echo $member_type;die;

                                $totalData = $this->Crud_model->allmembers_count($member_type);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {

                                        $members = $this->Crud_model->allmembers($member_type, $limit, $start, $order, $dir);
                                        // echo $this->db->last_query();
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $members =  $this->Crud_model->members_search($member_type, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->members_search_count($member_type, $search);
                                }

                                $data = array();
                                if (!empty($members)) {
                                        foreach ($members as $key => $member) {
                                                $profile_image = $member->profile_image;
                                                if(!empty($member->profile_image) && $member->is_profile_img_approved == 1){
                                                    if (file_exists('uploads/profile_image/'.$member->member_id . "/" . $profile_image)) {
                                                        $member_image = "<img src='" . base_url() . "uploads/profile_image/" .$member->member_id . "/" . $profile_image ."?".rand(999,99999999). "' class='img-sm'>";
                                                    }
                                                    else
                                                    {
                                                        $member_image = "<img src='" . base_url() . "uploads/profile_image/default.jpg' class='img-sm'>";
                                                    }
                                                }
                                                else
                                                {
                                                    $member_image = "<img src='" . base_url() . "uploads/profile_image/default.jpg' class='img-sm'>";
                                                }

                                                if ($member->is_blocked == "yes") {
                                                        $block_button = "<button data-target='#block_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('unblock') . "' onclick='block(\"" . $member->is_blocked . "\", " . $member->member_id . ")'><i class='fa fa-check'></i></button>";
                                                } elseif ($member->is_blocked == "no") {
                                                        $block_button = "<button data-target='#block_modal' data-toggle='modal' class='btn btn-dark btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('block') . "' onclick='block(\"" . $member->is_blocked . "\", " . $member->member_id . ")'><i class='fa fa-ban'></i></button>";
                                                }
                                                if ($member->is_closed == "yes") {
                                                        $acnt_status_button = "<center><span class='badge badge-danger' style='width:60px'>" . translate('closed') . "</span></center>";
                                                } elseif ($member->is_closed == "no") {
                                                        $acnt_status_button = "<center><span class='badge badge-success' style='width:60px'>" . translate('Active') . "</span></center>";
                                                }
                                                $switch_button = "<button data-target='#switch_modal' data-toggle='modal' class='btn btn-success btn-sm add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('switch_member') . "' onclick='switchMember(" . $member->member_id . ")'><i class='fa fa-exchange'></i></button>";
                                                $message_button = "<button data-target='#fakeMessageModal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('set_messages') . "' onclick='fakeMessage(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>";

                                                $no_pic_email_member = $this->Crud_model->get_email_member($member->member_id, 2);
                                                $incomplete_profile_email_member = $this->Crud_model->get_email_member($member->member_id, 3);
                                                $both_no_email_member = $this->Crud_model->get_email_member($member->member_id, 4);

                                                $nestedData['image'] = $member_image;
                                                
												if ($member_type == 4) {
                                                  $blank_email = "";
                                                }else{
                                                 $blank_email = "<button data-target='#blank_email_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='Send Email' onclick='blank_email(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>";     
                                                }
                                                //$nestedData['name'] = "<span style='color:black;'>" . $member->first_name . ' ' . $member->last_name . "</span><br/>".$blank_email;
                                                 if ($member->highlight_new_member == 1) {

                                                $nestedData['name'] = "<div style='color:black; background:lightblue;'>" . $member->first_name . ' ' . $member->last_name . "</div><br/>".$blank_email;
                                                        
                                                }else{
                                                $nestedData['name'] = "<div style='color:black;'>" . $member->first_name . ' ' . $member->last_name . "</div><br/>".$blank_email;

                                                }
                                                $membership = $this->Crud_model->get_type_name_by_id('member', $member->member_id, 'membership');

                                                //$nestedData['member_id'] = "<span style='color:black;'>" . $member->display_member . "</span>";
                                                if ($member->highlight_new_member == 1) {
                                                         $nestedData['member_id'] = "<div style='color:black;background:lightblue'>" . $member->display_member . "</div>";
                                                }else{
                                                        $nestedData['member_id'] = "<div style='color:black;'>" . $member->display_member . "</div>";
                                                }
                                                //added
                                                $nestedData['main_member_id'] = "<span style='color:black;'>" . $member->member_id . "</span>";
                                                $nestedData['follower'] = $member->follower;
                                                // if ($para1 == "platinum_members") {
                                                //         $package_info = $this->db->get_where('member', array('member_id' => $member->member_id))->row()->membership;
                                                //         if ($package_info == 2) {
                                                //               $nestedData['package'] = "Platinum";
                                                //         }
                                                // }
                                                $nestedData['registered'] = "<span style='color:black;'>" . date('m/d/Y', strtotime($member->member_since)) . "</span>";
                                                $nestedData['email'] = "<span style='color:black;'>" . $member->email . "</span>";
                                                $nestedData['password'] = "<span style='color:black;'>" . $member->plain_password . "</span>";

                                                $nestedData['options'] = $message_button = $para1 == "fake_members" ? $message_button : '';
                                                $nestedData['switch'] = "<select class='form-control' id='switchPackageTo_".$member->member_id."'>
                                                                                <option value='1'>Bronze</option>
                                                                                <option value='3'>Free</option>
                                                                                <option value='4'>Fake</option>
                                                                                <option value='disabled'>Disabled</option>
                                                                                <option value='deleted'>Delete</option>
                                                                        </select>" . $switch_button;
                                                // $nestedData['last_login'] = "<span style='color:black;'>" . date('M/d/Y H:i:s a', $member->isOnlineTimezone) . "</span>";
                                                $nestedData['last_login'] = "<span class='timezone".$key."'>" .$member->isOnlineTimezone."</span><script type='text/javascript'>dateFunc('".$member->isOnlineTimezone. "', ".$key.");</script>";

                            //$nestedData['is_deleted'] = '<span>'.$member->is_deleted.'</span>';
                                                if ($para1 != "fake_members") {
                                                    if ($no_pic_email_member != '') {
                                                                $newDate = date("m-Y", strtotime($no_pic_email_member));
                                                            $nestedData['no_pic_email_member'] = "<button style='height: 48px;width: 48px;' data-target='#no_pic_mail_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='Send No Pic Email' onclick='send_no_pic_email(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>" . "<span style='color:black;'>" . $newDate . "</span>";
                                                    } else {
                                                            $nestedData['no_pic_email_member'] = "<button style='height: 48px;width: 48px;' data-target='#no_pic_mail_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='Send No Pic Email' onclick='send_no_pic_email(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>";
                                                    }
                                                }
                                                if ($para1 == "fake_members") {
                                                        $conversationCount = $this->db->query("SELECT COUNT(message_thread_id) AS messageCount FROM
                                                                  message_thread WHERE message_to_seen = '' AND message_thread_to = $member->member_id")->result_array();
                                                        $nestedData['respond_to'] = $conversationCount[0]['messageCount'];
                                                }
                                                // if ($incomplete_profile_email_member != '') {
                                                //         $newDate = date("m-Y", strtotime($incomplete_profile_email_member));
                                                //         $nestedData['incomplete_profile_email_member'] = "<button style='height: 48px;width: 48px;' data-target='#incomplete_profile_mail_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='Send Incomplete Profile Email' onclick='send_incomplete_profile_email(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>" . "<span style='color:black;'>" . $newDate . "</span>";
                                                // } else {
                                                //         $nestedData['incomplete_profile_email_member'] = "<button style='height: 48px;width: 48px;' data-target='#incomplete_profile_mail_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='Send Incomplete Profile Email' onclick='send_incomplete_profile_email(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>";
                                                // }


                                                // if ($both_no_email_member != '') {
                                                //         $newDate = date("m-Y", strtotime($both_no_email_member));
                                                //         $nestedData['both_no_email_member'] = "<button style='height: 48px;width: 48px;' data-target='#both_no_mail_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='Send No Pic, Incomplete Profile Email' onclick='send_both_no_email(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>" . "<span style='color:black;'>" . $newDate . "</span>";
                                                // } else {
                                                //         $nestedData['both_no_email_member'] = "<button style='height: 48px;width: 48px;' data-target='#both_no_mail_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='Send No Pic, Incomplete Profile Email' onclick='send_both_no_email(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>";
                                                // }

                                                $data[] = $nestedData;
                                                // if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                /*echo '<pre>';
                                 print_r($json_data);exit;*/
                                echo json_encode($json_data);
                                if ($para1 == "all_members") {
                                    $this->db->where('highlight_new_member',1)->update('member',['highlight_new_member'=> 0]);
                                }elseif ($para1 == "bronze_members") {
                                   $this->db->where('highlight_new_member',1)->where('membership',1)->where('isProfileCompleted',1)->update('member',['highlight_new_member'=> 0]);    
                                }elseif ($para1 == "free_members") {
                                   $this->db->where('highlight_new_member',1)->where('membership',3)->where('isProfileCompleted',1)->update('member',['highlight_new_member'=> 0]);    
                                       
                                }elseif ($para1 == "fake_members") {
                                   $this->db->where('highlight_new_member',1)->where('membership',4)->where('isProfileCompleted',1)->update('member',['highlight_new_member'=> 0]);    
                                       
                                }elseif ($para1 == "incomplete_profiles") {
                                   $this->db->where('highlight_new_member',1)->where('isProfileCompleted',0)->update('member',['highlight_new_member'=> 0]);    
                                       
                                }
                                
                        } 
                        elseif ($para1 == "bronze_members") {
                                if ($para2 == "") {
                                        $page_data['top'] = "members/index.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "index.php";
                                        $page_data['bottom'] = "members/index.php";
                                        $page_data['get_bronze_members'] = $this->db->get_where("member", array("membership" => 1, "is_deleted = " => 0))->result();
                                        // echo "<pre>";
                                        // print_r($page_data['get_free_members']);exit;
                                        // echo $this->db->last_query(); exit;
                                        if ($this->session->flashdata('alert') == "edit") {
                                                $page_data['success_alert'] = translate("you_have_successfully_edited_the_profile!");
                                        } elseif ($this->session->flashdata('alert') == "upgrade") {
                                                $page_data['success_alert'] = translate("you_have_successfully_upgraded_the_member_package!");
                                        }
                                } elseif ($para2 == "view_member") {
                                        $page_data['top'] = "members/members.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "view_member.php";
                                        $page_data['bottom'] = "members/members.php";
                                        $page_data['get_free_member_by_id'] = $this->db->get_where("member", array("membership" => 1, "member_id" => $para3))->result();
                                } elseif ($para2 == "edit_member") {
                                        $page_data['top']                 = "members/members.php";
                                        $page_data['folder']         = "members";
                                        $page_data['file']                 = "edit_member.php";
                                        $page_data['bottom']         = "members/members.php";
                                        $page_data['get_free_member_by_id'] = $this->db->get_where("member", array("membership" => 1, "member_id" => $para3))->result();
                                }
                                $page_data['member_type'] = "Bronze";
                                $page_data['parameter'] = "bronze_members";
                                $page_data['page_name'] = "bronze_members";
                                $this->load->view('back/index', $page_data);
                        } 
                        elseif ($para1 == "platinum_members") {
                                if ($para2 == "") {
                                        $page_data['top'] = "members/index.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "index.php";
                                        $page_data['bottom'] = "members/index.php";
                                        $page_data['get_platinum_members'] = $this->db->get_where("member", array("membership" => 2, "is_deleted =" => 0))->result();
                                        // echo "<pre>";
                                        // print_r($page_data['get_premium_members']);exit;
                                        // echo $this->db->last_query(); exit;
                                        if ($this->session->flashdata('alert') == "edit") {
                                                $page_data['success_alert'] = translate("you_have_successfully_edited_the_profile!");
                                        } elseif ($this->session->flashdata('alert') == "upgrade") {
                                                $page_data['success_alert'] = translate("you_have_successfully_upgraded_the_member_package!");
                                        }
                                } elseif ($para2 == "view_member") {
                                        $page_data['top'] = "members/members.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "view_member.php";
                                        $page_data['bottom'] = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                } elseif ($para2 == "edit_member") {
                                        $page_data['top']                 = "members/members.php";
                                        $page_data['folder']         = "members";
                                        $page_data['file']                 = "edit_member.php";
                                        $page_data['bottom']         = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                }
                                $page_data['member_type'] = "Platinum";
                                $page_data['parameter'] = "platinum_members";
                                $page_data['page_name'] = "platinum_members";
                                $this->load->view('back/index', $page_data);
                        }
                        elseif ($para1 == "all_members") {
                                if ($para2 == "") {
                                        $page_data['top'] = "members/index.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "index.php";
                                        $page_data['bottom'] = "members/index.php";
                                        $page_data['get_all_members'] = $this->db->get_where("member")->result();
                                        // echo "<pre>";
                                        // print_r($page_data['get_premium_members']);exit;
                                        // echo $this->db->last_query(); exit;
                                        if ($this->session->flashdata('alert') == "edit") {
                                                $page_data['success_alert'] = translate("you_have_successfully_edited_the_profile!");
                                        } elseif ($this->session->flashdata('alert') == "upgrade") {
                                                $page_data['success_alert'] = translate("you_have_successfully_upgraded_the_member_package!");
                                        }
                                } elseif ($para2 == "view_member") {
                                        $page_data['top'] = "members/members.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "view_member.php";
                                        $page_data['bottom'] = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                } elseif ($para2 == "edit_member") {
                                        $page_data['top']                 = "members/members.php";
                                        $page_data['folder']         = "members";
                                        $page_data['file']                 = "edit_member.php";
                                        $page_data['bottom']         = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                }
                                $page_data['member_type'] = "All";
                                $page_data['parameter'] = "all_members";
                                $page_data['page_name'] = "all_members";
                                $this->load->view('back/index', $page_data);
                        }
                        elseif ($para1 == "free_members") {
                                if ($para2 == "") {
                                        $page_data['top'] = "members/index.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "index.php";
                                        $page_data['bottom'] = "members/index.php";
                                        $page_data['get_free_members'] = $this->db->get_where("member", array("membership" => 3, "is_deleted = " => 0))->result();
                                        // echo "<pre>";
                                        // print_r($page_data['get_premium_members']);exit;
                                        // echo $this->db->last_query(); exit;
                                        if ($this->session->flashdata('alert') == "edit") {
                                                $page_data['success_alert'] = translate("you_have_successfully_edited_the_profile!");
                                        } elseif ($this->session->flashdata('alert') == "upgrade") {
                                                $page_data['success_alert'] = translate("you_have_successfully_upgraded_the_member_package!");
                                        }
                                } elseif ($para2 == "view_member") {
                                        $page_data['top'] = "members/members.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "view_member.php";
                                        $page_data['bottom'] = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                } elseif ($para2 == "edit_member") {
                                        $page_data['top']                 = "members/members.php";
                                        $page_data['folder']         = "members";
                                        $page_data['file']                 = "edit_member.php";
                                        $page_data['bottom']         = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                }
                                $page_data['member_type'] = "Free";
                                $page_data['parameter'] = "free_members";
                                $page_data['page_name'] = "free_members";
                                $this->load->view('back/index', $page_data);
                        }
                        elseif ($para1 == "fake_members") {
                                if ($para2 == "") {
                                        $page_data['top'] = "members/index.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "index.php";
                                        $page_data['bottom'] = "members/index.php";
                                        $page_data['get_fake_members'] = $this->db->get_where("member", array("membership" => 4, "is_deleted = " => 0))->result();
                                        // echo "<pre>";
                                        // print_r($page_data['get_premium_members']);exit;
                                        // echo $this->db->last_query(); exit;
                                        if ($this->session->flashdata('alert') == "edit") {
                                                $page_data['success_alert'] = translate("you_have_successfully_edited_the_profile!");
                                        } elseif ($this->session->flashdata('alert') == "upgrade") {
                                                $page_data['success_alert'] = translate("you_have_successfully_upgraded_the_member_package!");
                                        }
                                } elseif ($para2 == "view_member") {
                                        $page_data['top'] = "members/members.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "view_member.php";
                                        $page_data['bottom'] = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                } elseif ($para2 == "edit_member") {
                                        $page_data['top']                 = "members/members.php";
                                        $page_data['folder']         = "members";
                                        $page_data['file']                 = "edit_member.php";
                                        $page_data['bottom']         = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                }
                                $page_data['member_type'] = "Fake";
                                $page_data['parameter'] = "fake_members";
                                $page_data['page_name'] = "fake_members";
                                $this->load->view('back/index', $page_data);
                        }
                        elseif ($para1 == "incomplete_profiles") {
                                if ($para2 == "") {
                                        $page_data['top'] = "members/index.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "index.php";
                                        $page_data['bottom'] = "members/index.php";
                                        $page_data['get_incomplete_profiles'] = $this->db->get_where("member", array("isProfileCompleted" => 0, "is_deleted = " => 0))->result();
                                        // echo "<pre>";
                                        // print_r($page_data['get_premium_members']);exit;
                                        // echo $this->db->last_query(); exit;
                                        if ($this->session->flashdata('alert') == "edit") {
                                                $page_data['success_alert'] = translate("you_have_successfully_edited_the_profile!");
                                        } elseif ($this->session->flashdata('alert') == "upgrade") {
                                                $page_data['success_alert'] = translate("you_have_successfully_upgraded_the_member_package!");
                                        }
                                } elseif ($para2 == "view_member") {
                                        $page_data['top'] = "members/members.php";
                                        $page_data['folder'] = "members";
                                        $page_data['file'] = "view_member.php";
                                        $page_data['bottom'] = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                } elseif ($para2 == "edit_member") {
                                        $page_data['top']                 = "members/members.php";
                                        $page_data['folder']         = "members";
                                        $page_data['file']                 = "edit_member.php";
                                        $page_data['bottom']         = "members/members.php";
                                        $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para3))->result();
                                }
                                $page_data['member_type'] = "Incomplete Profiles";
                                $page_data['parameter'] = "incomplete_profiles";
                                $page_data['page_name'] = "incomplete_profiles";
                                $this->load->view('back/index', $page_data);
                        } 
                        // elseif ($para1 == "add_member") {
                        //         if ($para2 == "") {
                        //                 $page_data['top']                 = "members/index.php";
                        //                 $page_data['folder']         = "members";
                        //                 $page_data['file']                 = "add_member.php";
                        //                 $page_data['bottom']         = "members/index.php";
                        //                 $page_data['page_name'] = "add_member";
                        //                 if ($this->session->flashdata('alert') == "add") {
                        //                         $page_data['success_alert'] = translate("you_have_successfully_added_a_member!!");
                        //                 } elseif ($this->session->flashdata('alert') == "add_fail") {
                        //                         $page_data['danger_alert'] = translate("member_registration_failed!");
                        //                 }


                        //                 $this->load->view('back/index', $page_data);
                        //         } elseif ($para2 == "do_add") {

                        //                 $this->form_validation->set_rules('fname', 'First Name', 'required');
                        //                 $this->form_validation->set_rules('lname', 'Last Name', 'required');
                        //                 $this->form_validation->set_rules('gender', 'Gender', 'required');
                        //                 $this->form_validation->set_rules('on_behalf', 'On Behalf', 'required');
                        //                 $this->form_validation->set_rules('plan', 'Plan', 'required');
                        //                 $this->form_validation->set_rules('email', 'Email', 'required|is_unique[member.email]|valid_email', array('required' => 'The %s is required.', 'is_unique' => 'This %s already exists.'));
                        //                 $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
                        //                 $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
                        //                 $this->form_validation->set_rules('password', 'Password', 'required');
                        //                 $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

                        //                 if ($this->form_validation->run() == FALSE) {
                        //                         $page_data['top']                 = "members/index.php";
                        //                         $page_data['folder']         = "members";
                        //                         $page_data['file']                 = "add_member.php";
                        //                         $page_data['bottom']         = "members/index.php";
                        //                         $page_data['page_name'] = "add_member";
                        //                         $page_data['form_error'] = "yes";
                        //                         $page_data['form_contents'] = $this->input->post();
                        //                         $this->session->set_flashdata('alert', 'add_fail');
                        //                         $this->load->view('back/index', $page_data);
                        //                 } else {

                        //                         // ------------------------------------Profile Image------------------------------------ //
                        //                         $profile_image[] = array(
                        //                                 'profile_image'    =>  'default.jpg',
                        //                                 'thumb'         =>  'default_thumb.jpg'
                        //                         );
                        //                         $profile_image = json_encode($profile_image);
                        //                         // ------------------------------------Profile Image------------------------------------ //

                        //                         // ------------------------------------Basic Info------------------------------------ //
                        //                         $basic_info[] = array(
                        //                                 'age'                 => '',
                        //                                 'marital_status'        => '',
                        //                                 'number_of_children'    => '',
                        //                                 'area'                  => '',
                        //                                 'on_behalf'             => $this->input->post('on_behalf')
                        //                         );
                        //                         $basic_info = json_encode($basic_info);
                        //                         // ------------------------------------Basic Info------------------------------------ //

                        //                         // ------------------------------------Present Address------------------------------------ //
                        //                         $present_address[] = array(
                        //                                 'country'        => '',
                        //                                 'city'                  => '',
                        //                                 'state'                 => '',
                        //                                 'postal_code'           => ''
                        //                         );
                        //                         $present_address = json_encode($present_address);
                        //                         // ------------------------------------Present Address------------------------------------ //

                        //                         // ------------------------------------Education & Career------------------------------------ //
                        //                         $education_and_career[] = array(
                        //                                 'highest_education' => '',
                        //                                 'occupation'                    => '',
                        //                                 'annual_income'                 => ''
                        //                         );
                        //                         $education_and_career = json_encode($education_and_career);
                        //                         // ------------------------------------Education & Career------------------------------------ //

                        //                         // ------------------------------------ Physical Attributes------------------------------------ //
                        //                         $physical_attributes[] = array(
                        //                                 'weight'     => '',
                        //                                 'eye_color'             => '',
                        //                                 'hair_color'            => '',
                        //                                 'complexion'            => '',
                        //                                 'blood_group'           => '',
                        //                                 'body_type'             => '',
                        //                                 'body_art'              => '',
                        //                                 'any_disability'        => ''
                        //                         );
                        //                         $physical_attributes = json_encode($physical_attributes);
                        //                         // ------------------------------------ Physical Attributes------------------------------------ //

                        //                         // ------------------------------------ Language------------------------------------ //
                        //                         $language[] = array(
                        //                                 'mother_tongue'         => '',
                        //                                 'language'              => '',
                        //                                 'speak'                 => '',
                        //                                 'read'                  => ''
                        //                         );
                        //                         $language = json_encode($language);
                        //                         // ------------------------------------ Language------------------------------------ //

                        //                         // ------------------------------------Hobbies & Interest------------------------------------ //
                        //                         $hobbies_and_interest[] = array(
                        //                                 'hobby'     => '',
                        //                                 'interest'              => '',
                        //                                 'music'                 => '',
                        //                                 'books'                 => '',
                        //                                 'movie'                 => '',
                        //                                 'tv_show'               => '',
                        //                                 'sports_show'           => '',
                        //                                 'fitness_activity'      => '',
                        //                                 'cuisine'               => '',
                        //                                 'dress_style'           => ''
                        //                         );
                        //                         $hobbies_and_interest = json_encode($hobbies_and_interest);
                        //                         // ------------------------------------Hobbies & Interest------------------------------------ //

                        //                         // ------------------------------------ Personal Attitude & Behavior------------------------------------ //
                        //                         $personal_attitude_and_behavior[] = array(
                        //                                 'affection'   => '',
                        //                                 'humor'                 => '',
                        //                                 'political_view'        => '',
                        //                                 'religious_service'     => ''
                        //                         );
                        //                         $personal_attitude_and_behavior = json_encode($personal_attitude_and_behavior);
                        //                         // ------------------------------------ Personal Attitude & Behavior------------------------------------ //

                        //                         // ------------------------------------Residency Information------------------------------------ //
                        //                         $residency_information[] = array(
                        //                                 'birth_country'    => '',
                        //                                 'residency_country'     => '',
                        //                                 'citizenship_country'   => '',
                        //                                 'grow_up_country'       => '',
                        //                                 'immigration_status'    => ''
                        //                         );
                        //                         $residency_information = json_encode($residency_information);
                        //                         // ------------------------------------Residency Information------------------------------------ //

                        //                         // ------------------------------------Spiritual and Social Background------------------------------------ //
                        //                         $spiritual_and_social_background[] = array(
                        //                                 'religion'   => '',
                        //                                 'caste'                 => '',
                        //                                 'sub_caste'             => '',
                        //                                 'ethnicity'             => '',
                        //                                 'u_manglik'             => '',
                        //                                 'personal_value'        => '',
                        //                                 'family_value'          => '',
                        //                                 'community_value'       => '',
                        //                                 'family_status'          =>  ''
                        //                         );
                        //                         $spiritual_and_social_background = json_encode($spiritual_and_social_background);
                        //                         // ------------------------------------Spiritual and Social Background------------------------------------ //

                        //                         // ------------------------------------ Life Style------------------------------------ //
                        //                         $life_style[] = array(
                        //                                 'diet'                => '',
                        //                                 'drink'                 => '',
                        //                                 'smoke'                 => '',
                        //                                 'living_with'           => ''
                        //                         );
                        //                         $life_style = json_encode($life_style);
                        //                         // ------------------------------------ Life Style------------------------------------ //

                        //                         // ------------------------------------ Astronomic Information------------------------------------ //
                        //                         $astronomic_information[] = array(
                        //                                 'sun_sign'    => '',
                        //                                 'moon_sign'                 => '',
                        //                                 'time_of_birth'             => '',
                        //                                 'city_of_birth'             => ''
                        //                         );
                        //                         $astronomic_information = json_encode($astronomic_information);
                        //                         // ------------------------------------ Astronomic Information------------------------------------ //

                        //                         // ------------------------------------Permanent Address------------------------------------ //
                        //                         $permanent_address[] = array(
                        //                                 'permanent_country'    => '',
                        //                                 'permanent_city'                => '',
                        //                                 'permanent_state'               => '',
                        //                                 'permanent_postal_code'         => ''
                        //                         );
                        //                         $permanent_address = json_encode($permanent_address);
                        //                         // ------------------------------------Permanent Address------------------------------------ //

                        //                         // ------------------------------------Family Information------------------------------------ //
                        //                         $family_info[] = array(
                        //                                 'father'             => '',
                        //                                 'mother'                => '',
                        //                                 'brother_sister'        => ''
                        //                         );
                        //                         $family_info = json_encode($family_info);
                        //                         // ------------------------------------Family Information------------------------------------ //

                        //                         // --------------------------------- Additional Personal Details--------------------------------- //
                        //                         $additional_personal_details[] = array(
                        //                                 'home_district'  => '',
                        //                                 'family_residence'              => '',
                        //                                 'fathers_occupation'            => '',
                        //                                 'special_circumstances'         => ''
                        //                         );
                        //                         $additional_personal_details = json_encode($additional_personal_details);
                        //                         // --------------------------------- Additional Personal Details--------------------------------- //

                        //                         // ------------------------------------ Partner Expectation------------------------------------ //
                        //                         $partner_expectation[] = array(
                        //                                 'general_requirement'    => '',
                        //                                 'partner_age'                       => '',
                        //                                 'partner_height'                    => '',
                        //                                 'partner_weight'                    => '',
                        //                                 'partner_marital_status'            => '',
                        //                                 'with_children_acceptables'         => '',
                        //                                 'partner_country_of_residence'      => '',
                        //                                 'partner_religion'                  => '',
                        //                                 'partner_caste'                     => '',
                        //                                 'partner_subcaste'                  => '',
                        //                                 'partner_complexion'                => '',
                        //                                 'partner_education'                 => '',
                        //                                 'partner_profession'                => '',
                        //                                 'partner_drinking_habits'           => '',
                        //                                 'partner_smoking_habits'            => '',
                        //                                 'partner_diet'                      => '',
                        //                                 'partner_body_type'                 => '',
                        //                                 'partner_personal_value'            => '',
                        //                                 'manglik'                           => '',
                        //                                 'partner_any_disability'            => '',
                        //                                 'partner_mother_tongue'             => '',
                        //                                 'partner_family_value'              => '',
                        //                                 'prefered_country'                  => '',
                        //                                 'prefered_state'                    => '',
                        //                                 'prefered_status'                   => ''
                        //                         );
                        //                         $partner_expectation = json_encode($partner_expectation);
                        //                         // ------------------------------------ Partner Expectation------------------------------------ //

                        //                         // ------------------------------------Privacy Status------------------------------------ //
                        //                         $privacy_status[] = array(
                        //                                 'present_address'                 => 'no',
                        //                                 'education_and_career'            => 'no',
                        //                                 'physical_attributes'             => 'no',
                        //                                 'language'                        => 'no',
                        //                                 'hobbies_and_interest'            => 'no',
                        //                                 'personal_attitude_and_behavior'  => 'no',
                        //                                 'residency_information'           => 'no',
                        //                                 'spiritual_and_social_background' => 'no',
                        //                                 'life_style'                      => 'no',
                        //                                 'astronomic_information'          => 'no',
                        //                                 'permanent_address'               => 'no',
                        //                                 'family_info'                     => 'no',
                        //                                 'additional_personal_details'     => 'no',
                        //                                 'partner_expectation'             => 'yes'
                        //                         );
                        //                         $privacy_status = json_encode($privacy_status);
                        //                         // ------------------------------------Privacy Status------------------------------------ //

                        //                         // ------------------------------------Pic Privacy Status------------------------------------ //
                        //                         $pic_privacy[] = array(
                        //                                 'profile_pic_show'        => 'all',
                        //                                 'gallery_show'            => 'premium'

                        //                         );
                        //                         $data_pic_privacy = json_encode($pic_privacy);
                        //                         // ------------------------------------Pic Privacy Status------------------------------------ //

                        //                         // --------------------------------- Additional Personal Details--------------------------------- //
                        //                         $package_info[] = array(
                        //                                 'current_package'   => $this->Crud_model->get_type_name_by_id('plan', $this->input->post('plan')),
                        //                                 'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $this->input->post('plan'), 'amount'),
                        //                                 'payment_type'      => 'None',
                        //                         );
                        //                         $package_info = json_encode($package_info);
                        //                         // --------------------------------- Additional Personal Details--------------------------------- //


                        //                         $data['first_name'] = $this->input->post('fname');
                        //                         $data['last_name'] = $this->input->post('lname');
                        //                         $data['gender'] = $this->input->post('gender');
                        //                         $data['email'] = $this->input->post('email');
                        //                         $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));
                        //                         $data['height'] = 0.00;
                        //                         $data['mobile'] = $this->input->post('mobile');
                        //                         $data['password'] = sha1($this->input->post('password'));
                        //                         $data['profile_image'] = $profile_image;
                        //                         $data['introduction'] = '';
                        //                         $data['basic_info'] = $basic_info;
                        //                         $data['present_address'] = $present_address;
                        //                         $data['family_info'] = $family_info;
                        //                         $data['education_and_career'] = $education_and_career;
                        //                         $data['physical_attributes'] = $physical_attributes;
                        //                         $data['language'] = $language;
                        //                         $data['hobbies_and_interest'] = $hobbies_and_interest;
                        //                         $data['personal_attitude_and_behavior'] = $personal_attitude_and_behavior;
                        //                         $data['residency_information'] = $residency_information;
                        //                         $data['spiritual_and_social_background'] = $spiritual_and_social_background;
                        //                         $data['life_style'] = $life_style;
                        //                         $data['astronomic_information'] = $astronomic_information;
                        //                         $data['permanent_address'] = $permanent_address;
                        //                         $data['additional_personal_details'] = $additional_personal_details;
                        //                         $data['partner_expectation'] = $partner_expectation;
                        //                         $data['interest'] = '[]';
                        //                         $data['short_list'] = '[]';
                        //                         $data['followed'] = '[]';
                        //                         $data['ignored'] = '[]';
                        //                         $data['ignored_by'] = '[]';
                        //                         $data['gallery'] = '[]';
                        //                         $data['happy_story'] = '[]';
                        //                         $data['package_info'] = $package_info;
                        //                         $data['payments_info'] = '[]';
                        //                         $data['interested_by'] = '[]';
                        //                         $data['follower'] = 0;
                        //                         $data['notifications'] = '[]';
                        //                         $plan = $this->input->post('plan');
                        //                         if ($plan == 1) {
                        //                                 $data['membership'] = 1;
                        //                         } else {
                        //                                 $data['membership'] = 2;
                        //                         }
                        //                         $data['profile_status'] = 1;
                        //                         $data['is_closed'] = 'no';
                        //                         $data['member_since'] = date("Y-m-d h:m:s");
                        //                         $data['express_interest'] = $this->db->get_where('plan', array('plan_id' => $plan))->row()->express_interest;
                        //                         $data['direct_messages'] = $this->db->get_where('plan', array('plan_id' => $plan))->row()->direct_messages;
                        //                         $data['photo_gallery'] = $this->db->get_where('plan', array('plan_id' => $plan))->row()->photo_gallery;
                        //                         $data['profile_completion'] = 0;
                        //                         $data['is_blocked'] = 'no';
                        //                         $data['privacy_status'] = $privacy_status;
                        //                         $data['pic_privacy'] = $data_pic_privacy;

                        //                         $this->db->insert('member', $data);
                        //                         $insert_id = $this->db->insert_id();
                        //                         $member_profile_id = strtoupper(substr(hash('sha512', rand()), 0, 8)) . $insert_id;

                        //                         $this->db->where('member_id', $insert_id);
                        //                         $this->db->update('member', array('member_profile_id' => $member_profile_id));
                        //                         recache();

                        //                         // $msg = 'done';
                        //                         if ($this->Email_model->account_opening('member', $data['email'], $this->input->post('password')) == false) {
                        //                                 //$msg = 'done_but_not_sent';
                        //                         } else {
                        //                                 //$msg = 'done_and_sent';
                        //                         }

                        //                         $this->session->set_flashdata('alert', 'add');
                        //                         redirect(base_url() . 'admin/members/add_member', 'refresh');
                        //                 }
                        //         }
                        // } 
                        // elseif ($para1 == "update_member") {
                        //         //		$this->form_validation->set_rules('introduction', 'Introduction', 'required');

                        //         $this->form_validation->set_rules('first_name', 'First Name', 'required');
                        //         //		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
                        //         //		$this->form_validation->set_rules('gender', 'Gender', 'required');
                        //         //        $this->form_validation->set_rules('profile_made', 'On Behalf', 'required');

                        //         //        $this->form_validation->set_rules('marital_status', 'Marital Status', 'required');

                        //         //        $this->form_validation->set_rules('residence', 'Country', 'required');

                        //         // $this->form_validation->set_rules('city', 'City', 'required');

                        //         //        $this->form_validation->set_rules('highest_education', 'Highest Education', 'required');
                        //         //        $this->form_validation->set_rules('profession', 'Profession', 'required');


                        //         //        $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');

                        //         // $this->form_validation->set_rules('permanent_city', 'Permanent City', 'required');

                        //         if ($this->form_validation->run() == FALSE) {
                        //                 $page_data['top']                 = "members/index.php";
                        //                 $page_data['folder']         = "members";
                        //                 $page_data['file']                 = "edit_member.php";
                        //                 $page_data['bottom']         = "members/index.php";
                        //                 $page_data['page_name'] = "edit_member";
                        //                 $page_data['form_error'] = "yes";
                        //                 $page_data['form_contents'] = $this->input->post();
                        //                 $this->session->set_flashdata('alert', 'edit_fail');
                        //                 if ($para3 == 'premium_members') {
                        //                         $page_data['get_premium_member_by_id'] = $this->db->get_where("member", array("membership" => 2, "member_id" => $para2))->result();
                        //                         $page_data['member_type'] = "Premium";
                        //                         $page_data['parameter'] = "premium_members";
                        //                         $page_data['page_name'] = "premium_members";
                        //                 } elseif ($para3 == 'free_members') {
                        //                         $page_data['get_free_member_by_id'] = $this->db->get_where("member", array("membership" => 1, "member_id" => $para2))->result();
                        //                         $page_data['member_type'] = "Free";
                        //                         $page_data['parameter'] = "free_members";
                        //                         $page_data['page_name'] = "free_members";
                        //                 }

                        //                 $this->load->view('back/index', $page_data);
                        //         } else {
                        //                 $data['first_name'] = $this->input->post('first_name');
                        //                 $data['last_name'] = $this->input->post('last_name');
                        //                 $data['gender'] = $this->input->post('gender');
                        //                 $data['email'] = $this->input->post('email');
                        //                 $data['mobile'] = $this->input->post('mobile');
                        //                 $data['date_of_birth'] = strtotime($this->input->post('date_of_birth'));
                        //                 $data['height'] = $this->input->post('height');
                        //                 $data['introduction'] = $this->input->post('introduction');

                        //                 // ------------------------------------Basic Info------------------------------------ //
                        //                 $basic_info[] = array(
                        //                         'residence'                =>        $this->input->post('residence'),
                        //                         'resident_status'        =>        $this->input->post('resident_status'),
                        //                         'my_sect'                                        =>        $this->input->post('my_sect'),
                        //                         'like_to_marry'             =>  $this->input->post('like_to_marry'),
                        //                         'grew_up'             =>  $this->input->post('grew_up'),
                        //                         'first_language'             =>  $this->input->post('first_language'),
                        //                         'second_language'             =>  $this->input->post('second_language'),
                        //                         'marital_status'             =>  $this->input->post('marital_status'),
                        //                         'Disabilities'             =>  $this->input->post('Disabilities'),
                        //                         'living_with'             =>  $this->input->post('living_with'),
                        //                         'profile_made'             =>  $this->input->post('profile_made'),
                        //                         'profession'             =>  $this->input->post('profession')
                        //                 );
                        //                 $data['basic_info'] = json_encode($basic_info);
                        //                 // ------------------------------------Basic Info------------------------------------ //

                        //                 // ------------------------------------Present Address------------------------------------ //
                        //                 $present_address[] = array(
                        //                         'country'                =>  $this->input->post('country'),
                        //                         'city'                                        =>        $this->input->post('city'),
                        //                         'state'                                        =>        $this->input->post('state'),
                        //                         'postal_code'                        =>        $this->input->post('postal_code')
                        //                 );
                        //                 $data['present_address'] = json_encode($present_address);
                        //                 // ------------------------------------Present Address------------------------------------ //

                        //                 // ------------------------------------Education & Career------------------------------------ //
                        //                 $education_and_career[] = array(
                        //                         'highest_education' =>  $this->input->post('highest_education'),
                        //                         'i_am_employed'                    =>  $this->input->post('i_am_employed'),
                        //                         'annual_income'                 =>  $this->input->post('annual_income'),
                        //                         'my_job_title'                 =>  $this->input->post('my_job_title'),
                        //                         'my_company_name'                 =>  $this->input->post('my_company_name'),
                        //                         'years_worked'                 =>  $this->input->post('years_worked'),
                        //                         'self_employed'                 =>  $this->input->post('self_employed'),
                        //                         'years_owned'                 =>  $this->input->post('years_owned'),
                        //                         'annual_income_self'                 =>  $this->input->post('annual_income_self')
                        //                 );
                        //                 $data['education_and_career'] = json_encode($education_and_career);
                        //                 // ------------------------------------Education & Career------------------------------------ //

                        //                 // ------------------------------------ Physical Attributes------------------------------------ //
                        //                 $physical_attributes[] = array(
                        //                         'weight'     =>        $this->input->post('weight'),
                        //                         'eye_color'                                =>        $this->input->post('eye_color'),
                        //                         'hair_color'                        =>        $this->input->post('hair_color'),
                        //                         'complexion'                        =>        $this->input->post('complexion'),
                        //                         'blood_group'                        =>        $this->input->post('blood_group'),
                        //                         'body_type'                                =>        $this->input->post('body_type'),
                        //                         'body_art'                                =>        $this->input->post('body_art'),
                        //                         'any_disability'                =>        $this->input->post('any_disability'),
                        //                         'exercise'                =>        $this->input->post('exercise')
                        //                 );
                        //                 $data['physical_attributes'] = json_encode($physical_attributes);
                        //                 // ------------------------------------ Physical Attributes------------------------------------ //

                        //                 // ------------------------------------ Language------------------------------------ //
                        //                 $language[] = array(
                        //                         'mother_tongue'                        =>  $this->input->post('mother_tongue'),
                        //                         'language'                                =>        $this->input->post('language'),
                        //                         'speak'                                        =>        $this->input->post('speak'),
                        //                         'read'                                        =>        $this->input->post('read')
                        //                 );
                        //                 $data['language'] = json_encode($language);
                        //                 // ------------------------------------ Language------------------------------------ //

                        //                 // ------------------------------------Hobbies & Interest------------------------------------ //
                        //                 $hobbies_and_interest[] = array(
                        //                         'hobby'            =>  $this->input->post('hobby'),
                        //                         'interest'                                =>  $this->input->post('interest'),
                        //                         'music'                                        =>        $this->input->post('music'),
                        //                         'books'                                        =>        $this->input->post('books'),
                        //                         'movie'                                        =>        $this->input->post('movie'),
                        //                         'tv_show'                                =>        $this->input->post('tv_show'),
                        //                         'sports_show'                        =>        $this->input->post('sports_show'),
                        //                         'fitness_activity'                =>        $this->input->post('fitness_activity'),
                        //                         'cuisine'                                =>        $this->input->post('cuisine'),
                        //                         'dress_style'                        =>        $this->input->post('dress_style')
                        //                 );
                        //                 $data['hobbies_and_interest'] = json_encode($hobbies_and_interest);
                        //                 // ------------------------------------Hobbies & Interest------------------------------------ //

                        //                 // ------------------------------------ Personal Attitude & Behavior------------------------------------ //
                        //                 $personal_attitude_and_behavior[] = array(
                        //                         'affection'        =>  $this->input->post('affection'),
                        //                         'humor'             =>        $this->input->post('humor'),
                        //                         'political_view'    =>        $this->input->post('political_view'),
                        //                         'religious_service' =>        $this->input->post('religious_service')
                        //                 );
                        //                 $data['personal_attitude_and_behavior'] = json_encode($personal_attitude_and_behavior);
                        //                 // ------------------------------------ Personal Attitude & Behavior------------------------------------ //

                        //                 // ------------------------------------Residency Information------------------------------------ //
                        //                 $residency_information[] = array(
                        //                         'birth_country'        =>  $this->input->post('birth_country'),
                        //                         'residency_country'                =>        $this->input->post('residency_country'),
                        //                         'citizenship_country'        =>        $this->input->post('citizenship_country'),
                        //                         'grow_up_country'                =>        $this->input->post('grow_up_country'),
                        //                         'immigration_status'        =>        $this->input->post('immigration_status')
                        //                 );
                        //                 $data['residency_information'] = json_encode($residency_information);
                        //                 // ------------------------------------Residency Information------------------------------------ //

                        //                 // ------------------------------------Spiritual and Social Background------------------------------------ //
                        //                 $spiritual_and_social_background[] = array(
                        //                         'religion'        =>  $this->input->post('religion'),
                        //                         'caste'                                        =>        $this->input->post('caste'),
                        //                         'sub_caste'                                =>        $this->input->post('sub_caste'),
                        //                         'ethnicity'                                =>        $this->input->post('ethnicity'),
                        //                         'personal_value'                =>        $this->input->post('personal_value'),
                        //                         'family_value'                        =>        $this->input->post('family_value'),
                        //                         'u_manglik'             =>  $this->input->post('u_manglik'),
                        //                         'community_value'                =>        $this->input->post('community_value'),
                        //                         'family_status'         =>  $this->input->post('family_status')
                        //                 );
                        //                 $data['spiritual_and_social_background'] = json_encode($spiritual_and_social_background);
                        //                 // ------------------------------------Spiritual and Social Background------------------------------------ //

                        //                 // ------------------------------------ Life Style------------------------------------ //
                        //                 $life_style[] = array(
                        //                         'diet'                                =>  $this->input->post('diet'),
                        //                         'drink'                                        =>        $this->input->post('drink'),
                        //                         'smoke'                                        =>        $this->input->post('smoke'),
                        //                         'living_with'                        =>        $this->input->post('living_with')
                        //                 );
                        //                 $data['life_style'] = json_encode($life_style);
                        //                 // ------------------------------------ Life Style------------------------------------ //

                        //                 // ------------------------------------ Astronomic Information------------------------------------ //
                        //                 $astronomic_information[] = array(
                        //                         'muslim_i_am'    =>  $this->input->post('muslim_i_am'),
                        //                         'revert'                 =>  $this->input->post('revert'),
                        //                         'convert'             =>  $this->input->post('convert'),
                        //                         'do_i_fast'             =>  $this->input->post('do_i_fast'),
                        //                         'do_i_pray'             =>  $this->input->post('do_i_pray'),
                        //                         'do_i_eat_halal'             =>  $this->input->post('do_i_eat_halal'),
                        //                         'women_only'             =>  $this->input->post('women_only'),
                        //                         'wife_wear'             =>  $this->input->post('wife_wear')
                        //                 );
                        //                 $data['astronomic_information'] = json_encode($astronomic_information);
                        //                 // ------------------------------------ Astronomic Information------------------------------------ //

                        //                 // ------------------------------------Permanent Address------------------------------------ //
                        //                 $permanent_address[] = array(
                        //                         'permanent_country'        =>  $this->input->post('permanent_country'),
                        //                         'permanent_city'                                =>        $this->input->post('permanent_city'),
                        //                         'permanent_state'                                =>        $this->input->post('permanent_state'),
                        //                         'permanent_postal_code'                        =>        $this->input->post('permanent_postal_code')
                        //                 );
                        //                 $data['permanent_address'] = json_encode($permanent_address);
                        //                 // ------------------------------------Permanent Address------------------------------------ //

                        //                 // ------------------------------------Family Information------------------------------------ //
                        //                 $family_info[] = array(
                        //                         'father'                                =>  $this->input->post('father'),
                        //                         'mother'                                =>        $this->input->post('mother'),
                        //                         'brother_sister'                =>        $this->input->post('brother_sister')
                        //                 );
                        //                 $data['family_info'] = json_encode($family_info);
                        //                 // ------------------------------------Family Information------------------------------------ //

                        //                 // ------------------------------------ Additional Personal Details------------------------------------ //
                        //                 $additional_personal_details[] = array(
                        //                         'born_at'        =>  $this->input->post('born_at'),
                        //                         'want_children'                                =>        $this->input->post('want_children'),
                        //                         'do_i_smoke'                        =>        $this->input->post('do_i_smoke'),
                        //                         'grew_up_in'                        =>        $this->input->post('grew_up_in'),
                        //                         'have_children'                        =>        $this->input->post('have_children'),
                        //                         'do_i_drink'                        =>        $this->input->post('do_i_drink'),
                        //                         'my_hobbies'                        =>        $this->input->post('my_hobbies'),
                        //                         'believe_in_polygamy'                        =>        $this->input->post('believe_in_polygamy'),
                        //                         'spouse_is'                        =>        $this->input->post('spouse_is')
                        //                 );
                        //                 $data['additional_personal_details'] = json_encode($additional_personal_details);
                        //                 // ------------------------------------ Additional Personal Details------------------------------------ //

                        //                 // ------------------------------------ Partner Expectation------------------------------------ //
                        //                 $partner_expectation[] = array(
                        //                         'partner_age'                                                =>        $this->input->post('partner_age'),
                        //                         'partner_height'                                        =>        $this->input->post('partner_height'),
                        //                         'partner_marital_status'                        =>        $this->input->post('partner_marital_status'),
                        //                         'partner_country_of_residence'                =>        $this->input->post('partner_country_of_residence'),
                        //                         'partner_caste'                                                =>        $this->input->post('partner_caste'),
                        //                         'partner_education'                 =>        $this->input->post('partner_education'),
                        //                         'partner_profession'                                =>        $this->input->post('partner_profession'),
                        //                         'partner_body_type'                                        =>        $this->input->post('partner_body_type'),
                        //                         'partner_any_disability'                        =>        $this->input->post('partner_any_disability'),
                        //                         'partner_born_at'                        =>        $this->input->post('partner_born_at'),
                        //                         'partner_nationality'                        =>        $this->input->post('partner_nationality'),
                        //                         'partner_resident_status'                        =>        $this->input->post('partner_resident_status'),
                        //                         'partner_1_language'                        =>        $this->input->post('partner_1_language'),
                        //                         'partner_have_children'                        =>        $this->input->post('partner_have_children'),
                        //                         'partner_children_how_many'                        =>        $this->input->post('partner_children_how_many'),
                        //                         'partner_profession'                        =>        $this->input->post('partner_profession'),
                        //                         'partner_2_language'                        =>        $this->input->post('partner_2_language')
                        //                 );
                        //                 $data['partner_expectation'] = json_encode($partner_expectation);
                        //                 // ------------------------------------ Partner Expectation------------------------------------ //

                        //                 $this->db->where('member_id', $para2);
                        //                 $result = $this->db->update('member', $data);
                        //                 recache();
                        //                 if ($result) {
                        //                         $this->session->set_flashdata('alert', 'edit');
                        //                         redirect(base_url() . 'admin/members/' . $para3, 'refresh');
                        //                 }
                        //         }
                        // } 
                        elseif ($para1 == "upgrade_member_package") {
                                $up_member_id = $this->input->post('up_member_id');
                                $plan_id = $this->input->post('plan');
                                $member_type = $this->input->post('member_type');

                                $prev_express_interest =  $this->db->get_where('member', array('member_id' => $up_member_id))->row()->express_interest;
                                $prev_direct_messages = $this->db->get_where('member', array('member_id' => $up_member_id))->row()->direct_messages;
                                $prev_photo_gallery = $this->db->get_where('member', array('member_id' => $up_member_id))->row()->photo_gallery;

                                if ($plan_id == '1') {
                                        $data['membership'] = 1;
                                } else {
                                        $data['membership'] = 2;
                                }

                                $data['express_interest'] = $prev_express_interest + $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->express_interest;
                                $data['direct_messages'] = $prev_direct_messages + $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->direct_messages;
                                $data['photo_gallery'] = $prev_photo_gallery + $this->db->get_where('plan', array('plan_id' => $plan_id))->row()->photo_gallery;

                                $package_info[] = array(
                                        'current_package'   => $this->Crud_model->get_type_name_by_id('plan', $plan_id),
                                        'package_price'     => $this->Crud_model->get_type_name_by_id('plan', $plan_id, 'amount'),
                                        'payment_type'      => 'By Admin',
                                );
                                $data['package_info'] = json_encode($package_info);

                                $this->db->where('member_id', $up_member_id);
                                $result = $this->db->update('member', $data);
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'upgrade');
                                        redirect(base_url() . 'admin/members/' . $member_type, 'refresh');
                                }
                        }
                }
        }

        function disabled_members($para1 = "", $para2 = "", $para3 = "", $para4 = "")
        {
            if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($this->session->flashdata('alert') == "restore") {
                                $page_data['success_alert'] = translate("you_have_successfully_restored_this_member!");
                        }
                        if ($para1 == "list_data") {
                                $columns = array(
                                        0 => '',
                                        1 => 'member_profile_id',
                                        2 => 'first_name',
                                        2 => 'email',
                                        3 => 'password',
                                        4 => 'member_since',
                                );

                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];

                                $member_type = 3;

                                $totalData = $this->Crud_model->all_deleted_members_count($member_type);
                                
                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {

                                        $members = $this->Crud_model->all_deleted_members($member_type, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $members =  $this->Crud_model->deleted_members_search($member_type, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->deleted_members_search_count($member_type, $search);
                                }

                                $data = array();
                                if (!empty($members)) {
                                        // if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
                                        foreach ($members as $member) {
                                                $email_member = $this->Crud_model->get_email_member($member->member_id, 1);
                                                $profile_image = $member->profile_image;
                                                if(!empty($member->profile_image) && $member->is_profile_img_approved == 1){
                                                    if (file_exists('uploads/profile_image/'.$member->member_id . "/" . $profile_image)) {
                                                        $member_image = "<img src='" . base_url() . "uploads/profile_image/" .$member->member_id . "/" . $profile_image . "' class='img-sm'>";
                                                    }
                                                    else
                                                    {
                                                        $member_image = "<img src='" . base_url() . "uploads/profile_image/default.jpg' class='img-sm'>";
                                                    }
                                                }
                                                else
                                                {
                                                    $member_image = "<img src='" . base_url() . "uploads/profile_image/default.jpg' class='img-sm'>";
                                                }

                                                $acnt_status_button = "<center><span class='badge badge-danger' style='width:60px'>" . translate('Inactive') . "</span></center>";

                                                // if ($member->is_deleted == 1) {
                                                //         $acnt_status_button = "<center><span class='badge badge-danger' style='width:60px'>" . translate('Inactive') . "</span></center>";
                                                // } elseif ($member->is_deleted == 0) {
                                                //         $acnt_status_button = "<center><span class='badge badge-success' style='width:60px'>" . translate('Active') . "</span></center>";
                                                // }
                                                $switch_button = "<button data-target='#switch_modal' data-toggle='modal' class='btn btn-success btn-sm add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('switch_member') . "' onclick='switchMember(" . $member->member_id . ")'><i class='fa fa-exchange'></i></button>";
                                                $nestedData['image'] = $member_image;
                                                $nestedData['name'] = $member->first_name . ' ' . $member->last_name;
                                                $nestedData['member_id'] = $member->member_profile_id;
                                                // $nestedData['follower'] = $member->follower;
                                                $this->db->select('name');
                                                $this->db->from('plan');
                                                $this->db->join('deleted_member', 'plan.plan_id = deleted_member.membership');
                                                $this->db->where('plan.plan_id', $member->membership);
                                                $package = $this->db->get()->row();
                                                $nestedData['package'] = $package->name;
                                                $nestedData['email'] = "<span style='color:black;'>" . $member->email . "</span>";
                                                $nestedData['password'] = "<span style='color:black;'>" . $member->plain_password . "</span>";
                                                $nestedData['registered'] = date('d/m/Y H:i A', strtotime($member->member_since));
                                                $nestedData['member_status'] = $acnt_status_button;
                                                // $nestedData['options'] = "<button data-target='#restore_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('restore') . "' onclick='restore($member->member_id)'><i class='fa fa-check'></i></button>" . "<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('delete_member') . "' onclick='delete_member(" . $member->member_id . ")'><i class='fa fa-trash'></i></button><button data-target='#mail_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='Send Email' onclick='send_email(" . $member->member_id . ")'><i class='fa fa-envelope'></i></button>";
                                                $nestedData['switch'] = "<select class='form-control' id='switchPackageTo_".$member->member_id."'>
                                                                                <option value='1'>Bronze</option>
                                                                                <option value='3'>Free</option>
                                                                                <option value='4'>Fake</option>
                                                                                <option value='deleted'>Delete</option>
                                                                        </select>" . $switch_button;
                                                $nestedData['email_sent'] = $email_member;

                                                $data[] = $nestedData;
                                                // if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } 
                        elseif ($para1 == "") {
                            $page_data['top'] = "members/index.php";
                            $page_data['folder'] = "deleted_members";
                            $page_data['page_name'] = "deleted_members";
                            $page_data['file'] = "index.php";
                            $page_data['bottom'] = "members/index.php";

                            $this->load->view('back/index', $page_data);
                        }
                }
        }

        function member_restore($para1)
        {

                $this->session->set_flashdata('alert', 'restore');
                echo $para1;
                $data['member_id'] = $para1;
                $data['member_profile_id'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->member_profile_id;
                $data['first_name'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->first_name;
                $data['last_name'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->last_name;
                $data['gender'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->gender;
                $data['email'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->email;
                $data['mobile'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->mobile;
                $data['is_closed'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->is_closed;
                $data['date_of_birth'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->date_of_birth;
                $data['height'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->height;
                $data['password'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->password;
                $data['profile_image'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->profile_image;
                $data['introduction'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->introduction;
                $data['basic_info'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->basic_info;
                $data['present_address'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->present_address;
                $data['education_and_career'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->education_and_career;
                $data['physical_attributes'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->physical_attributes;
                $data['language'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->language;
                $data['hobbies_and_interest'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->hobbies_and_interest;
                $data['personal_attitude_and_behavior'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->personal_attitude_and_behavior;
                $data['residency_information'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->residency_information;
                $data['spiritual_and_social_background'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->spiritual_and_social_background;
                $data['life_style'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->life_style;
                $data['astronomic_information'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->astronomic_information;
                $data['permanent_address'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->permanent_address;
                $data['family_info'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->family_info;
                $data['additional_personal_details'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->additional_personal_details;
                $data['partner_expectation'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->partner_expectation;
                $data['interest'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->interest;
                $data['short_list'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->short_list;
                $data['followed'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->followed;
                $data['ignored'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->ignored;
                $data['ignored_by'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->ignored_by;
                $data['gallery'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->gallery;
                $data['happy_story'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->happy_story;
                $data['package_info'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->package_info;
                $data['payments_info'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->payments_info;
                $data['interested_by'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->interested_by;
                $data['follower'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->follower;
                $data['membership'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->membership;
                $data['notifications'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->notifications;
                $data['profile_status'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->profile_status;
                $data['member_since'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->member_since;
                $data['express_interest'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->express_interest;
                $data['direct_messages'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->direct_messages;
                $data['photo_gallery'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->photo_gallery;
                $data['profile_completion'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->profile_completion;
                $data['is_blocked'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->is_blocked;
                $data['privacy_status'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->privacy_status;
                $data['pic_privacy'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->pic_privacy;
                $data['display_member'] = $this->db->get_where("deleted_member", array("member_id" => $para1))->row()->display_member;

                $this->db->insert('member', $data);

                $this->db->where('member_id', $para1);
                $result = $this->db->delete('deleted_member');
                recache();
        }

        function member_block($para1, $para2)
        {
            if ($para1 == 'no') {
                    $data['is_blocked'] = 'yes';
                    $this->session->set_flashdata('alert', 'block');
            } elseif ($para1 == 'yes') {
                    $data['is_blocked'] = 'no';
                    $email = $this->Crud_model->get_type_name_by_id('member', $para2, 'email');
                    $this->Email_model->account_activation($email);
                    $this->session->set_flashdata('alert', 'unblock');
            }

            $this->db->where('member_id', $para2);
            $this->db->update('member', $data);
            recache();
        }

        function member_switch($newPackage, $member_id)
        {
            if ($newPackage == 'disabled') 
            {
                $this->soft_delete_member($member_id);
            }
            elseif ($newPackage == 'deleted') 
            {
                $this->session->unset_userdata('login_state');
                $this->session->unset_userdata('member_id');
                $this->session->unset_userdata('member_name');
                $this->session->unset_userdata('member_email');

                $this->db->query("DELETE FROM message WHERE message_from = $member_id OR message_to = $member_id");
                $this->db->query("DELETE FROM message_thread WHERE message_thread_from = $member_id OR message_thread_to = $member_id");

                $m_members = $this->db->where('u_id',$member_id)->get('im_group_members')->result();
                foreach ($m_members as $value) {
                    $g_id = $value->g_id;
                    $this->db->query("DELETE FROM im_group_relation WHERE g_id = $g_id");
                    $this->db->query("DELETE FROM im_message WHERE receiver = $g_id");
                    $this->db->query("DELETE FROM im_receiver WHERE g_id = $g_id");
                    $this->db->query("DELETE FROM im_group WHERE g_id = $g_id");
                    $this->db->query("DELETE FROM im_group_members WHERE g_id = $g_id");

                }


                $tables = array('member', 'gallery_items');
                $this->db->where('member_id', $member_id);
                $this->db->delete($tables);

            }
            elseif($newPackage == 3 || $newPackage == 4)
            {
                $data['membership'] = $newPackage;
                $data['photo_gallery'] = 3;
                $this->db->where('member_id', $member_id);
                $this->db->update('member', $data);
            } 
            else 
            {
                $data['membership'] = $newPackage;
                $data['photo_gallery'] = 1;
                $this->db->where('member_id', $member_id);
                $this->db->update('member', $data);
            }
                
            recache();
            echo "true";
        }

        function switchDeletedMember($newPackage, $member_id)
        {
            $this->db->where('member_id', $member_id);
            $this->db->delete('deleted_member');
            
            if($newPackage == 3 || $newPackage == 4)
            {
                $data['is_deleted'] = 0;
                $data['membership'] = $newPackage;
                $data['photo_gallery'] = 3;
                $this->db->where('member_id', $member_id);
                $this->db->update('member', $data);
            }
            elseif ($newPackage == 'deleted') 
            {
                // $this->session->unset_userdata('login_state');
                // $this->session->unset_userdata('member_id');
                // $this->session->unset_userdata('member_name');
                // $this->session->unset_userdata('member_email');

                $this->db->query("DELETE FROM message WHERE message_from = $member_id OR message_to = $member_id");
                $this->db->query("DELETE FROM message_thread WHERE message_thread_from = $member_id OR message_thread_to = $member_id");

                $tables = array('member', 'gallery_items');
                $this->db->where('member_id', $member_id);
                $this->db->delete($tables);
            }
            else
            {
                $data['is_deleted'] = 0;
                $data['membership'] = $newPackage;
                $data['photo_gallery'] = 1;
                $this->db->where('member_id', $member_id);
                $this->db->update('member', $data);
            }

            recache();
            echo "true";
        }

        function setFakeMemberMessage()
        {
            $memberId = $_POST['memberId'];
            $message1 = $_POST['message1'];
            $message2 = $_POST['message2'];

            if ($message1 != "") {
                $data['member_id'] = $memberId;
                $data['message'] = $message1;
                $data['message_no'] = 1;
                $this->db->insert('fake_member_message', $data);
            }

            if ($message2 != "") {
                $data1['member_id'] = $memberId;
                $data1['message'] = $message2;
                $data1['message_no'] = 2;
                $this->db->insert('fake_member_message', $data1);
            }

            recache();
            echo "true";
        }

        function soft_delete_member($member_id)
        {
            // Set is_deleted flag 1 in member table
            $this->db->query('UPDATE member SET is_deleted = 1 WHERE member_id = '.$member_id);

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

        function member_delete($para1)
        {
            // $row = $this->db->get_where('is_deleted', array(
            //     'member_id' => $para1
            // ))->row()->is_deleted;

            //if ($row == 1) {
                $data['member_id'] = $para1;
                $data['member_profile_id'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'member_profile_id');
                $data['first_name'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'first_name');
                $data['last_name'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'last_name');
                $data['gender'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'gender');
                $data['email'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'email');
                $data['mobile'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'mobile');
                $data['is_closed'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'is_closed');
                $data['date_of_birth'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'date_of_birth');
                $data['height'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'height');
                $data['password'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'password');
                $data['profile_image'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'profile_image');
                $data['introduction'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'introduction');
                $data['basic_info'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'basic_info');
                $data['present_address'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'present_address');
                $data['education_and_career'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'education_and_career');
                $data['physical_attributes'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'physical_attributes');
                $data['language'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'language');
                $data['hobbies_and_interest'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'hobbies_and_interest');
                $data['personal_attitude_and_behavior'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'personal_attitude_and_behavior');
                $data['residency_information'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'residency_information');
                $data['spiritual_and_social_background'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'spiritual_and_social_background');
                $data['life_style'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'life_style');
                $data['astronomic_information'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'astronomic_information');
                $data['permanent_address'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'permanent_address');
                $data['family_info'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'family_info');
                $data['additional_personal_details'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'additional_personal_details');
                $data['partner_expectation'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'partner_expectation');
                $data['interest'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'interest');
                $data['short_list'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'short_list');
                $data['followed'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'followed');
                $data['ignored'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'ignored');
                $data['ignored_by'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'ignored_by');
                $data['gallery'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'gallery');
                $data['happy_story'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'happy_story');
                $data['package_info'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'package_info');
                $data['payments_info'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'payments_info');
                $data['interested_by'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'interested_by');
                $data['follower'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'follower');
                $data['membership'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'membership');
                $data['notifications'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'notifications');
                $data['profile_status'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'profile_status');
                $data['member_since'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'member_since');
                $data['express_interest'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'express_interest');
                $data['direct_messages'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'direct_messages');
                $data['photo_gallery'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'photo_gallery');
                $data['profile_completion'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'profile_completion');
                $data['is_blocked'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'is_blocked');
                $data['privacy_status'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'privacy_status');
                $data['pic_privacy'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'pic_privacy');
                $data['display_member'] = $this->Crud_model->get_type_name_by_id('member', $para1, 'display_member');
                //expire the session here
                // $this->load->library('session');
                // $this->session->unset_userdata('login_state');
                // $this->session->sess_destroy();

                $this->db->insert('deleted_member', $data);
                $this->db->where('member_id', $para1);
                // $result = $this->db->delete('member');
                recache();

                // if ($result) {
                //     $this->session->set_flashdata('alert', 'delete');

                //     //log the current user out and redirect to login or register page
                //     // redirect(base_url() . 'home/login', 'refresh');

                // } else {
                //     $this->session->set_flashdata('alert', 'failed_delete');
                // }
            //}
        }

        function delete_deleted_member($para1)
        {
                $this->db->where('member_id', $para1);
                $result = $this->db->delete('deleted_member');
                recache();
                if ($result) {
                        $this->session->set_flashdata('alert', 'delete');
                } else {
                        $this->session->set_flashdata('alert', 'failed_delete');
                }
        }

        function send_email($para1)
        {
                $date = date('Y-m-d H:i:s');
                $data['member_profile_id'] = $para1;
                $data['email_sent'] = 1;
                $data['type'] = 1;
                $data['email_date'] = $date;

                $this->db->insert('member_email', $data);


                $query = $this->db->get_where('email_template', array(
                        'email_template_id' => 6
                ))->row();

                $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                $email_body = $query->body;

                $email = $this->db->get_where('deleted_member', array(
                        'member_id' => $para1
                ))->row()->email;

                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;

                if ($protocol == 'smtp') {
                        $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                } else if ($protocol == 'mail') {
                        $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
                }

                $system_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
                echo "test";
                $this->Email_model->do_email($from, $system_name, $email, $query->subject, $email_body);
                //	$this->session->set_flashdata('alert', 'delete');

        }


        function send_no_pic_email($para1)
        {
                $date = date('Y-m-d H:i:s');
                $data['member_profile_id'] = $para1;
                $data['email_sent'] = 1;
                $data['type'] = 2;
                $data['email_date'] = $date;

                $this->db->insert('member_email', $data);


                $query = $this->db->get_where('email_template', array(
                        'email_template_id' => 7
                ))->row();

                $email_row = $this->db->get_where('member', array(
                        'member_id' => $para1
                ))->row();
                $email = $email_row->email;

                $email_body = $query->body;

                $to_name = $email_row->first_name . ' ' . $email_row->last_name;


                $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                $email_body = str_replace('[[to]]', $to_name, $email_body);

                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;

                if ($protocol == 'smtp') {
                        $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                } else if ($protocol == 'mail') {
                        $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
                }

                $system_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;

                $this->Email_model->do_email($from, $system_name, $email, $query->subject, $email_body);
        }


        function send_incomplete_profile_email($para1)
        {
                $date = date('Y-m-d H:i:s');
                $data['member_profile_id'] = $para1;
                $data['email_sent'] = 1;
                $data['type'] = 3;
                $data['email_date'] = $date;

                $this->db->insert('member_email', $data);


                $query = $this->db->get_where('email_template', array(
                        'email_template_id' => 8
                ))->row();

                $email_row = $this->db->get_where('member', array(
                        'member_id' => $para1
                ))->row();
                $email = $email_row->email;

                $email_body = $query->body;

                $to_name = $email_row->first_name . ' ' . $email_row->last_name;


                $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                $email_body = str_replace('[[to]]', $to_name, $email_body);

                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;

                if ($protocol == 'smtp') {
                        $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                } else if ($protocol == 'mail') {
                        $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
                }

                $system_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;

                $this->Email_model->do_email($from, $system_name, $email, $query->subject, $email_body);
        }

        function send_both_no_email($para1)
        {
                $date = date('Y-m-d H:i:s');
                $data['member_profile_id'] = $para1;
                $data['email_sent'] = 1;
                $data['type'] = 4;
                $data['email_date'] = $date;

                $this->db->insert('member_email', $data);


                $query = $this->db->get_where('email_template', array(
                        'email_template_id' => 9
                ))->row();



                $email_row = $this->db->get_where('member', array(
                        'member_id' => $para1
                ))->row();
                $email = $email_row->email;

                $email_body = $query->body;

                $to_name = $email_row->first_name . ' ' . $email_row->last_name;


                $email_body = str_replace('[[base_url]]', base_url(), $email_body);
                $email_body = str_replace('[[to]]', $to_name, $email_body);

                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;

                if ($protocol == 'smtp') {
                        $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                } else if ($protocol == 'mail') {
                        $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
                }

                $system_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;

                $this->Email_model->do_email($from, $system_name, $email, $query->subject, $email_body);
        }


        function member_package_modal($member_id)
        {
                $page_data['member_id'] = $member_id;

                $this->load->view('back/members/package_modal', $page_data);
        }

        function stories($para1 = "", $para2 = "", $para3 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "stories/index.php";
                                $page_data['folder'] = "stories";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "stories/index.php";
                                $page_data['page_name'] = "stories";
                                if ($this->session->flashdata('alert') == "approve") {
                                        $page_data['success_alert'] = translate("you_have_successfully_approved_the_story!");
                                } elseif ($this->session->flashdata('alert') == "unpublish") {
                                        $page_data['danger_alert'] = translate("you_have_successfully_unpublished_the_story!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => '',
                                        1 => 'title',
                                        2 => 'post_time',
                                        3 => 'member_name',
                                        4 => 'partner_name',
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'happy_story';

                                $totalData = $this->Crud_model->alldata_count($table);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->allstories($table, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $rows =  $this->Crud_model->story_search($table, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->story_search_count($table, $search);
                                }
                                $data = array();
                                if (!empty($rows)) {
                                        // if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
                                        foreach ($rows as $row) {
                                                $image = json_decode($row->image, true);
                                                if (file_exists('uploads/happy_story_image/' . $image[0]['thumb'])) {
                                                        $story_image = "<img src='" . base_url() . "uploads/happy_story_image/" . $image[0]['thumb'] . "' class='img-sm'>";
                                                } else {
                                                        $story_image = "<img src='" . base_url() . "uploads/happy_story_image/default_image.jpg' class='img-sm'>";
                                                }
                                                if ($row->approval_status == 1) {
                                                        $approve_button = "<button data-target='#approval_modal' data-toggle='modal' class='btn btn-dark btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('unpublish') . "'onclick='approval(" . $row->approval_status . ", " . $row->happy_story_id . ")'><i class='fa fa-close'></i></button>
							";
                                                } elseif ($row->approval_status == 0) {
                                                        $approve_button = "<button data-target='#approval_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('approve') . "'onclick='approval(" . $row->approval_status . ", " . $row->happy_story_id . ")'><i class='fa fa-check'></i></button>
							";
                                                }

                                                $nestedData['image'] = $story_image;
                                                $nestedData['title'] = $row->title;
                                                $nestedData['date'] = date('d/m/Y H:i:s A', strtotime($row->post_time));
                                                $nestedData['member_name'] = $row->member_name;
                                                $nestedData['partner_name'] = $row->partner_name;
                                                $nestedData['options'] = $approve_button . "<a href='" . base_url() . "admin/stories/view_story/" . $row->happy_story_id . "' id='demo-dt-view-btn' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('view') . "' ><i class='fa fa-eye'></i></a>
		               		<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('delete') . "' onclick='delete_story(" . $row->happy_story_id . ")'><i class='fa fa-trash'></i></button>";

                                                $data[] = $nestedData;
                                                // if ($dir == 'asc') { $i++; } elseif ($dir == 'desc') { $i--; }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "approval") {
                                if ($para2 == 0) {
                                        $data['approval_status'] = 1;
                                        $this->session->set_flashdata('alert', 'approve');
                                } elseif ($para2 == 1) {
                                        $data['approval_status'] = 0;
                                        $this->session->set_flashdata('alert', 'unpublish');
                                }
                                $this->db->where('happy_story_id', $para3);
                                $this->db->update('happy_story', $data);
                                recache();
                        } elseif ($para1 == "view_story") {
                                $page_data['top'] = "stories/stories.php";
                                $page_data['folder'] = "stories";
                                $page_data['file'] = "view_story.php";
                                $page_data['bottom'] = "stories/stories.php";
                                $page_data['get_story'] = $this->db->get_where("happy_story", array("happy_story_id" => $para2))->result();
                                $page_data['page_name'] = "stories";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "delete") {
                                $img =  $this->db->get_where("happy_story", array("happy_story_id" => $para2))->row()->image;
                                $img = json_decode($img, true);
                                unlink('uploads/happy_story_image/' . $img[0]['img']);
                                unlink('uploads/happy_story_image/' . $img[0]['thumb']);
                                $video_exist = $this->db->get_where("story_video", array("story_id" => $para2))->result();
                                if ($video_exist) {
                                        $vid_type = $this->db->get_where("story_video", array("story_id" => $para2))->row()->type;
                                        if ($vid_type == 'upload') {
                                                $video_src = $this->db->get_where("story_video", array("story_id" => $para2))->row()->video_src;
                                                unlink($video_src);
                                        }
                                        $this->db->where('story_id', $para2);
                                        $this->db->delete('story_video');
                                }
                                $this->db->where('happy_story_id', $para2);
                                $result = $this->db->delete('happy_story');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function send_sms($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top']                 = "send_sms/index.php";
                                $page_data['folder']         = "send_sms";
                                $page_data['file']                 = "index.php";
                                $page_data['bottom']        = "send_sms/index.php";
                                $page_data['page_name'] = "send_sms";

                                if ($this->session->flashdata('alert') == "sms_success") {
                                        $page_data['success_alert'] = translate("sms_sent_successfully!");
                                } elseif ($this->session->flashdata('alert') == "sms_failed") {
                                        $page_data['danger_alert'] = translate("no_mobile_number_found_to_send_sms!");
                                }

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "do_send") {
                                $send_by                 = $this->input->post('send_by');
                                $members_type         = $this->input->post('member');
                                $message                 = $this->input->post('msg');

                                if ($members_type == 'free') {
                                        $this->db->select('mobile');
                                        $this->db->where('mobile IS NOT NULL', null, false);
                                        $this->db->where('membership', 1);
                                } elseif ($members_type == 'premium') {
                                        $this->db->select('mobile');
                                        $this->db->where('mobile IS NOT NULL', null, false);
                                        $this->db->where('membership', 2);
                                } elseif ($members_type == 'all') {
                                        $this->db->select('mobile');
                                        $this->db->where('mobile IS NOT NULL', null, false);
                                }

                                $recievers_phone = $this->db->get('member')->result_array();
                                if (!empty($recievers_phone)) {
                                        if ($send_by == 'twilio') {
                                                $this->load->model('sms_model');

                                                foreach ($recievers_phone as $reciever_phone) {

                                                        $this->sms_model->send_sms_via_twilio($message, $reciever_phone['mobile']);
                                                }
                                        } elseif ($send_by == 'msg91') {
                                                $this->load->model('sms_model');

                                                foreach ($recievers_phone as $reciever_phone) {

                                                        $this->sms_model->send_sms_via_msg91($message, $reciever_phone['mobile']);
                                                }
                                        }
                                        $this->session->set_flashdata('alert', 'sms_success');
                                        // redirect(base_url().'admin/send_sms', 'refresh');
                                } else {
                                        $this->session->set_flashdata('alert', 'sms_failed');
                                        // redirect(base_url().'admin/send_sms', 'refresh');
                                }
                        }
                }
        }

       function earnings($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } 
                else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "earnings/index.php";
                                $page_data['folder'] = "earnings";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "earnings/index.php";
                                $page_data['page_name'] = "earnings";

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'member_id',
                                        1 => 'package',
                                        2 => 'billing_cycle',
                                        3 => 'invoice_no',
                                        4 => 'amount',
                                        5 => 'down_graded',
                                        6 => 'status',
                                        7 => 'payment_process_date',
                                        8 => 'due_date',
                                        9 => 'next_billing_date',
                                        10 => 'switch',
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'earning';

                                $totalData = $this->Crud_model->alldata_count($table);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->allearnings($table, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $rows =  $this->Crud_model->earning_search($table, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->earning_search_count($table, $search);
                                }

                                $data = array();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $key => $row) {
                                                // $nestedData['#'] = $i;
                                                // $nestedData['member_name'] = $row->member_first_name . ' ' . $row->member_last_name;
                                                // print_r($row);exit;
                                                $nestedData['member_id'] = $row->display_member;
                                                $nestedData['member_id'] = $row->member_id;
                                                if ($row->member_first_name == "") {
                                                    $nestedData['member_name'] = ucfirst($row->dltd_member_first_name) . ' ' . ucfirst($row->dltd_member_last_name); 
                                                }
                                                else
                                                {
                                                    $nestedData['member_name'] = ucfirst($row->member_first_name) . ' ' . ucfirst($row->member_last_name);
                                                }
                                                $nestedData['package'] = $row->package;
                                                $nestedData['billing_cycle'] = $row->billing_cycle;
                                                $nestedData['invoice_no'] = $row->invoice_no;
                                                $nestedData['amount'] = currency('', 'def') . $row->amount;

                                                $er_package = $row->package;
                                                $membership = $this->Crud_model->get_type_name_by_id('member', $row->member_id, 'membership');
                                                    if ($membership == 1) {
                                                        $package = "Bronze";
                                                    }
                                                    elseif ($membership == 2) {
                                                        $package = "Platinum";
                                                    }
                                                    elseif ($membership == 3) {
                                                        $package = "Free";
                                                    }
                                                if ($row->remove_member == '') {
                                        
                                                $nestedData['down_graded'] ="<span style = 'color: green'>Deleted<span>";
                                                }else{

                                                   if ($er_package == 'Platinum') {
                                                        if ($package == 'Platinum') {
                                                           $nestedData['down_graded']="<span style = 'color: green'>Active<span>";
                                                        }elseif($package == 'Bronze'){

                                                           $nestedData['down_graded']="<span style = 'color: red'>Downgraded<span>";
                                                        }else{
                                                          
                                                           $nestedData['down_graded']="<span style = 'color: red'>Downgraded<span>";
                                                        }
                                                      
                                                   }elseif($er_package == 'Bronze'){
                                                        if ($package == 'Platinum') {
                                                           $nestedData['down_graded']="<span style = 'color: red'>Upgraded<span>";
                                                        }elseif($package == 'Bronze'){

                                                           $nestedData['down_graded']="<span style = 'color: red'>Active<span>";
                                                        }else{
                                                          
                                                           $nestedData['down_graded']="<span style = 'color: red'>Downgraded<span>";
                                                        }

                                                   }else{
                                                        if ($package == 'Platinum') {
                                                           $nestedData['down_graded']="<span style = 'color: red'>Upgraded<span>";
                                                        }elseif($package == 'Bronze'){

                                                           $nestedData['down_graded']="<span style = 'color: red'>Upgraded<span>";
                                                        }else{
                                                          
                                                           $nestedData['down_graded']="<span style = 'color: red'>Active<span>";
                                                        }
                                                   }

                                                }

                                                if ($row->status == "active") {
                                                    $status = "<span style = 'color: green'>".$row->status."</span>";
                                                }
                                                elseif ($row->status == "incomplete") {
                                                    $status = "<span style = 'color: orange'>".$row->status."</span>";
                                                }
                                                elseif ($row->status == "canceled"){
                                                    $status = "<span style = 'color: red'>".$row->status."</span>";
                                                }
                                                //$nestedData['status'] = $status;
                                                $nestedData['payment_process_date'] = "<span class='paymentProcessDate".$key."'>" .$row->payment_process_date."</span><script type='text/javascript'>paymentProcessFunc('".$row->payment_process_date. "', ".$key.");</script>";
                                                $nestedData['due_date'] = "<span class='dueDate".$key."'>" .$row->due_date."</span><script type='text/javascript'>dueDateFunc('".$row->due_date. "', ".$key.");</script>";
                                                $nestedData['next_billing_date'] = "<span class='nextBillingDate".$key."'>" .$row->next_billing_date."</span><script type='text/javascript'>nextBillingFunc('".$row->next_billing_date. "', ".$key.");</script>";

                                                $switch_button_earning = "<button data-target='#switch_modal' data-toggle='modal' class='btn btn-success btn-sm add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('switch_member') . "' onclick='switchMember(" . $row->member_id . ")'><i class='fa fa-exchange'></i></button>";
                                                $nestedData['switch'] = "<select class='form-control' id='switchPackageTo_".$row->member_id."'>
                                                                <option value='1'>Bronze</option>
                                                                <option value='3'>Free</option>
                                                                <option value='4'>Fake</option>
                                                                <option value='disabled'>Disabled</option>
                                                                <option value='deleted'>Delete</option>
                                                        </select>" . $switch_button_earning;

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "view_detail") {
                                $details = $this->db->get_where('package_payment', array('package_payment_id' => $para2))->row()->payment_details;
                                if ($details != 'none') {
                                        echo $details;
                                } else {
                                        echo "<center>" . translate('no_details_available') . "</center>";
                                }
                        } elseif ($para1 == "delete") {

                                $this->db->where('package_payment_id', $para2);
                                $result = $this->db->delete('package_payment');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function ads_earnings($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } 
                else {

                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "earnings/index.php";
                                $page_data['folder'] = "ads_earnings";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "earnings/index.php";
                                $page_data['page_name'] = "ads_earnings";

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'ads_id',
                                        1 => 'ads_unique_id',
                                        2 => 'name_of_business',
                                        3 => 'payment_by',
                                        4 => 'amount',
                                        5 => 'billing_date',
                                        6 => 'status',
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'advertisements';

                                $totalData = $this->Crud_model->alldata_count($table);
                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->ads_allearnings($limit, $start, $order, $dir);
                                        // echo "<pre>";
                                        // print_r($rows);die();
                                } else {
                                        $search = $this->input->post('search')['value'];
                                        $rows =  $this->Crud_model->search_ads_allearnings($limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->search_ads_allearnings_count($search);
                                }

                                $data = array();
                                //echo "<pre>";print_r($rows);die();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $key => $row) {
                                                $nestedData['#'] = $i;
                                                // $nestedData['member_name'] = $row->member_first_name . ' ' . $row->member_last_name;
                                                // print_r($row);exit;
                                                $nestedData['ads_id'] = "Ads_".$row->advertisements_id;
                                                $nestedData['ads_unique_id'] = $row->unique_id;
                                                
                                                $nestedData['name_of_business'] = $row->title;
                                                $nestedData['billing_date'] = date('M-d-Y',strtotime($row->payment_date));
                                                $nestedData['amount'] = currency('', 'def') . $row->amount;

                                                $nestedData['payment_by'] =ucfirst($row->payment_by);
                                                $ads_status = $row->status;
                                                if ($ads_status == 0) {
                                                     $status = "<span style = 'color: green'>Active</span>";
                                                }elseif ($ads_status == 3) {
                                                    $status = "<span style = 'color: gray'>Pending</span>";
                                                }elseif ($ads_status == 4) {
                                                    $status = "<span style = 'color: red'>Reject</span>";
                                                }elseif ($ads_status == 5) {
                                                    $status = "<span style = 'color: gray'>Expired</span>";
                                                }
                                                $nestedData['status'] = $status;

                                                // $er_package = $row->package;
                                                
                                                // if ($row->status == "active") {
                                                //     $status = "<span style = 'color: green'>".$row->status."</span>";
                                                // }
                                                // elseif ($row->status == "incomplete") {
                                                //     $status = "<span style = 'color: orange'>".$row->status."</span>";
                                                // }
                                                // elseif ($row->status == "canceled"){
                                                //     $status = "<span style = 'color: red'>".$row->status."</span>";
                                                // }
                                                

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "view_detail") {
                                $details = $this->db->get_where('package_payment', array('package_payment_id' => $para2))->row()->payment_details;
                                if ($details != 'none') {
                                        echo $details;
                                } else {
                                        echo "<center>" . translate('no_details_available') . "</center>";
                                }
                        } elseif ($para1 == "delete") {

                                $this->db->where('package_payment_id', $para2);
                                $result = $this->db->delete('package_payment');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }


       function coverPic_earnings($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } 
                else {

                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "earnings/index.php";
                                $page_data['folder'] = "coverPic_earning";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "earnings/index.php";
                                $page_data['page_name'] = "coverPic_earnings";

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'member_id',
                                        1 => 'member',
                                        2 => 'payment_by',
                                        3 => 'amount',
                                        4 => 'payment_date',
                                        5 => 'expired_date',
                                        6 => 'status',
                                        7 => 'invoice_no',

                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'cover_pics';

                                $totalData = $this->Crud_model->alldata_count($table);
                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->coverpic_allearnings($limit, $start, $order, $dir);
                                       //echo "<pre>";
                                       //print_r($rows);die();
                                } else {
                                        $search = $this->input->post('search')['value'];
                                        $rows =  $this->Crud_model->search_coverpic_allearnings($limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->count_search_coverpic_allearnings($search);
                                }

                                $data = array();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $key => $row) {
                                                $nestedData['#'] = $i;
                                                $nestedData['picture_id'] = $row->payment_id;
                                                $nestedData['member_id']  = $row->member_id;
                                                $nestedData['member'] = ucfirst($row->first_name).' '.ucfirst($row->last_name);
                                                $nestedData['payment_date'] = date('M-d-Y',strtotime($row->payment_date));
                                                $nestedData['expired_date'] = date('M-d-Y',strtotime($row->expired_date));


                                                $nestedData['amount'] = currency('', 'def') . $row->amount;

                                                $nestedData['payment_by'] =ucfirst($row->payment_by);
                                                $ads_status = $row->expired_date;

                                                $five_days_minus_timestamp = date('Y-m-d', strtotime("-5 days"));

                                                $today = date('Y-m-d');
                                                if ($ads_status < $five_days_minus_timestamp) {
                                                     $status = "<span style = 'color: green'>Deleted</span>";
                                                }elseif ($ads_status < $today) {
                                                    $status = "<span style = 'color: green'>Expired</span>";
                                                }else{
                                                 $status = "<span style = 'color: red'>Active</span>";   
                                                }
                                                $nestedData['status'] = $status;
                                                $nestedData['invoice_no'] = substr($row->trns_id,0,15);

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "view_detail") {
                                $details = $this->db->get_where('package_payment', array('package_payment_id' => $para2))->row()->payment_details;
                                if ($details != 'none') {
                                        echo $details;
                                } else {
                                        echo "<center>" . translate('no_details_available') . "</center>";
                                }
                        } elseif ($para1 == "delete") {

                                $this->db->where('package_payment_id', $para2);
                                $result = $this->db->delete('package_payment');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        

        function picture_video_approval($para1 = "", $para2 = "")
        {
            // print_r($para1);exit;
            if ($this->admin_permission() == FALSE) {
                    redirect(base_url() . 'admin/login', 'refresh');
            } 
            else 
            {
                $page_data['title'] = "Admin || " . $this->system_title;
                if ($para1 == "") {
                        $page_data['top'] = "picture_video_approval/index.php";
                        $page_data['folder'] = "picture_video_approval";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "picture_video_approval/index.php";
                        $page_data['page_name'] = "picture_video_approval";

                        $this->load->view('back/index', $page_data);
                } 
                elseif ($para1 == "list_data") {
                        $columns = array(
                                0 => 'member_id',
                                1 => 'member_name',
                                2 => 'member_since',
                                3 => 'package',
                                4 => 'type',
                                5 => 'actions',
                                6 => 'request_submitted',
                        );
                        $limit = $this->input->post('length');
                        $start = $this->input->post('start');
                        $order = $columns[$this->input->post('order')[0]['column']];
                        $dir = $this->input->post('order')[0]['dir'];
                        $table = 'gallery_items';

                        $resultArr = array();
                        $profile_image = $this->db->query("SELECT member_id,first_name, last_name, profile_image, profile_img_uploaded_date, member_since, display_member, 'profile_image' as `type`, 'none' as item_id , is_profile_img_approved from member WHERE is_profile_img_approved = 2")->result();
                        for ($i=0; $i <count($profile_image) ; $i++) { 
                            if($profile_image[$i]->is_profile_img_approved != ""){
                                array_push($resultArr, $profile_image[$i]);
                            }
                            $member_ids = $profile_image[$i]->member_id;
                            
                        }
                        $gallery_data = $this->db->query("SELECT m.member_id,m.first_name, m.last_name, m.display_member,g.item_id, g.item_name, g.uploaded_date AS profile_img_uploaded_date, m.member_since, g.item_type AS `type` FROM gallery_items AS g 
                                LEFT JOIN member AS m ON m.member_id = g.member_id WHERE  g.`is_approved` = 2")->result();
                        //     echo "<pre>";
                        // print_r($gallery_data);exit;
                        for($j=0; $j <count($gallery_data) ; $j++){
                            array_push($resultArr, $gallery_data[$j]);
                        }

                        $totalData = count($resultArr);

                        $totalFiltered = count($resultArr);

                        if (empty($this->input->post('search')['value'])) {
                                $rows = $resultArr;
                        } else {
                                $search = $this->input->post('search')['value'];

                                $rows =  $resultArr;;

                                $totalFiltered = count($resultArr);
                        }

                        $data = array();
                        if (!empty($rows)) {
                                if ($dir == 'asc') {
                                        $i = $start + 1;
                                } elseif ($dir == 'desc') {
                                        $i = $totalFiltered - $start;
                                }
                                foreach ($rows as $row) {
                                    // print_r($row);
                                    if ($row->type == "profile_image") {
                                        $profile_image = $this->Crud_model->get_type_name_by_id('member',$row->member_id , 'profile_image');
                                        $path = base_url()."uploads/profile_image_main/".$row->member_id."/".$profile_image.'?'.rand(999,99999999);
                                    }
                                    elseif ($row->type == "gallery_image") {
                                        $path = base_url()."uploads/gallery_image/".$row->member_id."/".$row->item_name.'?'.rand(999,99999999);
                                    }
                                    elseif ($row->type == "gallery_video") {
                                        $path = base_url()."video/".$row->member_id."/".$row->item_name.'?'.rand(999,99999999);
                                    }

                                    $approve_button = "<button data-target='#approve_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('approve') . "' onclick='approve(1, " . $row->member_id . ", \"" . $row->type . "\", \"" . $row->item_id . "\")'><i class='fa fa-check'></i></button>";
                                    $reject_button = "<button data-target='#reject_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('reject') . "' onclick='reject(3, " . $row->member_id . ", \"" . $row->type . "\", \"" . $row->item_id . "\")'><i class='fa fa-ban'></i></button>";
                                    $preview_button = "<a href='".$path."' target='_blank' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title= '" . translate('preview') . "'><i class='fa fa-eye'></i></a>";

                                    $nestedData['member_id'] = $row->display_member;
                                    $nestedData['member_name'] = ucfirst($row->first_name) . ' ' . ucfirst($row->last_name);
                                    $nestedData['member_since'] = date('m/d/yy', strtotime($row->member_since));
                                    $membership = $this->Crud_model->get_type_name_by_id('member', $row->member_id, 'membership');
                                    if ($membership == 1) {
                                        $package = "Bronze";
                                    }
                                    elseif ($membership == 2) {
                                        $package = "Platinum";
                                    }
                                    elseif ($membership == 3) {
                                        $package = "Free";
                                    }
                                    elseif ($membership == 4) {
                                        $package = "Fake";
                                    }
                                    $nestedData['package'] = $package;
                                    $nestedData['type'] = translate($row->type);
                                    $nestedData['actions'] = $preview_button . $approve_button . $reject_button;
                                    $nestedData['request_submitted'] = date('m/d/yy', strtotime($row->profile_img_uploaded_date));

                                    $data[] = $nestedData;
                                    if ($dir == 'asc') {
                                            $i++;
                                    } elseif ($dir == 'desc') {
                                            $i--;
                                    }
                                }
                        }

                        $json_data = array(
                                "draw"            => intval($this->input->post('draw')),
                                "recordsTotal"    => intval($totalData),
                                "recordsFiltered" => intval($totalFiltered),
                                "data"            => $data
                        );
                        echo json_encode($json_data);
                }
            }
        }
        function contact_messages($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "contact_messages/index.php";
                                $page_data['folder'] = "contact_messages";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "contact_messages/index.php";
                                $page_data['page_name'] = "contact_messages";

                                if ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_this_message!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_this_message!");
                                } elseif ($this->session->flashdata('alert') == "sent") {
                                        $page_data['success_alert'] = translate("you_have_successfully_replied_this_message!");
                                }

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'contact_message_id',
                                        1 => 'name',
                                        2 => 'subject',
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'contact_message';

                                $totalData = $this->Crud_model->alldata_count($table);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->allcontact_messages($table, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $rows =  $this->Crud_model->contact_message_search($table, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->contact_message_search_count($table, $search);
                                }

                                $data = array();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $row) {
                                                if ($row->reply != '') {
                                                        $stat_txt = "<center><span class='badge badge-success'>" . translate('replied') . "</span></center>";
                                                } else {
                                                        $stat_txt = "<center><span class='badge badge-danger'>" . translate('not_replied') . "</span></center>";
                                                }

                                                $nestedData['#'] = $i;
                                                $nestedData['name'] = $row->name;
                                                $nestedData['subject'] = $row->subject;
                                                $nestedData['date'] = date('d/m/Y H:i A', $row->timestamp);
                                                $nestedData['status'] = $stat_txt;
                                                $nestedData['options'] = "<a href='" . base_url() . "admin/contact_messages/view_message/" . $row->contact_message_id . "' id='demo-dt-view-btn' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='View Message' ><i class='fa fa-eye'></i></a>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('delete') . "' onclick='delete_message(" . $row->contact_message_id . ")'><i class='fa fa-trash'></i></button>";

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "view_message") {
                                $page_data['top'] = "contact_messages/contact_messages.php";
                                $page_data['folder'] = "contact_messages";
                                $page_data['file'] = "view_message.php";
                                $page_data['bottom'] = "contact_messages/contact_messages.php";
                                $page_data['get_message'] = $this->db->get_where("contact_message", array("contact_message_id" => $para2))->result();
                                $page_data['page_name'] = "contact_messages";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "reply_message") {
                                $page_data['top'] = "contact_messages/contact_messages.php";
                                $page_data['folder'] = "contact_messages";
                                $page_data['file'] = "reply_message.php";
                                $page_data['bottom'] = "contact_messages/contact_messages.php";
                                $page_data['get_message'] = $this->db->get_where("contact_message", array("contact_message_id" => $para2))->result();
                                $page_data['page_name'] = "contact_messages";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == 'update_reply_message') {
                                $data['reply'] = $this->input->post('reply_message');
                                $this->db->where('contact_message_id', $para2);
                                $this->db->update('contact_message', $data);
                                $this->db->order_by('contact_message_id', 'desc');
                                recache();
                                $query = $this->db->get_where('contact_message', array(
                                        'contact_message_id' => $para2
                                ))->row();

                                $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
                                if ($protocol == 'smtp') {
                                        $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
                                } else if ($protocol == 'mail') {
                                        $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
                                }

                                $system_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;

                                $this->Email_model->do_email($from, $system_name, $query->email, 'RE: ' . $query->subject, $data['reply']);

                                $this->session->set_flashdata('alert', 'sent');
                                redirect(base_url() . 'admin/contact_messages', 'refresh');
                        } elseif ($para1 == "delete") {
                                $this->db->where('contact_message_id', $para2);
                                $result = $this->db->delete('contact_message');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function knowledge_base($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "knowledge_base/index.php";
                        $page_data['folder'] = "knowledge_base";
                        $page_data['bottom'] = "knowledge_base/index.php";
                        if ($para1 == "documentations") {
                                $page_data['page_name'] = "documentations";
                                $page_data['file'] = "documentations/index.php";

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "structural_info") {
                                $page_data['page_name'] = "structural_info";
                                $page_data['file'] = "structural_info/index.php";

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "how_to") {
                                $page_data['page_name'] = "how_to";
                                $page_data['file'] = "how_to/index.php";

                                $this->load->view('back/index', $page_data);
                        }
                }
        }

        function religion($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/religion";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $page_data['all_religions'] = $this->db->get("religion")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "religion";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_religion") {
                                $this->load->view('back/member_configure/religion/add_religion');
                        } elseif ($para1 == "edit_religion") {
                                $page_data['get_religion'] = $this->db->get_where("religion", array("religion_id" => $para2))->result();
                                $this->load->view('back/member_configure/religion/edit_religion', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'Religion Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('religion', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'Religion Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $religion_id = $this->input->post('religion_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('religion_id', $religion_id);
                                        $result = $this->db->update('religion', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('religion_id', $para2);
                                $result = $this->db->delete('religion');
                                // $this->db->where('religion_id', $para2);
                                // $this->db->delete('caste');

                                // $caste=$this->db->get_where('caste',array('religion_id'=>$para2))->result();
                                // foreach ($caste as $key) {
                                // 	$this->db->where('caste_id', $key->caste_id);
                                //  $this->db->delete('sub_caste');
                                // }

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function on_behalf($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/on_behalf";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_on_behalfs'] = $this->db->get("on_behalf")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "on_behalf";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_on_behalf") {
                                $this->load->view('back/member_configure/on_behalf/add_on_behalf');
                        } elseif ($para1 == "edit_on_behalf") {
                                $page_data['get_on_behalf'] = $this->db->get_where("on_behalf", array("on_behalf_id" => $para2))->result();
                                $this->load->view('back/member_configure/on_behalf/edit_on_behalf', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'on_behalf Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('on_behalf', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'on_behalf Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $on_behalf_id = $this->input->post('on_behalf_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('on_behalf_id', $on_behalf_id);
                                        $result = $this->db->update('on_behalf', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('on_behalf_id', $para2);
                                $result = $this->db->delete('on_behalf');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function profession($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/profession";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_profession'] = $this->db->get("profession")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "profession";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_profession") {
                                $this->load->view('back/member_configure/profession/add_profession');
                        } elseif ($para1 == "edit_profession") {
                                $page_data['get_profession'] = $this->db->get_where("profession", array("profession_id" => $para2))->result();
                                $this->load->view('back/member_configure/profession/edit_profession', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'profession Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('profession', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'profession Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $profession_id = $this->input->post('profession_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('profession_id', $profession_id);
                                        $result = $this->db->update('profession', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('profession_id', $para2);
                                $result = $this->db->delete('profession');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function sect($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/sect";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_sect'] = $this->db->get("sect")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "sect";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_sect") {
                                $this->load->view('back/member_configure/sect/add_sect');
                        } elseif ($para1 == "edit_sect") {
                                $page_data['get_sect'] = $this->db->get_where("sect", array("sect_id" => $para2))->result();
                                $this->load->view('back/member_configure/sect/edit_sect', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'sect Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('sect', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'sect Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $sect_id = $this->input->post('sect_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('sect_id', $sect_id);
                                        $result = $this->db->update('sect', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('sect_id', $para2);
                                $result = $this->db->delete('sect');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function maritalstatus($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/maritalstatus";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_maritalstatus'] = $this->db->get("marital_status")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "maritalstatus";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_maritalstatus") {
                                $this->load->view('back/member_configure/maritalstatus/add_maritalstatus');
                        } elseif ($para1 == "edit_maritalstatus") {
                                $page_data['get_maritalstatus'] = $this->db->get_where("marital_status", array("marital_status_id" => $para2))->result();
                                $this->load->view('back/member_configure/maritalstatus/edit_maritalstatus', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'maritalstatus Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('marital_status', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'maritalstatus Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $maritalstatusid = $this->input->post('marital_status_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('marital_status_id', $maritalstatusid);
                                        $result = $this->db->update('marital_status', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('marital_status_id', $para2);
                                $result = $this->db->delete('marital_status');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function i_exercise($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/i_exercise";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_i_exercise'] = $this->db->get("i_exercise")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "i_exercise";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_i_exercise") {
                                $this->load->view('back/member_configure/i_exercise/add_i_exercise');
                        } elseif ($para1 == "edit_i_exercise") {
                                $page_data['get_i_exercise'] = $this->db->get_where("i_exercise", array("i_exercise_id" => $para2))->result();
                                $this->load->view('back/member_configure/i_exercise/edit_i_exercise', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'i_exercise Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('i_exercise', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'i_exercise Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $i_exercise_id = $this->input->post('i_exercise_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('i_exercise_id', $i_exercise_id);
                                        $result = $this->db->update('i_exercise', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('i_exercise_id', $para2);
                                $result = $this->db->delete('i_exercise');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function complexion($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/complexion";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_complexion'] = $this->db->get("complexion")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "complexion";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_complexion") {
                                $this->load->view('back/member_configure/complexion/add_complexion');
                        } elseif ($para1 == "edit_complexion") {
                                $page_data['get_complexion'] = $this->db->get_where("complexion", array("complexion_id" => $para2))->result();
                                $this->load->view('back/member_configure/complexion/edit_complexion', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'complexion Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('complexion', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'complexion Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $complexion_id = $this->input->post('complexion_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('complexion_id', $i_exercise_id);
                                        $result = $this->db->update('complexion', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('complexion_id', $para2);
                                $result = $this->db->delete('complexion');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function eye_color($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/eye_color";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_eye_color'] = $this->db->get("eye_color")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "eye_color";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_eye_color") {
                                $this->load->view('back/member_configure/eye_color/add_eye_color');
                        } elseif ($para1 == "edit_eye_color") {
                                $page_data['get_eye_color'] = $this->db->get_where("eye_color", array("eye_color_id" => $para2))->result();
                                $this->load->view('back/member_configure/eye_color/edit_eye_color', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'eye_color Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('eye_color', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'eye_color Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $eye_color_id = $this->input->post('eye_color_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('eye_color_id', $eye_color_id);
                                        $result = $this->db->update('eye_color', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('eye_color_id', $para2);
                                $result = $this->db->delete('eye_color');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function hair_color($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/hair_color";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_hair_color'] = $this->db->get("hair_color")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "hair_color";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_hair_color") {
                                $this->load->view('back/member_configure/hair_color/add_hair_color');
                        } elseif ($para1 == "edit_hair_color") {
                                $page_data['get_hair_color'] = $this->db->get_where("hair_color", array("hair_color_id" => $para2))->result();
                                $this->load->view('back/member_configure/hair_color/edit_hair_color', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'hair_color Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('hair_color', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'hair_color Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $hair_color_id = $this->input->post('hair_color_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('hair_color_id', $hair_color_id);
                                        $result = $this->db->update('hair_color', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('hair_color_id', $para2);
                                $result = $this->db->delete('hair_color');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function body_type($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/body_type";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_body_type'] = $this->db->get("body_type")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "body_type";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_body_type") {
                                $this->load->view('back/member_configure/body_type/add_body_type');
                        } elseif ($para1 == "edit_body_type") {
                                $page_data['get_body_type'] = $this->db->get_where("body_type", array("body_type_id" => $para2))->result();
                                $this->load->view('back/member_configure/body_type/edit_body_type', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'body_type Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('body_type', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'body_type Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $body_type_id = $this->input->post('body_type_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('body_type_id', $body_type_id);
                                        $result = $this->db->update('body_type', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('body_type_id', $para2);
                                $result = $this->db->delete('body_type');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function education($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/education";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $this->db->order_by("name", "asc");
                                $page_data['all_education'] = $this->db->get("education")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "education";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_education") {
                                $this->load->view('back/member_configure/education/add_education');
                        } elseif ($para1 == "edit_education") {
                                $page_data['get_education'] = $this->db->get_where("education", array("education_id" => $para2))->result();
                                $this->load->view('back/member_configure/education/edit_education', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'education Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('education', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'education Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $education_id = $this->input->post('education_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('education_id', $education_id);
                                        $result = $this->db->update('education', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('education_id', $para2);
                                $result = $this->db->delete('education');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        
        function family_value($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/family_value";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $page_data['all_family_values'] = $this->db->get("family_value")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "family_value";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_family_value") {
                                $this->load->view('back/member_configure/family_value/add_family_value');
                        } elseif ($para1 == "edit_family_value") {
                                $page_data['get_family_value'] = $this->db->get_where("family_value", array("family_value_id" => $para2))->result();
                                $this->load->view('back/member_configure/family_value/edit_family_value', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'family_value Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('family_value', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'family_value Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $family_value_id = $this->input->post('family_value_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('family_value_id', $family_value_id);
                                        $result = $this->db->update('family_value', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('family_value_id', $para2);
                                $result = $this->db->delete('family_value');
                                // $this->db->where('religion_id', $para2);
                                // $this->db->delete('caste');

                                // $caste=$this->db->get_where('caste',array('religion_id'=>$para2))->result();
                                // foreach ($caste as $key) {
                                // 	$this->db->where('caste_id', $key->caste_id);
                                //  $this->db->delete('sub_caste');
                                // }

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function family_status($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/family_status";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $page_data['all_family_statuss'] = $this->db->get("family_status")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "family_status";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_family_status") {
                                $this->load->view('back/member_configure/family_status/add_family_status');
                        } elseif ($para1 == "edit_family_status") {
                                $page_data['get_family_status'] = $this->db->get_where("family_status", array("family_status_id" => $para2))->result();
                                $this->load->view('back/member_configure/family_status/edit_family_status', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'family_status Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('family_status', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'family_status Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $family_status_id = $this->input->post('family_status_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('family_status_id', $family_status_id);
                                        $result = $this->db->update('family_status', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('family_status_id', $para2);
                                $result = $this->db->delete('family_status');


                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function language($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/language";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $page_data['all_languages'] = $this->db->get("language")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "language";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_language") {
                                $this->load->view('back/member_configure/language/add_language');
                        } elseif ($para1 == "edit_language") {
                                $page_data['get_language'] = $this->db->get_where("language", array("language_id" => $para2))->result();
                                $this->load->view('back/member_configure/language/edit_language', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'Language Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('language', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'Language Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $language_id = $this->input->post('language_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('language_id', $language_id);
                                        $result = $this->db->update('language', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('language_id', $para2);
                                $result = $this->db->delete('language');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }


        function country($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/country";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "country";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'name',
                                        1 => 'name',
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'country';

                                $totalData = $this->Crud_model->alldata_count($table);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->alldatas($table, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $rows =  $this->Crud_model->data_search($table, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->data_search_count($table, $search);
                                }

                                $data = array();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $row) {
                                                $nestedData['#'] = $i;
                                                $nestedData['name'] = $row->name;
                                                $nestedData['options'] = "<button data-target='#country_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('edit') . "' onclick='edit_country(" . $row->country_id . ")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('delete') . "' onclick='delete_country(" . $row->country_id . ")'><i class='fa fa-trash'></i></button>";

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "add_country") {
                                $this->load->view('back/member_configure/country/add_country');
                        } elseif ($para1 == "edit_country") {
                                $page_data['get_country'] = $this->db->get_where("country", array("country_id" => $para2))->result();
                                $this->load->view('back/member_configure/country/edit_country', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'country Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('country', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'country Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $country_id = $this->input->post('country_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('country_id', $country_id);
                                        $result = $this->db->update('country', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('country_id', $para2);
                                $result = $this->db->delete('country');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function state($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/state";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "state";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'name',
                                        1 => 'name',
                                        2 => 'country_name'
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'state';

                                $totalData = $this->Crud_model->alldata_count($table);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->allstates($table, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $rows =  $this->Crud_model->state_search($table, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->state_search_count($table, $search);
                                }

                                $data = array();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $row) {
                                                $nestedData['#'] = $i;
                                                $nestedData['name'] = $row->name;
                                                $nestedData['country_name'] = $row->country_name;
                                                $nestedData['options'] = "<button data-target='#state_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('edit') . "' onclick='edit_state(" . $row->state_id . ")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('delete') . "' onclick='delete_state(" . $row->state_id . ")'><i class='fa fa-trash'></i></button>";

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "add_state") {
                                $this->load->view('back/member_configure/state/add_state');
                        } elseif ($para1 == "edit_state") {
                                $page_data['get_state'] = $this->db->get_where("state", array("state_id" => $para2))->result();
                                $this->load->view('back/member_configure/state/edit_state', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('country_id', 'Country', 'required');
                                $this->form_validation->set_rules('name', 'State', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $data['country_id'] = $this->input->post('country_id');
                                        $result = $this->db->insert('state', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('country_id', 'Country', 'required');
                                $this->form_validation->set_rules('name', 'state Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $state_id = $this->input->post('state_id');
                                        $data['name'] = $this->input->post('name');
                                        $data['country_id'] = $this->input->post('country_id');
                                        $this->db->where('state_id', $state_id);
                                        $result = $this->db->update('state', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('state_id', $para2);
                                $result = $this->db->delete('state');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function city($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/city";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_ddd_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "city";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'name',
                                        1 => 'name',
                                        2 => 'state_name',
                                        3 => 'country_name',
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'city';

                                $totalData = $this->Crud_model->alldata_count($table);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->allcities($table, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $rows =  $this->Crud_model->city_search($table, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->city_search_count($table, $search);
                                }

                                $data = array();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $row) {
                                                $nestedData['#'] = $i;
                                                $nestedData['name'] = $row->name;
                                                $nestedData['state_name'] = $row->state_name;
                                                $nestedData['country_name'] = $row->country_name;
                                                $nestedData['options'] = "<button data-target='#city_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('edit') . "' onclick='edit_city(" . $row->city_id . ")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('delete') . "' onclick='delete_city(" . $row->city_id . ")'><i class='fa fa-trash'></i></button>";

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "add_city") {
                                $this->load->view('back/member_configure/city/add_city');
                        } elseif ($para1 == "edit_city") {
                                $page_data['get_city'] = $this->db->get_where("city", array("city_id" => $para2))->result();
                                $page_data['country_id'] = $this->Crud_model->get_type_name_by_id('state', $page_data['get_city'][0]->state_id, 'country_id');
                                $this->load->view('back/member_configure/city/edit_city', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('country_id', 'Country', 'required');
                                $this->form_validation->set_rules('state_id', 'State', 'required');
                                $this->form_validation->set_rules('name', 'City', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $data['state_id'] = $this->input->post('state_id');
                                        $result = $this->db->insert('city', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('country_id', 'Country', 'required');
                                $this->form_validation->set_rules('state_id', 'State', 'required');
                                $this->form_validation->set_rules('name', 'City', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $city_id = $this->input->post('city_id');
                                        $data['name'] = $this->input->post('name');
                                        $data['state_id'] = $this->input->post('state_id');
                                        $this->db->where('city_id', $city_id);
                                        $result = $this->db->update('city', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('city_id', $para2);
                                $result = $this->db->delete('city');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        function caste($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/caste";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "caste";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'caste_name',
                                        1 => 'caste_name',
                                        2 => 'religion_name'
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'caste';

                                $totalData = $this->Crud_model->alldata_count($table);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->allcastes($table, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $rows =  $this->Crud_model->caste_search($table, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->caste_search_count($table, $search);
                                }

                                $data = array();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $row) {
                                                $nestedData['#'] = $i;
                                                $nestedData['name'] = $row->caste_name;
                                                $nestedData['religion_name'] = $row->religion_name;
                                                $nestedData['options'] = "<button data-target='#caste_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('edit') . "' onclick='edit_caste(" . $row->caste_id . ")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('delete') . "' onclick='delete_caste(" . $row->caste_id . ")'><i class='fa fa-trash'></i></button>";

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "add_caste") {
                                $this->load->view('back/member_configure/caste/add_caste');
                        } elseif ($para1 == "edit_caste") {
                                $page_data['get_caste'] = $this->db->get_where("caste", array("caste_id" => $para2))->result();
                                $this->load->view('back/member_configure/caste/edit_caste', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('religion_id', 'religion', 'required');
                                $this->form_validation->set_rules('caste_name', 'caste name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['caste_name'] = $this->input->post('caste_name');
                                        $data['religion_id'] = $this->input->post('religion_id');
                                        $result = $this->db->insert('caste', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('religion_id', 'religion', 'required');
                                $this->form_validation->set_rules('name', 'Caste Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $caste_id = $this->input->post('caste_id');
                                        $data['caste_name'] = $this->input->post('name');
                                        $data['religion_id'] = $this->input->post('religion_id');
                                        $this->db->where('caste_id', $caste_id);
                                        $result = $this->db->update('caste', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('caste_id', $para2);
                                $result = $this->db->delete('caste');

                                $this->db->where('caste_id', $para2);
                                $this->db->delete('sub_caste');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function sub_caste($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/sub_caste";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "sub_caste";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "list_data") {
                                $columns = array(
                                        0 => 'sub_caste_name',
                                        1 => 'sub_caste_name',
                                        2 => 'caste_name',
                                        3 => 'religion_name'
                                );
                                $limit = $this->input->post('length');
                                $start = $this->input->post('start');
                                $order = $columns[$this->input->post('order')[0]['column']];
                                $dir = $this->input->post('order')[0]['dir'];
                                $table = 'sub_caste';

                                $totalData = $this->Crud_model->alldata_count($table);

                                $totalFiltered = $totalData;

                                if (empty($this->input->post('search')['value'])) {
                                        $rows = $this->Crud_model->allsub_castes($table, $limit, $start, $order, $dir);
                                } else {
                                        $search = $this->input->post('search')['value'];

                                        $rows =  $this->Crud_model->sub_caste_search($table, $limit, $start, $search, $order, $dir);

                                        $totalFiltered = $this->Crud_model->sub_caste_search_count($table, $search);
                                }

                                $data = array();
                                if (!empty($rows)) {
                                        if ($dir == 'asc') {
                                                $i = $start + 1;
                                        } elseif ($dir == 'desc') {
                                                $i = $totalFiltered - $start;
                                        }
                                        foreach ($rows as $row) {
                                                $nestedData['#'] = $i;
                                                $nestedData['name'] = $row->sub_caste_name;
                                                $nestedData['caste_name'] = $row->caste_name;
                                                $nestedData['religion_name'] = $row->religion_name;
                                                $nestedData['options'] = "<button data-target='#sub_caste_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('edit') . "' onclick='edit_sub_caste(" . $row->sub_caste_id . ")'><i class='fa fa-edit'></i></button>
		                	<button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('delete') . "' onclick='delete_sub_caste(" . $row->sub_caste_id . ")'><i class='fa fa-trash'></i></button>";

                                                $data[] = $nestedData;
                                                if ($dir == 'asc') {
                                                        $i++;
                                                } elseif ($dir == 'desc') {
                                                        $i--;
                                                }
                                        }
                                }

                                $json_data = array(
                                        "draw"            => intval($this->input->post('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                );
                                echo json_encode($json_data);
                        } elseif ($para1 == "add_sub_caste") {
                                $this->load->view('back/member_configure/sub_caste/add_sub_caste');
                        } elseif ($para1 == "edit_sub_caste") {
                                $page_data['get_sub_caste'] = $this->db->get_where("sub_caste", array("sub_caste_id" => $para2))->result();
                                $page_data['religion_id'] = $this->Crud_model->get_type_name_by_id('caste', $page_data['get_sub_caste'][0]->caste_id, 'religion_id');
                                $this->load->view('back/member_configure/sub_caste/edit_sub_caste', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('caste_id', 'religion', 'required');
                                $this->form_validation->set_rules('sub_caste_name', 'sub_caste name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['sub_caste_name'] = $this->input->post('sub_caste_name');
                                        $data['caste_id'] = $this->input->post('caste_id');
                                        $result = $this->db->insert('sub_caste', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('caste_id', 'caste', 'required');
                                $this->form_validation->set_rules('sub_caste_name', 'sub_Caste Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $sub_caste_id = $this->input->post('sub_caste_id');
                                        $data['sub_caste_name'] = $this->input->post('sub_caste_name');
                                        $data['caste_id'] = $this->input->post('caste_id');
                                        $this->db->where('sub_caste_id', $sub_caste_id);
                                        $result = $this->db->update('sub_caste', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('sub_caste_id', $para2);
                                $result = $this->db->delete('sub_caste');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }
        function load_caste_with_religion_id($religion_id = "")
        {
                if ($religion_id == "") {
                        echo "<select class='form-control chosen' name='caste_id'>
					<option value=''>Choose a First</option>
				</select>";
                } else {
                        echo $this->Crud_model->select_html('caste', 'caste_id', 'caste_name', 'add', 'form-control chosen', '', 'religion_id', $religion_id, '');
                }
        }

        function load_state_with_country_id($country_id = "")
        {
                if ($country_id == "") {
                        echo "<select class='form-control chosen' name='state_id'>
					<option value=''>Choose a Country First</option>
				</select>";
                } else {
                        echo $this->Crud_model->select_html('state', 'state_id', 'name', 'add', 'form-control chosen', '', 'country_id', $country_id, '');
                }
        }

        function occupation($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/occupation";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $page_data['all_occupations'] = $this->db->get("occupation")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "occupation";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_occupation") {
                                $this->load->view('back/member_configure/occupation/add_occupation');
                        } elseif ($para1 == "edit_occupation") {
                                $page_data['get_occupation'] = $this->db->get_where("occupation", array("occupation_id" => $para2))->result();
                                $this->load->view('back/member_configure/occupation/edit_occupation', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'Occupation Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('occupation', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('name', 'Occupation Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $occupation_id = $this->input->post('occupation_id');
                                        $data['name'] = $this->input->post('name');
                                        $this->db->where('occupation_id', $occupation_id);
                                        $result = $this->db->update('occupation', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('occupation_id', $para2);
                                $result = $this->db->delete('occupation');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }

        

        function general_settings($para1 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        if ($para1 == "") {
                                $page_data['title'] = "Admin || " . $this->system_title;
                                $page_data['top'] = "general_settings/index.php";
                                $page_data['folder'] = "general_settings";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "general_settings/index.php";
                                $page_data['page_name'] = "general_settings";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
                                }
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "update_general_settings") {

                                $right_option = $this->input->post('right_option');
                                if (isset($right_option)) {
                                        $data8['value'] = 'on';
                                } else {
                                        $data8['value'] = 'off';
                                }
                                $this->db->where('type', 'right_click_option');
                                $this->db->update('general_settings', $data8);

                                $data1['value'] = $this->input->post('system_name');
                                $this->db->where('type', 'system_name');
                                $this->db->update('general_settings', $data1);

                                $data2['value'] = $this->input->post('system_email');
                                $this->db->where('type', 'system_email');
                                $this->db->update('general_settings', $data2);

                                $data3['value'] = $this->input->post('system_title');
                                $this->db->where('type', 'system_title');
                                $this->db->update('general_settings', $data3);

                                $data4['value'] = $this->input->post('address');
                                $this->db->where('type', 'address');
                                $this->db->update('general_settings', $data4);

                                $data5['value'] = $this->input->post('cache_time');
                                $this->db->where('type', 'cache_time');
                                $this->db->update('general_settings', $data5);

                                $data6['value'] = $this->input->post('language');
                                $this->db->where('type', 'language');
                                $this->db->update('general_settings', $data6);

                                $data7['value'] = $this->input->post('phone');
                                $this->db->where('type', 'phone');
                                $this->db->update('general_settings', $data7);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');

                                redirect(base_url() . 'admin/general_settings', 'refresh');
                        } elseif ($para1 == "update_smtp") {
                                $mail_status = $this->input->post('mail_status');
                                if (isset($mail_status)) {
                                        $data1['value'] = 'smtp';
                                } else {
                                        $data1['value'] = 'mail';
                                }
                                $this->db->where('type', 'mail_status');
                                $this->db->update('general_settings', $data1);

                                $data2['value'] = $this->input->post('smtp_host');
                                $this->db->where('type', 'smtp_host');
                                $this->db->update('general_settings', $data2);

                                $data3['value'] = $this->input->post('smtp_port');
                                $this->db->where('type', 'smtp_port');
                                $this->db->update('general_settings', $data3);

                                $data4['value'] = $this->input->post('smtp_user');
                                $this->db->where('type', 'smtp_user');
                                $this->db->update('general_settings', $data4);

                                $data5['value'] = $this->input->post('smtp_pass');
                                $this->db->where('type', 'smtp_pass');
                                $this->db->update('general_settings', $data5);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');

                                redirect(base_url() . 'admin/general_settings', 'refresh');
                        } elseif ($para1 == "update_social_links") {
                                $data1['value'] = $this->input->post('facebook');
                                $this->db->where('type', 'facebook');
                                $this->db->update('social_links', $data1);

                                $data2['value'] = $this->input->post('google-plus');
                                $this->db->where('type', 'google-plus');
                                $this->db->update('social_links', $data2);

                                $data3['value'] = $this->input->post('twitter');
                                $this->db->where('type', 'twitter');
                                $this->db->update('social_links', $data3);

                                $data4['value'] = $this->input->post('pinterest');
                                $this->db->where('type', 'pinterest');
                                $this->db->update('social_links', $data4);

                                $data5['value'] = $this->input->post('skype');
                                $this->db->where('type', 'skype');
                                $this->db->update('social_links', $data5);

                                $data5['value'] = $this->input->post('youtube');
                                $this->db->where('type', 'youtube');
                                $this->db->update('social_links', $data5);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');

                                redirect(base_url() . 'admin/general_settings', 'refresh');
                        } elseif ($para1 == "update_terms_and_conditions") {
                                $data['value'] = $this->input->post('terms_and_conditions');
                                $this->db->where('type', 'terms_conditions');
                                $this->db->update('general_settings', $data);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');

                                redirect(base_url() . 'admin/general_settings', 'refresh');
                        } elseif ($para1 == "update_privacy_policy") {
                                $data['value'] = $this->input->post('privacy_policy');
                                $this->db->where('type', 'privacy_policy');
                                $this->db->update('general_settings', $data);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');

                                redirect(base_url() . 'admin/general_settings', 'refresh');
                        }
                }
        }

        function frontend_appearances($para1 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "pages") {
                                $page_data['top'] = "frontend_appearances/index.php";
                                $page_data['folder'] = "frontend_appearances/pages";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "frontend_appearances/index.php";
                                $page_data['page_name'] = "pages";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
                                }
                                if ($this->session->flashdata('alert') == "failed_image") {
                                        $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
                                }
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "header") {
                                $page_data['top'] = "frontend_appearances/index.php";
                                $page_data['folder'] = "frontend_appearances/header";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "frontend_appearances/index.php";
                                $page_data['page_name'] = "header";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
                                }
                                if ($this->session->flashdata('alert') == "failed_image") {
                                        $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
                                }
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "footer") {
                                $page_data['top'] = "frontend_appearances/index.php";
                                $page_data['folder'] = "frontend_appearances/footer";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "frontend_appearances/index.php";
                                $page_data['page_name'] = "footer";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
                                }
                                if ($this->session->flashdata('alert') == "failed_image") {
                                        $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
                                }
                                $this->load->view('back/index', $page_data);
                        }
                }
        }

        function save_frontend_settings($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        if ($para1 == "home_slider") {
                                if ($this->input->post('slider_status')) {
                                        $data1['value'] = 'yes';
                                        $this->db->where('type', 'slider_status');
                                        $this->db->update('frontend_settings', $data1);
                                } else {
                                        $data1['value'] = 'no';
                                        $this->db->where('type', 'slider_status');
                                        $this->db->update('frontend_settings', $data1);
                                }

                                $data2['value'] = $this->input->post('slider_position');
                                $this->db->where('type', 'slider_position');
                                $this->db->update('frontend_settings', $data2);

                                $data4['value'] = $this->input->post('home_search_style');
                                $this->db->where('type', 'home_search_style');
                                $this->db->update('frontend_settings', $data4);

                                $data5['value'] = $this->input->post('searching_heading');
                                $this->db->where('type', 'home_searching_heading');
                                $this->db->update('frontend_settings', $data5);

                                $home_slider_image = $this->db->get_where('frontend_settings', array('type' => 'home_slider_image'))->row()->value;
                                $img_features = json_decode($home_slider_image, true);
                                $last_index = 0;

                                // $this->load->library('image_lib');
                                // ini_set("memory_limit", "-1");

                                $totally_new = array();
                                $replaced_new = array();
                                $untouched = array();

                                foreach ($_FILES['nimg']['name'] as $i => $row) {
                                        if ($_FILES['nimg']['name'][$i] !== '') {
                                                $ib = $i + 1;
                                                $path = $_FILES['nimg']['name'][$i];
                                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                                $img = 'slider_image_' . $ib . '.' . $ext;
                                                // $img_thumb = 'news_' . $para2 . '_' . $ib . '_thumb.' . $ext;
                                                $in_db = 'no';
                                                foreach ($img_features as $roww) {
                                                        if ($roww['index'] == $i) {
                                                                $replaced_new[] = array('index' => $i, 'img' => $img);
                                                                $in_db = 'yes';
                                                        }
                                                }
                                                if ($in_db == 'no') {
                                                        $totally_new[] = array('index' => $i, 'img' => $img);
                                                }
                                                move_uploaded_file($_FILES['nimg']['tmp_name'][$i], 'uploads/home_page/slider_image/' . $img);

                                                /*$config1['image_library'] = 'gd2';
	                    $config1['create_thumb'] = TRUE;
	                    $config1['maintain_ratio'] = TRUE;
	                    $config1['width'] = '400';
	                    $config1['height'] = '400';
	                    $config1['source_image'] = 'uploads/home_page/slider_image/' . $img;

	                    $this->image_lib->initialize($config1);
	                    $this->image_lib->resize();
	                    $this->image_lib->clear();*/
                                        }
                                }

                                $touched = $replaced_new + $totally_new;
                                foreach ($img_features as $yy) {
                                        $is_touched = 'no';
                                        foreach ($touched as $rr) {
                                                if ($yy['index'] == $rr['index']) {
                                                        $is_touched = 'yes';
                                                }
                                        }
                                        if ($is_touched == 'no') {
                                                $untouched[] = $yy;
                                        }
                                }
                                $new_img_features = array();
                                foreach ($replaced_new as $k) {
                                        $new_img_features[] = $k;
                                }
                                foreach ($totally_new as $k) {
                                        $new_img_features[] = $k;
                                }
                                foreach ($untouched as $k) {
                                        $new_img_features[] = $k;
                                }
                                sort_array_of_array($new_img_features, 'index', SORT_ASC); // Sort the data with Index

                                $data['value'] = json_encode($new_img_features);
                                $this->db->where('type', 'home_slider_image');
                                $this->db->update('frontend_settings', $data);


                                recache();

                                $this->session->set_flashdata('alert', 'edit');
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "home_premium_members") {
                                if ($this->input->post('home_members_status')) {
                                        $data1['value'] = 'yes';
                                        $this->db->where('type', 'home_members_status');
                                        $this->db->update('frontend_settings', $data1);
                                } else {
                                        $data1['value'] = 'no';
                                        $this->db->where('type', 'home_members_status');
                                        $this->db->update('frontend_settings', $data1);
                                }
                                $data2['value'] = $this->input->post('max_premium_member_num');

                                $this->db->where('type', 'max_premium_member_num');
                                $this->db->update('frontend_settings', $data2);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "home_parallax") {
                                $prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'home_parallax_image'))->row()->value;
                                if ($prev_image_info != '[]') {
                                        $prev_image_info = json_decode($prev_image_info, true);
                                        $prev_image = $prev_image_info[0]['image'];
                                }
                                if ($this->input->post('home_parallax_status')) {
                                        $data0['value'] = 'yes';
                                        $this->db->where('type', 'home_parallax_status');
                                        $this->db->update('frontend_settings', $data0);
                                } else {
                                        $data0['value'] = 'no';
                                        $this->db->where('type', 'home_parallax_status');
                                        $this->db->update('frontend_settings', $data0);
                                }
                                $data1['value'] = $this->input->post('parallax_text');
                                $is_edit = $this->input->post('is_edit');
                                if ($is_edit == '0') {
                                        $this->db->where('type', 'home_parallax_text');
                                        $this->db->update('frontend_settings', $data1);
                                        recache();

                                        $this->session->set_flashdata('alert', 'edit');
                                } elseif ($is_edit == '1') {
                                        if ($_FILES['parallax_image']['name'] !== '') {
                                                $path = $_FILES['parallax_image']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "parallax_image_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['parallax_image']['tmp_name'], 'uploads/home_page/parallax_image/' . $img_file_name);
                                                        $home_parallax_image[] = array('image' => $img_file_name);

                                                        $data2['value'] = json_encode($home_parallax_image);

                                                        $this->db->where('type', 'home_parallax_text');
                                                        $this->db->update('frontend_settings', $data1);

                                                        $this->db->where('type', 'home_parallax_image');
                                                        $this->db->update('frontend_settings', $data2);
                                                        recache();

                                                        if ($prev_image_info != '[]' && file_exists('uploads/home_page/parallax_image/' . $prev_image)) {
                                                                unlink('uploads/home_page/parallax_image/' . $prev_image);
                                                        }
                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                }
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "home_happy_stories") {
                                if ($this->input->post('home_stories_status')) {
                                        $data0['value'] = 'yes';
                                        $this->db->where('type', 'home_stories_status');
                                        $this->db->update('frontend_settings', $data0);
                                } else {
                                        $data0['value'] = 'no';
                                        $this->db->where('type', 'home_stories_status');
                                        $this->db->update('frontend_settings', $data0);
                                }

                                $data['value'] = $this->input->post('max_story_num');

                                $this->db->where('type', 'max_story_num');
                                $this->db->update('frontend_settings', $data);
                                recache();
                                $this->session->set_flashdata('alert', 'edit');
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "home_premium_plans") {
                                if ($this->input->post('home_plans_status')) {
                                        $data0['value'] = 'yes';
                                        $this->db->where('type', 'home_plans_status');
                                        $this->db->update('frontend_settings', $data0);
                                } else {
                                        $data0['value'] = 'no';
                                        $this->db->where('type', 'home_plans_status');
                                        $this->db->update('frontend_settings', $data0);
                                }

                                $prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'home_premium_plans_image'))->row()->value;
                                if ($prev_image_info != '[]') {
                                        $prev_image_info = json_decode($prev_image_info, true);
                                        $prev_image = $prev_image_info[0]['image'];
                                }
                                $is_edit = $this->input->post('is_edit');
                                if ($is_edit == '0') {
                                        $this->session->set_flashdata('alert', 'edit');
                                } elseif ($is_edit == '1') {
                                        if ($_FILES['premium_plans_image']['name'] !== '') {
                                                $path = $_FILES['premium_plans_image']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "premium_plans_image_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['premium_plans_image']['tmp_name'], 'uploads/home_page/premium_plans_image/' . $img_file_name);
                                                        $home_premium_plans_image[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($home_premium_plans_image);

                                                        $this->db->where('type', 'home_premium_plans_image');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        if ($prev_image_info != '[]' && file_exists('uploads/home_page/premium_plans_image/' . $prev_image)) {
                                                                unlink('uploads/home_page/premium_plans_image/' . $prev_image);
                                                        }
                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                }
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "home_contact_info") {
                                if ($this->input->post('home_contact_status')) {
                                        $data0['value'] = 'yes';
                                        $this->db->where('type', 'home_contact_status');
                                        $this->db->update('frontend_settings', $data0);
                                } else {
                                        $data0['value'] = 'no';
                                        $this->db->where('type', 'home_contact_status');
                                        $this->db->update('frontend_settings', $data0);
                                }

                                $data['value'] = $this->input->post('contact_info_text');

                                $this->db->where('type', 'home_contact_info_text');
                                $this->db->update('frontend_settings', $data);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "premium_plans") {
                                $prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'premium_plans_image'))->row()->value;
                                if ($prev_image_info != '[]') {
                                        $prev_image_info = json_decode($prev_image_info, true);
                                        $prev_image = $prev_image_info[0]['image'];
                                }
                                $is_edit = $this->input->post('is_edit');
                                if ($is_edit == '0') {
                                        if ($_FILES['premium_plans_image']['name'] !== '') {
                                                $path = $_FILES['premium_plans_image']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "premium_plans_image_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['premium_plans_image']['tmp_name'], 'uploads/premium_plans_image/' . $img_file_name);
                                                        $premium_plans_image[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($premium_plans_image);

                                                        $this->db->where('type', 'premium_plans_image');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                        $this->session->set_flashdata('alert', 'edit');
                                } elseif ($is_edit == '1') {
                                        if ($_FILES['premium_plans_image']['name'] !== '') {
                                                $path = $_FILES['premium_plans_image']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "premium_plans_image_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['premium_plans_image']['tmp_name'], 'uploads/premium_plans_image/' . $img_file_name);
                                                        $premium_plans_image[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($premium_plans_image);

                                                        $this->db->where('type', 'premium_plans_image');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        if ($prev_image_info != '[]' && file_exists('uploads/premium_plans_image/' . $prev_image)) {
                                                                unlink('uploads/premium_plans_image/' . $prev_image);
                                                        }
                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                }
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "happy_stories") {
                                $data['value'] = $this->input->post('happy_stories_text');

                                $this->db->where('type', 'happy_stories_text');
                                $this->db->update('frontend_settings', $data);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "contact_us") {
                                $data['value'] = $this->input->post('contact_us_text');

                                $this->db->where('type', 'contact_us_text');
                                $this->db->update('frontend_settings', $data);
                                recache();

                                $this->session->set_flashdata('alert', 'edit');
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "listing_page") {

                                $data1['value'] = $this->input->post('advance_search_position');
                                $this->db->where('type', 'advance_search_position');
                                $this->db->update('frontend_settings', $data1);

                                $this->session->set_flashdata('alert', 'edit');
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "log_in") {
                                $prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'login_image'))->row()->value;
                                if ($prev_image_info != '[]') {
                                        $prev_image_info = json_decode($prev_image_info, true);
                                        $prev_image = $prev_image_info[0]['image'];
                                }
                                $is_edit = $this->input->post('is_edit');
                                if ($is_edit == '0') {
                                        if ($_FILES['login_image']['name'] !== '') {
                                                $path = $_FILES['login_image']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "login_image_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['login_image']['tmp_name'], 'uploads/login_image/' . $img_file_name);
                                                        $login_image[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($login_image);

                                                        $this->db->where('type', 'login_image');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                        $this->session->set_flashdata('alert', 'edit');
                                } elseif ($is_edit == '1') {
                                        if ($_FILES['login_image']['name'] !== '') {
                                                $path = $_FILES['login_image']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "login_image_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['login_image']['tmp_name'], 'uploads/login_image/' . $img_file_name);
                                                        $login_image[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($login_image);

                                                        $this->db->where('type', 'login_image');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        if ($prev_image_info != '[]' && file_exists('uploads/login_image/' . $prev_image)) {
                                                                unlink('uploads/login_image/' . $prev_image);
                                                        }
                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                }
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "registration") {
                                $prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'registration_image'))->row()->value;
                                if ($prev_image_info != '[]') {
                                        $prev_image_info = json_decode($prev_image_info, true);
                                        $prev_image = $prev_image_info[0]['image'];
                                }
                                $is_edit = $this->input->post('is_edit');
                                if ($is_edit == '0') {
                                        if ($_FILES['registration_image']['name'] !== '') {
                                                $path = $_FILES['registration_image']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "registration_image_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['registration_image']['tmp_name'], 'uploads/registration_image/' . $img_file_name);
                                                        $registration_image[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($registration_image);

                                                        $this->db->where('type', 'registration_image');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                        $this->session->set_flashdata('alert', 'edit');
                                } elseif ($is_edit == '1') {
                                        if ($_FILES['registration_image']['name'] !== '') {
                                                $path = $_FILES['registration_image']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "registration_image_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['registration_image']['tmp_name'], 'uploads/registration_image/' . $img_file_name);
                                                        $registration_image[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($registration_image);

                                                        $this->db->where('type', 'registration_image');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        if ($prev_image_info != '[]' && file_exists('uploads/registration_image/' . $prev_image)) {
                                                                unlink('uploads/registration_image/' . $prev_image);
                                                        }
                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                }
                                redirect(base_url() . 'admin/frontend_appearances/pages', 'refresh');
                        } elseif ($para1 == "update_header") {
                                $prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'header_logo'))->row()->value;
                                if ($prev_image_info != '[]') {
                                        $prev_image_info = json_decode($prev_image_info, true);
                                        $prev_image = $prev_image_info[0]['image'];
                                }
                                $is_edit = $this->input->post('is_edit');
                                if ($is_edit == '0') {
                                        if ($_FILES['header_logo']['name'] !== '') {
                                                $path = $_FILES['header_logo']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "header_logo_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['header_logo']['tmp_name'], 'uploads/header_logo/' . $img_file_name);
                                                        $header_logo[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($header_logo);

                                                        $this->db->where('type', 'header_logo');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        } elseif ($_FILES['favicon']['name'] !== '') {
                                                $path = $_FILES['favicon']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "favicon_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['favicon']['tmp_name'], 'uploads/favicon/' . $img_file_name);
                                                        $favicon[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($favicon);

                                                        $this->db->where('type', 'favicon');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                        if ($this->input->post('sticky_header')) {
                                                $data1['value'] = 'yes';
                                                $this->db->where('type', 'sticky_header');
                                                $this->db->update('frontend_settings', $data1);
                                        } else {
                                                $data1['value'] = 'no';
                                                $this->db->where('type', 'sticky_header');
                                                $this->db->update('frontend_settings', $data1);
                                        }
                                        $this->session->set_flashdata('alert', 'edit');
                                } elseif ($is_edit == '1') {
                                        if ($_FILES['header_logo']['name'] !== '') {
                                                $path = $_FILES['header_logo']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "header_logo_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['header_logo']['tmp_name'], 'uploads/header_logo/' . $img_file_name);
                                                        $header_logo[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($header_logo);

                                                        $this->db->where('type', 'header_logo');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        if ($prev_image_info != '[]' && file_exists('uploads/header_logo/' . $prev_image)) {
                                                                unlink('uploads/header_logo/' . $prev_image);
                                                        }
                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        } elseif ($_FILES['favicon']['name'] !== '') {
                                                $path = $_FILES['favicon']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "favicon_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['favicon']['tmp_name'], 'uploads/favicon/' . $img_file_name);
                                                        $favicon[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($favicon);

                                                        $this->db->where('type', 'favicon');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        if ($prev_image_info != '[]' && file_exists('uploads/favicon/' . $prev_image)) {
                                                                unlink('uploads/favicon/' . $prev_image);
                                                        }
                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                }
                                redirect(base_url() . 'admin/frontend_appearances/header', 'refresh');
                        } elseif ($para1 == "update_footer") {
                                $data1['value'] = $this->input->post('footer_logo_position');
                                $data2['value'] = $this->input->post('footer_text');

                                $this->db->where('type', 'footer_logo_position');
                                $this->db->update('frontend_settings', $data1);

                                $this->db->where('type', 'footer_text');
                                $this->db->update('frontend_settings', $data2);
                                recache();


                                $prev_image_info = $this->db->get_where('frontend_settings', array('type' => 'footer_logo'))->row()->value;
                                if ($prev_image_info != '[]') {
                                        $prev_image_info = json_decode($prev_image_info, true);
                                        $prev_image = $prev_image_info[0]['image'];
                                }
                                $is_edit = $this->input->post('is_edit');
                                if ($is_edit == '0') {
                                        if ($_FILES['footer_logo']['name'] !== '') {
                                                $path = $_FILES['footer_logo']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "footer_logo_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['footer_logo']['tmp_name'], 'uploads/footer_logo/' . $img_file_name);
                                                        $footer_logo[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($footer_logo);

                                                        $this->db->where('type', 'footer_logo');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                        $this->session->set_flashdata('alert', 'edit');
                                } elseif ($is_edit == '1') {
                                        if ($_FILES['footer_logo']['name'] !== '') {
                                                $path = $_FILES['footer_logo']['name'];
                                                $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                                $img_file_name = "footer_logo_" . time() . $ext;
                                                if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                        move_uploaded_file($_FILES['footer_logo']['tmp_name'], 'uploads/footer_logo/' . $img_file_name);
                                                        $footer_logo[] = array('image' => $img_file_name);

                                                        $data['value'] = json_encode($footer_logo);

                                                        $this->db->where('type', 'footer_logo');
                                                        $this->db->update('frontend_settings', $data);
                                                        recache();

                                                        if ($prev_image_info != '[]' && file_exists('uploads/footer_logo/' . $prev_image)) {
                                                                unlink('uploads/footer_logo/' . $prev_image);
                                                        }
                                                        $this->session->set_flashdata('alert', 'edit');
                                                } else {
                                                        $this->session->set_flashdata('alert', 'failed_image');
                                                }
                                        }
                                }
                                redirect(base_url() . 'admin/frontend_appearances/footer', 'refresh');
                        }
                }
        }

        function currency_settings($para1 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "currency_configure") {
                                $page_data['top'] = "currency_settings/index.php";
                                $page_data['folder'] = "currency_settings/currency_configure";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "currency_settings/index.php";
                                $page_data['page_name'] = "currency_configure";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
                                }
                                $this->load->view('back/index', $page_data);
                        }
                        if ($para1 == "currency_set") {
                                $page_data['top'] = "currency_settings/index.php";
                                $page_data['folder'] = "currency_settings/currency_set";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "currency_settings/index.php";
                                $page_data['page_name'] = "currency_set";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
                                }
                                $this->load->view('back/index', $page_data);
                        }
                }
        }

        function update_currency_settings($para1 = "")
        {
                if ($para1 == "home_currency") {
                        $home_currency = $this->input->post('home_def_currency');

                        $data['value'] = $home_currency;

                        $this->db->where('type', 'home_def_currency');
                        $result = $this->db->update('business_settings', $data);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/currency_settings/currency_configure', 'refresh');
                } elseif ($para1 == "system_currency") {
                        $system_currency = $this->input->post('system_def_currency');

                        $data['value'] = $system_currency;

                        $this->db->where('type', 'currency');
                        $result = $this->db->update('business_settings', $data);

                        $this->db->where('currency_settings_id', $system_currency);
                        $this->db->update('currency_settings', array(
                                'exchange_rate_def' => '1'
                        ));
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/currency_settings/currency_configure', 'refresh');
                } elseif ($para1 == "currency_format") {
                        $this->db->where('type', 'currency_format');
                        $this->db->update('business_settings', array(
                                'value' => $this->input->post('currency_format')
                        ));

                        $this->db->where('type', 'symbol_format');
                        $this->db->update('business_settings', array(
                                'value' => $this->input->post('symbol_format')
                        ));

                        $this->db->where('type', 'no_of_decimals');
                        $result = $this->db->update('business_settings', array(
                                'value' => $this->input->post('no_of_decimals')
                        ));
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/currency_settings/currency_configure', 'refresh');
                }
        }

        function set_currency_rate($para1 = "")
        {
                if ($this->input->post('exchange')) {
                        $data['exchange_rate']                    = $this->input->post('exchange');
                }
                if ($this->input->post('exchange_def')) {
                        $data['exchange_rate_def']            = $this->input->post('exchange_def');
                }
                if ($this->input->post('name')) {
                        $data['name']            = $this->input->post('name');
                }
                if ($this->input->post('symbol')) {
                        $data['symbol']            = $this->input->post('symbol');
                }
                $cur_stats = $this->input->post('cur_stats');
                if (isset($cur_stats)) {
                        $data['status'] = "ok";
                } else {
                        $data['status'] = "no";
                }
                $this->db->where('currency_settings_id', $para1);
                $this->db->update('currency_settings', $data);
                recache();
        }

        function sms_settings($para1 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "twilio") {
                                $page_data['top'] = "sms_settings/index.php";
                                $page_data['folder'] = "sms_settings/twilio";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "sms_settings/index.php";
                                $page_data['page_name'] = "twilio";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
                                }
                                $this->load->view('back/index', $page_data);
                        }
                        if ($para1 == "msg91") {
                                $page_data['top'] = "sms_settings/index.php";
                                $page_data['folder'] = "sms_settings/msg91";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "sms_settings/index.php";
                                $page_data['page_name'] = "msg91";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_settings!");
                                }
                                $this->load->view('back/index', $page_data);
                        }
                }
        }

        function update_sms_settings($para1 = "")
        {
                if ($para1 == "twilio") {
                        $twilio_activation = $this->input->post('twilio_activation');
                        if (isset($twilio_activation)) {
                                $data1['value'] = "ok";
                        } else {
                                $data1['value'] = "no";
                        }
                        $data2['value'] = $this->input->post('twilio_account_sid');
                        $data3['value'] = $this->input->post('twilio_auth_token');
                        $data4['value'] = $this->input->post('twilio_sender_phone_number');

                        $this->db->where('type', 'twilio_status');
                        $result = $this->db->update('third_party_settings', $data1);

                        $this->db->where('type', 'twilio_account_sid');
                        $result = $this->db->update('third_party_settings', $data2);

                        $this->db->where('type', 'twilio_auth_token');
                        $result = $this->db->update('third_party_settings', $data3);

                        $this->db->where('type', 'twilio_sender_phone_number');
                        $result = $this->db->update('third_party_settings', $data4);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/sms_settings/twilio', 'refresh');
                }

                if ($para1 == "msg91") {
                        $msg91_activation = $this->input->post('msg91_activation');
                        if (isset($msg91_activation)) {
                                $data1['value'] = "ok";
                        } else {
                                $data1['value'] = "no";
                        }
                        $data2['value'] = $this->input->post('authentication_key');
                        $data3['value'] = $this->input->post('sender_id');
                        $data6['value'] = $this->input->post('type');

                        $data4['value'] = $this->input->post('country_code');
                        $data5['value'] = $this->input->post('route');


                        $this->db->where('type', 'msg91_status');
                        $result = $this->db->update('third_party_settings', $data1);

                        $this->db->where('type', 'msg91_authentication_key');
                        $result = $this->db->update('third_party_settings', $data2);

                        $this->db->where('type', 'msg91_sender_id');
                        $result = $this->db->update('third_party_settings', $data3);

                        $this->db->where('type', 'msg91_country_code');
                        $result = $this->db->update('third_party_settings', $data4);

                        $this->db->where('type', 'msg91_route');
                        $result = $this->db->update('third_party_settings', $data5);
                        $this->db->where('type', 'msg91_type');
                        $result = $this->db->update('third_party_settings', $data6);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/sms_settings/msg91', 'refresh');
                }
        }

        function theme_color_settings($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        if ($para1 == "") {
                                $page_data['title'] = "Admin || " . $this->system_title;
                                $page_data['top'] = "theme_color_settings/index.php";
                                $page_data['folder'] = "theme_color_settings";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "theme_color_settings/index.php";
                                $page_data['page_name'] = "theme_color_settings";
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_updated_your_profile!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_updated_your_profile!");
                                }

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "update") {
                                $data['value'] = $this->input->post('theme_color');
                                $this->db->where('type', 'theme_color');
                                $result = $this->db->update('frontend_settings', $data);
                                recache();
                        }
                }
        }

        function payments()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "payments/index.php";
                        $page_data['folder'] = "payments";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "payments/index.php";
                        $page_data['page_name'] = "payments";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_your_payments_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_your_payments_settings!");
                        }

                        $this->load->view('back/index', $page_data);
                }
        }

        function update_payments($para1 = "")
        {
                if ($para1 == "update_paypal") {

                        $paypal_activation = $this->input->post('paypal_activation');
                        if (isset($paypal_activation)) {
                                $data1['value'] = "ok";
                        } else {
                                $data1['value'] = "no";
                        }
                        $data2['value'] = $this->input->post('email');
                        $data3['value'] = $this->input->post('paypal_account_type');

                        $this->db->where('type', 'paypal_set');
                        $result = $this->db->update('business_settings', $data1);

                        $this->db->where('type', 'paypal_email');
                        $result = $this->db->update('business_settings', $data2);

                        $this->db->where('type', 'paypal_account_type');
                        $result = $this->db->update('business_settings', $data3);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/payments', 'refresh');
                } elseif ($para1 == "update_stripe") {

                        $stripe_activation = $this->input->post('stripe_activation');
                        if (isset($stripe_activation)) {
                                $data1['value'] = "ok";
                        } else {
                                $data1['value'] = "no";
                        }
                        $data2['value'] = $this->input->post('secret_key');
                        $data3['value'] = $this->input->post('publishable_key');

                        $this->db->where('type', 'stripe_set');
                        $result = $this->db->update('business_settings', $data1);

                        $this->db->where('type', 'stripe_secret_key');
                        $result = $this->db->update('business_settings', $data2);

                        $this->db->where('type', 'stripe_publishable_key');
                        $result = $this->db->update('business_settings', $data3);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/payments', 'refresh');
                } else if ($para1 == "update_pum") {

                        $pum_activation = $this->input->post('pum_activation');
                        if (isset($pum_activation)) {
                                $data1['value'] = "ok";
                        } else {
                                $data1['value'] = "no";
                        }
                        $data21['value'] = $this->input->post('pum_merchant_key');
                        $data22['value'] = $this->input->post('pum_merchant_salt');
                        $data3['value'] = $this->input->post('pum_account_type');

                        $this->db->where('type', 'pum_set');
                        $result = $this->db->update('business_settings', $data1);

                        $this->db->where('type', 'pum_merchant_key');
                        $result = $this->db->update('business_settings', $data21);

                        $this->db->where('type', 'pum_merchant_salt');
                        $result = $this->db->update('business_settings', $data22);

                        $this->db->where('type', 'pum_account_type');
                        $result = $this->db->update('business_settings', $data3);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/payments', 'refresh');
                }
        }

        function faq($para1 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        if ($para1 == "") {
                                $page_data['title'] = "Admin || " . $this->system_title;
                                $page_data['top'] = "faq/index.php";
                                $page_data['folder'] = "faq";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "faq/index.php";
                                $page_data['page_name'] = "faq";
                                if ($this->session->flashdata('alert') == "update") {
                                        $page_data['success_alert'] = translate("you_have_successfully_updated_the_FAQ!");
                                } elseif ($this->session->flashdata('alert') == "failed_update") {
                                        $page_data['danger_alert'] = translate("failed_to_update_the_FAQ!");
                                }
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "update") {
                                $faqs = array();

                                $f_q = $this->input->post('question');
                                $f_a = $this->input->post('answer');
                                foreach ($f_q as $i => $r) {
                                        $faqs[] = array(
                                                'question' => $f_q[$i],
                                                'answer' => $f_a[$i]
                                        );
                                }

                                $this->db->where('type', "faqs");
                                $result = $this->db->update('general_settings', array('value' => json_encode($faqs)));
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'update');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_update');
                                }
                                redirect(base_url() . 'admin/faq', 'refresh');
                        }
                }
        }

        function delete_slider($image_name)
        {
                $new_img_features = array();
                $old_img_features = json_decode($this->db->get_where('frontend_settings', array('type' => 'home_slider_image'))->row()->value, true);
                foreach ($old_img_features as $row2) {
                        if ($row2['img'] == $image_name) {
                                if (file_exists('uploads/home_page/slider_image/' . $row2['img'])) {
                                        unlink('uploads/home_page/slider_image/' . $row2['img']);
                                }
                        } else {
                                $new_img_features[] = $row2;
                        }
                }
                $data['value'] = json_encode($new_img_features);
                $this->db->where('type', 'home_slider_image');
                $this->db->update('frontend_settings', $data);
                recache();
        }

        function login()
        {
                if ($this->admin_permission() == TRUE) {
                        redirect(base_url() . 'admin/', 'refresh');
                } else {
                        $page_data['login_error'] = "";
                        if ($this->session->flashdata('alert') == "login_error") {
                                $page_data['login_error'] = translate("Your_email_or_password_is_Invalid!");
                        }
                        if ($this->session->flashdata('alert') == "not_sent") {
                                $page_data['login_error'] = translate("failed_to_send_your_email!");
                        }
                        if ($this->session->flashdata('alert') == "no_email") {
                                $page_data['login_error'] = translate("Your_email__is_Invalid!");
                        }
                        if ($this->session->flashdata('alert') == "email_sent") {
                                $page_data['success_alert'] = translate("email_sent_successfully!");
                        }
                        $this->load->view('back/login', $page_data);
                }
        }

        function forget_pass()
        {
                if ($this->admin_permission() == TRUE) {
                        redirect(base_url() . 'admin/', 'refresh');
                } else {
                        $page_data['forget_pass_error'] = "";
                        if ($this->session->flashdata('alert') == "forget_pass_error") {
                                $page_data['forget_pass_error'] = "Your <b>Email</b> or <b>Password</b> is Invalid!";
                        }
                        $this->load->view('back/forget_pass', $page_data);
                }
        }

        function submit_forget_pass()
        {
                $this->form_validation->set_rules('email', 'Email', 'required');

                if ($this->form_validation->run() == FALSE) {
                        $ajax_error[] = array('ajax_error'  =>  validation_errors());
                        echo json_encode($ajax_error);
                } else {
                        $query = $this->db->get_where('admin', array(
                                'email' => $this->input->post('email')
                        ));
                        if ($query->num_rows() > 0) {
                                $admin_id = $query->row()->admin_id;
                                $password = substr(hash('sha512', rand()), 0, 7);
                                $data['password'] = sha1($password);
                                if ($this->Email_model->password_reset_email('admin', $admin_id, $password)) {
                                        $this->db->where('admin_id', $admin_id);
                                        $this->db->update('admin', $data);
                                        recache();
                                        $this->session->set_flashdata('alert', 'email_sent');
                                } else {
                                        $this->session->set_flashdata('alert', 'not_sent');
                                }
                        } else {
                                $this->session->set_flashdata('alert', 'no_email');
                        }
                        redirect(base_url() . 'admin/login', 'refresh');
                }
        }

        function manage_language($para1 = "", $para2 = "", $para3 = "", $para4 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "manage_language/index.php";
                                $page_data['folder'] = "manage_language";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "manage_language/index.php";
                                $page_data['page_name'] = "manage_language";
                                $page_data['all_language_list'] = $this->db->get("site_language_list")->result();
                                if ($this->session->flashdata('alert') == "publish") {
                                        $page_data['success_alert'] = translate("you_have_successfully_published_the_language!");
                                }
                                if ($this->session->flashdata('alert') == "unpublish") {
                                        $page_data['success_alert'] = translate("you_have_successfully_unpublished_the_language!");
                                }
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_language!");
                                }
                                if ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_language!");
                                }
                                if ($this->session->flashdata('alert') == "delete") {
                                        $page_data['danger_alert'] = translate("you_have_successfully_deleted_the_language!");
                                }

                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "approval") {
                                if ($para2 == "no") {
                                        $data['status'] = "ok";
                                        $this->session->set_flashdata('alert', 'publish');
                                } elseif ($para2 == "ok") {
                                        $data['status'] = "no";
                                        $this->session->set_flashdata('alert', 'unpublish');
                                }
                                $this->db->where('site_language_list_id', $para3);
                                $this->db->update('site_language_list', $data);
                                recache();
                        } elseif ($para1 == "add_site_language") {
                                $this->load->view('back/manage_language/add_site_language');
                        } elseif ($para1 == "edit_site_language") {
                                $page_data['get_site_language'] = $this->db->get_where("site_language_list", array("site_language_list_id" => $para2))->result();
                                $this->load->view('back/manage_language/edit_site_language', $page_data);
                        } elseif ($para1 == "do_add") {
                                $data['name'] = $this->input->post('language_name');
                                $this->db->insert('site_language_list', $data);

                                $id = $this->db->insert_id();

                                move_uploaded_file($_FILES['language_icon']['tmp_name'], 'uploads/language_list_image/language_' . $id . '.jpg');

                                $language = 'lang_' . $id;

                                $this->db->where('site_language_list_id', $id);
                                $this->db->update('site_language_list', array(
                                        'db_field' => $language,
                                        'status' => 'ok'
                                ));
                                recache();

                                $this->session->set_flashdata('alert', 'add');
                                add_language($language);
                                redirect(base_url() . 'admin/manage_language', 'refresh');
                        } elseif ($para1 == "update") {
                                $this->db->where('site_language_list_id', $para2);
                                $this->db->update('site_language_list', array(
                                        'name' => $this->input->post('language_name')
                                ));
                                recache();
                                if ($this->input->post('is_edit') == '1') {
                                        move_uploaded_file($_FILES['language_icon']['tmp_name'], 'uploads/language_list_image/language_' . $para2 . '.jpg');
                                }
                                $this->session->set_flashdata('alert', 'edit');
                                redirect(base_url() . 'admin/manage_language', 'refresh');
                        } elseif ($para1 == "delete") {
                                $this->db->where('db_field', $para2);
                                $this->db->delete('site_language_list');
                                recache();
                                $this->load->dbforge();
                                $this->dbforge->drop_column('site_language', $para2);

                                $lid = $this->db->get_where('site_language_list', array('db_field' => $para2))->row()->site_language_list_id;
                                unlink('uploads/language_list_image/language_' . $lid . '.jpg');

                                $this->session->set_flashdata('alert', 'delete');
                        } elseif ($para1 == "set_translation") {
                                if ($para3 == "") {
                                        $page_data['top'] = "manage_language/index.php";
                                        $page_data['folder'] = "manage_language/set_translation";
                                        $page_data['file'] = "index.php";
                                        $page_data['bottom'] = "manage_language/index.php";
                                        $page_data['page_name'] = "manage_language";
                                        $page_data['selected_language'] = $para2;

                                        $this->load->view('back/index', $page_data);
                                } elseif ($para3 == "list_data") {
                                        $columns = array(
                                                0 => 'word',
                                                1 => 'word',
                                        );
                                        $limit = $this->input->post('length');
                                        $start = $this->input->post('start');
                                        $order = $columns[$this->input->post('order')[0]['column']];
                                        $dir = $this->input->post('order')[0]['dir'];
                                        $table = 'site_language';

                                        $totalData = $this->Crud_model->alldata_count($table);

                                        $totalFiltered = $totalData;

                                        if (empty($this->input->post('search')['value'])) {
                                                $rows = $this->Crud_model->allsite_language($table, $limit, $start, $order, $dir);
                                        } else {
                                                $search = $this->input->post('search')['value'];
                                                $rows = $this->Crud_model->site_language_search($table, $limit, $start, $search, $order, $dir);
                                                $totalFiltered = $this->Crud_model->site_language_search_count($table, $search);
                                        }

                                        $data = array();
                                        if (!empty($rows)) {
                                                if ($dir == 'asc') {
                                                        $i = $start + 1;
                                                } elseif ($dir == 'desc') {
                                                        $i = $totalFiltered - $start;
                                                }
                                                foreach ($rows as $row) {
                                                        $nestedData['#'] = $i;
                                                        $nestedData['word'] = "<span class='abv'>" . ucwords(str_replace('_', ' ', $row->word)) . "</span>";
                                                        $nestedData['translation'] = "<form class='form-horizontal trs' id='" . $para2 . "_" . $row->word_id . "' method='post' action='" . base_url() . "admin/manage_language/upd_trn/" . $row->word_id . "'><div class='input-group' style='width:100%'><input type='text' name='translation' class='form-control input-sm ann' value='" . $row->$para2 . "' style='border: 1px solid rgb(48, 68, 87); height:24px'><span class='input-group-btn'><button type='button' class='btn btn-dark btn-xs btn-labeled fa fa-save submittera' data-wid='" . $para2 . "_" . $row->word_id . "' style='padding: 3px 5px'>Save</button></span></div><input type='hidden' name='lang' value='" . $para2 . "'></form>";

                                                        $data[] = $nestedData;
                                                        if ($dir == 'asc') {
                                                                $i++;
                                                        } elseif ($dir == 'desc') {
                                                                $i--;
                                                        }
                                                }
                                        }

                                        $json_data = array(
                                                "draw"            => intval($this->input->post('draw')),
                                                "recordsTotal"    => intval($totalData),
                                                "recordsFiltered" => intval($totalFiltered),
                                                "data"            => $data
                                        );
                                        echo json_encode($json_data);
                                }
                        } elseif ($para1 == "upd_trn") {
                                $word_id = $para2;
                                $translation = $this->input->post('translation');
                                $language = $this->input->post('lang');
                                $word = $this->db->get_where('site_language', array(
                                        'word_id' => $word_id
                                ))->row()->word;
                                add_translation($word, $language, $translation);
                        }
                }
        }

        function manage_admin()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "manage_admin/index.php";
                        $page_data['folder'] = "manage_admin";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "manage_admin/index.php";
                        $page_data['page_name'] = "manage_admin";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_your_profile!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_your_profile!");
                        } elseif ($this->session->flashdata('alert') == "pass_edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_your_password!");
                        } elseif ($this->session->flashdata('alert') == "pass_failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_your_password!");
                        } elseif ($this->session->flashdata('alert') == "pass_matched") {
                                $page_data['danger_alert'] = translate("your_current_&_new_password_can_not_be_the_same!");
                        } elseif ($this->session->flashdata('alert') == "pass_not_matched") {
                                $page_data['danger_alert'] = translate("invalid_current_password!");
                        } elseif ($this->session->flashdata('alert') == "confirm_pass_fail") {
                                $page_data['danger_alert'] = translate("your_new_and_confirm_password_is_not_matched!");
                        } elseif ($this->session->flashdata('alert') == "image_success") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_backgroundimage!");
                        } elseif ($this->session->flashdata('alert') == "failed_image") {
                                $page_data['danger_alert'] = translate("image_upload_failed!_please_make_sure_your_image_format_is_JPG,_JPEG_or_PNG.");
                        }
                        $this->load->view('back/index', $page_data);
                }
        }

        function update_admin_profile($para1 = "")
        {
                if ($para1 == "update_details") {
                        $this->form_validation->set_rules('name', 'Name', 'required');
                        $this->form_validation->set_rules('email', 'Email', 'required');
                        if ($this->form_validation->run() == FALSE) {
                                $ajax_error[] = array('ajax_error' => validation_errors());
                                echo json_encode($ajax_error);
                        } else {
                                $admin_id = $this->session->userdata('admin_id');
                                $data['name'] = $this->input->post('name');
                                $data['email'] = $this->input->post('email');
                                $data['phone'] = $this->input->post('phone');
                                $data['address'] = $this->input->post('address');
                                $this->db->where('admin_id', $admin_id);
                                $result = $this->db->update('admin', $data);
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'edit');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_edit');
                                }
                                redirect(base_url() . 'admin/manage_admin', 'refresh');
                        }
                } elseif ($para1 == "update_pass_details") {
                        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
                        $this->form_validation->set_rules('new_password', 'New Password', 'required');
                        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
                        if ($this->form_validation->run() == FALSE) {
                                redirect(base_url() . 'admin/manage_admin', 'refresh');
                        } else {
                                $admin_id = $this->session->userdata('admin_id');
                                $current_password = sha1($this->input->post('current_password'));
                                $data['password'] = sha1($this->input->post('new_password'));
                                $confirm_password = sha1($this->input->post('confirm_password'));
                                $prev_password = $this->db->get_where("admin", array("admin_id" => $admin_id))->row()->password;
                                if ($current_password == $prev_password && $data['password'] != $current_password && $data['password'] == $confirm_password) {
                                        $this->db->where('admin_id', $admin_id);
                                        $result = $this->db->update('admin', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'pass_edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'pass_failed_edit');
                                        }
                                        redirect(base_url() . 'admin/manage_admin', 'refresh');
                                } elseif ($current_password != $prev_password) {
                                        $this->session->set_flashdata('alert', 'pass_not_matched');
                                        redirect(base_url() . 'admin/manage_admin', 'refresh');
                                } elseif ($data['password'] == $current_password) {
                                        $this->session->set_flashdata('alert', 'pass_matched');
                                        redirect(base_url() . 'admin/manage_admin', 'refresh');
                                } elseif ($data['password'] != $confirm_password) {
                                        $this->session->set_flashdata('alert', 'confirm_pass_fail');
                                        redirect(base_url() . 'admin/manage_admin', 'refresh');
                                }
                        }
                } elseif ($para1 == "update_login_page") {
                        $prev_image_info = $this->db->get_where('general_settings', array('type' => 'admin_login_image'))->row()->value;
                        if ($prev_image_info != '[]') {
                                $prev_image_info = json_decode($prev_image_info, true);
                                $prev_image = $prev_image_info[0]['image'];
                        }
                        $is_edit = $this->input->post('is_edit');
                        if ($is_edit == '0') {
                                if ($_FILES['admin_login_image']['name'] !== '') {
                                        $path = $_FILES['admin_login_image']['name'];
                                        $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                        $img_file_name = "admin_login_image_" . time() . $ext;
                                        if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                move_uploaded_file($_FILES['admin_login_image']['tmp_name'], 'uploads/admin_login_image/' . $img_file_name);
                                                $admin_login_image[] = array('image' => $img_file_name);

                                                $data['value'] = json_encode($admin_login_image);

                                                $this->db->where('type', 'admin_login_image');
                                                $this->db->update('general_settings', $data);
                                                recache();

                                                $this->session->set_flashdata('alert', 'image_success');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_image');
                                        }
                                }
                                $this->session->set_flashdata('alert', 'image_success');
                        } elseif ($is_edit == '1') {
                                if ($_FILES['admin_login_image']['name'] !== '') {
                                        $path = $_FILES['admin_login_image']['name'];
                                        $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                        $img_file_name = "admin_login_image_" . time() . $ext;
                                        if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                move_uploaded_file($_FILES['admin_login_image']['tmp_name'], 'uploads/admin_login_image/' . $img_file_name);
                                                $admin_login_image[] = array('image' => $img_file_name);

                                                $data['value'] = json_encode($admin_login_image);

                                                $this->db->where('type', 'admin_login_image');
                                                $this->db->update('general_settings', $data);
                                                recache();

                                                if ($prev_image_info != '[]' && file_exists('uploads/admin_login_image/' . $prev_image)) {
                                                        unlink('uploads/admin_login_image/' . $prev_image);
                                                }
                                                $this->session->set_flashdata('alert', 'image_success');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_image');
                                        }
                                }
                        }
                        redirect(base_url() . 'admin/manage_admin', 'refresh');
                } elseif ($para1 == "update_forget_pass_page") {
                        $prev_image_info = $this->db->get_where('general_settings', array('type' => 'forget_pass_image'))->row()->value;
                        if ($prev_image_info != '[]') {
                                $prev_image_info = json_decode($prev_image_info, true);
                                $prev_image = $prev_image_info[0]['image'];
                        }
                        $is_edit = $this->input->post('is_edit');
                        if ($is_edit == '0') {
                                if ($_FILES['forget_pass_image']['name'] !== '') {
                                        $path = $_FILES['forget_pass_image']['name'];
                                        $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                        $img_file_name = "forget_pass_image_" . time() . $ext;
                                        if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                move_uploaded_file($_FILES['forget_pass_image']['tmp_name'], 'uploads/forget_pass_image/' . $img_file_name);
                                                $forget_pass_image[] = array('image' => $img_file_name);

                                                $data['value'] = json_encode($forget_pass_image);

                                                $this->db->where('type', 'forget_pass_image');
                                                $this->db->update('general_settings', $data);
                                                recache();

                                                $this->session->set_flashdata('alert', 'image_success');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_image');
                                        }
                                }
                                $this->session->set_flashdata('alert', 'image_success');
                        } elseif ($is_edit == '1') {
                                if ($_FILES['forget_pass_image']['name'] !== '') {
                                        $path = $_FILES['forget_pass_image']['name'];
                                        $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                        $img_file_name = "forget_pass_image_" . time() . $ext;
                                        if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                move_uploaded_file($_FILES['forget_pass_image']['tmp_name'], 'uploads/forget_pass_image/' . $img_file_name);
                                                $forget_pass_image[] = array('image' => $img_file_name);

                                                $data['value'] = json_encode($forget_pass_image);

                                                $this->db->where('type', 'forget_pass_image');
                                                $this->db->update('general_settings', $data);
                                                recache();

                                                if ($prev_image_info != '[]' && file_exists('uploads/forget_pass_image/' . $prev_image)) {
                                                        unlink('uploads/forget_pass_image/' . $prev_image);
                                                }
                                                $this->session->set_flashdata('alert', 'image_success');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_image');
                                        }
                                }
                        }
                        redirect(base_url() . 'admin/manage_admin', 'refresh');
                }
        }

        function profile_sections()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "profile_sections/index.php";
                        $page_data['folder'] = "profile_sections";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "profile_sections/index.php";
                        $page_data['page_name'] = "profile_sections";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
                        }

                        $this->load->view('back/index', $page_data);
                }
        }

        function update_profile_sections_settings()
        {
                $present_address_status = $this->input->post('present_address_status');
                $education_and_career_status = $this->input->post('education_and_career_status');
                $physical_attributes_status = $this->input->post('physical_attributes_status');
                $language_status = $this->input->post('language_status');
                $hobbies_and_interests_status = $this->input->post('hobbies_and_interests_status');
                $personal_attitude_and_behavior_status = $this->input->post('personal_attitude_and_behavior_status');
                $residency_information_status = $this->input->post('residency_information_status');
                $spiritual_and_social_background_status = $this->input->post('spiritual_and_social_background_status');
                $life_style_status = $this->input->post('life_style_status');
                $astronomic_information_status = $this->input->post('astronomic_information_status');
                $permanent_address_status = $this->input->post('permanent_address_status');
                $family_information_status = $this->input->post('family_information_status');
                $additional_personal_details_status = $this->input->post('additional_personal_details_status');
                $partner_expectation_status = $this->input->post('partner_expectation_status');
                if (isset($present_address_status)) {
                        $data1['value'] = "yes";
                } else {
                        $data1['value'] = "no";
                }
                if (isset($education_and_career_status)) {
                        $data2['value'] = "yes";
                } else {
                        $data2['value'] = "no";
                }
                if (isset($physical_attributes_status)) {
                        $data3['value'] = "yes";
                } else {
                        $data3['value'] = "no";
                }
                if (isset($language_status)) {
                        $data4['value'] = "yes";
                } else {
                        $data4['value'] = "no";
                }
                if (isset($hobbies_and_interests_status)) {
                        $data5['value'] = "yes";
                } else {
                        $data5['value'] = "no";
                }
                if (isset($personal_attitude_and_behavior_status)) {
                        $data6['value'] = "yes";
                } else {
                        $data6['value'] = "no";
                }
                if (isset($residency_information_status)) {
                        $data7['value'] = "yes";
                } else {
                        $data7['value'] = "no";
                }
                if (isset($spiritual_and_social_background_status)) {
                        $data8['value'] = "yes";
                } else {
                        $data8['value'] = "no";
                }
                if (isset($life_style_status)) {
                        $data9['value'] = "yes";
                } else {
                        $data9['value'] = "no";
                }
                if (isset($astronomic_information_status)) {
                        $data10['value'] = "yes";
                } else {
                        $data10['value'] = "no";
                }
                if (isset($permanent_address_status)) {
                        $data11['value'] = "yes";
                } else {
                        $data11['value'] = "no";
                }
                if (isset($family_information_status)) {
                        $data12['value'] = "yes";
                } else {
                        $data12['value'] = "no";
                }
                if (isset($additional_personal_details_status)) {
                        $data13['value'] = "yes";
                } else {
                        $data13['value'] = "no";
                }
                if (isset($partner_expectation_status)) {
                        $data14['value'] = "yes";
                } else {
                        $data14['value'] = "no";
                }

                $this->db->where('type', 'present_address');
                $this->db->update('frontend_settings', $data1);

                $this->db->where('type', 'education_and_career');
                $this->db->update('frontend_settings', $data2);

                $this->db->where('type', 'physical_attributes');
                $this->db->update('frontend_settings', $data3);

                $this->db->where('type', 'language');
                $this->db->update('frontend_settings', $data4);

                $this->db->where('type', 'hobbies_and_interests');
                $this->db->update('frontend_settings', $data5);

                $this->db->where('type', 'personal_attitude_and_behavior');
                $this->db->update('frontend_settings', $data6);

                $this->db->where('type', 'residency_information');
                $this->db->update('frontend_settings', $data7);

                $this->db->where('type', 'spiritual_and_social_background');
                $this->db->update('frontend_settings', $data8);

                $this->db->where('type', 'life_style');
                $this->db->update('frontend_settings', $data9);

                $this->db->where('type', 'astronomic_information');
                $this->db->update('frontend_settings', $data10);

                $this->db->where('type', 'permanent_address');
                $this->db->update('frontend_settings', $data11);

                $this->db->where('type', 'family_information');
                $this->db->update('frontend_settings', $data12);

                $this->db->where('type', 'additional_personal_details');
                $this->db->update('frontend_settings', $data13);

                $this->db->where('type', 'partner_expectation');
                $result = $this->db->update('frontend_settings', $data14);

                recache();

                if ($result) {
                        $this->session->set_flashdata('alert', 'edit');
                } else {
                        $this->session->set_flashdata('alert', 'failed_edit');
                }
                redirect(base_url() . 'admin/profile_sections', 'refresh');
        }


        function social_media_comments()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "social_media_comments/index.php";
                        $page_data['folder'] = "social_media_comments";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "social_media_comments/index.php";
                        $page_data['page_name'] = "social_media_comments";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
                        }

                        $this->load->view('back/index', $page_data);
                }
        }

        function update_social_media_comments_settings()
        {
                $data1['value'] = $this->input->post('type');
                $data2['value'] = $this->input->post('discus_id');
                $data3['value'] = $this->input->post('facebook_comment_api');

                $this->db->where('type', 'comment_type');
                $result = $this->db->update('third_party_settings', $data1);

                $this->db->where('type', 'discus_id');
                $result = $this->db->update('third_party_settings', $data2);

                $this->db->where('type', 'fb_comment_api');
                $result = $this->db->update('third_party_settings', $data3);
                recache();

                if ($result) {
                        $this->session->set_flashdata('alert', 'edit');
                } else {
                        $this->session->set_flashdata('alert', 'failed_edit');
                }
                redirect(base_url() . 'admin/social_media_comments', 'refresh');
        }

        function captcha_settings()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "captcha_settings/index.php";
                        $page_data['folder'] = "captcha_settings";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "captcha_settings/index.php";
                        $page_data['page_name'] = "captcha_settings";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
                        }

                        $this->load->view('back/index', $page_data);
                }
        }

        function update_captcha_settings()
        {
                $captcha_activation = $this->input->post('captcha_activation');
                if (isset($captcha_activation)) {
                        $data1['value'] = "ok";
                } else {
                        $data1['value'] = "no";
                }
                $data2['value'] = $this->input->post('captcha_public');
                $data3['value'] = $this->input->post('captcha_private');

                $this->db->where('type', 'captcha_status');
                $result = $this->db->update('third_party_settings', $data1);

                $this->db->where('type', 'captcha_public');
                $result = $this->db->update('third_party_settings', $data2);

                $this->db->where('type', 'captcha_private');
                $result = $this->db->update('third_party_settings', $data3);
                recache();

                if ($result) {
                        $this->session->set_flashdata('alert', 'edit');
                } else {
                        $this->session->set_flashdata('alert', 'failed_edit');
                }
                redirect(base_url() . 'admin/captcha_settings', 'refresh');
        }

        function google_analytics_settings()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "google_analytics_settings/index.php";
                        $page_data['folder'] = "google_analytics_settings";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "google_analytics_settings/index.php";
                        $page_data['page_name'] = "google_analytics_settings";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
                        }

                        $this->load->view('back/index', $page_data);
                }
        }

        function update_google_analytics_settings()
        {
                $google_analytics_activation = $this->input->post('google_analytics_activation');
                if (isset($google_analytics_activation)) {
                        $data1['value'] = "yes";
                } else {
                        $data1['value'] = "no";
                }
                $data2['value'] = $this->input->post('google_analytics_key');

                $this->db->where('type', 'google_analytics_set');
                $result = $this->db->update('third_party_settings', $data1);

                $this->db->where('type', 'google_analytics_key');
                $result = $this->db->update('third_party_settings', $data2);
                recache();

                if ($result) {
                        $this->session->set_flashdata('alert', 'edit');
                } else {
                        $this->session->set_flashdata('alert', 'failed_edit');
                }
                redirect(base_url() . 'admin/google_analytics_settings', 'refresh');
        }

        function seo_settings()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "seo_settings/index.php";
                        $page_data['folder'] = "seo_settings";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "seo_settings/index.php";
                        $page_data['page_name'] = "seo_settings";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
                        }

                        $this->load->view('back/index', $page_data);
                }
        }

        function social_media_setting()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "social_media_setting/index.php";
                        $page_data['folder'] = "social_media_setting";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "social_media_setting/index.php";
                        $page_data['page_name'] = "social_media_setting";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
                        }

                        $page_data['data'] = $this->db->get('social_media_settings')->result();
                        $this->load->view('back/index', $page_data);
                }
        }

        function update_social_media_setting($id)
        {
                
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "social_media_setting/index.php";
                        $page_data['folder'] = "social_media_setting";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "social_media_setting/index.php";
                        $page_data['page_name'] = "social_media_setting";
                        
                        $data=array(
                            'content' => $this->input->post('content'),
                        );
                        // echo "<pre>";
                        // print_r($data);die();
                        $this->db->where('id',$id);
                        $result = $this->db->update('social_media_settings',$data);
                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }

                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
                        }

                        $page_data['data'] = $this->db->get('social_media_settings')->result();
                        $this->load->view('back/index', $page_data);
                }
        }

        function update_seo_settings()
        {
                $data1['value'] = $this->input->post('seo_keywords');
                $data2['value'] = $this->input->post('seo_author');
                $data3['value'] = $this->input->post('seo_revisit');
                $data4['value'] = $this->input->post('seo_description');

                $this->db->where('general_settings_id', 25);
                $result = $this->db->update('general_settings', $data1);

                $this->db->where('general_settings_id', 26);
                $result = $this->db->update('general_settings', $data2);

                $this->db->where('general_settings_id', 54);
                $result = $this->db->update('general_settings', $data3);
                $this->db->where('general_settings_id', 24);
                $result = $this->db->update('general_settings', $data4);
                recache();

                if ($result) {
                        $this->session->set_flashdata('alert', 'edit');
                } else {
                        $this->session->set_flashdata('alert', 'failed_edit');
                }
                redirect(base_url() . 'admin/seo_settings', 'refresh');
        }

        function email_setup()
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        $page_data['top'] = "email_setup/index.php";
                        $page_data['folder'] = "email_setup";
                        $page_data['file'] = "index.php";
                        $page_data['bottom'] = "email_setup/index.php";
                        $page_data['page_name'] = "email_setup";
                        if ($this->session->flashdata('alert') == "edit") {
                                $page_data['success_alert'] = translate("you_have_successfully_updated_the_settings!");
                        } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                $page_data['danger_alert'] = translate("failed_to_updated_the_settings!");
                        }

                        $this->load->view('back/index', $page_data);
                }
        }

        function update_email_setup($para1 = "")
        {
                if ($para1 == "password_reset_email") {
                        $data1['subject'] = $this->input->post('password_reset_email_sub');
                        $data2['body'] = $this->input->post('password_reset_email_body');

                        $this->db->where('email_template_id', 1);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 1);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                } elseif ($para1 == "package_purchase_email") {
                        $data1['subject'] = $this->input->post('account_approval_email_sub');
                        $data2['body'] = $this->input->post('account_approval_email_body');

                        $this->db->where('email_template_id', 2);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 2);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                } 
		    	elseif ($para1 == "cover_pic_payment_complete") {
                        $data1['subject'] = $this->input->post('cover_pic_payment_complete_sub');
                        $data2['body'] = $this->input->post('cover_pic_payment_complete_body');

                        $this->db->where('email_template_id', 25);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 25);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }

                elseif ($para1 == "cover_pic_approve") {
                        $data1['subject'] = $this->input->post('cover_pic_approve_sub');
                        $data2['body'] = $this->input->post('cover_pic_approve_body');

                        $this->db->where('email_template_id', 26);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 26);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }

                elseif ($para1 == "cover_pic_send") {
                        $data1['subject'] = $this->input->post('cover_pic_send_sub');
                        $data2['body'] = $this->input->post('cover_pic_send_body');

                        $this->db->where('email_template_id', 27);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 27);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }  
                elseif ($para1 == "blank_email_letter") {
                        $data1['subject'] = $this->input->post('blank_email_letter_sub');
                        $data2['body'] = $this->input->post('blank_email_letter_body');

                        $this->db->where('email_template_id', 29);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 29);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                } 
			
                  elseif ($para1 == "account_opening_email") {
                        $data1['subject'] = $this->input->post('account_opening_email_sub');
                        $data2['body'] = $this->input->post('account_opening_email_body');

                        $this->db->where('email_template_id', 4);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 4);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                } elseif ($para1 == "staff_add_email") {
                        $data1['subject'] = $this->input->post('staff_add_email_sub');
                        $data2['body'] = $this->input->post('staff_add_email_body');

                        $this->db->where('email_template_id', 5);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 5);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                } elseif ($para1 == "deleted_member_email") {
                        $data1['subject'] = $this->input->post('delete_member_email_sub');
                        $data2['body'] = $this->input->post('delete_member_email_body');

                        $this->db->where('email_template_id', 6);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 6);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                } elseif ($para1 == "no_pic_email") {
                        $data1['subject'] = $this->input->post('no_pic_email_sub');
                        $data2['body'] = $this->input->post('no_pic_email_body');

                        $this->db->where('email_template_id', 7);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 7);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                } elseif ($para1 == "incomplete_profile_email") {
                        $data1['subject'] = $this->input->post('incomplete_profile_email_sub');
                        $data2['body'] = $this->input->post('incomplete_profile_email_body');

                        $this->db->where('email_template_id', 8);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 8);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "downgrade_to_bronze_email") {
                        $data1['subject'] = $this->input->post('downgrade_to_bronze_email_sub');
                        $data2['body'] = $this->input->post('downgrade_to_bronze_email_body');

                        $this->db->where('email_template_id', 12);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 12);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "platinum_subscription_email") {
                        $data1['subject'] = $this->input->post('platinum_subscription_email_sub');
                        $data2['body'] = $this->input->post('platinum_subscription_email_body');

                        $this->db->where('email_template_id', 13);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 13);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "bronze_subscription_email") {
                        $data1['subject'] = $this->input->post('bronze_subscription_email_sub');
                        $data2['body'] = $this->input->post('bronze_subscription_email_body');

                        $this->db->where('email_template_id', 14);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 14);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "photo_submission_email") {
                        $data1['subject'] = $this->input->post('photo_submission_email_sub');
                        $data2['body'] = $this->input->post('photo_submission_email_body');

                        $this->db->where('email_template_id', 15);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 15);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "video_submission_email") {
                        $data1['subject'] = $this->input->post('video_submission_email_sub');
                        $data2['body'] = $this->input->post('video_submission_email_body');

                        $this->db->where('email_template_id', 16);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 16);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "photo_approval_email") {
                        $data1['subject'] = $this->input->post('photo_approval_email_sub');
                        $data2['body'] = $this->input->post('photo_approval_email_body');

                        $this->db->where('email_template_id', 17);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 17);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "ads_approval_email") {
                        $data1['subject'] = $this->input->post('ads_approval_email_sub');
                        //$data2['body'] = $this->input->post('ads_approval_email_body');
                        $data2['body'] = $_POST['ads_approval_email_body'];
						//print_r($data2['body']);die();
                        $this->db->where('email_template_id', 22);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 22);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "ads_reject_email") {
                        $data1['subject'] = $this->input->post('ads_reject_email_sub');
                        $data2['body'] = $this->input->post('ads_reject_email_body');

                        $this->db->where('email_template_id', 23);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 23);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "ads_url_email") {
                        $data1['subject'] = $this->input->post('ads_url_email_sub');
                        $data2['body'] = $this->input->post('ads_url_email_body');

                        $this->db->where('email_template_id', 24);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 24);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                
                elseif ($para1 == "ads_expired_email") {
                        $data1['subject'] = $this->input->post('ads_expired_email_sub');
                        $data2['body'] = $this->input->post('ads_expired_email_body');

                        $this->db->where('email_template_id', 28);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 28);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "video_approval_email") {
                        $data1['subject'] = $this->input->post('video_approval_email_sub');
                        $data2['body'] = $this->input->post('video_approval_email_body');

                        $this->db->where('email_template_id', 18);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 18);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "photo_rejection_email") {
                        $data1['subject'] = $this->input->post('photo_rejection_email_sub');
                        $data2['body'] = $this->input->post('photo_rejection_email_body');

                        $this->db->where('email_template_id', 19);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 19);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "video_rejection_email") {
                        $data1['subject'] = $this->input->post('video_rejection_email_sub');
                        $data2['body'] = $this->input->post('video_rejection_email_body');

                        $this->db->where('email_template_id', 20);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 20);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "delete_account_email") {
                        $data1['subject'] = $this->input->post('delete_account_email_sub');
                        $data2['body'] = $this->input->post('delete_account_email_body');

                        $this->db->where('email_template_id', 11);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 11);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "paypal_payment_failure_email") {
                        $data1['subject'] = $this->input->post('paypal_payment_failure_email_sub');
                        $data2['body'] = $this->input->post('paypal_payment_failure_email_body');

                        $this->db->where('email_template_id', 21);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 21);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "paypal_payment_success_mail") {
                        $data1['subject'] = $this->input->post('paypal_payment_success_mail_sub');
                        $data2['body'] = $this->input->post('paypal_payment_success_mail_body');

                        $this->db->where('email_template_id', 30);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 30);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }

                elseif ($para1 == "coverPic_recject_mail") {
                        $data1['subject'] = $this->input->post('coverPic_recject_mail_sub');
                        $data2['body'] = $this->input->post('coverPic_recject_mail_body');

                        $this->db->where('email_template_id', 31);
                        $result = $this->db->update('email_template', $data1);

                        $this->db->where('email_template_id', 31);
                        $result = $this->db->update('email_template', $data2);
                        recache();

                        if ($result) {
                                $this->session->set_flashdata('alert', 'edit');
                        } else {
                                $this->session->set_flashdata('alert', 'failed_edit');
                        }
                        redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "no_pic_profile_email") {
                    $data1['subject'] = $this->input->post('no_pic_profile_email_sub');
                    $data2['body'] = $this->input->post('no_pic_profile_email_body');

                    $this->db->where('email_template_id', 7);
                    $result = $this->db->update('email_template', $data1);

                    $this->db->where('email_template_id', 7);
                    $result = $this->db->update('email_template', $data2);
                    recache();

                    if ($result) {
                            $this->session->set_flashdata('alert', 'edit');
                    } else {
                            $this->session->set_flashdata('alert', 'failed_edit');
                    }
                    redirect(base_url() . 'admin/email_setup', 'refresh');
                }
                elseif ($para1 == "interest_email") {
                    $data1['subject'] = $this->input->post('interest_email_sub');
                    $data2['body'] = $this->input->post('interest_email_body');

                    $this->db->where('email_template_id', 10);
                    $result = $this->db->update('email_template', $data1);

                    $this->db->where('email_template_id', 10);
                    $result = $this->db->update('email_template', $data2);
                    recache();

                    if ($result) {
                            $this->session->set_flashdata('alert', 'edit');
                    } else {
                            $this->session->set_flashdata('alert', 'failed_edit');
                    }
                    redirect(base_url() . 'admin/email_setup', 'refresh');
                }
        }

        function check_login()
        {
                if ($this->admin_permission() == TRUE) {
                        redirect(base_url() . 'admin/', 'refresh');
                } else {
                        $username = $this->input->post('email');
                        $password = sha1($this->input->post('password'));

                        $result = $this->Crud_model->check_login('admin', $username, $password);
                        // echo $this->db->last_query();

                        $data = array();
                        if ($result) {
                                $data['admin_name'] = $result->email;
                                $data['admin_id'] = $result->admin_id;

                                $this->session->set_userdata($data);

                                redirect(base_url() . 'admin/', 'refresh');
                        } else {
                                $this->session->set_flashdata('alert', 'login_error');

                                redirect(base_url() . 'admin/login', 'refresh');
                        }
                }
        }

        function logout()
        {
                $this->session->unset_userdata('admin_name');
                $this->session->unset_userdata('admin_id');

                redirect(base_url() . 'admin/login', 'refresh');
        }

        // Mubassir Working
        public function chat_icons($id = '')
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        if ($id == '') {
                                $page_data['title'] = "Admin || " . $this->system_title;
                                $page_data['top'] = "chat_icons/index.php";
                                $page_data['folder'] = "chat_icons";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "chat_icons/index.php";
                                $page_data['page_name'] = "chat_heads";
                                $this->load->view('back/index', $page_data);
                        } else {
                                $details['data'] = $this->Crud_model->getChatIcons($id)[0];
                                if (file_exists('uploads/chat_icons/' . $details['data']->thumbnails)) {
                                        $details['data']->thumbnails = base_url() . "uploads/chat_icons/" . $details["data"]->thumbnails;
                                } else {
                                        $details['data']->thumbnails = base_url() . "uploads/chat_icons/default_image.png";
                                }
                                $details['icons'] = $this->Crud_model->getChatIconsChilds($id);
                                $this->load->view('back/chat_icons/details', $details);
                        }
                }
        }
        public function chat_icons_list()
        {
                $columns = array(
                        0 => '',
                        1 => 'name',
                        2 => 'thumbnails',
                        3 => 'status',
                );
                $limit = $this->input->post('length');
                $start = $this->input->post('start');
                $order = $columns[$this->input->post('order')[0]['column']];
                $dir = $this->input->post('order')[0]['dir'];
                $table = 'chat_icons_head';

                $totalData = $this->Crud_model->alldata_count($table);
                $totalFiltered = $totalData;
                if (empty($this->input->get('search'))) {
                        $rows = $this->Crud_model->allChatIcons($table, $limit, $start, $order, $dir);
                        //     $rows = print_r($this->Crud_model->allChatIcons($table,0,0,0,0)); //for test
                } else {
                        $search = $this->input->get('search');
                        $rows =  $this->Crud_model->ChatIcons_search($table, $limit, $start, $search, $order, $dir);
                        $totalFiltered = $this->Crud_model->allChatIcons_search_count($table, $search);
                }
                $data = array();
                if (!empty($rows)) {
                        // if ($dir == 'asc') { $i = $start + 1; } elseif ($dir == 'desc') { $i = $totalFiltered - $start; }
                        foreach ($rows as $row) {
                                if (file_exists('uploads/chat_icons/' . $row->thumbnails)) {
                                        $thumbnails = "<img src='" . base_url() . "uploads/chat_icons/" . $row->thumbnails . "' class='img-sm'>";
                                } else {
                                        $thumbnails = "<img src='" . base_url() . "uploads/chat_icons/default_image.png' class='img-sm'>";
                                }

                                $nestedData['thumbnails'] = $thumbnails;
                                $nestedData['title'] = $row->name;
                                $nestedData['count'] = $row->count;
                                $nestedData['status'] = $row->isActive ? '<span class="badge badge-primary badge-sm">Active</span>' : '<span class="badge badge-danger badge-sm">Inactive</span>';
                                $nestedData['options'] = "
                                <button data-target='#view_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('view') . "' onclick='GetDetails(" . $row->id . ")'><i class='fa fa-eye'></i></button>
                                <button data-target='#edit_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('edit') . "' onclick='EditDetails(" . $row->id . ")'><i class='fa fa-edit'></i></button>
                                <button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('Change Status') . "' onclick='delIcons(" . $row->id . ")'><i class='fa fa-trash'></i></button>";
                                $data[] = $nestedData;
                        }
                }

                $json_data = array(
                        "draw"            => intval($this->input->post('draw')),
                        "recordsTotal"    => intval($totalData),
                        "recordsFiltered" => intval($totalFiltered),
                        "data"            => $data
                );
                echo json_encode($json_data);
        }
        public function chat_icons_del($id = '')
        {
                $data = $this->db->get_where('chat_icons_head', array('id' => $id));
                if ($id == '' || $data->num_rows() <= 0) {
                        echo "Invalid Refrence";
                } else {
                        $data = $data->result()[0]->isActive;
                        $this->db->where('id', $id);
                        $result = $this->db->update('chat_icons_head', array('isActive' => $data ? 0 : 1));
                        echo $data ? "Inactivated" : "Activated";
                }
        }
        public function chat_icon_edit($id = '')
        {
                if ($id == "do_add") {
                        if (empty($this->input->post('refrence'))) { //add
                                $isValid = true;
                                $saved = $this->saveIconFile($_FILES);
                                $req = array(
                                        'name' => $this->input->post('name'),
                                );
                                if ($saved[0]) {
                                        $req['thumbnails'] = $saved[1];
                                } else {
                                        $req['thumbnails'] = "default_image.png";
                                        $isValid = false;
                                }
                                $this->db->insert('chat_icons_head', $req);
                                if ($isValid) {
                                        $this->session->set_flashdata('alert', "Data inserted succesfully");
                                } else {
                                        $this->session->set_flashdata('alert', $saved[1]);
                                }
                                redirect(base_url() . 'admin/chat_icons/', 'refresh');
                        } else { //edit
                                $data = $this->db->get_where('chat_icons_head', array('id' => $this->input->post('refrence')));
                                if ($id == '' || $data->num_rows() <= 0) {
                                        echo "Invalid Refrence";
                                } else {
                                        $isValid = true;
                                        $req = array(
                                                'name' => $this->input->post('name'),
                                                'thumbnails' => $this->input->post('thumbnails_edited'),
                                        );
                                        if ($req['thumbnails'] != '' && $req['thumbnails'] == 1) {
                                                $saved = $this->saveIconFile($_FILES);
                                                if ($saved[0]) {
                                                        $req['thumbnails'] = $saved[1];
                                                } else {
                                                        $req['thumbnails'] = $data->result()[0]->thumbnails;
                                                        $isValid = false;
                                                }
                                        } else {
                                                $req['thumbnails'] = $data->result()[0]->thumbnails;
                                        }
                                        $this->db->where('id', $this->input->post('refrence'));
                                        $this->db->update('chat_icons_head', $req);
                                        if ($isValid) {
                                                $this->session->set_flashdata('alert', "Updated Succesfully");
                                        } else {
                                                $this->session->set_flashdata('alert', $saved[1]);
                                        }
                                        redirect(base_url() . 'admin/chat_icons/', 'refresh');
                                }
                        }
                } else {
                        $data = $this->db->get_where('chat_icons_head', array('id' => $id));
                        if ($id == '' || $data->num_rows() <= 0) {
                                echo "<h3>Invalid Refrence</h3>";
                        } else {
                                $details['data'] = $data->result()[0];
                                if (file_exists('uploads/chat_icons/' . $details['data']->thumbnails)) {
                                        $details['data']->thumbnails = base_url() . "uploads/chat_icons/" . $details["data"]->thumbnails;
                                } else {
                                        $details['data']->thumbnails = base_url() . "uploads/chat_icons/default_image.png";
                                }
                                $this->load->view('back/chat_icons/edit', $details);
                        }
                }
        }

        public function saveIconFile($files)
        {
                $path = $_FILES['thumbnails']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext == 'png') {
                        $img_file_name = strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
                        move_uploaded_file($_FILES['thumbnails']['tmp_name'], 'uploads/chat_icons/' . $img_file_name);
                        return [true, $img_file_name];
                } else {
                        return [false, "thumbnails should be transparent (png)"];
                }
        }

        public function chat_icons_group($id = '')
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        if ($id == '') {
                                $page_data['title'] = "Admin || " . $this->system_title;
                                $page_data['top'] = "chat_icons/index.php";
                                $page_data['folder'] = "chat_icons/group";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "chat_icons/index.php";
                                $page_data['page_name'] = "group_icons";
                                $page_data['heads'] = $this->db->get_where('chat_icons_head', array('isActive' => 1))->result();
                                $this->load->view('back/index', $page_data);
                        } else {
                                $details['data'] = $this->Crud_model->getChatGroupIcons($id)[0];
                                if (!file_exists($details['data']->icon)) {
                                        $details['data']->thumbnails = base_url() . "uploads/chat_icons/default_image.png";
                                }
                                $this->load->view('back/chat_icons/group/details', $details);
                        }
                }
        }
        
        

        public function group_icons_list()
        {
                $columns = array(
                        0 => '',
                        1 => 'chat_icons_id',
                        2 => 'icon',
                        3 => 'tittle',
                        4 => 'status'
                );
                $limit = $this->input->post('length');
                $start = $this->input->post('start');
                $order = 0; //$columns[$this->input->post('order')[0]['column']];
                $dir = 'asc'; //$this->input->post('order')[0]['dir'];
                $table = 'chat_icons_meta';

                $totalData = $this->Crud_model->alldata_count($table);
                $totalFiltered = $totalData;
                if (empty($this->input->get('search'))) {
                        $rows = $this->Crud_model->allGroupIcons($table, $limit, $start, $order, $dir);
                } else {
                        $search = $this->input->get('search');
                        $rows =  $this->Crud_model->GroupIcons_search($table, $limit, $start, $search, $order, $dir);
                        $totalFiltered = $this->Crud_model->allgroupIcons_search_count($table, $search);
                }
                $data = array();
                if (!empty($rows)) {
                        foreach ($rows as $row) {
                                $icon = "<img src='" . $row->icon . "' class='img-sm'>";
                                $nestedData['icon'] = $icon;
                                $nestedData['title'] = $row->tittle;
                                $nestedData['head'] = $row->parent;
                                $nestedData['status'] = $row->isActive ? '<span class="badge badge-primary badge-sm">Active</span>' : '<span class="badge badge-danger badge-sm">Inactive</span>';
                                $nestedData['options'] = "
                                <button data-target='#view_modal' data-toggle='modal' class='btn btn-success btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('view') . "' onclick='GetDetails(" . $row->id . ")'><i class='fa fa-eye'></i></button>
                                <button data-target='#edit_modal' data-toggle='modal' class='btn btn-primary btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('edit') . "' onclick='EditDetails(" . $row->id . ")'><i class='fa fa-edit'></i></button>
                                <button data-target='#delete_modal' data-toggle='modal' class='btn btn-danger btn-xs add-tooltip' data-toggle='tooltip' data-placement='top' title='" . translate('Change Status') . "' onclick='delIcons(" . $row->id . ")'><i class='fa fa-trash'></i></button>";
                                $data[] = $nestedData;
                        }
                }

                $json_data = array(
                        "draw"            => intval($this->input->post('draw')),
                        "recordsTotal"    => intval($totalData),
                        "recordsFiltered" => intval($totalFiltered),
                        "data"            => $data
                );
                echo json_encode($json_data);
        }

        public function group_icons_del($id = '')
        {
                $data = $this->db->get_where('chat_icons_meta', array('id' => $id));
                if ($id == '' || $data->num_rows() <= 0) {
                        echo "Invalid Refrence";
                } else {
                        $this->db->where('id', $id);
                        $this->db->update('chat_icons_meta', array('isActive' => 0));
                        echo "Deleted";
                }
        }

        public function group_icon_edit($id = '')
        {
                if ($id == "do_add") {
                        $data = $this->db->get_where('chat_icons_meta', array('id' => $this->input->post('refrence')));
                        if ($id == '' || $data->num_rows() <= 0) {
                                echo "Invalid Refrence";
                        } else {
                                $isValid = true;
                                $req = array(
                                        'tittle' => $this->input->post('name'),
                                        'icon' => $this->input->post('thumbnails_edited'),
                                );
                                if ($req['icon'] != '' && $req['icon'] == 1) {
                                        $saved = $this->saveIconGFile($_FILES);
                                        if ($saved[0]) {
                                                $req['icon'] = $saved[1];
                                        } else {
                                                $req['icon'] = $data->result()[0]->thumbnails;
                                                $isValid = false;
                                        }
                                } else {
                                        $req['icon'] = $data->result()[0]->thumbnails;
                                }
                                $this->db->where('id', $this->input->post('refrence'));
                                $this->db->update('chat_icons_meta', $req);
                                if ($isValid) {
                                        $this->session->set_flashdata('alert', "Updated Succesfully");
                                } else {
                                        $this->session->set_flashdata('alert', $saved[1]);
                                }
                                redirect(base_url() . 'admin/chat_icons_group/', 'refresh');
                        }
                } else {
                        $data = $this->db->get_where('chat_icons_meta', array('id' => $id));
                        if ($id == '' || $data->num_rows() <= 0) {
                                echo "<h3>Invalid Refrence</h3>";
                        } else {
                                $details['data'] = $data->result()[0];
                                $this->load->view('back/chat_icons/group/edit', $details);
                        }
                }
        }

        public function saveIconGFile($files)
        {
                $path = $_FILES['thumbnails']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext == 'png') {
                        $img_file_name = 'uploads/chat_icons/' . strtotime(date('Y-m-d H:i:s')) . '.' . $ext;
                        move_uploaded_file($_FILES['thumbnails']['tmp_name'], $img_file_name);
                        return [true, base_url() . $img_file_name];
                } else {
                        return [false, "thumbnails should be transparent (png)"];
                }
        }
        public function group_icon_add()
        {
                $isValid = true;
                $msg = "Updated Succesfully";
                if (empty($this->input->post('head')) || $this->input->post('head') == 0) {
                        $isValid = false;
                        $msg = "Please Select The Head";
                } else {
                        $head = $this->input->post('head');
                        $cpt = count($_FILES['icons']['name']);
                        if ($cpt > 0) {
                                for ($i = 0; $i < $cpt; $i++) {
                                        $_FILES['icons']['name'][$i];
                                        $ext = strtolower(pathinfo($_FILES['icons']['name'][$i], PATHINFO_EXTENSION));
                                        $img_file_name = 'uploads/chat_icons/' . strtotime(date('Y-m-d H:i:s')) . $head . $i . '.' . $ext;
                                        move_uploaded_file($_FILES['icons']['tmp_name'][$i], $img_file_name);
                                        if ($ext == "png") {
                                                $data = array(
                                                        'chat_icons_id' => $head,
                                                        'icon' => base_url() . $img_file_name,
                                                        'tittle' => $this->input->post('icon_tittle[' . $i . ']'),
                                                );
                                                $this->db->insert('chat_icons_meta', $data);
                                        } else {
                                                $msg = "Some Files Was Not Transparent";
                                        }
                                }
                        } else {
                                $isValid = false;
                                $msg = "Please Select Some Icons";
                        }
                }
                if ($isValid) {
                        $this->session->set_flashdata('alert', $msg);
                }
                redirect(base_url() . 'admin/chat_icons_group/', 'refresh');
        }
        
       
       public function chats($para1 = "", $para2 = "")
        {

            if ($this->admin_permission() == FALSE) {
                redirect(base_url() . 'admin/login', 'refresh');
            } 
            else {
                $page_data['title'] = "Admin || " . $this->system_title;
                if ($para1 == "") {
                    $page_data['top'] = "chats/index.php";
                    $page_data['folder'] = "chats";
                    $page_data['file'] = "index.php";
                    $page_data['bottom'] = "chats/index.php";
                    $page_data['page_name'] = "chats";

                    $this->load->view('back/index', $page_data);
                }
                elseif ($para1 == "list_data") {
                    $columns = array(
                        0 => 'message_thread_id',
                        1 => 'message_from',
                        2 => 'message_to',
                        3 => 'message_text',
                        4 => 'reply',
                    );
                    $limit = $this->input->post('length');
                    $start = $this->input->post('start');
                    $order = $columns[$this->input->post('order')[0]['column']];
                    // $dir = $this->input->post('order')[0]['dir'];
                    $dir = "desc";
                    $table = 'im_message';

                    $totalData = $this->Crud_model->alldata_count($table);
                    $totalFiltered = $totalData;

                    if (empty($this->input->post('search')['value'])) {
                        $rows = $this->Crud_model->allchats($table, $limit, $start, $order, $dir);

                    } else {
                        $search = $this->input->post('search')['value'];
						
                        $rows = $this->Crud_model->chats_search($table, $limit, $start, $search, $order, $dir);

                        $totalFiltered = $this->Crud_model->chats_search_count($table, $search);
                   	// echo "<pre>";print_r($rows);die();
                    }

                    $data = array();
                  
                    if (!empty($rows)) {

                        foreach ($rows as $key => $row) {

                            //take out names of individuals to be put in here
                            $this->db->select('display_member')->select('first_name')->select('last_name')->select('membership');
                            $this->db->from('member');
                            $this->db->where('member_id', $row->message_from);
                            $object = $this->db->get()->row();

                            $this->db->select('display_member')->select('first_name')->select('last_name')->select('membership')->select('member_id');
                            $this->db->from('member');
                            $this->db->where('member_id', $row->message_to);
                            $obj = $this->db->get()->row();


                            $this->db->select('membership')->select('member_id');
                            $this->db->from('member');
                            $this->db->where('member_id', $row->message_to);
                            $getFakeMemeber = $this->db->get()->row();

                            if ($getFakeMemeber->membership == 4) {
                                $replyMsg =  $this->db->where('r_id',$obj->member_id)->where('m_id',$row->m_id)->get('im_receiver')->row('received');

                                if (isset($replyMsg) && $replyMsg == 0) {
                                    $sendFakeReply = "<button class='sendFakeReplyId' 
                                            style='border: none;background: none'
                                            data-toggle='modal' data-target='#sendReplyByFakeMember'
                                            from_id='".$row->message_to."'
                                            to_id='".$row->message_from."'
                                            g_id='".$row->receiver."'
                                            onclick='sendMessage(\"" . $row->message_to . "\", " . $row->message_from . "," . $row->receiver . ",)'
                                            ><i class='fa fa-paper-plane' aria-hidden='true' style='font-size: 20px;color:red'></i></button>";
                                }else{
                                  $sendFakeReply = "";
                                }
                            }else{
                                $sendFakeReply = "";
                            }

                                $msgFromMembership = $object->membership;
                                $msgToMembership = $obj->membership;
                                if ($msgFromMembership == 4) {
                                    $message_from = "<span style='color: #ff726f'>".$object->display_member."</span>". " " .ucfirst($object->first_name). " " .ucfirst($object->last_name);
                                }
                                else
                                {
                                    $message_from = $object->display_member. " " .ucfirst($object->first_name). " " .ucfirst($object->last_name);
                                }
                                if ($msgToMembership == 4) {
                                    $message_to = "<span style='color: #ff726f'>".$obj->display_member."</span>". " " .ucfirst($obj->first_name). " " .ucfirst($obj->last_name);
                                }
                                else
                                {
                                    $message_to = $obj->display_member. " " .ucfirst($obj->first_name). " " .ucfirst($obj->last_name);
                                }
                                



                                
                                $nestedData['message_from'] = $message_from ? $message_from : $row->message_from;
                                $nestedData['message_to'] = $message_to ? $message_to : $row->message_to;
                                $nestedData['message_text'] = $row->message_text;
                                $nestedData['message_time'] = "<span class='timezone".$key."'>" .$row->timezone_datetime."</span><script type='text/javascript'>dateFunc('".$row->timezone_datetime. "', ".$key.");</script>";
                                $nestedData['reply'] =$sendFakeReply;

                                $data[] = $nestedData;
                        }
                    }

                    $json_data = array(
                        "draw"            => intval($this->input->post('draw')),
                        "recordsTotal"    => intval($totalData),
                        "recordsFiltered" => intval($totalFiltered),
                        "data"            => $data
                    );
                    echo json_encode($json_data);
                }
                elseif ($para1 == "delete") {
                    $this->db->where('message_id', $para2);
                    $result = $this->db->delete('message');
                    recache();
                    if ($result) {
                        $this->session->set_flashdata('alert', 'delete');
                    } else {
                        $this->session->set_flashdata('alert', 'failed_delete');
                    }
                }
            }
        }

        //added AS 
        function fake_message_reply(){
                $message =  $this->input->post('reply_message');
                $from_id =  $this->input->post('from_id');
                $to_id =  $this->input->post('to_id');
                $g_id =  $this->input->post('g_id');

                $data['sender']   = $from_id;
                $data['receiver'] = $g_id;
                $data['type']     = "text";
                $data['message']  = $message;
                $data['receiver_type'] = 'personal';
                $data['date']     = date('Y-m-d');
                $data['time']     = date("h:i:s");
                $data['date_time'] = date(DATE_ISO8601, time());
                $data['fake_message_recevier'] = $to_id;
                $data['message_to']     = 1;
                $this->db->insert('im_message',$data);
                $m_id = $this->db->insert_id();
                $receiver_time = date('Y-m-d h:i:s', time());
                $this->db->where('r_id',$to_id)->where('g_id',$g_id)->delete('im_receiver');
                $this->db->where('r_id',$from_id)->where('g_id',$g_id)->where('received',1)->delete('im_receiver');
                $this->db->where('r_id',$from_id)->update('im_receiver',['received'=>1]);
                $this->db->insert('im_receiver',['g_id'=>$g_id,'m_id'=>$m_id,'r_id'=>$to_id,'received'=>0,'time'=>$receiver_time]);
                echo "success";

        }

        function sendFakeMessage($message_to = NULL)
        {
            // Select Random Bronze Member
            if ($message_to == NULL) {
                // $getBronzeMember = $this->db->query("SELECT member_id, gender FROM member WHERE membership = 1 AND member_id NOT IN (SELECT message_to FROM message WHERE fake_message_id IS NOT NULL)
                //     ORDER BY RAND ()")->result();
                $getBronzeMember = $this->db->query("SELECT member_id, gender FROM member WHERE membership = 1 AND is_email_verified = 1 AND is_deleted = 0 AND member_id NOT IN (SELECT fake_message_recevier FROM im_message WHERE fake_message_recevier IS NOT NULL )
                    ORDER BY RAND ()")->result();
                        // echo "<pre>";
                        // print_r($getBronzeMember);
                
            }
            foreach ($getBronzeMember as $bronzeMember) {
                // print_r($bronzeMember);
                // Select Random Fake Member to send first message
                // $result = $this->db->query("SELECT fm.fake_message_id,
                //               fm.`member_id` AS fake_member_id,
                //               fm.message AS message,
                //               m.`gender`
                //             FROM
                //               `fake_member_message` AS fm
                //               LEFT JOIN member AS m
                //                 ON m.`member_id` = fm.`member_id`
                //                 AND m.`membership` = 4
                //             WHERE NOT EXISTS
                //               (SELECT
                //                 *
                //               FROM
                //                 `message` AS mess
                //               WHERE 
                //                 fm.`member_id` = mess.`message_to`)
                //                 AND fm.`message_no` = 1
                //                 AND m.`gender` != $bronzeMember->gender
                //             ORDER BY RAND ()
                //             LIMIT 1")->result();
                $result = $this->db->query("SELECT fm.`fake_message_id`,
                              fm.`member_id` AS fake_member_id,
                              fm.`message` AS message,
                              m.`gender`,fm.`message_no`
                              FROM `fake_member_message` AS fm
                              LEFT JOIN member AS m
                              ON m.`member_id` = fm.`member_id`
                              AND m.`membership` = 4
                              AND m.`gender` != $bronzeMember->gender
                              AND fm.`message_no` = 1
                              ORDER BY RAND ()
                              LIMIT 1")->result();


                
                // echo "<pre>";
                // print_r($result);die();

                if (!empty($result)) {
                     if ($result[0]->gender) {
                        $fake_member_id  = $result[0]->fake_member_id;
                        $bronzeMember_id = $bronzeMember->member_id;
						 
						  $recevier_display_member = $this->db->get_where("member", array("member_id" => $bronzeMember_id))->row('display_member');
                        $sender_display_member = $this->db->get_where("member", array("member_id" => $fake_member_id))->row('display_member');
						
						
                        $check_form_id = $this->db->where('from_id',$fake_member_id)->where('to_id',$bronzeMember_id)->get('im_group_relation')->result_array();
                        $check_to_id = $this->db->where('from_id',$bronzeMember_id)->where('to_id',$fake_member_id)->get('im_group_relation')->result_array();
                        if (count($check_form_id) == 0 && count($check_to_id) == 0) {

                            $gp['createdBy'] = $fake_member_id;
                            $gp['lastActive'] = date('Y-m-d G:i:s');
                            $this->db->insert('im_group',$gp);
                            $insert_id = $this->db->insert_id();

                            $gpm['g_id'] = $insert_id;
                            $gpm['u_id'] = $bronzeMember_id;
                  			$gpm['display_member'] = $recevier_display_member;

                            $gpm2['g_id'] = $insert_id;
                            $gpm2['u_id'] = $fake_member_id;		
                    		$gpm2['display_member'] = $sender_display_member;
							
                            $this->db->insert('im_group_members',$gpm);
                            $this->db->insert('im_group_members',$gpm2);
                            $this->db->insert('im_group_relation',['from_id'=>$fake_member_id,'to_id'=>$bronzeMember_id,'g_id'=>$insert_id]);

                            $data['sender']   = $fake_member_id;
                            $data['receiver'] = $insert_id;
                            $data['type']     = "text";
                            $data['message']  = $result[0]->message;
                            $data['receiver_type'] = 'personal';
                            $data['date']     = date('Y-m-d');
                            $data['time']     = date("h:i:s");
                            $data['date_time'] = date(DATE_ISO8601, time());
                            $data['fake_message_id'] = $result[0]->fake_message_id;
                            $data['fake_message_recevier'] = $bronzeMember_id;
                            $data['message_to']     = 1;
                            $this->db->insert('im_message',$data);
                            $m_id = $this->db->insert_id();
                            $receiver_time = date('Y-m-d h:i:s', time());
                            $this->db->insert('im_receiver',['g_id'=>$insert_id,'m_id'=>$m_id,'r_id'=>$bronzeMember_id,'received'=>0,'time'=>$receiver_time]);

                            echo "true";
                        }

                        
                     }
                }
                // echo "<pre>";
                // print_r($result);die();

                // if (!empty($result)) {
                //     $fake_message_id = $result[0]->fake_message_id;
                //     $fake_member = $result[0]->fake_member_id;
                //     $message = $result[0]->message;

                    // Create Thread
                    // $data['message_thread_from'] = $fake_member;
                    // $data['message_thread_to'] = $bronzeMember->member_id;
                    // $data['message_thread_time'] = time();
                    // $data['message_from_seen'] = 'yes';
                    // $data['thread_viewable_to'] = 1;
                    // $data['is_fake_message'] = 1;

                    // $data['sender'] = $fake_member;
                    // $data['receiver'] = $bronzeMember->member_id;
                    // $data['type'] = "text";
                    // $data['receiver_type'] = 'personal';
                    // $data['date'] = date('Y-m-d');
                    // $data['time'] = date("h:i:s");
                    // $data['date_time'] = date(DATE_ISO8601, time());
                    // $data['is_fake_message'] = 1;

                    // $this->db->insert('message_thread', $data);
                    // $thread_id = $this->db->insert_id();

                //     // Send Message
                //     $data1['message_thread_id'] = $thread_id;
                //     $data1['fake_message_id'] = $fake_message_id;
                //     $data1['message_from'] = $fake_member;
                //     $data1['message_to'] = $bronzeMember->member_id;
                //     $data1['message_text'] = $message;
                //     $data1['message_time'] = time();
                //     $data1['timezone_datetime'] = gmdate('Y-m-d\TH:i:s.').'000Z';

                //     $this->db->insert('message', $data1);

                //     echo "true";
                // }
            }
        }

        function fakeMemberMessageReply()
        {
            // Reply to bronze members in response of 1st message
            // $result = $this->db->query("SELECT
            //                   fm.fake_message_id,
            //                   fm.member_id AS message_from,
            //                   fm.message AS message,
            //                   mt.message_thread_to AS message_to,
            //                   mt.message_thread_id
            //                 FROM
            //                   fake_member_message AS fm
            //                 LEFT JOIN message_thread AS mt
            //                     ON fm.member_id = mt.message_thread_from
            //                 WHERE fm.message_no = 2
            //                 AND mt.is_fake_message = 2")->result();
            $result = $this->db->query("SELECT
                              fm.fake_message_id,
                              fm.member_id AS message_from,
                              fm.message AS message,
                              im.fake_message_recevier AS message_to,
                              im.m_id,
                              im.receiver
                            FROM fake_member_message AS fm
                            LEFT JOIN im_message AS im
                                ON fm.member_id = im.sender
                            WHERE fm.message_no = 2
                            AND im.fake_message_id IS NOT NULL")->result();
            

            foreach ($result as $key => $replyData) {
                // Send Reply
                $data['sender']   = $replyData->message_from;
                $data['receiver'] = $replyData->receiver;
                $data['type']     = "text";
                $data['message']  = $replyData->message;
                $data['receiver_type'] = 'personal';
                $data['date']     = date('Y-m-d');
                $data['time']     = date("h:i:s");
                $data['date_time']= date(DATE_ISO8601, time());
                $data['fake_message_id'] = $replyData->fake_message_id;
                $data['fake_message_recevier'] = $replyData->message_to;
                $data['message_to']     = 2;

                $check = $this->db->where('fake_message_recevier',$replyData->message_to)->where('message_to',2)->get('im_message')->result_array();
                $replyCheck = $this->db->where('receiver',$replyData->receiver)->get('im_message')->result_array();
                if (count($check) == 0 && count($replyCheck) > 1) {
                        // echo "<pre>";
                        // print_r($data);
                        $this->db->insert('im_message', $data);
                        $id = $this->db->insert_id();
                        $receiver_time = date('Y-m-d h:i:s', time());
                        $this->db->insert('im_receiver',['g_id'=>$replyData->receiver,'m_id'=>$id,'r_id'=>$replyData->message_to,'received'=>0,'time'=>$receiver_time]);
                }

                // Update is_fake_message flag to 3
                // $this->db->where("message_thread_id", $replyData->message_thread_id);
                // $this->db->update('message_thread', array('is_fake_message' => 3));
            }
            
            echo "true";
        }

        function randomDateTimeForFakeMessage()
        {
            $currDate = new DateTime();
            $currDate->setTimestamp(1594096123);
            $currDate ->modify('+1 day');

            $nextFiveFDays = new DateTime();
            $nextFiveFDays->setTimestamp(1594096123);
            $nextFiveFDays->modify('+5 day');

            $regDate = $currDate->format('Y-m-d H:i');
            $fiveDay = $nextFiveFDays->format('Y-m-d H:i');

            $fMin = strtotime($regDate);
            $fMax = strtotime($fiveDay);

            $fVal = mt_rand($fMin, $fMax);

            $Format = 'Y-m-d H:i:s';
            $date =  date($Format, $fVal);

            echo $date;
        }

        function getAllPlans()
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.stripe.com/v1/plans",
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

            return json_decode($response);
        }

        function getPlanDetails($planId)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.stripe.com/v1/plans/".$planId,
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

            return json_decode($response);
        }

        function updatePlanPrice($planId, $price)
        {
            // $accessToken = $this->getPaypalAccessToken()->access_token;

            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //   CURLOPT_URL => "https://api.sandbox.paypal.com/v1/billing/plans/".$planId."/update-pricing-schemes",
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => "",
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => "POST",
            //     CURLOPT_POSTFIELDS =>"{\r\n  \"pricing_schemes\": [\r\n    {\r\n\t\t\"billing_cycle_sequence\": 1,\t\r\n      \"pricing_scheme\": {\r\n        \"fixed_price\": {\r\n          \"value\": $price,\r\n          \"currency_code\": \"USD\"\r\n        }\r\n      }\r\n    }\r\n  ]\r\n}",
            //   CURLOPT_HTTPHEADER => array(
            //     "Authorization: Bearer ".$accessToken,
            //     "Content-Type: application/json",
            //     "Content-Type: text/plain"
            //   ),
            // ));

            // $response = curl_exec($curl);

            // curl_close($curl);
            // echo $response;

        }

        function approve_gallery_image()
        {
            $approve = $_POST['approve'];
            $approveMemberId = $_POST['approveMemberId'];
            $approveImageType = $_POST['approveImageType'];
            $approveitemId = $_POST['approveitemId'];

            if ($approveImageType == "profile_image") {
                $data['is_profile_img_approved'] = $approve;

                $this->db->where('member_id', $approveMemberId);
                $this->db->update('member', $data);
            }
            elseif ($approveImageType == "gallery_image" || $approveImageType == "gallery_video") {
                $data['is_approved'] = $approve;

                $this->db->where('item_id', $approveitemId);
                $this->db->update('gallery_items', $data);
            }

            $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $approveMemberId")->result();

            if ($approveImageType == "gallery_image" || $approveImageType == "profile_image") {
                $this->Email_model->photo_approval_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);
            }
            elseif ($approveImageType == "gallery_video") {
                $this->Email_model->video_approval_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);
            }
            
            echo "true";
        }

        function reject_gallery_image()
        {
            $reject = $_POST['reject'];
            $rejectMemberId = $_POST['rejectMemberId'];
            $rejectImageType = $_POST['rejectImageType'];
            $rejectitemId = $_POST['rejectitemId'];

            $memberData = $this->db->query("SELECT * FROM member WHERE member_id = $rejectMemberId")->result();

            if ($rejectImageType == "profile_image") {
                
                // Delete Image from server
                unlink('uploads/profile_image/'. $rejectMemberId . "/" . $memberData[0]->profile_image);
                
                $data['is_profile_img_approved'] = $reject;
                $data['profile_image'] = "";
                $data['is_profile_img_approved'] = 0;

                $this->db->where('member_id', $rejectMemberId);
                $this->db->update('member', $data);

                // Send Rejection Email
                $this->Email_model->photo_rejection_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);

            }
            elseif ($rejectImageType == "gallery_image") {
                
                // Delete Image from server
                $image_name = $this->db->get_where('gallery_items', array('item_id' => $rejectitemId))->result();
                unlink('uploads/gallery_image/'. $rejectMemberId . "/" . $image_name[0]->item_name);

                $this->db->where('item_id', $rejectitemId);
                $this->db->delete('gallery_items');

                // Increase Picture Quota
                $photo_gallery_amount = $this->db->get_where('member', array('member_id' => $rejectMemberId))->row()->photo_gallery;

                $data1['photo_gallery'] = $photo_gallery_amount + 1;
                $this->db->where('member_id', $rejectMemberId);
                $this->db->update('member', $data1);

                // Send Rejection Email
                $this->Email_model->photo_rejection_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);

            }
            elseif ($rejectImageType == "gallery_video") {
                // Delete Image from server
                $video_name = $this->db->get_where('gallery_items', array('item_id' => $rejectitemId))->result();
                unlink('video/'. $rejectMemberId . "/" . $video_name[0]->item_name);

                $this->db->where('item_id', $rejectitemId);
                $this->db->delete('gallery_items');
                
                // Increase Video Quota
                $videoGalleryQuota = $this->Crud_model->get_type_name_by_id('member', $rejectMemberId, 'video_gallery');

                $rejectVideoData['video_gallery'] = $videoGalleryQuota + 1;
                $this->db->where('member_id', $rejectMemberId);
                $this->db->update('member', $rejectVideoData);

                // Send Rejection Email
                $this->Email_model->video_rejection_notification($memberData[0]->email, $memberData[0]->first_name . " " . $memberData[0]->last_name);
            }
            
            echo "true";
        }



        function packages($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                            $plans = $this->getAllPlans();
                            $quarterlyPlanId = $plans->data[0]->id;
                            $biAnnualPlanId = $plans->data[1]->id;
                            $annualPlanId = $plans->data[2]->id;
                            
                            $quarterlyPlan = $this->getPlanDetails($quarterlyPlanId);
                            // echo "<pre>";
                            // print_r(number_format(($quarterlyPlan->amount_decimal /100), 2, '.', ' '));exit;
                            $biAnnualPlan = $this->getPlanDetails($biAnnualPlanId);
                            $annualPlan = $this->getPlanDetails($annualPlanId);

                            $updateData['quaterly_amount'] = number_format(($quarterlyPlan->amount_decimal /100), 2, '.', ' ');
                            $updateData['bi_annually_amount'] = number_format(($biAnnualPlan->amount_decimal /100), 2, '.', ' ');
                            $updateData['yearly_amount'] = number_format(($annualPlan->amount_decimal /100), 2, '.', ' ');
                            
                            // $this->db->where('plan_id', 2);
                            // $this->db->update('plan', $updateData);

                            $page_data['top'] = "packages/index.php";
                            $page_data['folder'] = "packages";
                            $page_data['file'] = "index.php";
                            $page_data['bottom'] = "packages/index.php";
                            $page_data['quarterlyPlan'] = $quarterlyPlan;
                            $page_data['biAnnualPlan'] = $biAnnualPlan;
                            $page_data['annualPlan'] = $annualPlan;
                            $page_data['all_plans'] = $this->db->get("plan")->result();
                            if ($this->session->flashdata('alert') == "edit") {
                                    $page_data['success_alert'] = translate("you_have_successfully_edited_the_package!");
                            } elseif ($this->session->flashdata('alert') == "add") {
                                    $page_data['success_alert'] = translate("you_have_successfully_added_the_package!");
                            } elseif ($this->session->flashdata('alert') == "delete") {
                                    $page_data['danger_alert'] = translate("you_have_successfully_deleted_the_package!");
                            } elseif ($this->session->flashdata('alert') == "failed_image") {
                                    $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
                            }
                        } elseif ($para1 == "add_package") {
                                $page_data['top'] = "packages/packages.php";
                                $page_data['folder'] = "packages";
                                $page_data['file'] = "add_package.php";
                                $page_data['bottom'] = "packages/packages.php";
                        } elseif ($para1 == "do_add") {
                                $data['name'] = $this->input->post('name');
                                $data['monthly_amount'] = $this->input->post('monthly_amount');
                                $data['quaterly_amount'] = $this->input->post('quaterly_amount');
                                $data['bi_annually_amount'] = $this->input->post('bi_annually_amount');
                                $data['yearly_amount'] = $this->input->post('yearly_amount');
                                $data['express_interest'] = $this->input->post('express_interest');
                                $data['direct_messages'] = $this->input->post('direct_messages');
                                $data['photo_gallery'] = $this->input->post('photo_gallery');

                                $this->db->insert('plan', $data);
                                $plan_id = $this->db->insert_id();

                                if ($_FILES['image']['name'] !== '') {
                                    $id = $plan_id;
                                    $path = $_FILES['image']['name'];
                                    $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                    if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                            $this->Crud_model->file_up("image", "plan", $id, '', '', $ext);
                                            $images[] = array('image' => 'plan_' . $id . $ext, 'thumb' => 'plan_' . $id . '_thumb' . $ext);
                                            $data['image'] = json_encode($images);
                                    } else {
                                            $this->session->set_flashdata('alert', 'failed_image');
                                            redirect(base_url() . 'admin/packages', 'refresh');
                                    }
                                }
                                $this->db->where('plan_id', $plan_id);
                                $result = $this->db->update('plan', $data);
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'add');
                                        redirect(base_url() . 'admin/packages', 'refresh');
                                } else {
                                        echo "Data Failed to Edit!";
                                }
                                exit;
                        } elseif ($para1 == "edit_package") {
                            $plans = $this->getAllPlans();
                            $quarterlyPlanId = $plans->data[0]->id;
                            $biAnnualPlanId = $plans->data[1]->id;
                            $annualPlanId = $plans->data[2]->id;
                            
                            $quarterlyPlan = $this->getPlanDetails($quarterlyPlanId);
                            $biAnnualPlan = $this->getPlanDetails($biAnnualPlanId);
                            $annualPlan = $this->getPlanDetails($annualPlanId);

                            $page_data['quarterlyPlan'] = $quarterlyPlan;
                            $page_data['biAnnualPlan'] = $biAnnualPlan;
                            $page_data['annualPlan'] = $annualPlan;

                            $page_data['top'] = "packages/packages.php";
                            $page_data['folder'] = "packages";
                            $page_data['file'] = "edit_package.php";
                            $page_data['bottom'] = "packages/packages.php";
                            $page_data['get_plan'] = $this->db->get_where("plan", array("plan_id" => $para2))->result();
                        } elseif ($para1 == "update") {
                                $plan_id = $this->input->post('plan_id');

                                // Update plan prices in paypal
                                // if ($plan_id == 2) {
                                //     $currQuaterlyPrice = $this->Crud_model->get_type_name_by_id('plan',$plan_id , 'quaterly_amount');
                                //     $currBiAnnualPrice = $this->Crud_model->get_type_name_by_id('plan',$plan_id , 'bi_annually_amount');
                                //     $currAnnualPrice = $this->Crud_model->get_type_name_by_id('plan',$plan_id , 'yearly_amount');
                                //     if ($this->input->post('quaterly_amount') != $currQuaterlyPrice) {
                                //         $quaterlyId = $this->input->post('paypalQuarterlyPlanId');
                                //         $quaterlyPrice = $this->input->post('quaterly_amount');
                                //         $this->updatePlanPrice($quaterlyId, $quaterlyPrice);
                                //     }
                                //     if ($this->input->post('bi_annually_amount') != $currBiAnnualPrice) {
                                //         $biAnnualId = $this->input->post('paypalBiannualPlanId');
                                //         $biAnnualPrice = $this->input->post('bi_annually_amount');
                                //         $this->updatePlanPrice($biAnnualId, $biAnnualPrice);
                                //     }    
                                //     if ($this->input->post('yearly_amount') != $currAnnualPrice) {
                                //         $annualId = $this->input->post('paypalAnnualPlanId');
                                //         $annualPrice = $this->input->post('yearly_amount');
                                //         $this->updatePlanPrice($annualId, $annualPrice);
                                //     }
                                    
                                // }

                                $data['name'] = $this->input->post('name');
                                $data['monthly_amount'] = $this->input->post('monthly_amount');
                                $data['quaterly_amount'] = $this->input->post('quaterly_amount');
                                $data['bi_annually_amount'] = $this->input->post('bi_annually_amount');
                                $data['yearly_amount'] = $this->input->post('yearly_amount');
                                // $data['express_interest'] = $this->input->post('express_interest');
                                // $data['direct_messages'] = $this->input->post('direct_messages');
                                // $data['photo_gallery'] = $this->input->post('photo_gallery');
                                if ($_FILES['image']['name'] !== '') {
                                        $id = $plan_id;
                                        $path = $_FILES['image']['name'];
                                        $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                        if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                $this->Crud_model->plan_file_up("image", "plan", $id, '', '', $ext);
                                                $images[] = array('image' => 'plan_' . $id . $ext, 'thumb' => 'plan_' . $id . '_thumb' . $ext);
                                                $data['image'] = json_encode($images);
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_image');
                                                redirect(base_url() . 'admin/packages', 'refresh');
                                        }
                                }
                                $this->db->where('plan_id', $plan_id);
                                $result = $this->db->update('plan', $data);                                
                                
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'edit');
                                        redirect(base_url() . 'admin/packages', 'refresh');
                                } else {
                                        echo "Data Failed to Edit!";
                                }
                                exit;
                        } elseif ($para1 == "delete") {
                                $plan_id = $para2;
                                $this->db->where('plan_id', $para2);
                                $result = $this->db->delete('plan');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                        redirect(base_url() . 'admin/packages', 'refresh');
                                } else {
                                        echo "Data Failed to Delete!";
                                }
                                exit;
                        }
                        $page_data['page_name'] = "packages";
                        $this->load->view('back/index', $page_data);
                }
        }

        public function coverPic($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                           
                            $page_data['top'] = "packages/index.php";
                            $page_data['folder'] = "coverPic";
                            $page_data['file'] = "index.php";
                            $page_data['bottom'] = "packages/index.php";

                            $page_data['all_plans'] = $this->db->get("cover_pic_plan")->result();
                            if ($this->session->flashdata('alert') == "edit") {
                                    $page_data['success_alert'] = translate("you_have_successfully_edited_the_package!");
                            } elseif ($this->session->flashdata('alert') == "add") {
                                    $page_data['success_alert'] = translate("you_have_successfully_added_the_package!");
                            } elseif ($this->session->flashdata('alert') == "delete") {
                                    $page_data['danger_alert'] = translate("you_have_successfully_deleted_the_package!");
                            } elseif ($this->session->flashdata('alert') == "failed_image") {
                                    $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
                            }
                        } elseif ($para1 == "add_package") {
                                $page_data['top'] = "packages/packages.php";
                                $page_data['folder'] = "coverPic";
                                $page_data['file'] = "add_package.php";
                                $page_data['bottom'] = "packages/packages.php";
                        } elseif ($para1 == "do_add") {
                                $data['name'] = $this->input->post('name');
                                $data['week'] = $this->input->post('week');
                                $data['amount'] = $this->input->post('amount');
                                $data['price_id'] = $this->input->post('price_id');
                                $data['photo_gallery'] = 1;

                                $this->db->insert('cover_pic_plan', $data);
                                $plan_id = $this->db->insert_id();

                                recache();
                                if ($plan_id) {
                                        $this->session->set_flashdata('alert', 'add');
                                        redirect(base_url() . 'admin/coverPic', 'refresh');
                                } else {
                                        echo "Data Failed to Edit!";
                                }
                                exit;
                        } elseif ($para1 == "edit_package") {

                            $page_data['top'] = "packages/packages.php";
                            $page_data['folder'] = "coverPic";
                            $page_data['file'] = "edit_package.php";
                            $page_data['bottom'] = "packages/packages.php";
                            $page_data['get_plan'] = $this->db->get_where("cover_pic_plan", array("plan_id" => $para2))->result();
                        } elseif ($para1 == "update") {
                                $plan_id = $this->input->post('plan_id');

                                $data['name'] = $this->input->post('name');
                                $data['week'] = $this->input->post('week');
                                $data['amount'] = $this->input->post('amount');
                                $data['price_id'] = $this->input->post('price_id');
                                $data['photo_gallery'] = 1;

                                $this->db->where('plan_id', $plan_id);
                                $result = $this->db->update('cover_pic_plan', $data);                                
                                
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'edit');
                                        redirect(base_url() . 'admin/coverPic', 'refresh');
                                } else {
                                        echo "Data Failed to Edit!";
                                }
                                exit;
                        } elseif ($para1 == "delete") {
                                $plan_id = $para2;
                                $this->db->where('plan_id', $para2);
                                $result = $this->db->delete('cover_pic_plan');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                        redirect(base_url() . 'admin/coverPic', 'refresh');
                                } else {
                                        echo "Data Failed to Delete!";
                                }
                                exit;
                        }
                        $page_data['page_name'] = "coverPic";
                        $this->load->view('back/index', $page_data);
                }
        }

        public function ads_plan($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                           
                            $page_data['top'] = "packages/index.php";
                            $page_data['folder'] = "ads_plan";
                            $page_data['file'] = "index.php";
                            $page_data['bottom'] = "packages/index.php";

                            $page_data['all_plans'] = $this->db->get("advertisement_plans")->result();
                            // echo "<pre>";
                            // print_r($page_data['all_plans']);die();
                            if ($this->session->flashdata('alert') == "edit") {
                                    $page_data['success_alert'] = translate("you_have_successfully_edited_the_package!");
                            } elseif ($this->session->flashdata('alert') == "add") {
                                    $page_data['success_alert'] = translate("you_have_successfully_added_the_package!");
                            } elseif ($this->session->flashdata('alert') == "delete") {
                                    $page_data['danger_alert'] = translate("you_have_successfully_deleted_the_package!");
                            } elseif ($this->session->flashdata('alert') == "failed_image") {
                                    $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
                            }
                        } elseif ($para1 == "add_package") {
                                $page_data['top'] = "packages/packages.php";
                                $page_data['folder'] = "ads_plan";
                                $page_data['file'] = "add_package.php";
                                $page_data['bottom'] = "packages/packages.php";
                        } elseif ($para1 == "do_add") {
                                $data['duration'] = $this->input->post('duration');
                                $data['amount'] = $this->input->post('amount');
                                $data['stripe_prize_id'] = $this->input->post('stripe_prize_id');

                                $this->db->insert('advertisement_plans', $data);
                                $id = $this->db->insert_id();

                                recache();
                                if ($id) {
                                        $this->session->set_flashdata('alert', 'add');
                                        redirect(base_url() . 'admin/ads_plan', 'refresh');
                                } else {
                                        echo "Data Failed to Edit!";
                                }
                                exit;
                        } elseif ($para1 == "edit_package") {

                            $page_data['top'] = "packages/packages.php";
                            $page_data['folder'] = "ads_plan";
                            $page_data['file'] = "edit_package.php";
                            $page_data['bottom'] = "packages/packages.php";
                            $page_data['get_plan'] = $this->db->get_where("advertisement_plans", array("id" => $para2))->result();
                        } elseif ($para1 == "update") {
                                $id = $this->input->post('id');

                                $data['duration'] = $this->input->post('duration');
                                $data['amount'] = $this->input->post('amount');
                                $data['stripe_prize_id'] = $this->input->post('stripe_prize_id');

                                $this->db->where('id', $id);
                                $result = $this->db->update('advertisement_plans', $data);                                
                                
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'edit');
                                        redirect(base_url() . 'admin/ads_plan', 'refresh');
                                } else {
                                        echo "Data Failed to Edit!";
                                }
                                exit;
                        } elseif ($para1 == "delete") {
                                $id = $para2;
                                $this->db->where('id', $para2);
                                $result = $this->db->delete('advertisement_plans');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                        redirect(base_url() . 'admin/ads_plan', 'refresh');
                                } else {
                                        echo "Data Failed to Delete!";
                                }
                                exit;
                        }
                        $page_data['page_name'] = "ads_plan";
                        $this->load->view('back/index', $page_data);
                }
        }

        function CoverPic_approval($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {

                            $page_data['top'] = "picture_video_approval/index.php";
                            $page_data['folder'] = "CoverPic_approval";
                            $page_data['file'] = "index.php";
                            $page_data['bottom'] = "picture_video_approval/index.php";

                            //waiting for approve

                            $this->db->select('cover_pic_payment.cover_pic_payment_id , cover_pic_payment.client_date , cover_pic_plan.name , cover_pic_payment.payment_by , cover_pic_payment.payment_date , cover_pic_plan.week , cover_pic_plan.amount , member.email , member.member_profile_id , member.member_id,cover_pic_payment.image_reject,cover_pics.image');
                            $this->db->from('cover_pic_payment');
                            $this->db->join('member', 'member.member_id = cover_pic_payment.member_id');
                            $this->db->join('cover_pic_plan', 'cover_pic_plan.plan_id = cover_pic_payment.member_plan_id');
							$this->db->join('cover_pics', 'cover_pics.member_id = cover_pic_payment.member_id','left');
                            $this->db->where('cover_pic_payment.start_date', null);
                            $page_data['all_data'] = $this->db->get()->result();
							
							//echo "<pre>";print_r($page_data['all_data'] );die();
                            //approved
                            $this->db->select('cover_pic_payment.cover_pic_payment_id , cover_pic_payment.client_date , cover_pic_plan.name , cover_pics.image,cover_pics.cover_pics_id, cover_pic_plan.week , cover_pic_plan.amount , member.email , member.member_profile_id , member.member_id , cover_pics.start_date as cover_pic_start_date , cover_pics.end_date as cover_pic_end_date , cover_pics.status as cover_pic_status , cover_pic_payment.start_date as cover_pic_payment_start_date , cover_pic_payment.payment_date as cover_pic_payment_payment_date , cover_pic_payment.payment_by ');
                            $this->db->from('cover_pic_payment');
                            $this->db->join('member', 'member.member_id = cover_pic_payment.member_id');
                            $this->db->join('cover_pic_plan', 'cover_pic_plan.plan_id = cover_pic_payment.member_plan_id');
                            $this->db->join('cover_pics', 'cover_pics.cover_pic_payment_id = cover_pic_payment.cover_pic_payment_id');
                            $page_data['all_data_approved'] = $this->db->get()->result();

                            // echo "<pre>";print_r($page_data['all_data_approved'] );die();
                            if ($this->session->flashdata('alert') == "edit") {
                                    $page_data['success_alert'] = translate("you_have_successfully_edited_the_package!");
                            } elseif ($this->session->flashdata('alert') == "add") {
                                    $page_data['success_alert'] = translate("you_have_successfully_added_the_package!");
                            } elseif ($this->session->flashdata('alert') == "delete") {
                                    $page_data['danger_alert'] = translate("you_have_successfully_deleted_the_package!");
                            } elseif ($this->session->flashdata('alert') == "failed_image") {
                                    $page_data['danger_alert'] = translate("failed_to_upload_your_image._make_sure_the_image_is_JPG,_JPEG_or_PNG!");
                            }
                        } elseif ($para1 == "add_picture") {
                                $page_data['top'] = "packages/packages.php";
                                $page_data['folder'] = "CoverPic_approval";
                                $page_data['file'] = "add_package.php";
                                $page_data['bottom'] = "packages/packages.php";
                                $page_data['id'] = $para2;
                        } elseif ($para1 == "do_add") {
								$id = $para2;
								$this->db->select('cover_pic_payment.cover_pic_payment_id, cover_pic_payment.amount,cover_pic_payment.client_date , cover_pic_payment.payment_date , cover_pic_plan.name , cover_pic_plan.image , cover_pic_plan.week , cover_pic_plan.amount , member.email , cover_pics.end_date , cover_pics.image , cover_pics.status , member.member_profile_id , member.member_id , member.first_name, member.last_name , member.display_member,cover_pics.cover_pics_id ');
								$this->db->from('cover_pic_payment');
								$this->db->join('member', 'member.member_id = cover_pic_payment.member_id');
								$this->db->join('cover_pic_plan', 'cover_pic_plan.plan_id = cover_pic_payment.member_plan_id');
								$this->db->join('cover_pics', 'cover_pics.member_id = cover_pic_payment.member_id');
								$this->db->where('cover_pic_payment.cover_pic_payment_id', $id );
								$member = $this->db->get()->row();
							echo "<pre>";print_r($member);
							
                                $data['cover_pic_payment_id'] = $member->cover_pic_payment_id;
                                $week = $member->week;
                                $day = $week * 7;
                                $Date = date("Y-m-d");

                                $status = 1;

                                if ( date("Y-m-d") > $member->client_date) {

                                $data['start_date'] = date("Y-m-d");
                                $dataToUpdate['start_date'] = date("Y-m-d");
                                $data['end_date']   = date('Y-m-d', strtotime($Date. ' + '.$day.' days'));
                                $dataToUpdate['end_date']   = date('Y-m-d', strtotime($Date. ' + '.$day.' days'));
                                    
                                }else{

                                $Date = $member->client_date;        

                                $data['start_date'] = $member->client_date;
                                $dataToUpdate['start_date'] = $member->client_date;
                                $data['end_date']   = date('Y-m-d', strtotime($Date. ' + '.$day.' days'));
                                $dataToUpdate['end_date']   = date('Y-m-d', strtotime($Date. ' + '.$day.' days'));

                                }

                                if (isset($member->status)) {
                                    $status = 1;
                                    $data['status'] = $status;

                                    $this->db->from("cover_pics");
                                    $this->db->limit(1);
                                    $this->db->order_by('cover_pics_id',"DESC");
                                    $this->db->where('status', 0 );
                                    $this->db->where('member_id', $member->member_id );
                                    $query = $this->db->get()->result_array();
									//	echo "<pre>";print_r($data);
									//echo "<pre>";print_r($dataToUpdate);
									//die();
                                    $this->db->where('cover_pics_id', $member->cover_pics_id);
                                    $result = $this->db->update('cover_pics', $data);

                                    $this->db->where('cover_pic_payment_id',$member->cover_pic_payment_id );
                                    $result = $this->db->update('cover_pic_payment', $dataToUpdate);

                                    $this->Email_model->cover_pic_approval_notification($member->first_name ,$member->last_name , $member->email , $member->name , $id , $data['start_date'] ,$data['end_date'] , $member->payment_date , $id,$week, $member->display_member,$member->amount);

                                    $this->session->set_flashdata('alert', 'add');
                                    redirect(base_url() . 'admin/CoverPic_approval', 'refresh');

                                }else{
                                        $data['status'] = 1;
                                        $this->db->insert('cover_pics', $data);
                                        $plan_id = $this->db->insert_id();

                                        if ($_FILES['image']['name'] !== '') {
                                            $id = $plan_id;
                                            $path = $_FILES['image']['name'];

                                            $id = time();
                                            $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                            if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                    $this->Crud_model->file_upCover("image", "plan", $id, '', '', $ext);
                                                    $images[] = array('image' => $id. "-".  $_FILES['image']['name'] );
                                                    $data['image'] = json_encode($images);
                                            } else {
                                                    $this->session->set_flashdata('alert', 'failed_image');
                                                    redirect(base_url() . 'admin/coverPic', 'refresh');
                                            }
                                        }


                                        $this->db->where('cover_pics_id', $plan_id);
                                        $result = $this->db->update('cover_pics', $data);

                                        $dataToUpdate['start_date'] = $data['start_date'];
                                        $dataToUpdate['end_date'] = $data['end_date'];


                                        $this->db->where('cover_pic_payment_id', $this->input->post('id') );
                                        $result = $this->db->update('cover_pic_payment', $dataToUpdate);

                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                                redirect(base_url() . 'admin/CoverPic_approval', 'refresh');
                                        } else {
                                                echo "Data Failed to Edit!";
                                        }
                                }

                                
                                exit;
                        } elseif ($para1 == "edit_package") {
                            $plans = $this->getAllPlans();
                            $quarterlyPlanId = $plans->data[0]->id;
                            $biAnnualPlanId = $plans->data[1]->id;
                            $annualPlanId = $plans->data[2]->id;
                            
                            $quarterlyPlan = $this->getPlanDetails($quarterlyPlanId);
                            $biAnnualPlan = $this->getPlanDetails($biAnnualPlanId);
                            $annualPlan = $this->getPlanDetails($annualPlanId);

                            $page_data['quarterlyPlan'] = $quarterlyPlan;
                            $page_data['biAnnualPlan'] = $biAnnualPlan;
                            $page_data['annualPlan'] = $annualPlan;

                            $page_data['top'] = "packages/packages.php";
                            $page_data['folder'] = "coverPic";
                            $page_data['file'] = "edit_package.php";
                            $page_data['bottom'] = "packages/packages.php";
                            $page_data['get_plan'] = $this->db->get_where("cover_pic_plan", array("plan_id" => $para2))->result();
                        } elseif ($para1 == "update") {
                                $plan_id = $this->input->post('plan_id');

                                $data['name'] = $this->input->post('name');
                                $data['week'] = $this->input->post('week');
                                $data['amount'] = $this->input->post('amount');
                                $data['photo_gallery'] = 1;


                                if ($_FILES['image']['name'] !== '') {
                                        $id = $plan_id;
                                        $path = $_FILES['image']['name'];
                                        $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                                        if ($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG" || $ext == ".png" || $ext == ".PNG") {
                                                $this->Crud_model->plan_file_up("image", "plan", $id, '', '', $ext);
                                                $images[] = array('image' => 'plan_' . $id . $ext, 'thumb' => 'plan_' . $id . '_thumb' . $ext);
                                                $data['image'] = json_encode($images);
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_image');
                                                redirect(base_url() . 'admin/coverPic', 'refresh');
                                        }
                                }
                                $this->db->where('plan_id', $plan_id);
                                $result = $this->db->update('cover_pic_plan', $data);                                
                                
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'edit');
                                        redirect(base_url() . 'admin/coverPic', 'refresh');
                                } else {
                                        echo "Data Failed to Edit!";
                                }
                                exit;
                        } elseif ($para1 == "delete") {
                                $plan_id = $para2;
                                $this->db->where('plan_id', $para2);
                                $result = $this->db->delete('cover_pic_plan');
                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                        redirect(base_url() . 'admin/coverPic', 'refresh');
                                } else {
                                        echo "Data Failed to Delete!";
                                }
                                exit;
                        }
                        $page_data['page_name'] = "CoverPic_approval";
                        $this->load->view('back/index', $page_data);
                }
        }
        
        function deleteCoverPic($id){
                 $this->db->where('cover_pics_id',$id)->delete('cover_pics');
                 return "success";
        }

        function change_status(){
               
          $id = $this->input->post('id');
          $status = $this->input->post('status');

          $result = $this->db->where('id',$id)->update('social_media_settings',['status'=>$status]);
          return 'success';
        }

        //asad

        function advertisements($para1 = "", $para2 = "")
        {
			

			
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
							   $today = date('Y-m-d');
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "member_configure/advertisements";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
              			   //$this->db->select('advertisements.*,advertisements.payment_status as payment,advertisements_payment.payment_status,advertisements_payment.payment_by');
                               // $this->db->from('advertisements');
                               // $this->db->join('advertisements_payment', 'advertisements.advertisements_id = advertisements_payment.advertisement_id', 'left');
                                //$this->db->where('advertisements.payment_status !=', '0');
                             
                                //$this->db->order_by("advertisements_id", "asc");
                                //$page_data['all_advertisements'] = $this->db->get()->result();	
							 
								  
						$query=$this->db->query("SELECT                   advertisements.*,advertisements_payment.ads_payment_id,advertisements_payment.payment_by 
					FROM advertisements
					JOIN advertisements_payment ON advertisements.advertisements_id=advertisements_payment.advertisement_id
					 WHERE advertisements.payment_status != 0 AND
					 advertisements_payment.ads_payment_id IN 
							(SELECT max(advertisements_payment.ads_payment_id)
							 as ads_payment_ids 
							FROM  advertisements_payment
							GROUP by advertisements_payment.advertisement_id 
							ORDER by ads_payment_ids DESC);");
							 $page_data['all_advertisements'] = $query->result_array();	
                           //echo '<pre>';
						///print_r($page_data['all_advertisements']);
						///die();
							
                              
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "advertisements";
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_advertisements") {
                                $page_data['payments'] = $this->db->get('advertisements_payment')->result();
                                $page_data['ads_plans'] = $this->db->get('advertisement_plans')->result();
                                $this->load->view('back/member_configure/advertisements/add_advertisements',$page_data);
                        } elseif ($para1 == "edit_advertisements") {
                                $page_data['get_advertisements'] = $this->db->get_where("advertisements", array("advertisements_id" => $para2))->result();
                                $page_data['ads_plans'] = $this->db->get('advertisement_plans')->result();
                                $this->load->view('back/member_configure/advertisements/edit_advertisements', $page_data);
                        } elseif ($para1 == "do_add") {
							
								//print_r($_FILES['file']['name']);die();
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
											$ajax_error[] = array('ajax_error' => 'Image must be upload JPEG,JPG & PNG !!');
											echo json_encode($ajax_error);
										}
									}
								}
							
                                $this->form_validation->set_rules('title', 'advertisements title', 'required');
                                $this->form_validation->set_rules('address', 'advertisements address', 'required');
                                $this->form_validation->set_rules('advertisement_plans_id', 'advertisements duration', 'required');
                                $this->form_validation->set_rules('ads_email', 'advertisements email', 'required');
                                $this->form_validation->set_rules('ads_phone', 'advertisements phone', 'required');
							
										
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['title'] = $this->input->post('title');
                                        $title = $this->input->post('title');
                                        $data['ads_phone'] = $this->input->post('ads_phone');
                                        $data['address'] = $this->input->post('address');
                                        $data['company_url'] = $this->input->post('company_url');
                                        $data['city_state'] = $this->input->post('city_state');
									    $data['color'] = $this->input->post('color');
                                        $address = $this->input->post('address');
                                        $data['advertisement_plans_id'] = $this->input->post('advertisement_plans_id');
                                        $plan_id = $this->input->post('advertisement_plans_id');
                                        $plan_data = $this->db->where('id',$plan_id)->get('advertisement_plans')->row();
                                        $data['duration'] = $plan_data->duration;
                                        $data['ads_email'] = $this->input->post('ads_email');
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
                                        $data['payment_status'] = 1;
										//echo "<pre>";print_r($data);die();
                                        $result = $this->db->insert('advertisements', $data);
                                        
                                        $insert_id = $this->db->insert_id();
                                        $payment['advertisement_id'] = $insert_id;
                                        
                                        $payment['payment_status'] = 'completed';
                                        $payment['payment_by'] = 'Cash';
                                        $this->db->insert('advertisements_payment',$payment);
                                        $this->Email_model->advertisement_send_url_notification($unique_id,$email,$address,$title,$duration ,$amount="", $start_date, $data['end_date']);
                                        
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
								//print_r($_FILES['file']['name']);die();
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
											$ajax_error[] = array('ajax_error' => 'Image must be upload JPEG,JPG & PNG !!');
											echo json_encode($ajax_error);
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
                                        $advertisements_id = $this->input->post('advertisements_id');
                                        $data['title'] = $this->input->post('title');
                                        $data['address'] = $this->input->post('address');
                                        $data['ads_phone'] = $this->input->post('ads_phone');
                                        $data['city_state'] = $this->input->post('city_state');
                                        $data['ads_email'] = $this->input->post('ads_email');
                                        $data['company_url'] = $this->input->post('company_url');
                                        $data['end_date'] = $this->input->post('end_date');
									    $data['color'] = $this->input->post('color');
									//echo "asfdsa";die();
                                        $this->db->where('advertisements_id', $advertisements_id);
                                        $result = $this->db->update('advertisements', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('advertisements_id', $para2);
                                $result = $this->db->delete('advertisements');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }


        function advertisements_approve($id){
		
           $data = $this->db->get_where('advertisements', array('advertisements_id' => $id))->row();
           $data1 = $this->db->where('advertisement_id', $id)->order_by('ads_payment_id','desc')->limit(1)->get('advertisements_payment')->row();
           $register = date("m-d-Y" , strtotime($data1->payment_date));
           $ads_email = $data->ads_email;
           $title = $data->title;
           $address = $data->address;
           $unique_id = $data->unique_id;
           $duration = $data->duration;
           if ($duration == 6) {
                $amount = 100;
           }else{
                $amount =  150;
           }
           $start_date = date("m-d-Y" , strtotime($data->start_date));
           $end_date = date("m-d-Y" , strtotime($data->end_date));
           $this->db->where('advertisements_id',$id)->update('advertisements',['status'=>0,'email_status'=>'1']);

           $this->Email_model->advertisement_approval_notification($id,$ads_email,$title,$address,$unique_id,$duration ,$amount, $start_date, $end_date,$register);
           echo json_encode('success');
        }

        function advertisements_reject($id){
           $data = $this->db->get_where('advertisements', array('advertisements_id' => $id))->row();
           $ads_email = $data->ads_email;
           $title = $data->title;
           $address = $data->address;
           $unique_id = $data->unique_id;
           $this->db->where('advertisements_id',$id)->update('advertisements',['status'=>4,'email_status'=>'2']);
           $this->Email_model->advertisement_reject_notification($id,$ads_email,$title,$address,$unique_id);
           
           echo json_encode('success');
        }

        function approve_ads_send_url_notification()
        {
			
            $id = $_POST['ads_id'];
            $ads_email = $_POST['ads_email'];
            $data = $this->db->where('advertisements_id',$id)->get('advertisements')->row();
            $url = $data->unique_id;

           $title = $data->title;
           $address = $data->address;
           $unique_id = $data->unique_id;
           $duration = $data->duration;
           if ($duration == 6) {
                $amount = 100;
           }else{
                $amount =  150;
           }
           $start_date = date("d-m-Y" , strtotime($data->start_date));
           $end_date = date("d-m-Y" , strtotime($data->end_date));		
		   $this->db->where('advertisements_id',$id)->update('advertisements',['email_status'=>'0']);
			
           $this->Email_model->advertisement_send_url_notification($url,$ads_email,$title,$address,$duration ,$amount, $start_date, $end_date);
			
           //$this->Email_model->paypal_payment_success("Title","shovoua@gmail.com",100,7);
            echo json_encode("true");
        }
        
        function getBlankEmaildetails(){
                $data  = $this->db->where('email_template_id',29)->get('email_template')->result();
                echo json_encode($data);
        }

        function send_blank_mail(){
                $id = $_POST['id'];
                $member = $this->db->where('member_id',$id)->get('member')->row();
                $email = $member->email;
                $name = $member->first_name;
                $subject = $_POST['subject'];
                $body = $_POST['body'];
            $this->Email_model->send_blank_email($email,$name,$subject,$body);
            echo json_encode("true");

        }

        function CoverPic_approval_reject($id){
                $cover_pics = $this->db->where('cover_pics_id',$id)->get('cover_pics')->row();
                $member_id = $cover_pics->member_id;
                $member = $this->db->where('member_id',$member_id)->get('member')->row();
                $email = $member->email;
                $name = $member->first_name;
                $send = $this->Email_model->CoverPic_approval_reject_mail($email,$name);
                     
                     $this->db->where('member_id',$member_id)->where('start_date',null)->order_by('cover_pic_payment_id','desc')->update('cover_pic_payment',['image_reject' => 1]);
                     $this->db->where('cover_pics_id',$id)->update('cover_pics',['status' => 3]);
                if ($send) {
                }
				echo "success";die();
                redirect(base_url() . 'admin/CoverPic_approval', 'refresh');
        }
	
	function countAdvertisement(){
		$ads_notification = count($this->db->where('status',3)->where('payment_status !=',0)->get('advertisements')->result());
		echo $ads_notification;
	}
	
	
        function paypal_plans($para1 = "", $para2 = "")
        {
                if ($this->admin_permission() == FALSE) {
                        redirect(base_url() . 'admin/login', 'refresh');
                } else {
                        $page_data['title'] = "Admin || " . $this->system_title;
                        if ($para1 == "") {
                                $page_data['top'] = "member_configure/index.php";
                                $page_data['folder'] = "paypal_plan";
                                $page_data['file'] = "index.php";
                                $page_data['bottom'] = "member_configure/index.php";
                                $page_data['all_paypal_plans'] = $this->db->get("paypal_subscription_plans")->result();
                                if ($this->session->flashdata('alert') == "add") {
                                        $page_data['success_alert'] = translate("you_have_successfully_added_the_data!");
                                } elseif ($this->session->flashdata('alert') == "edit") {
                                        $page_data['success_alert'] = translate("you_have_successfully_edited_the_data!");
                                } elseif ($this->session->flashdata('alert') == "delete") {
                                        $page_data['success_alert'] = translate("you_have_successfully_deleted_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_add") {
                                        $page_data['danger_alert'] = translate("failed_to_add_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_edit") {
                                        $page_data['danger_alert'] = translate("failed_to_edit_the_data!");
                                } elseif ($this->session->flashdata('alert') == "failed_delete") {
                                        $page_data['danger_alert'] = translate("failed_to_delete_the_data!");
                                }
                                $page_data['page_name'] = "paypal_plan";
                                // echo "<pre>";print_r($page_data);die;
                                $this->load->view('back/index', $page_data);
                        } elseif ($para1 == "add_paypal_plan") {
                                $this->load->view('back/paypal_plan/add_paypal_plan');
                        } elseif ($para1 == "edit_paypal_plan") {
                                $page_data['get_paypal_plan'] = $this->db->get_where("paypal_subscription_plans", array("id" => $para2))->result();
                                $this->load->view('back/paypal_plan/edit_paypal_plan', $page_data);
                        } elseif ($para1 == "do_add") {
                                $this->form_validation->set_rules('name', 'paypal_plan Name', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $data['name'] = $this->input->post('name');
                                        $result = $this->db->insert('paypal_subscription_plans', $data);
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'add');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_add');
                                        }
                                }
                        } elseif ($para1 == "update") {
                                $this->form_validation->set_rules('amount', 'Paypal plan amount', 'required');
                                if ($this->form_validation->run() == FALSE) {
                                        $ajax_error[] = array('ajax_error' => validation_errors());
                                        echo json_encode($ajax_error);
                                } else {
                                        $paypal_plan_id = $this->input->post('id');
                                        $plan_id = $this->input->post('plan_id');
                                        $amount  = $this->input->post('amount');
                                        $data['amount'] = $this->input->post('amount');
                                        $plan_pricing = $this->plan_pricing($plan_id,$amount);
                                        //echo $plan_id;die();
                                        if ($plan_pricing == 1) {
                                                    $this->db->where('id', $paypal_plan_id);
                                          $result = $this->db->update('paypal_subscription_plans', $data);
                                        }
                                        recache();
                                        if ($result) {
                                                $this->session->set_flashdata('alert', 'edit');
                                        } else {
                                                $this->session->set_flashdata('alert', 'failed_edit');
                                        }
                                }
                        } elseif ($para1 == "delete") {
                                $this->db->where('id', $para2);
                                $result = $this->db->delete('paypal_subscription_plans');

                                recache();
                                if ($result) {
                                        $this->session->set_flashdata('alert', 'delete');
                                } else {
                                        $this->session->set_flashdata('alert', 'failed_delete');
                                }
                        }
                }
        }


        public function plan_pricing($plan_id,$amount)
        { 
			
			$token = $this->db->where('id',1)->get('paypal_access_token')->row();
			$expires_in = $token->expires_in;

			if (time() > $expires_in) {
				$this->generalAccesstoken();
			}

			$access_token = $this->db->where('id',1)->get('paypal_access_token')->row();
			define('PAYPAL_ACCESS_TOKEN',$access_token->access_token);
			
			  $body = '{
				"pricing_schemes": [{
				"billing_cycle_sequence": 1,
				  "pricing_scheme": {
					"fixed_price": {
					  "value": "'.$amount.'",
					  "currency_code": "USD"
					  }
					}
				  }
				]
			  }';

		 //echo "<pre>";print_r(PAYPAL_ACCESS_TOKEN);die();

		   $curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/billing/plans/".$plan_id."/update-pricing-schemes",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer ".PAYPAL_ACCESS_TOKEN,
				"Content-Type: application/json",
				"Accept: application/json",
				"Prefer: return=representation",
			  ),
			  CURLOPT_POSTFIELDS => $body,
			));
			$response = curl_exec($curl);
			//echo "<pre>";print_r($response);die();
			curl_close($curl);
			if($response != null){
				return 0;
			}else{
				return 1;
			};
        }
	
	
	
	public function generalAccesstoken(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.sandbox.paypal.com/v1/oauth2/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic QVRiaUNSUkx2YXd6ZlNIVWRlVHFmRmt4NnkzSG1WRXM4cnZRSzZaZldhdEpfZk1EUWMySDV5XzRWbUlWZk96eDVWUnhoRnhZLUYzcTBpeTE6RUp1TjJLbXJEVjY0UzB6ZzJ3Q2lzeDJJUDZSc09qWDh0cExPelFsaXRzdFJOZkVldkNxamM2MjJBb081SEJKWklyX0dLOHNGMFJBekdmbHQ=',
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        $data['access_token'] = $result->access_token;
        $time = time() + $result->expires_in;
        $data['expires_in'] = $time;
        $this->db->where('id',1)->update('paypal_access_token',$data);
		if($result){
			redirect(base_url() . 'home', 'refresh');
		}

	}

}
