<?php
defined('ABSPATH') or die("restricted access");
function mmursp_insert_data_process()
{
	global $wpdb;
	if(isset($_POST['cat_name'])&& $_POST['cat_name']!="")
	{	
		$cat_name=sanitize_text_field($_POST['cat_name']);
		$created_by=!empty($_POST['current_user_name'])? sanitize_text_field($_POST['current_user_name']) :'';
		$created_date=!empty($_POST['created_date'])? sanitize_text_field($_POST['created_date']) :'';
		//$page_or_post_title=!empty($_POST['page_or_post_title'])? sanitize_text_field($_POST['page_or_post_title']) :'';
		$page_or_post_slug=!empty($_POST['page_or_post_slug'])? sanitize_text_field($_POST['page_or_post_slug']) :'';
		$page_or_post_id=!empty($_POST['page_or_post_id']) ? intval($_POST['page_or_post_id']):'';
		$post_of_custom_post_type=!empty($_POST['post_of_custom_post_type']) ? sanitize_text_field($_POST['post_of_custom_post_type']):'';
		$regular_expression=!empty($_POST['regular_expression']) ? sanitize_text_field($_POST['regular_expression']) :'';
		$regular_expression=$regular_expression;
		$data=array(
					'category'							=> $cat_name,
					'created_by'						=> $created_by,
					'created_date'						=> $created_date,
					//'page_or_post_title'				=> $page_or_post_title,
					'page_or_post_slug'					=> $page_or_post_slug,
					'page_or_post_id' 					=> $page_or_post_id,
					'post_of_custom_post_type' 			=> $post_of_custom_post_type,
					'regular_expression'				=> $regular_expression,
					);	
		$table_name=$wpdb->prefix.'mmursp_settings';
		$wpdb->insert($table_name, $data);	
		wp_redirect( admin_url('admin.php?page=mmursp-list&mmursp_in_msg=suc') );
		exit();	
	}
}
function mmursp_edit_data_process()
{
	global $wpdb;
	if(isset($_POST['cat_name'])&& $_POST['cat_name']!="" && isset($_POST['mmursp_id']) && $_POST['mmursp_id']!="")
	{		
		$cat_name=sanitize_text_field($_POST['cat_name']);
		$created_by=!empty($_POST['current_user_name'])? sanitize_text_field($_POST['current_user_name']) :'';
		$created_date=!empty($_POST['created_date'])? sanitize_text_field($_POST['created_date']) :'';
		//$page_or_post_title=!empty($_POST['page_or_post_title'])? sanitize_text_field($_POST['page_or_post_title']) :'';
		$page_or_post_slug=!empty($_POST['page_or_post_slug'])? sanitize_text_field($_POST['page_or_post_slug']) :'';
		$page_or_post_id=!empty($_POST['page_or_post_id']) ? intval($_POST['page_or_post_id']):'';
		$post_of_custom_post_type=!empty($_POST['post_of_custom_post_type']) ? sanitize_text_field($_POST['post_of_custom_post_type']):'';
		$regular_expression=!empty($_POST['regular_expression']) ? sanitize_text_field($_POST['regular_expression']) :'';
		$regular_expression=$regular_expression;
		$data=array(
				'category'							=> $cat_name,
				'created_by'						=> $created_by,
				'created_date'						=> $created_date,
				'page_or_post_slug'					=> $page_or_post_slug,
				//'page_or_post_title'				=> $page_or_post_title,
				'page_or_post_id' 					=> $page_or_post_id,
				'post_of_custom_post_type' 			=> $post_of_custom_post_type,
				'regular_expression'				=> $regular_expression,
				);
		//print_r($data);
		//die;
		$where =array('id'=>intval($_POST['mmursp_id']));
		$table_name=$wpdb->prefix.'mmursp_settings';
		$wpdb->update($table_name, $data, $where);	
		wp_redirect( admin_url('admin.php?page=mmursp-list&mmursp_ed_msg=suc'));		
		exit();	
	}
}
function mmursp_delete_data_process()
{
	global $wpdb;
	if(isset($_POST['mmursp_id']) && $_POST['mmursp_id']!="" && (isset($_POST['mmursp_select_action_top']) && $_POST['mmursp_select_action_top']=="delete" || isset($_POST['mmursp_select_action_bottom']) && $_POST['mmursp_select_action_bottom']=="delete"))
	{	
		$id_array=explode(",",$_POST['mmursp_id']);
		foreach($id_array as $id)
		{
			$where = array('id' => intval($id));
			$table_name=$wpdb->prefix.'mmursp_settings';
			$wpdb->delete($table_name,$where);
		}
		wp_redirect(admin_url('admin.php?page=mmursp-list&mmursp_dl_msg=suc'));
	}
	else
	{
		wp_redirect(admin_url('admin.php?page=mmursp-list'));		
	}
	exit();
}
function mmursp_fetch_post_of_custom_post_types()
{																																
	global $wpdb;
	$post_type=!empty($_POST['whatever'])? sanitize_text_field($_POST['whatever']) :'';
	if(!empty($_POST['select_post'])){
		$select_post=sanitize_text_field($_POST['select_post']);
	}
	$args = array('post_type' => $post_type,'post_status' => 'publish');
	$pages1 = query_posts( $args );
	foreach ( $pages1 as $page1 ) 
	{
	  	$selected = $select_post == $page1->post_name ? "selected":'';
	  	$option = '<option value=' . $page1->ID . '" '.$selected.' slug="'.urldecode($page1->post_name).'">';
		$option .= $page1->post_title.'('.urldecode($page1->post_name).')';
		$option .= '</option>';
		echo $option;
	}
}