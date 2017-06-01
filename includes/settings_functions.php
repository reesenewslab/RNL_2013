<?php



// GET THEME SETTINGS
function theme_options($var){
  $theme_id = "theme_" . upfw_get_current_theme_id() . "_options";
  $options = get_option($theme_id);

  if($var == 'theme_cover_story'){
    $options[$var] = explode(':',$options[$var]);
  }

  return $options[$var];
}

// SPLIT FRONT MENU
function front_menu(){
  $options = get_option("theme_" . upfw_get_current_theme_id() . "_options");
  if(is_home())   $front_menu = $options['front_menu'];
  else            $front_menu = $options['inner_menu'];

  $front_menu = preg_split ('/$\R?^/m',$front_menu);

  $display = '<ul class="nav">';
  $display .= '<li class="expand_contract"><i class="icon-2x txt-blue4 icon-chevron-right icon-white"></i></li>';
  foreach($front_menu as $f):
    $a   = explode(',',$f);

    $display .= '<li><a href="'.$a[0].'"><i class="txt-blue3 '.$a[1].'"></i><span>'.$a[2].'</span></a></li>';

  endforeach;
  $display .= '</ul>';
  
  return $display;
}

// SPLIT SOCIAL MEDIA
function social_media(){
  $options          = get_option("theme_" . upfw_get_current_theme_id() . "_options");
  $social_media     = $options['social_media'];
  $social_media     = preg_split ('/$\R?^/m',$social_media);

  $display  = '<div class="social-media">';

  foreach($social_media as $s){
    $SM = explode(',',$s);
    $display .= '<a href="'.$SM[0].'"><i class="btn '.$SM[1].' txt-blue2 icon-2x" alt="'.$SM[2].'"></i></a>';
  }

  $display .= '</div>';

  return $display;
}

// GET EXCERPT BY ID
function get_excerpt_by_post_array($array,$length,$continuation){
  $excerpt = $array->post_excerpt;
  $content = strip_tags($array->post_content);
  $content = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content);

  if($excerpt == ''):
    $excerpt = substr($content,0,$length).$continuation;
  endif;

  return $excerpt;
}

function num_widgets($sidebar){
  $widgets  = wp_get_sidebars_widgets();
  $num      = count($widgets[$sidebar]);

  $span     = 12;

  $span_num = floor($span/$num);
  return $span_num;
}

?>