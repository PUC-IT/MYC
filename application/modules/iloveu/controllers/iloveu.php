<?php
class Iloveu extends MX_Controller 
{

function __construct()
{
parent::__construct();
// $this->load->library->('form_validation');
// $this->form_validation->CI =& $this;
}



function index()
{
    $data['username'] = $this->input->post('username', TRUE);
    $this->load->module('templates');
    $this->templates->login_page($data);
}

function submit_login()
{
    $submit = $this->input->post('submit', TRUE);

    if ($submit=="Submit") {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[60]|callback_username_check');
        $this->form_validation->set_rules('pword', 'Password', 'required|min_length[5]|max_length[35]'  );

        if ($this->form_validation->run() == TRUE) {
            // $col1 = 'username';
            // $value1 = $this->input->post('username', TRUE);
            // $col2 = 'email';
            // $value1 = $this->input->post('username', TRUE);
            // $query = $this->store_accounts->get_with_double_condition($col1, $value1, $col2, $value2);
            // foreach ($query->result() as $row) {
            //     $user_id = $row->id;
            // }
            // $remember = $this->input->post('remember', TRUE);
            // if ($remember=="remember_me") {
            //     $login_type = "longterm";
            echo "weeeeee";
            } else{
                $login_type = "shortterm";
            }
            $this->_in_you_go($user_id, $login_type);
        } else {
            echo validation_errors();
        }
    }

}

function username_check($str)
{
    //
    $this->load->module('site_security');
    $error_msg = "You did not enter a correct username and/or password";
    $pword = $this->input->post('pword', TRUE);

    $result = $this->site_security->_check_admin_login_details($str, $pword)
    {

    // $col1 = 'username';
    // $value1 = $str;
    // $col2 = 'email';
    // $value1 = $str;
    // $query = $this->store_accounts->get_with_double_condition($col1, $value1, $col2, $value2);
    // $num_rows = $query->num_rows();

    if ($result==FALSE) {
        $this->form_validation->set_message('username_check', $error_msg);
        return FALSE;
    }

//Skip
    // foreach ($query->result() as $row) {
    //     $pword_on_table = $row->pword;
    // }
    // $pword = $this->input->post('pword', TRUE);
    // $result = $this->site_security->_verify_hash($pword, $pword_on_table);

    // if ($result=TRUE) {
    //     return TRUE
    // } else{
    //     $this->form_validation->set_message('username_check', $error_msg);
    //     return FALSE;
    // }
    } else {
        return TRUE;
    }
}


}