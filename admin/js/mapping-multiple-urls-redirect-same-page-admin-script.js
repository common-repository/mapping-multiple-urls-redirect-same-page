function mmursp_check_options()
{
	document.getElementById('page_or_post_slug').value="";
	document.getElementById('page_or_post_title').value="";
	document.getElementById('page_or_post_id').value="";
	document.getElementById('post_of_custom_post_type').value="";
	if(document.getElementById('cat_name').value=="page"){
		document.getElementById('select_page_div').style.display="block";
		document.getElementById('select_post_div').style.display="none";
		document.getElementById('select_category_div').style.display="none";
		document.getElementById('select_tag_div').style.display="none";
		document.getElementById('select_custom_post_types_div').style.display="none"; 
		document.getElementById('select_custom_post_types_value_div').style.display="none";
		document.getElementById('checked_post_type_div').style.display="none";
		document.getElementById('checked_post_type_value').checked=false;	
	}
	else if(document.getElementById('cat_name').value=="post"){
		document.getElementById('select_post_div').style.display="block";
		document.getElementById('select_page_div').style.display="none";
		document.getElementById('select_category_div').style.display="none";
		document.getElementById('select_tag_div').style.display="none";
		document.getElementById('select_custom_post_types_div').style.display="none"; 
		document.getElementById('select_custom_post_types_value_div').style.display="none";
		document.getElementById('checked_post_type_div').style.display="none";
		document.getElementById('checked_post_type_value').checked=false;
	}
	else if(document.getElementById('cat_name').value=="category"){
		document.getElementById('select_category_div').style.display="block";
		document.getElementById('select_post_div').style.display="none";
		document.getElementById('select_page_div').style.display="none";
		document.getElementById('select_tag_div').style.display="none";
		document.getElementById('select_custom_post_types_div').style.display="none";
		document.getElementById('select_custom_post_types_value_div').style.display="none";
		document.getElementById('checked_post_type_div').style.display="none";
		document.getElementById('checked_post_type_value').checked=false;
	}
	else if(document.getElementById('cat_name').value=="tag"){
		document.getElementById('select_tag_div').style.display="block";
		document.getElementById('select_category_div').style.display="none";
		document.getElementById('select_post_div').style.display="none";
		document.getElementById('select_page_div').style.display="none";
		document.getElementById('select_custom_post_types_div').style.display="none";
		document.getElementById('select_custom_post_types_value_div').style.display="none";
		document.getElementById('checked_post_type_div').style.display="none";
		document.getElementById('checked_post_type_value').checked=false;
	}
	else if(document.getElementById('cat_name').value=="custom-post-types"){
		document.getElementById('select_custom_post_types_div').style.display="block";
		document.getElementById('select_tag_div').style.display="none";
		document.getElementById('select_category_div').style.display="none";
		document.getElementById('select_post_div').style.display="none";
		document.getElementById('select_page_div').style.display="none";
		document.getElementById('checked_post_type_div').style.display="block";
	}
}
function mmursp_insert_valid_check(){
	if(document.getElementById('regular_expression').value==""){
		document.getElementById('regular_expression').style.border="1px solid #dc8a8a"; 
		return false;
	}
	if(document.getElementById('cat_name').value=="page"){
		if(document.getElementById('page_id').value==-1 ){
		document.getElementById('page_id').style.border="1px solid #dc8a8a"; 
		return false;
		}
	}
	if(document.getElementById('cat_name').value=="post"){
		if(document.getElementById('post_id').value==-1){
		document.getElementById('post_id').style.border="1px solid #dc8a8a"; 
		return false;
		}
	}	
	if(document.getElementById('cat_name').value=="category"){
		if(document.getElementById('category_id').value==-1){
		document.getElementById('category_id').style.border="1px solid #dc8a8a"; 
		return false;
		}
	}	
	if(document.getElementById('cat_name').value=="tag"){
		if(document.getElementById('tag_id').value==-1){
		document.getElementById('tag_id').style.border="1px solid #dc8a8a"; 
		return false;
		}
	}
	if(document.getElementById('cat_name').value=="custom-post-types"){
		if(document.getElementById('custom_post_types_id').value==-1){
		document.getElementById('custom_post_types_id').style.border="1px solid #dc8a8a"; 
		return false;
		}
	}
	if(document.getElementById('checked_post_type_value').checked==true){
		if(document.getElementById('value_of_custom_post_types_id').value==-1){
		document.getElementById('value_of_custom_post_types_id').style.border="1px solid #dc8a8a"; 
		return false;
		}
	}	
}
function mmursp_select_page_name(){
	var select_id = document.getElementById("page_id");
	var page_name = select_id.options[select_id.selectedIndex].text
	var page_slug = select_id.options[select_id.selectedIndex].getAttribute('slug');
	var option_id = document.getElementById("page_id").value;
	document.getElementById('page_or_post_slug').value=page_slug;
	document.getElementById('page_or_post_title').value=page_name;
	document.getElementById('page_or_post_id').value=option_id;
}
function mmursp_select_post_name(){
	var select_id = document.getElementById("post_id");
	var post_name = select_id.options[select_id.selectedIndex].text
	var post_slug = select_id.options[select_id.selectedIndex].getAttribute('slug');
	var option_id = document.getElementById("post_id").value;
	document.getElementById('page_or_post_slug').value=post_slug;
	document.getElementById('page_or_post_title').value=post_name;
	document.getElementById('page_or_post_id').value=option_id;
}
function mmursp_select_category_name(){
	var select_id = document.getElementById("category_id");
	var cat_name = select_id.options[select_id.selectedIndex].text
	var cat_slug = select_id.options[select_id.selectedIndex].getAttribute('slug');
	var option_id = document.getElementById("category_id").value;
	document.getElementById('page_or_post_title').value=cat_name;
	document.getElementById('page_or_post_slug').value=cat_slug;
	document.getElementById('page_or_post_id').value=option_id;
}
function mmursp_select_tag_name(){
	var select_id = document.getElementById("tag_id");
	var tag_name = select_id.options[select_id.selectedIndex].text
	var tag_slug = select_id.options[select_id.selectedIndex].getAttribute('slug');
	var option_id = document.getElementById("tag_id").value;
	document.getElementById('page_or_post_title').value=tag_name;
	document.getElementById('page_or_post_slug').value=tag_slug;
	document.getElementById('page_or_post_id').value=option_id;
}
function mmursp_select_custom_post_types(checked_type=''){
	var select_id = document.getElementById("custom_post_types_id");
	var custom_post_types_name = select_id.options[select_id.selectedIndex].text
	var custom_post_types_slug = select_id.options[select_id.selectedIndex].getAttribute('slug');
	var option_id = document.getElementById("custom_post_types_id").value;

	document.getElementById('post_of_custom_post_type').value=custom_post_types_name;

	// document.getElementById('page_or_post_title').value=custom_post_types_name;
	// document.getElementById('page_or_post_slug').value=custom_post_types_slug;
	// document.getElementById('page_or_post_id').value=option_id;
	document.getElementById('checked_post_type_div').style.display="block";
	if(checked_type!=""){document.getElementById('post_of_custom_post_type').value=checked_type;}
	jQuery(document).ready(function($) {
		var data = {
			'action': 'mmursp_fetch_post_of_custom_post_types',
			'whatever': custom_post_types_name,
			'select_post':checked_type
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			var htmloption="<option value=-1>Select Post Of Custom Post</option>";
			jQuery('#value_of_custom_post_types_id').html(htmloption+response);
			var custom_post_select_id = document.getElementById("value_of_custom_post_types_id");
			var custom_post_name = custom_post_select_id.options[custom_post_select_id.selectedIndex].text
			var custom_post_option_id = document.getElementById("value_of_custom_post_types_id").value;
			var custom_post_slug = custom_post_select_id.options[custom_post_select_id.selectedIndex].getAttribute('slug');
			document.getElementById('page_or_post_title').value=custom_post_name;
			document.getElementById('page_or_post_slug').value=custom_post_slug;
			document.getElementById('page_or_post_id').value=custom_post_option_id;
		});
	});
}
function mmursp_custom_post_type_open(check_post_type=''){																																																																																																																																																																																																																																																																																																																																																																																																																																																														;
	if(document.getElementById('checked_post_type_value').checked==true)
	{
		var select_id = document.getElementById("custom_post_types_id");
		var custom_post_types_name = select_id.options[select_id.selectedIndex].text
		jQuery(document).ready(function($) {
		var data = {
			'action': 'mmursp_fetch_post_of_custom_post_types',
			'whatever': custom_post_types_name
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			var htmloption="<option value=-1>Select Post Of Custom Post</option>";
			jQuery('#value_of_custom_post_types_id').html(htmloption+response);
		});
	});
		document.getElementById('select_custom_post_types_value_div').style.display="block";
	}
	else
	{
		document.getElementById('select_custom_post_types_value_div').style.display="none";
		document.getElementById('value_of_custom_post_types_id').value='';
		document.getElementById('post_of_custom_post_type').value='';
	}
}
function mmursp_select_custom_post_types_name(){
	var select_id = document.getElementById("value_of_custom_post_types_id");
	var custom_post_name = select_id.options[select_id.selectedIndex].text
	var option_id = document.getElementById("value_of_custom_post_types_id").value;
	
	var custom_post_slug = select_id.options[select_id.selectedIndex].getAttribute('slug');
	document.getElementById('page_or_post_title').value=custom_post_name;
	document.getElementById('page_or_post_slug').value=custom_post_slug;
	document.getElementById('page_or_post_id').value=option_id;

	var post_type_select_id = document.getElementById("custom_post_types_id");
	var custom_post_types_name = post_type_select_id.options[post_type_select_id.selectedIndex].text
	document.getElementById('post_of_custom_post_type').value=custom_post_types_name;

}
function mmursp_how_many(){
	var checkedValue = ""; 
	var inputElements = document.getElementsByClassName('mmursp_delete_check_class');
	for(var i=0; inputElements[i]; ++i)
	{
      	if(inputElements[i].checked)
      	{
           checkedValue += inputElements[i].value +",";
      	}
	}
	document.getElementById('mmursp_id').value=checkedValue;
	document.getElementById("mmursp_deleteForm").submit();
}
function mmursp_all_check_top(){
	if(document.getElementById('mmursp_root_checkbox_id_top').checked==true)
	{
		document.getElementById('mmursp_root_checkbox_id_bottom').checked=true;
		var inputElements = document.getElementsByClassName('mmursp_delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
		}
	}
	else
	{
		document.getElementById('mmursp_root_checkbox_id_bottom').checked=false;
		var inputElements = document.getElementsByClassName('mmursp_delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=false;
		}
	}
}
function mmursp_all_check_bottom(){
	if(document.getElementById('mmursp_root_checkbox_id_bottom').checked==true)
	{
		document.getElementById('mmursp_root_checkbox_id_top').checked=true;
		var inputElements = document.getElementsByClassName('mmursp_delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
		}
	}
	else
	{
		document.getElementById('mmursp_root_checkbox_id_top').checked=false;
		var inputElements = document.getElementsByClassName('mmursp_delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=false;
		}
	}
}
function mmursp_each_check(which_id){
	var inputElements = document.getElementsByClassName('mmursp_delete_check_class');
	if(document.getElementById('mmursp_root_checkbox_id_top').checked==true || document.getElementById('mmursp_root_checkbox_id_bottom').checked==true)
	{
		document.getElementById('mmursp_root_checkbox_id_top').checked=false;
		document.getElementById('mmursp_root_checkbox_id_bottom').checked=false;
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
			if(inputElements[i].value==which_id)
			{
				inputElements[i].checked=false;
			}		
		}
	}
}
