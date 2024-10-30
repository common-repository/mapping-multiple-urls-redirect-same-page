<?php
defined('ABSPATH') or die("restricted access");
function add_mmursp_options()  
{  
    add_menu_page('Mapping multiple URLs redirect same page', 'Mapping multiple URLs redirect same page', 'administrator','mmursp-list'); 
    add_submenu_page('mmursp-list', 'List Of URL Alias','List Of URL Alias','administrator', 'mmursp-list','mapping_multiple_urls_redirect_same_page_main'); 
	add_submenu_page('mmursp-list', 'Add New','Add New','administrator', 'mmursp-insert','mmursp_insert'); 	
}