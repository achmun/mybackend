<?php

function get_month($id = NULL, $placeholder='') // fungsi untuk mengambil nama level
{
	$datas =  array(
			'' => $placeholder,
			1=>'Jan',
			2=>'Feb',
			3=>'Mar',
			4=>'Apr',
			5=>'May',
			6=>'Jun',
			7=>'Jul',
			8=>'Aug',
			9=>'Sep',
			10=>'Oct',
			11=>'Nov',
			12=>'Dec',
	);

	if ($id == NULL) {
		return $datas;
	} else {
		if (is_numeric($id)) {
			$output = $datas[$id];
		} else {
			$output = array_search(strtolower($id),array_map('strtolower',$datas));
		}
		return $output;
	}
}

function get_level_name($id = NULL, $placeholder='') // fungsi untuk mengambil nama level
{  
	$datas =  array(
			'' => $placeholder,
			1=>'Super Admin',
			2=>'Admin',
			3=>'User',
	);

	if ($id == NULL) {
		return $datas;
	} else {
		if (is_numeric($id)) {
			$output = $datas[$id];
		} else {
			$output = array_search(strtolower($id),array_map('strtolower',$datas));
		}
		return $output;
	}
}

function encrypt_password($str)
{
	$cipher = new Cipher(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	$key = "achmadmunandar1234567890";
	
	return $cipher->encrypt($str, $key);
}
function get_publisher($id=0, $order=null) // fungsi untuk mengambil data provinsi
{
	$CI =& get_instance();
	$CI->load->model('publisher_model');
	if ($id == 0){
		$ordering = $order == null ? "created" : $order;
		$data = $CI->publisher_model->get_data(array(), $ordering);
		
		return $data;
	} else {
		$data = $CI->publisher_model->get_data(array('id_pub'=>$id));
		
		return $data[0];
	}
}
function get_select_user($level=0, $placeholder='') // fungsi untuk mengambil data provinsi
{
	/* Level : 1 -> Super Admin, 2 -> Admin, 3 -> User */
	$CI =& get_instance();
	$CI->load->model('user_model');
	if ($level == 0) 
		$where = array();
	else 
		$where = array('level'=>$level);
	
	$data = $CI->user_model->get_data($where, 'name');

	$datas = array(''=>$placeholder);
	for ($i=0;$i<count($data);$i++){
		$datas[$data[$i]->uid] = $data[$i]->name;
	}
	return $datas;
}
function get_last_insertid($table)
{
	$CI =& get_instance();
	$table_schema = $CI->db->database;
	
	$query = $CI->db->query("select AUTO_INCREMENT from `information_schema`.`TABLES` where `TABLE_SCHEMA`='$table_schema' and `TABLE_NAME`='$table'");
	
	return $query = $query->row()->AUTO_INCREMENT;
}
function getListAccounts(&$analytics) {
  // Get the user's first view (profile) ID.

  // Get the list of accounts for the authorized user.
  $accounts = $analytics->management_accounts->listManagementAccounts();

  return $accounts->getItems();
  /*
  if (count($accounts->getItems()) > 0) {
    $items = $accounts->getItems();
    return $items;
  } else {
    throw new Exception('No accounts found for this user.');
  }*/
}
function getFirstprofileId(&$analytics) {
  // Get the user's first view (profile) ID.

  // Get the list of accounts for the authorized user.
  $accounts = $analytics->management_accounts->listManagementAccounts();

  if (count($accounts->getItems()) > 0) {
    $items = $accounts->getItems();
    $firstAccountId = $items[0]->getId();

    // Get the list of properties for the authorized user.
    $properties = $analytics->management_webproperties
        ->listManagementWebproperties($firstAccountId);

    if (count($properties->getItems()) > 0) {
      $items = $properties->getItems();
      $firstPropertyId = $items[0]->getId();

      // Get the list of views (profiles) for the authorized user.
      $profiles = $analytics->management_profiles
          ->listManagementProfiles($firstAccountId, $firstPropertyId);

      if (count($profiles->getItems()) > 0) {
        $items = $profiles->getItems();

        // Return the first view (profile) ID.
        return $items[0]->getId();

      } else {
        throw new Exception('No views (profiles) found for this user.');
      }
    } else {
      throw new Exception('No properties found for this user.');
    }
  } else {
    throw new Exception('No accounts found for this user.');
  }
}

function getEmail($token) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
  return $token['payload']['email'];
}
function getAccessToken($accessToken) {
  $datas = json_decode($accessToken);
  
  return $datas->access_token;
}

function getResults(&$analytics, $profileId) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
  return $analytics->data_ga->get(
      'ga:' . $profileId,
      '2015-06-01',
      '2015-06-20',
      'ga:sessions,ga:pageviews,ga:users');
}

function printResults(&$results) {
  // Parses the response from the Core Reporting API and prints
  // the profile name and total sessions.
  if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $results->getRows();
    $sessions = $rows[0][0];
    $pageviews = $rows[0][1];
    $users = $rows[0][2];

    // Print the results.
    print "<p>First view (profile) found: $profileName</p>";
    print "<p>Total sessions : $sessions</p>";
    print "<p>Total pageviews: $pageviews</p>";
    print "<p>Total Unique Visitor : $users</p>";
  } else {
    print "<p>No results found.</p>";
  }
}
?>
