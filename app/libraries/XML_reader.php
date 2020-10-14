<?php

class XML_reader{

	private $path = "public/data/xml/";

	public function read($filename){
		echo file_get_contents($this->path.$filename.".xml");
	}

	public function single_read($file=null){
		$file = (!empty($file)?($this->path.$file.".xml"):($this->path."default.xml"));
		if(file_exists($file)){   
			$doc = new DOMDocument();
			$doc->load($file);//xml file loading here

			$news = $doc->getElementsByTagName("item");
			foreach( $news as $value )
			{
				$titles = $value->getElementsByTagName("title");
				$links = $value->getElementsByTagName("link");
				$images = $value->getElementsByTagName("image");
				$descriptions = $value->getElementsByTagName("description");
				
				$xml[] = (object)array( 
					'title' 	  => $titles->item(0)->nodeValue, 
					'link' 	      => $links->item(0)->nodeValue, 
					'image'		  => (!empty($images->item(0)->nodeValue)?$images->item(0)->nodeValue:null), 
					'description' => $descriptions->item(0)->nodeValue
				);

			}
			return $xml; 
		} 
	}

	public function write_by_url($data=null){ 
		$xmlData = file_get_contents($data['url']);
		file_put_contents($this->path.$data['filename'].".xml", $xmlData); 
	}

	public function write_by_config($config=null){ 
		#----------------------------------------------#
		$filename = $config['filename'];
		$url      = $config['url'];
		$item     = $config['item'];
		$title    = $config['title'];
		$link     = $config['link'];
		$image    = $config['image'];
		$description    = $config['description'];
		#----------------------------------------------#
		$doc = new DOMDocument();
		$doc->load($url);//xml file loading here
		$news = $doc->getElementsByTagName($item);
		foreach($news as $value ) {
			$titles = $value->getElementsByTagName($title);
			$links = $value->getElementsByTagName($link); 
			$images= $value->getElementsByTagName($image);
			$descriptions = $value->getElementsByTagName($description);
			$xml[] = array( 
				'title' 	  => $titles->item(0)->nodeValue, 
				'link' 	      => $links->item(0)->nodeValue, 
				'image'		  => (!empty($images->item(0)->nodeValue)?$images->item(0)->nodeValue:null), 
				'description' => $descriptions->item(0)->nodeValue
			); 
		}  
		#----------------------------------------------#
		$this->do_xml($filename,$xml);
	}

	public function do_xml($filename,$data){
		$xmlData = '<?xml version="1.0" encoding="UTF-8" ?>';
		$xmlData .= '<rss version="2.0">';
		$xmlData .= '<channel>';
		$xmlData .= '<title>A2z Newspaper dot Com</title>';
		$xmlData .= '<link>http://www.a2znewspager.com</link>';
		$xmlData .= '<description>A2z Description </description>';
		foreach ($data as $row):
		    $xmlData .= '<item>';
		    $xmlData .= '<title>'.($row['title']).'</title>';
		    $xmlData .= '<link>'.($row['link']).'</link>';
		    $xmlData .= '<image>'.($row['image']).'</image>';
		    $xmlData .= '<description>'.($row['description']).'</description>';
		    $xmlData .= '</item>';
		endforeach;
		$xmlData .= '</channel>';
		$xmlData .= '</rss> ';
		header('Content-Type: application/xml');
		#----------------------------------------------# 
		file_put_contents($this->path.$filename.".xml", $xmlData);	
		#----------------------------------------------# 
		redirect($_SERVER['HTTP_REFERER']);
	}
}





// $obj = new XML_reader();
// $obj->xml_read('google');
// $obj->xml_single_read('google');

// $obj->xml_write_by_url('http://news.google.com/news?ned=us&topic=h&output=rss','google');


// $obj->do_xml('google',array(
// 		array('title'=>'title 1','link'=>'http://title1.com','image'=>'image1','description'=>'description1'),
// 		array('title'=>'title 2','link'=>'http://title2.com','image'=>'image2','description'=>'description2'),
// 		array('title'=>'title 3','link'=>'http://title3.com','image'=>'image3','description'=>'description3'),
// 		array('title'=>'title 4','link'=>'http://title4.com','image'=>'image4','description'=>'description4'),
// 		array('title'=>'title 5','link'=>'http://title5.com','image'=>'image5','description'=>'description5'),
// ));

#---------google---------#
// $obj->xml_write(array(
// 	'url' 		=> 'http://news.google.com/news?ned=us&topic=h&output=rss',
// 	'filename'  => 'google',
// 	'item'		=> 'item', 
// 	'title'		=> 'title', 
// 	'link'		=> 'url',
// 	'image'		=> 'image',
// 	'description' => 'description'
// ));

#---------microsoft---------#
// $obj->xml_write(array(
// 	'url' 		=> 'https://blogs.technet.microsoft.com/inside_microsoft_research/feed/',
// 	'filename'  => 'microsoft',
// 	'item'		=> 'item', 
// 	'title'		=> 'title', 
// 	'link'		=> 'link',
// 	'image'		=> 'image',
// 	'description' => 'description'
// ));

#---------msnbc---------#
// $obj->xml_write(array(
// 	'url' 		=> 'http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml',
// 	'filename'  => 'msnbc',
// 	'item'		=> 'item', 
// 	'title'		=> 'title', 
// 	'link'		=> 'link',
// 	'image'		=> 'image',
// 	'description' => 'description'
// ));







