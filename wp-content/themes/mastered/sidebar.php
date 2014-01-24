<?php if ( is_single() ) : ?>
	<div class="white-module with-space">
		<p class="bold">Written by Cheryl Adamson</p>
		<p class="no-spacing bio-para">
			Head of Marketing and Community at <a href="https://mastered.co/pages/purpose">Mastered</a>.
			Passionate about supporting designer-makers to make a real living from their creative talents.
		</p>
	</div>
<?php endif; ?>
<a href="https://mastered.co/courses" class="blog-course-promo">
	<h3>Turning Makers into Masters</h3>
	<p class="desc">Online fashion and jewelry courses from world class experts.</p>
	<p class="blog-cta-wrap"><span class="butt mini cta">Try a course today!</span></p>
</a>
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