<?php 

/*
Template Name: Search Page
*/

get_header();

	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach

	$search = new WP_Query($search_query);
	?>


<div class="container-fluid" id="main">

	<div class="row-fluid">
		<div class="span12 heading">
			<h1 class="white_heading">Search for: <?php the_search_query();?></h1>
		</div>

	</div>
	
<?php
get_template_part('includes/paginate_links');

if( $search->have_posts() ) : while ( $search->have_posts() ) : $search->the_post(); ?>

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
endif; 

get_template_part('includes/paginate_links');
?>

</div>

<?php
get_footer();
?>
