=== Solve Media CAPTCHA ===
Contributors: Ilia Fishbein, Jeff Weisberg
Tags: akismet, captcha, registration, contact form 7, advertising, anti-spam, plugin, solve media, spam, captcha advertising, security, monetize, type-in, security captcha, iPhone, iPad, Blackberry, Android, Windows Phone 7, WPMS, BuddyPress
Requires at least: 2.8.4
Tested up to: 3.3.1
Stable tag: 1.1.0

Secure & Monetize your site with Solve Media's CAPTCHA replacement.


== Installation ==

In order to properly integrate the Solve Media CAPTCHA plugin, you must perfrom the follwing steps.

1. Sign up for a free Solve Media account on the [Solve Media registration page](http://portal.solvemedia.com/portal/public/signup)
1. Upload the entire `solvemedia` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Set the public, private and hash keys in the Solve Media admininstrative panel found under the 'Plugins' menu
1. Enable/Disable the Solve Media widget on the user registration form, comments section, or Contact-Form-7 forms.

Add [solvemedia solvemedia-1] to a Contact-Form-7 text area to use the Solve Media CAPTCHA replacement on a contact form.

Add `<?php do_action('comment_form', $post-\>ID); ?>` to the comments.php file of your theme if it is not already there. Otherwise, the code to display CAPTCHA never gets called.

For basic usage, you can also have a look at the [plugin homepage](http://portal.solvemedia.com/portal/help/pub/wp/).

== Frequently Asked Questions ==

= I use a non-default theme and the widget doesn't show up in the comments. =

The comments.php file of your theme must have code that handles actions associated with the "comment_form" hook. Otherwise, the code to display CAPTCHA never gets called.
The code should appear after the "Submit Comment" button and read:
`<?php do_action('comment_form', $post-\>ID); ?>`

== Screenshots ==

1. Solve Media puzzle on registration
2. Solve Media puzzle on comments
3. Solve Media puzzle on a Contact-Form-7 contact form
4. Solve Media plugin configuration page
5. Adding the Solve Media puzzle to a Contact-Form-7 form

== Changelog ==

= 1.1.0 =
* WPMS and BuddyPress support
* Bug fixes

= 1.0.6 =
* Bug fix - fixed a bug that caused the puzzle to reload if the Contact-Form-7 option was enabled and other plugins that use AJAX were present

= 1.0.5 =
* Bug fix - fixed a bug that resulted from a style change in the default WordPress theme in version 3.0.1

= 1.0 =
* Initial Release 

== Upgrade Notice ==

= 1.1.0 =
This version provides full support for WPMS and the WordPress sites that use the BuddyPress plugin

= 1.0.6 =
This version fixes an issue that would cause the puzzle to reload when other plugins made AJAX calls.

= 1.0.5 =
This version fixes a style issue that make the CAPTCHA TYPE-IN™ creative unreadable in the comments section in IE6

== Description ==

= Secure & Monetize your site with Solve Media's free CAPTCHA replacement. =

CAPTCHA is a simple and popular method of securing forms from abuse. Solve Media has created a patent-pending technology that turns CAPTCHA into branded TYPE-INs™, allowing you to earn money while you secure your site. Every time a visitor to your site solves a CAPTCHA TYPE-IN™ ad, we share the revenue with you. Solve Media CAPTCHA TYPE-IN™ ads are easy to read and easy to complete. Our systems constantly monitor for various forms of abuse, insuring that an optimal amount of revenue and security is provided. For visually impaired users, the Solve Media CAPTCHA widget offers an audio CAPTCHA puzzle.

Use the Solve Media CAPTCHA widget on a registration form, comments form, or any Contact-Form-7 v2.0 or newer. The Solve Media CAPTCHA widget is compatible with other anti-spam solutions like Akismet. The Solve Media CAPTCHA widget works with nearly 100% of all browsers including mobile devices like the iPad, iPhone, Blackberry, Android and Windows PHone 7 devices, regardlress of Flash or Javascript capabilities.

Visit the [Solve Media homepage](http://www.solvemedia.com) for more information about our CAPTCHA solution.

