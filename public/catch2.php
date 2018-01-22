<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 21/01/18
 * Time: 22:34
 */
require 'simple_html_dom.php';

if (isset($_GET['qs'])) {

    $qs = \urlencode($_GET['qs']);

    if ($qs != "") {
        header("Content-Type: audio/mpeg");
        $url = "http://youtubeinmp3.me/api/generate.php?id=" . $qs;
        $html = file_get_html($url);

        //echo $html;
        $saltos = 0;
        $urlReady = "";
        //echo $html->find('a');

        foreach ($html->find('a') as $i){
            $urlReady = $i->href;
        }

        header("Location: $urlReady");

    }
}
?>