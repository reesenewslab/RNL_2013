<?php

// ADD WIDGET AREA
function rnl_widgets_init() {

  register_sidebar( array(
    'name' => 'Front Page, Span 12',
    'id' => 'front_page_span12',
    'before_widget' => '<section class="section"><div class="container-fluid"><div class="row-fluid">',
    'after_widget' => '</div></div></section>',
    'before_title' => '',
    'after_title' => '',
  ) );

  register_sidebar( array(
    'name' => 'Footer',
    'id' => 'footer',
    'before_widget' => '<div class="footer_widget">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ) );
}
add_action( 'widgets_init', 'rnl_widgets_init' );

?>