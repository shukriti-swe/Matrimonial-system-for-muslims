<?php

class Im_message_Model extends CI_Model{

    public $sender;
    public $receiver;
    public $message;
    public $type;
    public $fileName;
    public $receiver_type;
    public $date;
    public $time;
    public $date_time;

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function insert($u_id,$g_id,$message,$type,$fileName,$receiver_type,$date,$time,$date_time)
    {
        $this->sender=$u_id;
        $this->receiver=$g_id;
        $this->message=$message;
        $this->type=$type;
        $this->fileName=$fileName;
        $this->receiver_type=$receiver_type;
        $this->date=$date;
        $this->time=$time;
        $this->date_time=$date_time;
        $this->db->insert("im_message",$this);
        return $this->db->insert_id();
    }

    public function getMessage($g_id, $start, $limit)
    {
        $this->db->where("receiver",$g_id);
        $this->db->where("message !=",null);
        $this->db->order_by("date_time DESC");
        $query = $this->db->get("im_message",$limit,$start);
        $prepareData=array();
        foreach ($query->result() as $result){
            if($result->type!="text" && $result->type!="update"){
                $result->message=base_url() . "template/front/assets/im/group_".$g_id."/".$result->message;
            }

            $prepareData[]=$result;
        }
        return $prepareData;
    }
    public function getRecentMessage($g_id)
    {

        $this->db->where("receiver",$g_id);
        $this->db->order_by("m_id DESC");

        $query = $this->db->get("im_message");
        $prepareData=$query->row();
        if($prepareData!=null){
            if( $prepareData->type!="text" && $prepareData->type!="update"){
                $prepareData->message=base_url() . "template/front/assets/im/group_" .$g_id."/". $prepareData->message;
            }
        }

        return $this->arrayToObject($prepareData);
    }
	
    public function getRecentMessageWithUpdate($g_id)
    {
        $this->db->where("receiver",$g_id);
       // $this->db->where("type <>","update");
        $this->db->order_by("m_id DESC");

        $query = $this->db->get("im_message");
        $prepareData=$query->row();
        if($prepareData!=null){
            if( $prepareData->type!="text" && $prepareData->type!="update"){
                $prepareData->message=base_url() . "template/front/assets/im/group_" .$g_id."/". $prepareData->message;
            }
        }

        return $this->arrayToObject($prepareData);
    }

    public function getTotalMessage($g_id){
        $this->db->select("count(m_id) as total");
        $this->db->where("receiver",$g_id);
        $query = $this->db->get("im_message");
        return $query->row()->total;
    }
    public function DeleteAll($g_id){
        $this->db->where("g_id",$g_id);
        return $this->db->delete("im_message");
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