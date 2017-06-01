<?php
function load_rnl_scripts()  
{ 
  wp_register_script( 
  	'bootstrap', 
    get_template_directory_uri() . '/js/bootstrap.js', 
    array('jquery'), 
    '20130604', 
    'all' ); 

  wp_register_script( 
  	'custom', 
    get_template_directory_uri() . '/js/custom.js', 
    array('jquery'), 
    '20130604', 
    'all' ); 

  wp_enqueue_script('bootstrap');
  wp_enqueue_script('custom');

}

add_action('wp_enqueue_scripts', 'load_rnl_scripts');
?>