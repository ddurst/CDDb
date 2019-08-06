<?php
require_once('simple_html_dom.php');
$html = file_get_html('$link');
foreach($html->find('img') as $element) {
    echo $element->src."\n";
}
?>