<?php get_header(); ?>
	<div class="layout-width">
		<div class="col main-content">
			<h1 class="headline">
				You searched for: <?php echo esc_attr(get_search_query()); ?>
			</h1>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" role="article" class="post-list-entry">
				<header>
					<h2 class="post-entry-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h2>
					<p class="post-meta">Posted on <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> by <?php the_author(); ?> in <?php the_category(', '); ?>.</p>
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
				<p>Your search didn't bring back any results.</p>
			</article>
			<?php endif; ?>	
		</div>
		<div class="col sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>