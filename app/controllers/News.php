<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'news_model'
		));
	}
 	
	public function language($language = null) {
       $language = ($language != null) ? $language : "english"; 
        $this->session->set_userdata('site_lang', $language); 
        redirect(base_url());
    }

	public function index(){   
		$data['title'] = "Home"; 
		$data['news_world'] = $this->news_model->read(); 
		$data['news_region'] = $this->news_model->read_by_ip(
			$this->ip_country()
		);  
		$data['content'] = $this->load->view('frontend/pages/home',$data,true);
		$this->load->view('frontend/layouts/layout',$data);
	}

	public function details(){ 
		$data['title'] = "Details";
		$data['content'] = $this->load->view('frontend/pages/details',$data,true);
		$this->load->view('frontend/layouts/layout',$data);
	}


	function ip_country(){
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];
	    $country  = "Unknown";

	    if(filter_var($client, FILTER_VALIDATE_IP)){
	        $ip = $client;
	    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
	        $ip = $forward;
	    }else{
	        $ip = $remote;
	    } 
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    $ip_data_in = curl_exec($ch); // string
	    curl_close($ch);

	    $ip_data = json_decode($ip_data_in,true);
	    $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

	    if($ip_data && $ip_data['geoplugin_countryCode'] != null) {
	        $country = $ip_data['geoplugin_countryCode'];
	    }
	    return $country;
	}




}
