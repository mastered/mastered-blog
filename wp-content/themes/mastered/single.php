<?php get_header(); ?>
	<div class="layout-width">
		<div class="col main-content">
			<?php while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">
				<header>
					<h1 itemprop="headline" class="post-entry-title">
						<?php the_title(); ?>
					</h1>
					<p class="post-meta">Posted by <?php the_author_meta('user_firstname'); ?> in <?php the_category(', '); ?>.</p>
				</header> <!-- End post header -->
				<div class="post-content" itemprop="articleBody">
					<?php the_content(); ?>
				</div> <!-- End post content -->	
				<?php comments_template(); ?>
			</article> <!-- End the post -->		
			<?php endwhile; ?>
		</div>
		<div class="col sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>