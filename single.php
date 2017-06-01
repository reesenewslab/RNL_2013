<?php 
get_header();?>

<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="container-fluid" id="main">
	<div class="row-fluid">
		<div class="span12 content_title">
				<?php 
				the_title('<h1>','</h1>');
				echo '<p class="byline">By ';
				if ( function_exists( 'coauthors_posts_links' ) ) {
				    coauthors_posts_links();
				} else {
				    the_author_posts_link();
				}
				echo '</p>';
				echo '
					<p class="date">
					<span class="month">'.get_the_date('M').'</span>
					<span class="day">'.get_the_date('d').'</span>
					<span class="year">'.get_the_date('Y').'</span>
					</p>';
				?>
		</div>

	</div>

	<div class="row-fluid">
		<div class="span12 content_paragraph">
			<?php
				$display_thumb = get_post_meta(get_the_ID(),'display_thumb');
				if($display_thumb[0] == 'Y'):
					the_post_thumbnail('thumbnail',array('class'=>'pull-right'));
				endif;
				the_content();

				comments_template();
				get_comments();

			?>
		</div>
	</div>
</div>

<?php 
endwhile; 
endif;?>
<section class="repeated-stories black50 text-white">

</section>


<?php get_footer();
?>
