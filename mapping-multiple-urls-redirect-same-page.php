<?php
/**
* Plugin Name: Mapping multiple URLs redirect same page
* Description: Mapping multiple URLs redirect same page,post,category,tags,custom post types.
* Version: 5.8
* Author: Rupam Hazra
* Author URI: http://rstar.dx.am
**/
defined('ABSPATH') or die("restricted access");
if(is_admin())
{
	include_once(dirname(__FILE__).'/admin/mapping-multiple-urls-redirect-same-page-menu.php');
	include_once(dirname(__FILE__).'/admin/mapping-multiple-urls-redirect-same-page-list.php');
	include_once(dirname(__FILE__).'/admin/mapping-multiple-urls-redirect-same-page-insert.php');
	include_once(dirname(__FILE__).'/admin/mapping-multiple-urls-redirect-same-page-edit.php');
	include_once(dirname(__FILE__).'/admin/mapping-multiple-urls-redirect-same-page-process.php');
	add_action( 'admin_enqueue_scripts', 'mmursp_scripts_css' );	
}
else
{
	add_action( 'wp_enqueue_scripts', 'mmursp_scripts_css' );	
}
function mmursp_scripts_css()
{	
	if( is_admin() )
	{	
		wp_enqueue_style('mapping-multiple-urls-redirect-same-page-admin-styles',plugins_url('admin/css/mapping-multiple-urls-redirect-same-page-admin-styles.css',__FILE__));
		wp_enqueue_script('mapping-multiple-urls-redirect-same-page-admin-script',plugins_url('admin/js/mapping-multiple-urls-redirect-same-page-admin-script.js',__FILE__));
	}
	
} 
function add_redirect_rule()
{
	global $wpdb;
	$url_taxonomi='';
	$url_taxonomi_value='';
	$page_or_post_slug='';
	$post_type_name='';
	$table_name=$wpdb->prefix.'mmursp_settings';
	$results_array = $wpdb->get_results( "SELECT * FROM $table_name");
	//$url_taxonomi=array('category_name','pagename','post_type','tag','page');
	foreach ($results_array as $key => $object_value) {
		if($object_value->category=="page"){
			$url_taxonomi='pagename';
			$url_taxonomi_value=$object_value->page_or_post_slug;
			$page_or_post_slug='index.php?'.$url_taxonomi.'='.esc_html($url_taxonomi_value);
			//echo $page_or_post_slug;
			//die;
		}
		else if($object_value->category=="post"){
			$url_taxonomi='post_type';
			$url_taxonomi_value='post';
			$page_or_post_slug='index.php?'.$url_taxonomi.'='.esc_html($url_taxonomi_value).'&name='.$object_value->page_or_post_slug;
		}
		else if($object_value->category=="category"){
			$url_taxonomi='category_name';
			$url_taxonomi_value=$object_value->page_or_post_slug;
			$page_or_post_slug='index.php?'.$url_taxonomi.'='.esc_html($url_taxonomi_value);
		}
		else if($object_value->category=="tag"){
			$url_taxonomi='tag';
			$url_taxonomi_value=$object_value->page_or_post_slug;
			$page_or_post_slug='index.php?'.$url_taxonomi.'='.esc_html($url_taxonomi_value);
		}
		else if($object_value->category=="custom-post-types"){
			$url_taxonomi='post_type';
			$url_taxonomi_value=$object_value->post_of_custom_post_type;
			if($object_value->page_or_post_slug!="") $post_type_name='&name='.$object_value->page_or_post_slug;
			$page_or_post_slug='index.php?'.$url_taxonomi.'='.esc_html($url_taxonomi_value).$post_type_name;
			//die;
		}
		$regular_expression=esc_html($object_value->regular_expression);
		add_rewrite_rule($regular_expression,$page_or_post_slug,'top');
	}
    flush_rewrite_rules( $hard = true  ); 
}
function mmursp_check_current_user_level()
{
	global $current_user;
	if ( current_user_can('level_3') )
	{
		return true;
	}
}
function mapping_multiple_urls_redirect_same_page_main()
{
	global $current_user;
	$mmursp_mapping_multiple_urls_redirect_same_page_view='list';
	if(isset($_GET['view']) && $_GET['view'])
	{
		
		$mmursp_mapping_multiple_urls_redirect_same_page_view = trim($_GET['view']);
	}
	if(isset($_POST['view']) && $_POST['view'])
	{
		$mmursp_mapping_multiple_urls_redirect_same_page_view = trim($_POST['view']);
	}

	if (!empty($mmursp_mapping_multiple_urls_redirect_same_page_view) && $mmursp_mapping_multiple_urls_redirect_same_page_view == 'list')
	{
		mmursp_list();
	}
	else if (!empty($mmursp_mapping_multiple_urls_redirect_same_page_view) && $mmursp_mapping_multiple_urls_redirect_same_page_view == 'addnew')
	{
		if(!mmursp_check_current_user_level())
		{
			wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
		}	
		mmursp_insert();
	}
	else if (!empty($mmursp_mapping_multiple_urls_redirect_same_page_view) && $mmursp_mapping_multiple_urls_redirect_same_page_view == 'edit')
	{
		if(!mmursp_check_current_user_level())
		{
			wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
		}	
		mmursp_edit();
	}
}
function mmursp_activate()
{
		mmursp_create_table();		
		flush_rewrite_rules();
}
function mmursp_deactivate()
{
		flush_rewrite_rules();
}
function mmursp_uninstall()
{
		mmursp_remove_table();
}
function mmursp_create_table()
{
	global $wpdb;	
	require_once(ABSPATH . '/wp-admin/includes/upgrade.php');	
	 $charset_collate = '';
	 if ( ! empty( $wpdb->charset ) )
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";

    if ( ! empty( $wpdb->collate ) )
        $charset_collate .= " COLLATE {$wpdb->collate}";
	$table_name=$wpdb->prefix.'mmursp_settings';
	$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `category` varchar(50) NOT NULL,
				  `page_or_post_id` int(11) DEFAULT NULL,
				  `page_or_post_slug` varchar(50) DEFAULT NULL,
				  `post_of_custom_post_type` varchar(50) DEFAULT NULL,
				  `regular_expression` text DEFAULT NULL,
				  `created_by` varchar(30) DEFAULT NULL,
				  `created_date` datetime DEFAULT NULL,
				  PRIMARY KEY (`id`)
			) $charset_collate;";
	dbDelta($sql);
	
}

function mmursp_remove_table()
{
	global $wpdb;
	$table = $wpdb->prefix."mmursp_settings";
	$wpdb->query("DROP TABLE IF EXISTS $table");
}
register_activation_hook(__FILE__,'mmursp_activate' ); // resgister hook
register_deactivation_hook( __FILE__,'mmursp_deactivate');
register_uninstall_hook( __FILE__, 'mmursp_uninstall' ); // uninstall plugin
add_action('admin_menu', 'add_mmursp_options'); // add menu hook
add_action( 'admin_post_mmursp-submit-insert-form-data', 'mmursp_insert_data_process' ); // insert action decleared
add_action( 'admin_post_mmursp-submit-edit-form-data', 'mmursp_edit_data_process' ); // edit action decleared
add_action( 'admin_post_mmursp-submit-delete-form-data', 'mmursp_delete_data_process' ); // delete action decleared
add_action('init', 'add_redirect_rule');
add_action( 'wp_ajax_mmursp_fetch_post_of_custom_post_types', 'mmursp_fetch_post_of_custom_post_types' );
