<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
	<!-- <?php echo $_SERVER['HTTP_USER_AGENT']; ?>-->
    <?php wp_head();?>
    <title><?php bloginfo('name'); if(!is_front_page()){echo ' | ' . get_the_title();}?></title> 
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <?php $options = get_option("theme_" . upfw_get_current_theme_id() . "_options");?>
      <style>
        body{
          background: url("<?php echo $options['theme_background_image'];?>") fixed center top #111 no-repeat;
        }

	@media (orientation: landscape){
		body{background-size: 100% auto;}
	}
	@media (orientation: portrait){
		body{background-size: auto 100%;}
	}
      </style>

      <?php if(is_admin_bar_showing()){ ?>
        <style>.navbar-fixed-top{top: 25px;}</style>
      <?php }?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url" content="http://<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ?>"  />
    <meta property="og:site_name" content="<?php echo get_bloginfo('name');?>" />
    <meta property="og:site_title" content="<?php echo get_bloginfo('name');?>" />
    <meta property="og:description" content="<?php echo $options['meta_description'];?>" />
    <meta property="og:image" content="<?php echo theme_options('theme_meta_photo');?>" />
    <?php if (is_page()) { ?>
        <meta property="og:title" content="<?php single_post_title(''); ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:image" content="<?php if (get_the_post_thumbnail($post->ID)) $thumbn =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium'); echo $thumbn[0]; ?>" />
    <?php } ?>

    <?php if (is_single()) { ?>
        <meta property="og:title" content="<?php single_post_title(''); ?>" />
        <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:image" content="<?php if (get_the_post_thumbnail($post->ID)) $thumbn =  wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium'); echo $thumbn[0]; ?>" />
    <?php } ?>
<?php if(preg_match('/(?i)MSIE [1-8]/',$_SERVER['HTTP_USER_AGENT'])): ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie.css" />
	<script>
  	for(var e,l='article aside footer header nav section time /article /aside /footer /header /nav /section /time'.split(' ');e=l.pop();document.createElement(e))
	</script>
<?php endif;?>
  
  </head>
   <body data-spy="scroll" data-target="#sidebar">
   <!--Google analytics -->
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90895238-1', 'auto');
  ga('send', 'pageview');

</script>

    <?php //get_template_part('includes/sidebar');?>
    <?php front_menu();?>
    
    <div id="wrapper">
      <?php get_template_part('navigation');?>
      <div id="container-fluid">
        
        <?php get_template_part('includes/header');?>
        

        
