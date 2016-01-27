<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Social Media Sign In Configuration
|--------------------------------------------------------------------------
|
| 
*/

/* Facebook */
$config['socmed']['facebook_app_id'] 	= "318069428397604";
$config['socmed']['facebook_app_secret']= "a8a050c9feaf3eb94a56962f412e3b33";
$config['socmed']['facebook_url_callback']	= 'login/fb_callback';

/* Twitter */
$config['socmed']['twitter_consumer_key'] 	= "LZucPPfqz3LCkpCqjljvNMz0G";
$config['socmed']['twitter_consumer_secret']= "jWp3ucr9ED30wOqlZKUIXRD29bjtwW6aFeWOjQmrCLgoi4BlzB";
$config['socmed']['twitter_url_callback']	= 'login/tw_callback';

/* Telkom */
$config['socmed']['telkom_client_id'] 		= "q-journal";
$config['socmed']['telkom_client_secret']	= "qjournal@2014";
$config['socmed']['telkom_url_callback']	= 'login/telkom_login';


/* End of file twitter.php */
/* Location: ./application/config/twitter.php */
