<?php
class Language_Loader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');

        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            $ci->lang->load('index',$ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load('index','bangla');
        }
    }
}