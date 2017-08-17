<?php
class Cart extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function index()
{
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "cart";
    $session_id = $this->session->session_id;
    $this->load->module('site_security');
    $shopper_id = $this->site_security->_get_user_id();
    if (!is_numeric($shopper_id)) {
        $shopper_id = 0;
    }
    $table = 'store_basket';
    $data['query'] = $this->_fetch_cart_content($session_id, $shopper_id, $table);
    //count the number of items in cart
    $data['num_rows'] = $data['query']->num_rows();
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}

function _get_showing_statement($num_rows)
{
    if ($num_rows==1) {
        $showing_statement = "You have one item in your shopping cart.";
    } else {
        $showing_statement = "You have ".$num_rows." items in your shopping cart.";
    }
}

function _fetch_cart_content($session_id, $shopper_id, $table)
{
    $this->load->module('store_basket');
    if ($shopper_id>0) {
        $mysql_query = "select * from $table where shopper_id=$shopper_id";
    } else {
        $mysql_query = "select * from $table where session_id=$session_id";
    }
    $query = $this->store_basket->_custom_query($mysql_query);
    return $query;

}

function _draw_add_to_cart($item_id)
{
    //fetch color option for item
    $submitted_color = $this->input->post('submitted_color', TRUE);
    if ($submitted_color=="") {
        $color_options[''] = "Select...";
    }

    $this->load->module('store_item_colors');
    $query = $this->store_item_colors->get_where_custom('item_id', $item_id);
    $data['num_colors'] = $query->num_rows();
    foreach ($query->result() as $row) {
        $color_options[$row->id] = $row->color;
    }


    //fetch Size option for item
    $submitted_size = $this->input->post('submitted_size', TRUE);
    if ($submitted_size=="") {
        $size_options[''] = "Select...";
    }

    $this->load->module('store_item_sizes');
    $query = $this->store_item_sizes->get_where_custom('item_id', $item_id);
    $data['num_sizes'] = $query->num_rows();
    foreach ($query->result() as $row) {
        $size_options[$row->id] = $row->size;
    }

    $data['submitted_color'] = $submitted_color;
    $data['submitted_size'] = $submitted_size;
    $data['color_options'] = $color_options;
    $data['size_options'] = $size_options;
    $data['item_id'] = $item_id;
    $this->load->view('add_to_cart', $data);
}

}