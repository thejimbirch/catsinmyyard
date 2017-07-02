<?php
/*
	Plugin Name: Block Bad Queries (BBQ)
	Plugin URI: https://perishablepress.com/block-bad-queries/
	Description: BBQ is a super fast firewall that automatically protects WordPress against malicious URL requests.
	Tags: firewall, security, protect, lockdown, blacklist,  hack, eval, http, malicious, query, request, secure, spam, whitelist
	Usage: No configuration necessary. Upload, activate and done. BBQ blocks bad queries automically to protect your site against malicious URL requests. For advanced protection check out BBQ Pro.
	Author: Jeff Starr
	Author URI: https://plugin-planet.com/
	Contributors: specialk, aldolat, WpBlogHost, jameswilkes, juliobox, lernerconsult
	Donate link: https://m0n.co/donate
	Requires at least: 4.1
	Tested up to: 4.8
	Stable tag: 20170322
	Version: 20170322
	Text Domain: block-bad-queries
	Domain Path: /languages
	License: GPLv2 or later
*/

/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	Get a copy of the GNU General Public License: http://www.gnu.org/licenses/
*/

if (!defined('ABSPATH')) die();

if (!defined('BBQ_VERSION')) define('BBQ_VERSION', '20170322');
if (!defined('BBQ_FILE'))    define('BBQ_FILE', plugin_basename(__FILE__));
if (!defined('BBQ_DIR'))     define('BBQ_DIR',  plugin_dir_path(__FILE__));
if (!defined('BBQ_URL'))     define('BBQ_URL',  plugin_dir_url(__FILE__));

function bbq_core() {
	
	$request_uri_array  = apply_filters('request_uri_items',  array('eval\(', 'UNION(.*)SELECT', '\(null\)', 'base64_', '\/localhost', '\%2Flocalhost', '\/pingserver', '\/config\.', '\/wwwroot', '\/makefile', 'crossdomain\.', 'proc\/self\/environ', 'etc\/passwd', '\/https\:', '\/http\:', '\/ftp\:', '\/cgi\/', '\.cgi', '\.exe', '\.sql', '\.ini', '\.dll', '\.asp', '\.jsp', '\/\.bash', '\/\.git', '\/\.svn', '\/\.tar', ' ', '\<', '\>', '\/\=', '\.\.\.', '\+\+\+', '\/&&', '\/Nt\.', '\;Nt\.', '\=Nt\.', '\,Nt\.', '\.exec\(', '\)\.html\(', '\{x\.html\(', '\(function\(', '\.php\([0-9]+\)', '(benchmark|sleep)(\s|%20)*\('));
	$query_string_array = apply_filters('query_string_items', array('\.\.\/', '127\.0\.0\.1', 'localhost', 'loopback', '\%0A', '\%0D', '\%00', '\%2e\%2e', 'input_file', 'execute', 'mosconfig', 'path\=\.', 'mod\=\.', 'wp-config\.php'));
	$user_agent_array   = apply_filters('user_agent_items',   array('acapbot', 'binlar', 'casper', 'cmswor', 'diavol', 'dotbot', 'finder', 'flicky', 'morfeus', 'nutch', 'planet', 'purebot', 'pycurl', 'semalt', 'skygrid', 'snoopy', 'sucker', 'turnit', 'vikspi', 'zmeu'));
	
	$request_uri_string  = false;
	$query_string_string = false;
	$user_agent_string   = false;
	
	if (isset($_SERVER['REQUEST_URI'])     && !empty($_SERVER['REQUEST_URI']))     $request_uri_string  = $_SERVER['REQUEST_URI'];
	if (isset($_SERVER['QUERY_STRING'])    && !empty($_SERVER['QUERY_STRING']))    $query_string_string = $_SERVER['QUERY_STRING'];
	if (isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT'])) $user_agent_string   = $_SERVER['HTTP_USER_AGENT'];
	
	if ($request_uri_string || $query_string_string || $user_agent_string) {
		
		if (
			
			// strlen( $_SERVER['REQUEST_URI'] ) > 255 || // optional
			
			preg_match('/'. implode('|', $request_uri_array)  .'/i', $request_uri_string)  || 
			preg_match('/'. implode('|', $query_string_array) .'/i', $query_string_string) || 
			preg_match('/'. implode('|', $user_agent_array)   .'/i', $user_agent_string) 
			
		) {
			
			bbq_response();
			
		}
		
	}
	
}
add_action('plugins_loaded', 'bbq_core');

function bbq_response() {
	
	header('HTTP/1.1 403 Forbidden');
	header('Status: 403 Forbidden');
	header('Connection: Close');
	
	exit;
	
}

if (is_admin()) require_once BBQ_DIR .'bbq-settings.php';
