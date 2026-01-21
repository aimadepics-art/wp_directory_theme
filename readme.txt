=== Maddos Directory Theme ===
Theme URI: www.superblogme.com/store/products/maddos-directory-theme/
Author: Super Blog Me
Author URI: https://www.superblogme.com/
Tags: theme, directory, review
Requires at least: 4.7
Tested up to: 6.4.3
Stable Tag: 2.8.2

Maddos is directory style review theme for WordPress

== Description ==

Maddos is directory style review theme for WordPress with header, content, and
footer sections. It has a dynamic layout where the home page content shows 1-4
columns of categories and their posts. Post links are to the external site 
url and/or internal single post reviews. Single posts have the featured image,
review content and ratings, and links to related posts in the same category.

= 2.8.2 - Released Febrary 26th, 2024 =

* Fix for remove_action to match add_action parameters.
* Fix for any site header location with relative url using an absolute url in parameters.
* Added filters maddos_post_archive_title_htag, maddos_post_archive_desc_htag, and maddos_post_single_title_htag.

= 2.8.1 - Released April 6th, 2023 =

* css fix for image header possibly cropped on mobile
* bootstrap_navwalker now uses item->attr_title over item->title
* Fix for scrollbar on mobile devices.
* Fix for show thumbnail on hover.
* More debug messages on archive pages.
* Extra check if WordPress returns false on theme update transient.
* Extra checks on wp_upload_bits return info.
* Fix for comments showing post id in post title.
* Adjustments for Next/Prev page and WP_PageNavi support.
* Fix for archive posts with no Site URLs - show post permalink instead.
* Fix for grid archive layout
* If still using deprecated alexaRank for post order, 'none' will be used instead.

= 2.8 - Released December 26th, 2022 =

* Added ability to Auto Detect website title, description, and tags.
* Removed support for Alexa ranking (retires Dec 2022). No free alternatives.
* UI fix - archive grid container width 
* Added new filters

= 2.7 - Released June 2nd, 2022 =

* Related Posts Options - Added setting for round (default) or square thumbnail display.
* Replaced deprecated PageSpeed v3 API mobile test with Google v1 API mobileFriendlyTest.
* Removed deprecated Maddos code options.
* Updated deprecated jQuery function calls.
* Bugfix: do not display hamburger icon on mobile devices if no menu.
* CSS tweak: .maddos-widget-title with height:auto
* Bugfix: Handle servers that return a header redirect with a relative url address.
* OptionTree bugfix: security issue verify nonce.
* Added filter 'maddos_site_icon_url'
* Bugfix: Tag archive pages fixed.
* Bugfix: Google s2 favicons service sometimes gets confused on http vs https. Include scheme on fetch url.

= 2.6.3 - Released July 18th, 2020 =

* Bugfix: esc_url used for any malformed site_urls

= 2.6.2 - Released April 25th, 2020 =

* Enabled Archive Post Links to select Site Url or post review page.
* Added 'maddos_archive_link' filter if user wants to change permalink.
* CSS tweaks for link-header padding

= 2.6.1 - Released April 17th, 2020 =

* Added notice if Alexa API has blacklisted your IP.
* Fix: Directory pages now ignore the content filter when checking for empty content.
* Fix: Comment From field not displaying properly.
* Tweak the Theme Update Checker schedule

= 2.6 - Released March 12th, 2020 =

* Changed hover-thumb size from 253xX to 255x200 cropped so ensure equal grid size.
* Set default fonts to Arial.
* Removed plugin recommendation for Easy Affiliate Links.
* Added Widget Context to recommended plugins.
* Added plugin recommendation for Taxonomy Terms Order.
* Removed plugin recommendation for Intuitive Custom Post Order.
* alexaRating change to be more compatible with WP_Query. Non-ranked sites are given fake alexa rating 999999999.
* Directory pages now show page content before the Directory.
* Fix for alexaRank order on Archive Pages, related posts section.
* Site Icon: Check for 'blank' icon and use local copy instead.
* Site Icon: Check for default Google 'globe' icon and default website 'arrow' icon and use local copy instead.
* New and improved grid format.
* Archive pages: post title now links to single post page.
* Archive pages: post categories now link to category pages.
* Adjusted header tags on post entries for archive pages vs single post page.
* Updated Font Awesome from 4.7 to 5.12.1
* Added wp_title support.
* Fixed Open/Close icon +/x
* Custom code split into Maddos Theme Extensions plugin (required).
* Updated .pot file
* 100% W3 Validation.
* Added support for comment Avatars.
* Maddos Post Info Metabox: Added Options for new tab/nofollow/exclude from Directory.
* Cascading target and rel options. Post Metabox > Maddos Widget and Post Metabox > Maddos Post Options.
* Create and set default blog automatically when activating theme, if needed.
* Fixed possible issue with color picker in Option Tree.
* Added up/down ranking chevrons if ordering Maddos Directory Widget posts by alexaRank.
* Site and Category icons now show on sub-pages.
* Removed deprecated 'Maddos Column' from Dashboard Posts->Categories.
* Empty Directory page will show 4 default columns with 'Add Widgets' link.
* Position tweak for hover thumbs visibility.
* Added alt and title tags to hover thumbs on Directory pages.
* Create and set default Homepage Directory automatically when activating theme, if needed.
* Added support for galleries.
* Directory pages now fully widgetized!
* Updated Option Tree to 2.7.3, PHP 5.3+ required.
* Added missing alt/title tags on single post featured image.

