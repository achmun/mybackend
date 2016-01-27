<?php

/**
 * Description of User_model
 *
 * @author Nandar@MetraNet
 */
class User_model extends CI_Model {
    
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
    
    // add/edit by nandar
    public function get_data($where = NULL, $order = NULL, $limit = NULL)
    {
        $this->db->select('*');
        $this->db->from('cms_users');
        
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
    public function get_single_data($where)
    {
        $this->db->select('*');
        $this->db->from('cms_users');
        
        if ($where != null)
            $this->db->where($where);
        
        $query = $this->db->get();
        return $query->row_array();
        // return $query->last_query();
    }
    
}
