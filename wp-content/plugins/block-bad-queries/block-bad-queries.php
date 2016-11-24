<?php
/*
	Plugin Name: Block Bad Queries (BBQ)
	Plugin URI: https://perishablepress.com/block-bad-queries/
	Description: Automatically protects WordPress against malicious URL requests. This is the free/basic version of BBQ.
	Tags: security, protect, firewall, php, eval, malicious, url, request, blacklist
	Usage: No configuration necessary. Upload, activate and done. BBQ blocks bad queries automically to protect your site against malicious URL requests.
	Author: Jeff Starr
	Author URI: https://plugin-planet.com/
	Contributors: specialk, aldolat, WpBlogHost, jameswilkes, juliobox, lernerconsult
	Donate link: http://m0n.co/donate
	Requires at least: 4.1
	Tested up to: 4.7
	Stable tag: 20161114
	Version: 20161114
	Text Domain: block-bad-queries
	Domain Path: /languages
	License: GPLv2 or later
*/

if (!defined('ABSPATH')) die();

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

function bbq_meta_links($links, $file) {
	
	if ($file == plugin_basename(__FILE__)) {
		
		$rate_url   = 'https://wordpress.org/support/plugin/block-bad-queries/reviews/?rate=5#new-post';
		$rate_title = esc_attr__('Click here to rate and review this plugin at WordPress.org', 'block-bad-queries');
		$rate_text  = esc_html__('Rate this plugin&nbsp;&raquo;', 'block-bad-queries');
		
		$links[] = '<a target="_blank" href="'. $rate_url .'" title="'. $rate_title .'">'. $rate_text .'</a>';
		
	}
	
	return $links;
	
}
add_filter('plugin_row_meta', 'bbq_meta_links', 10, 2);

function bbq_action_links($links, $file) {
	
	if ($file == plugin_basename(__FILE__)) {
		
		$pro_url   = 'https://plugin-planet.com/bbq-pro/?plugin';
		$pro_title = esc_attr__('Get BBQ Pro for advanced protection', 'block-bad-queries');
		$pro_text  = esc_html__('Go&nbsp;Pro', 'block-bad-queries');
		$pro_style = 'padding:1px 5px 2px 5px;color:#fff;background:#feba12;border-radius:1px;';
		
		$links[] = '<a target="_blank" href="'. $pro_url .'" title="'. $pro_title .'" style="'. $pro_style .'">'. $pro_text .'</a>';
		
	}
	
	return $links;
	
}
add_filter('plugin_action_links', 'bbq_action_links', 10, 2);

function bbq_languages() {
	
	load_plugin_textdomain('block-bad-queries', false, basename(dirname(__FILE__)) .'/languages/');
	
}
add_action('plugins_loaded', 'bbq_languages');

function bbq_response() {
	
	header('HTTP/1.1 403 Forbidden');
	header('Status: 403 Forbidden');
	header('Connection: Close');
	
	exit;
	
}
