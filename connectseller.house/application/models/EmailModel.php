<?php

class EmailModel extends CI_Model {

    private $emailSending = FALSE;// default value
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('email');
        $this->load->model('ApplicationModel');
        $this->load->model('DatabaseModel');
        
        $this->emailSending = $this->config->item('send_email');
    }

    /**
     * get the email host
     * @param type $email
     * @return type
     */
    public function getEmailHostLink($email) {
        $emailLink = strstr($email, '@');
        $emailLink = substr($emailLink, 1, strlen($emailLink));

        return $emailLink;
    }

    /**
     * Used to send password recovery email
     * @param type $email
     * @param type $username
     * @param type $hashUsername
     */
    public function sendRecoverPasswordEmail($email, $username, $hashUsername) {
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['smtp_host'] = $this->config->item('smtp_host');
        $config['smtp_user'] = $this->config->item('smtp_email');
        $config['smtp_pass'] = $this->config->item('smtp_email_password');
        $config['smtp_port'] = $this->config->item('smtp_port');
        $config['mailtype'] = "html";
        $this->email->initialize($config);

        $this->email->from($this->config->item('smtp_host'), $this->config->item('application_project_domain'));
        $this->email->to($email);
        $this->email->subject(ucwords($this->config->item('application_project_domain')) . "Password Reset");
        $message = "<div style='border: 1px solid #eee;padding: 3%;'>"
                . "<img style='margin-left: 35%;' "
                . "src='" . base_url() . "plugins/images/logo.png'"
                . " alt='" . $this->config->item('application_project_domain') . "'>"
                . "<h1>Password Reset</h1>"
                . "<p>We noticed you having problems with your password. Reset your password by clicking the link below</p>"
                . "<a href='" . base_url() . "welcome/processPasswordReset/{$username}/$hashUsername" . "'>Reset Password Now</a>"
                . "</div>";
        $this->email->message($message);
        
        if($this->emailSending){
            $this->email->send();
        }else{
            print_r($this->email->message($message));    
            exit();
        }        
    }

}
