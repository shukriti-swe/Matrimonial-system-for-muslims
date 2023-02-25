<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaypalController extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$token = $this->db->where('id',1)->get('paypal_access_token')->row();
		$expires_in = $token->expires_in;

		if (time() > $expires_in) {
			$this->generalAccesstoken();
		}

		$access_token = $this->db->where('id',1)->get('paypal_access_token')->row();
		define('PAYPAL_ACCESS_TOKEN',$access_token->access_token);
	  }
	public function PlanID($product_id,$name,$interval_unit="MONTH", $interval_count,$amount )
	{
		$body = '{
	      "product_id": "'. str_replace("%20"," ", $product_id) .'",
	      "name": "'. str_replace("%20"," ", $name).'",
	      "billing_cycles": [
	        {
	          "frequency": {
	            "interval_unit": "'.str_replace("%20"," ", $interval_unit).'",
	            "interval_count": '.$interval_count.'
	          },
	          "tenure_type": "REGULAR",
	          "sequence": 1,
        	  "total_cycles": 1,
	          "pricing_scheme": {
	            "fixed_price": {
	              "value": "'.$amount.'",
	              "currency_code": "USD"
	            }
	          }
	        }
	      ],
	      "payment_preferences": {
	        "auto_bill_outstanding": true,
	        "payment_failure_threshold": 3
	      }
	    }';
	    
	   //print_r($body);die();
        //"total_cycles": 100,

       $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/billing/plans",
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
            //"PayPal-Request-Id: SUBSCRIPTION-21092020-001",
            "Prefer: return=representation",
          ),
          CURLOPT_POSTFIELDS => $body,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        echo "Plan ID : ".$result->id;

        echo "<br>";
        echo "================";
        print_r($result); 
	}
	
	
	public function createPlan(){
	    $product_id="PROD-8CE174808F793561E";
	    $name="One year advertisement plan";
	    $interval_unit="MONTH";
	    $interval_count=12;
	    $amount= 150;
	    $this->PlanID($product_id,$name,$interval_unit,$interval_count,$amount);
	}
	

	public function ProductId($name,$description,$type = "SERVICE",$category="EDUCATION")
	{
		$body = '{
		  "name": "'.str_replace("%20"," ", $name).'",
		  "description": "'.str_replace("%20"," ", $description).'",
		  "type": "'.str_replace("%20"," ", $type).'",
		  "category": "'.str_replace("%20"," ", $category) .'"
		}';
       $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/catalogs/products",
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
          ),
          CURLOPT_POSTFIELDS => $body,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response);
		
		print_r($result);
		echo PAYPAL_ACCESS_TOKEN;die();
        echo "Product ID : ".$result->id;

        echo "<br>";
        echo "================";
        print_r($result); 

	}
	
	
	public function createProduct(){
	    $name = "Student Subscription Product";
	    $description = "Student Subscription Product";
	    $type = "SERVICE";
	    $category="SOFTWARE";
	    
	    $this->ProductId($name,$description,$type,$category);
	}
	
	
	public function plan_pricing($plan_id='P-2MX2123897085550ML7QEE2I',$amount=115){ 
		
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

		 //echo "<pre>";print_r($body);die();

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
				//"PayPal-Request-Id: SUBSCRIPTION-21092020-001",
				"Prefer: return=representation",
			  ),
			  CURLOPT_POSTFIELDS => $body,
			));
			$response = curl_exec($curl);
			curl_close($curl);
			print_r($response);
	}
	
	public function getPlanDetails($plan_id='P-2MX2123897085550ML7QEE2I'){
		//echo PAYPAL_ACCESS_TOKEN;die;
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/billing/plans/".$plan_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer".PAYPAL_ACCESS_TOKEN,
          "Content-Type: application/json",
          //"Accept: application/json",
		  //"PayPal-Request-Id: SUBSCRIPTION-21092020-001",
		  //"Prefer: return=representation",
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      $result = json_decode($response);
      echo '<pre>'; print_r($response);
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
        //echo $result->expires_in;
        //echo "<br>";
        //print_r($result);die();
        //echo $response;

	}
	
	
	public function subscription(){
        $id = $_POST['plan_id'];
        $member_id = $this->session->userdata['member_id'];
        $email = $this->session->userdata['member_email'];
        //$email = 'shovoua@gmail.com';
        $member = $this->db->where('member_id',$member_id)->get('member')->row();
        $first_name = $member->first_name;
        $last_name = $member->last_name;
    
         if ($id == 4) {
           $plan_id = PAYPAL_PER_MONTH_PLAN_ID;
         }elseif ($id == 1) {
           $plan_id = PAYPAL_THREE_MONTH_PLAN_ID;
         }elseif ($id == 2) {
           $plan_id = PAYPAL_SIX_MONTH_PLAN_ID;
         }elseif ($id == 3) {
           $plan_id = PAYPAL_TWELVE_MONTH_PLAN_ID;
         }
        
        
        //$plan_id = PAYPAL_M_TEST;
    
        //$start_time = date('Y-m-d h:i:s');
        $this->load->helper('string'); 
        $PayPal_Request_Id = random_string('alnum',15);
        //echo $start_time; die();
    
    
        $body = '{
    
              "plan_id": "'.$plan_id.'",
              "subscriber": {
                "name": {
                  "given_name": "'. str_replace("%20"," ",trim($first_name)) .'",
                  "surname": "'. str_replace("%20"," ", trim($last_name)) .'"
                },
                "email_address": "'.$email.'"
              },
              "application_context": {
                "brand_name": "Match Made In Jannah",
                "locale": "en-US",
                "shipping_preference": "SET_PROVIDED_ADDRESS",
                "user_action": "SUBSCRIBE_NOW",
                "payment_method": {
                  "payer_selected": "PAYPAL",
                  "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
                },
                "return_url": "'.base_url().'home/thankyou_page_paypal",
                "cancel_url": "'.base_url().'home/profile"
              }
            
            }';
    
    
            // echo "<pre>";
            // print_r($body);die();
    
         $curl = curl_init();
    
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/billing/subscriptions",
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
                "PayPal-Request-Id:".$PayPal_Request_Id,
                "Prefer: return=representation",
              ),
              CURLOPT_POSTFIELDS => $body,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response);
              
            $link = $result->links[0];
            $href = $link->href;
            $data['token']=parse_url($href, PHP_URL_QUERY);
            $data['subscription_id'] = $result->id;
            $data['member_id'] = $this->session->userdata['member_id'];
            $data['plan_id'] = $plan_id;
            $data['type'] = "Membership";
            $this->db->insert("paypal_subscription",$data);
            echo $href;
      }
      
      
    public function subscription_for_coverPicture(){
        $id = $_POST['plan_id'];
        $member_id = $this->session->userdata['member_id'];
        $email = $this->session->userdata['member_email'];
        $member = $this->db->where('member_id',$member_id)->get('member')->row();
        $first_name = $member->first_name;
        $last_name = $member->last_name;
        
         if ($id == 5) {
           $plan_id = PAYPAL_COVER_PIC_PER_WEEK_PLAN_ID;
         }elseif ($id == 7) {
           $plan_id = PAYPAL_COVER_PIC_TWO_WEEK_PLAN_ID;
         }
        
        //$plan_id = PAYPAL_ADS_TEST;
        
        $this->load->helper('string'); 
        $PayPal_Request_Id = random_string('alnum',15);
    
        $body = '{
              "plan_id": "'.$plan_id.'",
              "subscriber": {
                "name": {
                  "given_name": "'. str_replace("%20"," ",trim($first_name)) .'",
                  "surname": "'. str_replace("%20"," ", trim($last_name)) .'"
                },
                "email_address": "'.$email.'"
              },
              "application_context": {
                "brand_name": "Match Made In Jannah",
                "locale": "en-US",
                "shipping_preference": "SET_PROVIDED_ADDRESS",
                "user_action": "SUBSCRIBE_NOW",
                "payment_method": {
                  "payer_selected": "PAYPAL",
                  "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
                },
                "return_url": "'.base_url().'home/thankyou_page_paypal",
                "cancel_url": "'.base_url().'home/profile"
              }
            
            }';
    
    
            // echo "<pre>";
            // print_r($body);die();
    
         $curl = curl_init();
    
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/billing/subscriptions",
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
                "PayPal-Request-Id:".$PayPal_Request_Id,
                "Prefer: return=representation",
              ),
              CURLOPT_POSTFIELDS => $body,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response);
            $link = $result->links[0];
            $href = $link->href;
            $data['token']=parse_url($href, PHP_URL_QUERY);
            $data['subscription_id'] = $result->id;
            $data['member_id'] = $member_id;
            $data['plan_id'] = $plan_id;
            $data['type'] = "CoverPicture";
            $this->db->insert("paypal_subscription",$data);
            echo $href;

      }
      
      
    public function subscription_for_advertisement(){
        $id = $_POST['duration'];
        $ads_id = $_POST['ads_id'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $unique_id = $_POST['unique_id'];
        $first_name = "Matchmade";
        $last_name = "InJannah";
    
        if ($id == 6) {
          $plan_id = PAYPAL_SIX_MONTH_ADS_PLAN_ID;
        }elseif ($id == 12) {
          $plan_id = PAYPAL_TWELVE_MONTH_ADS_PLAN_ID;
        }
        
        
        //$plan_id = PAYPAL_ONE_DAY_TEST; P-23W30758815258348MCJXGNI;
    	//$plan_id = 'P-2MX2123897085550ML7QEE2I';
		
        $this->load->helper('string'); 
        $PayPal_Request_Id = random_string('alnum',15);
    
        $body = '{
              "plan_id": "'.$plan_id.'",
              "subscriber": {
                "name": {
                  "given_name": "'. str_replace("%20"," ",trim($first_name)) .'",
                  "surname": "'. str_replace("%20"," ", trim($last_name)) .'"
                },
                "email_address": "'.$email.'"
              },
              "application_context": {
                "brand_name": "Match Made In Jannah",
                "locale": "en-US",
                "shipping_preference": "SET_PROVIDED_ADDRESS",
                "user_action": "SUBSCRIBE_NOW",
                "payment_method": {
                  "payer_selected": "PAYPAL",
                  "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
                },
                "return_url": "'.base_url().'home/thankyou_page_paypal",
                "cancel_url": "'.base_url().'home/advertisement_payment_page/'.$unique_id.'"
              }
            
            }';
    
    
            // echo "<pre>";
            // print_r($body);die();
    
         $curl = curl_init();
    
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api-m.sandbox.paypal.com/v1/billing/subscriptions",
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
                "PayPal-Request-Id:".$PayPal_Request_Id,
                "Prefer: return=representation",
              ),
              CURLOPT_POSTFIELDS => $body,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response);
            // echo "<pre>";
            // print_r($result);die();
            $link = $result->links[0];
            $href = $link->href;
            $data['token']=parse_url($href, PHP_URL_QUERY);
            $data['subscription_id'] = $result->id;
            $data['member_id'] = $ads_id;
            $data['plan_id'] = $plan_id;
            $data['type'] = "Advertisement";
            $this->db->insert("paypal_subscription",$data);
            echo $href;

      }
	
	
}