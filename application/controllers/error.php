<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Error extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->settings = $this->config->item ( 'site_settings' );
		$this->path_view = 'themes/' . $this->settings ['template'];
	}
	function index() {
		$data = array ();
		$data['path_view'] = $this->path_view;
		$this->load->view ( 'error', $data );
	}
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */
?>
