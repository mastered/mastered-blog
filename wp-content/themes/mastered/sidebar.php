<form role="search" class="blog-search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<label class="search-blog-label screen-reader-text" for="s">Search the blog:</label>
	<input type="text" value="" class="search-blog-input" name="s" id="s" /><input type="submit" id="searchsubmit" value="Search" class="blog-search-btn" />
</form>
<ul class="sidebar-archives side-list">
	<li class="sidebar-title">Blog Archives</li>
	<?php wp_get_archives(); ?>
</ul>
<ul class="sidebar-categories side-list">
	<li class="sidebar-title">Blog Categories</li>
	<?php wp_list_categories('orderby=name&title_li='); ?>
</ul>