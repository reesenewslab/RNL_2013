<?php
/**
 * Example Widget Class
 */
class three_column_posts_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function three_column_posts_widget() {
        $widget_ops		=	array('description'=>'Display recent posts from a category in three columns');
        parent::WP_Widget('three_column_posts_widget','Three Column, Recent Posts',$widget_ops);		
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
    	extract( $args );

    	$category 	= $instance['category'];
    	$posts 		= $instance['posts'];
    	$display 	= $instance['display'];
      $title    = $instance['title'];

      echo '<section id="'.$instance['id'].'" class="section repeated-stories '.$instance['text_color'].'" style="';
                if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE') !== false):
                        $hex = rgb2hex($instance['background_color']);
                        echo 'background-color: '.$hex[color].'; filter: alpha(opacity='.$hex[opacity].');';
                else:
                        echo 'background-color: '.$instance['background_color'];
                endif;
                echo '" data-section="'.$instance['id'].'"><div class="container-fluid">';
      
      echo '<div class="row-fluid title">';
      echo '<div class="span12">';
      if($category && $display == 'cat') echo '<h2>'.get_cat_name($category).'</h2>';
      elseif($title == '') echo '<h2>Recent Posts</h2>';
      else echo '<h2>'.$title.'</h2>';
      echo '</div>';
      echo '</div>';


      echo '<div class="row-fluid content">'."\r\n\t";

    	if($display == 'cat'):
        $all_posts = get_posts(array('numberposts'=>'3','category'=>$category));
    	

    	elseif($display == 'post'):
        foreach($posts as $p):

      		$po = explode(':',$p);
      		$blog_number    = $po[0];
      		$post_id 	      = $po[1];

          if($blog_number != get_current_blog_id()) switch_to_blog($blog_number);   // SWITCH TO BLOG IF FROM ANOTHER SITE

          $all_posts[] = get_post($post_id);

          if($blog_number != get_current_blog_id()) restore_current_blog();         // RESTORE CURRENT BLOG

        endforeach;

    	// 	// $query = new WP_Query('cat='.$category.'&posts_per_page=3');
    	endif;

      foreach($all_posts as $p):
      if($instance['display_excerpt'] == 'show'): $div_class = 'display_excerpt'; else: $div_class = 'hide_excerpt'; endif;
      echo '<div class="span4 ' . $div_class . '">'."\r\n\t\t";
      echo '<h4>';
      echo '<a href="'.get_permalink($p->ID).'">'.$p->post_title.'</a></h4>'."\r\n\t\t";
      if($instance['display_excerpt'] == 'show'):
      echo '<p>'.get_excerpt_by_post_array($p,200,'...').'</p>';
      echo '<a href="'.get_permalink($p->ID).'" rel="external" class="pull-right btn">Read More &raquo;</a>'."\r\n\t";
      endif;
      echo '</div>'."\r\n";

      endforeach;
   		
      echo '</div></section>';
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
    if(!isset($instance['id'])) $instance['id'] = rand(1000,9999);
    $instance['title'] = $new_instance['title'];
		$instance['category'] = $new_instance['category'];
		$instance['posts'] = $new_instance['posts'];
		$instance['display'] = $new_instance['display'];
    $instance['text_color'] = $new_instance['text_color'];
    $instance['background_color'] = $new_instance['background_color'];
    $instance['display_excerpt'] = $new_instance['display_excerpt'];

    return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
      $title   = $instance['title'];
    	$category 	= $instance['category'];
    	$posts 		= $instance['posts'];
    	$display 	= $instance['display'];
      $background = $instance['background_color'];
      $text_color = $instance['text_color'];
      $display_excerpt = $instance['display_excerpt'];
	?>

      <h3>Main Widget Options</h3>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:<br/>Will default to Category name if left blank.'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
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

	<p>
	  <label for="<?php echo $this->get_field_id('display_excerpt');?>"><?php _e('Display Excerpt');?></label>
	  <select id="<?php echo $this->get_field_id('display_excerpt');?>" name="<?php echo $this->get_field_name('display_excerpt');?>">
		<option value="show" <?php if($display_excerpt == 'show') echo 'selected';?>>Show</option>
		<option value="hide" <?php if($display_excerpt == 'hide') echo 'selected';?>>Hide</option>
	  </select>

      <?php
    	// GET TOP 10 POSTS FROM EACH BLOG
        // $blogs = get_all_blogs();
        // foreach($blogs as $key=>$val){
        //   switch_to_blog($key);

          // GET RECENT POSTS BY BLOG
          $args = array('numberposts' => 20);
          $recent_posts =       wp_get_recent_posts($args);
          $array[]      =       array('title'=>'-- '.$val->blogname.' --','name'=>'');
          
          foreach($recent_posts as $r){
            $array[$r[ID]][title]     = $r[post_title];
            $array[$r[ID]][name]      = $key . ':' . $r[ID];
          }

        //   restore_current_blog();
        // }

		$args = array(
  			'id' => $this->get_field_id('category'),
  			'name' => $this->get_field_name('category'),
  			'selected' => $category
  		); ?>
  		
  		<style>
  			.green{
  				border: 2px solid #B3C95A; 
  				background: #e4e8d4; 
  				padding: 20px 5px;
  			}
  		</style>

  		<p style="color: #999">You may choose a category to display the latest three posts, or choose three posts to display.</p>
  		
  		<h3>What should this display</h3>
  		<p>
  			<label>Category</label>
  			<input type="radio" class="radio"
  			id="<?php echo $this->get_field_id('display');?>" name="<?php echo $this->get_field_name('display');?>" 
  			<?php if($display == 'cat') echo ' CHECKED ';?>
  			value="cat" style="float: right;">

  			<br/>

  			<label>Posts</label>
  			<input type="radio" class="radio"
  			id="<?php echo $this->get_field_id('display');?>" name="<?php echo $this->get_field_name('display');?>" 
  			<?php if($display == 'post') echo ' CHECKED ';?>
  			value="post" style="float: right;">
  		</p>

  		<div id="choose_category" class="<?php if($display == 'cat') echo 'green';?>">
	  		<h3 style="padding: 0; margin: 0">Choose a category</h3>
	  		<p>Choose a category from this site and show the latest three posts.</p>
	  		<?php wp_dropdown_categories($args);?>
  		</div>

  		
  		<h2 style="color: #8B0000; text-align: center">or</h2>

  		<div id="choose_posts" class="<?php if($display == 'post') echo 'green';?>">
	  		<h3 style="padding: 0; margin: 0">Choose three posts</h3>
	  		<p>Choose posts to display.  Only the first three will be stored.</p><?php 

	  		echo '<select class="widefat" id="'.$this->get_field_id('posts').'" name="'.$this->get_field_name('posts').'[]" multiple size="5">';
	  		foreach($array as $key=>$value){
	  			echo '<option value="'.$value[name].'"';
	  			if(in_array($value[name],$posts)) echo ' selected';
	  			echo '>'.substr($value[title],0,35).'</option>';
	  		}
	  		echo '</select>';?>
  		</div>

  		<?php
    }
 
 
} // end class three_column_widget
add_action('widgets_init', create_function('', 'return register_widget("three_column_posts_widget");'));
?>
