<?php

class Im_group_Model extends CI_Model{

    public $name;
    public $lastActive;
    public $createdBy;
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }


    public function insert($name,$lastActive,$createdBy)
    {
        $this->name=$name;
        $this->lastActive=$lastActive;
        $this->createdBy=$createdBy;
        $this->db->insert("im_group",$this);
        return $this->db->insert_id();
    }


    public function update($g_id,$name)
    {
        $update=array(
            "name"=>$name
        );
        $this->db->where("g_id",$g_id);
        return $this->db->update("im_group",$update);
    }

    public function updateLastActiveDate($g_id,$lastActive){
        $update=array(
            "lastActive"=>$lastActive
        );
        $this->db->where("g_id",$g_id);
        return $this->db->update("im_group",$update);
    }

    public function delete($g_id)
    {
        $this->db->where("g_id",$g_id);
        return $this->db->delete("im_group");
    }


    public function get($g_id)
    {
        $this->db->where("g_id",$g_id);
        $this->db->order_by("lastActive DESC");
        $query = $this->db->get("im_group");

        return $query->row();
    }
    public function getName($g_id)
    {
        $this->db->select("name");
        $this->db->where("g_id",$g_id);
        $this->db->order_by("lastActive DESC");
        $query = $this->db->get("im_group");

        return $query->row()->name;
    }
    public function DeleteAll($g_id){

        $this->db->where("g_id",$g_id);
        return $this->db->delete("im_group");
    }
    public function ifThisUserCreator($g_id,$u_id)
    {
        $this->db->where("g_id",$g_id);
        $this->db->where("createdBy",$u_id);
        $this->db->from('im_group');
        if ($this->db->count_all_results() == 0) {
            return false;
        } else {
            return true;
        }
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