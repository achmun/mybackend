<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller
{

	private $settings;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->settings = $this->config->item('site_settings');
		// set custom message for form error
		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_message('valid_email', '%s bukan alamat email yang valid');
		$this->form_validation->set_message('matches', '%s tidak cocok');
		$this->form_validation->set_message('min_length', '%s harus terdiri dari minimal %s karakter');
		$this->form_validation->set_message('numeric', '%s harus diisi dengan angka');
		// if not login, redirect to front page
		if ($this->session->userdata('uid') == ""){
			redirect('');
		}
		//prevent accessed from user except superadmin
		if ($this->session->userdata('idlevel') != "1"){
			redirect('error');
		}
	}

	function index()
	{
		$data = array();
		$content['CONTENT_TITLE'] = $data['page_title'] = "User Admin";
		$content['menu_a_active'] = "user";
		$content['menu_li_active'] = "user";
		$data['panel_title'] = "Daftar User Admin";
		$data['error'] = false;
		$data['message'] = "";
		$data['User'] = "";
		
		if ($action == "error") {
			$data['message'] = "Data tidak bisa dihapus karena masih ada data terkait di Sub User atau Paper. Silahkan hapus terlebih dahulu data Sub User atau Paper yang terkait.";
		}
		$data['list'] = $this->user_model->get_data(array(), 'created desc');
		$content['CONTENT'] = $this->parser->parse($this->settings['path_view'] . '/user', $data, true);
		$this->parser->parse($this->settings['default_layout'], $content);
		
		// echo $action;
	}

	public function add()
	{
		$data = array();
		$content['CONTENT_TITLE'] = $data['page_title'] = "User Admin";
		$content['menu_a_active'] = "user";
		$content['menu_li_active'] = "user";
		$data['panel_title'] = "Form Tambah User Admin";
		$data['error'] = false;
		$data['message'] = "";
		$action = $this->uri->segment(2);
		$data['action'] = $action;
		
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|matches[password2]');
			$this->form_validation->set_rules('level', 'Level', 'trim|required');
			// $this->form_validation->set_message('required', '%s wajib diisi');
			
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name', true);
				$username = $this->input->post('username', true);
				$password = $this->input->post('password', true);
				$level = $this->input->post('level', true);
				$datas = array(
					'name' => $name,
					'username' => $username,
					'password' => encrypt_password($password),
					'level' => $level,
					'created' => date("Y-m-d H:i:s")
				);
				
				$this->db->insert('user', $datas);
				redirect('user');
			}
		}
		$content['CONTENT'] = $this->parser->parse($this->settings['path_view'] . '/user_form', $data, true);
		$this->parser->parse($this->settings['default_layout'], $content);
		
		// echo $action;
	}

	function edit()
	{
		$data = array();
		$content['CONTENT_TITLE'] = $data['page_title'] = "User Admin";
		$content['menu_a_active'] = "user";
		$content['menu_li_active'] = "user";
		$data['panel_title'] = "Form Edit User Admin";
		$data['error'] = false;
		$data['message'] = "";
		
		$id = (int) $this->uri->segment(3);
		$action = $this->uri->segment(2);
		$data['action'] = $action;
		
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('level', 'Level', 'trim|required');
			// $this->form_validation->set_message('required', '%s wajib diisi');
			
			if ($this->form_validation->run() == TRUE) {
				$name = $this->input->post('name', true);
				$username = $this->input->post('username', true);
				$password = $this->input->post('password', true);
				$level = $this->input->post('level', true);
				$datas = array(
					'name' => $name,
					'username' => $username,
					'level' => $level,
				);
				if ($password != ""){
					$datas['password'] = encrypt_password($password);
				}
				$this->db->update('user', $datas, "uid = $id");
				redirect('user');
			}
		}
		if ($id != 0) {
			$data['datas'] = $datas = $this->user_model->get_single_data(array(
				'uid' => $id
			));
			print_r($datas);
			$content['CONTENT'] = $this->parser->parse($this->settings['path_view'] . '/user_form', $data, true);
			$this->parser->parse($this->settings['default_layout'], $content);
		} else {
			redirect('');
		}
	}

	function delete()
	{
		$data = array();
		$data['error'] = false;
		$data['message'] = "";
		$id = (int) $this->uri->segment(3);
		
		if ($id != 0) {
			/*$constraint = false;
			// cek dulu apakah ada data yg constraint, jika ada, maka tidak bisa dihapus
			$qry = $this->db->query("select ID_User from User where ID_PARENT = '$id'");
			if ($qry->num_rows() > 0)
				$constraint = true;
			$qry2 = $this->db->query("select ID_PAPER from paper where ID_User = $id and PUBLISHED = 'Y'");
			if ($qry2->num_rows() > 0)
				$constraint = true;
			
			if ($constraint) {
				return false;
			} else {
				$this->db->delete('User', array(
					'ID_User' => $id
				));
				return true;
			}
			if ($this->User_model->delete($id)) {
				redirect('User');
			} else {
				redirect('User/error');
			}*/
			$this->db->delete('user', array(
				'uid' => $id
			));
			redirect('user');
		} else {
			redirect('user');
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/user.php */
?>
