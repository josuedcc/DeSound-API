<?php

/**
 * Created by PhpStorm.
 * User: josue
 * Date: 21/01/18
 * Time: 22:34
 */
require 'simple_html_dom.php';

if (isset($_GET['qs']) and isset($_GET['f'])) {

    $qs = \urlencode($_GET['qs']);
    $f = $_GET['f'];
    //echo $f;
    if ($qs != "" && $f != "") {
        //header("Content-Type: audio/mpeg");
        $url = "http://video.genyoutube.net/" . $qs;
        $html = file_get_html($url);

        //echo $html;
        switch ($f){
            case "MP4":
                linkMP4($html);
                break;
            case "3GP":
                link3GP($html);
                break;
            case "M4A":
                linkM4A($html);
                break;
            case "MP3":
                linkMP3($qs);
                break;
            default:
                echo "Tu mama calata";
                break;
        }
    }
}

function linkMP4 ($html){
    $saltos = 0;
    $urlRedy = "";

    if(($html->find('a[rel][href][data-itag][data-format="MP4"]', 0))) {
        foreach ($html->find('a[rel][href][data-itag][data-format="MP4"]') as $i) {
            $saltos = $saltos+1;
            $value = $i->href;
            if ($saltos==1) {
                $urlRedy = $value;
                header("Location: $urlRedy");
            }
        }
    }else{
        echo "No existe";
    }
}

function link3GP ($html){
    $saltos = 0;
    $urlRedy = "";

    if(($html->find('a[rel][href][data-itag][data-format="3GP"]', 0))) {
        foreach ($html->find('a[rel][href][data-itag][data-format="3GP"]') as $i) {
            $saltos = $saltos+1;
            $value = $i->href;
            if ($saltos==1) {
                $urlRedy = $value;
                header("Location: $urlRedy");
            }
        }
    }else{
        echo "No existe";
    }
}

function linkM4A ($html){
    $saltos = 0;
    $urlRedy = "";

    if(($html->find('a[rel][href][data-itag][data-format="M4A"]', 0))) {
        foreach ($html->find('a[rel][href][data-itag][data-format="M4A"]') as $i) {
            $saltos = $saltos+1;
            $value = $i->href;
            if ($saltos==1) {
                $urlRedy = $value;
                header("Location: $urlRedy");
            }
        }
    }else{
        echo "No existe";
    }
}

function linkMP3 ($qs){
    $saltos = 0;
    $urlRedy = "";

    $urlyoutubeinmp3 = "http://youtubeinmp3.com/fetch/?video=http://www.youtube.com/watch?v=";
    header("Location: $urlyoutubeinmp3$qs");
}

?>