<!-- BEGIN LOGO CONTAINER -->
<header>
  <div class="container-fluid" id="head"> 
    <div class="row-fluid">
      <div class="span12">
        <?php echo social_media();?>

        <!-- LOGO -->
	<?php if(theme_options('theme_organization') != ''): ?>
        <p class="organization"><?php echo theme_options('theme_organization');?></p>
	<?php endif;?>
	<a href="<?php echo home_url();?>">
        <img class="logo" src="<?php echo theme_options('theme_logo');?>" alt="Reese News Lab"/>
        </a>
        <span class="tagline"><?php echo get_bloginfo('description');?></span>
        <!-- END LOGO -->

      </div>
    </div>
  </div>
</header>
<!-- END LOGO CONTAINER -->

