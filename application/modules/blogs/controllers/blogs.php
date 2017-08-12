<?php
class Blogs extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function test()
{
    $this->load->module('timedate');
    $nowtime = time();
    $datepicker_time = $this->timedate->get_nice_date($nowtime, 'datepicker_us');
    echo $datepicker_time;
    echo "<hr>";
    $timestamp = $this->timedate->make_timestamp_from_datepicker_us($datepicker_time);
    echo $timestamp;
    echo "<hr>";
    $nice_time = $this->timedate->get_nice_date($timestamp, 'cool');
    echo $nice_time;
}
function delete($update_id)
{
    if (!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $submit = $this->input->post('submit', TRUE);
    //Cancel button back to Create page
    if ($submit=="Cancel")
    {
        redirect('blogs/create/'.$update_id);
    }
    elseif ($submit=="Yes - Delete Item")
    {
        $this->_delete($update_id);
        $flash_msg = "The item was seuccessfully Delete.";
        $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);
        redirect('blogs/manage/');
    }
}

function deleteconf($update_id)
{
    if (!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    } elseif ($update_id<3) {
        redirect('site_security/not_allowed');
    }
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['headline'] = "Delete page";
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);
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
        redirect('blogs/manage');
    }
    if ($submit=="Submit")
    {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('page_title', 'page Title', 'required|max_length[240]');
        $this->form_validation->set_rules('page_content', 'Page Content', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_from_post();
            $data['page_url'] = url_title($data['page_title']);

            if (is_numeric($update_id))
            {
                //update page
                if ($update_id<3) {
                    unset($data['page_url']);
                }
                $this->_update($update_id, $data);
                $flash_msg = "The Page detail was seuccessfully Updated!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('blogs/create/'.$update_id);
            }
            else 
            {
                //insert a new page
                $this->_insert($data);
                $update_id = $this->get_max();
                $flash_msg = "The Page was seuccessfully added!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('blogs/manage/'.$update_id);
            }
        }
    }

    if ((is_numeric($update_id)) && ($submit!="Submit"))
    {
        $data = $this->fetch_data_from_db($update_id);
    } else {
        $data = $this->fetch_data_from_post();
    }
    if (!is_numeric($update_id))
    {
        $data['headline'] = "Create New Page";
    }
    else
    {
        $data['headline'] = "Update Page Information";
    }

    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');    
    $data['view_file'] = "create";
    $this->load->module('templates');
    $this->templates->admin($data);
}

function fetch_data_from_post()
{
    $data['page_title'] = $this->input->post('page_title', TRUE);
    $data['page_keywords'] = $this->input->post('page_keywords', TRUE);
    $data['page_description'] = $this->input->post('page_description', TRUE);
    $data['page_content'] = $this->input->post('page_content', TRUE);
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
        $data['page_title'] = $row->page_title;
        $data['page_url'] = $row->page_url;
        $data['page_keywords'] = $row->page_keywords;
        $data['page_content'] = $row->page_content;
        $data['page_description'] = $row->page_description;
    }
    if (!isset($data))
    {
        $data = "";
    }
    return $data;
}

function manage()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $data['flash'] = $this->session->flashdata('item');
    $data['query'] = $this->get('page_url');
    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin($data);
}


function get($order_by)
{
    $this->load->model('mdl_blogs');
    $query = $this->mdl_blogs->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_blogs');
    $query = $this->mdl_blogs->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) 
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_blogs');
    $query = $this->mdl_blogs->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_blogs');
    $query = $this->mdl_blogs->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_blogs');
    $this->mdl_blogs->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_blogs');
    $this->mdl_blogs->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_blogs');
    $this->mdl_blogs->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_blogs');
    $count = $this->mdl_blogs->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_blogs');
    $max_id = $this->mdl_blogs->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_blogs');
    $query = $this->mdl_blogs->_custom_query($mysql_query);
    return $query;
}

}



