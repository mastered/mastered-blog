<?php
/*
 * Game / Post Shortcode
 * Display a specific game/post in a desired location on your content.
 *
 * usage: [playbuzz-game game="jonathang/players-and-playmates-playoffs"]
 *
 * @since 0.1
 */
add_shortcode( 'playbuzz-game', 'playbuzz_shortcode' );
add_shortcode( 'playbuzz-post', 'playbuzz_shortcode' );



/*
 * Hub / Archive Shortcode
 * Display a list of games/posts according specific tags in a desired location on your content.
 *
 * usage: [playbuzz-hub tags="Celebrities"]
 *
 * @since 0.1
 */
add_shortcode( 'playbuzz-hub',     'playbuzz_hub_shortcode' );
add_shortcode( 'playbuzz-archive', 'playbuzz_hub_shortcode' );



/*
 * Recommendations / Related-Content Shortcode
 * Display Playbuzz related playful content links and recommendations according specific tags in a desired location on your content.
 *
 * usage: [playbuzz-recommendations tags="Celebrities" links="http://www.mysite.com/url_in_your_site_where_you_displayed_playbuzz_games"]
 *
 * @since 0.1
 */
add_shortcode( 'playbuzz-related',         'playbuzz_recommendations_shortcode' );
add_shortcode( 'playbuzz-recommendations', 'playbuzz_recommendations_shortcode' );



/*
 * Shortcode functions
 *
 * @since 0.1.1
 */
function playbuzz_shortcode( $atts ) {

	// Load options
	$options = get_option( 'playbuzz' );

	// Attributes with default values
	extract( shortcode_atts(
		array(
			'key'       => $options['key'],                                     // api key allowing configuration and analytics
			'tags'      => pb_tags( $options ),                                 // filter by tags
			'game'      => '',                                                  // defines the game that will be loaded by the IFrame
			'info'      => ( '1' == $options['info'] ? 'true' : 'false' ),      // show game info (thumbnail, name, description, editor, etc)
			'shares'    => ( '1' == $options['shares'] ? 'true' : 'false' ),    // show sharing buttons 
			'comments'  => ( '1' == $options['comments'] ? 'true' : 'false' ),  // show comments control from the game page.
			'margintop'      => $options['margin-top'],                              // margin top for score bar in case there is a floating bar
			'recommend' => ( '1' == $options['recommend'] ? 'true' : 'false' ), // show recommendations for more games
		), $atts )
	);

	// PlayBuzz Embed Code
	if ( is_singular() ) {

		return '
			<script type="text/javascript" src="http://www.playbuzz.com/bundles/feed"></script>
			<div class="pb_feed" data-key="' . $key . '" data-tags="' . $tags . '" data-game="' . $game . '" data-game-info="' . $info . '" data-comments="' . $comments . '" data-shares="' . $shares . '" data-recommend="' . $recommend . '" data-margin-top="' . $margintop . '"></div>
		';

	} elseif ( is_archive() ) {

		return '';

	}

}

/*
 * Shortcode functions
 *
 * @since 0.1.4
 */
function playbuzz_hub_shortcode( $atts ) {

	// Load options
	$options = get_option( 'playbuzz' );

	// Attributes with default values
	extract( shortcode_atts(
		array(
			'key'       => $options['key'],                                     // api key allowing configuration and analytics
			'tags'      => pb_tags( $options ),                                 // filter by tags
			'game'      => '',                                                  // defines the game that will be loaded by the IFrame
			'info'      => ( '1' == $options['info'] ? 'true' : 'false' ),      // show game info (thumbnail, name, description, editor, etc)
			'shares'    => ( '1' == $options['shares'] ? 'true' : 'false' ),    // show sharing buttons 
			'comments'    => ( '1' == $options['comments'] ? 'true' : 'false' ),    // show comments control from the game page.
			'margintop'      => $options['margin-top'],                              // margin top for score bar in case there is a floating bar
			'recommend' => ( '1' == $options['recommend'] ? 'true' : 'false' ), // show recommendations for more games
		), $atts )
	);

	// PlayBuzz Embed Code
	return '
		<script type="text/javascript" src="http://www.playbuzz.com/bundles/feed"></script>
		<div class="pb_feed" data-key="' . $key . '" data-tags="' . $tags . '" data-game="' . $game . '" data-game-info="' . $info . '" data-comments="' . $comments . '" data-shares="true" data-recommend="' . $recommend . '" data-margin-top="' . $margintop . '"></div>
	';
}

function playbuzz_recommendations_shortcode( $atts ) {

	// Load options
	$options = get_option( 'playbuzz' );

	// Attributes with default values
	extract( shortcode_atts(
		array(
			'key'     => $options['key'],     // api key allowing configuration and analytics
			'view'    => $options['view'],    // set view type
			'items'   => $options['items'],   // number of items to display
			'links'   => $options['links'],   // url in your site where you displayed playbuzz posts
			'tags'    => pb_tags( $options ), // filter by tags
			'nostyle' => 'false',             // set style
		), $atts )
	);

	// PlayBuzz Embed Code
	if ( is_singular() ) {

		return '
			<script type="text/javascript" src="http://www.playbuzz.com/bundles/widgets"></script>
			<div class="pb_recommendations" data-key="' . $key . '" data-tags="' . $tags . '" data-view="' . $view . '" data-num-items="' . $items . '" data-links="' . $links . '" data-nostyle="' . $nostyle . '"></div>
		';

	} elseif ( is_archive() ) {

		return '';

	}

}
