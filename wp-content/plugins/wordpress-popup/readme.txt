=== WordPress PopUp ===
Contributors: WPMUDEV
Tags: popup, popover, advertising, buddypress, wpmu, wpmu plugin, buddypress plugin, making money, SEO, multisite
Requires at least: 3.1
Tested up to: 3.9.1
Stable tag: 4.4.5.4

Allows you to display a fancy popup to visitors, a *very* effective way of advertising a mailing list, special offer or running a plain old ad.

== Description ==

One of the most effective ways to advertise your mailing list, special offer or simply to show ads is via javascript ‘pop over’ on your site. And that’s exactly what his easy-to-use and guaranteed-to-work plugin does.

[youtube  https://www.youtube.com/watch?v=eqhZebtA-SU]

Here is just a taste of what it can do:

- Display fancy pop up(s) (powered as a popover!) to visitors network wide, per site or on specific URLs
- Hassle-free interface. Creating your new pop over is as simple as adding a new post to your WordPress blog.
- Extensive options for customizing who sees your pop overs including logged out users, visitors who have never commented , search engine visitors.
- Includes optional hide a pop over forever.
- Ability to set the amount of time that passes between when the user hits your site and when the pop up displays
- Compatible with any WordPress theme. Customize the style and layout of your pop over to fit with your existing site design.
- Works perfectly with WordPress, Multisite and BuddyPress.
- Use this plugin on any WordPress project you like.

Visitors from our pop over on WPMU.org results in double the number of pages and twice the length of stay compared to visitors that come via Adwords!

And of course it even contains a link allowing users to click it and never see the popover again… just to take care of the complainers! Not that we’ve ever had a single complaint!

Like I said, we use it and now so can you!

Once installed, it’s really simple, just activate it and go to Pop Over > Create New to get started.

Then paste in your ad code… whether its javascript or, like us, an image. And select it’s size, borders, background color, position and even font color.

Then, set the display rules, namely: Show the Pop Over if one of the following checked rules is true:

- Visitor is not logged in.
- Visitor has never commented here before.
- Visitor came from a search engine.
- Visitor did not come from an internal page.
- Visitor referrer matches
- And the visitor has seen the pop over less than  X  times
- Visitor is arriving from a specific link

And you’re good to go!

* <a href='http://premium.wpmudev.org/project/the-pop-over-plugin/'>Download the pro version &raquo;</a>

== Installation ==

WordPress Installation Instructions:

----------------------------------------------------------------------

1) Place the popover directory in the plugins directory
2) Activate the plugin


WPMU Installation Instructions:

----------------------------------------------------------------------

1) Place the popover directory in the plugins directory
2) Network Activate the plugin

For blog by blog, leave as is.

For network wide control - add the line define('PO_GLOBAL', true); to your wp-config.php file.

* You can find <a href='http://premium.wpmudev.org/manuals/installing-regular-plugins-on-wpmu/'>in-depth setup and usage instructions with screenshots here &raquo;</a>

== Screenshots ==

1. The PopUp in action
2. PopUp produces double the number of pages and twice the length of stay compared to visitors that come via Adwords
3. Some of the settings options

== Changelog ==

= 4.4.5.4 =

* Performance improvements
* Fixed issue with dynamic JavaScript loading
* Added PO_PLUGIN_DIR in config for changing plugin directory name

= 4.4.5.2 = 

* Added missing translatable strings
* Updated language file

= 4.4.5.1 = 

* added collation to tables creation code
* updated require calls to include directory path
* moved custom loading out of experimental status
* set default loading method to custom loading

= 4.4.5 =

* Added different custom loading method that should be cache resistant and remove issues with other ajax loading method.
* Made On URL rule more specific so that it doesn't match child pages when the main page is specified

= 4.4.4 = 

* Added option to switch from JS loading to standard loading of pop ups.
* Added ability to use regular expressions in the referrers and on url conditions.
* Prepared code to make it easy to upgrade interface for future releases.

= 4.4.3 = 

* Updated for WP 3.5
* Added initial attempt to distinguish referrers from Google search and referrers from Google custom site search.

= 4.4.2 = 

* Removed unneeded css and js files
* Updated language file

= 4.4.1 = 

* Moved popover loading js to be created by a php file due to needing extra processing.
* Fixed issue with directory based sites loading popover script from main site.
* Fixed issue of popover loading on login and register pages.

= 4.4 =

* Updated Popover to load via ajax call rather than page creation for cache plugin compatibility

= 4.3.2 =
* Major rewrite
* Multiple PopUps can be created
* Fixed issue of network activation not creating tables until admin area visited
* Updated code to remove all notifications, warnings and depreciated function calls ready for WP 3.4

= 3.1.4 =
* WP3.3 style updating

= 3.0 =
* Initial release