<?php 
	$info = theme_options('theme_cover_story');
	$blog_num 	=	$info[0];
	$story_id 	=	$info[1];

	//if($blog_num != get_current_blog_id()): switch_to_blog($blog_num); endif;
	$query = new WP_Query('p='.$story_id);
	while($query->have_posts()) : $query->the_post(); ?>
	<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>

	<section class="section" id="intro" data-section="intro">
          <div class="container-fluid"> 
            <div class="row-fluid" id="top-story-container">
              <div class="span6">
                <hgroup>
                  <h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
                  <h3><?php echo get_the_excerpt();?></h3>
                </hgroup>
                <a href="<?php echo get_permalink();?>" class="btn btn-inverse">
                  Learn More
                </a>

                <?php $category = get_the_category(); ?>
                <a href="<?php echo get_category_link($category[0]->term_id);?>" class="btn btn-inverse">
                  <?php echo $category[0]->name;?><i class="icon-chevron-right"></i>
                </a>

              </div>
              <div class="span6"> 
                <img src="<?php echo $url;?>" id="top-story-image"/>
              </div>
	    </div>
          </div>
        </section>
	<?php 
	endwhile;


	//if($blog_num != get_current_blog_id()): restore_current_blog(); endif;
	?>
