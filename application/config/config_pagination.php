<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Pagination config
|--------------------------------------------------------------------------
|
| Menyesuaikan dengan css bootstrap
|
*/

$config['pagination']['base_url']         = base_url();
$config['pagination']['per_page']         = 5;
$config['pagination']['num_links']        = 3;
$config['pagination']['uri_segment']      = 3;        
$config['pagination']['full_tag_open']    = '<ul class="pagination pagination-sm pagination-centered">';
$config['pagination']['full_tag_close']   = '</ul>';
$config['pagination']['next_tag_open']    = '<li>';
$config['pagination']['next_link']        = 'Next  &rsaquo;';
$config['pagination']['next_tag_close']   = '</li>';
$config['pagination']['prev_tag_open']    = '<li>';
$config['pagination']['prev_link']        = '&lsaquo; Prev';
$config['pagination']['prev_tag_close']   = '</li>';        
$config['pagination']['num_tag_open']     = '<li>';
$config['pagination']['num_tag_close']    = '</li>';
$config['pagination']['cur_tag_open']     = '<li class="active"><span>';
$config['pagination']['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';        
$config['pagination']['first_tag_open']   = '<li>';
$config['pagination']['first_link']       = '&lsaquo;&lsaquo; First';
$config['pagination']['first_tag_close']  = '</li>';
$config['pagination']['last_tag_open']    = '<li>';
$config['pagination']['last_link']        = 'Last &rsaquo;&rsaquo;';
$config['pagination']['last_tag_close']   = '</li>';  


/* End of file config_pagination.php */
/* Location: ./application/config/config_pagination.php */
