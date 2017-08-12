<?php
class Youraccount extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function create()
{
    $data['flash'] = $this->session->flashdata('item');    
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}

function login()
{
    $data['flash'] = $this->session->flashdata('item');    
    $data['view_file'] = "login";
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}

}