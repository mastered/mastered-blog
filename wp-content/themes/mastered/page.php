<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">
		<h1 itemprop="headline">
			<?php the_title(); ?>
		</h1>		
		<div class="post-content" itemprop="articleBody">
			<?php the_content(); ?>
		</div> <!-- End main page content -->	
		<footer>
			<?php the_tags('<p class="tags">Tags: ', ', ', '</p>'); ?>
		</footer> <!-- End page content footer -->
	</article> <!-- End page article -->		
	<?php comments_template(); ?>
	<?php endwhile; ?>			
	<?php else : ?>
	<article id="post-not-found">
		<header>
			<h1>No Pages Found</h1>
		</header>
		<p>No pages seem to be here.</p>
	</article>	
	<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>