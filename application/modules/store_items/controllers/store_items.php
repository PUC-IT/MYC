<?php
class Store_items extends MX_Controller 
{

function __construct()
{
parent::__construct();
$this->load->library('form_validation');
$this->form_validation->CI =& $this;
}

// function _get_sub_cat_id($update_id)
// {
//     $refer_url = $_SERVER['HTTP_REFERER'];

//     $this->load->module('site_setting');
//     $this->load->module('store_cat_assign');
//     $this->load->module('store_categories');

//     $item_segments = $this->site_setting->_get_items_segments();
//     $ditch_this = base_url().$item_segments;
//     $cat_url = str_replace($ditch_this, '', $refer_url);
//     $sub_cat_id = $this->store_categories->_get_cat_id_from_cat_url($cat_url);
//     if ($sub_cat_id>0) {
//         return $sub_cat_id;
//     } else {
//         $sub_cat_id = $this->_get_best_sub_cat_id($update_id);
//     }
//     return $sub_cat_id;
// }

function _get_item_id_from_item_url($item_url)
{
    $query = $this->get_where_custom('item_url', $item_url);
    foreach ($query->result() as $row) {
        $item_id = $row->id;
    }
    if (!isset($item_id)) {
        $item_id = 0;
    }
    return $item_id;
}

function view($update_id)
{
    if (!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }
    $this->load->module('site_setting');

    //fetch item detail
    $data = $this->fetch_data_from_db($update_id);
    $data['update_id'] = $update_id;

    $data['item_price_desc'] = number_format($data['item_price'], 2);
    $data['item_price_desc'] = str_replace('.00', '', $data['item_price_desc']);

    $data['currency_symbol'] = $this->site_setting->_get_dollar_symbol();
    $data['flash'] = $this->session->flashdata('item');
    $data['view_module'] = "store_items";
    $data['view_file'] = "view";
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);
}


function _process_delete($update_id)
{
    //attempt to delete item color
    $this->load->module('store_item_colors');
    $this->store_item_colors->_delete_for_item($update_id);
    //attempt to delete item size
    $this->load->module('store_item_sizes');
    $this->store_item_sizes->_delete_for_item($update_id);

    $data = $this->fetch_data_from_db($update_id);
    $big_pic = $data['big_pic'];
    $small_pic = $data['small_pic'];
    $big_pic_path = './big_pics/'.$big_pic;
    $small_pic_path = './small_pics/'.$small_pic;
    
    if (file_exists($big_pic_path))
    {
        unlink($big_pic_path);
    } 
    if (file_exists($small_pic_path))
    {
        unlink($small_pic_path);
    }
    $this->_delete($update_id);
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
        redirect('store_items/create/'.$update_id);
    }
    elseif ($submit=="Yes - Delete Item")
    {
        $this->_process_delete($update_id);
        $flash_msg = "The item was seuccessfully Delete.";
        $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
        $this->session->set_flashdata('item', $value);
        redirect('store_items/manage/');
    }
}

function deleteconf($update_id)
{
    if (!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['headline'] = "Delete Item";
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);
}

