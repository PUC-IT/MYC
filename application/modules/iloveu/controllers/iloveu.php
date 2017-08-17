<?php
class Iloveu extends MX_Controller 
{

function __construct()
{
parent::__construct();
}



function index()
{
    $data['username'] = $this->input->post('username', TRUE);
    $this->load->module('templates');
    $this->templates->login($data);
}

function submit_login()
{
$submit = $this->input->post('submit', TRUE);
    if ($submit=="Submit")
    {        
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[60]|callback_username_check');
        $this->form_validation->set_rules('pword', 'Password', 'required|min_length[4]|max_length[35]');
        if ($this->form_validation->run() == TRUE)
        {
            //figure out the user_id
            $this->_in_you_here();
        } else {
            echo validation_errors();

        }
    }

}

function logout()
{
    unset($_SESSION['is_admin']);
    $this->load->module('site_cookies');
    $this->site_cookies->_destroy_cookie();
    redirect(base_url());
}

function _in_you_here()
{
    $this->session->set_userdata('is_admin', '1');
    //Sending user $user_id to the Welcome area
    redirect('dashboard/home');
}

function username_check($str)
{
    $this->load->module('site_security');
    $error_msg = "You did not enter the correct username or/and password";
	$pword = $this->input->post('pword', TRUE);

	$result = $this->site_security->_check_admin_login_details($str, $pword);
    if($result==FALSE) {
        $this->form_validation->set_message('username_check', $error_msg);
        return FALSE;
    } else {
    	return TRUE;
    }
}



}