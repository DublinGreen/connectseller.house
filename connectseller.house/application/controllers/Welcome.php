<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->library('session');
        $this->load->library('form_validation');
		$this->load->helper('directory');
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('email');

        $this->load->model('ApplicationModel');
        $this->load->model('DatabaseModel');
        $this->load->model('EmailModel');
        $this->load->model('UserModel');  
		$this->load->library('grocery_CRUD');      
    }

	function add_field_callback_1(){
		return "<input disabled id='field-user_id' class='form-control' name='user_id' type='text' value='{$this->session->userdata('id')}' maxlength='20'> DISABLED";
	}
	
	function add_field_callback_2(){
		return '<input type="text" maxlength="50" value="" name="state" style="width:400px"> ( for NIGERIA only )';
	}
	
	function add_field_callback_3(){
		return '<select disabled id="field-status" name="status" class="chosen-select select2-hidden-accessible" data-placeholder="Select Status" tabindex="-1" aria-hidden="true" style="display: none;"><option value=""></option><option value="OFF MARKET" selected="selected">OFF MARKET</option><option value="ON MARKET">ON MARKET</option></select>';
	}
	
	function add_field_callback_4(){
		return 'DETERMINE BY ADMIN';
	}
	
	function log_user_after_insert($post_array,$primary_key){
		$user_logs_insert = array(
		"user_id" => $primary_key,
		"created" => date('Y-m-d H:i:s'),
		"last_update" => date('Y-m-d H:i:s')
		);
	}


	public function userProperty(){
		$this->UserModel->checkUserAuth();
		
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] =  "My Properties";
        $data['warning'] = "";
        $data['canonicalUrl'] = base_url() . 'welcome/userProperty';
        
		$crud = new grocery_CRUD(); // GROCERY CRUD LIB 
		$crud->set_model('Custom_query_model');
		$crud->set_table('properties');
		$crud->basic_model->set_query_str("SELECT * FROM properties WHERE user_id = {$this->session->userdata('id')} "); //Query text here

		$crud->columns('user_id','status','category','type','name','price');
		//$crud->display_as('full_name','full name');
		$crud->set_subject('My Properties');
		$crud->required_fields('status','user_id','category','type','name','description','bedroom','bathroom',
		'toilet','price','address','state','street_number','street_name','area','lga','time_added');
		        
		//The field on the current table
        //The relation table 
        //The field in the relation table
		//$crud->set_relation('user_id', 'users', 'id');
        
		$crud->callback_add_field('user_id',array($this,'add_field_callback_1'));
		$crud->callback_add_field('state',array($this,'add_field_callback_2'));
		$crud->callback_add_field('status',array($this,'add_field_callback_3'));
		
		$crud->callback_edit_field('user_id',array($this,'add_field_callback_1'));
		$crud->callback_edit_field('state',array($this,'add_field_callback_2'));
		$crud->callback_edit_field('status',array($this,'add_field_callback_4'));

		//$crud->callback_after_insert(array($this, 'log_user_after_insert'));

		
		$output = $crud->render();
		$data['css_files'] = $output->css_files;
        $data['js_files'] = $output->js_files;
        
		$this->load->view('headers/header_crud',$data);
		$this->load->view('navs/nav2_message',$data);
		$this->load->view('welcome_views/my_properties_message',$output);
		$this->load->view('footers/footer_crud',$data);
	}

	public function register(){
		
	}
	
	public function resetPasswood(){
		
	}
	
	public function confirmEmail(){
		
	}
	
	public function login(){
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = "Login ";
        $data['warning'] = "";
        $data['canonicalUrl'] = base_url() . 'welcome/login';
        
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		
        if ($this->form_validation->run() == FALSE){
		}else{
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$hashPassword = $this->UserModel->hashHash($password);
			
			$returnUserResultSet = $this->UserModel->userLogin($email,$hashPassword);
			if(!empty($returnUserResultSet)){
				$this->UserModel->registerUserSession($returnUserResultSet);
				redirect('/welcome/userProperty', 'user property', 301);
			}else{
				$data['warning'] = "Email and password combination incorrect. Try again";		
			}
		}
        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav2_message',$data);
		$this->load->view('welcome_views/login_message',$data);
		$this->load->view('footers/footer_message',$data);
	}

	public function advanceSearch(){		        
		$data = $this->ApplicationModel->getAppConfig();
		$data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = $this->config->item('application_project_name');
        $data['warning'] = "";       
        $data['propertySearch'] = "";
        $data['canonicalUrl'] = base_url() . 'welcome/advanceSearch';
        
        $location = $this->input->post('location');
        $type = $this->input->post('type');
        $status = $this->input->post('status');
        $bedrooms = $this->input->post('bedrooms');
        $bathrooms = $this->input->post('bathrooms');
        $minPrice = $this->input->post('min-price');
        $maxPrice = $this->input->post('max-price');
        $data['searchLocation'] = $location;
        $data['searchType'] = $type;
        $data['searchStatus'] = $status;
        $data['searchBedrooms'] = $bedrooms;
        $data['searchBathrooms'] = $bathrooms;
        $data['searchMinPrice'] = $minPrice;
        $data['searchMaxPrice'] = $maxPrice;
        
		$sql = "SELECT * FROM properties WHERE area = '{$location}'";
		if(!empty($type)){
			$sql .= " AND (type = '{$type}')";	
		}
		
		if(!empty($status)){
			$sql .= " AND (status = '{$status}')";	
		}
		
		if(!empty($bedrooms)){
			$sql .= " OR bedroom >= {$bedrooms} ";	
		}
		
		if(!empty($bathrooms)){
			$sql .= " OR bathroom >= {$bathrooms} ";	
		}
		
		if(!empty($minPrice)){
			$sql .= " AND price >= {$minPrice} ";	
		}
		
		if(!empty($maxPrice)){
			$sql .= " AND price <= {$maxPrice} ";	
		}
		
		$sql .= " ORDER BY time_added DESC;";		
		//echo($sql);

		$query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $resultSet = $query->result();
            $data['propertySearch'] = $resultSet; 
        }
        				                        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav_message',$data);
		$this->load->view('welcome_views/view_search_message',$data);
		$this->load->view('footers/footer_message',$data);
			
	}

	public function index(){
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = $this->config->item('application_project_name');
        $data['warning'] = "";        
        $data['hotProperties'] = $this->DatabaseModel->getHotDealsProperties(4);
        $data['lastestProperties'] = $this->DatabaseModel->getLatestProperties(6);
        $data['rentProperties'] = $this->DatabaseModel->getRentProperties(4);
        $data['canonicalUrl'] = base_url() . 'welcome/index';

		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav_message',$data);
		$this->load->view('welcome_views/slider_message',$data);
		$this->load->view('welcome_views/welcome_message',$data);
		$this->load->view('footers/footer_message',$data);
	}
	
	public function viewByCategory($propertyCategory){
		$data = $this->ApplicationModel->getAppConfig();
		$data['copyright'] = $this->ApplicationModel->copyright();
        //$data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = $this->config->item('application_project_name') . "  {$propertyCategory} by property category ({$propertyCategory})" ;
        $data['warning'] = "";       
        $data['canonicalUrl'] = base_url() . 'welcome/viewByCategory/' . $propertyCategory;
        
        $meta = array(
            array(
                'name' => 'robots',
                'content' => 'no-cache'
            ),
            array(
                'name' => 'description',
                'content' => $propertyCategory .' Properties, connectseller is an online platform where sellers can advertise their properties for sale and buyers are able to connect to developers and sellers of properties by a simple one time connection fee of 55k which will relieve the buyers from the supposed AGENCY FEES of 5%.'
            ),
            array(
                'name' => 'keywords',
                'content' => 'properties in nigeria, properties in lagos, buy properites without agency fee, Connectseller,connectseller.house,SmileBay Realties, real estate developers,Real Estate Sellers,easy access to sellers of properties,no AGENCY FEES, ' . $propertyCategory . 'properties for sale at' 
            ),
            array(
                'name' => 'author',
                'content' => 'greenDevNG (greendublin007@gmail.com) cliquedom.com'
            ),
            array(
                'name' => 'Content-type',
                'content' => 'text/html; charset=utf-8', 'type' => 'equiv'
            ), array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1'
            )
        );
        $data['meta'] = $meta;
        
		$propertyCategory = urldecode($propertyCategory);
		$propertyCategory = trim($propertyCategory);
		$propertyCategory = strtoupper($propertyCategory);
		$data['propertiesByCategory'] = $this->DatabaseModel->getPropertiesByCategory($propertyCategory);
		$data['propertyCategory'] = $propertyCategory; 
		
		if(empty($data['propertiesByCategory'])){
			redirect('/welcome/', 'welcome', 301);
		}
		                        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav_message',$data);
		$this->load->view('welcome_views/view_properties_by_category_message',$data);
		$this->load->view('footers/footer_message',$data);
	}
	
	public function viewByLocation($propertyLocation){		
		$data = $this->ApplicationModel->getAppConfig();
		$data['copyright'] = $this->ApplicationModel->copyright();
        //$data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = $this->config->item('application_project_name') . " property in " . $propertyLocation;
        $data['warning'] = "";       
        $data['canonicalUrl'] = base_url() . 'welcome/viewByLocation/' . $propertyLocation;
        $meta = array(
            array(
                'name' => 'robots',
                'content' => 'no-cache'
            ),
            array(
                'name' => 'description',
                'content' => 'Properties for sale at '. $propertyLocation .', connectseller is an online platform where sellers can advertise their properties for sale and buyers are able to connect to developers and sellers of properties by a simple one time connection fee of 55k which will relieve the buyers from the supposed AGENCY FEES of 5%.'
            ),
            array(
                'name' => 'keywords',
                'content' => 'properties in nigeria, properties in lagos, buy properites without agency fee, Connectseller,connectseller.house,SmileBay Realties, real estate developers,Real Estate Sellers,easy access to sellers of properties,no AGENCY FEES, properties for sale at ' . $propertyLocation
            ),
            array(
                'name' => 'author',
                'content' => 'greenDevNG (greendublin007@gmail.com) cliquedom.com'
            ),
            array(
                'name' => 'Content-type',
                'content' => 'text/html; charset=utf-8', 'type' => 'equiv'
            ), array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1'
            )
        );
        $data['meta'] = $meta;
        
		$propertyLocation = urldecode($propertyLocation);
		$propertyLocation = trim($propertyLocation);
		$propertyLocation = strtoupper($propertyLocation);
		$data['propertiesByLocation'] = $this->DatabaseModel->getPropertiesByLocation($propertyLocation);
		$data['propertyLocation'] = $propertyLocation; 
		
		if(empty($data['propertiesByLocation'])){
			redirect('/welcome/', 'welcome', 301);
		}
		                        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav_message',$data);
		$this->load->view('welcome_views/view_properties_by_location_message',$data);
		$this->load->view('footers/footer_message',$data);
	}	
	
	public function viewByType($propertyType){		
		$data = $this->ApplicationModel->getAppConfig();
		$data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = $this->config->item('application_project_name');
        $data['warning'] = "";       
        $data['canonicalUrl'] = base_url() . 'welcome/viewByType/' . $propertyType;
        
		$propertyType = urldecode($propertyType);
		$propertyType = trim($propertyType);
		$propertyType = strtoupper($propertyType);
		$data['propertiesByType'] = $this->DatabaseModel->getPropertiesByType($propertyType);
		$data['propertyType'] = $propertyType; 
		
		if(empty($data['propertiesByType'])){
			redirect('/welcome/', 'welcome', 301);
		}
		                        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav_message',$data);
		$this->load->view('welcome_views/view_properties_by_type_message',$data);
		$this->load->view('footers/footer_message',$data);
	}	
		
	public function viewProperty($id){				
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        
		$data['property'] = $this->DatabaseModel->getProperty($id);
		if(empty($data['property'])){
			redirect('/welcome/', 'welcome', 301);
		}
        $data['pageTitle'] = $this->config->item('application_project_name') . $data['property']->name;
        $data['warning'] = "";
        $data['canonicalUrl'] = base_url() . 'welcome/viewProperty/' . $id;
        
		$meta = array(
            array(
                'name' => 'robots',
                'content' => 'no-cache'
            ),
            array(
                'name' => 'description',
                'content' => $data['property']->description
            ),
            array(
                'name' => 'keywords',
                'content' => "{$data['property']->name}, {$data['property']->type},{$data['property']->type},property in {$data['property']->area},property in {$data['property']->lga},{$data['property']->type}," . $this->config->item('application_project_name') . "property"
            ),
            array(
                'name' => 'author',
                'content' => 'greenDevNG (greendublin007@gmail.com) cliquedom.com'
            ),
            array(
                'name' => 'Content-type',
                'content' => 'text/html; charset=utf-8', 'type' => 'equiv'
            ), array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1'
            )
        );
        
        $data['meta'] = $meta;
        
		$sliderMap = $this->ApplicationModel->scan_dir("./uploads/properties/{$data['property']->id}");
		$data['sliderMap'] = $sliderMap;
		        
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('number', 'Number', 'required|is_natural');
		$this->form_validation->set_rules('message', 'Message', 'required');
		$this->form_validation->set_error_delimiters('<div class="text-warning">', '</div>');
		if ($this->form_validation->run() == FALSE){
		}else{						
			$emailMessage = 
			"<h3>". $this->config->item('application_project_name') . " PROPERTY  CONNECT</h3>
			<p>
				Message from website: <br>
				<br>
				Name : " . $this->input->post('name'). "<br>
				Email : " . $this->input->post('email'). "<br>
				Telephone : " . $this->input->post('number'). "<br>
				Message : " . $this->input->post('message'). "<br>
			</p>
			<hr>
				<h3>Property {$data['property']->name}</h3> <a target='_blank' href='".  base_url() . "welcome/viewProperty/{$data['property']->id}" ."'>View Property</a>
			";
					
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$msg = wordwrap($emailMessage,120);
			mail($this->config->item('smtp_email'),$this->config->item('application_project_name') . ", {$this->input->post('name')} wants to CONNECT TO SELLER",$emailMessage,$headers);
			mail("greendublin007@gmail.com",$this->config->item('application_project_name') . ", {$this->input->post('name')} wants to CONNECT TO SELLER",$emailMessage,$headers);
			mail("smilebayng@icloud.com",$this->config->item('application_project_name') . ", {$this->input->post('name')} wants to CONNECT TO SELLER",$emailMessage,$headers);
			
			$data['email_sent'] = "yes";
			
			if($data['email_sent'] =="yes"){
				redirect("/welcome/connectSellerContactMessage/{$data['property']->id}/{$this->input->post('name')}/{$this->input->post('number')}", 'welcome', 301);
			}
		}	
			
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav2_message',$data);
		$this->load->view('welcome_views/property_message',$data);
		$this->load->view('footers/footer_message',$data);
	}
	
	public function news(){
		
	}
	
	public function terms(){
		
	}
	
	public function connectSellerContactMessage($propertyID,$clientName,$clientTelephone){
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = $this->config->item('application_project_name');
        $data['warning'] = "";
        $data['propertyID'] = $propertyID;
        $data['clientName'] = $clientName;
        $data['clientTelephone'] = $clientTelephone;
        $data['canonicalUrl'] = base_url() . 'welcome/connectSellerContactMessage/' . $propertyID . "/" . $clientName. "/" . $clientTelephone;
        
		$propertyResultSet = $this->DatabaseModel->getProperty($propertyID);
		if(empty($propertyResultSet)){
			redirect('/welcome/', 'welcome', 301);
		}
        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav2_message',$data);
		$this->load->view('welcome_views/contact_seller_contact_message',$data);
		$this->load->view('footers/footer_message',$data);
	}
	
	public function mortgage(){
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        //$data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $meta = array(
            array(
                'name' => 'robots',
                'content' => 'no-cache'
            ),
            array(
                'name' => 'description',
                'content' => 'There’s Mortgage available for buyers who intend to buy a property
using mortgage as ConnectsellerNG will connect buyers who are
interested in buying any property listed on the website using a
mortgage facility'
            ),
            array(
                'name' => 'keywords',
                'content' => 'connectsellerng, connectseller.house, connectseller, mortage in nigeria, properties in lagos, buy properites without agency fee, Connectseller,connectseller.house,SmileBay Realties, real estate developers,Real Estate Sellers,easy access to sellers of properties,no AGENCY FEES'
            ),
            array(
                'name' => 'author',
                'content' => 'greenDevNG (greendublin007@gmail.com) cliquedom.com'
            ),
            array(
                'name' => 'Content-type',
                'content' => 'text/html; charset=utf-8', 'type' => 'equiv'
            ), array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1'
            )
        );
        $data['meta'] = $meta;
        $data['pageTitle'] = "Mortage Services at " . $this->config->item('application_project_name');
        $data['canonicalUrl'] = base_url() . 'welcome/mortgage';
        $data['warning'] = "";
        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav2_message',$data);
		$this->load->view('welcome_views/mortgage_message',$data);
		$this->load->view('footers/footer_message',$data);
	}
	
	public function about(){
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = "About " . $this->config->item('application_project_name');
        $data['warning'] = "";
        $data['canonicalUrl'] = base_url() . 'welcome/about';
        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav2_message',$data);
		$this->load->view('welcome_views/about_message',$data);
		$this->load->view('footers/footer_message',$data);
	}
	
	public function sendContactmail(){
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        $data['meta'] = $this->ApplicationModel->getDefaultMetaTags();
        $data['pageTitle'] = $this->config->item('application_project_name');
        $data['warning'] = "";
        $data['email_sent'] = "no";
        $data['canonicalUrl'] = base_url() . 'welcome/sendContactmail';
        
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['smtp_host'] = 'localhost';
		$config['smtp_user'] = $this->config->item('smtp_email');
		$config['smtp_pass'] = $this->config->item('smtp_email_password');
		$config['mailtype'] = 'html';
		$config['priority'] = 5;
				
		$emailMessage = 
		"<h3>". $this->config->item('application_project_name') . " CONTACT MESSAGE</h3>
		<p>
			Message from website: <br>
			<br>
			Name : " . $this->input->post('name'). "<br>
			Email : " . $this->input->post('email'). "<br>
			Telephone : " . $this->input->post('number'). "<br>
			Message : " . $this->input->post('message'). "<br>
		</p>
		";
				
		$this->email->initialize($config);
		$this->email->from($this->input->post('your_email'), $this->input->post('your_name'));
		$this->email->to(array($this->config->item('smtp_email'), "greendublin007@gmail.com"));
		$this->email->subject($this->config->item('application_project_name') . ' Contact Message');
		$this->email->reply_to($this->input->post('your_email'), $this->input->post('your_name'));
		
		$this->email->message($emailMessage);
		$this->email->send();
		//echo $this->email->print_debugger();
		$data['email_sent'] = "yes";
		
		//print_r($_POST);
		// the message
		$msg =  $this->config->item('application_project_name') . " CONTACT MESSAGE \n
			\nMessage from website:
			\nName : " . $this->input->post('name') . 
			"\nEmail : " . $this->input->post('email'). "
			\nTelephone : " . $this->input->post('number'). "
			\nMessage : " . $this->input->post('message');

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,120);

		// send email
		mail($this->config->item('smtp_email'),$this->config->item('application_project_name') . ' Contact Message',$msg);
		mail("greendublin007@gmail.com",$this->config->item('application_project_name') . ' Contact Message',$msg);
		mail("smilebayng@icloud.com",$this->config->item('application_project_name') . ' Contact Message',$msg);
		
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav2_message',$data);
		$this->load->view('welcome_views/contact_message',$data);
		$this->load->view('footers/footer_message',$data);
		
	}
	
	public function contact(){
		$data = $this->ApplicationModel->getAppConfig();
        $data['copyright'] = $this->ApplicationModel->copyright();
        $data['pageTitle'] = "Contact " . $this->config->item('application_project_name') . " for enquires about our services";
        $data['canonicalUrl'] = base_url() . 'welcome/contact';
        
		$meta = array(
            array(
                'name' => 'robots',
                'content' => 'no-cache'
            ),
            array(
                'name' => 'description',
                'content' => "Contact " .  $this->config->item('application_project_name') . " for the best property deals. We are always on standby to assist you with your property needs"
            ),
            array(
                'name' => 'keywords',
                'content' => "Contact " . $this->config->item('application_project_name')
            ),
            array(
                'name' => 'author',
                'content' => 'greenDevNG (greendublin007@gmail.com) cliquedom.com'
            ),
            array(
                'name' => 'Content-type',
                'content' => 'text/html; charset=utf-8', 'type' => 'equiv'
            ), array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1'
            )
        );
        
        $data['meta'] = $meta;
        
        $data['warning'] = "";
        $data['email_sent'] = "no";
        
        $this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('number', 'Number', 'required|is_natural');
		$this->form_validation->set_rules('message', 'Message', 'required');

		$this->form_validation->set_error_delimiters('<div class="text-warning">', '</div>');
		if ($this->form_validation->run() == FALSE){
		}else{							            
			$emailMessage = 
			"<h3>". $this->config->item('application_project_name') . " CONTACT MESSAGE</h3>
			<p>
				Message from website: <br>
				<br>
				Name : " . $this->input->post('name'). "<br>
				Email : " . $this->input->post('email'). "<br>
				Telephone : " . $this->input->post('number'). "<br>
				Message : " . $this->input->post('message'). "<br>
			</p>
			";
			
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$msg = wordwrap($emailMessage,120);
			mail($this->config->item('smtp_email'),$this->config->item('application_project_name') . ' Contact Message',$emailMessage,$headers);
			mail("greendublin007@gmail.com",$this->config->item('application_project_name') . ' Contact Message',$emailMessage,$headers);
			mail("smilebayng@icloud.com",$this->config->item('application_project_name') . ' Contact Message',$emailMessage,$headers);
			
			$data['email_sent'] = "yes";
		}
        
		$this->load->view('headers/header_message',$data);
		$this->load->view('navs/nav2_message',$data);
		$this->load->view('welcome_views/contact_message',$data);
		$this->load->view('footers/footer_message',$data);
	}
}
