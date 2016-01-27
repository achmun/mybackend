<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Article_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	// add/edit by nandar
	function get_data($where = NULL, $order = NULL, $limit = NULL)
	{
		$this->db->select('*');
		$this->db->from('cms_article');
		
		if ($where != null)
			$this->db->where($where);
		if ($order != null)
			$this->db->order_by($order);
		if ($limit != null)
			$this->db->limit($limit);
			
			// return $this->db->_compile_select();
		$query = $this->db->get();
		return $query->result();
		// return $query->last_query();
	}
	// add/edit by nandar
	function get_single_data($where)
	{
		$this->db->select('*');
		$this->db->from('cms_article');
		
		if ($where != null)
			$this->db->where($where);
		
		$query = $this->db->get();
		return $query->row_array();
		// return $query->last_query();
	}
}
/* End of file kategori_model.php */
/* Location: ./application/models/kategori_model.php */
?>
