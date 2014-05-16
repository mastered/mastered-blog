<table class="wpp_input widefat" id="wpp_popup_options">

	<tbody>
		
		<?php do_action( 'wpp_options_meta_box_start', $popup_id ); ?>

		<tr id="status">
			
			<td class="label">
				<label>
					<?php _e( 'Enabled', POPUP_PLUGIN_PREFIX ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<input <?php checked( $options['enabled'], true ) ?> type="checkbox" value="yes" id="ibtn-enable" name="options[enabled]" />
			</td>
			
		</tr>

		<tr id="theme">
			
			<td class="label">
				<label>
					<?php _e( 'Theme', POPUP_PLUGIN_PREFIX ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<select name="options[theme]">
					
					<?php foreach ( $themes as $theme ): ?>
						<option value="<?php echo $theme->id() ?>" <?php selected( $theme->id(), $active_theme ) ?>>
							<?php echo $theme->name() ?>
						</option>
					<?php endforeach; ?>
					
					<?php do_action( 'wpp_html_theme_select' ) ?>
				</select>
			</td>
			
		</tr>

		<tr id="delay_time">
			
			<td class="label">
				<label>
					<?php _e( 'Delay Time', POPUP_PLUGIN_PREFIX ); ?>
				</label>
				<p class="description">Display the popup after the miliseconds you set</p>
			</td>
			<td>
				<label>
					<input type="text" value="<?php echo $options['delay_time'] ?>" name="options[delay_time]" placeholder="Enter time in miliseconds" /> ms
				</label>
			</td>
			
		</tr>

		<tr id="mask_color">
			
			<td class="label">
				<label>
					<?php _e( 'Mask Color', POPUP_PLUGIN_PREFIX ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<label>
					<input type="text" id="mask_color_field" value="<?php echo $options['mask_color'] ?>" name="options[mask_color]" placeholder="Enter the mask color" />
				</label>
				<div id="mask_colorpicker"></div>
			</td>
			
		</tr>

		<tr id="border_color">
			
			<td class="label">
				<label>
					<?php _e( 'Border Color', POPUP_PLUGIN_PREFIX ); ?>
				</label>
				<p class="description"></p>
			</td>
			<td>
				<label>
					<input type="text" id="border_color_field" value="<?php echo $options['border_color'] ?>" name="options[border_color]" placeholder="Enter the border color" />
				</label>
				<div id="border_colorpicker"></div>
			</td>
			
		</tr>

		<tr id="transition">
			
			<td class="label">
				<label>
					<?php _e( 'Transition', POPUP_PLUGIN_PREFIX ); ?>
				</label>
				<p class="description">Set the transition effect</p>
			</td>
			<td>
				<select name="options[transition]">
					
					<option value="elastic" <?php selected( 'elastic', $options['transition'] ) ?>>
							Elastic
					</option>

					<option value="fade" <?php selected( 'fade', $options['transition'] ) ?>>
							Fade
					</option>

					<option value="none" <?php selected( 'none', $options['transition'] ) ?>>
							None
					</option>
					
					<?php do_action( 'wpp_html_transition_select' ) ?>
				</select>
			</td>
			
		</tr>

		<?php do_action( 'wpp_options_meta_box_before_rules', $popup_id ); ?>

		<tr id="rules">
			
			<td class="label">
				<label>
					<?php _e( 'Rules', POPUP_PLUGIN_PREFIX ); ?>
				</label>
				<p class="description">Apply rules to your popup</p>
			</td>
			<td>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_on_homepage'], true ) ?> name="options[rules][show_on_homepage]" value="true" /> Show on homepage
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_only_on_homepage'], true ) ?> name="options[rules][show_only_on_homepage]" value="true" /> Show <strong>only</strong> on homepage
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_to_logged_in_users'], true ) ?> name="options[rules][show_to_logged_in_users]" value="true" /> Show to logged-in users
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['hide_on_mobile_devices'], true ) ?> name="options[rules][hide_on_mobile_devices]" value="true" /> Hide on mobile devices
					</label>
				</p>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['show_only_to_search_engine_visitors'], true ) ?> name="options[rules][show_only_to_search_engine_visitors]" value="true" /> Show only to search engine visitors
					</label>
				</p>

				<?php if ( defined('WPP_PREMIUM_FUNCTIONALITY') &&  WPP_PREMIUM_FUNCTIONALITY ):
					if ( ! isset( $options['rules']['comment_autofill'] ) )
						$options['rules']['comment_autofill'] = false;
				?>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['comment_autofill'], true ) ?> name="options[rules][comment_autofill]" value="true" /> Comment author Name/Email autofill
					</label>
				</p>
				<?php endif; ?>

				<?php if ( defined('WPP_PREMIUM_FUNCTIONALITY') &&  WPP_PREMIUM_FUNCTIONALITY ):
					if ( ! isset( $options['rules']['exit_popup'] ) )
						$options['rules']['exit_popup'] = false;
				?>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['exit_popup'], true ) ?> name="options[rules][exit_popup]" value="true" /> Exit Popup
					</label>
				</p>
				<?php endif; ?>

				<?php if ( defined('WPP_PREMIUM_FUNCTIONALITY') &&  WPP_PREMIUM_FUNCTIONALITY ): ?>
				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['when_post_end_rule'], true ) ?> name="options[rules][when_post_end_rule]" value="true" /> Show only when the visitor's <strong>scrollbar</strong> is at the end of the post or page content.
					</label>
				</p>
				<?php endif; ?>

				<p>
					<label>
							<input type="checkbox" <?php checked( $options['rules']['use_cookies'], true ) ?> name="options[rules][use_cookies]" value="true" /> Use Cookies
					</label>
				</p>

				<p>
					<label>
						<input type="text" value="<?php echo $options['rules']['cookie_expiration_time'] ?>" name="options[rules][cookie_expiration_time]" placeholder="Cookie Expiration Time" /> Days
					</label>
				</p>

			</td>
			
		</tr>


		<?php do_action( 'wpp_options_meta_box_end', $popup_id, $options ); ?>



	</tbody>

</table>