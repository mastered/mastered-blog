<?php

if ( isset( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated fade"><p><strong>All settings saved.</strong></p></div>';

?>
<div class="wrap wpp_settings_wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2><?php echo __( 'Settings' , POPUP_PLUGIN_PREFIX ) ?></h2>
 	<br />
	<div class="wpp_settings_opts">
		<form method="post">

			<div class="wpp_settings_section">

				<div class="wpp_settings_title">
					<h3>
						<img src="<?php echo wpp_image_url("trans.png") ?>" class="inactive" alt="">
						General</h3>
						<span class="submit">
							<input type="submit" name="saved" class="button button-primary" value="Save changes" />
						</span>
					<div class="clearfix"></div>
				</div>


				<div class="wpp_settings_options">
					
					<div class="wpp_settings_input wpp_settings_select">

						<label for="email_service">Email service</label>
						<select id="email_service" name="settings[email_service]">
							<option value="mailchimp" <?php selected( 'mailchimp' , $settings['email_service']) ?>>Mailchimp</option>

							<?php do_action( 'wpp_settings_email_service_select',$settings['email_service'] ) ?>
						</select>
						<small>Select your email marketing service</small>

					</div>

					<div class="wpp_settings_input wpp_settings_text">

						<label for="redirect_url">Redirect URL</label>
						<input type="text" id="redirect_url" name="settings[redirect_url]" value="<?php echo $settings['redirect_url'] ?>" />
							
						<small>Leave it empty if you don't want to redirect the subscriber after he/she successfully submitted his/her email address</small>

					</div>

					<div class="wpp_settings_input wpp_settings_textarea">

						<label for="inline_thanks_message">In-popup thanks message</label>
						<textarea id="inline_thanks_message" name="settings[inline_thanks_message]"><?php echo $settings['inline_thanks_message'] ?></textarea>
							
						<small>If the redirect url field is empty then the content from this field will be shown in the popup as a thanks message or success message</small>

					</div>


					<div class="wpp_settings_input wpp_settings_textarea">

						<label for="unknown_error">Unknown error message</label>
						<textarea id="unknown_error" name="settings[error_message][unknown]"><?php echo $settings['error_message']['unknown'] ?></textarea>
							
						<small>This error message will be shown inside the popup with the error message from your email marketing service</small>

					</div>

					<div class="wpp_settings_input wpp_settings_textarea">

						<label for="subscriber_alredy_exist_error">Subscriber already exist error</label>
						<textarea id="subscriber_alredy_exist_error_error" name="settings[error_message][subscriber_already_exist]"><?php echo $settings['error_message']['subscriber_already_exist'] ?></textarea>
							
						<small>This message will be shown inside the popup when the email used by the subscriber already exist in your email list</small>

					</div>

				</div>

			</div>
			<!-- General Section End -->

			<!-- Mailchimp Section start -->

			<div class="wpp_settings_section">

				<div class="wpp_settings_title">
					<h3>
						<img src="<?php echo plugins_url( "images/trans.png", POPUP_PLUGIN_MAIN_FILE ) ?>" class="inactive" alt="">
						Mailchimp</h3>
						<span class="submit">
							<input type="submit" name="saved" class="button button-primary" value="Save changes" />
						</span>
					<div class="clearfix"></div>
				</div>

				<div class="wpp_settings_options">

					<div class="wpp_settings_input wpp_settings_textarea">

						<label for="mailchimp_api_key">API Key</label>
						<input type="text" id="mailchimp_api_key" name="settings[mailchimp][api_key]" value="<?php echo $settings['mailchimp']['api_key'] ?>" />
							
						<small><a target="_blank" href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key/">Where can I find my API Key?</a></small>

					</div>

					<div class="wpp_settings_input wpp_settings_textarea">

						<label for="mailchimp_list_id">List ID</label>
						<input type="text" id="mailchimp_list_id" name="settings[mailchimp][list_id]" value="<?php echo $settings['mailchimp']['list_id'] ?>" />
							
						<small><a target="_blank" href="http://kb.mailchimp.com/article/how-can-i-find-my-list-id">How can I find my List ID?</a></small>

					</div>

				</div>

			</div>

			<!-- Mailchimp Section end -->

			<?php do_action( 'wpp_settings_page_end', $settings ) ?>

			<input type="hidden" value="<?php echo $nonce ?>" name="nonce" />
		</form>
	</div>

</div>

<style>

.wpp_settings_wrap{
	width:740px;
}
.wpp_settings_section{
	margin-top: 10px;
	border:1px solid #ddd;
	border-bottom:0;
	background:#f9f9f9;
}
.wpp_settings_opts label{
	font-size:12px;
	font-weight:700;
	width:200px;
	display:block;
	float:left;	
}
.wpp_settings_input {
	padding:30px 10px;
	border-bottom:1px solid #ddd;
	border-top:1px solid #fff;
}
.wpp_settings_opts small{
	display:block;
	float:right;
	width:200px;
	color:#999;
}
.wpp_settings_opts input[type="text"], .wpp_settings_opts select{
	width:280px;
	font-size:12px;
	padding:4px;
	color:#333;
	line-height:1em;
	background:#f3f3f3;
}
.wpp_settings_input input:focus, .wpp_settings_input textarea:focus{
	background:#fff;
}
.wpp_settings_input textarea{
	width:280px;
	height:175px;
	font-size:12px;
	padding:4px;
	color:#333;
	line-height:1.5em;
	background:#f3f3f3;
}
.wpp_settings_title h3 {
	cursor:pointer;
	font-size:1em;
	text-transform: uppercase;
	margin:0;
	font-weight:bold;
	color:#232323;
	float:left;
	width:80%;
	padding:14px 4px;
}
.wpp_settings_title{
	cursor:pointer;
	border-bottom:1px solid #ddd;
	background:#eee;
	padding:0;
}
.wpp_settings_title h3 img.inactive{
	margin:-8px 10px 0 2px;
	width:32px;
	height:32px;	
	background:url('<?php echo wpp_image_url("pointer.png") ?>') no-repeat 0 0;
	float:left;
	-moz-border-radius:6px;
	border:1px solid #ccc;
}
.wpp_settings_title h3 img.active{
	margin:-8px 10px 0 2px;
	width:32px;
	height:32px;	
	background:url('<?php echo wpp_image_url("pointer.png") ?>') no-repeat  0 -32px;
	float:left;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border:1px solid #ccc;
}		
.wpp_settings_title h3:hover img{
	border:1px solid #999;
}
.wpp_settings_title span.submit{
	display:block;
	float:right;
	margin:0;
	padding:0;
	width:15%;
	padding:14px 0;
}
.clearfix{
	clear:both;
}
.wpp_settings_table th, .wpp_settings_table td{
	border:1px solid #bbb;
	padding:10px;
	text-align:center;
}
.wpp_settings_table th, .wpp_settings_table td.feature{
	border-color:#888;
}
.wpp_settings_options{
	display: none;
}
</style>

<script>
jQuery(document).ready(function(){
		jQuery('.wpp_settings_options').slideUp();
		
		jQuery('.wpp_settings_section h3').click(function(){		
			if(jQuery(this).parent().next('.wpp_settings_options').css('display')==='none')
				{	jQuery(this).removeClass('inactive').addClass('active').children('img').removeClass('inactive').addClass('active');
					
				}
			else
				{	jQuery(this).removeClass('active').addClass('inactive').children('img').removeClass('active').addClass('inactive');
				}
				
			jQuery(this).parent().next('.wpp_settings_options').slideToggle('slow');	
		});
});
</script>