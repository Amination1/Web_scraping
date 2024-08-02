<?php

require "simple_html_dom.php";

$dom = file_get_html('https://www.imdb.com/title/tt6263850/reviews', false);

$answer = [];
if(!empty($dom)) {
    $i = 0;
    foreach($dom->find(".review-container") as $divClass) {
        foreach($divClass->find(".title") as $title ) {
            $answer[$i]['title'] = $title->plaintext;
        }
        foreach($divClass->find(".ipl-ratings-bar") as $ipl_ratings_bar ) {
            $answer[$i]['rate'] = trim($ipl_ratings_bar->plaintext);
        }
        foreach($divClass->find('div[class=text show-more__control]') as $desc) {
            $text = html_entity_decode($desc->plaintext);
            $text = preg_replace('/\'/', "`", $text);
            $answer[$i]['content'] = html_entity_decode($text);
        }
        $i++;
    }
}

require "index.view.php";

function array_to_xml($array, &$xml_user_info) {
    foreach($array as $key => $value) {
        if(is_array($value)) {
            $subnode = $xml_user_info->addChild("Review$key");
            foreach ($value as $k => $v) {
                $subnode->addChild("$k", htmlspecialchars($v));
            }
        } else {
            $xml_user_info->addChild("$key", htmlspecialchars($value));
        }
    }
    return $xml_user_info->asXML();
}

$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><root></root>");
$xmlContent = array_to_xml($answer, $xml_user_info);


$my_file = 'reviews.xml';
$handle = fopen($my_file, 'w') or die('Cannot open file: '.$my_file);

//if(fwrite($handle, $xmlContent)) {
//    echo 'XML file has been generated successfully.';
//} else {
//    echo 'XML file generation error.';
//}


