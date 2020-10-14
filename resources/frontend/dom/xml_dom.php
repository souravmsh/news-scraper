<?php


// Create DOM from URL or file
$html = file_get_html('http://www.bbc.com');

// Find all article blocks
foreach($html->find('div.contentLeft div.topNewsLeftTop') as $article) {
    $item['title']    = $article->find('a', 0)->plaintext;
    $item['link']     = $article->find('a', 0)->href;
    $item['image']    = $article->find('img', 0)->src;
    $item['description'] = $article->find('p', -1)->plaintext;
    $articles[] = (object)$item;
}


foreach ($articles as $value) {
	echo "<h3><a href=\"$value->link\">$value->title</a></h3>";
	echo "<img src=\"$value->image\" width=\"80\" height=\"80\" alt=\"\">";
	echo "<p>$value->description</p>";
}