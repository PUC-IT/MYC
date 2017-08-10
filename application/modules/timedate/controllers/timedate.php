<?php
class Timedate extends MX_Controller 
{

function __construct()
{
parent::__construct();
}

function get_nice_date($timestamp, $format){
    switch ($format) {
        case 'full':
        $the_date = date('l jS \of F Y \a\t h:i:s A', $timestamp);
        break;
        case 'cool':
        $the_date = date('l jS \of F Y ', $timestamp);
        break;
        case 'short':
        $the_date = date('jS M Y', $timestamp);
        break;
        case 'shorta':
        $the_date = date('d\-m\-Y', $timestamp);
        break;
    }
    return $the_date;
}

}