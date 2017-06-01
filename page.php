<?php 
get_header();

if( have_posts() ) : while ( have_posts() ) : the_post();?>
<div class="container-fluid" id="main">
	<div class="row-fluid">
		<div class="span12 heading">
			<?php the_title('<h1 class="white_heading">','</h1>');?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12 content_paragraph">
			<?php 
				the_content(); 
			?>
		</div>
	</div>
</div>

<?php
endwhile; 
endif;

get_footer();
?>