<?php
/*
 * Recommendations Widget
 * WordPress widget that displays playbuzz related playful content links and recommendations on sites sidebar.
 *
 * @since 0.1
 */
class PlayBuzzAdmin {

	protected static $option_name = 'playbuzz';
	protected static $data = array(

		// General
		'key'               => 'default',

		// Games
		'info'              => '1',
		'shares'            => '1',
		'comments'          => '1',
		'recommend'         => '1',
		'margin-top'   => '0',

		// Recommendations
		'active'            => 'false',
		'show'              => 'footer',
		'view'              => 'large_images',
		'items'             => '3',
		'links'             => 'http://www.playbuzz.com',

		// Tags
		'tags-mix'          => '1',
		'tags-fun'          => '',
		'tags-pop'          => '',
		'tags-geek'         => '',
		'tags-sports'       => '',
		'tags-editors-pick' => '',
		'more-tags'         => '',

	);

	/*
	 * Constructor
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'init' ) );
		
		// Text domain for localization and translation
		try {
			load_plugin_textdomain( 'playbuzz', false, plugin_dir_path( __FILE__ ) . '/lang' );
		} catch (Exception $e) {
			// Nothing
		}
		
		// Admin sub-menu
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'add_page'   ) );

	}

	/*
	 * Get option name
	 */
	public function get_option_name(){
		return self::$option_name;
	}

	/*
	 * Get data
	 */
	public function get_data(){
		return self::$data;
	}

	/*
	 * Fired when the plugin is activated.
	 */
	public static function activate() {

		// Set default options when the plugin is activated
		if ( ! current_user_can( 'activate_plugins' ) )
		return;
		
		// Set API Key
		if ( 'default' == self::$data['key']  ) {

			// Extract host domain
			$domain = parse_url( home_url(), PHP_URL_HOST );

			// Remove "www." from the domain
			$api = str_replace( 'www.', '', $domain );

			// Set API
			self::$data['key'] = $api;
		}
		
		if( !get_option( self::$option_name ) ) {
			update_option( self::$option_name, self::$data );
		}
		else // We already have a settings object in memory, add the new items
		{
			update_option( self::$option_name, array_merge( (self::$data), get_option( self::$option_name )) );
		}
	}

	/*
	 * Fired when the plugin is deactivated.
	 */
	public static function deactivate() {

		// Delete options from the database when the plugin is deactivated
		//delete_option( self::$option_name );

	}

	/*
	 * Init function.
	 */
	public function init() {

		// Add Recommendations to the content
		add_filter( 'the_content', 'pb_content_filter', 20 );

		function pb_content_filter( $content ) {

			global $post;

			$options   = get_option( 'playbuzz' );
			$key       = $options['key'];
			$active    = $options['active'];
			$show      = $options['show'];
			$view      = $options['view'];
			$items     = $options['items'];
			$links     = $options['links'];
			$tags      = pb_tags( $options );

			// Embed Code
			$pb_code  = '
				<script type="text/javascript" src="http://www.playbuzz.com/bundles/widgets"></script>
				<div class="pb_recommendations" data-key="' . $key . '" data-view="' . $view . '" data-num-items="' . $items . '" data-links="' . $links . '" data-tags="' . $tags . '" data-nostyle="false"></div>
			';

			// Add embed code
			if ( 'true' == $active ) {

				// Add embed code only to posts and pages
				if ( is_singular() ) {

					// Add to header or footer
					if ( 'header' == $show ) {

						$content = $pb_code . $content;

					} elseif ( 'footer' == $show ) {

						$content = $content . $pb_code;

					}

				}

			}

			// Return the content
			return $content;

		}

	}

	/*
	 * White list our options using the Settings API.
	 */
	public function admin_init() {

		register_setting( 'playbuzz', $this->get_option_name() );

	}

	/*
	 * Add entry in the settings menu.
	 */
	public function add_page() {

		add_options_page( __('PlayBuzz', 'playbuzz' ), __( 'PlayBuzz', 'playbuzz' ), 'manage_options', 'playbuzz', array( $this, 'options_do_page' ) );

	}

