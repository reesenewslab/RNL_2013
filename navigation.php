<!-- TOP NAV -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">

		<a class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
  		</a>

	  		<div class="nav-collapse collapse">
			  <?php 
				  $args = array(
				  	'theme_location'	=>	'header-menu',
				  	'menu' 				=>  'header-menu',
				  	'menu_class'		=>	'nav nav-pills');
				  wp_nav_menu($args);

				  get_search_form();
			  ?>

			</div>
		</div>
	</div>
</div>

<!-- TOP NAV
