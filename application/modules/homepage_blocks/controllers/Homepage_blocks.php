<?php
class Homepage_blocks extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function _draw_sortable_list(){
    $mysql_query = "select * from homepage_blocks order by priority";
    $data['query'] = $this->_custom_query($mysql_query);
    $this->load->view('sortable_list', $data);
}
function _draw_blocks()
{
    $data['query'] = $this->get('priority');
    $num_rows = $data['query']->num_rows();
    if ($num_rows>0) {
        $this->load->view('view', $data);
    }
}

function view($update_id)
{
    if (!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $this->load->module('site_setting');

    //fetch category detail
    $data = $this->fetch_data_from_db($update_id);

    //fetch item blong to category
    $mysql_query = "
    SELECT
store_items.item_title,
store_items.item_url,
store_items.item_price,
store_items.big_pic,
store_items.small_pic
FROM
store_cat_assign
INNER JOIN store_items ON store_cat_assign.item_id = store_items.id
WHERE
 store_cat_assign.cat_id=$update_id and store_items.status=1
    ";

    $data['item_segments'] = $this->site_setting->_get_items_segments();
    $data['dollar_symbol'] = $this->site_setting->_get_dollar_symbol();
    $data['query'] = $this->_custom_query($mysql_query);
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_module'] = "homepage_blocks";
    $data['view_file'] = "view";
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}


function sort()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $number = $this->input->post('number', TRUE);
    for ($i=1; $i <= $number; $i++) { 
        $update_id = $_POST['order'.$i];
        $data['priority'] = $i;
        $this->_update($update_id, $data);
    }
}



function _get_block_title($update_id)
{
    $data = $this->fetch_data_from_db($update_id);
    $block_title = $data['block_title'];
    return $block_title;
}

function fetch_data_from_post()
{
    $data['block_title'] = $this->input->post('block_title', TRUE);
    return $data;
}

function fetch_data_from_db($update_id)
{
    //security check
    if (!is_numeric($update_id)) {
        redirect('site_security/not_allowed');
    }
    $query = $this->get_where($update_id);
    foreach ($query->result() as $row) 
    {
        $data['block_title'] = $row->block_title;
    }
    if (!isset($data))
    {
        $data = "";
    }
    return $data;
}

//Create page
function create()
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    
    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    //Cancel button back to Manage page
    if ($submit=="Cancel")
    {
        redirect('homepage_blocks/manage');
    }
    if ($submit=="Submit")
    {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('block_title', 'Homepage Offer Title', 'required|max_length[240]');

        if ($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_from_post();

            if (is_numeric($update_id))
            {
                //update the data category
                $this->_update($update_id, $data);
                $flash_msg = "The category detail was seuccessfully Updated!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                // redirect('homepage_blocks/create/'.$update_id);
                redirect('homepage_blocks/manage');
            }
            else 
            {
                //insert the data category
                $this->_insert($data);
                $update_id = $this->get_max();
                $flash_msg = "The category was seuccessfully added!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                //redirect('homepage_blocks/create/'.$update_id);
                redirect('homepage_blocks/manage');
            }
        }
    }

    if ((is_numeric($update_id)) && ($submit!="Submit"))
    {
        $data = $this->fetch_data_from_db($update_id);
    }
    else
    {
        $data = $this->fetch_data_from_post();
    }
    if (!is_numeric($update_id))
    {
        $data['headline'] = "Create New Homepage Offer";
    }
    else
    {
        $data['headline'] = "Update Homepage Offer";
    }

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');    
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->admin($data);
}

function manage()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
        
    $data['sort_this'] = TRUE;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin($data);
}



function get($order_by)
{
    $this->load->model('mdl_homepage_blocks');
    $query = $this->mdl_homepage_blocks->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_homepage_blocks');
    $query = $this->mdl_homepage_blocks->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) 
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_homepage_blocks');
    $query = $this->mdl_homepage_blocks->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_homepage_blocks');
    $query = $this->mdl_homepage_blocks->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_homepage_blocks');
    $this->mdl_homepage_blocks->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_homepage_blocks');
    $this->mdl_homepage_blocks->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_homepage_blocks');
    $this->mdl_homepage_blocks->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_homepage_blocks');
    $count = $this->mdl_homepage_blocks->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_homepage_blocks');
    $max_id = $this->mdl_homepage_blocks->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_homepage_blocks');
    $query = $this->mdl_homepage_blocks->_custom_query($mysql_query);
    return $query;
}

}