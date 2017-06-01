<?php

function theme_styles()  
{ 
  wp_register_style( 
  	'wordpress-core', 
    get_template_directory_uri() . '/css/wordpress_core.css', 
    array(), 
    '20130604', 
    'all' );

  wp_register_style( 
  	'bootstrap', 
    get_template_directory_uri() . '/css/bootstrap.css', 
    array(), 
    '20130604', 
    'all' );

  wp_register_style( 
  	'bootstrap-responsive', 
    get_template_directory_uri() . '/css/bootstrap-responsive.css', 
    array('bootstrap'), 
    '20130604', 
    'all' );

   wp_register_style( 
  	'custom', 
    get_template_directory_uri() . '/css/style.css', 
    array(), 
    '20130617', 
    'all' );

  wp_register_style( 
    'icons', 
    get_template_directory_uri() . '/css/font-awesome.css', 
    array('no-icons'), 
    '20130604', 
    'all' );


  wp_register_style( 
    'no-icons', 
    'http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css', 
    array(), 
    '20130604', 
    'all' );

  wp_enqueue_style( 'wordpress-core' );
  wp_enqueue_style( 'bootstrap' );
  wp_enqueue_style( 'bootstrap-responsive' );
  wp_enqueue_style( 'custom' );
  wp_enqueue_style( 'no-icons' );
  wp_enqueue_style( 'icons' );
}

add_action('wp_enqueue_scripts', 'theme_styles');

?>
