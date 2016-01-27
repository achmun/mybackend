<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lookup extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'security'));
		$this->load->library(array('form_validation','session'));
		$this->load->database();
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect('error');
		}
	}

	function index() 
	{
			
	}

	function user($action = NULL, $id = NULL) 
	{
		
		$this->load->model('users_model');
		$this->load->model('institusi_model');

		$action = xss_clean($action);
		$id = xss_clean(intval($id));

		
		$page = isset($_POST['page']) ? $_POST['page'] : 1;
		$rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
		$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : '';
		$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : '';
		$query = isset($_POST['query']) ? $_POST['query'] : false;
		$qtype = isset($_POST['qtype']) ? $_POST['qtype'] : false;
		
		if($sortname!= "")
			$sort = "ORDER BY $sortname $sortorder";
		
		$start = (($page-1) * $rp);
		$limit = "LIMIT $start, $rp";
		
		$query = $this->db->query("select * from users $sort $limit");
		//$getData = $this->users_model->get_data();
		$getData = $query->result();
		$totalData = $query->num_rows();
		$result = array('page'=>$page,'total'=>$totalData,'rows'=>array());
		if($totalData>0) {
			$i = 1;
			foreach($getData as $r) {
				$kode = $r->ID_USER;
				$dataCell = array('id'=>$kode,
						'cell'=>array(
								'seq' => $i + $start,
								'id_user' => $kode,
								'nik' => get_nik($kode),
								'name_first' => $r->NAME_FIRST,
								'name_mid' => $r->NAME_MID,
								'name_last' => $r->NAME_LAST,
								'name' => set_display_nama($r->NAME_FIRST, $r->NAME_MID, $r->NAME_LAST),
								'email_user' => $r->EMAIL_USER,
								'id_institusi' => $r->ID_INSTITUSI,
								'institusi' => NamaInstitusi($r->ID_INSTITUSI),
								'pekerjaan' => $r->PEKERJAAN,//."-".$r->projectChief."-".$r->pic
								'bidang_keahlian' => $r->BIDANG_KEAHLIAN,
								'nohp_user' => $r->NOHP_USER,
								'web_user' => $r->WEB_USER,
								'blokir' => $r->BLOKIR,
								'date_created' => $r->DATE_CREATED,
						)
				);
				$result['rows'][] = $dataCell;
				$i++;
			}
		}
		header("Content-type: application/json");
		echo json_encode($result);
		//$data['list'] = $this->users_model->get_data();
		//$content['CONTENT'] = $this->parser->parse('admin/institusi_admin_form',$data,true);
		//$this->parser->parse('admin',$content);
	}
	
	function keyword()
	{
		//$this->load->model('trending_model');
		//$this->load->model('institusi_model');
	
		$action = xss_clean($action);
		$id = xss_clean(intval($id));
	
		$query = $this->db->query("select * from keyword");
		//$getData = $this->users_model->get_data();
		$getData = $query->result();
		$totalData = $query->num_rows();
		$result = array();
		if($totalData > 0) {
			foreach($getData as $r) {
				$result[] = ucwords(trim($r->KEYWORD));
			}
		}
		
		header("Content-type: application/json");
		echo json_encode($result);
		
	}

	function pic($action = NULL, $id = NULL)
	{
	
		$this->load->model('users_model');
		$this->load->model('institusi_model');
	
		$action = xss_clean($action);
		$id = xss_clean(intval($id));
	
		$page = isset($_POST['page']) ? $_POST['page'] : 1;
		$rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
		$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : '';
		$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : '';
		$query = isset($_POST['query']) ? $_POST['query'] : false;
		$qtype = isset($_POST['qtype']) ? $_POST['qtype'] : false;
	
		if($sortname!= "")
			$sort = "ORDER BY $sortname $sortorder";
	
		$start = (($page-1) * $rp);
		$limit = "LIMIT $start, $rp";
	
		$query = $this->db->query("select NAME_FIRST,NAME_MID,NAME_LAST from users where STATUS != 'D'");
		//$getData = $this->users_model->get_data();
		$getData = $query->result();
		$totalData = $query->num_rows();
		$result = array();
		if($totalData > 0) {
			foreach($getData as $r) {
				$name = $r->NAME_FIRST;
				$name .= $r->NAME_MID == "" ? "" : " ".$r->NAME_MID; 
				$name .= $r->NAME_LAST == "" ? "" : " ".$r->NAME_LAST; 
				$result[] = $name;
			}
		}
	
		header("Content-type: application/json");
		echo json_encode($result);
		//$data['list'] = $this->users_model->get_data();
		//$content['CONTENT'] = $this->parser->parse('admin/institusi_admin_form',$data,true);
		//$this->parser->parse('admin',$content);
	}

	function author()
	{
		$this->load->model('author_model');
	
		$action = xss_clean($this->uri->segment(4));
		$id = xss_clean($this->uri->segment(3));
		
		
		$query = $this->db->query("select * from author where NAME like '%".$_GET['q']."%' group by FIRST_TITLE,NAME,LAST_TITLE");
		//$getData = $this->users_model->get_data();
		$getData = $query->result();
		$totalData = $query->num_rows();
		$result = array();
		if($totalData > 0) {
			foreach($getData as $p) {
				$name = $p->FIRST_TITLE == "" ? "" : $p->FIRST_TITLE." ";
				$name .= $p->NAME;
				$name .= $p->LAST_TITLE == "" ? "" : ", ".$p->LAST_TITLE;
				$result[] = array(
						'id' => $p->ID_AUTHOR,
						'text' => $name,
				);
			}
		}
	
		header("Content-type: application/json");
		echo json_encode($result);
		//$data['list'] = $this->users_model->get_data();
		//$content['CONTENT'] = $this->parser->parse('admin/institusi_admin_form',$data,true);
		//$this->parser->parse('admin',$content);
	}
	

	function institusi()
	{
		$this->load->model('institusi_model');
	
		$action = xss_clean($this->uri->segment(4));
		$id = xss_clean($this->uri->segment(3));
	
		//$query = $this->db->query("select * from jurnal");
		//$getData = $this->users_model->get_data();
		$where = array('PUBLISHED'=>'Y');
		if ($action == "institusi") {
			$where['ID_INSTITUSI'] = $id;
		}
	
		$getData = $this->institusi_model->get_data($where, "NAMA_JURNAL");
		$totalData = count($getData);
		$result = array();
		if($totalData > 0) {
			foreach($getData as $r) {
				$datas = array(
						'id' => $r->ID_INSTITUSI,
						'text' => $r->NAMA_INSTITUSI,
				);
				$result[] = $datas;
			}
		}
	
		header("Content-type: application/json");
		echo json_encode($result);
		//$data['list'] = $this->users_model->get_data();
		//$content['CONTENT'] = $this->parser->parse('admin/institusi_admin_form',$data,true);
		//$this->parser->parse('admin',$content);
	}
	
	function jurnal()
	{
		$this->load->model('jurnal_model');
	
		$action = xss_clean($this->uri->segment(4));
		$id = xss_clean($this->uri->segment(3));
		
		//$query = $this->db->query("select * from jurnal");
		//$getData = $this->users_model->get_data();
		$where = array('PUBLISHED'=>'Y');
		if ($action == "institusi") {
			$where['ID_INSTITUSI'] = $id;
		} elseif ($action == "jurnal"){
			$where['ID_JURNAL'] = $id;
		} elseif ($action == "qjsn"){
			$where['QJSN'] = $id;
		}
		
		$getData = $this->jurnal_model->get_data($where, "NAMA_JURNAL");
		$totalData = count($getData);
		$result = array();
		if($totalData > 0) {
			foreach($getData as $r) {
				$datas = array(
						'id' => $r->QJSN,
						'text' => $r->NAMA_JURNAL,
				);
				$result[] = $datas;
			}
		}
	
		header("Content-type: application/json");
		echo json_encode($result);
		//$data['list'] = $this->users_model->get_data();
		//$content['CONTENT'] = $this->parser->parse('admin/institusi_admin_form',$data,true);
		//$this->parser->parse('admin',$content);
	}
	
	function issue()
	{
	
		$this->load->model('jurnal_model');
		$this->load->model('issue_model');
	
		$action = xss_clean($this->uri->segment(4));
		$id = xss_clean($this->uri->segment(3));
	
		//$query = $this->db->query("select * from jurnal");
		//$getData = $this->users_model->get_data();
		$where = array('PUBLISHED'=>'Y');
		if ($action == "institusi") {
			$where['ID_INSTITUSI'] = $id;
		} elseif ($action == "jurnal"){
			$where['ID_JURNAL'] = $id;
		} elseif ($action == "qjsn"){
			$where['QJSN'] = $id;
		}
		if (isset($_GET['id'])){
			$getData = $this->issue_model->get_single_data(array('ID_ISSUE'=>$_GET['id']));
			$result = array('id'=> $getData['ID_ISSUE'], 'text' => set_display_issue($getData['VOLUME'],$getData['NOMOR'],$getData['TAHUN'],$getData['JUDUL_ISSUE']));
		} else {
			$getData = $this->issue_model->get_data($where, 'VOLUME, NOMOR, TAHUN');
			$totalData = count($getData);
			$result = array();
			if($totalData > 0) {
				foreach($getData as $r) {
					/*$volume = preg_match('/vol/i', $r->VOLUME) ? $r->VOLUME : "Volume ".$r->VOLUME;
					 $nomor = $r->NOMOR == "" ? "" : ", ".$r->NOMOR;
					$judul = trim($r->JUDUL_ISSUE) == "" ? "" : " -- ".$r->JUDUL_ISSUE;*/
					$datas = array(
							'id' => $r->ID_ISSUE,
							'text' => set_display_issue($r->VOLUME,$r->NOMOR,$r->TAHUN,$r->JUDUL_ISSUE),
					);
					$result[] = $datas;
				}
			}
		}
	
		header("Content-type: application/json");
		echo json_encode($result);
		//$data['list'] = $this->users_model->get_data();
		//$content['CONTENT'] = $this->parser->parse('admin/institusi_admin_form',$data,true);
		//$this->parser->parse('admin',$content);
	}

	function paper()
	{
	
		$this->load->model('paper_model');
		$this->load->model('issue_model');
	
		$action = xss_clean($this->uri->segment(4));
		$id = xss_clean($this->uri->segment(3));
	
		//$query = $this->db->query("select * from jurnal");
		//$getData = $this->users_model->get_data();
		$where = array('PUBLISHED'=>'Y');
		if ($action == "institusi") {
			$where['ID_INSTITUSI'] = $id;
		} elseif ($action == "jurnal"){
			$where['ID_JURNAL'] = $id;
		} elseif ($action == "qjsn"){
			$where['QJSN'] = $id;
		}
	
		$getData = $this->issue_model->get_data($where, 'VOLUME, NOMOR, TAHUN');
		$totalData = count($getData);
		$result = array();
		if($totalData > 0) {
			foreach($getData as $r) {
				$volume = preg_match('/vol/i', $r->VOLUME) ? $r->VOLUME : "Volume ".$r->VOLUME;
				$nomor = $r->NOMOR == "" ? "" : ", ".$r->NOMOR;
				$judul = trim($r->JUDUL_ISSUE) == "" ? "" : " -- ".$r->JUDUL_ISSUE;
				$datas = array(
						'id' => $r->ID_ISSUE,
						'text' => $volume.$nomor." ".$r->TAHUN.$judul,
				);
				$result[] = $datas;
			}
		}
	
		header("Content-type: application/json");
		echo json_encode($result);
		//$data['list'] = $this->users_model->get_data();
		//$content['CONTENT'] = $this->parser->parse('admin/institusi_admin_form',$data,true);
		//$this->parser->parse('admin',$content);
	}
}

/* End of file lookup.php */
/* Location: ./application/controllers/lookup.php */
?>