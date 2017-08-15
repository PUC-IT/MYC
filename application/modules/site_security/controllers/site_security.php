<?php
class Site_security extends MX_Controller 
{

function __construct()
{
parent::__construct();
}



function _check_admin_login_details($username, $pword){

	$target_username = "amdin";
	$target_pass	= "password";

	if (($username==$target_username) && ($pword==$target_pass)) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function test(){
	$length = 30;
	echo $this->generate_random_string($length);
}


function _get_user_id()
{
	//attempt to get The User ID
}

function generate_random_string($length)
{
	$characters = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
	$randomString = '';
	for ($i=0; $i < $length ; $i++) { 
		$randomString .= $characters[rand(0, strlen($characters) -1)];
	}
	return $randomString;
}

function _hash_string($str){
	$hash_string = password_hash($str, PASSWORD_BCRYPT, array(
		'cost' => 11
	));
	return $hash_string;
}

function _verify_hash($plain_text_str, $hash_string)
{
	$result = password_verify($plain_text_str, $hash_string);
	return $result;
}

function _make_sure_is_admin()
{
    $is_admin = TRUE;
    if ($is_admin!=TRUE)
    {
        redirect('site_security/not_allowed');
    }
}
function not_allowed()
{
    echo "You are not allow to access!";
}
}