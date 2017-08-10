<?php
class Shipping extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function get($order_by)
{
    $this->load->model('mdl_shipping');
    $query = $this->mdl_shipping->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_shipping');
    $query = $this->mdl_shipping->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) 
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_shipping');
    $query = $this->mdl_shipping->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_shipping');
    $query = $this->mdl_shipping->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_shipping');
    $this->mdl_shipping->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_shipping');
    $this->mdl_shipping->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_shipping');
    $this->mdl_shipping->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_shipping');
    $count = $this->mdl_shipping->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_shipping');
    $max_id = $this->mdl_shipping->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_shipping');
    $query = $this->mdl_shipping->_custom_query($mysql_query);
    return $query;
}

}