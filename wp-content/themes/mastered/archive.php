<?php get_header(); ?>
	<div class="layout-width">
		<div class="col main-content">
			<?php if (is_category()) { ?>
			<h1 class="headline">
				Category: <?php single_cat_title(); ?>
			</h1>
			<?php } elseif (is_tag()) { ?> 
			<h1 class="headline">
				Posts Tagged: <?php single_tag_title(); ?>
			</h1>
			<?php } elseif (is_author()) { ?>
			<h1 class="headline">
				Posts By: <?php get_the_author_meta('display_name'); ?>
			</h1>
			<?php } elseif (is_day()) { ?>
			<h1 class="headline">
				Archives: <?php the_time('l, F j, Y'); ?>
			</h1>
			<?php } elseif (is_month()) { ?>
			<h1 class="headline">
				Archives: <?php the_time('F Y'); ?>
			</h1>
			<?php } elseif (is_year()) { ?>
			<h1 class="headline">
				Archives: <?php the_time('Y'); ?>
			</h1>
			<?php } ?>
			
			<?php while (have_posts()) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" role="article" class="post-list-entry">
				<header>
					<h2 class="post-entry-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h2>
					<p class="post-meta">Posted by <?php the_author_meta('user_firstname'); ?> in <?php the_category(', '); ?>.<span class="blog-sep-border"></span><a href="<?php the_permalink() ?>#disqus_thread">Leave a comment</a></p>
				</header> <!-- End post header -->
				<div class="post-content">
					<?php the_content('<span class="read-more">Read more on "'.the_title('', '', false).'"</span>'); ?>
				</div> <!-- End post content -->				
			</article> <!-- End the post -->
			<?php endwhile; ?>	
			<?php posts_nav_link(); ?>
		</div>
		<div class="col sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>