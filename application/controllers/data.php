<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Data extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'security' );
		// if not login, redirect to front page
		if ($this->session->userdata ( 'uid' ) == "") {
			redirect ( '' );
		}
	}
	public function index() {
		// $this->load->view('data/index');
	}
	/*
	 * json_data for datatables server side processing
	 */
	public function get_publisher() {
// 		require_once APPPATH.'libraries/google-api-php-client/src/Google/autoload.php';
// 		//$this->load->model('users_model');
// 		/************************************************
// 		 ATTENTION: Fill in these values! Make sure
// 		 the redirect URI is to this page, e.g:
// 		 http://localhost:8080/user-example.php
// 		 ************************************************/
// 		$client_id = '708897842391-saqr2erftqdtvo24v80bq97im8tc85p6.apps.googleusercontent.com';
// 		$client_secret = '_OdU0yXpJmi3wrqcAptgVBS3';
// 		$redirect_uri = base_url('login/google');
		
// 		/************************************************
// 		 Make an API request on behalf of a user. In
// 		 this case we need to have a valid OAuth 2.0
// 		 token for the user, so we need to send them
// 		 through a login flow. To do this we need some
// 		 information from our API console project.
// 		************************************************/
// 		$client = new Google_Client();
// 		$client->setClientId($client_id);
// 		$client->setClientSecret($client_secret);
// 		$client->setRedirectUri($redirect_uri);
// 		//$client->setScopes('email');
// 		$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
		
		$mode = $this->uri->segment ( 3 );
		$year = 2015;
		$month = 5;
		$list = array ();
		$token = getAccessToken ( $this->session->userdata ( 'access_token' ) );
		
		if ($this->session->userdata ( 'access_token' ) == '') {
			redirect ( 'login' );
		}
		// die($token);
		// Set the access token on the client.
		/* $client->setAccessToken ( $this->session->userdata ( 'access_token' ) );
		
		$token_data = $client->verifyIdToken ()->getAttributes ();
		
		// Create an authorized analytics service object.
		$analytics = new Google_Service_Analytics ( $client );
		
		// Get the first view (profile) id for the authorized user.
		// $profile = getFirstProfileId($analytics);
		$accounts = $analytics->management_accounts->listManagementAccounts ();
		$i = 1;
		if (count ( $accounts ) > 0) {
			foreach ( $accounts as $row ) {
				echo "Account ".$i++.": ".$row->getId();
			}
		} else {
			echo "No accounts found for this user.";
		} */
		
// 		$getPublisher = $this->publisher_model->get_data ( array () );
		
// 		for($i = 1; $i <= $loop; $i ++) {
// 			$month_pad = str_pad ( $i, 2, "0", STR_PAD_LEFT );
			
// 			// $table .= '<td>'.$year.'-'.$month_pad.'</td>';
// 		}
		// $table .= '</tr>';
		
		// if(!empty($ses_access_token) && isset($ses_access_token)){
		
		$url = 'https://www.googleapis.com/analytics/v3/management/accounts?access_token=' . $token;
		$json = file_get_contents ( $url );
		$jsonData = json_decode ( $json );
		$totalAccount = 0;
// 		print_r($jsonData);
// 		print_r($jsonData->items);
		foreach ($jsonData->items as $row){
			$urlProperties = $row->childLink->href . '?access_token=' . $token;
			
			$account = array(
					'account_id' => $row->id,
					'account_name' => $row->name,
					'property_url' => $row->childLink->href,
					'created' => date_format(new DateTime($row->created), "Y-m-d H:i:s"),
					'updated' => date_format(new DateTime($row->updated), "Y-m-d H:i:s"),
			);
			
			$this->db->insert('ga_accounts', $account);
			$properties = array();
			$getProperties = file_get_contents ( $urlProperties);
			$propertiesData = json_decode ( $getProperties );
// 			print_r($propertiesData);
			foreach ($propertiesData->items as $val){
				$urlView = $val->childLink->href . '?access_token=' . $token;
				$propName = $val->name;
				$properties = array(
						'account_id' => $row->id,
						'property_id' => $val->id,
						'property_name' => $val->name,
						'view_url' => $val->childLink->href,
					'created' => date_format(new DateTime($val->created), "Y-m-d H:i:s"),
					'updated' => date_format(new DateTime($val->updated), "Y-m-d H:i:s"),
				);
				$this->db->insert('ga_properties', $properties);
				$views = array();
				//echo "id: ".$val->id." -- name: ".$val->name." -- profile: ".$val->childLink->href."<br>";
				$getViews = file_get_contents ( $urlView);
				$viewData = json_decode ( $getViews );
				foreach ($viewData->items as $v){
					$views = array(
							'property_id' => $val->id,
							'view_id' => $v->id,
							'view_name' => $v->name,
							'goal_url' => $v->childLink->href,
					'created' => date_format(new DateTime($v->created), "Y-m-d H:i:s"),
					'updated' => date_format(new DateTime($v->updated), "Y-m-d H:i:s"),
					);
					$this->db->insert('ga_views', $views);
// 					echo "id: ".$v->id." -- name: ".$v->name." -- profile: ".$v->childLink->href."<br>";
				}
			}
// 			echo "id: ".$row->id." -- name: ".$row->name." -- properties: ".$row->childLink->href."<br>";
			$totalAccount++;
		}
		echo "import data GA publisher successfully. Total Account : $totalAccount.";
		// $list_publisher = $this->report_model->get_publisher();
// 		foreach ( $getPublisher as $val ) {
			
// 			// $table .= '<tr>';
// 			// $table .= '<td>'.$val->name.'</td>';
// 			$datas = array (
					
// 					'publisher_name' => $val->name 
// 			)
// 			// 'group' => $val->group
// 			;
// 			$ids = 'ga%3A' . $val->ga_view;
			
// 			for($i = 1; $i <= $loop; $i ++) {
				
// 				$dayOfMonth = cal_days_in_month ( CAL_GREGORIAN, $i, $year );
				
// 				$month_pad = str_pad ( $i, 2, "0", STR_PAD_LEFT );
				
// 				$start = $year . '-' . $month_pad . '-01';
// 				$end = $year . '-' . $month_pad . '-' . $dayOfMonth;
// 				$url = 'https://www.googleapis.com/analytics/v3/data/ga?ids=' . $ids . '&start-date=' . $start . '&end-date=' . $end . '&metrics=ga%3Ausers%2Cga%3Asessions%2Cga%3Apageviews&access_token=' . $token;
// 				$json = file_get_contents ( $url );
// 				$jsonData = json_decode ( $json );
				
// 				$datas['pageviews'][$i] = $jsonData->{'totalsForAllResults'}->{'ga:pageviews'};
// 				// $table .= '<td>'.$data->{'totalsForAllResults'}->{'ga:pageviews'}.'</td>';
				
// 				// echo $year.'-'.$month_pad.' -> '.$data->{'totalsForAllResults'}->{'ga:pageviews'}.'</br>';
// 			}
			
// 			$list[$val->group][] = $datas;
// 		}
// 		$list['current_year'] = $year;
// 		$list['last_month'] = $loop;
		
// 		$data['list'] = $list;
	}
	public function get_barang() {
		// load model
		$this->load->model ( "barang_model" );
		$param = rawurldecode ( $this->uri->segment ( 3 ) );
		$is_report = $this->uri->segment ( 4 ) != 1 ? 0 : 1;
		$params = explode ( ",", $param );
		$provinsi = $params[0] == "" ? 0 : $params[0];
		$daops = $params[1] == "" ? 0 : $params[1];
		$kategori = $params[2] == "" ? 0 : $params[2];
		$barang = $params[3] == "" ? "" : $params[3];
		/*
		 * $level = rawurldecode($this->uri->segment(3));
		 * $status = $this->uri->segment(4);
		 * $institusi = $this->uri->segment(5);
		 */
		// echo $level == "" ? "kosong" : $level;
		// echo get_level_name($level);
		// echo get_level_name($level);
		/*
		 * Array of database columns which should be read and sent back to DataTables. Use a space where
		 * you want to insert a non-database field (for example a counter or static image)
		 */
		$aColumns = array (
				'id_barang',
				'id_daops',
				'provinsi',
				'id_kategori',
				'nama_barang',
				'satuan',
				'baik',
				'rusak',
				'rusak_sekali',
				'keterangan',
				'nama_daops',
				'nama_provinsi',
				'nama_kategori',
				'leaf',
				'parent',
				'created' 
		);
		
		// DB table to use
		$sTable = 'v_barang';
		// Default sort column
		$order = 'created desc';
		// where in query
		// $where = array();
		if ($this->session->userdata ( 'idlevel' ) == "2") {
			$where = array (
					'admin' => $this->session->userdata ( 'uid' ) 
			);
		} else {
			$where = array ();
		}
		if ($provinsi != 0) {
			$this->db->where ( "provinsi", $provinsi );
		}
		if ($daops != 0) {
			$this->db->where ( "id_daops", $daops );
		}
		if ($kategori != 0) {
			$this->db->where ( "id_kategori", $kategori );
			$this->db->or_where ( "parent", $kategori );
		}
		if ($barang != "") {
			$this->db->where ( "nama_barang", $barang );
		}
		
		$iDisplayStart = $this->input->get_post ( 'iDisplayStart', true );
		$iDisplayLength = $this->input->get_post ( 'iDisplayLength', true );
		$iSortCol_0 = $this->input->get_post ( 'iSortCol_0', true );
		$iSortingCols = $this->input->get_post ( 'iSortingCols', true );
		$sSearch = $this->input->get_post ( 'sSearch', true );
		$sEcho = $this->input->get_post ( 'sEcho', true );
		
		// Paging
		if (isset ( $iDisplayStart ) && $iDisplayLength != '-1') {
			$this->db->limit ( $this->db->escape_str ( $iDisplayLength ), $this->db->escape_str ( $iDisplayStart ) );
		}
		
		// Ordering
		if (isset ( $iSortCol_0 )) {
			for($i = 0; $i < intval ( $iSortingCols ); $i ++) {
				$iSortCol = $this->input->get_post ( 'iSortCol_' . $i, true );
				$bSortable = $this->input->get_post ( 'bSortable_' . intval ( $iSortCol ), true );
				$sSortDir = $this->input->get_post ( 'sSortDir_' . $i, true );
				
				if ($bSortable == 'true') {
					$this->db->order_by ( $aColumns[intval ( $this->db->escape_str ( $iSortCol ) )], $this->db->escape_str ( $sSortDir ) );
				}
			}
		}
		
		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		if (isset ( $sSearch ) && ! empty ( $sSearch )) {
			for($i = 0; $i < count ( $aColumns ); $i ++) {
				$bSearchable = $this->input->get_post ( 'bSearchable_' . $i, true );
				
				// Individual column filtering
				if (isset ( $bSearchable ) && $bSearchable == 'true') {
					// $this->db->where($where);
					$this->db->or_like ( $aColumns[$i], $this->db->escape_like_str ( $sSearch ) );
				}
			}
		}
		
		// Select Data
		// $this->db->set('@counter', "0");
		// $this->db->query("set @counter = 0");
		// (@counter:= @counter + 1) as counter,
		$this->db->select ( 'SQL_CALC_FOUND_ROWS ' . str_replace ( ' , ', ' ', implode ( ', ', $aColumns ) ), false )->from ( $sTable )->where ( $where )->order_by ( $order );
		
		$rResult = $this->db->get ();
		// echo $this->db->last_query();
		// Data set length after filtering
		$this->db->select ( 'FOUND_ROWS() AS found_rows' );
		$iFilteredTotal = $this->db->get ()->row ()->found_rows;
		// echo $this->db->last_query();
		
		// Total data set length
		$iTotal = $this->db->count_all ( $sTable );
		
		// Output
		$output = array (
				'sEcho' => intval ( $sEcho ),
				
				// 'iTotalRecords' => $iTotal,//if you want to display total record without filter
				'iTotalRecords' => $iFilteredTotal,
				'iTotalDisplayRecords' => $iFilteredTotal,
				'aaData' => array () 
		);
		$counter = $iDisplayStart + 1;
		foreach ( $rResult->result () as $aRow ) {
			$id_barang = $aRow->id_barang;
			$nama_kategori = $aRow->leaf == 0 ? $aRow->nama_kategori : get_nama_kategori ( $aRow->parent ) . " &raquo; " . $aRow->nama_kategori;
			$total = $aRow->baik + $aRow->rusak + $aRow->rusak_sekali;
			/*
			 * $action = '<a href="'.base_url('barang/edit/'.$aRow->id_barang).'" class="btn btn-mini btn-primary tip" title="Edit"><i class="icon-pencil"></i></a>
			 * <a href="javascript:void(0)" onclick="del(\''.base_url('barang/delete/'.$aRow->id_barang).'\',\''.$aRow->nama_barang.'\')"
			 * class="btn btn-mini btn-danger tip" title="Hapus"><i class="icon-trash"></i></a>';
			 */
			$action = '<a href="' . base_url ( 'barang/edit/' . $aRow->id_barang ) . '" title="Edit"><i class="icon-pencil"></i></a>
				<a href="javascript:void(0)" onclick="del(\'' . base_url ( 'barang/delete/' . $aRow->id_barang ) . '\',\'' . $aRow->nama_barang . '\')"
					title="Hapus"><i class="icon-trash"></i></a>';
			$action = $this->session->userdata ( 'idlevel' ) != "3" ? $action : "";
			// $row = array();
			// $row[] = $counter++;
			/*
			 * foreach($aColumns as $col)
			 * {
			 * if ($col) {
			 * ;
			 * }
			 * $row[] = $aRow[$col];
			 * }
			 */
			if ($is_report) {
				$output['aaData'][] = array (
						$counter ++,
						$aRow->nama_provinsi,
						$nama_kategori,
						$aRow->nama_kategori,
						$aRow->nama_barang,
						$aRow->baik,
						$aRow->rusak,
						$aRow->rusak_sekali,
						$total,
						$aRow->satuan,
						$aRow->keterangan 
				);
			} else {
				$output['aaData'][] = array (
						$counter ++,
						$aRow->nama_provinsi,
						$aRow->nama_daops,
						
						// $nama_kategori,
						$nama_kategori,
						$aRow->nama_barang,
						$aRow->baik,
						$aRow->rusak,
						$aRow->rusak_sekali,
						$total,
						$aRow->satuan,
						$aRow->keterangan,
						$action 
				);
			}
		}
		
		echo json_encode ( $output );
	}
	function daops() {
		$this->load->model ( 'daops_model' );
		
		$action = xss_clean ( $this->uri->segment ( 4 ) );
		$id = xss_clean ( $this->uri->segment ( 3 ) );
		
		// $query = $this->db->query("select * from jurnal");
		// $getData = $this->users_model->get_data();
		$where = array ();
		if ($action == "provinsi") {
			$where['provinsi'] = $id;
			if ($this->session->userdata ( 'idlevel' ) == "2") {
				$where['admin'] = $this->session->userdata ( 'uid' );
			}
		} elseif ($action == "daops") {
			$where['id_daops'] = $id;
		}
		
		$getData = $this->daops_model->get_data ( $where, "nama_daops" );
		$totalData = count ( $getData );
		$result = array ();
		if ($totalData > 0) {
			foreach ( $getData as $r ) {
				$datas = array (
						'id' => $r->id_daops,
						'text' => $r->nama_daops 
				);
				$result[] = $datas;
			}
		}
		
		header ( "Content-type: application/json" );
		echo json_encode ( $result );
	}
	function subkat() {
		$this->load->model ( 'kategori_model' );
		
		$action = xss_clean ( $this->uri->segment ( 4 ) );
		$id = xss_clean ( $this->uri->segment ( 3 ) );
		
		// $query = $this->db->query("select * from jurnal");
		// $getData = $this->users_model->get_data();
		$where = array ();
		if ($action == "kategori") {
			$where['parent'] = $id;
		} elseif ($action == "id") {
			$where['id_kategori'] = $id;
		}
		
		$getData = $this->kategori_model->get_data ( $where, "nama_kategori" );
		$totalData = count ( $getData );
		$result = array ();
		if ($totalData > 0) {
			foreach ( $getData as $r ) {
				$datas = array (
						'id' => $r->id_kategori,
						'text' => $r->nama_kategori 
				);
				$result[] = $datas;
			}
		}
		
		header ( "Content-type: application/json" );
		echo json_encode ( $result );
	}
	function select_barang() {
		// $this->load->model('barang_model');
		$action = xss_clean ( $this->uri->segment ( 4 ) );
		$id = xss_clean ( $this->uri->segment ( 3 ) );
		
		$query = $this->db->query ( "select id_barang, nama_barang from barang group by nama_barang" );
		// $getData = $this->users_model->get_data();
		
		$getData = $query->result ();
		$totalData = count ( $getData );
		$result = array ();
		if ($totalData > 0) {
			foreach ( $getData as $r ) {
				$datas = array (
						'id' => $r->nama_barang,
						'text' => $r->nama_barang 
				);
				$result[] = $datas;
			}
		}
		
		header ( "Content-type: application/json" );
		echo json_encode ( $result );
	}
}
?>