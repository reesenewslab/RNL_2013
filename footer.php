	<footer>
		<div class="container-fluid">
			<div class="row-fluid">
			<?php dynamic_sidebar('footer');?>
			</div>
		</div>
	</footer>
	<?php wp_footer();?>
	</div>
</div>
	<?php 
	// NUMBER OF FOOTER WIDGETS
	echo '<script>
			jQuery(".footer_widget").addClass("span'.num_widgets('footer').'");
		</script>'."\r\n";

	// ADD GOOGLE ANALYTICS CODE
	$options = get_option("theme_" . upfw_get_current_theme_id() . "_options");
	echo "
	<script>
  		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  		ga('create','".$options['google_analytics']."' , '".$options['google_analytics_site']."');
  		ga('send', 'pageview');
	</script>";
	?>

	<script src="<?php echo get_template_directory_uri();?>/js/scrolldepth/jquery.scrolldepth.js"></script>
	<script>
	jQuery(function() {
    		jQuery.scrollDepth();
	});
	</script>


	<script type="text/javascript">
	(function(doc) {

	var addEvent = 'addEventListener',
	    type = 'gesturestart',
	    qsa = 'querySelectorAll',
	    scales = [1, 1],
	    meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

	function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
	}

	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
	}

	}(document));
	</script>


</body>
</html>
