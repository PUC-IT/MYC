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