= 2.4.0.1 - Released October 2nd, 2019 =

* Fix for apply_filter typo.

= 2.4 - Released October 1st, 2019 =

* Added option to support different Directory categories for mobile devices.
* Added filter 'maddos_url_alexa_override' to override websites that redirect based on geo location.
* Fix for some websites that do not recognize the default WordPress user-agent and return weird responses.
* When fetching site_url, ignore any server redirect to 127.0.0.1
* Do not display default 'Add a menu' in wp_nav_menu callback if echo is false.
* Fix sanitization in page-nav.php
* Added more filters for user customizations.

= 2.3.1 - Released May 25th, 2019 =

* Bugfix for websites that return relative URL header locations.

= 2.3 - Released May 14th, 2019 =

* Added more validation and sanitization.
* W3C Validated.
* Made sticky posts 1st on all pages.
* Fix for meta refresh header check.
* Added Directory Option to set Category Background Color/Image
* Issue with using wp_remote_retrieve_header function.
* Detect site_urls that redirect back to themselves.
* Site Url: also detect sites that return meta refreshes to get final url.
* Bugfix when a remote server returns localhost as location.
* Suppress XML warnings when fetching Alexa API data.
* Bugfix for recognizing first sentence in category description for Directory setting.
* Bugfix for showing featured image if site_url is empty.

= 2.2 - Released February 7th, 2019 =

* Added a Sprite Helper in Maddos Settings.
* Related posts will use all the post's categories not just one.
* Single posts will now show all categories not just one.
* Updated superblogme.com links to https.
* Added more filters.
* Added warning message if trying to use Maddos without a license.

= 2.1 - Released December 1st, 2018 =

* Fix for beta checks.
* CSS tweaks for review description scrollbar class '.maddos-content-scroll'.
* Directory Options - Added 'Directory Category Description' to choose how to display.
* Archive Options - Added 'Archive Taxonomy Description' to choose how to display.
* Added option to show Maddos review page with scrollbar.
* List layout - use larger image size if on mobile device.
* Ensure site screeshot fills full width of column.

= 2.0 - Released November 16th, 2018 =

* Added rel='noopener' for external Site Url links to prevent window hijacking.
* Added Related Post Options as separate page in Maddos Settings.
* Header Options - Added 'Link Header Image' to link image to home page.
* Directory Options - Added 'Directory Post Links' for optionable way to generate post links.
* Related Posts Options - Added 'Related Post Links' for optionable way to generate post links.
* General Options - Added 'Load Font Awesome' for those who may not use it.
* Archive Options - Added 'Archive Post Links' for optionable way to generate post links.
* Post Options - Added separate 'Nofollow Site Urls' for related posts.
* License - Added 'Check for Beta Updates?' setting.
* Options for 'Nofollow external links' is now 'Nofollow Site Urls' and applies to Site Urls only. 
* Added some missing alt and title tags to links.
* Bugfix - Don't show menu icon on mobile devices if no menu.
* Added filters for bootstrap and font-awesome URLs.
* Category descriptions will now show on Directory page as well as category pages.
* added single post css class for link text.
* allow html in footer copyright text
* bugfix on header image, category icons and menus showing html
* Bugfix for category max-height using double quotes.
* Added alt and title tags on single post thumbnails.

= 1.9 - Released November 5th, 2018 =

