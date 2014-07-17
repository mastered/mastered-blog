<?php
/*
 * Recommendations Widget
 * WordPress widget that displays playbuzz related playful content links and recommendations on sites sidebar.
 *
 * @since 0.1
 */
class PlayBuzz_Recommendations_Widget extends WP_Widget {

	/*
	 * Constructor
	 */
	public function __construct() {

		// load plugin text domain
		add_action( 'init', array( $this, 'playbuzz' ) );

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook(   __FILE__ , array( $this, 'activate'   ) );
		register_deactivation_hook( __FILE__ , array( $this, 'deactivate' ) );

		parent::__construct(
			'playbuzz-recommendations-id',
			__( 'PlayBuzz Recommendations', 'playbuzz' ),
			array(
				'classname'   => 'playbuzz-recommendations',
				'description' => __( 'Related playful content links and recommendations by PlayBuzz.', 'playbuzz' )
			)
		);

	}


	/*
	 * Outputs the content of the widget.
	 *
	 * @param	array	args		The array of form elements
	 * @param	array	instance	The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		$options = get_option( 'playbuzz' );

		$key     = $options['key'];
		$links   = $options['links'];
		

		$view    = empty( $instance['view'] )  ? '' : apply_filters( 'view',  $instance['view']  );
		$items   = empty( $instance['items'] ) ? '' : apply_filters( 'items', $instance['items'] );
		$title	 = empty( $instance['title'] ) ? '' : apply_filters( 'title', $instance['title'] );
		$tags    = pb_tags( $instance );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		echo '
			<script type="text/javascript" src="http://www.playbuzz.com/bundles/widgets"></script>
			<div class="pb_recommendations" data-key="' . $key . '" data-tags="' . $tags . '" data-view="' . $view . '" data-num-items="' . $items . '" data-links="' . $links . '" data-nostyle="false"></div>
		';
		echo $after_widget;

	}


	/*
	 * Processes the widget's options to be saved.
	 *
	 * @param	array	new_instance	The new instance of values to be generated via the update.
	 * @param	array	old_instance	The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['view']              = strip_tags( stripslashes( $new_instance['view']              ) );
		$instance['title']             = strip_tags( $new_instance['title']                             );
		$instance['items']             = strip_tags( stripslashes( $new_instance['items']             ) );
		$instance['tags-pop']          = strip_tags( stripslashes( $new_instance['tags-pop']         ) );
		$instance['tags-geek']         = strip_tags( stripslashes( $new_instance['tags-geek']       ) );
		$instance['tags-sports']       = strip_tags( stripslashes( $new_instance['tags-sports']       ) );
		$instance['tags-editors-pick'] = strip_tags( stripslashes( $new_instance['tags-editors-pick'] ) );
		$instance['tags-mix']          = strip_tags( stripslashes( $new_instance['tags-mix']          ) );
		$instance['tags-tv']           = strip_tags( stripslashes( $new_instance['tags-tv']           ) );
		$instance['tags-celebrities']  = strip_tags( stripslashes( $new_instance['tags-celebrities']  ) );
		$instance['more-tags']         = strip_tags( stripslashes( $new_instance['more-tags']         ) );

		return $instance;

	}


	/*
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		// Load options
		$options = get_option( 'playbuzz' );

		// Set default values
		$defaults = array(
				'title'				=> 'Play It',
				'view'              => $options['view'],
				'items'             => $options['items'],
				'tags-fun'          => $options['tags-fun'],
				'tags-pop'          => $options['tags-pop'],
				'tags-geek'         => $options['tags-geek'],
				'tags-editors-pick' => $options['tags-editors-pick'],
				'tags-mix'          => $options['tags-mix'],
				'more-tags'         => $options['more-tags'],
			);

		// New instance (use defaults if empty)
		$new_instance = wp_parse_args( (array)$instance, $defaults );

		// Display the admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'playbuzz' ); ?></label>
			<input value="<?php echo $new_instance['title']; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text">
		</p>
		<p>
			<label for="view"><?php _e( 'View', 'playbuzz' ); ?></label>
			<select id="<?php echo $this->get_field_id('view'); ?>" name="<?php echo $this->get_field_name('view'); ?>" class="widefat">
				<option value="large_images"      <?php if ( 'large_images'      == $new_instance['view'] ) echo 'selected'; ?>><?php _e( 'Large Images', 'playbuzz' ); ?></option>
				<option value="horizontal_images" <?php if ( 'horizontal_images' == $new_instance['view'] ) echo 'selected'; ?>><?php _e( 'Horizontal Images', 'playbuzz' ); ?></option>
				<option value="no_images"         <?php if ( 'no_images'         == $new_instance['view'] ) echo 'selected'; ?>><?php _e( 'No Images', 'playbuzz' ); ?></option>
			</select>
		</p>
		<p>
			<label for="items"><?php _e( 'Number of Items', 'playbuzz' ); ?></label>
			<select id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" class="widefat">
				<option value="2"  <?php if ( '2'  == $new_instance['items'] ) echo 'selected'; ?>>2</option>
				<option value="3"  <?php if ( '3'  == $new_instance['items'] ) echo 'selected'; ?>>3</option>
				<option value="4"  <?php if ( '4'  == $new_instance['items'] ) echo 'selected'; ?>>4</option>
				<option value="5"  <?php if ( '5'  == $new_instance['items'] ) echo 'selected'; ?>>5</option>
				<option value="6"  <?php if ( '6'  == $new_instance['items'] ) echo 'selected'; ?>>6</option>
				<option value="7"  <?php if ( '7'  == $new_instance['items'] ) echo 'selected'; ?>>7</option>
				<option value="8"  <?php if ( '8'  == $new_instance['items'] ) echo 'selected'; ?>>8</option>
				<option value="9"  <?php if ( '9'  == $new_instance['items'] ) echo 'selected'; ?>>9</option>
				<option value="10" <?php if ( '10' == $new_instance['items'] ) echo 'selected'; ?>>10</option>
				<option value="11" <?php if ( '11' == $new_instance['items'] ) echo 'selected'; ?>>11</option>
				<option value="12" <?php if ( '12' == $new_instance['items'] ) echo 'selected'; ?>>12</option>
				<option value="13" <?php if ( '13' == $new_instance['items'] ) echo 'selected'; ?>>13</option>
				<option value="14" <?php if ( '14' == $new_instance['items'] ) echo 'selected'; ?>>14</option>
				<option value="15" <?php if ( '15' == $new_instance['items'] ) echo 'selected'; ?>>15</option>
			</select>
		</p>
		<p>
			<label for="tags"><?php _e( 'Simple Tags', 'playbuzz' ); ?></label><br>
			<input type="checkbox" name="<?php echo $this->get_field_name('tags-mix');          ?>" value="1" <?php if ( '1' == $new_instance['tags-mix']          ) echo 'checked="checked"'; ?>> <?php _e( 'Mix',            'playbuzz' ); ?> 
			<input type="checkbox" name="<?php echo $this->get_field_name('tags-fun');         ?>" value="1" <?php if ( '1' == $new_instance['tags-fun']         ) echo 'checked="checked"'; ?>> <?php _e( 'Fun',           'playbuzz' ); ?> 
			<input type="checkbox" name="<?php echo $this->get_field_name('tags-pop');         ?>" value="1" <?php if ( '1' == $new_instance['tags-pop']         ) echo 'checked="checked"'; ?>> <?php _e( 'Pop',           'playbuzz' ); ?> 
			<input type="checkbox" name="<?php echo $this->get_field_name('tags-geek');       ?>" value="1" <?php if ( '1' == $new_instance['tags-geek']       ) echo 'checked="checked"'; ?>> <?php _e( 'Geek',         'playbuzz' ); ?> 
			<input type="checkbox" name="<?php echo $this->get_field_name('tags-sports');       ?>" value="1" <?php if ( '1' == $new_instance['tags-sports']       ) echo 'checked="checked"'; ?>> <?php _e( 'Sports',         'playbuzz' ); ?> 
			<input type="checkbox" name="<?php echo $this->get_field_name('tags-editors-pick'); ?>" value="1" <?php if ( '1' == $new_instance['tags-editors-pick'] ) echo 'checked="checked"'; ?>> <?php _e( 'Editor\'s Pick', 'playbuzz' ); ?> 
		</p>
		<p>
			<label for="tags"><?php _e( 'Advanced Tags', 'playbuzz' ); ?></label>
			<input type="input" name="<?php echo $this->get_field_name('more-tags'); ?>" value="<?php echo $new_instance['more-tags']; ?>" class="widefat">
		</p>
		<?php
	}


	/*
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function playbuzz() {
		load_plugin_textdomain( 'playbuzz', false, plugin_dir_path( __FILE__ ) . '/lang' );
	}


	/*
	 * Fired when the plugin is activated.
	 *
	 * @param		boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public function activate( $network_wide ) {
		// Define activation functionality here
	}


	/*
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
	 */
	public function deactivate( $network_wide ) {
		// Define deactivation functionality here
	}

}

add_action( 'widgets_init', create_function( '', 'register_widget("PlayBuzz_Recommendations_Widget");' ) );
