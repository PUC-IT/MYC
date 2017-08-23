<?php
class Store_basket extends MX_Controller 
{

function __construct()
{
parent::__construct();

}

function remove()
{
    $update_id = $this->uri->segment(3);
    $allowed = $this->_make_sure_remove_allowed($update_id);
    if ($allowed==FALSE) {
        redirect('cart');
    }
    
    $update_id = $this->uri->segment(3);
    $this->_delete($update_id);
    redirect('cart');
}

function _make_sure_remove_allowed($update_id)
{
    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) {
        $session_id = $row->session_id;
        $shopper_id = $row->shopper_id;
    }

    if (!isset($shopper_id)) {
        return FALSE;
    }

    $customer_session_id = $this->session->session_id;
    $this->load->module('site_security');
    $customer_shopper_id = $this->site_security->_get_user_id();

    if (($session_id==$customer_session_id) OR ($shopper_id==$customer_shopper_id)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function add_to_basket()
{
    $submit = $this->input->post('submit', TRUE);
    if ($submit=="Submit")
    {
        //process the form

        $this->load->library('form_validation');
        //$this->form_validation->set_rules('item_color', 'Item Color', 'numeric');
        //$this->form_validation->set_rules('item_size', 'Size', 'numeric');
        $this->form_validation->set_rules('item_qty', 'Quantity', 'numeric');
        $this->form_validation->set_rules('item_id', 'Item ID', 'required|numeric');

        if ($this->form_validation->run() == TRUE)
        {
            $data = $this->_fetch_the_data();
            $this->_insert($data);
            redirect('cart');
        } else {
            $refer_url = $_SERVER['HTTP_REFERER'];
            $error_msg = validation_errors("<p style='color:red;'>", "</p>");
            $this->session->set_flashdata('item', $error_msg);
            redirect($refer_url);
        }
    }
}

function _fetch_the_data()
{
    $this->load->module('site_security');
    $this->load->module('store_items');

    $item_id = $this->input->post('item_id', TRUE);
    $item_data = $this->store_items->fetch_data_from_db($item_id);
    $item_price = $item_data['item_price'];
    $item_qty = $this->input->post('item_qty', TRUE);
    //$item_size = $this->input->post('item_size', TRUE);
    //$item_color = $this->input->post('item_color', TRUE);
    $shopper_id = $this->site_security->_get_user_id();

    if (!is_numeric($shopper_id)) {
        $shopper_id = 0;
    }

    $data['session_id'] = $this->session->session_id;
    $data['item_title'] = $item_data['item_title'];
    $data['price'] = $item_price;
    $data['tax'] = '0';
    $data['item_id'] = $item_id;
    //$data['item_size'] = $this->_get_value('size', $item_size);
    $data['item_qty'] = 1 + $item_qty;
    //$data['item_color'] = $this->_get_value('color', $item_color);
    $data['date_added'] = time();
    $data['shopper_id'] = $shopper_id;
    $data['ip_address'] = $this->input->ip_address();
    return $data;
}

// function _get_value($value_type, $update_id)
// {
//     if($value_type=='size'){
//         $this->load->module('store_item_sizes');
//         $query = $this->store_item_sizes->get_where($update_id);
//         foreach ($query->result() as $row) {
//             $item_size = $row->size;
//         }
//         if (!isset($item_size)) {
//             $item_size = '';
//         }
//         $value = $item_size;
//     } else {
//         $this->load->module('store_item_colors');
//         $query = $this->store_item_colors->get_where($update_id);
//         foreach ($query->result() as $row) {
//             $item_color = $row->color;
//         }
//         if (!isset($item_color)) {
//             $item_color = '';
//         }
//         $value = $item_color;
//     }
//     return $value;
// }

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