<?php
class Store_accounts extends MX_Controller 
{

function __construct()
{
parent::__construct();
}
//Update Password Account
function update_pword()
{
    $this->load->library('session');
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $update_id = $this->uri->segment(3);
    $submit = $this->input->post('submit', TRUE);

    if (!is_numeric($update_id)) {
        redirect('store_accounts/manage');
    } elseif ($submit=="Cancel") {
        redirect('store_accounts/manage'.$update_id);
    }//Cancel button back to Manage page
    
    if ($submit=="Submit")
    {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pword', 'Password', 'required|min_length[7]|max_length[35]');
        $this->form_validation->set_rules('repeat_pword', 'Repeat Password', 'required|matches[pword]');
        if ($this->form_validation->run() == TRUE)
        {
            //get the variables
            $pword = $this->input->post('pword', TRUE);
            $this->load->module('site_security');
            $data['pword'] = $this->site_security->_hash_string($pword); //strong password

            //update the data account
            $this->_update($update_id, $data);
            $flash_msg = "The account Password was seuccessfully Updated!";
            $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
            $this->session->set_flashdata('account', $value);
            redirect('store_accounts/create/'.$update_id);
        }
    }
    
    $data['headline'] = "Update Account Password";
    $data['update_id'] = $update_id;
    $data['flash'] = $this->session->flashdata('account');    
    $data['view_file'] = "update_pword";
    $this->load->module('templates');
    $this->templates->admin($data);
}

//create accout
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
        redirect('store_accounts/manage');
    }
    if ($submit=="Submit")
    {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'UserName', 'required');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
       

        if ($this->form_validation->run() == TRUE)
        {
            //get the variables
            $data = $this->fetch_data_from_post();

            if (is_numeric($update_id))
            {
                //update the data account
                $this->_update($update_id, $data);
                $flash_msg = "The account detail was seuccessfully Updated!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_accounts/create/'.$update_id);
            }
            else 
            {
                //insert the data account
                $data['date_made'] = time();
                $this->_insert($data);
                $update_id = $this->get_max();
                $flash_msg = "The Account was seuccessfully added!";
                $value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
                $this->session->set_flashdata('item', $value);
                redirect('store_accounts/create/'.$update_id);
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


//manage
function manage()
{
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $data['flash'] = $this->session->flashdata('item');
    $data['query'] = $this->get('');
    $data['view_file'] = "manage";
    $this->load->module('templates');
    $this->templates->admin($data);
}


function fetch_data_from_post()
{
    $data['username'] = $this->input->post('username', TRUE);
    $data['firstname'] = $this->input->post('firstname', TRUE);
    $data['lastname'] = $this->input->post('lastname', TRUE);
    $data['company'] = $this->input->post('company', TRUE);
    $data['address1'] = $this->input->post('address1', TRUE);
    $data['address2'] = $this->input->post('address2', TRUE);
    $data['town'] = $this->input->post('town', TRUE);
    $data['country'] = $this->input->post('country', TRUE);
    $data['postcode'] = $this->input->post('postcode', TRUE);
    $data['telnum'] = $this->input->post('telnum', TRUE);
    $data['email'] = $this->input->post('email', TRUE);
    // $data['date_made'] = $this->input->post('date_made', TRUE);
    // $data['pword'] = $this->input->post('pword', TRUE);
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
        $data['username'] = $row->username;
        $data['firstname'] = $row->firstname;
        $data['lastname'] = $row->lastname;
        $data['company'] = $row->company;
        $data['address1'] = $row->address1;
        $data['address2'] = $row->address2;
        $data['town'] = $row->town;
        $data['country'] = $row->country;
        $data['postcode'] = $row->postcode;
        $data['telnum'] = $row->telnum;
        $data['email'] = $row->email;
        $data['date_made'] = $row->date_made;
        $data['pword'] = $row->pword;
    }
    if (!isset($data))
    {
        $data = "";
    }
    return $data;
}

function get($order_by)
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) 
    {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_accounts');
    $count = $this->mdl_store_accounts->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_accounts');
    $max_id = $this->mdl_store_accounts->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->_custom_query($mysql_query);
    return $query;
}






////Trick
function autogen()
{
    $mysql_query = "show columns from store_accounts";
    $query = $this->_custom_query($mysql_query);
/*    foreach ($query->result() as $row) {
        $column_name = $row->Field;

        if ($column_name!="id") {
            echo '$data[\''.$column_name.'\'] = $this->input->post(\''.$column_name.'\', TRUE);<br>';
        }
    }


    echo "<hr>";

    foreach ($query->result() as $row) {
        $column_name = $row->Field;

        if ($column_name!="id") {
            echo '$data[\''.$column_name.'\'] = $row->'.$column_name.';<br>';
        }
    }
*/

    foreach ($query->result() as $row) {
        $column_name = $row->Field;

        if ($column_name!="id") {
           $var ='<div class="control-group">
           <label class="control-label" for="typeahead">'.ucfirst($column_name).'</label>
            <div class="controls">
            <input type="text" class="span6" name="'.$column_name.'" value="<?= $'.$column_name.' ?>">
            </div>
            </div>';
echo htmlentities($var);
        }
    }
    
}
}