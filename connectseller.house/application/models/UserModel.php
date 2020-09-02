<?php

class UserModel extends CI_Model {
	
    private function __authUser() {
        $i = false;

        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in) {
            $i = true;
        }

        return $i;
    }

    public function checkUserAuth() {
        $logged_in = $this->__authUser();
        if (!$logged_in) {
            redirect('/welcome/', 'To Homepage ', 307);
        }
    }

	public function registerUserSession($userResultSet){
		$userData = array(
				'id'  => $userResultSet->id,
			   'email'  => $userResultSet->email,
			   'password'     => $userResultSet->password,
			   'telephone' => $userResultSet->telephone,
			   'confirmed_email' => $userResultSet->confirmed_email,
			   'confirmed_telephone' => $userResultSet->confirmed_telephone,
			   'time_added' => $userResultSet->time_added,
			   'logged_in' => TRUE
		   );
		$i = $this->session->set_userdata($userData);
		
	}
	
	public function hashHash($password) {
        return hash('sha512', $password);
    }
	
	public function userLogin($email,$hashPassword){
		$resultSet = "";

        $query = $this->db->get_where('users', array('email' => $email,'password' => $hashPassword));
        if ($query->num_rows() > 0) {
            $resultSet = $query->row();
        }

        return $resultSet;		
	}

}
