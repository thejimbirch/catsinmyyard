=== BBQ: Block Bad Queries ===

Plugin Name: Block Bad Queries (BBQ)
Plugin URI: https://perishablepress.com/block-bad-queries/
Description: Automatically protects WordPress against malicious URL requests.
Tags: security, protect, firewall, php, eval, malicious, url, request, blacklist
Usage: No configuration necessary. Upload, activate and done. BBQ blocks bad queries automically to protect your site against malicious URL requests.
Author: Jeff Starr
Author URI: http://monzilla.biz/
Contributors: specialk, aldolat, WpBlogHost, James Wilkes, juliobox
Donate link: http://m0n.co/donate
Requires at least: 3.9
Tested up to: 4.2
Stable tag: trunk
Version: 20150507
License: GPLv2 or later

Block Bad Queries (BBQ) helps protect WordPress against malicious URL requests. 

== Description ==

[Block Bad Queries (BBQ)](https://perishablepress.com/block-bad-queries/) is a simple script that protects your website against malicious URL requests. BBQ checks all incoming traffic and quietly blocks bad requests containing nasty stuff like eval(, base64_, and excessively long request-strings. This is a simple yet solid solution that works great for sites where .htaccess is not available. The BBQ script is available as a plugin for WordPress or standalone script for any PHP-powered website.

**Features include**

* Plug-n-play functionality
* No configuration required
* Born of simplicity, no frills
* Blocks a wide range of malicious requests
* Based on the [5G/6G Blacklist](https://perishablepress.com/6g-beta/)
* Scans all incoming traffic and blocks bad requests
* Works silently behind the scenes to protect your site
* New! Customize blocked strings via [Whitelist/Blacklist plugins](https://perishablepress.com/bbq-whitelist-blacklist/)

== Installation ==

To protect your site using this lightweight plugin, unzip and upload the "/block-bad-queries/" folder and contents to your plugin directory and activate via the WP Admin. No configuration necessary. Upload, activate and done. BBQ blocks bad queries automically to protect your site against malicious URL requests. Once active, this plugin will silently and effectively close any connections for these sorts of injection-type attacks.

[More info on installing WP plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins)

**Notes**

* To allow strings otherwise blocked by BBQ, check out the [BBQ Whitelist plugin](https://perishablepress.com/bbq-whitelist-blacklist/)
* To block strings otherwise allowed by BBQ, check out the [BBQ Blacklist plugin](https://perishablepress.com/bbq-whitelist-blacklist/)

== Upgrade Notice ==

To upgrade BBQ, remove old version and replace with new version. Nothing else needs done.

== Screenshots ==

No screenshots available - code only.

== Changelog ==

**2015/05/07**

* Tested with WP 4.2 and 4.3 (alpha)
* Replaced some "http" with "https" in readme.txt

**2015/03/14**

* introduce bbq_core()
* tested on latest WP
* tightened up code

**2014/09/22**

* tested on latest version of WordPress (4.0)
* retested on Multisite
* increased minimum version requirement to WP 3.7

**2014/03/05**

* Bugfix: added conditional checks for empty variables

**2014/01/23**

* tested on latest version of WordPress (3.8)
* added link to rate plugin

**2013/11/03**

* removed "?>" from script
* added optional line for blocking long URLs
* added line to prevent direct access to BBQ script
* added "\;Nt\.", "\=Nt\.", "\,Nt\." to request URI items
* tested on latest version of WordPress (3.7)

**2013/07/07**

* replaced "Nt\." with "\/Nt\." (resolves comment editing/approval issue)

**2013/07/05**

* removed "https\:" (from previous version)
* replaced "\/https\/" with "\/https\:"
* replaced "\/http\/" with "\/http\:"
* replaced "\/ftp\/" with "\/ftp\:"

**2013/07/04**

* removed block for "jakarta" in user-agents
* removed "union" from query strings
* added to request-URI: "\%2Flocalhost", "Nt\.", "https\:", "\.exec\(", "\)\.html\(", "\{x\.html\(", "\(function\("
* resolved PHP Notice "Undefined Index" via isset()

**2013/01/03**

* removed block for CONCAT in request-URI
* removed block for "environ" in query-string
* removed block for "%3C" and "%3E" in query-string
* removed block for "%22" and "%27" in query-string
* removed block for "[" and "]" in query-string (to allow unsafe characters used in WordPress)
* removed block for "?" in query-string (to allow unsafe character used in WordPress)
* removed block for ":" in query-string (to allow unsafe character used by Google)
* removed block for "libwww" in user-agents (to allow access to Lynx browser)

**2012/11/08**

* Removed ":" match from query string (Google disregards encoding)
* Removed "scanner" from query string from query string match
* Streamlined source code for better performance (thanks to juliobox)

**Older versions**

* 2012/10/27 - Disabled check for long strings, disabled check for scanner
* 2012/10/26 - Rebuilt plugin using 5G/6G technology
* 2011/02/21 - Updated readme.txt file
* 2009/12/30 - Added check for admin users
* 2009/12/30 - Additional request strings added

== Frequently Asked Questions ==

= Do I need to do anything else for BBQ to work? =

Nope, just install and relax knowing that BBQ is protecting your site from bad URL requests.

= Got a question? =

To ask a question, visit the [BBQ homepage](https://perishablepress.com/block-bad-queries/) or [contact me](https://perishablepress.com/contact/).

== Donations ==

I created this plugin with love for the WP community. To show support, you can [make a donation](http://m0n.co/donate) or purchase one of my books: 

* [The Tao of WordPress](https://wp-tao.com/)
* [Digging into WordPress](https://digwp.com/)
* [.htaccess made easy](https://htaccessbook.com/)
* [WordPress Themes In Depth](https://wp-tao.com/wordpress-themes-book/)

Links, tweets and likes also appreciated. Thanks! :)
