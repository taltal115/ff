<?php

/*
Plugin Name: Blue Captcha
Plugin URI: http://wordpress.org/extend/plugins/blue-captcha/
Description: Blue Captcha
Version: 1.3
Author: Jotis Kokkalis (BlueCoder)
Author URI: http://mybluestuff.blogspot.com/
*/

/*  
	(C) Copyright 2012, Jotis Kokkalis

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
	General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software Foundation,
	Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

error_reporting (E_ALL);

function blcap_errorhandler ($errno, $errstr, $errfile, $errline)
{
	//echo "Error : $errstr ($errno) in file $errfile ($errline)<br>";
	//@error_log ("* " . date ("d/m/Y , H:i:s") . " : $errstr [$errno] in line $errline\r\n", 3, "blcap_errors.log");
}
set_error_handler ("blcap_errorhandler", E_ALL);

if (!defined('WP_CONTENT_URL')) {
   define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
}

function blcap_check ()
{
	if (!function_exists ("gd_info") || !extension_loaded ("gd") )
	{
		$message = "";
		$message = $message . "<table class='widefat page fixed' align='center'>\n";
		$message = $message . "<tr><td><div align='center'><h3>BLUE CAPTCHA : GD Library is not installed on your system!</h3></div></td></tr>\n";
		$message = $message . "</table>\n";
		echo $message;	
	}

	if (version_compare (PHP_VERSION, "5.0.0", '<'))
	{
		$message = "";
		$message = $message . "<table class='widefat page fixed' align='center'>\n";
		$message = $message . "<tr><td><div align='center'><h3>BLUE CAPTCHA : Your system doesn't have PHP 5 or newer version!</h3></div></td></tr>\n";
		$message = $message . "</table>\n";
		echo $message;
	}
	
	$blcap_version = get_option ("blcap_version");
	if ($blcap_version == "")
	{
		$message = "";
		$message = $message . "<table class='widefat page fixed' align='center'>\n";
		$message = $message . "<tr><td><div align='center'><h3>BLUE CAPTCHA : Plugin is not installed properly. Try to reinstall it.</h3></div></td></tr>\n";
		$message = $message . "</table>\n";
		echo $message;
        die (0);
	}	
}

function blcap_install ()
{
	global $wpdb;

	require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

	$prefix = "blcap_";

	$blcap_cur_version = "";
	$blcap_cur_version = get_option ("blcap_version");
	
	$blcap_version = "1.3";
	add_option ("blcap_version", $blcap_version);
	update_option ("blcap_version", $blcap_version);
	
	if ($blcap_cur_version == "")
	{
		$settings = "a:93:{s:13:\"gen_activated\";s:3:\"yes\";s:13:\"gen_pingtrack\";s:3:\"yes\";s:7:\"gen_log\";s:3:\"yes\";s:12:\"gen_keepinfo\";s:3:\"yes\";s:11:\"gen_keeppwd\";s:2:\"no\";s:13:\"gen_layersize\";s:1:\"1\";s:11:\"gen_refresh\";s:3:\"yes\";s:16:\"gen_use_sessions\";s:2:\"no\";s:19:\"gen_autogeneratekey\";s:3:\"yes\";s:11:\"log_enabled\";s:3:\"yes\";s:8:\"log_user\";s:2:\"10\";s:10:\"log_char_6\";s:1:\"6\";s:8:\"log_type\";s:15:\"numbers_letters\";s:10:\"log_letter\";s:9:\"uppercase\";s:8:\"log_font\";s:4:\"yes1\";s:15:\"log_availfont_1\";s:1:\"1\";s:15:\"log_availfont_2\";s:1:\"2\";s:15:\"log_availfont_3\";s:1:\"3\";s:15:\"log_availfont_4\";s:1:\"4\";s:14:\"log_size_large\";s:5:\"large\";s:9:\"log_color\";s:6:\"colorn\";s:10:\"log_rotate\";s:3:\"yes\";s:14:\"log_background\";s:7:\"palette\";s:13:\"log_availbg_1\";s:1:\"1\";s:13:\"log_availbg_2\";s:1:\"2\";s:13:\"log_availbg_3\";s:1:\"3\";s:13:\"log_availbg_4\";s:1:\"4\";s:13:\"log_availbg_5\";s:1:\"5\";s:9:\"log_extra\";s:2:\"no\";s:9:\"log_lines\";s:2:\"no\";s:11:\"log_trlevel\";s:1:\"1\";s:9:\"log_layer\";s:6:\"single\";s:11:\"log_profile\";s:1:\"4\";s:11:\"reg_enabled\";s:3:\"yes\";s:8:\"reg_user\";s:2:\"10\";s:10:\"reg_char_4\";s:1:\"4\";s:8:\"reg_type\";s:7:\"letters\";s:10:\"reg_letter\";s:9:\"uppercase\";s:8:\"reg_font\";s:4:\"yes1\";s:15:\"reg_availfont_1\";s:1:\"1\";s:15:\"reg_availfont_2\";s:1:\"2\";s:15:\"reg_availfont_3\";s:1:\"3\";s:15:\"reg_availfont_4\";s:1:\"4\";s:15:\"reg_size_larger\";s:6:\"larger\";s:9:\"reg_color\";s:8:\"colorful\";s:10:\"reg_rotate\";s:2:\"no\";s:14:\"reg_background\";s:5:\"color\";s:9:\"reg_extra\";s:2:\"no\";s:9:\"reg_lines\";s:2:\"no\";s:11:\"reg_trlevel\";s:1:\"1\";s:9:\"reg_layer\";s:6:\"single\";s:11:\"reg_profile\";s:1:\"2\";s:11:\"pwd_enabled\";s:3:\"yes\";s:8:\"pwd_user\";s:2:\"10\";s:10:\"pwd_char_3\";s:1:\"3\";s:8:\"pwd_type\";s:7:\"numbers\";s:10:\"pwd_letter\";s:9:\"uppercase\";s:8:\"pwd_font\";s:4:\"yes1\";s:15:\"pwd_availfont_1\";s:1:\"1\";s:15:\"pwd_size_larger\";s:6:\"larger\";s:9:\"pwd_color\";s:6:\"color1\";s:10:\"pwd_rotate\";s:2:\"no\";s:14:\"pwd_background\";s:5:\"color\";s:9:\"pwd_extra\";s:2:\"no\";s:9:\"pwd_lines\";s:2:\"no\";s:11:\"pwd_trlevel\";s:1:\"1\";s:9:\"pwd_layer\";s:6:\"single\";s:11:\"pwd_profile\";s:1:\"1\";s:11:\"com_enabled\";s:3:\"yes\";s:8:\"com_user\";s:2:\"10\";s:10:\"com_char_5\";s:1:\"5\";s:8:\"com_type\";s:15:\"numbers_letters\";s:10:\"com_letter\";s:9:\"uppercase\";s:8:\"com_font\";s:4:\"yes1\";s:15:\"com_availfont_1\";s:1:\"1\";s:15:\"com_availfont_2\";s:1:\"2\";s:15:\"com_availfont_3\";s:1:\"3\";s:15:\"com_availfont_4\";s:1:\"4\";s:15:\"com_size_larger\";s:6:\"larger\";s:9:\"com_color\";s:6:\"colorn\";s:10:\"com_rotate\";s:3:\"yes\";s:14:\"com_background\";s:5:\"image\";s:13:\"com_availbg_1\";s:1:\"1\";s:13:\"com_availbg_2\";s:1:\"2\";s:13:\"com_availbg_3\";s:1:\"3\";s:13:\"com_availbg_4\";s:1:\"4\";s:13:\"com_availbg_5\";s:1:\"5\";s:9:\"com_extra\";s:2:\"no\";s:9:\"com_lines\";s:2:\"no\";s:11:\"com_trlevel\";s:1:\"1\";s:9:\"com_layer\";s:6:\"single\";s:11:\"com_profile\";s:1:\"3\";s:10:\"ban_iplist\";s:0:\"\";}";

		$settings_arr = @unserialize ($settings);
		add_option ("blcap_settings", $settings_arr);
		update_option ("blcap_settings", $settings_arr);
	}
    
	$blcap_protection_key = "";
	$charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	for ($i = 0 ; $i < 16 ; $i++)
		$blcap_protection_key .= $charset[mt_rand (0, strlen ($charset)-1)];
	add_option ("blcap_protection_key", $blcap_protection_key);
	update_option ("blcap_protection_key", $blcap_protection_key);
    
	if ($current_version == "" || version_compare ($current_version, "1.2", "<="))
	{
		$default_ip_informer_url = "http://whatismyipaddress.com/ip/{ip}";
		add_option ("blcap_ip_informer_url", $default_ip_informer_url);
		update_option ("blcap_ip_informer_url", $default_ip_informer_url);
	}

	$blcap_date = date ("Y/m/d");
	add_option ("blcap_date", $blcap_date);
	update_option ("blcap_date", $blcap_date);    
     
	add_option ("blcap_sessions", "");
	update_option ("blcap_sessions", "");

	$charset = "utf8";
	if (defined("DB_CHARSET")) $charset = DB_CHARSET;
	if ($charset == "") $charset = "utf8";

	$blcap_table = $prefix . "log";
	
	if ($wpdb->get_var("SHOW TABLES LIKE '" . $blcap_table . "'") != $blcap_table)
	{
		$sql = "CREATE TABLE `$blcap_table` (
			`id` int(11) NOT NULL auto_increment,
			`ip` text NOT NULL,
			`proxy` text NOT NULL,
			`totaltime` text NOT NULL,
			`type` text NOT NULL,
			`captcha` text NOT NULL,
			`refresh` text NOT NULL,
			`result` text NOT NULL,
			`info` longtext NOT NULL,
			`more` longtext NOT NULL,
			`date` text NOT NULL,
			`time` text NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=$charset";
		
		dbDelta($sql);
	}

	$blcap_table = $prefix . "sessions";
	if ($wpdb->get_var("SHOW TABLES LIKE '" . $blcap_table . "'") != $blcap_table)
	{
		$sql = "CREATE TABLE `$blcap_table` (
			`no` int(11) NOT NULL auto_increment,
			`capid` text NOT NULL,
			`ip` text NOT NULL,
			`captcha` text NOT NULL,
			`original` text NOT NULL,
			`caprefresh` text NOT NULL,
			`captime` text NOT NULL,
			`capurl` text NOT NULL,
			PRIMARY KEY (`no`)
			) ENGINE=MyISAM DEFAULT CHARSET=$charset";
			
		dbDelta($sql);
	}

	$blcap_table = $prefix . "ips";
	if ($wpdb->get_var("SHOW TABLES LIKE '" . $blcap_table . "'") != $blcap_table)
	{
		$sql = "CREATE TABLE `$blcap_table` (
			`id` int(11) NOT NULL auto_increment,
			`ip` text NOT NULL,
			`date` text NOT NULL,
			`time` text NOT NULL,
			`microtime` double NOT NULL,
			`sumprob` float NOT NULL,
			`level` text NOT NULL,
			`more` longtext NOT NULL,
			`pp` int(11) NOT NULL,
			`pptotal` int(11) NOT NULL,
			`trialstoday` int(11) NOT NULL,
			`trialstotal` int(11) NOT NULL,
			`failstoday` int(11) NOT NULL,
			`failstotal` int(11) NOT NULL,
			`failure` float NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=$charset";
			
		dbDelta($sql);
	}

	if (version_compare ($current_version, "1.1", "<="))
		$wpdb->get_results ("DROP TABLE blcap_banlog");
}

function blcap_uninstall ()
{
	delete_option ("blcap_version");
	delete_option ("blcap_protection_key");
	delete_option ("blcap_ip_informer_url");
	delete_option ("blcap_date");
	delete_option ("blcap_sessions");
	delete_option ("blcap_settings");
	blcap_remove_db ();
}

function blcap_add_menus ()
{
	add_menu_page ('Blue Captcha', 'Blue Captcha', 'administrator', 'blcap_main_page', 'blcap_main');

	add_submenu_page ('blcap_main_page', 'Options', 'Options', 'administrator', 'blcap_options_page', 'blcap_options');
	add_submenu_page ('blcap_main_page', 'Hall of Shame', 'Hall of Shame', 'administrator', 'blcap_hos_page', 'blcap_hos');
	add_submenu_page ('blcap_main_page', 'Log', 'Log', 'administrator', 'blcap_logs_page', 'blcap_logs');
}

function blcap_main ()
{
	global $wpdb;

	blcap_check ();
	
	$blcap_siteurl = get_option ("siteurl"); 
	$blcap_pageurl = $blcap_siteurl . "/wp-admin/admin.php?page="; 
	$blcap_mainsite = $blcap_pageurl . "blcap_main_page";
	
	$blcap_version = get_option ("blcap_version");

	$action = (isset ($_REQUEST["blcap_action"]) ? $_REQUEST["blcap_action"] : "");
	if ($action == "uninstall")
	{
		@include_once ("blfuncs.php");
		
		blcap_uninstall ();
		
		echo "<div class=\"updated\" align=\"center\">\n";
		echo "<br /><strong>Blue Captcha has been successfully uninstalled.</strong>";
		echo "<br /><strong>You may now deactivate and delete plugin.</strong>";
		echo "<br /><br /></div>\n";		
		die ();
	}

	echo "<script language=\"javascript\">\n";
	echo "function blcap_confirm ()\n";
	echo "{\n";
	echo "\tvar conf;\n";
	echo "\tconf = confirm (\"Are you sure that you want to uninstall Blue Captcha Plugin?\");\n";
	echo "\tif (conf)\n";
	echo "\t{\n";
	echo "\t\tdocument.getElementById (\"blcap_action\").value = \"uninstall\";\n";
	echo "\t\tdocument.getElementById (\"blcap_submit_form\").submit();\n";
	echo "\t}\n";
	echo "}\n";
	echo "</script>\n";
	
	echo "<h1 style=\"color: lightblue;\">Blue Captcha v" . $blcap_version . "</h1>\n";
	echo "<h2 style=\"color: darkblue;\">By Jotis Kokkalis (aka \"BlueCoder\")</h2>\n";
	
	echo "<h3>Visit my blue stuff page at <a href=\"http://mybluestuff.blogspot.com\" target=\"_blank\">http://mybluestuff.blogspot.com</a>\n";
    echo "<br />where you can find documentation about Blue Captcha.</h3>\n";
	
	echo "<hr style=\"color: blue;\" />\n";	

	echo "\n";
	echo "<form action=\"$blcap_mainsite\" id=\"blcap_submit_form\" name=\"blcap_submit_form\" method=\"post\">\n\n";
	echo "<div align=\"center\">\n";
	echo "<input type=\"button\" class=\"button-primary\" value=\" Uninstall \" title=\"Click here to uninstall plugin\" onclick=\"blcap_confirm();\" />\n";
	echo "<input type=\"hidden\" id=\"blcap_action\" name=\"blcap_action\" value=\"\" />\n";
	echo "</div>\n";
	echo "\n</form>\n";
	echo "\n";
	

	echo "<br />\n";
	echo "<h3>This plugin is free and will always be free ;-)</h3>\n";
	echo "<h3>However, if this plugin has protected you from spammers,<br />\n";
	echo "has helped you in some way or if you just like it, then<br />\n";
	echo "you could donate one dollar or two. Any donation will be highly<br />\n";
	echo "appreciated and will help in further development of this project.</h3>\n";
	echo "<br />\n";

	echo "\n<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">\n";
	echo "<input type=\"hidden\" name=\"encrypted\" value=\"-----BEGIN PKCS7-----MIIHPwYJKoZIhvcNAQcEoIIHMDCCBywCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCM3uBy28muFK6Ww/GA6+sDp5Uz6cww19rI2HHSx7OPNqxOlwx3kmgf/BaLgcOyeVZJfDmaMQi2VsLg5sDtbQ0bSIO0mfvVSsbR60NEmdcOJEIO9byb1OqWJG5K+Dq56a8Zjw6zUisuYnhaTPYyxFGuJlY3KONP3ZEBq2ngho1E8TELMAkGBSsOAwIaBQAwgbwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIeNfjcHaXTwWAgZjq5Q6q6Q/zinQ4/KrX/LjHxyy1yIGSIuNVfIkrmnfsRohe65KCbBSua/7MbaFVIERtzRLGu7Y39AxDkWhZ/89hGHffoEP3sO907E6oW0gRr3QvVaWv0qx+3+S3wtPpwfeqavLUXOgn+ctlYY4xPy1nhUkMXIRfZVOoEn25+O0vgHw5sgxvByYKZJsDBW8oV5pgMt+3u9TjE6CCA4cwggODMIIC7KADAgECAgEAMA0GCSqGSIb3DQEBBQUAMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTAeFw0wNDAyMTMxMDEzMTVaFw0zNTAyMTMxMDEzMTVaMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAwUdO3fxEzEtcnI7ZKZL412XvZPugoni7i7D7prCe0AtaHTc97CYgm7NsAtJyxNLixmhLV8pyIEaiHXWAh8fPKW+R017+EmXrr9EaquPmsVvTywAAE1PMNOKqo2kl4Gxiz9zZqIajOm1fZGWcGS0f5JQ2kBqNbvbg2/Za+GJ/qwUCAwEAAaOB7jCB6zAdBgNVHQ4EFgQUlp98u8ZvF71ZP1LXChvsENZklGswgbsGA1UdIwSBszCBsIAUlp98u8ZvF71ZP1LXChvsENZklGuhgZSkgZEwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tggEAMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADgYEAgV86VpqAWuXvX6Oro4qJ1tYVIT5DgWpE692Ag422H7yRIr/9j/iKG4Thia/Oflx4TdL+IFJBAyPK9v6zZNZtBgPBynXb048hsP16l2vi0k5Q2JKiPDsEfBhGI+HnxLXEaUWAcVfCsQFvd2A1sxRr67ip5y2wwBelUecP3AjJ+YcxggGaMIIBlgIBATCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwCQYFKw4DAhoFAKBdMBgGCSqGSIb3DQEJAzELBgkqhkiG9w0BBwEwHAYJKoZIhvcNAQkFMQ8XDTEyMDMxODIxNDkyMFowIwYJKoZIhvcNAQkEMRYEFMxLDk7JFi2UMYLHA6CorDFs9ui/MA0GCSqGSIb3DQEBAQUABIGAJcvELjVTqMHf5hHRZKoxTOKEtxRgYF543Uq4QtX/FnboMQ5CtKnmfpsqIbI+aIUl7sW9c9Qvu/YF+uAzecFEdH1fatyrjq+ullfh4PcXivEwmoeFX7u2DqC9zKPhgBrTaRCujA3/KqFDulRwT4lbiZDnwKmwn1p1ykC2+fEJJ/w=-----END PKCS7-----\">\n";
	echo "<input type=\"image\" src=\"https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif\" border=\"0\" name=\"submit\" alt=\"PayPal - The safer, easier way to pay online!\">\n";
	echo "<img alt=\"\" border=\"0\" src=\"https://www.paypalobjects.com/en_US/i/scr/pixel.gif\" width=\"1\" height=\"1\">\n";
	echo "</form>\n\n";
	
	echo "<hr style=\"color: cyan; width: 50%;\" />\n";	
	echo "<h3 align=\"center\">''The entire project was proudly created with NotePad''</h3>\n";	
	echo "<hr style=\"color: cyan; width: 50%;\" />\n";

	echo "<br />\n";
	echo "<strong>\n";
	echo "This program is free software; you can redistribute it and/or modify<br />\n";
	echo "it under the terms of the GNU General Public License, version 2,<br />\n";
	echo "as published by the Free Software Foundation.<br />\n";
	echo "<br />\n";
	echo "This program is distributed in the hope that it will be useful,<br />\n";
	echo "but WITHOUT ANY WARRANTY; without even the implied warranty of<br />\n";
	echo "MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU<br />\n";
	echo "General Public License for more details.<br />\n";
	echo "<br />\n";
	echo "You should have received a copy of the GNU General Public License,<br />\n";
	echo "along with this program; if not, write to the Free Software Foundation,<br />\n";
	echo "Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA<br />\n";
	echo "<br />\n";	
	echo "(C) 2012, Jotis Kokkalis<br />\n";
	echo "</strong><br />\n";
}

function blcap_logs ()
{
	global $wpdb;

	blcap_check ();
	
	$blcap_siteurl = get_option ("siteurl"); 
	$blcap_pageurl = $blcap_siteurl . "/wp-admin/admin.php?page="; 
	$blcap_logsite = $blcap_pageurl . "blcap_logs_page";
	
	$blcap_version = get_option ("blcap_version");

	@include_once ("blfuncs.php");
	
	@include_once ("bluelog.php");
}

function blcap_hos ()
{
	global $wpdb;

	blcap_check ();
	
	$blcap_siteurl = get_option ("siteurl"); 
	$blcap_pageurl = $blcap_siteurl . "/wp-admin/admin.php?page="; 
	$blcap_hossite = $blcap_pageurl . "blcap_hos_page";
	
	$blcap_version = get_option ("blcap_version");

	@include_once ("blfuncs.php");
	
	@include_once ("bluehos.php");
}
	
function blcap_options ()
{
	global $wpdb;

	blcap_check ();
	
	$blcap_siteurl = get_option ("siteurl"); 
	$blcap_pageurl = $blcap_siteurl . "/wp-admin/admin.php?page="; 
	$blcap_mainsite = $blcap_pageurl . "blcap_options_page";
	
	$blcap_version = get_option ("blcap_version");

	include_once ("blueoptions.php");
}

function blcap_get_current_url ()
{
	$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
	$port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
	$port = (($port) ? ":" . $_SERVER["SERVER_PORT"] : "");
	$url = ($isHTTPS ? "https://" : "http://") . $_SERVER["SERVER_NAME"] . $port . $_SERVER["REQUEST_URI"];	
	return $url;
}

function blcap_get_ip ()
{
	$ip_remote = "-";
	if (isset ($_SERVER['REMOTE_ADDR']))
		$ip_remote = $_SERVER['REMOTE_ADDR'];
	
	$ip_client = "-";
	if (isset ($_SERVER['HTTP_CLIENT_IP']))
		$ip_client = $_SERVER['HTTP_CLIENT_IP'];
		
	$ip_forward = "-";
	if (isset ($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ip_forward = $_SERVER['HTTP_X_FORWARDED_FOR'];

	if ($ip_forward == "-") $ip_forward = $ip_client;
	
	if ($ip_forward != "-")
		return array ($ip_forward, $ip_remote);

	return array ($ip_remote, $ip_forward);
}

function blcap_compare_ip ($remoteip, $list)
{
	$list = str_replace (" ", "", $list);
	if ($list == "") return false;
    
	$list_arr = explode (",", $list);
    
	$remoteip_ar = explode (".", $remoteip);
	$rp1 = (isset ($remoteip_ar[0]) ? $remoteip_ar[0] : -1);
	$rp2 = (isset ($remoteip_ar[1]) ? $remoteip_ar[1] : -1);
	$rp3 = (isset ($remoteip_ar[2]) ? $remoteip_ar[2] : -1);
	$rp4 = (isset ($remoteip_ar[3]) ? $remoteip_ar[3] : -1);

	if (is_array ($list_arr))
	foreach ($list_arr as $ip)
	{
		if ($ip == $remoteip) return true;
		else
		{
			$ip_ar = explode (".", $ip);
			$p1 = (isset ($ip_ar[0]) ? $ip_ar[0] : -1);
			$p2 = (isset ($ip_ar[1]) ? $ip_ar[1] : -1);
			$p3 = (isset ($ip_ar[2]) ? $ip_ar[2] : -1);
			$p4 = (isset ($ip_ar[3]) ? $ip_ar[3] : -1);
			if ($p1 == $rp1 && $p2 == $rp2 && ($p3 == $rp3 || $p3 == "*") && ($p4 == $rp4 || $p4 == "*"))
			return true;
		}
	}

	return false;
}

function blcap_calc_spam_probability ($response, $totalchars, $proxy, $refreshes, $captcha)
{
	$MAX_CHARS_PER_SEC = 10.0;

	$pos = 0.0;
	if ($response > 1000000)
	{
		$pos = 99.0;
		if ($captcha == "" || $proxy != "-") $pos = 99.9;
		if ($captcha == "" && $proxy != "-") $pos = 100.0;
	}
	else
	{
		$caplen = strlen ($captcha);
        
		$mincaptime = 1.0*$refreshes + 0.5*$caplen;
        
		$mintypetime = (float)($totalchars / $MAX_CHARS_PER_SEC);
        
		$mintypetime = $mintypetime + $mincaptime;

		if ($mintypetime < 1.0) $mintypetime = 1.0;        
        
		if ($response >= $mintypetime)
			$pos = 0.0;
		else
			$pos = 100.0*(float)(($mintypetime - $response) / $mintypetime*1.0);
        
		if ($caplen == 0) $pos = $pos + 25.0;
    
		if ($proxy != "-") $pos = $pos + 30.0;
        
		if ($pos >= 99.9) $pos = 99.9;
	}
    
	if ($pos > 100.0) $pos = 100.0;

	$pos = number_format ($pos, 1, ".", "");
    
	return $pos;
}

function blcap_check_date ($gen_autogeneratekey = "yes")
{
	global $wpdb;
	
	$current_date = date ("Y/m/d");
	$blcap_date = get_option ("blcap_date");
    
	if ($blcap_date != $current_date)
	{
		add_option ("blcap_date", $current_date);
		update_option ("blcap_date", $current_date);
		
		if ($gen_autogeneratekey == "yes")
		{
			$new_protection_key = "";
			$keycharset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			for ($i = 0 ; $i < 16 ; $i++)
				$new_protection_key .= $keycharset[mt_rand (0, strlen ($keycharset)-1)];
			add_option ("blcap_protection_key", $new_protection_key);
			update_option ("blcap_protection_key", $new_protection_key);
	        }
		
		// truncate DB table of Captcha Sessions Data
		$r = $wpdb->get_results ("TRUNCATE TABLE blcap_sessions");
	}
}

function blcap_loginform ()
{
	global $current_user;

	$blcap_setser = get_option ("blcap_settings");
	if (is_array ($blcap_setser))
		$sss = $blcap_setser;
	else
		$sss = @unserialize ($blcap_setser);
		
	$user_id = (isset ($current_user->ID) ? $current_user->ID : -1);
	$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
	
	$captcha_active = (isset ($sss["gen_activated"]) ? $sss["gen_activated"] : "yes");
	$captcha_enabled = (isset ($sss["log_enabled"]) ? $sss["log_enabled"] : "yes");
	$captcha_user = (isset ($sss["log_user"]) ? $sss["log_user"] : "0");
	$captcha_use_sessions = (isset ($sss["gen_use_sessions"]) ? $sss["gen_use_sessions"] : "no");
    
	if ($captcha_active == "yes" && $captcha_enabled == "yes")
		if ($user_level <= $captcha_user)
		{
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$start_time = $time;
            
			$sid = "L";
			list ($ip, $remote) = blcap_get_ip ();
			$ip_str = str_replace (".", "", $ip);
			$time_str = str_replace (".", "", (string)$time);
			$sid = $sid . $ip_str . $time_str;
			
			$gen_autogeneratekey = (isset ($sss["gen_autogeneratekey"]) ? $sss["gen_autogeneratekey"] : "yes");
			blcap_check_date ($gen_autogeneratekey);
			
			if ($captcha_use_sessions == "yes")
			{
				if (!isset ($_SESSION)) @session_start ();
                
				$_SESSION["capid"] = $sid;
				$_SESSION["caprefresh"] = -1;
				$_SESSION["captime"] = $start_time;
				$_SESSION["capurl"] = blcap_get_current_url ();
			}
			else
			{
				@include_once ("blfuncs.php");
				
				blcap_add_captcha_session ($sid, $ip, "", "", -1, $start_time, blcap_get_current_url ());
			}
			
			$captchaurl = get_option ("siteurl") . "?bcapact=gen&id=" . $sid;
			
			$captcha_layersize = (isset ($sss["gen_layersize"]) ? $sss["gen_layersize"] : "1");
			$captcha_refresh = (isset ($sss["gen_refresh"]) ? $sss["gen_refresh"] : "yes");

			if ($captcha_layersize == "1")
				$wh_tag = "width=\"200\" height=\"50\" ";
			else
				$wh_tag = "";
			
			if ($captcha_refresh == "yes")
			{
				$rf_tag = "title=\"Click to refresh Captcha Image\" onclick=\"blcap_refresh_captcha();\" ";
				$rf_span = "<span onclick=\"blcap_refresh_captcha();\" title=\"Click to refresh Captcha Image\" onmouseout=\"style.color='black';style.cursor='';\" onmouseover=\"style.color='red';style.cursor='pointer';\">Refresh</span><br />";
			}
			else
			{
				$rf_tag = "";
				$rf_span = "";
			}
				
			echo "\t<p>\n";
			echo "\t\t<div align=\"center\">\n";
			echo "\t\t<img id=\"blcap_img\" src=\"$captchaurl\" " . $wh_tag . "tabindex=\"40\" " . $rf_tag . "/><br />" . $rf_span . "<br />\n";
			echo "\t\t<label>Captcha<br />\n";
			echo "\t\t<input type=\"text\" name=\"user_captcha\" id=\"user_captcha\" title=\"Enter Captcha here\" value=\"\" size=\"15\" tabindex=\"50\" /></label><br /><br />\n";
			echo "\t\t<input type=\"hidden\" name=\"captcha_id\" value=\"" . $sid . "\" />\n";
			echo "\t\t</div>\n";
			echo "\t</p>\n";
	
			if ($captcha_refresh == "yes")
			{
				echo "\n";
				echo "\t<script language=\"javascript\">\n";
				echo "\tvar blcap_refno = 0;\n";
				echo "\tfunction blcap_refresh_captcha()\n";
				echo "\t{\n";
				echo "\t\tvar im = new Image();\n";
				echo "\t\tblcap_refno = blcap_refno + 1;\n";
				echo "\t\tim.src=\"" . $captchaurl . "&refresh=\" + blcap_refno;\n";
				echo "\t\tdocument.getElementById (\"blcap_img\").src = im.src;\n";
				echo "\t}\n";
				echo "\t</script>\n";
				echo "\n";
			}
		}
}

function blcap_loginact ()
{
	global $current_user;

	$blcap_setser = get_option ("blcap_settings");
	if (is_array ($blcap_setser))
		$sss = $blcap_setser;
	else
		$sss = @unserialize ($blcap_setser);

	$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
	
	$captcha_active = (isset ($sss["gen_activated"]) ? $sss["gen_activated"] : "yes");	
	$captcha_enabled = (isset ($sss["log_enabled"]) ? $sss["log_enabled"] : "no");
	$captcha_user = (isset ($sss["log_user"]) ? $sss["log_user"] : "0");
	$captcha_use_sessions = (isset ($sss["gen_use_sessions"]) ? $sss["gen_use_sessions"] : "no");
	
	if ($captcha_active == "yes" && $captcha_enabled == "yes")
		if ($user_level <= $captcha_user && isset ($_REQUEST["log"]) && isset ($_REQUEST["pwd"]))
		{
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$end_time = $time;
            
			$user_captcha = (isset ($_REQUEST["user_captcha"]) ? $_REQUEST["user_captcha"] : "");
			$captcha_id = (isset ($_REQUEST["captcha_id"]) ? $_REQUEST["captcha_id"] : "");
	
			@include_once ("blfuncs.php");
			
			if ($captcha_use_sessions == "yes")
			{
				if (!isset ($_SESSION)) @session_start ();

				$captcha = (isset ($_SESSION["captcha"]) ? $_SESSION["captcha"] : "");
				$start_time = (isset ($_SESSION["captime"]) ? $_SESSION["captime"] : 0);
				$capurl = (isset ($_SESSION["capurl"]) ? $_SESSION["capurl"] : "");
				$refresh = (isset ($_SESSION["caprefresh"]) ? $_SESSION["caprefresh"] : 0);
				if ($refresh < 0) $refresh = 0;
			}
			else
			{        
				$res = blcap_get_captcha_session ($captcha_id);
                
				$captcha = (isset ($res["captcha"]) ? $res["captcha"] : "");
				$start_time = (isset ($res["captime"]) ? $res["captime"] : 0);
				$capurl = (isset ($res["capurl"]) ? $res["capurl"] : "");
				$refresh = (isset ($res["caprefresh"]) ? $res["caprefresh"] : 0);
				if ($refresh < 0) $refresh = 0;
			}

			$protection_key = "";
			$protection_key = get_option ("blcap_protection_key");
			$user_captcha = str_replace (" ", "", $user_captcha);
			$captcha_to_check = $protection_key . $user_captcha;
            
			if ($captcha != sha1 ($captcha_to_check) || $user_captcha == "" || $captcha == "") $success = false;
			else $success = true;
	
			$gen_log = (isset ($sss["gen_log"]) ? $sss["gen_log"] : "yes");
			$gen_keepinfo = (isset ($sss["gen_keepinfo"]) ? $sss["gen_keepinfo"] : "yes");
			$gen_keeppwd = (isset ($sss["gen_keeppwd"]) ? $sss["gen_keeppwd"] : "no");
   			$ban_iplist = (isset ($sss["ban_iplist"]) ? $sss["ban_iplist"] : "");
   			$ban = (isset ($sss["ban_log"]) ? $sss["ban_log"] : "0");            
            
			$banresult = false;
			if ($ban > 0 && $ban_iplist != "")
			{
				$iparr = blcap_get_ip ();
				$remoteip = (isset ($iparr[0]) ? $iparr[0] : "-");
				$banresult = blcap_compare_ip ($remoteip, $ban_iplist);
				if ($banresult == true) $success = false;
			}
            
			if ($gen_log == "yes")
			{
				$total_time = round (($end_time - $start_time)*100) / 100.0;
				$total_time = number_format ($total_time, 2, ".", "");
				
				$iparr = blcap_get_ip ();
			
				$ip = (isset ($iparr[0]) ? $iparr[0] : "-");
				$proxy = (isset ($iparr[1]) ? $iparr[1] : "-");
				if ($ip == $proxy) $proxy = "-";
				
				$logdate = date ("Y/m/d");
				$logtime = date ("H:i:s");
		
				$info = "";
				if ($gen_keepinfo == "yes")
				{		
					$MAX_LEN = 64;
					
					$username = (isset ($_REQUEST["log"]) ? $_REQUEST["log"] : "-");
					if ($gen_keeppwd == "yes") $password = (isset ($_REQUEST["pwd"]) ? $_REQUEST["pwd"] : "-");
					else $password = "******";
					
					if (strlen ($username) > $MAX_LEN) $username = substr ($username, 0, $MAX_LEN) . "...";
					if (strlen ($password) > $MAX_LEN) $password = substr ($password, 0, $MAX_LEN) . "...";
					
					$info = $info . "Username: " . $username . "<br>";
					$info = $info . "Password: " . $password;
					
					$info = strip_tags ($info, "<br>");
				}
				else $info = "-";
				
				$totalchars = 0;
				if (isset ($_REQUEST["log"]))
				    $totalchars = $totalchars + strlen (stripslashes ($_REQUEST["log"]));
				if (isset ($_REQUEST["pwd"]))
				    $totalchars = $totalchars + strlen (stripslashes ($_REQUEST["pwd"]));

				$pos = blcap_calc_spam_probability ($total_time, $totalchars, $proxy, $refresh, $user_captcha);

				$more = $totalchars . "#" . $pos;
		        
				if ($success == true) $result = "SUCCESS";
				else $result = "FAIL";
				if ($banresult == true) $result = "BANNED";

				$logres = blcap_add_log ($ip, $proxy, $total_time, "LOGIN", $user_captcha, $refresh, $result, $info, $more, $logdate, $logtime);

				$ipres = blcap_get_ip_db ($ip);
				if ($ipres["found"] == true)
				{
					$thisdate = (isset ($ipres["date"]) ? $ipres["date"] : "");
					$sumprob = (isset ($ipres["sumprob"]) ? (float)$ipres["sumprob"] : 0.0);
					$trialstoday = (isset ($ipres["trialstoday"]) ? (int)$ipres["trialstoday"] : 0);
					$trialstotal = (isset ($ipres["trialstotal"]) ? (int)$ipres["trialstotal"] : 0);
					$failstoday = (isset ($ipres["failstoday"]) ? (int)$ipres["failstoday"] : 0);
					$failstotal = (isset ($ipres["failstotal"]) ? (int)$ipres["failstotal"] : 0);
					
					if ($sumprob == "" || !is_numeric ($sumprob)) $sumprob = 0.0;
					$sumprob = (float)($sumprob * $trialstotal);
					$sumprob = (float)(1.0*($sumprob + $pos) / ($trialstotal + 1.0));
					$sumprob = number_format ($sumprob, 1, ".", "");

					$trialstotal = (int)($trialstotal + 1);
					if ($thisdate != $logdate)
					{
						$trialstoday = 1;
						$failstoday = 0;
					}
					else $trialstoday = $trialstoday + 1;
					if ($success == false)
					{
						$failstotal = (int)($failstotal + 1);
						$failstoday = (int)($failstoday + 1);
					}
					if ($trialstotal > 0) $failure = 100.0*(1.0*$failstotal / (float)$trialstotal);
					else $failure = 0.0;
					$failure = number_format ($failure, 1, ".", "");

					blcap_update_ip_db ($ip, $logdate, $logtime, $end_time, $sumprob, "0", "", "0", "0", $trialstoday, $trialstotal, $failstoday, $failstotal, $failure);
				}
				else
				{
					if ($success == false)
					{
						$fails = 1;
						$failure = 100.0;
					}
					else
					{
						$fails = 0;
						$failure = 0.0;
					}

					blcap_add_ip_db ($ip, $logdate, $logtime, $end_time, $pos, "0", "", "0", "0", "1", "1", $fails, $fails, $failure);
				}
			}
		
			if ($success == false)
			{
				if ($capurl != "")
					echo "<div style=\"padding: 5px; border: 2px solid blue; border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; -o-border-radius: 10px;  background: yellow; color: red; font-weight: bold; text-align: center;\"><h3>You have entered a Wrong CAPTCHA.</h3><h4>Click <a href=\"" . $capurl . "\">here</a> to go back and try again.</h4></div>\n";
				else
					echo "<div style=\"padding: 5px; border: 2px solid blue; border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; -o-border-radius: 10px;  background: yellow; color: red; font-weight: bold; text-align: center;\"><h3>You have entered a Wrong CAPTCHA.</h3><h4>Go back and try again.</h4></div>\n";
				die (0);
			}
			else
			{
				if ($captcha_use_sessions == "yes")
					$_SESSION["captcha"] = "";
				else
					blcap_delete_captcha_session ($captcha_id);
			}
		}
}

function blcap_registerform ()
{
	global $current_user;

	$blcap_setser = get_option ("blcap_settings");
	if (is_array ($blcap_setser))
		$sss = $blcap_setser;
	else
		$sss = @unserialize ($blcap_setser);
		
	$user_id = (isset ($current_user->ID) ? $current_user->ID : -1);
	$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
	
	$captcha_active = (isset ($sss["gen_activated"]) ? $sss["gen_activated"] : "yes");	
	$captcha_enabled = (isset ($sss["reg_enabled"]) ? $sss["reg_enabled"] : "yes");
	$captcha_user = (isset ($sss["reg_user"]) ? $sss["reg_user"] : "0");
	$captcha_use_sessions = (isset ($sss["gen_use_sessions"]) ? $sss["gen_use_sessions"] : "no");
	
	if ($captcha_active == "yes" && $captcha_enabled == "yes")
		if ($user_level <= $captcha_user)
		{
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$start_time = $time;
            
			$sid = "R";
			list ($ip, $remote) = blcap_get_ip ();
			$ip_str = str_replace (".", "", $ip);
			$time_str = str_replace (".", "", (string)$time);
			$sid = $sid . $ip_str . $time_str;		
			
			$gen_autogeneratekey = (isset ($sss["gen_autogeneratekey"]) ? $sss["gen_autogeneratekey"] : "yes");
			blcap_check_date ($gen_autogeneratekey);
			
			if ($captcha_use_sessions == "yes")
			{
				if (!isset ($_SESSION)) @session_start ();
                
				$_SESSION["capid"] = $sid;
				$_SESSION["caprefresh"] = -1;
				$_SESSION["captime"] = $start_time;
				$_SESSION["capurl"] = blcap_get_current_url ();
			}
			else
			{
				@include_once ("blfuncs.php");
				
				blcap_add_captcha_session ($sid, $ip, "", "", -1, $start_time, blcap_get_current_url ());
			}
			
			$captchaurl = get_option ("siteurl") . "?bcapact=gen&id=" . $sid;
			
			$captcha_layersize = (isset ($sss["gen_layersize"]) ? $sss["gen_layersize"] : "1");
			$captcha_refresh = (isset ($sss["gen_refresh"]) ? $sss["gen_refresh"] : "yes");

			if ($captcha_layersize == "1")
				$wh_tag = "width=\"200\" height=\"50\" ";
			else
				$wh_tag = "";
			
			if ($captcha_refresh == "yes")
			{
				$rf_tag = "title=\"Click to refresh Captcha Image\" onclick=\"blcap_refresh_captcha();\" ";
				$rf_span = "<span onclick=\"blcap_refresh_captcha();\" title=\"Click to refresh Captcha Image\" onmouseout=\"style.color='black';style.cursor='';\" onmouseover=\"style.color='red';style.cursor='pointer';\">Refresh</span><br />";
			}
			else
			{
				$rf_tag = "";
				$rf_span = "";
			}
			
			echo "\t<p>\n";
			echo "\t\t<div align=\"center\">\n";
			echo "\t\t<img id=\"blcap_img\" src=\"$captchaurl\" " . $wh_tag . "tabindex=\"40\" " . $rf_tag . "/><br />" . $rf_span . "<br />\n";
			echo "\t\t<label>Captcha<br />\n";
			echo "\t\t<input type=\"text\" name=\"user_captcha\" id=\"user_captcha\" title=\"Enter Captcha here\" value=\"\" size=\"15\" tabindex=\"50\" /></label><br /><br />\n";
			echo "\t\t<input type=\"hidden\" name=\"captcha_id\" value=\"" . $sid . "\" />\n";
			echo "\t\t</div>\n";
			echo "\t</p>\n";
	
			if ($captcha_refresh == "yes")
			{
				echo "\n";
				echo "\t<script language=\"javascript\">\n";
				echo "\tvar blcap_refno = 0;\n";
				echo "\tfunction blcap_refresh_captcha()\n";
				echo "\t{\n";
				echo "\t\tvar im = new Image();\n";
				echo "\t\tblcap_refno = blcap_refno + 1;\n";
				echo "\t\tim.src=\"" . $captchaurl . "&refresh=\" + blcap_refno;\n";
				echo "\t\tdocument.getElementById (\"blcap_img\").src = im.src;\n";
				echo "\t}\n";
				echo "\t</script>\n";
				echo "\n";
			}
		}
}

function blcap_registerflt ($err)
{
	global $current_user;

	$blcap_setser = get_option ("blcap_settings");
	if (is_array ($blcap_setser))
		$sss = $blcap_setser;
	else
		$sss = @unserialize ($blcap_setser);

	$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
	
	$captcha_active = (isset ($sss["gen_activated"]) ? $sss["gen_activated"] : "yes");	
	$captcha_enabled = (isset ($sss["reg_enabled"]) ? $sss["reg_enabled"] : "yes");
	$captcha_user = (isset ($sss["reg_user"]) ? $sss["reg_user"] : "0");
	$captcha_use_sessions = (isset ($sss["gen_use_sessions"]) ? $sss["gen_use_sessions"] : "no");
	
	if ($captcha_active == "yes" && $captcha_enabled == "yes")
		if ($user_level <= $captcha_user)
		{
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$end_time = $time;
            
			$user_captcha = (isset ($_REQUEST["user_captcha"]) ? $_REQUEST["user_captcha"] : "");
			$captcha_id = (isset ($_REQUEST["captcha_id"]) ? $_REQUEST["captcha_id"] : "");
	
			@include_once ("blfuncs.php");
			
			if ($captcha_use_sessions == "yes")
			{
				if (!isset ($_SESSION)) @session_start ();

				$captcha = (isset ($_SESSION["captcha"]) ? $_SESSION["captcha"] : "");
				$start_time = (isset ($_SESSION["captime"]) ? $_SESSION["captime"] : 0);
				$capurl = (isset ($_SESSION["capurl"]) ? $_SESSION["capurl"] : "");
				$refresh = (isset ($_SESSION["caprefresh"]) ? $_SESSION["caprefresh"] : 0);
				if ($refresh < 0) $refresh = 0;
			}
			else
			{        
				$res = blcap_get_captcha_session ($captcha_id);

				$captcha = (isset ($res["captcha"]) ? $res["captcha"] : "");
				$start_time = (isset ($res["captime"]) ? $res["captime"] : 0);
				$capurl = (isset ($res["capurl"]) ? $res["capurl"] : "");
				$refresh = (isset ($res["caprefresh"]) ? $res["caprefresh"] : 0);
				if ($refresh < 0) $refresh = 0;
			}

			$protection_key = "";
			$protection_key = get_option ("blcap_protection_key");
			$user_captcha = str_replace (" ", "", $user_captcha);
			$captcha_to_check = $protection_key . $user_captcha;
            
			if ($captcha != sha1 ($captcha_to_check) || $user_captcha == "" || $captcha == "") $success = false;
			else $success = true;

			$gen_log = (isset ($sss["gen_log"]) ? $sss["gen_log"] : "yes");
			$gen_keepinfo = (isset ($sss["gen_keepinfo"]) ? $sss["gen_keepinfo"] : "yes");
			$gen_keeppwd = (isset ($sss["gen_keeppwd"]) ? $sss["gen_keeppwd"] : "no");
   			$ban_iplist = (isset ($sss["ban_iplist"]) ? $sss["ban_iplist"] : "");
   			$ban = (isset ($sss["ban_reg"]) ? $sss["ban_reg"] : "0");            
            
			$banresult = false;
			if ($ban > 0 && $ban_iplist != "")
			{
				$iparr = blcap_get_ip ();
				$remoteip = (isset ($iparr[0]) ? $iparr[0] : "-");
				$banresult = blcap_compare_ip ($remoteip, $ban_iplist);
				if ($banresult == true) $success = false;
			}
            
			if ($gen_log == "yes")
			{
				$total_time = round (($end_time - $start_time)*100) / 100.0;
				$total_time = number_format ($total_time, 2, ".", "");
				
				$iparr = blcap_get_ip ();
				
				$ip = (isset ($iparr[0]) ? $iparr[0] : "-");
				$proxy = (isset ($iparr[1]) ? $iparr[1] : "-");
				if ($ip == $proxy) $proxy = "-";
				
				$logdate = date ("Y/m/d");
				$logtime = date ("H:i:s");
		
				$info = "";
				if ($gen_keepinfo == "yes")
				{		
					$MAX_LEN = 64;

					$user_login = (isset ($_REQUEST["user_login"]) ? $_REQUEST["user_login"] : "-");
					$user_email = (isset ($_REQUEST["user_email"]) ? $_REQUEST["user_email"] : "-");
					
					if (strlen ($user_login) > $MAX_LEN) $user_login = substr ($user_login, 0, $MAX_LEN) . "...";
					if (strlen ($user_email) > $MAX_LEN) $user_email = substr ($user_email, 0, $MAX_LEN) . "...";
					
					$info = $info . "Username: " . $user_login . "<br>";
					$info = $info . "Email: " . $user_email;
					
					$info = strip_tags ($info, "<br>");
				}
				else $info = "-";

				$totalchars = 0;
				if (isset ($_REQUEST["user_login"]))
				    $totalchars = $totalchars + strlen (stripslashes ($_REQUEST["user_login"]));
				if (isset ($_REQUEST["user_email"]))
				    $totalchars = $totalchars + strlen (stripslashes ($_REQUEST["user_email"]));

				$pos = blcap_calc_spam_probability ($total_time, $totalchars, $proxy, $refresh, $user_captcha);

				$more = $totalchars . "#" . $pos;
                
				if ($success == true) $result = "SUCCESS";
				else $result = "FAIL";
				if ($banresult == true) $result = "BANNED";

				$logres = blcap_add_log ($ip, $proxy, $total_time, "REGISTER", $user_captcha, $refresh, $result, $info, $more, $logdate, $logtime);

				$ipres = blcap_get_ip_db ($ip);
				if ($ipres["found"] == true)
				{
					$thisdate = (isset ($ipres["date"]) ? $ipres["date"] : "");
					$sumprob = (isset ($ipres["sumprob"]) ? (float)$ipres["sumprob"] : 0.0);
					$trialstoday = (isset ($ipres["trialstoday"]) ? (int)$ipres["trialstoday"] : 0);
					$trialstotal = (isset ($ipres["trialstotal"]) ? (int)$ipres["trialstotal"] : 0);
					$failstoday = (isset ($ipres["failstoday"]) ? (int)$ipres["failstoday"] : 0);
					$failstotal = (isset ($ipres["failstotal"]) ? (int)$ipres["failstotal"] : 0);
					
					if ($sumprob == "" || !is_numeric ($sumprob)) $sumprob = 0.0;
					$sumprob = (float)($sumprob * $trialstotal);
					$sumprob = (float)(1.0*($sumprob + $pos) / ($trialstotal + 1.0));
					$sumprob = number_format ($sumprob, 1, ".", "");

					$trialstotal = (int)($trialstotal + 1);
					if ($thisdate != $logdate)
					{
						$trialstoday = 1;
						$failstoday = 0;
					}
					else $trialstoday = $trialstoday + 1;
					if ($success == false)
					{
						$failstotal = (int)($failstotal + 1);
						$failstoday = (int)($failstoday + 1);
					}
					if ($trialstotal > 0) $failure = 100.0*(1.0*$failstotal / (float)$trialstotal);
					else $failure = 0.0;
					$failure = number_format ($failure, 1, ".", "");

					blcap_update_ip_db ($ip, $logdate, $logtime, $end_time, $sumprob, "0", "", "0", "0", $trialstoday, $trialstotal, $failstoday, $failstotal, $failure);
				}
				else
				{
					if ($success == false)
					{
						$fails = 1;
						$failure = 100.0;
					}
					else
					{
						$fails = 0;
						$failure = 0.0;
					}

					blcap_add_ip_db ($ip, $logdate, $logtime, $end_time, $pos, "0", "", "0", "0", "1", "1", $fails, $fails, $failure);
				}
			}

			if ($success == false)
			{
				if ($capurl != "")
					echo "<div style=\"padding: 5px; border: 2px solid blue; border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; -o-border-radius: 10px;  background: yellow; color: red; font-weight: bold; text-align: center;\"><h3>You have entered a Wrong CAPTCHA.</h3><h4>Click <a href=\"" . $capurl . "\">here</a> to go back and try again.</h4></div>\n";
				else
					echo "<div style=\"padding: 5px; border: 2px solid blue; border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; -o-border-radius: 10px;  background: yellow; color: red; font-weight: bold; text-align: center;\"><h3>You have entered a Wrong CAPTCHA.</h3><h4>Go back and try again.</h4></div>\n";
				die (0);
			}
			else
			{
				if ($captcha_use_sessions == "yes")
					$_SESSION["captcha"] = "";
				else
					blcap_delete_captcha_session ($captcha_id);
			}
		}
	
	return $err;
}

function blcap_lostpasswordform ()
{
	global $current_user;

	$blcap_setser = get_option ("blcap_settings");
	if (is_array ($blcap_setser))
		$sss = $blcap_setser;
	else
		$sss = @unserialize ($blcap_setser);
		
	$user_id = (isset ($current_user->ID) ? $current_user->ID : -1);
	$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
	
	$captcha_active = (isset ($sss["gen_activated"]) ? $sss["gen_activated"] : "yes");	
	$captcha_enabled = (isset ($sss["pwd_enabled"]) ? $sss["pwd_enabled"] : "yes");
	$captcha_user = (isset ($sss["pwd_user"]) ? $sss["pwd_user"] : "0");
	$captcha_use_sessions = (isset ($sss["gen_use_sessions"]) ? $sss["gen_use_sessions"] : "no");
	
	if ($captcha_active == "yes" && $captcha_enabled == "yes")
		if ($user_level <= $captcha_user)
		{
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$start_time = $time;
            
			$sid = "P";
			list ($ip, $remote) = blcap_get_ip ();
			$ip_str = str_replace (".", "", $ip);
			$time_str = str_replace (".", "", (string)$time);
			$sid = $sid . $ip_str . $time_str;
			
			$gen_autogeneratekey = (isset ($sss["gen_autogeneratekey"]) ? $sss["gen_autogeneratekey"] : "yes");
			blcap_check_date ($gen_autogeneratekey);
			
			if ($captcha_use_sessions == "yes")
			{
				if (!isset ($_SESSION)) @session_start ();
                
				$_SESSION["capid"] = $sid;
				$_SESSION["caprefresh"] = -1;
				$_SESSION["captime"] = $start_time;
				$_SESSION["capurl"] = blcap_get_current_url ();
			}
			else
			{
				@include_once ("blfuncs.php");
				
				blcap_add_captcha_session ($sid, $ip, "", "", -1, $start_time, blcap_get_current_url ());
			}
			
			$captchaurl = get_option ("siteurl") . "?bcapact=gen&id=" . $sid;
			
			$captcha_layersize = (isset ($sss["gen_layersize"]) ? $sss["gen_layersize"] : "1");
			$captcha_refresh = (isset ($sss["gen_refresh"]) ? $sss["gen_refresh"] : "yes");

			if ($captcha_layersize == "1")
				$wh_tag = "width=\"200\" height=\"50\" ";
			else
				$wh_tag = "";
			
			if ($captcha_refresh == "yes")
			{
				$rf_tag = "title=\"Click to refresh Captcha Image\" onclick=\"blcap_refresh_captcha();\" ";
				$rf_span = "<span onclick=\"blcap_refresh_captcha();\" title=\"Click to refresh Captcha Image\" onmouseout=\"style.color='black';style.cursor='';\" onmouseover=\"style.color='red';style.cursor='pointer';\">Refresh</span><br />";
			}
			else
			{
				$rf_tag = "";
				$rf_span = "";
			}
			
			echo "\t<p>\n";
			echo "\t\t<div align=\"center\">\n";
			echo "\t\t<img id=\"blcap_img\" src=\"$captchaurl\" " . $wh_tag . "tabindex=\"40\" " . $rf_tag . "/><br />" . $rf_span . "<br />\n";
			echo "\t\t<label>Captcha<br />\n";
			echo "\t\t<input type=\"text\" name=\"user_captcha\" id=\"user_captcha\" title=\"Enter Captcha here\" value=\"\" size=\"15\" tabindex=\"50\" /></label><br /><br />\n";
			echo "\t\t<input type=\"hidden\" name=\"captcha_id\" value=\"" . $sid . "\" />\n";
			echo "\t\t</div>\n";
			echo "\t</p>\n";
	
			if ($captcha_refresh == "yes")
			{
				echo "\n";
				echo "\t<script language=\"javascript\">\n";
				echo "\tvar blcap_refno = 0;\n";
				echo "\tfunction blcap_refresh_captcha()\n";
				echo "\t{\n";
				echo "\t\tvar im = new Image();\n";
				echo "\t\tblcap_refno = blcap_refno + 1;\n";
				echo "\t\tim.src=\"" . $captchaurl . "&refresh=\" + blcap_refno;\n";
				echo "\t\tdocument.getElementById (\"blcap_img\").src = im.src;\n";
				echo "\t}\n";
				echo "\t</script>\n";
				echo "\n";
			}
		}
}

function blcap_lostpasswordact ()
{
	global $current_user;

	$blcap_setser = get_option ("blcap_settings");
	if (is_array ($blcap_setser))
		$sss = $blcap_setser;
	else
		$sss = @unserialize ($blcap_setser);

	$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
	
	$captcha_active = (isset ($sss["gen_activated"]) ? $sss["gen_activated"] : "yes");	
	$captcha_enabled = (isset ($sss["pwd_enabled"]) ? $sss["pwd_enabled"] : "yes");
	$captcha_user = (isset ($sss["pwd_user"]) ? $sss["pwd_user"] : "0");
	$captcha_use_sessions = (isset ($sss["gen_use_sessions"]) ? $sss["gen_use_sessions"] : "no");
	
	if ($captcha_active == "yes" && $captcha_enabled == "yes")
		if ($user_level <= $captcha_user)
		{
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$end_time = $time;
            
 			$user_captcha = (isset ($_REQUEST["user_captcha"]) ? $_REQUEST["user_captcha"] : "");
			$captcha_id = (isset ($_REQUEST["captcha_id"]) ? $_REQUEST["captcha_id"] : "");
	
			@include_once ("blfuncs.php");

			if ($captcha_use_sessions == "yes")
			{
				if (!isset ($_SESSION)) @session_start ();

				$captcha = (isset ($_SESSION["captcha"]) ? $_SESSION["captcha"] : "");
				$start_time = (isset ($_SESSION["captime"]) ? $_SESSION["captime"] : 0);
				$capurl = (isset ($_SESSION["capurl"]) ? $_SESSION["capurl"] : "");
				$refresh = (isset ($_SESSION["caprefresh"]) ? $_SESSION["caprefresh"] : 0);
				if ($refresh < 0) $refresh = 0;
			}
			else
			{        
				$res = blcap_get_captcha_session ($captcha_id);

				$captcha = (isset ($res["captcha"]) ? $res["captcha"] : "");
				$start_time = (isset ($res["captime"]) ? $res["captime"] : 0);
				$capurl = (isset ($res["capurl"]) ? $res["capurl"] : "");
				$refresh = (isset ($res["caprefresh"]) ? $res["caprefresh"] : 0);
				if ($refresh < 0) $refresh = 0;
			}

			$protection_key = "";
			$protection_key = get_option ("blcap_protection_key");
			$user_captcha = str_replace (" ", "", $user_captcha);
			$captcha_to_check = $protection_key . $user_captcha;
            
			if ($captcha != sha1 ($captcha_to_check) || $user_captcha == "" || $captcha == "") $success = false;
			else $success = true;
			
			$gen_log = (isset ($sss["gen_log"]) ? $sss["gen_log"] : "yes");
			$gen_keepinfo = (isset ($sss["gen_keepinfo"]) ? $sss["gen_keepinfo"] : "yes");
			$gen_keeppwd = (isset ($sss["gen_keeppwd"]) ? $sss["gen_keeppwd"] : "no");
   			$ban_iplist = (isset ($sss["ban_iplist"]) ? $sss["ban_iplist"] : "");
   			$ban = (isset ($sss["ban_pwd"]) ? $sss["ban_pwd"] : "0");            
            
			$banresult = false;
			if ($ban > 0 && $ban_iplist != "")
			{
				$iparr = blcap_get_ip ();
				$remoteip = (isset ($iparr[0]) ? $iparr[0] : "-");
				$banresult = blcap_compare_ip ($remoteip, $ban_iplist);
				if ($banresult == true) $success = false;
			}

			if ($gen_log == "yes")
			{
				$total_time = round (($end_time - $start_time)*100) / 100.0;
				$total_time = number_format ($total_time, 2, ".", "");
				
				$iparr = blcap_get_ip ();
				
				$ip = (isset ($iparr[0]) ? $iparr[0] : "-");
				$proxy = (isset ($iparr[1]) ? $iparr[1] : "-");
				if ($ip == $proxy) $proxy = "-";
				
				$logdate = date ("Y/m/d");
				$logtime = date ("H:i:s");
		
				$info = "";
				if ($gen_keepinfo == "yes")
				{	
					$MAX_LEN = 64;
					
					$user_login = (isset ($_REQUEST["user_login"]) ? $_REQUEST["user_login"] : "-");
					
					if (strlen ($user_login) > $MAX_LEN) $user_login = substr ($user_login, 0, $MAX_LEN) . "...";
					
					$info = $info . "Username or E-mail: " . $user_login;
					
					$info = strip_tags ($info, "<br>");
				}
				else $info = "-";

				$totalchars = 0;
				if (isset ($_REQUEST["user_login"]))
					$totalchars = $totalchars + strlen (stripslashes ($_REQUEST["user_login"]));

				$pos = blcap_calc_spam_probability ($total_time, $totalchars, $proxy, $refresh, $user_captcha);

				$more = $totalchars . "#" . $pos;

				if ($success == true) $result = "SUCCESS";
				else $result = "FAIL";
				if ($banresult == true) $result = "BANNED";
				
				$logres = blcap_add_log ($ip, $proxy, $total_time, "LOST_PASSWORD", $user_captcha, $refresh, $result, $info, $more, $logdate, $logtime);

				$ipres = blcap_get_ip_db ($ip);
				if ($ipres["found"] == true)
				{
					$thisdate = (isset ($ipres["date"]) ? $ipres["date"] : "");
					$sumprob = (isset ($ipres["sumprob"]) ? (float)$ipres["sumprob"] : 0.0);
					$trialstoday = (isset ($ipres["trialstoday"]) ? (int)$ipres["trialstoday"] : 0);
					$trialstotal = (isset ($ipres["trialstotal"]) ? (int)$ipres["trialstotal"] : 0);
					$failstoday = (isset ($ipres["failstoday"]) ? (int)$ipres["failstoday"] : 0);
					$failstotal = (isset ($ipres["failstotal"]) ? (int)$ipres["failstotal"] : 0);
					
					if ($sumprob == "" || !is_numeric ($sumprob)) $sumprob = 0.0;
					$sumprob = (float)($sumprob * $trialstotal);
					$sumprob = (float)(1.0*($sumprob + $pos) / ($trialstotal + 1.0));
					$sumprob = number_format ($sumprob, 1, ".", "");

					$trialstotal = (int)($trialstotal + 1);
					if ($thisdate != $logdate)
					{
						$trialstoday = 1;
						$failstoday = 0;
					}
					else $trialstoday = $trialstoday + 1;
					if ($success == false)
					{
						$failstotal = (int)($failstotal + 1);
						$failstoday = (int)($failstoday + 1);
					}
					if ($trialstotal > 0) $failure = 100.0*(1.0*$failstotal / (float)$trialstotal);
					else $failure = 0.0;
					$failure = number_format ($failure, 1, ".", "");

					blcap_update_ip_db ($ip, $logdate, $logtime, $end_time, $sumprob, "0", "", "0", "0", $trialstoday, $trialstotal, $failstoday, $failstotal, $failure);
				}
				else
				{
					if ($success == false)
					{
						$fails = 1;
						$failure = 100.0;
					}
					else
					{
						$fails = 0;
						$failure = 0.0;
					}

					blcap_add_ip_db ($ip, $logdate, $logtime, $end_time, $pos, "0", "", "0", "0", "1", "1", $fails, $fails, $failure);
				}
			}

			if ($success == false)
			{
				if ($capurl != "")
					echo "<div style=\"padding: 5px; border: 2px solid blue; border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; -o-border-radius: 10px;  background: yellow; color: red; font-weight: bold; text-align: center;\"><h3>You have entered a Wrong CAPTCHA.</h3><h4>Click <a href=\"" . $capurl . "\">here</a> to go back and try again.</h4></div>\n";
				else
					echo "<div style=\"padding: 5px; border: 2px solid blue; border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; -o-border-radius: 10px;  background: yellow; color: red; font-weight: bold; text-align: center;\"><h3>You have entered a Wrong CAPTCHA.</h3><h4>Go back and try again.</h4></div>\n";
				die (0);
			}
			else
			{
				if ($captcha_use_sessions == "yes")
					$_SESSION["captcha"] = "";
				else
					blcap_delete_captcha_session ($captcha_id);
			}            
		}
}

function blcap_commentform ()
{
	global $current_user;

	$blcap_setser = get_option ("blcap_settings");
	if (is_array ($blcap_setser))
		$sss = $blcap_setser;
	else
		$sss = @unserialize ($blcap_setser);
		
	$user_id = (isset ($current_user->ID) ? $current_user->ID : -1);
	$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
	
	$captcha_active = (isset ($sss["gen_activated"]) ? $sss["gen_activated"] : "yes");	
	$captcha_enabled = (isset ($sss["com_enabled"]) ? $sss["com_enabled"] : "yes");
	$captcha_user = (isset ($sss["com_user"]) ? $sss["com_user"] : "0");
	$captcha_use_sessions = (isset ($sss["gen_use_sessions"]) ? $sss["gen_use_sessions"] : "no");
	
	if ($captcha_active == "yes" && $captcha_enabled == "yes")
		if ($user_level <= $captcha_user)
		{
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$start_time = $time;
            
			$sid = "C";
			list ($ip, $remote) = blcap_get_ip ();
			$ip_str = str_replace (".", "", $ip);
			$time_str = str_replace (".", "", (string)$time);
			$sid = $sid . $ip_str . $time_str;
			
			$gen_autogeneratekey = (isset ($sss["gen_autogeneratekey"]) ? $sss["gen_autogeneratekey"] : "yes");
			blcap_check_date ($gen_autogeneratekey);
			
			if ($captcha_use_sessions == "yes")
			{
				if (!isset ($_SESSION)) @session_start ();
                
				$_SESSION["capid"] = $sid;
				$_SESSION["caprefresh"] = -1;
				$_SESSION["captime"] = $start_time;
				$_SESSION["capurl"] = blcap_get_current_url ();
			}
			else
			{
				@include_once ("blfuncs.php");
				
				blcap_add_captcha_session ($sid, $ip, "", "", -1, $start_time, blcap_get_current_url ());
			}
			
			$captchaurl = get_option ("siteurl") . "?bcapact=gen&id=" . $sid;
			
			$captcha_layersize = (isset ($sss["gen_layersize"]) ? $sss["gen_layersize"] : "1");
			$captcha_refresh = (isset ($sss["gen_refresh"]) ? $sss["gen_refresh"] : "yes");

			if ($captcha_layersize == "1")
				$wh_tag = "width=\"200\" height=\"50\" ";
			else
				$wh_tag = "";
			
			if ($captcha_refresh == "yes")
			{
				$rf_tag = "title=\"Click to refresh Captcha Image\" onclick=\"blcap_refresh_captcha();\" ";
				$rf_span = "<span onclick=\"blcap_refresh_captcha();\" title=\"Click to refresh Captcha Image\" onmouseout=\"style.color='black';style.cursor='';\" onmouseover=\"style.color='red';style.cursor='pointer';\">Refresh</span><br />";
			}
			else
			{
				$rf_tag = "";
				$rf_span = "";
			}
		
			echo "\n\t<p>\n";
			echo "\t\t<div align=\"left\">\n";
			echo "\t\t<img id=\"blcap_img\" src=\"$captchaurl\" " . $wh_tag . "tabindex=\"40\" " . $rf_tag . "/><br />" . $rf_span . "<br />\n";
			echo "\t\t<label>Captcha<br />\n";

			echo "\t\t<input type=\"text\" name=\"user_captcha\" id=\"user_captcha\" title=\"Enter Captcha here\" value=\"\" size=\"15\" tabindex=\"50\" /></label><br /><br />\n";
			echo "\t\t<input type=\"hidden\" name=\"captcha_id\" value=\"" . $sid . "\" />\n";
			echo "\t\t</div>\n";
			echo "\t</p>\n";
	
			if ($captcha_refresh == "yes")
			{
				echo "\n";
				echo "\t<script language=\"javascript\">\n";
				echo "\tvar blcap_refno = 0;\n";
				echo "\tfunction blcap_refresh_captcha()\n";
				echo "\t{\n";
				echo "\t\tvar im = new Image();\n";
				echo "\t\tblcap_refno = blcap_refno + 1;\n";
				echo "\t\tim.src=\"" . $captchaurl . "&refresh=\" + blcap_refno;\n";
				echo "\t\tdocument.getElementById (\"blcap_img\").src = im.src;\n";
				echo "\t}\n";
				echo "\t</script>\n";
				echo "\n";
			}
		}
}

function blcap_commentflt ($subcomment)
{
	global $current_user;
	
	$blcap_setser = get_option ("blcap_settings");
	if (is_array ($blcap_setser))
		$sss = $blcap_setser;
	else
		$sss = @unserialize ($blcap_setser);
		
	$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
	
	$captcha_active = (isset ($sss["gen_activated"]) ? $sss["gen_activated"] : "yes");	
	$captcha_enabled = (isset ($sss["com_enabled"]) ? $sss["com_enabled"] : "yes");
	$captcha_allow_pingtrack = (isset ($sss["gen_pingtrack"]) ? $sss["gen_pingtrack"] : "yes");
	$captcha_user = (isset ($sss["com_user"]) ? $sss["com_user"] : "0");
	$captcha_use_sessions = (isset ($sss["gen_use_sessions"]) ? $sss["gen_use_sessions"] : "no");

	if ($subcomment["comment_type"] == "pingback" || $subcomment["comment_type"] == "trackback")
	{
		if ($captcha_active == "yes" && $captcha_allow_pingtrack == "no")
		{
			$captcha_enabled = "yes";
			$user_level = -1;
		}
		else return $subcomment;
	}
	
	if ($captcha_active == "yes" && $captcha_enabled == "yes")
		if ($user_level <= $captcha_user)
		{
			$time = microtime();
			$time = explode(" ", $time);
			$time = $time[1] + $time[0];
			$end_time = $time;
            
			$user_captcha = (isset ($_REQUEST["user_captcha"]) ? $_REQUEST["user_captcha"] : "");
			$captcha_id = (isset ($_REQUEST["captcha_id"]) ? $_REQUEST["captcha_id"] : "");
	
			@include_once ("blfuncs.php");

			if ($captcha_use_sessions == "yes")
			{
				if (!isset ($_SESSION)) @session_start ();

				$captcha = (isset ($_SESSION["captcha"]) ? $_SESSION["captcha"] : "");
				$start_time = (isset ($_SESSION["captime"]) ? $_SESSION["captime"] : 0);
				$capurl = (isset ($_SESSION["capurl"]) ? $_SESSION["capurl"] : "");
				$refresh = (isset ($_SESSION["caprefresh"]) ? $_SESSION["caprefresh"] : 0);
				if ($refresh < 0) $refresh = 0;
			}
			else
			{        
				$res = blcap_get_captcha_session ($captcha_id);

				$captcha = (isset ($res["captcha"]) ? $res["captcha"] : "");
				$start_time = (isset ($res["captime"]) ? $res["captime"] : 0);
				$capurl = (isset ($res["capurl"]) ? $res["capurl"] : "");
				$refresh = (isset ($res["caprefresh"]) ? $res["caprefresh"] : 0);
				if ($refresh < 0) $refresh = 0;
			}

			$protection_key = "";
			$protection_key = get_option ("blcap_protection_key");
			$user_captcha = str_replace (" ", "", $user_captcha);
			$captcha_to_check = $protection_key . $user_captcha;
            
			if ($captcha != sha1 ($captcha_to_check) || $user_captcha == "" || $captcha == "") $success = false;
			else $success = true;
			
			$gen_log = (isset ($sss["gen_log"]) ? $sss["gen_log"] : "yes");
			$gen_keepinfo = (isset ($sss["gen_keepinfo"]) ? $sss["gen_keepinfo"] : "yes");
			$gen_keeppwd = (isset ($sss["gen_keeppwd"]) ? $sss["gen_keeppwd"] : "no");
   			$ban_iplist = (isset ($sss["ban_iplist"]) ? $sss["ban_iplist"] : "");
   			$ban = (isset ($sss["ban_com"]) ? $sss["ban_com"] : "0");

			$banresult = false;
			if ($ban > 0 && $ban_iplist != "")
			{
				$iparr = blcap_get_ip ();
				$remoteip = (isset ($iparr[0]) ? $iparr[0] : "-");
				$banresult = blcap_compare_ip ($remoteip, $ban_iplist);
				if ($banresult == true) $success = false;
			}
		
			if ($gen_log == "yes")
			{
				$total_time = round (($end_time - $start_time)*100) / 100.0;
				$total_time = number_format ($total_time, 2, ".", "");
				
				$iparr = blcap_get_ip ();
				
				$ip = (isset ($iparr[0]) ? $iparr[0] : "-");
				$proxy = (isset ($iparr[1]) ? $iparr[1] : "-");
				if ($ip == $proxy) $proxy = "-";
				
				$logdate = date ("Y/m/d");
				$logtime = date ("H:i:s");
				
				$info = "";
				if ($gen_keepinfo == "yes")
				{
					$MAX_LEN = 512;
					$MAX_COMMENT_LEN = 4096;
					
					$author = (isset ($subcomment["comment_author"]) ? $subcomment["comment_author"] : "-");
					$email = (isset ($subcomment["comment_author_email"]) ? $subcomment["comment_author_email"] : "-");
					$authorurl = (isset ($subcomment["comment_author_url"]) ? $subcomment["comment_author_url"] : "-");
					$targeturl = (isset ($capurl) ? $capurl : "");
					$comment = (isset ($subcomment["comment_content"]) ? $subcomment["comment_content"] : "-");
					if (trim ($targeturl) == "") $targeturl = blcap_get_current_url();

					$author = trim (strip_tags ($author));
					$email = trim (strip_tags ($email));
					$authorurl = trim (strip_tags ($authorurl));
					$targeturl = trim (strip_tags ($targeturl));
					$comment = trim (strip_tags ($comment));

					if (strlen ($author) > $MAX_LEN) $author = substr ($author, 0, $MAX_LEN) . "...";
					if (strlen ($email) > $MAX_LEN) $email = substr ($email, 0, $MAX_LEN) . "...";
					if (strlen ($authorurl) > $MAX_LEN) $authorurl = substr ($authorurl, 0, $MAX_LEN) . "...";
					if (strlen ($targeturl) > $MAX_LEN) $targeturl = substr ($targeturl, 0, $MAX_LEN) . "...";
					if (strlen ($comment) > $MAX_COMMENT_LEN) $comment = substr ($comment, 0, $MAX_COMMENT_LEN) . "...";
					
					$comment_type = (isset ($subcomment["comment_type"]) ? $subcomment["comment_type"] : "");

					if ($comment_type == "pingback" || $comment_type == "trackback")
					{
						$comment_type = " (" . $comment_type . ")";
					}
					else $comment_type = "";

					$info = $info . "Author: " . $author . "<br>";
					$info = $info . "Email: " . $email . "<br>";
					$info = $info . "Author URL: " . $authorurl . "<br>";
					$info = $info . "Target URL: " . $targeturl . "<br>";
					$info = $info . "Comment" . $comment_type . ": " . $comment;
					
					$info = strip_tags ($info, "<br>");
				}
				else $info = "-";

				$totalchars = 0;
				if ($user_level < 0 && isset ($subcomment["comment_author"]))
					$totalchars = $totalchars + strlen (stripslashes ($subcomment["comment_author"]));
				if ($user_level < 0 && isset ($subcomment["comment_author_email"]))
					$totalchars = $totalchars + strlen (stripslashes ($subcomment["comment_author_email"]));
				if ($user_level < 0 && isset ($subcomment["comment_author_url"]))
					$totalchars = $totalchars + strlen (stripslashes ($subcomment["comment_author_url"]));
				if (isset ($subcomment["comment_content"]))
					$totalchars = $totalchars + strlen (stripslashes ($subcomment["comment_content"]));
                    
				$pos = blcap_calc_spam_probability ($total_time, $totalchars, $proxy, $refresh, $user_captcha);

				$more = $totalchars . "#" . $pos;
                
				if ($success == true) $result = "SUCCESS";
				else $result = "FAIL";
				if ($banresult == true) $result = "BANNED";
				
				$logres = blcap_add_log ($ip, $proxy, $total_time, "COMMENT", $user_captcha, $refresh, $result, $info, $more, $logdate, $logtime);

				$ipres = blcap_get_ip_db ($ip);
				if ($ipres["found"] == true)
				{
					$thisdate = (isset ($ipres["date"]) ? $ipres["date"] : "");
					$sumprob = (isset ($ipres["sumprob"]) ? (float)$ipres["sumprob"] : 0.0);
					$trialstoday = (isset ($ipres["trialstoday"]) ? (int)$ipres["trialstoday"] : 0);
					$trialstotal = (isset ($ipres["trialstotal"]) ? (int)$ipres["trialstotal"] : 0);
					$failstoday = (isset ($ipres["failstoday"]) ? (int)$ipres["failstoday"] : 0);
					$failstotal = (isset ($ipres["failstotal"]) ? (int)$ipres["failstotal"] : 0);
					
					if ($sumprob == "" || !is_numeric ($sumprob)) $sumprob = 0.0;
					$sumprob = (float)($sumprob * $trialstotal);
					$sumprob = (float)(1.0*($sumprob + $pos) / ($trialstotal + 1.0));
					$sumprob = number_format ($sumprob, 1, ".", "");

					$trialstotal = (int)($trialstotal + 1);
					if ($thisdate != $logdate)
					{
						$trialstoday = 1;
						$failstoday = 0;
					}
					else $trialstoday = $trialstoday + 1;
					if ($success == false)
					{
						$failstotal = (int)($failstotal + 1);
						$failstoday = (int)($failstoday + 1);
					}
					if ($trialstotal > 0) $failure = 100.0*(1.0*$failstotal / (float)$trialstotal);
					else $failure = 0.0;
					$failure = number_format ($failure, 1, ".", "");

					blcap_update_ip_db ($ip, $logdate, $logtime, $end_time, $sumprob, "0", "", "0", "0", $trialstoday, $trialstotal, $failstoday, $failstotal, $failure);
				}
				else
				{
					if ($success == false)
					{
						$fails = 1;
						$failure = 100.0;
					}
					else
					{
						$fails = 0;
						$failure = 0.0;
					}

					blcap_add_ip_db ($ip, $logdate, $logtime, $end_time, $pos, "0", "", "0", "0", "1", "1", $fails, $fails, $failure);
				}
	
			}
			
			if ($success == false)
			{	
				if ($capurl != "")
					echo "<div style=\"padding: 5px; border: 2px solid blue; border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; -o-border-radius: 10px; background: yellow; color: red; font-weight: bold; text-align: center;\"><h3>You have entered a Wrong CAPTCHA.</h3><h4>Click <a href=\"" . $capurl . "\">here</a> to go back and try again.</h4></div>\n";
				else
					echo "<div style=\"padding: 5px; border: 2px solid blue; border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; -webkit-border-radius: 10px; -o-border-radius: 10px;  background: yellow; color: red; font-weight: bold; text-align: center;\"><h3>You have entered a Wrong CAPTCHA.</h3><h4>Go back and try again.</h4></div>\n";
				die (0);
			}
			else
			{
				if ($captcha_use_sessions == "yes")
					$_SESSION["captcha"] = "";
				else
					blcap_delete_captcha_session ($captcha_id);
			}            
		}
	
	return $subcomment;
}

function blcap_update_func ()
{
	blcap_install ();
}

function blcap_get_version ()
{
	if (!function_exists ("get_plugins"))
	require_once (ABSPATH . "wp-admin/includes/plugin.php");
	$plugin_folder = get_plugins ("/" . plugin_basename (dirname (__FILE__)));
	$plugin_file = basename ((__FILE__));
	return $plugin_folder[$plugin_file]["Version"];
}

function blcap_check_for_update ()
{
	$current_version = get_option ("blcap_version");
	
	if ($current_version == "") return;
	
	$new_version = blcap_get_version ();
	
	if ($new_version == $current_version) return;
	if (version_compare ($current_version, $new_version, "<"))
	{
		blcap_update_func ();
	        add_option ("blcap_version", $new_version);
        	update_option ("blcap_version", $new_version);
	}
}

function blcap_init ()
{
	global $current_user;
	
	//blcap_check_for_update ();
	
	@session_start ();
	
	$act = (isset ($_REQUEST["bcapact"]) ? $_REQUEST["bcapact"] : "");

	if ($act == "gen")
	{
		$cid = (isset ($_REQUEST["id"]) ? $_REQUEST["id"] : "");
		@include_once ("blfuncs.php");
		@include_once ("blimage.php");
		die (0);
	}
	else
	if ($act == "exp" || $act == "exphos")
	{
		$user_id = (isset ($current_user->ID) ? $current_user->ID : -1);
		$user_level = (isset ($current_user->user_level) ? $current_user->user_level : -1);
		
		if ($user_id >= 0 && $user_level == 10)
		{
			@include_once ("blfuncs.php");
			
			header ("Content-type: text/html; charset=utf-8");
			header ("Content-type: application/vnd.ms-excel");
			if ($act == "exp")
				header ("Content-disposition: attachment; filename=bluecaptcha_" . date("Ymd") . ".csv");
			else
				header ("Content-disposition: attachment; filename=bluecaptcha_hos_" . date("Ymd") . ".csv");
			
			if ($act == "exp")
			{	
				echo "no;date;time;ip;proxy;captcha;refreshes;response_time;total_chars;type;result;spam_probability;info";
				echo "\n";
				blcap_create_csv ();
			}
			else
			{
				echo "no;ip;last_date;last_time;current_fails;current_trials;total_fails;total_trials;failure;avg_spam_probabiliy";
				echo "\n";
				blcap_create_csv_hos ();
			}			

			die (0);
		}
	}
}

add_action ("admin_menu", "blcap_add_menus");

add_action ("init", "blcap_init");
add_action ("plugins_loaded", "blcap_check_for_update");

add_action ("login_form", "blcap_loginform");
add_action ("wp_authenticate", "blcap_loginact", 10);

add_action ("register_form", "blcap_registerform", 10);
add_filter ("registration_errors", "blcap_registerflt");

add_action ("lostpassword_form", "blcap_lostpasswordform", 10);
add_action ("lostpassword_post", "blcap_lostpasswordact", 10);

add_action ("comment_form", "blcap_commentform", 1);
add_filter ("preprocess_comment", "blcap_commentflt", 1);

register_activation_hook (__FILE__, "blcap_install");

?>
