<?php

if (! defined('BASEPATH'))
	exit('No direct script access allowed');
	
	/*
 * |--------------------------------------------------------------------------
 * | Site Setting Configuration
 * |--------------------------------------------------------------------------
 * |
 * |
 * |
 */
$config['site_settings']['sitename'] = "Ads Inventory";
$config['site_settings']['email'] = "achmun.16@gmail.com";
$config['site_settings']['phone'] = "(+62)21 3375 8000";

// Desain View
$template = "sbadmin";
$config['site_settings']['template'] = $template;
$config['site_settings']['admin_layout'] = 'admin';
$config['site_settings']['default_layout'] = 'themes/' . $template . '/general_globalpage';
$config['site_settings']['path_view'] = 'themes/' . $template;
// Path Asset
$asset_host = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$config['site_settings']['asset_host'] = $asset_host;
$config['site_settings']['asset_basedir'] = $asset_host . 'assets';
$config['site_settings']['asset_css'] = $config['site_settings']['asset_basedir'] . '/css';
$config['site_settings']['asset_img'] = $config['site_settings']['asset_basedir'] . '/images';
$config['site_settings']['asset_plugin'] = $config['site_settings']['asset_basedir'] . '/plugin';
// Path Media
$config['site_settings']['media_basedir'] = $_SERVER["DOCUMENT_ROOT"] . '/';
$config['site_settings']['media_blueprint'] = 'media/blueprint';
$config['site_settings']['media_photo'] = 'media/photo';

/* End of file site_settings.php */
/* Location: ./application/config/site_settings.php */
