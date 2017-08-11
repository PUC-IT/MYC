<?php
class Default_module extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function index(){
	$first_bit = trim($this->uri->segment(1));
	$this->load->module('webpages');
	$query = $this->webpages->get_where_custom('page_url', $first_bit);
	$num_rows = $query->num_rows();
	if ($num_rows>0) {
		$data['view_module']
		$this->load->module('templates');
		$this->templates->public_bootstrap($data);
	}
}

}