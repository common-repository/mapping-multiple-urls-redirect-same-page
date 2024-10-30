<?php
defined('ABSPATH') or die("restricted access");
  if ( isset( $_GET['mmursp_in_msg'] ) && $_GET['mmursp_in_msg'] == 'suc' )
  {
	  echo "<div id='message' class='updated notice notice-success'><p>New Url alias has been created.</p></div>";
  }
  if ( isset( $_GET['mmursp_ed_msg'] ) && $_GET['mmursp_ed_msg'] == 'suc' )
  {
	  echo "<div id='message' class='updated notice notice-success'><p>Url alias has been updated</p></div>";
  }
  if ( isset( $_GET['mmursp_dl_msg'] ) && $_GET['mmursp_dl_msg'] == 'suc' )
  {
	  echo "<div id='message' class='updated notice notice-success'><p>Url alias has been deleted.</p></div>";
  }