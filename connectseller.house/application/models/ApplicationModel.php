<?php

class ApplicationModel extends CI_Model {

	var $connectSellerID = 1;

	
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('email');
    }

	public function scan_dir($dir) {
		$ignored = array('.', '..', '.svn', '.htaccess');

		$files = array();    
		foreach (scandir($dir) as $file) {
			if (in_array($file, $ignored)) continue;
			$files[$file] = filemtime($dir . '/' . $file);
		}

		arsort($files);
		$files = array_keys($files);
		$files = array_reverse($files);  // reverse order (first upload, first picture)
		
		return ($files) ? $files : false;
	}

    public function getDefaultMetaTags() {
        $meta = array(
            array(
                'name' => 'robots',
                'content' => 'no-cache'
            ),
            array(
                'name' => 'description',
                'content' => 'To create an online platform where sellers can advertise their properties for sale and buyers are able to connect to developers and sellers of properties by a simple one time connection fee of 55k which will relieve the buyers from the supposed AGENCY FEES of 5%.'
            ),
            array(
                'name' => 'keywords',
                'content' => 'properties in nigeria, properties in lagos, buy properites without agency fee, Connectseller,connectseller.house,SmileBay Realties, real estate developers,Real Estate Sellers,easy access to sellers of properties,no AGENCY FEES'
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

        return $meta;
    }

    public function getAppConfig() {
        $data = array();
        $data['assetsFolder'] = base_url() . $this->config->item('public_application_assets_folder');
        $data['dashboardAssetsFolder'] = base_url() . $this->config->item('public_application_office_assets_folder');

        $data['pageTitle'] = $this->config->item('application_project_name');
        $data['appName'] = $this->config->item('application_project_name');
        $data['address'] = $this->config->item('application_project_address');
        $data['telephone'] = $this->config->item('application_project_telephone');
        $data['email'] = $this->config->item('application_project_email');
		$data['connectSellerInfo'] = $this->DatabaseModel->getSellerInfo($this->connectSellerID);
				
		$data['searchAreaResultSet'] = $this->DatabaseModel->getAreaSearch();
		$data['searchTypeResultSet'] = $this->DatabaseModel->getPropertyTypeSearch();
		$data['searchCategoryResultSet'] = $this->DatabaseModel->getPropertyCategorySearch();
		$data['searchBedRoomResultSet'] = $this->DatabaseModel->getPropertyBedRoomSearch();
		$data['searchBathRoomResultSet'] = $this->DatabaseModel->getPropertyBathRoomSearch();
		$data['searchPriceResultSet'] = $this->DatabaseModel->getPropertyPriceSearch();
		$data['searchAreaSqResultSet'] = $this->DatabaseModel->getPropertyAreaSqSearch();
		
        return $data;
    }

    public function copyright() {
        $copyright = "&copy; " . $this->config->item('application_project_name') . " ";
        $startYear = $this->config->item('application_start_year');
        $currentYear = Date('Y');
        if ($startYear == Date('Y')) {
            $copyright .= " $startYear" . ". <br>All Rights Reserved";
        } else {
            $copyright .= "$startYear " . "-" . " $currentYear" . ".<br> All Rights Reserved";
        }
        return $copyright;
    }

    public function hashHash($password) {
        return hash('sha512', $password);
    }

    public function randNumber($min = 10, $max = 1000000) {
        return rand($min, $max);
    }

    public function roundNumber($val, $precisioin) {
        return round($val, $precision);
    }

    public function maxVal($array) {
        return max($values);
    }

    public function minVal($array) {
        return min($values);
    }

    public function tokenGenerator() {
        return md5(rand(11, 1000000000));
    }

    public function arrayJoiner($glue, $pieces) {
        return implode($glue, $pieces);
    }

    public function arraySeperator($delimiter, $string) {
        return explode($delimiter, $string);
    }

}
