<?php 

add_filter('xmlrpc_enabled', '__return_false');

/* THEME OPTIONS PAGE */

    /**  Bootstrap the Theme Options Framework  **/
      if( file_exists(get_template_directory().'/options/options.php') )
        include_once(get_template_directory().'/options/options.php');

    /**  Set up General Options **/
      if( file_exists(get_template_directory().'/theme-options.php') )
        include_once(get_template_directory().'/theme-options.php');

/* FUNCTIONS */
add_theme_support( 'post-thumbnails' ); 

// INCLUDES
include(get_template_directory().'/includes/settings_stylesheets.php');
include(get_template_directory().'/includes/settings_scripts.php');
include(get_template_directory().'/includes/settings_functions.php');
include(get_template_directory().'/includes/settings_widget.php');
include(get_template_directory().'/includes/settings_menu.php');
include(get_template_directory().'/includes/widget_three-col.php');
include(get_template_directory().'/includes/widget_three-col-recent-posts.php');
include(get_template_directory().'/includes/hide_thumbnail.php');
include(get_template_directory().'/includes/weekly_reads.php');

/*
 add_action('wp_head', 'show_template');
 function show_template() {
   global $template;
   print_r($template);
 }*/


// ADDITIONAL FUNCTIONS
// function get_all_blogs(){
//   global $wpdb;
//   $blogs = array();
//   $query = "SELECT blog_id FROM wp_blogs ORDER BY blog_id";  
//   $result = $wpdb->get_results($query);
//   if($result){
//     foreach ($result as $key => $row) {
//         $id = $row->blog_id;
//         $blogs[$id] = get_blog_details($id);
//     }
//   }
//   return $blogs;
// }

function rgb2hex($rgba){
	$rgba = str_replace('rgba(','',$rgba);	// remove RGBA beginning
	$rgba = str_replace(')','',$rgba);		// remove RGBA end
	$rgba = explode(',',$rgba);

	$hex[color]  = '#';
	$hex[color] .= dechex($rgba[0]);
	$hex[color] .= dechex($rgba[1]);
	$hex[color] .= dechex($rgba[2]);

	$hex[opacity] = $rgba[3] * 100;

	return $hex;
}