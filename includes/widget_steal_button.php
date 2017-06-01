<?php

add_action('widgets_init', create_function('', 'return register_widget("StealButton");'));

class StealButton extends WP_Widget {

	function StealButton() {
    	$widget_ops		=	array('description'=>'Adds button to sidebar that copies the code');
        parent::WP_Widget('StealButton','Steal This',$widget_ops);	
    }

    function widget($args, $instance) {	?>
    	<!-- Button to trigger modal -->
    	<?php if(is_single()): 
    	$the_post = get_post(get_the_ID());
    	//if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<center><a href="#myModal" role="button" class="btn btn-large btn-warning" data-toggle="modal">Steal This</a></center>
		 
		<!-- MODAL BOX -->
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<!-- HEADER -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel"><?php echo $the_post->post_title;?></h3>
			</div>

			<!-- FORM -->
			<form action="<?php bloginfo('template_directory');?>/includes/php/download.php" method="post">
				<!-- GET TITLE -->
				<?php $title = preg_replace('/[^a-z\d ]/i', '', $the_post->post_title);  $title = str_replace(' ','_',$title); $title = strtolower($title);?>
				<input type="hidden" name="filename" value="<?php echo $title; ?>"/>

				<!-- SHOW PLAINTEXT -->
				<textarea style="display: none;" name="download_plaintext" class="span12" rows="20"><?php 
				echo $the_post->post_title . "\r\n\r\n";
				$removethese 		 =	array('class','id','style','alt','border');
				$content 			 =	strip_tags($the_post->post_content,'<img><a>');								//STRIP ALL TAGS EXCEPT FOR IMAGES AND LINKS
										preg_match_all('/src=["|\'](.*?)["|\']/i',$content,$images);				//EXTRACT ALL IMAGE URLS
				 $content 			 =	strip_tags($content,'<a>');													//REMOVE ALL IMAGE TAGS
				// $content 			 =	preg_replace("/[\r\n]+/", "\r\n",$content);									//REPLACE ALL EXCESS SPACES
				

				foreach($removethese as $rem){ $content = preg_replace('/'.$rem.'=".*?"/', '', $content); }
				$content 			.= 	"\r\n\r\n\r\n"."Content produced by the Reese News Lab, UNC School of Journalism and Mass Communication";

				

				print_r($matches[0]);  

				echo $content;
				?></textarea>

				<!-- SHOW HTML TO BE COPIED -->
				<textarea id="download" name="download" class="span12" rows="20"><?php
					// REMOVE CLASSES AND IDs FOR CONTENT, KEEP P TAGS, LISTS, AND IMAGES
					$postcon  = apply_filters('the_content',$the_post->post_content);
					$postcon  = strip_tags($postcon,'<img><p><ul><ol><li><a>');
					$removethese 		 =	array('class','id','style','alt','border');
					foreach($removethese as $rem){ $postcon = preg_replace('/'.$rem.'=".*?"/', '', $postcon); }

					$content  = "<h1>".$the_post->post_title."</h1>";
					$content .= "\r\n\r\n";
					$content .= $postcon;
					$content .= "\r\n\r\n";
					$content .= "Content produced by ";
					$content2 = '<a href="http://reesenewslab.org">Reese News Lab</a>, <a href="http://jomc.unc.edu">UNC School of Journalism and Mass Communication</a>';

					echo $content;
					// if(function_exists('coauthors_posts_links')): coauthors_posts_links(); else: the_author_posts_link(); endif;
					echo $content2;
				?></textarea>
				<div class="modal-footer">
					<button type="submit" id="download_btn" name="download_btn" class="btn btn-primary" value="btn">Download HTML</button>
					<!-- <button type="submit" id="download_plaintext" name="download_btn_plaintext" class="btn btn-primary" value="plaintext">Download Plain Text</button> -->
				</div>
			</form>
			
		</div>
		<?php endif; //endwhile; //endif; ?>
	<?php }

    function update($new_instance, $old_instance) {	}

    function form($instance) {}
}


?>