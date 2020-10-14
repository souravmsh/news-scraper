<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('image_lib');
        $data = $idata = $config = $config2 = array();
    }

    # To load this model
    # $this->upload->do_upload($upload_path = 'assets/images/profile/', $file_field_name = 'userfile');

    function do_upload($upload_path = NULL, $file_field_name = NULL) {
        #folder upload
        $gm_date = explode(' ', $this->gm_date());
        $file_path = $upload_path . $gm_date[2] . "/";
        if (!is_dir($file_path))
            mkdir($file_path, 0755);
        #ends of folder upload 
        $config['upload_path'] = $file_path;
        #$config['file_name'] = time();
        $config['allowed_types'] = 'gif|jpg|png';
        // $config['max_size'] = 1000;
//        $config['max_width'] = 1024;
//        $config['max_height'] = 768;
//        $config['min_width'] = 200;
//        $config['min_height'] = 200;
        $config['max_filename'] = 5;
        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = FALSE;
        $config['remove_spaces'] = TRUE;
        $config['file_ext_tolower'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_field_name)) {
            return FALSE;
        } else {
            $file = $this->upload->data();
            return $file_path.$file['file_name'];
        }
    }   

    public function do_resize($image_path = NULL, $width = NULL, $height = NULL) {
        $this->load->library('image_lib');
        $config['image_library']  = 'gd2';
        $config['source_image']   = $image_path;
        $config['create_thumb']   = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['width']          = $width;
        $config['height']         = $height;
        // $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    public function do_muliple_resize($image_path = NULL, $width = NULL, $height = NULL) {
        foreach ($image_path as $real_path) {
            $config['image_library']  = 'gd2';
            $config['source_image']   = $real_path;
            $config['create_thumb']   = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['width']          = $width;
            $config['height']         = $height;
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
    }

    function do_multiple_upload($upload_path = NULL, $file_field_name = NULL) {
        $name_array = array();
        $count = count($_FILES[$field_name]['size']);
        foreach ($_FILES as $key => $value) {
            for ($i = 0; $i <= $count - 1; $i++) {
                $_FILES[$field_name]['name'] = $value['name'][$i];
                $_FILES[$field_name]['type'] = $value['type'][$i];
                $_FILES[$field_name]['tmp_name'] = $value['tmp_name'][$i];
                $_FILES[$field_name]['error'] = $value['error'][$i];
                $_FILES[$field_name]['size'] = $value['size'][$i];
                #folder upload
                $gm_date = explode(' ', $this->gm_date());
                $file_path = $upload_path . $gm_date[2] . "/";
                if (!is_dir($file_path))
                    mkdir($file_path, 0755);
                #ends of folder upload
                $config['upload_path'] = $file_path;
//                $config['file_name'] = time();
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1000;
                $config['max_width'] = 1024;
                $config['max_height'] = 768;
//              $config['min_width'] = 200;
//              $config['min_height'] = 200;
                $config['max_filename'] = 5;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = FALSE;
                $config['remove_spaces'] = TRUE;
                $config['file_ext_tolower'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->do_upload();
                $data = $this->upload->data();
                $name_array[] = $data['file_name'];
            }
        }
//      resize uploaded files   
//        $this->resize_multi_upload($file_path, $names, 200, 200);
//      ends of resize uploaded files 
//            ------------------handle empty data
        for ($q = 0; $q <= $count; $q++)
            if ($name_array[$q] != '') {
                if ($name_array[$q] == $name_array[$q + 1]) {
                    $name_array[$q] = '';
                }
                $names = @implode(' ', $name_array);
            }
//            ------------------handle empty data
        return $names;
    }
   
    function gm_date() {
        $hour = gmdate("H") + 6;
        $minute = gmdate("i");
        $iecond = gmdate("s");
        $year = gmdate("Y");
        $month = gmdate("m");
        $day = gmdate("d");
        return date("h:i:s A Y-m-d", mktime($hour, $minute, $iecond, $month, $day, $year));
    }

}

