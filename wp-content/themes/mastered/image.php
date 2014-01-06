<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
    	<header>
        	<h1>
        		<a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &mdash; <?php the_title(); ?>
        	</h1>
		</header>
    	<div class="post-content">
    		<a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a>
      		<p><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></p>
			<?php the_content('<p>Read the rest of this entry.</p>'); ?>
		</div>
		<nav class="prev-next-links">
			<ul>
        		<li><?php previous_image_link() ?></li>
        		<li><?php next_image_link() ?></li>
        	</ul>
    	</nav>
    </article>
    <?php endwhile; else: ?>					
    <div class="no-attachments">
    	<p>Sorry, no attachments matched your criteria.</p>
    </div>			
	<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>