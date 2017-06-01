<?php 
get_header();?>

<div class="container-fluid" id="main">

<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>


	<div class="row-fluid">
		<div class="span12 content_paragraph archive">
			<?php
				$display_thumb = get_post_meta(get_the_ID(),'display_thumb');
					the_post_thumbnail('thumbnail',array('class'=>'pull-right'));
				the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
				echo 
					'<p class="date">
					<span class="month">'.get_the_date('M').'</span>
					<span class="day">'.get_the_date('d').'</span>
					<span class="year">'.get_the_date('Y').'</span>
					</p>';
				
				the_excerpt();

				comments_template();
				get_comments();

			?>
		</div>
	</div>


<?php 
endwhile; 
endif; ?>

</div>

<?php
get_footer();
?>