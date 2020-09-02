<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->library('cart');
        $this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->library('user_agent');
    }
	
	public function viewByCategory(){
		$data = $this->ApplicationModel->getAppConfig();
		$data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
		$data['pageTitle'] = "Favorite Properties";
        $data['warning'] = "";       
        
		$propertyCategory = strtoupper("nigeria");
		
		//$data['propertiesByCategory'] = $this->DatabaseModel->getPropertiesByCategory($propertyCategory);
		$query = $this->db->query("SELECT * FROM `properties` WHERE id IN({$comma_separated});");
		$data['propertiesByCategory'] = $query->result();
		
		$data['propertyCategory'] = $propertyCategory; 
		
		if(empty($data['propertiesByCategory'])){
			redirect('/welcome/', 'welcome', 301);
		}
		                        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav_message',$data);
		$this->load->view('welcome_views/view_properties_by_category_message',$data);
		$this->load->view('footers/footer_message',$data);
	}
	
	public function view(){
		try{
			$userWishList = $this->session->userdata('wish_list');
			$comma_separated = implode(",", $userWishList);
			
			$data = $this->ApplicationModel->getAppConfig();
			$data['copyright'] = $this->ApplicationModel->copyright();
			$data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
			$data['pageTitle'] = "Favorite Properties";
			$data['warning'] = "";       
			$propertyCategory = strtoupper("Your Favorite Properties");  

			$query = $this->db->query("SELECT * FROM `properties` WHERE id IN({$comma_separated});");
			$data['propertiesByCategory'] = $query->result();
			$data['propertyCategory'] = $propertyCategory; 
			
			$this->load->view('headers/header_message',$data);
			$this->load->view('navs/nav_message',$data);
			$this->load->view('welcome_views/view_properties_by_category_message',$data);
			$this->load->view('footers/footer_message',$data);
		}catch(Exception $e){
			log_message('error', 'Unable to process view method for wishlist controller');
		}
	}
	
	public function index($propertyID){
		try{
			$data = $this->ApplicationModel->getAppConfig();
			$wishListStringArray;
			$hasWishList = $this->session->userdata('has_wish_list');
			$wishListArray = array();
			$i = $propertyID;	
			
			if(isset($i)){	
				if($hasWishList){
					$wishListArray = $this->session->userdata('wish_list');					
					array_push($wishListArray,$i);
					$wishListArray = array_unique($wishListArray);

					$wishData = array(
					   'wish_list'  => $wishListArray,
					   'has_wish_list' => TRUE
					);
					$this->session->set_userdata($wishData);	
				}else{
					array_push($wishListArray,$i);
					$wishListArray = array_unique($wishListArray);

					$wishData = array(
					   'wish_list'  => $wishListArray,
					   'has_wish_list' => TRUE
					);
					$this->session->set_userdata($wishData);					
				}
			}
			
			//print_r($wishData);			
			// is not referral page
			if (!$this->agent->is_referral()){
				//echo $this->agent->referrer();
				redirect($this->agent->referrer()); // back to  referere page
			}
		}catch (Exception $e) {
			log_message('error', 'Unable to process index method for wishlist controller');
			redirect($this->agent->referrer()); // back to  referere page
		}
	}	
}

/* End of file wishlist.php */
/* Location: ./application/controllers/wishlist.php */
