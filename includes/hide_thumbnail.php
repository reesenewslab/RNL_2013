<?php

add_action( 'add_meta_boxes', 'display_thumb_add' );
add_action( 'save_post', 'display_thumb_save' );

function display_thumb_add()
{
	add_meta_box( 'display_thumb', 'Display Thumbnail', 'display_thumb_cb', 'post', 'side', 'high' );
}

function display_thumb_cb( $post )
{
	$values = get_post_custom( $post->ID );
	if($values[display_thumb][0] == 'Y'): $check = 'checked="checked"'; else: $check = ''; endif;
	?>
		<input type="checkbox" name="display_thumb" <?php echo $check;?> value="Y" /> <label for="display_thumb">Show featured image on post</label>
	<?php	
}



function display_thumb_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['display_thumb'] ) )
		if($_POST['display_thumb'] != 'Y'): $val = 'N'; else: $val = 'Y'; endif;
		update_post_meta( $post_id, 'display_thumb', htmlentities( $val ) );
}

// function get_display_thumb( $post_id ){
// 	$meta_values = get_post_meta($post_id,'display_thumb',true);

// 	$text  = '<style type="text/css">';
// 	$text .= html_entity_decode($meta_values);
// 	$text .= '</style>';

// 	return $text;
// }
?>