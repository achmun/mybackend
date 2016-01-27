<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Article extends CI_Controller
{

	private $settings;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		$this->settings = $this->config->item('site_settings');
		// if not login, redirect to front page
		if ($this->session->userdata('uid') == ""){
			redirect('');
		}
	}

	public function index()
	{
		$data = array();
		$content['CONTENT_TITLE'] = $data['title'] = "Article";
		$content['menu_a_active'] = "article";
		$content['menu_li_active'] = "article";
		$data['panel_title'] = "Article List";
		$data['error'] = false;
		$data['message'] = "";
		$where = array();

		$this->load->model ( 'article_model' );

		$data['list'] = $this->article_model->get_data($where, 'created desc');
		$content['CONTENT'] = $this->parser->parse($this->settings['path_view'] . '/article/index', $data, true);
		$this->parser->parse($this->settings['default_layout'], $content);
		
		// echo $action;
	}

	public function add()
	{
		$data = array();
		$content['CONTENT_TITLE'] = $data['title'] = "Article";
		$content['menu_a_active'] = "article";
		$content['menu_li_active'] = "article";
		$data['panel_title'] = "Form Add Article";
		$isError = false;

		//prevent accessed from user is not admin
		if ($this->session->userdata('idlevel') == "3"){
			redirect('error');
		}

		//Set upload Config
		$config['upload_path'] = "./media/images";
		$config['allowed_types'] = 'gif|jpg|png';
		// $config['max_width'] = '200';
		// $config['max_height'] = '150';
		$config['max_size'] = '500';
		$config['overwrite'] = true;

		if ($this->input->post()) {
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			$this->form_validation->set_rules('source_img', 'Content Image', 'trim|required');
// print_r($_FILES['img_upload']);
			$source = $this->input->post('source_img');
			if ($source == 'url'){
				$this->form_validation->set_rules('img_url', 'URL of Image', 'trim|required');
			} elseif ($source == 'upload'){
				if ($_FILES['img_upload']['name'] == "") {
					$isError = true;
					$data['message'] = 'The Upload file is required';
				}
			}
// exit(var_dump($isError));
			if ($this->form_validation->run() == TRUE && !$isError) {
				// $element = $this->input->post('element', TRUE);
				$title = $this->input->post('title', TRUE);
				$subtitle = $this->input->post('subtitle', TRUE);
				$content = $this->input->post('content');
				$img_url = $this->input->post('img_url');

				$datas = array(
					// 'element_id' => $element,
					'author_id' => $this->session->userdata('uid'),
					'title' => $title,
					'subtitle' => $subtitle,
					'content' => $content,
					'created' => date("Y-m-d H:i:s"),
				);

				// exit("<pre>".print_r($datas)."</pre>");
				// load upload library & configuration
				if ($source == 'url'){
					$datas['image'] = $img_url;
				} elseif ($source == 'upload') {
					$config['file_name'] = url_title($title, '_', TRUE) . "_" . time();
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (isset($_FILES['img_upload']) && ! empty($_FILES['img_upload']['name'])) {
						if ($this->upload->do_upload('img_upload')) {
							// echo "uploaded";
							// set a $_POST value for 'image' that we can use later
							$upload_data = $this->upload->data();
							$datas['image'] = base_url('media/images/'). DIRECTORY_SEPARATOR .$upload_data['file_name'];
						} else {
							// possibly do some clean up ... then throw an error
							// $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
							$isError = true;
							$data['message'] = $this->upload->display_errors();
						}
					}
				}
				
				if (!$isError){
					$this->db->insert('cms_article', $datas);
					redirect(base_url('article'));
				}
			}
		}
		$array = array(''=>'');
		
		$content['CONTENT'] = $this->parser->parse($this->settings['path_view'] . '/article/form', $data, true);
		$this->parser->parse($this->settings['default_layout'], $content);
		
		// echo $action;
	}

	function edit()
	{
		//prevent accessed from user is not admin
// 		if ($this->session->userdata('idlevel') == "3"){
// 			redirect('error');
// 		}
		$data = array();
		$content['CONTENT_TITLE'] = $data['page_title'] = "Publisher";
		$content['menu_a_active'] = "publisher";
		$content['menu_li_active'] = "publisher";
		$data['panel_title'] = "Form Edit Publisher";
		$data['error'] = false;
		$data['message'] = "";
		$isError = false;

		//prevent accessed from user is not admin
		if ($this->session->userdata('idlevel') == "3"){
			redirect('error');
		}

		$id = $this->uri->segment(3);
		$data['action'] = 'edit';
		//Set upload Config
		$config['upload_path'] = "./media/images";
		$config['allowed_types'] = 'gif|jpg|png';
		// $config['max_width'] = '200';
		// $config['max_height'] = '150';
		$config['max_size'] = '500';
		$config['overwrite'] = true;

		if ($this->input->post()) {
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('content', 'Content', 'trim|required');
			$this->form_validation->set_rules('source_img', 'Content Image', 'trim|required');
// print_r($_FILES['img_upload']);
			$source = $this->input->post('source_img');
			if ($source == 'url'){
				$this->form_validation->set_rules('img_url', 'URL of Image', 'trim|required');
			} elseif ($source == 'upload'){
				if ($_FILES['img_upload']['name'] == "") {
					$isError = true;
					$data['message'] = 'The Upload file is required';
				}
			}
// exit(var_dump($isError));
			if ($this->form_validation->run() == TRUE && !$isError) {
				// $element = $this->input->post('element', TRUE);
				$title = $this->input->post('title', TRUE);
				$subtitle = $this->input->post('subtitle', TRUE);
				$content = $this->input->post('content');
				$img_url = $this->input->post('img_url');

				$datas = array(
					// 'element_id' => $element,
					'author_id' => $this->session->userdata('uid'),
					'title' => $title,
					'subtitle' => $subtitle,
					'content' => $content,
					'created' => date("Y-m-d H:i:s"),
				);

				// exit("<pre>".print_r($datas)."</pre>");
				// load upload library & configuration
				if ($source == 'url'){
					$datas['image'] = $img_url;
				} elseif ($source == 'upload') {
					$config['file_name'] = url_title($title, '_', TRUE) . "_" . time();
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (isset($_FILES['img_upload']) && ! empty($_FILES['img_upload']['name'])) {
						if ($this->upload->do_upload('img_upload')) {
							// echo "uploaded";
							// set a $_POST value for 'image' that we can use later
							$upload_data = $this->upload->data();
							$datas['image'] = base_url('media/images/'). DIRECTORY_SEPARATOR .$upload_data['file_name'];
						} else {
							// possibly do some clean up ... then throw an error
							// $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
							$isError = true;
							$data['message'] = $this->upload->display_errors();
						}
					}
				}
				
				if (!$isError){
					$this->db->update('cms_article', $datas, 'id = ');
					redirect(base_url('article'));
				}
			}
		}
		$this->load->model ( 'article_model' );
		if ($id != 0) {
			$this->load->model ( 'article_model' );
			$data['datas'] = $datas = $this->article_model->get_single_data(array(
				'id' => $id
			));

			$content['CONTENT'] = $this->parser->parse($this->settings['path_view'] . '/article/form', $data, true);
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
		//prevent accessed from user is not admin
		if ($this->session->userdata('idlevel') == "3"){
			redirect('error');
		}
		if ($id != 0) {
			
			$this->db->delete('publisher', array(
				'id' => $id
			));
			redirect('publisher');
		} else {
			redirect('publisher');
		}
	}
	public function view()
	{
		$data = array();
		$content['CONTENT_TITLE'] = $data['page_title'] = "Publisher";
		$content['menu_a_active'] = "daops";
		$content['menu_li_active'] = "daops";
		
		$data['settings'] = $this->settings;
		$id = (int) $this->uri->segment(3);
	
		if ($id != 0) {
			$data['datas'] = $this->publisher_model->get_single_data(array(
				'id_pub' => $id
			));
			
			$content['CONTENT'] = $this->parser->parse($this->settings['path_view'] . '/publisher/detail', $data, true);
			$this->parser->parse($this->settings['default_layout'], $content);
		} else {
			redirect('daops');
		}
		// echo $action;
	}
	function delete_images()
	{
		$data = array();
		$data['error'] = false;
		$data['message'] = "";
		$id = (int) $this->uri->segment(3);
	
		if ($id != 0) {
			/*$constraint = false;
				// cek dulu apakah ada data yg constraint, jika ada, maka tidak bisa dihapus
				$qry = $this->db->query("select ID_Daops from Daops where ID_PARENT = '$id'");
				if ($qry->num_rows() > 0)
					$constraint = true;
					$qry2 = $this->db->query("select ID_PAPER from paper where ID_Daops = $id and PUBLISHED = 'Y'");
					if ($qry2->num_rows() > 0)
						$constraint = true;
							
						if ($constraint) {
						return false;
						} else {
						$this->db->delete('Daops', array(
						'ID_Daops' => $id
						));
						return true;
						}
						if ($this->Daops_model->delete($id)) {
						redirect('Daops');
						} else {
						redirect('Daops/error');
						}*/
					$this->db->delete('images', array(
						'id' => $id
					));
					redirect($this->input->server('HTTP_REFERER'));
		} else {
			redirect($this->input->server('HTTP_REFERER'));
		}
	}
}

/* End of file Daops.php */
/* Location: ./application/controllers/daops.php */
?>
