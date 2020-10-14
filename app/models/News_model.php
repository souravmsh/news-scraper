<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

	public $table = "rss_settings";

	public function read(){
		return $this->db->select("*")
			->from($this->table) 
			->where('status',1)
			->order_by('newspaper_position','asc')
			->get()
			->result(); 
	}

	public function read_by_ip($region=null){
		return $this->db->select("*")
			->from($this->table)
			->where('newspaper_region',$region)
			->where('status',1)
			->order_by('newspaper_position','asc')
			->get()
			->result(); 
	}
  
}
