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
        $url = "http://video.genyoutube.net/" . $qs;
        $html = file_get_html($url);
        
        //echo $html;
        $saltos = 0;
        $urlRedy = "";

        if(($html->find('a[rel][href][data-itag][data-format="3GPP"]', 0))) {
            foreach ($html->find('a[rel][href][data-itag][data-format="3GPP"]') as $i) {
            $saltos = $saltos+1;
            $value = $i->href;
            if ($saltos==1) {
                $urlRedy = $value;
                header("Location: $urlRedy");
            }
            }
        }elseif ($html->find('a[rel][href][data-itag][data-format="3GPP"]',1)) {
                foreach ($html->find('a[rel][href][data-itag][data-format="3GPP"]') as $i) {
                $saltos = $saltos+1;
                $value = $i->href;
                if ($saltos==2) {
                $urlRedy = $value;
                header("Location: $urlRedy");
            }
            }
        }
    }
}
?>