	/*
	 * Print the menu page itself.
	 */
	public function options_do_page() {

		// Load settings
		$options = get_option( $this->get_option_name() );

		// Set default tab
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'details';

		// Display the page
		?>
		<a name="top"></a>
		<div class="wrap">
			<h2 class="nav-tab-wrapper">
				<?php _e( 'PlayBuzz', 'playbuzz' ); ?> 
				<a href="?page=<?php echo $this->get_option_name(); ?>&tab=details"         class="nav-tab <?php echo $active_tab == 'details'         ? 'nav-tab-active' : ''; ?>"><?php _e( 'General Details',  'playbuzz' ); ?></a>
				<a href="?page=<?php echo $this->get_option_name(); ?>&tab=games"           class="nav-tab <?php echo $active_tab == 'games'           ? 'nav-tab-active' : ''; ?>"><?php _e( 'Games',            'playbuzz' ); ?></a>
				<a href="?page=<?php echo $this->get_option_name(); ?>&tab=recommendations" class="nav-tab <?php echo $active_tab == 'recommendations' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Recommendations',  'playbuzz' ); ?></a>
			</h2>

			<?php if( $active_tab == 'details' ) { ?>

				<h3><?php _e( 'General', 'playbuzz' ); ?></h3>		
				<table class="form-table">
					<tr>
						<th scope="row"><?php _e( 'API Key', 'playbuzz' ); ?></th>
						<td>
							<strong><?php echo $options['key']; ?></strong>
						</td>
					</tr>
				</table>

				<h3><?php _e( 'Shortcodes', 'playbuzz' ); ?></h3>

				<p><?php _e( 'Embedding content is easy, just use a simple shortcode:', 'playbuzz' ); ?></p>
				<br>

				<h4><?php _e( 'Game / Post Shortcode', 'playbuzz' ); ?></h4>
				<p><?php _e( 'Choose any Playful Content item from <a href="http://www.playbuzz.com">http://www.playbuzz.com</a> and easily embed it in a post.', 'playbuzz' ); ?></p>
				<p><?php _e( 'The short code used is:', 'playbuzz' ); ?></p>
				<p><code>[playbuzz-game game="URL OF Game/Post"]</code> <span style="font-size:10px"><?php _e( '(Change defaults in "Games" tab)', 'playbuzz' ); ?></span></p>
				<p><?php _e( '(e.g game="http://www.playbuzz.com/rachaelg/eye-candy-name-the-chocolate-by-its-cross-section")', 'playbuzz' ); ?></p>
				<p><?php _e( 'Create your own Playful items (quizzes,lists,etc) on PlayBuzz\'s website and embed them in the exact same way.', 'playbuzz' ); ?></p>
				<p><?php _e( 'You can override defaults with the following attributes: info="true/false", recommend="true/false", comments="true/false".', 'playbuzz' ); ?></p>
				<br>

				<h4><?php _e( 'Hub / Archive Shortcode', 'playbuzz' ); ?></h4>
				<p><?php _e( 'A list of Playful Items in a specific vertical. This is best used as a "Playful Section" displaying games and posts in the selected tags (topics).', 'playbuzz' ); ?></p>
				<p><code>[playbuzz-hub]</code> <span style="font-size:10px"><?php _e( '(Change defaults in "Games" tab)', 'playbuzz' ); ?></span></p>
				<p><?php _e( 'You can override defaults with the following attributes: tags="Any PlayBuzz Tag", recommend="true/false", comments="true/false".', 'playbuzz' ); ?></p>
				<br>

				<h4><?php _e( 'Recommendations / Related-Content Shortcode', 'playbuzz' ); ?></h4>
				<p><?php _e( 'Embedding PlayBuzz related playful content links and recommendations on your sites sidebar using customizable WordPress widget.', 'playbuzz' ); ?></p>
				<p><code>[playbuzz-recommendations]</code> <span style="font-size:10px"><?php _e( '(Change defaults in "Recommendations" tab)', 'playbuzz' ); ?><span></p>
				<p><?php _e( 'You can override defaults with the following attributes: tags="Any PlayBuzz Tag", recommend="true/false", comments="true/false".', 'playbuzz' ); ?></p>
				<p><?php _e( 'For the links to open on YOUR site you need to do the following:', 'playbuzz' ); ?></p>
				<p>
					<ol>
						<li><?php _e( 'Include the PlayBuzz hub\'s page shortcode in a designated page/post.', 'playbuzz' ); ?></li>
						<li><?php _e( 'Copy the URL (location) of the page that contains PlayBuzz\'s hub.', 'playbuzz' ); ?></li>
						<li><?php _e( 'Paste the URL in the "Location of PlayBuzz hub" field under "Recommendations".', 'playbuzz' ); ?></li>
					</ol>
				</p>
				<br>

			<?php } elseif( $active_tab == 'games' ) { ?>

				<h3><?php _e( 'Games Settings', 'playbuzz' ); ?></h3>

				<form method="post" action="options.php">

					<?php settings_fields( 'playbuzz' ); ?>
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[key]"    value="<?php echo $options['key'];    ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[active]" value="<?php echo $options['active']; ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[show]"   value="<?php echo $options['show'];   ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[view]"   value="<?php echo $options['view'];   ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[items]"  value="<?php echo $options['items'];  ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[links]"  value="<?php echo $options['links'];  ?>">

					<table class="form-table">
						<tr>
							<th scope="row"><?php _e( 'Info', 'playbuzz' ); ?></th>
							<td>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[info]" value="1" <?php if ( '1' == $options['info'] ) echo 'checked="checked"'; ?>> <?php _e( 'Show game info (thumbnail, name, description, editor, etc).', 'playbuzz' ); ?>
							</td>
						</tr>
						<tr>
							<th scope="row"><?php _e( 'Sharing Buttons', 'playbuzz' ); ?></th>
							<td>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[shares]" value="1" <?php if ( '1' == $options['shares'] ) echo 'checked="checked"'; ?>> <?php _e( 'Show sharing buttons (Recommended - redirects to your page)', 'playbuzz' ); ?>
							</td>
						</tr>
						<tr>
							<th scope="row"><?php _e( 'Comments Box', 'playbuzz' ); ?></th>
							<td>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[comments]" value="1" <?php if ( '1' == $options['comments'] ) echo 'checked="checked"'; ?>> <?php _e( 'Show comments control in the game page.', 'playbuzz' ); ?>
							</td>
						</tr>
						
						<tr>
							<th scope="row"><?php _e( 'Recommendations', 'playbuzz' ); ?></th>
							<td>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[recommend]" value="1" <?php if ( '1' == $options['recommend'] ) echo 'checked="checked"'; ?>> <?php _e( 'Show recommendations for more games.', 'playbuzz' ); ?>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e( 'Simple Tags', 'playbuzz' ); ?></th>
							<td>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-mix]"          value="1" <?php if ( '1' == $options['tags-mix']          ) echo 'checked="checked"'; ?>> <?php _e( 'All',            'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-fun]"         value="1" <?php if ( '1' == $options['tags-fun']         ) echo 'checked="checked"'; ?>> <?php _e( 'Fun',           'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-pop]"         value="1" <?php if ( '1' == $options['tags-pop']         ) echo 'checked="checked"'; ?>> <?php _e( 'Pop',           'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-geek]"       value="1" <?php if ( '1' == $options['tags-geek']       ) echo 'checked="checked"'; ?>> <?php _e( 'Geek',         'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-sports]"       value="1" <?php if ( '1' == $options['tags-sports']       ) echo 'checked="checked"'; ?>> <?php _e( 'Sports',         'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-editors-pick]" value="1" <?php if ( '1' == $options['tags-editors-pick'] ) echo 'checked="checked"'; ?>> <?php _e( 'editorspicks',    'playbuzz' ); ?><br/>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e( 'Advanced Tags', 'playbuzz' ); ?></th>
							<td>
								<input type="text" name="<?php echo $this->get_option_name(); ?>[more-tags]" value="<?php echo $options['more-tags']; ?>" class="regular-text" placeholder="<?php _e( 'Comma separated tags', 'playbuzz' ); ?>">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e( 'Margin Top (in case of a floating bar)', 'playbuzz' ); ?></th>
							<td>
								<input type="text" name="<?php echo $this->get_option_name(); ?>[margin-top]" value="<?php echo $options['margin-top']; ?>" class="regular-text" placeholder="<?php _e( 'Top Margin (px) for score Bar', 'playbuzz' ); ?>">
							</td>
						</tr>
					</table>

					<?php submit_button(); ?> 

				</form>

			<?php } elseif( $active_tab == 'recommendations' ) { ?>

				<h3><?php _e( 'Related Content', 'playbuzz' ); ?></h3>

				<form method="post" action="options.php">

					<?php settings_fields( 'playbuzz' ); ?>

					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[key]"       value="<?php echo $options['key'];       ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[info]"      value="<?php echo $options['info'];      ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[comments]"  value="<?php echo $options['comments'];  ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[shares]"    value="<?php echo $options['shares'];    ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[recommend]" value="<?php echo $options['recommend']; ?>">
					<input type="hidden" name="<?php echo $this->get_option_name(); ?>[margin-top]"    value="<?php echo $options['margin-top'];    ?>">

					<table class="form-table">
						<tr>
							<th scope="row"><?php _e( 'Number of Items', 'playbuzz' ); ?></th>
							<td>
								<select name="<?php echo $this->get_option_name(); ?>[items]">
									<option value="2"  <?php if ( '2'  == $options['items'] ) echo 'selected'; ?>>2</option>
									<option value="3"  <?php if ( '3'  == $options['items'] ) echo 'selected'; ?>>3</option>
									<option value="4"  <?php if ( '4'  == $options['items'] ) echo 'selected'; ?>>4</option>
									<option value="5"  <?php if ( '5'  == $options['items'] ) echo 'selected'; ?>>5</option>
									<option value="6"  <?php if ( '6'  == $options['items'] ) echo 'selected'; ?>>6</option>
									<option value="7"  <?php if ( '7'  == $options['items'] ) echo 'selected'; ?>>7</option>
									<option value="8"  <?php if ( '8'  == $options['items'] ) echo 'selected'; ?>>8</option>
									<option value="9"  <?php if ( '9'  == $options['items'] ) echo 'selected'; ?>>9</option>
									<option value="10" <?php if ( '10' == $options['items'] ) echo 'selected'; ?>>10</option>
									<option value="11" <?php if ( '11' == $options['items'] ) echo 'selected'; ?>>11</option>
									<option value="12" <?php if ( '12' == $options['items'] ) echo 'selected'; ?>>12</option>
									<option value="13" <?php if ( '13' == $options['items'] ) echo 'selected'; ?>>13</option>
									<option value="14" <?php if ( '14' == $options['items'] ) echo 'selected'; ?>>14</option>
									<option value="15" <?php if ( '15' == $options['items'] ) echo 'selected'; ?>>15</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><?php _e( 'Style', 'playbuzz' ); ?></th>
							<td valign="top">
								<input type="radio" name="<?php echo $this->get_option_name(); ?>[view]" value="large_images"      <?php if ( 'large_images'      == $options['view'] ) echo 'checked="checked"'; ?>> <?php _e( 'Large Images',      'playbuzz' ); ?><br><img src="<?php echo plugins_url( 'img/tumbs.jpg',      __FILE__); ?>" title="<?php _e( 'Large Images', 'playbuzz' );      ?>"><br><br>
								<input type="radio" name="<?php echo $this->get_option_name(); ?>[view]" value="horizontal_images" <?php if ( 'horizontal_images' == $options['view'] ) echo 'checked="checked"'; ?>> <?php _e( 'Horizontal Images', 'playbuzz' ); ?><br><img src="<?php echo plugins_url( 'img/image-list.jpg', __FILE__); ?>" title="<?php _e( 'Horizontal Images', 'playbuzz' ); ?>"><br><br>
								<input type="radio" name="<?php echo $this->get_option_name(); ?>[view]" value="no_images"         <?php if ( 'no_images'         == $options['view'] ) echo 'checked="checked"'; ?>> <?php _e( 'No Images',         'playbuzz' ); ?><br><img src="<?php echo plugins_url( 'img/list.jpg',       __FILE__); ?>" title="<?php _e( 'No Images', 'playbuzz' );         ?>">
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e( 'Simple Tags', 'playbuzz' ); ?></th>
							<td>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-mix]"          value="1" <?php if ( '1' == $options['tags-mix']          ) echo 'checked="checked"'; ?>> <?php _e( 'Mix',            'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-fun]"         value="1" <?php if ( '1' == $options['tags-fun']         ) echo 'checked="checked"'; ?>> <?php _e( 'Fun',           'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-pop]"         value="1" <?php if ( '1' == $options['tags-pop']         ) echo 'checked="checked"'; ?>> <?php _e( 'Pop',           'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-geek]"       value="1" <?php if ( '1' == $options['tags-geek']       ) echo 'checked="checked"'; ?>> <?php _e( 'Geek',         'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-sports]"       value="1" <?php if ( '1' == $options['tags-sports']       ) echo 'checked="checked"'; ?>> <?php _e( 'Sports',         'playbuzz' ); ?><br/>
								<input type="checkbox" name="<?php echo $this->get_option_name(); ?>[tags-editors-pick]" value="1" <?php if ( '1' == $options['tags-editors-pick'] ) echo 'checked="checked"'; ?>> <?php _e( 'editorsPicks',   'playbuzz' ); ?><br/>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><?php _e( 'Advanced Tags', 'playbuzz' ); ?></th>
							<td>
								<input type="text" name="<?php echo $this->get_option_name(); ?>[more-tags]" value="<?php echo $options['more-tags']; ?>" class="regular-text" placeholder="<?php _e( 'Comma separated tags', 'playbuzz' ); ?>">
							</td>
						</tr>
						<tr>
							<th scope="row"><?php _e( 'Location of PlayBuzz hub', 'playbuzz' ); ?></th>
							<td>
								<input type="text" name="<?php echo $this->get_option_name(); ?>[links]" value="<?php echo $options['links']; ?>" class="regular-text">
								<p class="description"><?php _e( 'The URL of the page containing the HUB shortcode. Default: http://www.playbuzz.com', 'playbuzz' ); ?></p>
							</td>
								
						</tr>
						<tr>
							<td>
								<hr/>
							<td>
						<tr>
							<th colspan="2"><?php _e( 'Automatically Add Recommendations', 'playbuzz' ); ?></th>
						</tr>
						<tr>
							<th scope="row"><?php _e( 'Active', 'playbuzz' ); ?></th>
							<td>
								<select name="<?php echo $this->get_option_name(); ?>[active]">
									<option value="false" <?php if ( 'false' == $options['active'] ) echo 'selected'; ?>><?php _e( 'Disable', 'playbuzz' ); ?></option>
									<option value="true"  <?php if ( 'true'  == $options['active'] ) echo 'selected'; ?>><?php _e( 'Enable',   'playbuzz' ); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><?php _e( 'Location', 'playbuzz' ); ?></th>
							<td>
								<select name="<?php echo $this->get_option_name(); ?>[show]">
									<option value="header" <?php if ( 'header' == $options['show'] ) echo 'selected'; ?>><?php _e( 'Above the content', 'playbuzz' ); ?></option>
									<option value="footer" <?php if ( 'footer' == $options['show'] ) echo 'selected'; ?>><?php _e( 'Bellow the content', 'playbuzz' ); ?></option>
								</select>
							</td>
						</tr>

						</tr>
					</table>

					<?php submit_button(); ?> 

				</form>

			<?php } ?>

		</div>
		<?php

	}

}



/*
 * Extract tags list
 *
 * @since 0.1
 */
function pb_tags( $options ) {

	// Tags string
	$tags = '';

	// Default tags
	if ( '1' == $options['tags-mix']          ) $tags .= 'All,';
	if ( '1' == $options['tags-fun']         ) $tags .= 'Fun,';
	if ( '1' == $options['tags-pop']         ) $tags .= 'Pop,';
	if ( '1' == $options['tags-geek']       ) $tags .= 'Geek,';
	if ( '1' == $options['tags-sports']       ) $tags .= 'Sports,';
	if ( '1' == $options['tags-editors-pick'] ) $tags .= 'editorsPicks,';
	if ( '1' == $options['tags-tv']           ) $tags .= 'TV,';
	if ( '1' == $options['tags-celebrities']  ) $tags .= 'Celebrities,';

	// Custom tags
	$tags .= $options['more-tags'];

	// Remove the comma from the end
	$tags = rtrim( $tags, ',');

	// Return the tag list
	return $tags;

}
