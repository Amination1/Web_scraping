<?php

$url = 'https://www.alexairan.com/';

$scraping = require 'scraper.php';

if ($scraping == 1){
    require 'scraping.view.php';
}else{
    echo 'We have problem in create xml file for load ranking websites';
}