<?php

class Xml_reader{

	private $location = "data/xml/";

	public function xml_read($filename){
		echo file_get_contents($this->location.$filename.".xml");
	}

	public function xml_single_read($file=null){
		$file = (!empty($file)?($this->location.$file.".xml"):($this->location."default.xml"));
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

			$data['xml'] = $xml;

			foreach ($xml as $value) {
				echo "<a href=\"$value->link\">$value->title</a>";
				echo "<br>";
				echo (!empty($value->image)?("<img width=\"100\" src=\"http://mtnews24.com/uploads/$value->image\">"):null);
				echo "<br>";
				echo $value->description;
				echo "<br>"; 
			}
		} 
	}

	public function xml_write_by_url($url=null,$filename=null){ 
		$data = file_get_contents($url);
		file_put_contents($this->location.$filename.".xml", $data); 
	}

	public function xml_write($config=null){ 
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
			foreach( $news as $value ) {
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
			$xmlData = '<?xml version="1.0" encoding="UTF-8" ?>';
			$xmlData .= '<rss version="2.0">';
			$xmlData .= '<channel>';
			$xmlData .= '<title>A2z Newspaper dot Com</title>';
			$xmlData .= '<link>http://www.a2znewspager.com</link>';
			$xmlData .= '<description>A2z Description </description>';
			foreach ($xml as $row):
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
			file_put_contents($this->location.$filename.".xml", $xmlData);
	}

}


$obj = new XML_reader();
$obj->xml_read('google');
// $obj->xml_single_read('google');

$obj->xml_write_by_url('http://news.google.com/news?ned=us&topic=h&output=rss','google');

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






