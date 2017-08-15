<?php
class Youraccount extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function test1()
{
    $your_name = "CHOU";
    $this->session->set_userdata('your_name', $your_name);
    echo "The session variable was set.";

    echo "<hr>";
    echo anchor('youraccount/test2', 'Get session')."<br>";
    echo anchor('youraccount/test3', 'Delete session')."<br>";
}
function test2()
{
    $your_name = $this->session->userdata('your_name');
    if ($your_name!="") {
        echo "<h1>Hello $your_name</h1>";
    } else {
        echo "No session variable has been set yet";
    }
    echo "<hr>";
    echo anchor('youraccount/test1', 'Set session')."<br>";
    echo anchor('youraccount/test3', 'Delete session')."<br>";
}
function test3()
{
    $this->session->unset_userdata('your_name');
    //unset($_SESSION['your_name']);
    echo "UNSET";

    echo "<hr>";
    echo anchor('youraccount/test1', 'Set session')."<br>";
    echo anchor('youraccount/test2', 'Get session')."<br>";
}

function logout()
{
    unset($_SESSION['user_id']);
    $this->load->module('site_cookies');
    $this->site_cookies->_destroy_cookie();
    redirect(base_url());
}

function welcome()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_logged_in();

    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "welcome";
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}

function login(){
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
            $col1 = 'username';
            $value1 = $this->input->post('username', TRUE);
            $col2 = 'email';
            $value2 = $this->input->post('email', TRUE);
            $query = $this->store_accounts->get_with_double_condition($col1, $value1, $col2, $value2);
            foreach ($query->result() as $row) {
                $user_id = $row->id;
            }

            $remember = $this->input->post('remember', TRUE);
            if ($remember=="remember-me") {
                $login_type = "longterm";
            } else {
                $login_type = "shortterm";
            }
            //send them to somewhere.
            $this->_in_you_here($user_id, $login_type);
        } else {
            echo validation_errors();

        }
    }

}

function _in_you_here($user_id, $login_type)
{
    if ($login_type=="longterm") {
        $this->load->module('site_cookies');
        $this->site_cookies->_set_cookie($user_id);
    } else {
        $this->session->set_userdata('user_id', $user_id);
    }
    //Sending user $user_id to the Welcome area
    redirect('youraccount/welcome');
}

function submit()
{
$submit = $this->input->post('submit', TRUE);
    if ($submit=="Submit")
    {        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[store_accounts.username]');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|max_length[120]');
        $this->form_validation->set_rules('pword', 'Password', 'required|min_length[4]|max_length[35]');
        $this->form_validation->set_rules('repeat_pword', 'Repeat Password', 'required|matches[pword]');

        if ($this->form_validation->run() == TRUE)
        {
        	$this->_process_create_account();
        	echo "<h1>Account has been Created!</h1>";
        	echo "<p>Please login!</p>";
        	die();
            
        } else {
        	$this->start();
        }
    }

}

function _process_create_account()
{
	$this->load->module('store_accounts');
	$data = $this->fetch_data_from_post();
	unset($data['repeat_pword']);

	$pword = $this->input->post('pword', TRUE);
    $this->load->module('site_security');
    $data['pword'] = $this->site_security->_hash_string($pword); //strong password
    $this->store_accounts->_insert($data);


}

function start()
{
	$data = $this->fetch_data_from_post();
    $data['flash'] = $this->session->flashdata('item');    
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}

function fetch_data_from_post()
{
	$data['username'] = $this->input->post('username', TRUE);
	$data['email'] = $this->input->post('email', TRUE);
	$data['pword'] = $this->input->post('pword', TRUE);
	$data['repeat_pword'] = $this->input->post('repeat_pword', TRUE);
	return $data;
}


function username_check($str)
{
    $this->load->module('store_accounts');
    $this->load->module('site_security');

    $error_msg = "You did not enter the correct username or/and password";

    $col1 = 'username';
    $value1 = $str;
    $col2 = 'email';
    $value2 = $str;
    $query = $this->store_accounts->get_with_double_condition($col1, $value1, $col2, $value2);
    $num_rows = $query->num_rows();

    if($num_rows<1) {
        $this->form_validation->set_message('username_check', $error_msg);
        return FALSE;
    }

    foreach ($query->result() as $row) {
        $pword_on_table = $row->pword;
    }
    $pword = $this->input->post('pword', TRUE);
    $result = $this->site_security->_verify_hash($pword, $pword_on_table);

    if ($result==TRUE) {
        return TRUE;
    } else {
        $this->form_validation->set_message('username_check', $error_msg);
        return FALSE;
    }
}
}