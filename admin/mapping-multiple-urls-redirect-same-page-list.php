<?php
defined('ABSPATH') or die("restricted access");
function mmursp_list()
{
	global $wpdb;
	$table_name=$wpdb->prefix.'mmursp_settings';
	//$results = $wpdb->get_results( "SELECT * FROM $table_name");
?>
	<div class="wrap">
		<h1>List Of URL Alias <a href="<?php echo admin_url('admin.php?page=mmursp-list&view=addnew'); ?>" class="page-title-action" role="button">Add New</a></h1>
		<p>If you have any type of query releted to make a link then please contact with query to <b><a href="mailto:rupamhazra@gmail.com">rupamhazra@gmail.com</a></b></p>
       <p><b>If this plugin is usefull for you then please rate it <a href="https://wordpress.org/plugins/mapping-multiple-urls-redirect-same-page/">here</a>.</b></p>
		<?php include_once('mapping-multiple-urls-redirect-same-page-message.php');?>
		<form method="post" name="mmursp_deleteForm" id="mmursp_deleteForm" action="<?php echo get_admin_url().'admin-post.php'; ?>">
			<input type="hidden" name="action" value="mmursp-submit-delete-form-data" />  
			<input type="hidden" id="mmursp_id" name="mmursp_id" value=""/> 
			<div class="tablenav top" id="tablenavtop_id">
				<div class="tablenav-pages">
					<?php
							$customPagHTML     = "";
							$query             = "SELECT * FROM $table_name";
							$total_query     = "SELECT COUNT(1) FROM (${query}) AS combined_table";
							$total             = $wpdb->get_var( $total_query );
							$items_per_page = 10;
							$page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
							$offset         = ( $page * $items_per_page ) - $items_per_page;
							$result         = $wpdb->get_results( $query . " ORDER BY id DESC LIMIT ${offset}, ${items_per_page}" );
							$totalPage         = ceil($total / $items_per_page);
							$pagination_link=paginate_links( array(
							'base' => add_query_arg( 'cpage', '%#%' ),
							'format' => '',
							'prev_next'=> true,
							'prev_text'          => __('« '),
							'next_text'          => __(' »'),
							'total' => $totalPage,
							'current' => $page
							));
							if($totalPage > 1){
							$customPagHTML     =  '<span class="displaying-num" id="">'.$total.' items </span>	<span class="displaying-num">Page '.$page.' of '.$totalPage.'</span>'.$pagination_link;
							
							}		
							?>
					<?php echo $customPagHTML;?>	
				</div>
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
					<select name="mmursp_select_action_top" id="bulk-action-selector-top">
						<option value="-1">Bulk Actions</option>
						<option value="delete" class="hide-if-no-js">Delete</option>
					</select>
					<input type="button" id="doaction" class="button action"  onclick="mmursp_how_many();" value="Apply">
				</div>
				<div class="tablenav-pages one-page"><span class="displaying-num" id="total_item_top_id"></span></div>
			</div>
			<table class="wp-list-table widefat fixed striped posts">
				<thead>
				  <tr>
					<th>
						<input id="mmursp_root_checkbox_id_top" type="checkbox"  style="margin-left:0px;margin-right:5px;" value="1" onclick="mmursp_all_check_top()">
						<span>Regular Expression</span>
					</th>
					<!-- <th>Title</th> -->
					<th>Slug</th>
					<th>Type</th>
					<th>Created By</th>
					<th>Date</th>
				  </tr>
				</thead>
				
				<tbody id="the-list">					  
						<?php	
						$count_item=0;
						foreach ($result as $key => $object) {  
							$id     = !empty($object->id) ? $object->id : '';
							$page_or_post_slug=esc_html($object->page_or_post_slug);
							// $page_or_post_title=esc_html($object->page_or_post_title);
							$regular_expression=esc_html($object->regular_expression);
							$created_by=esc_html($object->created_by);
							$created_date=$object->created_date;
							$category=esc_html($object->category);
							$count_item++;
						?>								
						<tr>
							<td>
								<input id="delete_check_id_<?php echo $id; ?>" class="mmursp_delete_check_class" type="checkbox" name="delete_check[]" onclick="mmursp_each_check(<?php echo $id; ?>)" value="<?php echo $id; ?>">								
							<a href="<?php echo admin_url('admin.php?page=mmursp-list&view=edit&mmursp_id='.$id); ?>"><?php echo $regular_expression; ?></a></td>
							<td><a href="<?php echo admin_url('admin.php?page=mmursp-list&view=edit&mmursp_id='.$id); ?>"><?php echo $page_or_post_slug; ?></a></td>
							<td><a href="<?php echo admin_url('admin.php?page=mmursp-list&view=edit&mmursp_id='.$id); ?>"><?php echo ucwords(str_replace('-', ' ', $category)); ?></a></td>
							<td><a href="<?php echo admin_url('admin.php?page=mmursp-list&view=edit&mmursp_id='.$id); ?>"><?php echo $created_by; ?></a></td>
							<td><a href="<?php echo admin_url('admin.php?page=mmursp-list&view=edit&mmursp_id='.$id); ?>"><?php echo $created_date; ?></a></td>
							
						</tr>
						<?php	} if($count_item==0){?>
						<tr><td colspan="5" style="text-align:center;">No Url alias found</td></tr>	
						<?php } ?>
				</tbody>
				</div>
				<tfoot>
				  <tr>
					<th>
						<input id="mmursp_root_checkbox_id_bottom" type="checkbox" style="margin-left:0px;margin-right:5px;" value="1" onclick="mmursp_all_check_bottom()">
						<span>Regular Expression</span>
					</th>
					<!-- <th>Title</th> -->
					<th>Slug</th>
					<th>Type</th>
					<th>Created By</th>
					<th>Date</th>
				  </tr>
				</tfoot>
			</table>
			<div class="tablenav bottom" id="tablenavbottom_id">
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label><select name="mmursp_select_action_bottom" id="bulk-action-selector-bottom">
							<option value="-1">Bulk Actions</option>
							<option value="delete" class="hide-if-no-js">Delete</option>
						</select>
					<input type="submit" id="doaction2" class="button action" onclick="mmursp_how_many();" value="Apply">
				</div>
				<div class="tablenav-pages one-page"><span class="displaying-num" id="total_item_bottom_id"></span></div>
				<br class="clear">
			</div>
			<script> 
				var count_item = <?php echo $count_item; ?>;
				if(count_item == 0)
				{
					document.getElementById('tablenavbottom_id').style.display="none";
					document.getElementById('tablenavtop_id').style.display="none";
				}
			</script>
		</form>	
	</div>	
<?php } ?>