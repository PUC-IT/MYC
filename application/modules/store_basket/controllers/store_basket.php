<?php
class Store_basket extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function test()
{
    $session_id = $this->session->session_id;
    echo $session_id;
    echo "<hr>";
    $this->load->module('site_security');
    $shopper_id = $this->site_security->_get_user_id();
    echo "Your are the shopper id:".$shopper_id;
}

function get($order_by)
{
    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) 
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_basket');
    $this->mdl_store_basket->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_basket');
    $this->mdl_store_basket->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_basket');
    $this->mdl_store_basket->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_basket');
    $count = $this->mdl_store_basket->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_basket');
    $max_id = $this->mdl_store_basket->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_basket');
    $query = $this->mdl_store_basket->_custom_query($mysql_query);
    return $query;
}

}