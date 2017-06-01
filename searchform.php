<form id="search" role="search" method="get" class="navbar-search pull-right" action="<?php echo home_url( '/' ); ?>">
	<input type="text" class="span2 search-query" value="<?php if(get_search_query()) the_search_query();?>" name="s" id="s" placeholder="Search" onchange="this.form.submit();"/>
	<input type="hidden" id="searchsubmit" />
</form>