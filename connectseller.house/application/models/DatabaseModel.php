<?php

class DatabaseModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('email');
    }
        
    public function getAreaSearch(){
		$resultSet;

		$this->db->select('area');
		$this->db->distinct();
		$this->db->order_by('area','ASC');
		$query = $this->db->get('properties');		
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }
        $str = $this->db->last_query();
        
        return $resultSet;	
	}
	
	public function getPropertyTypeSearch(){
		$resultSet;

		$this->db->select('type');
		$this->db->distinct();
		$this->db->order_by('type','ASC');
		$query = $this->db->get('properties');		
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }
        $str = $this->db->last_query();
        
        return $resultSet;	
	}
	
	public function getPropertyCategorySearch(){
		$resultSet;

		$this->db->select('category');
		$this->db->distinct();
		$this->db->order_by('category','ASC');
		$query = $this->db->get('properties');
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }
        $str = $this->db->last_query();
        
        return $resultSet;	
	}
	
	public function getPropertyBedRoomSearch(){
		$resultSet;

		$this->db->select('bedroom');
		$this->db->distinct();
		$this->db->order_by('bedroom','DESC');
		$query = $this->db->get('properties');
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }
        $str = $this->db->last_query();
        
        return $resultSet;	
	}
	
	public function getPropertyBathRoomSearch(){
		$resultSet;

		$this->db->select('bathroom');
		$this->db->distinct();
		$this->db->order_by('bathroom','DESC');
		$query = $this->db->get('properties');
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }
        $str = $this->db->last_query();
        
        return $resultSet;	
	}
	
	public function getPropertyPriceSearch(){
		$resultSet;

		$this->db->select('price');
		$this->db->distinct();
		$this->db->order_by('price','ASC');
		$query = $this->db->get('properties');
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }
        $str = $this->db->last_query();
        
        return $resultSet;	
	}
	
	public function getPropertyAreaSqSearch(){
		$resultSet;

		$this->db->select('land_size');
		$this->db->distinct();
		$this->db->order_by('land_size','ASC');
		$query = $this->db->get('properties');
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }
        $str = $this->db->last_query();

        return $resultSet;	
	}
	
    
    public function getSellerInfo($id){
		$resultSet;

        $query = $this->db->get_where('seller', array('id' => $id,'status' => 'ACTIVE'));
        if ($query->num_rows() > 0) {
            $resultSet = $query->row();
        }

        return $resultSet;	
	}
    
    public function getUniquePropertiesArea(){
		$resultSet;
		
		$query = $this->db->query('SELECT DISTINCT(area) FROM properties');
		if ($query->num_rows() > 0){
			$resultSet = $query->result();
		}
		
		return $resultSet;
	}
	
	public function getPropertiesCountByArea($area){
		$resultSet = 0;

        $query = $this->db->get_where('properties', array('area' => $area,'status' => 'ON MARKET'));
		$resultSet =  $query->num_rows();

        return $resultSet;				
	}

    public function getPropertiesByCategory($propertyCategory){
		$resultSet = "";

        $query = $this->db->get_where('properties', array('category' => $propertyCategory,'status' => 'ON MARKET'));
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }

        return $resultSet;		
	}
	
	public function getPropertiesByType($propertyType){
		$resultSet = "";

        $query = $this->db->get_where('properties', array('type' => $propertyType,'status' => 'ON MARKET'));
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }

        return $resultSet;		
	}
	
	public function getPropertiesByLocation($propertyLocation){
		$resultSet = "";

        $query = $this->db->get_where('properties', array('area' => $propertyLocation,'status' => 'ON MARKET'));
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }

        return $resultSet;		
	}
    
    public function getProperty($id){
		$resultSet;

        $query = $this->db->get_where('properties', array('id' => $id,'status' => 'ON MARKET'));

        if ($query->num_rows() > 0) {
            $resultSet = $query->row();
        }

        return $resultSet;		
	}
	
	public function getAllRentPropertiesCount(){
		$resultCount = 0;

        $query = $this->db->get_where('properties', array('category' => 'RENT','status' => 'ON MARKET'));
		$resultCount = $query->num_rows();

        return $resultCount;					
	}
	
	public function getAllSalePropertiesCount(){	
		$resultCount = 0;

        $query = $this->db->get_where('properties', array('category' => 'SALE','status' => 'ON MARKET'));
		$resultCount = $query->num_rows();

        return $resultCount;		
	}
	
	public function getlAllHotDealsPropertiesCount(){
		$resultCount = 0;

        $query = $this->db->get_where('properties', array('category' => 'HOT DEAL','status' => 'ON MARKET'));
		$resultCount = $query->num_rows();

        return $resultCount;					
	}
	
	public function getRentProperties($limit = 4){
		$resultSet = "";

		$this->db->limit($limit);
        $query = $this->db->get_where('properties', array('category' => 'RENT','status' => 'ON MARKET'));
		$resultSet = $query->result();

        return $resultSet;					
	}
    
    public function getHotDealsProperties($limit = 1){
		$resultSet = "";

		$this->db->limit($limit);
        $query = $this->db->get_where('properties', array('category' => 'HOT DEAL','status' => 'ON MARKET'));
		$resultSet = $query->result();

        return $resultSet;			
	}
	
	public function getLatestProperties($limit = 1){
		$resultSet = "";

		$this->db->limit($limit);
		$query = $this->db->get_where('properties', array('status' => 'ON MARKET'));
		$resultSet = $query->result();

        return $resultSet;					
	}
    
    public function getAllProperties(){
		$resultSet = "";

		$query = $this->db->get_where('properties', array('status' => 'ON MARKET'));
		$resultSet = $query->result();

        return $resultSet;	
	}
    
    public function getDbConfig($name){
        $result = "";

        $query = $this->db->get_where('config', array('name' => $name));

        if ($query->num_rows() > 0) {
            $resultSet = $query->row();
            $result = $resultSet->value;
        }

        return $result;		
	}

	public function getSliders(){
        $resultSet = "";

		$this->db->order_by('order', 'ASC');
        $query = $this->db->get_where('sliders', array('status' => 'ACTIVE'));

        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
        }

        return $resultSet;		
	}

    public function getUserInfo($id) {
        $resultSet = "";

        $query = $this->db->get_where('hms_users', array('id' => $id));

        if ($query->num_rows() > 0) {
            $resultSet = $query->row();
        }

        return $resultSet;
    }

    public function getUserInfoByUsername($username) {
        $resultSet = "";

        $query = $this->db->get_where('hms_users', array('username' => $username));

        if ($query->num_rows() > 0) {
            $resultSet = $query->row();
        }

        return $resultSet;
    }

    public function login($username, $hashPassword) {
        $resultSet = "";

        $query = $this->db->get_where('hms_users', array('username' => $username, 'password' => $hashPassword));

        if ($query->num_rows() > 0) {
            $resultSet = $query->row();
        }

        return $resultSet;
    }

    public function logUser($userId, $username, $role) {
        $insertData = array(
            'user_id' => $userId,
            'session_id' => $userId . $username . time(),
            'role' => $role
        );

        $i = $this->db->insert('hms_user_log', $insertData);

        return $i;
    }

}
