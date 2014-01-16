<?php get_header(); ?>
	<div class="layout-width">
		<div class="col main-content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" role="article" class="post-list-entry">
				<header>
					<h2 class="post-entry-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h2>
					<p class="post-meta">Posted by <?php the_author_meta('user_firstname'); ?> in <?php the_category(', '); ?>.</p>
				</header> <!-- End post header -->
				<div class="post-content">
					<?php the_content('<span class="read-more">Read more on "'.the_title('', '', false).'"</span>'); ?>
				</div> <!-- End post content -->				
			</article> <!-- End the post -->		
			<?php endwhile; ?>	
			<?php posts_nav_link(); ?>
			<?php else : ?>	
			<article id="post-not-found">
				<header>
					<h1>No Posts Found</h1>
				</header>
				<p>Hmmm, there doesn't seem to be any posts just yet.</p>
			</article>	
			<?php endif; ?>
		</div>
		<div class="col sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>