<?php

if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Login extends CI_Controller {
	protected $settings = array();
	protected $path_view = "";	
	
	function __construct() {
		parent::__construct ();
		$this->settings = $this->config->item('site_settings');
		$this->path_view = $this->settings['path_view'];
		//$this->socmed = $this->config->item('socmed');
	}
	public function index() 
	{
		$data = array ();
		$data ['title'] = 'Login';
		$data ['message'] = '';
		$data ['pagetitle'] = 'Login';
		// $settings = $this->config->item('site_settings');
		// print_r($settings);
		$this->load->model ( 'user_model' );
		// if user has logined, redirect page to home
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect(base_url());
		}
		
		if ($this->input->post ()) {
			$this->form_validation->set_rules ( 'username', 'Username', 'trim|required' );
			$this->form_validation->set_rules ( 'password', 'Password', 'trim|required' );
			$username = $this->input->post ( 'username', true );
			$password = $this->input->post ( 'password', true );
			$encPassword = sha1 ( $password );
			
			// $this->form_validation->set_rules('level', 'Level', 'trim|required');
			// echo $email;
			// print_r($email);
			if ($this->form_validation->run () == TRUE) {
				//validasi login dengan menggunakan password system lama ataupun baru.
				// $query = $this->db->query ( "SELECT * FROM `user` WHERE `email`='$username' AND `password`='$encPassword'" ); //
				$rows = $this->user_model->get_single_data(array('uname'=>$username, 'password'=>$encPassword));
				//$rows = $query->row();
				// print_r($rows);
				
				if ($rows['uid'] != "") {
					//echo $this->db->last_query();
					$status = $rows['lockout'];
					//$level = get_level_name($rows->level);
					$idlevel = $rows['level']; 
					$name = $rows['name'];
					$uid = $rows['uid'];
					
					$user = array (
						'uid' => $uid,
						'name' => $name,
						//'level' => $level,
						'idlevel' => $idlevel,
						'logged_in' => TRUE 
					);
						
					// account diblokir/banned
					if ($status == '1') {
						$data ['message'] = '!! Your Account was blocked. Please contact website Administrator for detail information. !!';
						
					// account aktif
					} elseif ($status == '0') {
						$this->session->set_userdata ( $user );
						redirect('');
					}
					
				// jika email user tidak ada di dalam database  
				} else {
					$data ['message'] = '!! Wrong Username or Password !!';
				}
			}
		}
		//$content['JS_SCRIPT'] = $this->init_javascript_login();
		//$content ['CONTENT'] = $this->parser->parse ( $this->settings ['path_view'].'/login', $data, true );
		$content['CONTENT'] = $this->parser->parse ( $this->path_view . '/login', $data, true );
		$this->parser->parse ( $this->settings['default_layout'], $content );
		//$this->load->view ( 'login', $data );
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}
	public function google()
	{
		$this->load->model('user_model');
		$data = array();
		
		require_once APPPATH.'libraries/google-api-php-client/src/Google/autoload.php';
		//$this->load->model('users_model');
        /************************************************
		  ATTENTION: Fill in these values! Make sure
		  the redirect URI is to this page, e.g:
		  http://localhost:8080/user-example.php
		 ************************************************/
		 $client_id = '1063903629062-1q9qletmv9v0m7nedfjtq2nu1aabv3mk.apps.googleusercontent.com';
		 $client_secret = '_beoTqZJ9LuVxN5SmUT39y-c';
		 $redirect_uri = base_url('login/google');

		/************************************************
		  Make an API request on behalf of a user. In
		  this case we need to have a valid OAuth 2.0
		  token for the user, so we need to send them
		  through a login flow. To do this we need some
		  information from our API console project.
		 ************************************************/
		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->setScopes('email');
		$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

		// Handle authorization flow from the server.
		if (! isset($_GET['code'])) {
		  $auth_url = $client->createAuthUrl();
		  //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
		  redirect(filter_var($auth_url, FILTER_SANITIZE_URL));
		} else {
			$client->authenticate($_GET['code']);
			$getAccessToken = $client->getAccessToken();
			$tokenData = $client->verifyIdToken()->getAttributes();
			//$this->session->set_userdata('access_token', $getAccessToken);
			$email = getEmail($tokenData);
			
			if ($email != ''){
				$getUserProfile = $this->user_model->get_single_data(array('email'=>$email));
				if ($getUserProfile['uid'] != ''){
					$status = $getUserProfile['status'];
					$level = get_level_name($getUserProfile['level']);
					$idlevel = $getUserProfile['level']; 
					$name = $getUserProfile['name'];
					$uid = $getUserProfile['uid'];
					
					$sessions = array (
							'uid' => $uid,
							'email' => $email,
							'name' => $name,
							'level' => $level,
							'idlevel' => $idlevel,
							'access_token' => $getAccessToken
					);
						
					// account diblokir/banned
					if ($status == '0') {
						$data ['message'] = '!! Account anda diblokir. Untuk informasi lebih lanjut, silahkan hubungi Administrator !!';
							
					// account aktif
					} elseif ($status == '1') {
						$this->session->sess_expiration = '3600';
						$this->session->set_userdata ( $sessions );
						redirect('');
					}
				} else {
					$data ['message'] = 'Anda tidak terdaftar sebagai admin aplikasi ini. Silahkan hubungi Administrator untuk mendapatkan akses.';
				}
			} else {
				$data ['message'] = 'Your Email account is not valid.';
			}
			//$_SESSION['access_token'] = $getAccessToken;
			//$access_token = json_decode($getAccessToken);
			//$_SESSION['new_access_token'] = $access_token['access_token'];
			//$redirect_uri = base_url('');
			//header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
			//redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}
		$content['CONTENT'] = $this->parser->parse ( $this->path_view . '/login', $data, true );
		$this->parser->parse ( $this->settings['default_layout'], $content );
		
	}
	public function google_login()
	{
		require_once APPPATH.'libraries/google-api-php-client/src/Google/autoload.php';
		//$this->load->model('users_model');
        
		//$redirect = isEmpty($this->input->get('referuri'))?'':$this->input->get('referuri');
 		$data = array();
		//echo 'test';
		// Start a session to persist credentials.
		//session_start();
		//echo BASEPATH;
		//var_dump(is_file(APPPATH.'libraries/google-api-php-client/client_secrets.json'));
		//exit('test');
		
		// Create the client object and set the authorization configuration
		// from the client_secrets.json you downloaded from the Developers Console.
		$client = new Google_Client();
		$client->setAuthConfigFile(APPPATH.'libraries/google-api-php-client/client_secrets.json');
		//$client->setRedirectUri(base_url('login/google_callback'));
		$client->setScopes('email');
		$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

		// If the user has already authorized this app then get an access token
		// else redirect to ask the user to authorize access to Google Analytics.
		if ($this->session->userdata('access_token') != '') {
		  // Set the access token on the client.
		  $client->setAccessToken($this->session->userdata('access_token'));

		  // Create an authorized analytics service object.
		  $analytics = new Google_Service_Analytics($client);

		  // Get the first view (profile) id for the authorized user.
		  $profile = getFirstProfileId($analytics);

		  // Get the results from the Core Reporting API and print the results.
		  printResults(getResults($analytics, $profile));
		} else {
		  $redirect_uri = base_url('login/google_callback');
		  //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		  redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}
	}
	
	public function google_callback()
	{
		require_once APPPATH.'libraries/google-api-php-client/src/Google/autoload.php';
		//$this->load->model('users_model');
        
		//$redirect = isEmpty($this->input->get('referuri'))?'':$this->input->get('referuri');
 		$data = array();
		//echo 'test';
		// Start a session to persist credentials.
		//session_start();
		//echo BASEPATH;
		//var_dump(is_file(APPPATH.'libraries/google-api-php-client/client_secrets.json'));
		//exit('test');
		
		// Create the client object and set the authorization configuration
		// from the client_secrets.json you downloaded from the Developers Console.
		$client = new Google_Client();
		$client->setAuthConfigFile(APPPATH.'libraries/google-api-php-client/client_secrets.json');
		$client->setRedirectUri(base_url('login/google_callback'));
		$client->setScopes('email');
		$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

		// Handle authorization flow from the server.
		if (! isset($_GET['code'])) {
		  $auth_url = $client->createAuthUrl();
		  //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
		  redirect(filter_var($auth_url, FILTER_SANITIZE_URL));
		} else {
			$client->authenticate($_GET['code']);
			$getAccessToken = $client->getAccessToken();
			$this->session->set_userdata('access_token', $getAccessToken);
			//$_SESSION['access_token'] = $getAccessToken;
			//$access_token = json_decode($getAccessToken);
			//$_SESSION['new_access_token'] = $access_token['access_token'];
			$redirect_uri = base_url('');
			//header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
			redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}

		
	}
	private function set_session_login($user_data) 
	{
		$this->session->set_userdata ( $user_data );
		
		$iduser = $user_data['userid'];
		$email = $user_data['uid'];
		$level = $user_data['level'];
		if (array_key_exists('fbid', $user_data)) {
			$counter = "`FB_COUNTER`=`FB_COUNTER`+1";
		} elseif (array_key_exists('twid', $user_data)) {
			$counter = "`TW_COUNTER`=`TW_COUNTER`+1";
		} elseif (array_key_exists('telkomid', $user_data)) {
			$counter = "`TELKOM_COUNTER`=`TELKOM_COUNTER`+1";
		} else {
			$counter = "`QJ_COUNTER`=`QJ_COUNTER`+1";
		}
		// -> update counter login 
		$sql_counter = "INSERT INTO `login_counter` (`ID_USER`,`EMAIL_USER`,`LEVEL`,`LOGIN_DATE`,`FB_COUNTER`) " . " VALUE ('$iduser','$email','$level',CURDATE(),1) " . " ON DUPLICATE KEY UPDATE $counter";
		$this->db->query ( $sql_counter );
	}
	//this used for callback of form_validation
	private function email_exist($email) {
		$this->load->model('users_model');
		$is_email_exist = $this->users_model->is_user_exist('EMAIL_USER', $email);
		if (!$is_email_exist) {//jika email tidak ada di database
			return TRUE;
		} else {
			$this->form_validation->set_message('email_exist', '%s already exist. Please input another email address.');
			return FALSE;
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
?>
