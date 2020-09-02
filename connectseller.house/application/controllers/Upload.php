<?php

class Upload extends CI_Controller {

	private function resizeSlider($path,$image){
		$config['image_library'] = 'gd2';
		$config['source_image'] = "{$path}{$image}";
		//$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 2000;
		$config['height']       = 1000;

		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	
	private function resizeProperties($path,$image){
		$config['image_library'] = 'gd2';
		$config['source_image'] = "{$path}{$image}";
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 850;
		$config['height']       = 570;
		
		
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	
	private function watermarkImage($path,$image){
        $config['image_library'] = 'gd2';
		$config['source_image'] = "{$path}{$image}";
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = './uploads/logo.png';
        //the overlay image
        $config['wm_opacity'] = 100;
        $config['wm_vrt_alignment'] = 'bottom';
        $config['wm_hor_alignment'] = 'right';
        
        $this->image_lib->initialize($config);
        if (!$this->image_lib->watermark()) {
            echo $this->image_lib->display_errors() . " water mark<br>";
        } else {
            echo 'Successfully updated image with watermark<br>';
        }
    }

	public function __construct(){
		parent::__construct();
		$this->load->library('cart');
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->helper('directory');
		$this->load->library('image_lib');

		$this->load->model('ApplicationModel');
        $this->load->model('DatabaseModel');
        $this->load->model('EmailModel');
	}

	public function index(){
		$this->load->view('upload_views/upload_form', array('error' => ' ' ));
	}
	
	public function uploadProperties(){
		$this->load->view('upload_views/upload_form_properties', array('error' => ' ' ));
	}

	public function do_upload(){		
		$uploadPath = $this->input->post('picture_type');
		$fuploadPath =$uploadPath;
		$uploadWaterMark = "";
		$i ;
		switch($uploadPath){
			case 'properties':
				$filesCount = count($_FILES['userfile']['name']);
			
				$property_id = $this->input->post('property_id');
				if(isset($property_id)){
					if(!file_exists("./uploads/properties/{$property_id}")){
						$i = mkdir("./uploads/properties/{$property_id}", 0777);	
					}	
				}
				
				$uploadPath = "./uploads/properties/{$property_id}";
				$uploadWaterMark = "./uploads/properties/{$property_id}/";
				
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']	= 1500000;
				$config['max_width']  = 30024;
				$config['max_height']  = 10768;
				$config['overwrite']  = FALSE;
				$config['max_filename']  = 0;
				$config['encrypt_name']  = TRUE;
				$config['remove_spaces']  = TRUE;
				$config['file_name'] = 'image';
				
				break;
			case 'sliders':
				$uploadPath = './uploads/sliders/';
				$uploadWaterMark = "./uploads/sliders/";
				
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']	= 1500000;
				$config['max_width']  = 30024;
				$config['max_height']  = 10768;
				$config['overwrite']  = FALSE;
				$config['max_filename']  = 0;
				$config['encrypt_name']  = TRUE;
				$config['remove_spaces']  = TRUE;
				$config['file_name'] = 'image';
				
				break;
			default:
				break;
		}
				
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		$error;
		$data;
		$filesCount = count($_FILES['userfile']['name']) ; // -2 because of the array count
		//echo($filesCount);
		
		for($i = 0 ;$i < $filesCount; $i++){		
			//print_r($_FILES['userfile']);
			//echo("Main<br><br><hr>");
			
			$_FILES['image']['name']= $_FILES['userfile']['name'][$i];
			$_FILES['image']['type']= $_FILES['userfile']['type'][$i];
			$_FILES['image']['tmp_name']= $_FILES['userfile']['tmp_name'][$i];
			$_FILES['image']['error']= $_FILES['userfile']['error'][$i];
			$_FILES['image']['size']= $_FILES['userfile']['size'][$i];
        
		
			//print_r($_FILES['userfile']['name'][$i]);
			//echo("<br><br>");
			//print_r($_FILES['image']);
			
			if ( ! $this->upload->do_upload('image') ){
				$error = array('error' => $this->upload->display_errors());
			}else{
				$data = array('upload_data' => $this->upload->data());			
							
				//$this->watermarkImage($uploadWaterMark,$data['upload_data']['file_name']);
				
				if($fuploadPath == "properties"){
					$this->resizeProperties($uploadWaterMark,$data['upload_data']['file_name']);
				}
				
				if($fuploadPath == "sliders"){
					$this->resizeSlider($uploadWaterMark,$data['upload_data']['file_name']);
				}
				
			}
			
		}
				
		if(!empty($error)){
			$this->load->view('upload_views/upload_form', $error);
		}else{
			$this->load->view('upload_views/upload_success', $data);
		}
		
	}
	
	public function viewPictures(){
		$this->load->view('upload_views/upload_pictures_message');
	}
	
	public function viewSliderPictures(){
		$data = array();		
		$sliderMap = $this->ApplicationModel->scan_dir('./uploads/sliders/');
		$data['sliderMap'] = $sliderMap;
		$this->load->view('upload_views/uploaded_slider_message',$data);
	}
		
	function dir_map_sort($array){
	    $items = array();
	
	    foreach ($array as $key => $val)
	    {
	        if (is_array($val)) // if is dir
	        {
	            // run dir array through function to sort subdirs and files
	            // unless it's empty
	            $items[$key] = (!empty($array)) ? dir_map_sort($val) : $val; 
	        }
	        else
	        {
	            $items[$val] = $val;
	        }
	    }
	
	    ksort($items); // sort by key
	
	    return $items;
	}
	
	public function viewPropertiesPictures(){
		$data = array();		
		//$productMap = $this->dir_map_sort(directory_map('./uploads/properties/'));
		$productMap = $this->ApplicationModel->scan_dir('./uploads/properties/');
		$allProperties = $this->DatabaseModel->getAllProperties();
		
		$data['properties'] = $allProperties;
		$data['productMap'] = $productMap;
		
		$this->load->view('upload_views/uploaded_properties_message',$data);
	}
		
	public function deletePicture($picture,$path){
		$data = array();		
		
		$data['deletedPicture'] = $picture;
		$data['deletedPicturePath'] = $path;
		
		switch($path){
			case 'sliders':
				unlink('./uploads/sliders/'. $picture);
				break;
			case 'properties':
				unlink('./uploads/properties/'. $picture);
				break;
			default;
				break;
		}
		
		$this->load->view('upload_views/delete_picture_message',$data);
	}
	
	public function deleteFolder($folder){
		$data = array();		
		
		$data['deletedPicture'] = './uploads/properties/' . $folder;
		
		unlink('./uploads/properties/'. $folder);	
		
		echo('./uploads/properties/'. $folder);	
		exit();
		
		$this->load->view('upload_views/delete_picture_message',$data);
	}
	
	public static function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			throw new InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}

}
?>
