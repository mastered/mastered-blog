<?php if ( is_single() ) : ?>
	<div class="white-module with-space less-padding">
		<p class="bold"><span class="written-by">Written by</span> <?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('last_name'); ?></p>
		<p class="no-spacing bio-para">
			<span class="blog-bio-pic">
				<?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'thumbnail'); ?>
			</span>
			<?php echo get_the_author_meta('description'); ?>
		</p>
	</div>
<?php endif; ?>
<a href="https://mastered.co/courses" class="blog-course-promo">
	<h3>Turning Makers into Masters</h3>
	<p class="desc">Online fashion and jewellery courses from world class experts.</p>
	<p class="blog-cta-wrap"><span class="butt mini cta">Try a course today!</span></p>
</a>