* Added more translation strings. Updated .pot file.
* Directory Options - Added 'Show Open/Close buttons on Categories?' to expand/collapse the category list.
* Directory Options - Added 'Show Site Review icons only on Hover?' to support always showing site review icons.
* Post Options - Added 'Nofollow external site links'
* Added filter to customize showing WP-PostRatings on single posts.
* Added extra checks and filters for screenshot import success.
* Added 3 fallback methods for importing screenshot if 1 fails.
* Force WordPress to save site_icon as https if using SSL.
* Fix for ACF plugin changes.
* Bootstrap & Font Awesome now internal, Easy Bootstrap plugin no longer required.
* [OptionTree fix](https://github.com/valendesigns/option-tree/issues/679) for not showing Colorpicker hex field in WordPress 4.9+.

= 1.8 - Released June 1st, 2018 =

* Added option to 'nofollow' external links in Maddos Directory Options.
* Added page number to archive multi-page h1 tag.
* Use hover-thumb image size for post content list/grid pages.
* Bugfix 'image on hover' border to be on image not the column it is in.

= 1.7.2 - Released April 16th, 2018 =

* Bugfix - javaScript hover was not triggering correctly.

= 1.7.1 - Released April 9th, 2018 =

* Ensure WP loads fresh js/css files with each version.
* replace OptionTree Google API key with Maddos Google API key.
* removed Pingbacks. Not used.

== Changelog ==

= 1.7 - Released December 13th, 2017 =

* Improved auto detect fetch times for Site Url screenshots.
* Saving a post with a cloak/redirect Site Url will now save the 'true' url as a custom field to help prevent dupes.
* Admin will now show a warning if publishing a post with a duplicate site url as another. Works with cloaks/redirects too.
* Admin will now show a warning if expected Column Categories are not selected.
* Removed favico Maddos theme option. Instead use native WordPress Appearance->Customize->Site Identity->Site Icon.
* Upgraded TGM Plugin Activation to 2.6.1
* Added Easy Affiliate Links to recommended plugins. Easy way to cloak affiliate links.
* Added User Submitted Posts to recommended plugins. Integrated plugin for visitors to submit a site for possible addition to the Directory.
* Admin will now show a warning to enter license information.
* Added Maddos Column to WordPress Posts->Categories subpanel.
* Added Maddos Theme quick links in WordPress admin bar.

= 1.6.4 - Released March 21st, 2017 =

* Bugfix for menu CSS styling.
* Bugfix for WP duplicate posts if no sticky posts defined.

= 1.6.3 - Released March 20th, 2017 =

* Added support for sticky posts - will show a 'star' icon on Directory page.
* Added filter 'maddos_directory_post_target' to override default target on Directory.
* Bugfix for post CSS matching when using grid archive format.

= 1.6.2 - Released January 5th, 2017 =

* Bugfix for Maddos archive order settings applying to WP admin pages.

= 1.6.1 - Released October 10th, 2016 =

* Added 'maddos_get_review_link' filter hook.
* Added minimum PHP/WP check on theme switch.

= 1.6 - Released Aug 22th, 2016 =

* Added Header Option to change typography for Site Title and Description.
* Added recommended plugin 'Menu Icons'.
* Added CSS, JS tweaks, mostly for mobile devices.
* Added Archive Options section to Maddos Settings.
* Added Archive Layout setting - list or grid format.
* Moved Posts Order setting from Directory to Archive Options.
* Posts Order setting now applies to all archive pages (Directory, category pages, search result pages, etc)
* Do not show Directory hover thumbnails on mobile devices.
* Filter 'maddos_category_posts' renamed 'maddos_directory_posts'.
* Bugfix: Clear theme hooks when deactivated.
* Bugfix: Import from file was not getting correct post title.
* Bugfix for css class 'maddos-link-container'. Thx to Smut-Talk.
* Bugfix for double nested anchor tag in maddos-review. Thx to Smut-Talk.

= 1.5.1 - Released Aug 4th, 2016 =

* Fixed minor display issue on single post maddos format - image was slightly smaller than container.
* Added 'internet' icon on Site Url post field to open in new window.
* Fix for box-shadow changes on elements.

= 1.5 - Released July 30th, 2016 =

* Added Metabox to Pages to set categories for that page. This allows multiple Directory Pages!
* Added ability to split maddos post format into sections with keyword <!--maddossplit-->. See docs.
* Added Post Option to order the related posts.
* Moved post tags into post meta header.
* Header image missing responsive tag fix.

= 1.4 - Released July 16th, 2016 =

* Added General Options->Use Text Shadow to toggle text shadows.
* Bugfix: header image now uses actual image size not just fill header image area.
* Screenshots now named after post title not url.

= 1.3.2 - Released July 14th, 2016 =

* WordPress error messages will be displayed to the screen, such as timeouts waiting for an API response.
* Import from File: Added filter to change auto detection if desired.
* Code changes to workaround any servers with allow_url_fopen set to Off.
* Bugfix for daily alexa ranking updates.

= 1.3.1 - Released July 13th, 2016 =

* Import from File: Reset PHP max execution time if needed.
* Import from File: Ensure site icon urls do not have query parameters.

= 1.3 - Released July 12th, 2016 =

* Added option to order category posts by the Site Url's Alexa Ranking.
* Site Url Alexa Rankings now automatically update daily in the background.
* More filters, hooks, examples for customizations.
* Split Post Display Override Options for more control.
* Added Header Option to not show Search Form.
* Added ability to import from any text file in Post Options. See docs.

= 1.2 - Released July 8th, 2016 =

* Added Auto Detect ability to capture Site Url screenshot and set it as featured image.
* Added column parameter to 'maddos_category_posts' filter for custom orders. Doc example.
* Change: Archive pages will now show results in list format with post excerpt.
* Bugfix: Related posts will now link to post if Site Url is not defined.

= 1.1 - Released July 4th, 2016 =

* Added .pot translation file.
* Added Theme->Directory Option to show 'new' icon for new posts.
* Added Theme->Post Option for display overrides.
* Added MetaBox for the Maddos post info on Post Edit page.
* Site Url Auto Detect will now follow redirects automatically on Post Edit page.
* Added Alexa information to Post Edit page.
* Added Site Icon to display on Post Edit page.
* Added Additional Icon field on Post Edit page.
* Search results now only show posts with content by default.
* Bugfix: Pagenav on category pages.
* Bugfix: Only display mobile menu icon if menu is assigned.
* Updated documentation with above.


= 1.0 - Released June 23rd, 2016 =

* Initial Release

