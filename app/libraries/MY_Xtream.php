<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Xtream {

	/*
	* -----------------------------------------------------------
	* Author Md. Shohrab Hossain *
	* sourav.diubd@gmail.com *
	* *
	* Create on 25/05/2016 *
	* -----------------------------------------------------------
	*/

	/*
	* ----------------------------------------------------------*
	* -------- load the lirbrary ----------
	* $this->load->library('xtream');
	* -------call _encode function ---------
	* echo $id = $this->xtream->_encode($int_value);
	* -------call _decode function ---------
	* echo $this->xtream->_decode($id);
	* -----------------------------------------------------------
	*/

	public function _encode($id=null){
		return date('ym').$id.date('w').mt_rand(100, 999).date('s');
	}

	public function _decode($id=null){
		return substr(substr($id, 4), 0,-6);
	}

	/*
	* -----------------------------------------------------------
	* -------call _date function -----------
	* $this->xtream->_date('date');
	* -----------------------------------------------------------
	*/

	public function _date($date = null){
		return (($date===null)?(null):(date('d-m-Y',strtotime($date))));
	}


	/*
	* -----------------------------------------------------------
	* -------call _random function ---------
	* $this->xtream->_random();
	* $this->xtream->_random('table','id');
	* -----------------------------------------------------------
	*/

	public function _random($table=null,$field=null){
		$CI =& get_instance();
		$CI->load->helper('string');
		$random_code = date('y').random_string('alnum', 3).date('m').random_string('alnum', 3).date('s');
		if(!empty($table) && !empty($field)):
			return $this->check_exists($table,$field,$random_code);
		else:
			return strtoupper($random_code);
		endif;
	}

	private function check_exists($table=null,$field=null,$random_code=null){
		$CI =& get_instance();
		$CI->load->database();
		$num_rows = $CI->db->select("*")
		->from($table)
		->where($field,$random_code)
		->get()
		->num_rows();
		if($num_rows > 0):
			$this->_random($table,$field);
		else:
			return strtoupper($random_code);
		endif;
	}

	/*
	* ----------------------------------------------------------*
	* -------call _json_encode function ---------
	* $data = array(10,20,30,40,50,60,70,80,90,100);
	* $filepath = "assets/data/json/filename.json";
	* $this->xtream->_json_encode($data,$filepath);
	*
	* -------call _json_decode function ---------
	* $filepath = "assets/data/json/filename.json";
	* $json = $this->xtream->_json_decode($filepath, true);
	*
	* foreach ($json as $key => $value):
	* if (!is_array($value)):
	* echo $key . '=>' . $value . '<br />';
	* else:
	* foreach ($value as $key => $val):
	* echo $key . '=>' . $val . '<br />';
	* endforeach;
	* endif;
	* endforeach;
	* ----------------------------------------------------------*
	*/

	public function _json_encode($data=null,$filepath=null){
		$json_string = json_encode($data);
		@unlink($filepath);
		file_put_contents($filepath, $json_string);
	}

	public function _json_decode($filepath=null,$mode=null){
		if(file_exists($filepath)):
			$string = file_get_contents($filepath);
			return json_decode($string, $mode);
		else:
			return false;
		endif;
	}


} 