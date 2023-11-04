<?php 
$url = 'https://www.google.com/';
$doc = new DOMDocument();
$doc->strictErrorChecking = FALSE;
$doc->loadHTML(file_get_contents($url));
$xml = simplexml_import_dom($doc);
$arr = $xml->xpath('//link[@rel="icon"]');
// echo $arr[0]['href'];

?>