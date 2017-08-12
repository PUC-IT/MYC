<?php
class Site_setting extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function _get_items_segments(){
    //return the segment for the store_items pages (product url)
    $segments = "musical/instrument/";
    return $segments;
}
function _get_cat_segments(){
    //return the segment for the store_items pages (product url)
    $segments = "song/instrument/";
    return $segments;
}

function _get_page_not_found_msg(){
	$msg = "<h1>It's a webpage Tola But not as we know it!</h1>";
	$msg.= "<p>Please check your vibe and try again!</p>";
	return $msg;
}
}