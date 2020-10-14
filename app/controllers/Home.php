<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{

	public function dom_read()
	{
		$this->load->helper('dom');
		// Create DOM from URL or file
		$html = file_get_html('https://www.bbc.com/');

		// Find all article blocks
		foreach($html->find('ul.media-list li.media-list__item') as $article) {
		    $item['title']    = $article->find('a.media__link', 0)->plaintext;
		    $item['link']     = $article->find('a.media__link', 0)->href;
		    $item['image']    = $article->find('img.image-replace', 0)->src;
		    $item['description'] = $article->find('p.media__summary', -1)->plaintext;
		    $articles[] = (object)$item;
		}

		foreach ($articles as $value) {
			echo "<h3><a href=\"$value->link\">$value->title</a></h3>";
			echo "<img src=\"$value->image\" width=\"80\" height=\"80\" alt=\"\">";
			echo "<p>$value->description</p>";
		}
	}

	public function xml_read(){
		$this->load->library('xml_reader');
		$this->xml_reader->read('google');
	}

	public function xml_single_read(){
		$this->load->library('xml_reader');
		$xml = $this->xml_reader->single_read('google');

		foreach ($xml as $value) {
			echo "<a href=\"$value->link\">$value->title</a>";
			echo "<br>";
			echo (!empty($value->image)?("<img width=\"100\" src=\"http://mtnews24.com/uploads/$value->image\">"):null);
			echo "<br>";
			echo $value->description;
			echo "<br>"; 
		}
	}

	public function xml_write_by_url(){
		$this->load->library('xml_reader');
		$config = array(
			'url' 	   => 'https://blogs.technet.microsoft.com/inside_microsoft_research/feed/',
			'filename' => 'microsoft' 
		);
		$this->xml_reader->write_by_url($config);
	}	

	public function xml_write_by_config(){
		$this->load->library('xml_reader');
		$config = array(
			'url' 	=> 'https://blogs.technet.microsoft.com/inside_microsoft_research/feed/',
			'filename'  => 'microsoft',
			'item'		=> 'item', 
			'title'		=> 'title', 
			'link'		=> 'link',
			'image'		=> 'image',
			'description' => 'description'
		);
		$this->xml_reader->write_by_config($config);
	}	

	public function xml_write_from_db(){
		$this->load->library('xml_reader'); 
		$this->xml_reader->do_xml('test1',array(
			array('title'=>'title 1','link'=>'http://title1.com','image'=>'image1','description'=>'description1'),
			array('title'=>'title 2','link'=>'http://title2.com','image'=>'image2','description'=>'description2'),
			array('title'=>'title 3','link'=>'http://title3.com','image'=>'image3','description'=>'description3'),
			array('title'=>'title 4','link'=>'http://title4.com','image'=>'image4','description'=>'description4'),
			array('title'=>'title 5','link'=>'http://title5.com','image'=>'image5','description'=>'description5'),
		));
	}	


}

