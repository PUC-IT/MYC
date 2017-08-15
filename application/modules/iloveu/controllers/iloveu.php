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
    $this->templates->login($data);
}




}