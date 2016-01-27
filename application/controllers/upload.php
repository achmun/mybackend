<?php

if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Upload extends CI_Controller
{

	private $site_view;

	private $site_setting;

	private $personal;
	/*
	 * var $mode
	 * Default value : view
	 */
	private $mode;

	public function __construct()
	{
		parent::__construct();
		$this->settings = $this->config->item('site_settings');
		// set custom message for form error
		$this->form_validation->set_message('required', '%s wajib diisi');
	}

	public function index()
	{
		redirect('');
	}
	/*
	 * Nama Halaman : Profile
	 * Author : Bayu Anggara Saputra
	 * Halaman ini menggunaikan :
	 */
	public function blueprint()
	{
		$datas = array(
			'title' 		=> 'Blueprint',
			'active'		=> 'daops',
			'upload_path'	=> $this->settings['media_blueprint'],
			'type'			=> 1,
			'id_daops'		=> $this->uri->segment(3),
		);
		$this->set_upload($datas);
	}
	public function bangunan()
	{
		$datas = array(
			'title' 		=> 'Bangunan',
			'active'		=> 'daops',
			'upload_path'	=> $this->settings['media_photo'],
			'type'			=> 2,
			'id_daops'		=> $this->uri->segment(3),
		);
		$this->set_upload($datas);
	}

	private function set_upload($datas)
	{
		$content['CONTENT_TITLE'] = $data['page_title'] = "Upload Foto ".$datas['title'];
		$content['menu_a_active'] = $datas['active'];
		$content['menu_li_active'] = $datas['active'];
		// load upload configuration
		$config['upload_path'] = "./" . $datas['upload_path'];
		$config['allowed_types'] = 'gif|jpg|png';
		// $config['max_width'] = '200';
		// $config['max_height'] = '150';
		$config['max_size'] = '2048';
		$config['overwrite'] = true;
		// set custom message of upload error message
		$this->lang->load('upload', 'indonesian');
		
		$daops = $datas['id_daops'];
		$type = $datas['type'];
		$data['id_daops'] = $daops;
		
		if ($this->input->post()) {
			// $this->form_validation->set_rules('jenis', 'Jenis Foto', 'trim|required');
			$this->form_validation->set_rules('judul', 'Judul Foto', 'trim|required');
			// $this->form_validation->set_rules('photo', 'Foto File', 'trim|required');
			
			if ($this->form_validation->run() == TRUE) {
				$judul = $this->input->post('judul', true);
				// $photo = $this->input->post('photo');
				$data = array(
					'img_name' => ucwords($judul),
					'daops' => $daops,
					'type' => $type
				);
				
				// untuk dapat last auto number, bisa menggunakan fungsi get_last_sequence() dari users_model
				$id = get_last_insertid('images');
				$config['file_name'] = $id . "_" . url_title($judul, '_', TRUE);
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if (isset($_FILES['photo']) && ! empty($_FILES['photo']['name'])) {
					if ($this->upload->do_upload('photo')) {
						// echo "uploaded";
						// set a $_POST value for 'image' that we can use later
						$upload_data = $this->upload->data();
						$data['img_file'] = $upload_data['file_name'];
						$this->db->insert('images', $data);
						redirect('daops/view/' . $daops);
					} else {
						// possibly do some clean up ... then throw an error
						// $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
						$data['message'] = $this->upload->display_errors();
					}
				} else {
					// echo "no upload";
					// $this->institusi_model->add();
					// redirect('panel/institusi');
					$data['message'] = "Image File tidak boleh kosong";
				}
			}
		}
		$content['CONTENT'] = $this->parser->parse($this->settings['path_view'] . '/upload_image', $data, true);
		$this->parser->parse($this->settings['default_layout'], $content);
	}

}

/* End of file my.php */
/* Location: ./application/controllers/my.php */
