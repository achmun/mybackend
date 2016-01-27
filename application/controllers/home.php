<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Home extends CI_Controller {
	protected $settings = array();
	protected $path_view = "";	
	/*
	 * Constructor
	 */
	public function __construct() {
		parent::__construct ();
		$this->settings = $this->config->item ( 'site_settings' );
		$this->path_view = $this->settings['path_view'];
	}
	/*
	 * Halaman Home
	 *
	 * @access	public
	 * @return 	mixed
	 */
	public function index() {
		$data = array ();
		$content['CONTENT_TITLE'] = "Welcome Home";
		$content['menu_a_active'] = "dashboard";
		$content['menu_li_active'] = "home";
		
		//echo $this->session->userdata('access_token');
		
		if ($this->session->userdata ( 'uid' ) != "") {
			$content['CONTENT'] = $this->parser->parse ( $this->path_view . '/home', $data, true );
			$this->parser->parse ( $this->settings['default_layout'], $content );
		} else {
			$content['CONTENT'] = $this->parser->parse ( $this->path_view . '/login', $data, true );
			$this->parser->parse ( $this->settings['default_layout'], $content );
		}
		
	}
	/*
	 * Load Tab New Paper
	 *
	 * @access	private Called by the index
	 * @return 	mixed
	 */
	private function loadTabPaper() {
		$data['top_paper'] = $this->paper_model->get_top ();
		return $this->parser->parse ( $this->path_view . 'home_newpapers', $data, TRUE );
	}
	/*
	 * Load Tab Institusi
	 *
	 * @access	private Called by the index
	 * @return 	mixed
	 */
	private function loadTabInstitution() {
		$data['site_setting'] = $this->settings;
		$data['top_instutions'] = $this->institusi_model->get_top ();
		return $this->parser->parse ( $this->path_view . 'home_institutions', $data, TRUE );
	}
	/*
	 * Load Tab Categori
	 *
	 * @access	private Called by the index
	 * @return 	mixed
	 */
	private function loadTabCategorie() {
		$this->load->model ( 'menukategori' );
		$this->menukategori->init ();
		$root = $this->menukategori->get_root ();
		$data['kategori'] = $this->get_catagorie_child ( $root['ID_KATEGORI'] );
		return $this->parser->parse ( $this->path_view . 'home_categories', $data, TRUE );
	}
	/*
	 * Get Categorie Child
	 *
	 * untuk mendapatkan child data kategori
	 *
	 * @access	private Called by the loadTabCategorie
	 * @param integer nilai ID_KATEGORI
	 * @return 	array
	 */
	private function get_catagorie_child($catid, $result = array()) {
		$child = $this->menukategori->get_child ( $catid );
		if (is_array ( $child ) && count ( $child ) > 0) {
			$result[$catid] = $child;
			foreach ( $child as $row ) {
				$result = $this->get_catagorie_child ( $row['ID_KATEGORI'], $result );
			}
		}
		return $result;
	}
	/*
	 * Load Tab Trending
	 *
	 * @access	private Called by the index
	 * @return 	mixed
	 */
	private function loadTabTrending() {
		$data['top_trendings'] = $this->trending_model->get_top ( 100 );
		return $this->parser->parse ( $this->path_view . 'home_trendings', $data, TRUE );
	}
	public function template() {
		$id = $this->uri->segment ( 3 );
		$this->load->view ( 'design2/front/template' . $id );
	}
	public function change($param = NULL, $param2 = NULL) {
		$data = array ();
		$data['title'] = $data['pagetitle'] = 'Change Password';
		$data['pesan'] = '';
		$data['status'] = '';
		
		$this->load->model ( 'users_model' );
		$this->load->helper ( 'security' );
		
		$kode = xss_clean ( $param2 );
		// echo $this->session->userdata('logged_in');
		if ($kode != "") {
			// cek to table users
			$query = $this->db->query ( "SELECT * FROM users WHERE KODE_AKTIVASI='$kode'" );
			$row = $query->row ();
			if ($query->num_rows () < 1 || $row->STATUS != 'C') {
				$data['status'] = 'failed';
				$data['pesan'] = 'Link reset password Anda tidak valid. Silahkan cek email Anda kembali, atau lakukan <a href="' . base_url () . 'home/forgot">forgot password </a> kembali.';
			}
		}
		if ($this->input->post ()) {
			if ($this->session->userdata ( 'logged_in' ) == TRUE) {
				$this->form_validation->set_rules ( 'old_password', 'Old Password', 'trim|xss_clean|required|min_length[6]' );
			}
			$this->form_validation->set_rules ( 'password', 'New Password', 'trim|xss_clean|required|min_length[6]' );
			$this->form_validation->set_rules ( 'password2', 'Confirm New Password', 'trim|xss_clean|required|matches[password]' );
			
			$this->form_validation->set_message ( 'required', '%s wajib diisi' );
			$this->form_validation->set_message ( 'matches', '%s tidak cocok dengan %s' );
			$this->form_validation->set_message ( 'min_length', '%s harus terdiri minimal %s karakter' );
			
			if ($this->form_validation->run () == TRUE) {
				$password = $this->input->post ( 'password' );
				$arrdata = array (
						'STATUS' => 'N',
						'PASSWORD' => encrypt_password ( $password ),
						'KODE_AKTIVASI' => '',
						'UPDATED_DATE' => date ( "Y-m-d H:i:s" ),
						
						// 'UPDATED_USER'=> $row->ID_USER,
						'UPDATED_IP' => $this->input->server ( 'REMOTE_ADDR' ) 
				);
				if ($this->session->userdata ( 'logged_in' ) == TRUE) {
					$email = $this->input->post ( 'email', true );
					$old_password = $this->input->post ( 'old_password' );
					$get_users = $this->users_model->get_single_data ( array (
							'EMAIL_USER' => $email 
					) );
					if (encrypt_password ( $old_password ) == $get_users['PASSWORD']) {
						// success;
						$data['PASSWORD'] = encrypt_password ( $password );
						$this->db->update ( 'users', $arrdata, "EMAIL_USER = '$email'" );
						$pesan = 'Password Anda berhasil diganti. Silahkan gunakan password baru Anda untuk login selanjutnya.';
						$data['pesan'] = $pesan;
						$data['status'] = 'success';
					} else {
						$data['status'] = "error";
						$data['message'] = 'Password Lama tidak benar';
					}
				} else {
					$data['UPDATED_USER'] = $row->ID_USER;
					$this->db->update ( 'users', $arrdata, "KODE_AKTIVASI = '$kode'" );
					$pesan = 'Password Anda berhasil diganti. Silahkan <a href="' . base_url ( 'login' ) . '">login</a> menggunakan password baru Anda.';
					$data['pesan'] = $pesan;
					$data['status'] = 'success';
				}
			} else {
				$data['status'] = 'error';
			}
		} else {
			
			/*
			 * if ($query->num_rows() > 0 && $query->row()->STATUS == 'C') {
			 * // $data['status'] = 'failed';
			 * } else {
			 *
			 * }
			 */
		}
		
		// echo $data['status'];
		$content['CONTENT'] = $this->parser->parse ( $this->path_view . 'change', $data, true );
		$this->parser->parse ( $this->settings['default_layout'], $content );
	}
	public function forgot() {
		$data = array ();
		$data['title'] = $data['pagetitle'] = 'Forgot Password';
		$data['pesan'] = '';
		$data['status'] = '';
		
		$this->load->model ( 'users_model' );
		
		if ($this->input->post ()) {
			$this->form_validation->set_rules ( 'email', 'Email', 'trim|xss_clean|required|valid_email|callback_cek_email' );
			
			$this->form_validation->set_message ( 'required', '%s wajib diisi' );
			$this->form_validation->set_message ( 'valid_email', '%s email tidak valid' );
			
			if ($this->form_validation->run () == TRUE) {
				$this->load->helper ( 'phpmailer' );
				$subjek = 'Forgot Password Q-Journal';
				$email_from = 'journal@telkom.cc';
				$nama_from = 'Q-Journal';
				
				$email = $this->input->post ( 'email' );
				$get_user = $this->users_model->get_single_data ( array (
						'EMAIL_USER' => $email 
				) );
				$nama = $get_user['NAME_FIRST'] . ' ' . $get_user['NAME_MID'] . ' ' . $get_user['NAME_LAST'];
				
				if ($get_user['EMAIL_USER'] != "") {
					if ($get_user['STATUS'] == "Y") {
						$data['pesan'] = 'Account Anda sedang di blokir. Silahkan hubungi Administrator untuk memulihkan kembali.';
						$data['status'] = 'error';
						/*
						 * } else if ($get_user['STATUS'] == "A") {
						 * $data['pesan'] = 'Account Anda sudah terdaftar dan butuh aktivasi email. Silahkan hubungi Administrator untuk memulihkan kembali.';
						 * $data['status'] = 'error';
						 */
					} else {
						$email_to = $email;
						$nama_to = $nama;
						$pesan = '<table><tr><td align="justify">Hi ' . $nama . ',<br>
								<br>
								You have requested to reset your forgotten password for your Q-Journal account. To reset your new password, please click the link below :<br>
								<br>
								<a href="' . base_url ( 'home/change/password/' . sha1 ( $email ) ) . '">' . base_url ( 'home/change/password/' . sha1 ( $email ) ) . '</a><br>
								<br>
								This is an automated message, please do not reply this message.<br>
								If you have any questions, please send email to Help Desk Central at helpdesk@qjournal.co.id<br>
								<br><br>
								Thank You,<br>
								Q-Journal Team</td></tr></table>';
						
						$sending = send_email_smtp ( $email_from, $nama_from, $email_to, $nama_to, $subjek, $pesan );
						if ($sending) {
							$this->db->update ( 'users', array (
									'KODE_AKTIVASI' => sha1 ( $email ),
									'STATUS' => 'C',
									'UPDATED_DATE' => date ( "Y-m-d H:i:s" ),
									'UPDATED_USER' => $get_user['ID_USER'],
									'UPDATED_IP' => $this->input->server ( 'REMOTE_ADDR' ) 
							), "EMAIL_USER = '$email'" );
							
							$data['pesan'] = 'Url link untuk merubah password sudah dikirimkan. Silahkan cek email Anda.';
							$data['status'] = 'success';
						} else {
							$data['pesan'] = 'Proses pengiriman email gagal';
							$data['status'] = 'error';
						}
					}
				} else {
					$data['pesan'] = 'Email belum terdaftar';
					$data['status'] = 'error';
				}
			} else {
				$data['status'] = 'error';
			}
		}
		$content['CONTENT'] = $this->parser->parse ( $this->path_view . 'forgot', $data, true );
		$this->parser->parse ( $this->settings['default_layout'], $content );
	}
	public function cek_email($str) {
		$query = $this->db->query ( "SELECT EMAIL_USER FROM users WHERE EMAIL_USER='$str'" );
		if ($query->num_rows () > 0) {
			return TRUE;
		} else {
			$this->form_validation->set_message ( 'cek_email', '%s belum terdaftar' );
			return FALSE;
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
?>
