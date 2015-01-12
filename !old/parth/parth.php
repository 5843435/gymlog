<?php
require_once 'simple_html_dom.php';

$dom = file_get_html('http://www.1101.com/home.html');
$dom->find('h1', 0)->outertext;  //<h1>ƒ^ƒCƒgƒ‹<strong>‹­’²</strong></h1>

?>