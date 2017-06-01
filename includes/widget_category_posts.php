<?php
/**
 * Example Widget Class
 */
class CategoryPostsWidget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function CategoryPostsWidget() {
    	$widget_ops		=	array('description'=>'Displays a widget with recent posts from a speicifed category with excerpts.');
        parent::WP_Widget('CategoryPostsWidget','Category Posts with Excerpts',$widget_ops);	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        $ID = get_the_ID();
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $category 	= $instance['cat'];
        $num_posts 	= $instance['num_posts'];

        if(is_single()){
          $tags = wp_get_post_tags($ID);
          foreach($tags as $tag){
            $new_tags[] = $tag->term_id;
          }
          if(isset($new_tags)):
          $new_tags = implode(',',$new_tags); endif;
        }
        
        // GET POSTS FROM CATEGORY
        $args 		= array('numberposts'=>$num_posts, 'category' => $category, 'orderby' => 'rand');
        if(isset($new_tags)){$args['tag'] = $new_tags;}
        $posts 		= get_posts($args);
        if(count($posts) == 0){
          unset($args['tag']);
          $posts    = get_posts($args);}
        

        // DISPLAY
        $widget 		 =	$before_widget; 
        if($title)
        $widget 		.=	$before_title.$title.$after_title;
    	$widget 		.=	'<ul class="category-posts">';

    	foreach($posts as $post): setup_postdata($post);
    		$widget 	.=  '<li>';
        $widget   .=  '<a href="'.get_permalink($post->ID).'">';
        if(has_post_thumbnail($post->ID)){$widget .= get_the_post_thumbnail($post->ID,'medium',array('class'=>'container'));}
    		$widget 	.=	'<h5>'.$post->post_title.'</h5>';
        $widget   .=  '</a>';
    		$widget 	.=	'<p>'.get_the_excerpt().'</p>';
    		$widget 	.=	'</li>';
    	endforeach;

    	$widget 		.=	'</ul>';
        $widget 		.= 	$after_widget; 

        echo $widget;
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance 						         = $old_instance;
		$instance['title'] 				     = strip_tags($new_instance['title']);
		$instance['num_posts'] 			   = strip_tags($new_instance['num_posts']);
		$instance['cat'] 				       = strip_tags($new_instance['cat']);
		$instance['show_excerpt'] 		 = strip_tags($new_instance['show_excerpt']);
        
    return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
        $title 				= esc_attr($instance['title']);
        $num_posts			= esc_attr($instance['num_posts']);	
        $sel				= esc_attr($instance['cat']);
        $show_excerpt	 	= esc_attr($instance['show_excerpt']); ?>

        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e('Number of Posts:'); ?></label> 
          <input id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" type="text" value="<?php echo $num_posts; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Category:'); ?></label> 
          <select id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>">
          <?php  	$categories 		=	get_categories(array('type'=>'post'));
          	foreach($categories as $cat){
          		if($cat->cat_ID == $sel){$selected = $category.' SELECTED';} else{$selected = '';}
          		echo '<option value="'.$cat->cat_ID.'"'.$selected.'>'.$cat->cat_name.'</option>';
          	}
          ?>
          </select>
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e('Show Excerpt?'); ?></label> 
          <?php if($show_excerpt == 'y'){ $checked = 'CHECKED'; } ?>
          <input id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" type="checkbox" value="y" <?php echo $checked;?>/>
        </p>
        <?php 
    }
 
 
} // end class example_widget
add_action('widgets_init', create_function('', 'return register_widget("CategoryPostsWidget");'));
?>