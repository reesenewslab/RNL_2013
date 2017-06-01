<?php

function weeklyreads_shortcode_2013($atts){
	extract(
		shortcode_atts(
			array(
					'category_slug' 	=> 'blogroll',
					'orderby' 			=> 'link_id',
					'order' 			=> 'DESC',
					'limit'				=> -1,
					'tag'				=> 'h3',
					'list_class'		=> ''
			), $atts
		)
	);

	// GET CATEGORY ID BY SLUG
	$cat = get_term_by('slug',$category_slug,'link_category',ARRAY_A);

	// SET ARGUMENTS FOR GET BOOKMARKS
	$args = array(
		'orderby' 		=> $orderby,
		'order'			=> $order,
		'limit'			=> $limit,
		'category'		=> $cat['term_id']
	); 

	// GET LINKS ARRAYS
	$links 		=		get_bookmarks($args);

	$display .= '</div></div>';
	foreach($links as $link):

		$display 	 .= '<div class="row-fluid"><div class="span12 content_paragraph">';
			$display .= '<'.$tag.'>';
			$display .= '<a href="'.$link->link_url.'" target="_blank">';
			$display .= $link->link_name;
			$display .= '</a>';
			$display .= '</'.$tag.'>';
			if($link->link_description)
				$display .= '<p>'.$link->link_description.'</p>';
		$display 	 .= "</div></div>";
	endforeach;

	return $display;

}

add_shortcode( 'weeklyreads', 'weeklyreads_shortcode2013' );

?>
