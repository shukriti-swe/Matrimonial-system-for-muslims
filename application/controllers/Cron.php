<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	function __construct()
    {
            parent::__construct();
		$this->load->helper('string');
	  $this->load->library('email');
	  $this->load->model('Email_model');
    }
	public function index()
	{
		$today = date('Y-m-d');
		$expired = $this->db->where('end_date <=',$today)->where('status',0)->where('expired_status',0)->get('advertisements')->result();
		foreach ($expired as $value) {
			$id = $value->advertisements_id;
			$email = $value->ads_email;
			$end_date = $value->end_date;
			$title = $value->title;
			$email = $this->Email_model->advertisement_send_expired_notification($end_date,$email,$title);
			if ($email) {
				$expired = $this->db->where('advertisements_id',$id)->update('advertisements',['expired_status'=>1]);
			}

		}
		
	}

	public function userSecrit(){
		$member = $this->db->get('member')->result();
		foreach($member as $data){
			$this->db->where('member_id',$data->member_id)->update('member',['userSecret'=>$data->member_id]);
		}
	}
	
	
    public function delete_message(){
        $date = date('Y-m-d');
        $date2 = date('Y-m-d', strtotime($date. ' - 10 days'));

        $previes_msgs = $this->db->where('date <',$date2)->get('im_message')->result_array();

        foreach ($previes_msgs as $key => $value) {
            $msgID = $value['m_id'];
            $this->db->where('m_id',$msgID)->delete('im_message');
            $this->db->where('m_id',$msgID)->delete('im_receiver');
        }
        echo 'success';

    }
	
	public function advertisement_earnings_email(){
		
		
	$NewDate=Date('Y-m-d', strtotime('+6 days'));
	$this->db->where('end_date',$NewDate);
	$this->db->where('status','0');
	$this->db->where('payment_status','1');
	$add=$this->db->get('advertisements')->result();
  
	$this->db->update('advertisements',['email_status'=>'3']);
		
	if(!empty($add)){
	foreach($add as $key=>$row){
		//$token=random_string('alnum', 8);
		$data['advertisements_id']=$row->advertisements_id;
		$data['reg_date']=$row->start_date;
		$data['end_date']=$row->end_date;
		$data['random_key']=$row->unique_id;
		$this->db->insert('invoices',$data);

		$this->db->where('advertisements_id',$row->advertisements_id);
		$this->db->limit(1);
		$this->db->order_by('id','desc');
		$query=$this->db->get('invoices');
		$all_invoice[$key]=$query->result();
		
		$this->db->where('advertisement_id',$row->advertisements_id);
		$this->db->limit(1);
		$this->db->order_by('ads_payment_id','desc');
		$query=$this->db->get('advertisements_payment');
		$payment[$key]=$query->result();
		
		$link[$key]=base_url().'home/advertisement_payment_page/'.$row->unique_id.'/1'; 
	}
		
	foreach($all_invoice as $key=>$new_invoices){
		$invoice_id[$key]=$new_invoices[0]->id;
		$invoice_reg_date[$key]=$new_invoices[0]->reg_date;
		$invoice_end_date[$key]=$new_invoices[0]->end_date;
	}
		
	foreach($payment as $key=>$new_payment){
		$payment_dollar[$key]=$new_payment[0]->amount;
	}
	

	$from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
	$protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
	
	
            if ($protocol == 'smtp') {
                 $from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
            } else if ($protocol == 'mail') {
                $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            }

	  
	
	$this->db->where('title','Advertisement Expired');
	$email_body=$this->db->get('email_template')->row();
	
	$sub=$email_body->subject;  
	//$email_b= str_replace('[[base_url]]', base_url(), $email_body->body);
	
	foreach($add as $key=>$row){

	$date=date('m-d-Y',strtotime($invoice_reg_date[$key])).' - '.date('m-d-Y',strtotime($invoice_end_date[$key]));
	$date_new=date_create($invoice_end_date[$key]);
    $end_date=date_format($date_new,"F j, Y");
	    //die(); 
	    $change=["[[base_url]]","{data}","{Member’s first name}","{business_name}","{package}","{payment}","{invoice_no}","{date}","{link}","{end_date}"];
	    $change_to = [base_url(),$row->company_logo,$row->adviser_name,$row->title,$row->duration,$payment_dollar[$key],$invoice_id[$key],$date,$link[$key],$end_date];
	    $final_email_body=str_replace($change,$change_to,$email_body->body);
					echo '<pre>';
		//print_r($row->ads_email);die();
		$send_mail =$this->Email_model->do_email($from, $from_name, $row->ads_email, $sub, $final_email_body);
		
	}
		
}
else
{
	echo 'data not found';
}

}
	
	//public function advertisement_expired(){
	
	//$today_date=date("Y-m-d");
	//$this->db->set('expired_status','1');
	//$this->db->where('payment_status','1'); 
	//$this->db->where('DATE(end_date)<',$today_date);    
	//$this->db->update('advertisements');


	//echo 'expired status update';


	//}
	
	public function advertisement_expired_email(){

		$today_date=date("Y-m-d");

		$this->db->where('status','5');
		$this->db->where('payment_status','1');  	
		$this->db->where('DATE(end_date)<',$today_date); 
		$expired_ads=$this->db->get('advertisements')->result();

	  if($expired_ads)
	  {
		$this->db->where('status','5');
		$this->db->where('payment_status','1');  	
		$this->db->where('DATE(end_date)<',$today_date); 
		$this->db->update('advertisements',['status'=>5,'payment_status'=>3,'email_status'=>'3']);

		$from_name = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
	    $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
		
		if ($protocol == 'smtp') {
				$from = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
		} else if ($protocol == 'mail') {
			$from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
		}
		
	
			
		foreach($expired_ads as $ads)
		{
			$final_email_body="<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/>			 <br/>hi $ads->adviser_name, Your advertisement is expired";
			
			$final_email_body_admin="<a href='". base_url() ."'><img src='". base_url() ."uploads/header_logo/header_logo_1558265578.png'></a><br/>			 <br/>User $ads->adviser_name advertisement is expired";
			
			$send_mail =$this->Email_model->do_email($from, $from_name, $ads->ads_email,'Advertisement expired', $final_email_body);
			$send_mail_admin=$this->Email_model->do_email($from, $from_name,'matchmadeadmi@gmail.com','Advertisement expired', 		           $final_email_body_admin);
		}
		 echo 'email send';
	   }
	   else
	   {
		  echo 'no data found'; 
	   }
		

	}
	
}