<?php if ( is_single() ) : ?>
  <div class='bio-container'>
    <div class='bio-author'>
      <span class="written-by">Written by</span>
      <p class="bold"><?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('last_name'); ?></p>
    </div>
    <div class='bio-pic'>
      <?php echo get_wp_user_avatar(get_the_author_meta('ID'), 'thumbnail'); ?>
    </div>
  </div>
  <hr/>
<?php endif; ?>

<h3>Talent. Meet opportunity.</h3>
<p class="desc">Online fashion and jewellery courses from world class experts.</p>
<a class="butt mini cta full-width" href="https://mastered.com/course-listings">Try a course today</a>

<hr/>
<h3>Connect with us</h3>
<div class="share-links">
  <a href="https://twitter.com/masteredhq" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png"/></a>
  <a href="https://www.pinterest.com/Masteredpin/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/pinterest.png"/></a>
  <a href="https://www.facebook.com/MasteredHQ" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png"/></a>
</div>

<hr/>
<h3>Explore courses</h3>
<ul class="course-listing">
  <li>
    <a href="https://www.mastered.com/course-listings/master-surface-embellishment/overview" target="_blank">
      <div class="course-image"><img src="<?php echo get_template_directory_uri(); ?>/images/embellishment.jpg"/></div>
      <div class="course-description">
        <h3 class="bold">Master Surface Embellishment</h3>
        <div class="description">with Hand & Lock, Diana Springall and Karen Nicoll</div>
      </div>
    </a>
  </li>
  <li>
    <a href="https://www.mastered.com/course-listings/the-savile-row-coat/overview" target="_blank">
      <div class="course-image"><img src="<?php echo get_template_directory_uri(); ?>/images/savilerow.jpg"/></div>
      <div class="course-description">
        <h3 class="bold">The Savile Row Coat</h3>
        <div class="description">with the Savile Row Academy</div>
      </div>
    </a>
  </li>
  <li>
    <a href="https://www.mastered.com/course-listings/develop-your-illustration-career/overview" target="_blank">
      <div class="course-image"><img src="<?php echo get_template_directory_uri(); ?>/images/illustration.jpg"/></div>
      <div class="course-description">
        <h3 class="bold">Develop your illustration career</h3>
        <div class="description">with Jacqueline Bisset</div>
      </div>
    </a>
  </li>
</ul>

<a class="butt mini cta full-width" href="https://mastered.com/course-listings">Explore all courses</a>

<hr/>
<form role="search" class="blog-search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<h3>Search the blog:</h3>
	<input type="text" value="" class="search-blog-input" name="s" id="s"/><input type="submit" id="searchsubmit" value="Go" class="butt blog-search-btn black"/>
</form>

<hr/>

<h3>Blog categories</h3>
<?php wp_dropdown_categories('orderby=name&title_li='); ?>
<hr/>

<h3>Blog archives</h3>
<select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
  <option value=""><?php echo attribute_escape(__('Select')); ?></option>
<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
