<?php

require "simple_html_dom.php";

$dom = file_get_html($url, false);

$answer = [];
if(!empty($dom)) {
    $i = 0;
    foreach($dom->find(".top-site") as $divClass) {
        foreach($divClass->find(".site-address") as $title ) {
            $answer[$i]['title'] = $title->plaintext;
        }
        foreach($divClass->find(".site-number") as $ipl_ratings_bar ) {
            $answer[$i]['rank'] = trim($ipl_ratings_bar->plaintext);
        }
        foreach($divClass->find('.site-title') as $desc) {
            $text = html_entity_decode($desc->plaintext);
            $text = preg_replace('/\'/', "`", $text);
            $answer[$i]['content'] = html_entity_decode($text);
        }
        $i++;
    }
}

function array_to_xml($array, &$xml_user_info) {
    foreach($array as $key => $value) {
        if(is_array($value)) {
            $subnode = $xml_user_info->addChild("Rank$key");
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

$my_file = 'ranking.xml';
$handle = fopen($my_file, 'w') or die('Cannot open file: '.$my_file);

if(fwrite($handle, $xmlContent)) {
    return 1;
} else {
    return 0;
}


