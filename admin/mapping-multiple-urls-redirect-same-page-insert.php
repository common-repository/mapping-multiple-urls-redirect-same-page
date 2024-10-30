<?php
defined('ABSPATH') or die("restricted access");
function mmursp_insert()
{
	global $current_user;
	if(!mmursp_check_current_user_level())
		{
			wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
		}
	$current_user_details=wp_get_current_user();
?>
	<div class="wrap">
		<?php if(isset($_GET['mmursp_in_msg']) && $_GET['mmursp_in_msg']=="error"){?><h3 style="color:red;	">Already you have created the link for this page try another !!</h1><?php }?>
        <h1>Check the follwing settings</h1>
       <p>If you have any type of query releted to make a regular expression then please contact with query to <b><a href="mailto:rupamhazra@gmail.com">rupamhazra@gmail.com</a></b></p>
       <p><b>If this plugin is usefull for you then please rate it <a href="https://wordpress.org/plugins/mapping-multiple-urls-redirect-same-page/">here</a>.</b></p>
        <form name="insert_form" method="post" action="<?php echo get_admin_url().'admin-post.php'; ?>" onsubmit="return mmursp_insert_valid_check()" novalidate>    
			<?php wp_nonce_field( 'mmursp_in_verify' ); ?>
            <input type="hidden" name="action" value="mmursp-submit-insert-form-data" />  
             
             <input type="hidden" name="page_or_post_slug" id="page_or_post_slug" value="" />
             <input type="hidden" name="page_or_post_title" id="page_or_post_title" value="" />
             <input type="hidden" name="page_or_post_id" id="page_or_post_id" value="" />
             <input type="hidden" name="post_of_custom_post_type" id="post_of_custom_post_type" value="" />
             <input type="hidden" name="current_user_name" id="current_user_name" value="<?php echo $current_user_details->display_name; ?>" />
             <input type="hidden" name="created_date" id="created_date" value="<?php echo current_time( 'mysql'); ?>" />
             <p>
             	<label class="input_label" id="" for="title" style="margin-left: 27px;">RegularExpression : </label>
             	<input type="text" name="regular_expression" pattern="^([\w0-9\.\-])+\@(([a-zA-Z0-9\-])+\.)+[a-zA-Z]{2,4}$" id="regular_expression" style="width:80%;height: 35px;" required>
             </p>
            <p>
				<label class="input_label" id="" for="title" style="    margin-left: 79px;">Select Type : </label>
				<select name="cat_name" id="cat_name" style="width:80%;height: 35px;"onchange="mmursp_check_options();">
					<option value="page" selected>Page</option>
					<option value="post">Post</option>
					<option value="custom-post-types">Custom Post Types</option>
					<option value="category">Category</option>	
					<option value="tag">Tag</option>	
				</select>
			</p> 
			<div id="select_page_div">
				<p>
					<label class="input_label" id="" for="title" style="margin-left: 78px;">Select Page : </label>
					<select name="page_id" id="page_id" style="width:80%;height: 35px;" onchange="mmursp_select_page_name();"> 
						<option value="-1"><?php echo esc_attr( __( 'Select page' ) ); ?></option> 
							<?php 
							  $pages = get_pages(); 
							  
							  foreach ( $pages as $page ) 
							  {
							  	$option = '<option value="' . $page->ID . '" slug="'.urldecode($page->post_name).'">';
								$option .= $page->post_title.' ('.urldecode($page->post_name).')';
								$option .= '</option>';
								echo $option;
							  }
					 		?>
					</select>
				</p>
			</div>
			<div id="select_post_div" style="display:none;">
				<p>
					<label class="input_label" id="" for="title" style="margin-left: 78px;">Select Post : </label>
					<select name="post_id" id="post_id" style="width:80%;height: 35px;" onchange="mmursp_select_post_name();"> 
						<option value="-1"><?php echo esc_attr( __( 'Select post' ) ); ?></option> 
					 	<?php 
					 		  $posts_array=new WP_Query(array( 'posts_per_page' => -1 ,'order_by'=>'ID'));
					 		 
							  //$pages1 = query_posts( $args );
							  foreach ( $posts_array->posts as $post ) 
							  {
							  	$option = '<option value="' . $post->ID . '" slug="'.urldecode($post->post_name).'">';
								$option .= $post->post_title.' ('.urldecode($post->post_name).')';
								$option .= '</option>';
								echo $option;
								
							  }
					 	?>
					</select>
				</p>
			</div>
			<div id="select_category_div" style="display:none;">
				<p>
					<label class="input_label" id="" for="title" style="margin-left: 47px;">Select Category : </label>
					<select name="category_id" id="category_id" style="width:80%;height: 35px;" onchange="mmursp_select_category_name();"> 
						<option value="-1"><?php echo esc_attr( __( 'Select category' ) ); ?></option> 
					 	<?php  
							$category_list = $terms = get_terms( array(
																	    'taxonomy' => 'category',
																	    'hide_empty' => false,
																	) );
							foreach ( $category_list as $category ) 
							{
							  	$option = '<option value="' . $category->term_id . '" slug="'.urldecode($category->slug).'">';
								$option .= urldecode($category->name).' ('.urldecode($category->slug).')';
								$option .= '</option>';
								echo $option;
							}
					 	?>
					</select>
				</p>

			</div>
			<div id="select_tag_div" style="display:none;">
				<p>
					<label class="input_label" id="" for="title" style="margin-left: 88px;">Select Tag : </label>
					<select name="tag_id" id="tag_id" style="width:80%;height: 35px;" onchange="mmursp_select_tag_name();"> 
						<option value="-1"><?php echo esc_attr( __( 'Select Tag' ) ); ?></option> 
					 	<?php  
							$tag_list = $terms = get_terms( array(
																	    'taxonomy' => 'post_tag',
																	    'hide_empty' => false,
																	) );
							foreach ( $tag_list as $tag ) 
							{
							  	$option = '<option value="' . $tag->term_id . '" slug="'.urldecode($tag->slug).'">';
								$option .= urldecode($tag->name).' ('.urldecode($tag->slug).')';
								$option .= '</option>';
								echo $option;
							}
					 	?>
					</select>
				</p>
			</div>
			<div id="select_custom_post_types_div" style="display:none;">
				<p>
					<label class="input_label" id="" for="title" style="margin-left: 25px;">Custom Post Types : </label>
					<select name="custom_post_types_id" id="custom_post_types_id" style="width:80%;height: 35px;" onchange="mmursp_select_custom_post_types();"> 
						
						<option value="-1"><?php echo esc_attr( __( 'Select Custom Post Types' ) ); ?></option> 
					 	<?php  
					 		$args = array(
										   'public'   => true,
										   '_builtin' => false
										);
							$custom_post_types_list = get_post_types($args);
							//print_r($custom_post_types_list);
							//echo "1234";
							$cnt=0;
							foreach ( $custom_post_types_list as $custom_post_types=>$value ) 
							{
								$cnt++;
							  	$option = '<option value="' . $cnt . '" slug="'.urldecode($value).'">';
								$option .= $value;
								$option .= '</option>';
								echo $option;
							}
					 	?>
					</select>
				</p>

			</div>
			<div id="checked_post_type_div" style="display:none;">
				<p><input type="checkbox" name="checked_post_type_value" id="checked_post_type_value" style="margin-left: 184px;" onclick="mmursp_custom_post_type_open();">Check if you want to select post of custom post</p>
			</div>
			<div id="select_custom_post_types_value_div" style="display:none;">
				<p>
					<label class="input_label" id="" for="title" style="margin-left: 15px;">Post of Custom Post : </label>
					<select name="value_of_custom_post_types_id" id="value_of_custom_post_types_id" style="width:80%;height: 35px;" onchange="mmursp_select_custom_post_types_name();"> 
					</select>
				</p>

			</div>
			<div style="width: 38%;padding: 30px;text-align:center;">
				<input type="submit" class="button button-primary button-large" name="Submit" value="Save Settings" />
			</div>
			<div>
				<div style="float: left;">
					<h3>Regex quick reference</h3>
					<div style="float: left;">
						<p>[abc]     A single character: a, b or c</p>
						<p>[^abc]     Any single character but a, b, or c</p>
						<p>[a-z]     Any single character in the range a-z</p>
						<p>[a-zA-Z]     Any single character in the range a-z or A-Z</p>
						<p>^     Start of line</p>
						<p>$     End of line</p>
						<p>\A     Start of string</p>
						<p>\z     End of string</p>
						<p>.     Any single character</p>
						<p>\s     Any whitespace character</p>
						<p>\S     Any non-whitespace character</p>
						<p>\d     Any digit</p>
						
					</div>	
					<div style="float: left;margin-left: 20px;">
						<p>\D     Any non-digit</p>
						<p>\w     Any word character (letter, number, underscore)</p>
						<p>\W     Any non-word character</p>
						<p>\b     Any word boundary character</p>
						<p>(...)     Capture everything enclosed</p>
						<p>(a|b)     a or b</p>
						<p>a?     Zero or one of a</p>
						<p>a*     Zero or more of a</p>
						<p>a+     One or more of a</p>
						<p>a{3}     Exactly 3 of a</p>
						<p>a{3,}     3 or more of a</p>
						<p>a{3,6}     Between 3 and 6 of a</p>
					</div>
				</div>
				<div style="float: left;margin-left: 30px;">
					<h3>Some sample link according to regular expression</h3>
					<div style="float:left">
						<strong>Expression</strong>
						<p><b>^site/link.*$</b></p>
						<p><b>^link.*$</b></p>
						<p><b>^link$</b></p>
						<p><b>^leaf/([0-9]+)/?</b></p>
						<p><b>^leaf/([a-zA-z]+)/?</b></p>
						
					</div>
					<div style="float:left;margin-left: 20px;">
						<strong>Link</strong>
						<p><?php echo get_site_url(); ?>/site/link1 or link2 or link or linkwerrr</p>
						<p><?php echo get_site_url(); ?>/link1 or link2</p>
						<p><?php echo get_site_url(); ?>/link</p>
						<p><?php echo get_site_url(); ?>/leaf/any number</p>
						<p><?php echo get_site_url(); ?>/leaf/any letter</p>
					</div>
					
				</div>
			</div>	
        </form>
    </div>
<?php }?>