<?php
/**
 * Example Widget Class
 */
class three_column_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function three_column_widget() {
        $widget_ops		=	array('description'=>'Supply an image, description, title and link for three columns.');
        parent::WP_Widget('three_column_widget','Three Column, Custom Fields',$widget_ops);		
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
    	extract( $args );

   		$num_cols = 3;
   		// echo $before_widget;
   		echo '<section id="'.$instance['id'].'" class="section projects '.$instance['text_color'].'" style="';
		if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') !== false):
			$hex = rgb2hex($instance['background_color']);
			echo 'background-color: '.$hex[color].'; filter: alpha(opacity='.$hex[opacity].');';
		else:
			echo 'background-color: '.$instance['background_color'];
		endif;
		echo '" data-section="'.$instance['id'].'"><div class="container-fluid">';
   		echo '<div class="row-fluid">';
      	
      	for ($i = 1; $i <= $num_cols; $i++) {
      		echo '<div class="span4">';
            	if($instance['cols'][$i]['url'] != '')		echo '<a target="_blank" href="'.$instance['cols'][$i]['url'].'">';
            	if($instance['cols'][$i]['icon'] != '')		echo '<img src="'.$instance['cols'][$i]['icon'].'" class="project_img"/>';
            	if($instance['cols'][$i]['title'] != '')	echo '<h3>'.$instance['cols'][$i]['title'].'</h3>';
            	if($instance['cols'][$i]['title'] != '')	echo '<p>'.$instance['cols'][$i]['description'].'</p>';
            	if($instance['cols'][$i]['url'] != '')	 	echo '</a>';
          	echo '</div>';
      	}

      	echo '</div>';
      	echo '</div></section>';
      	// echo $after_widget;
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$num_cols = 3;

    if(!isset($instance['id'])) $instance['id'] = rand(1000,9999);
		$instance['background_color'] = $new_instance['background_color'];
		$instance['text_color'] = $new_instance['text_color'];

		for ($i = 1; $i <= $num_cols; $i++) {
			$instance['cols'][$i]['icon'] 			= $new_instance['col_icon_'.$i];
			$instance['cols'][$i]['title'] 			= $new_instance['col_title_'.$i];
			$instance['cols'][$i]['description'] 	= $new_instance['col_description_'.$i];
			$instance['cols'][$i]['url'] 			= $new_instance['col_url_'.$i];
		}


		// $instance = maybe_serialize($instance['cols']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
    	$background = $instance['background_color'];
    	$text_color = $instance['text_color'];
    	?>
    	<h3>Main Widget Options</h3>
    		<p>
	          <label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('CSS background color:<br/>ex. "#333" or "rgba(0,0,0,0.5)"'); ?></label> 
	          <input class="widefat" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" type="text" value="<?php echo $background; ?>" />
	        </p>

	        <p>
	          <label for="<?php echo $this->get_field_id('text_color'); ?>"><?php _e('Text Color'); ?></label> 
	          <select id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>">
	          	<option value="text-white" <?php if($text_color == 'text-white') echo 'selected';?>>Light</option>
	          	<option value="text-black" <?php if($text_color == 'text-black') echo 'selected';?>>Dark</option>
	          </select>
	        </p>
    	<?php

 	$num_cols = 3;

      	for ($i = 1; $i <= $num_cols; $i++) :
      		$col[$i][icon] 				= $instance['cols'][$i][icon];
      		$col[$i][title] 			= $instance['cols'][$i][title];
      		$col[$i][description] 			= $instance['cols'][$i][description];
      		$col[$i][url] 				= $instance['cols'][$i][url];
      	?>
      	<h3>Column <?php echo $i;?></h3>
      	<p>
          <label for="<?php echo $this->get_field_id('col_icon_'.$i); ?>"><?php _e('Icon URL:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('col_icon_'.$i); ?>" name="<?php echo $this->get_field_name('col_icon_'.$i); ?>" type="text" value="<?php echo $col[$i][icon]; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('col_title_'.$i); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('col_title_'.$i); ?>" name="<?php echo $this->get_field_name('col_title_'.$i); ?>" type="text" value="<?php echo $col[$i][title]; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('col_description_'.$i); ?>"><?php _e('Description:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('col_description_'.$i); ?>" name="<?php echo $this->get_field_name('col_description_'.$i); ?>" type="text" value="<?php echo $col[$i][description]; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('col_url_'.$i); ?>"><?php _e('URL:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('col_url_'.$i); ?>" name="<?php echo $this->get_field_name('col_url_'.$i); ?>" type="text" value="<?php echo $col[$i][url]; ?>" />
        </p>
        <?php
      	endfor;
        ?>
        
        <?php 
    }
 
 
} // end class three_column_widget
add_action('widgets_init', create_function('', 'return register_widget("three_column_widget");'));
?>