//update color
function update($update_id)
{
    if (!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['headline'] = "Update Item Colors";
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "update";
    $this->load->module('templates');
    $this->templates->admin($data);
}

//Delete Image from DB
function delete_image($update_id)
{
    if (!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data = $this->fetch_data_from_db($update_id);
    $big_pic = $data['big_pic'];
    $small_pic = $data['small_pic'];
    $big_pic_path = './big_pics/'.$big_pic;
    $small_pic_path = './small_pics/'.$small_pic;
    
    if (file_exists($big_pic_path))
    {
        unlink($big_pic_path);
        //echo "The File".$big_pic_path." exists";
    } 
    if (file_exists($small_pic_path))
    {
        unlink($small_pic_path);
        //echo "The File".$big_pic_path." Does not exits.";
    }
    //update db from delete
    unset($data);
    $data['big_pic'] = "";
    $data['small_pic'] = "";
    $this->_update($update_id, $data);
    redirect('store_items/create/'.$update_id);
    $flash_msg = "The item Image was seuccessfully Delete.";
    $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
    $this->session->set_flashdata('item', $value);
}

//Generate Thumbnails
function _generate_thumbnail($file_name)
{
    $config['image_library'] = 'gd2';
    $config['source_image'] = './big_pics/'.$file_name;
    $config['new_image'] = './small_pics/'.$file_name;
    //$config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']         = 200;
    $config['height']       = 200;

    $this->load->library('image_lib', $config);
    $this->image_lib->resize();
}

//Do Upload
function do_upload($update_id)
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
        redirect('store_items/create/'.$update_id);
    }
    
    $config['upload_path']          = './big_pics/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 4500;
    $config['max_width']            = 2024;
    $config['max_height']           = 1024;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('userfile'))
    {
        $data['error'] = array('error' => $this->upload->display_errors('<p style="color:red; display:inline-block;">', '</p>'));      
        $data['headline'] = "Upload Error";
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "upload_image";
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    else
    {

        $data = array('upload_data' => $this->upload->data());

        $upload_data = $data['upload_data'];
        $file_name = $upload_data['file_name'];
        $this->_generate_thumbnail($file_name);

        //update image database
        $update_data['big_pic'] = $file_name;
        $update_data['small_pic'] = $file_name;
        $this->_update($update_id, $update_data);

        $data['headline'] = "Upload Success";
        $data['update_id'] = $update_id;
        $data['flash'] = $this->session->flashdata('item');
        $data['view_file'] = "upload_success";
        $this->load->module('templates');
        $this->templates->admin($data);
        redirect('store_items/create/'.$update_id);
    }
}

//Upload Page
function upload_image($update_id)
{
    if (!is_numeric($update_id))
    {
        redirect('site_security/not_allowed');
    }

    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $data['headline'] = "Upload Image";
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file'] = "upload_image";
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
        redirect('store_items/manage');
    }
    if ($submit=="Submit")
    {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('item_title', 'Item Title', 'required|max_length[240]|callback_item_check');
        $this->form_validation->set_rules('item_price', 'Item Price', 'required|numeric');
        $this->form_validation->set_rules('was_price', 'Was Price', 'numeric');
        $this->form_validation->set_rules('status', 'Status', 'required|numeric');
        $this->form_validation->set_rules('item_description', 'Item Description', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_from_post();
            $data['item_url'] = url_title($data['item_title']);

            if (is_numeric($update_id))
            {
                //update the data item
                $this->_update($update_id, $data);
                $flash_msg = "The item detail was seuccessfully Updated!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_items/create/'.$update_id);
            }
            else 
            {
                //insert the data item
                $this->_insert($data);
                $update_id = $this->get_max();
                $flash_msg = "The item was seuccessfully added!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_items/create/'.$update_id);
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
        $data['big_pic'] = "";
    }
    if (!is_numeric($update_id))
    {
        $data['headline'] = "Add New Item";
    }
    else
    {
        $data['headline'] = "Update Item Details";
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
    $data['flash'] = $this->session->flashdata('item');
    $data['query'] = $this->get('item_title');
    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin($data);
}

function fetch_data_from_post()
{
    $data['item_title'] = $this->input->post('item_title', TRUE);
    $data['item_price'] = $this->input->post('item_price', TRUE);
    $data['was_price'] = $this->input->post('was_price', TRUE);
    $data['item_description'] = $this->input->post('item_description', TRUE);
    $data['status'] = $this->input->post('status', TRUE);
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
        $data['item_title'] = $row->item_title;
        $data['item_url'] = $row->item_url;
        $data['item_price'] = $row->item_price;
        $data['item_description'] = $row->item_description;
        $data['big_pic'] = $row->big_pic;
        $data['small_pic'] = $row->small_pic;
        $data['was_price'] = $row->was_price;
        $data['status'] = $row->status;
    }
    if (!isset($data))
    {
        $data = "";
    }
    return $data;
}

function get($order_by)
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset)))
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id))
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id))
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id))
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_items');
    $count = $this->mdl_store_items->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_items');
    $max_id = $this->mdl_store_items->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->_custom_query($mysql_query);
    return $query;
}

function item_check($str)
{
    $item_url = url_title($str);
    $mysql_query = "select * from store_items where item_title='$str' and item_url='$item_url'";
    $update_id = $this->uri->segment(3);
    if (is_numeric($update_id))
    {
        # update...
        $mysql_query.= "and id!=$update_id";
    }

    $query = $this->_custom_query($mysql_query);
    $num_rows = $query->num_rows();

    if ($num_rows>0)
    {
        $this->form_validation->set_message('item_check', 'The item title that you add not avaliable!');
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}
}