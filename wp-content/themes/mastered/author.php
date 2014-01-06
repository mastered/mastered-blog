<?php get_header(); ?>
	<h1>
		Posts by: <?php echo get_the_author_meta('display_name'); ?>
	</h1>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" role="article">
		<header>
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<p class="meta">Posted on <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> by <?php the_author_posts_link(); ?> and filed under <?php the_category(', '); ?>.</p>
		</header> <!-- End post header -->
		<div class="post-content">
			<?php the_post_thumbnail( 'thumb-200' ); ?>
			<?php the_excerpt(); ?>
		</div> <!-- End post content -->			
	</article> <!-- End the post -->			
	<?php endwhile; ?>	
	<?php posts_nav_link(); ?>
	<?php else : ?>
	<article id="post-not-found">
		<header>
			<h1>No Posts Found</h1>
		</header>
		<p>Hmmm, there doesn't seem to be any posts here.</p>
	</article>
	<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>