<?php
/**
 * Created by PhpStorm.
 * User: josue
 * Date: 21/01/18
 * Time: 20:56
 */

require 'simple_html_dom.php';

header('Content-Type: application/json');
$key = "GenesisJosue";

date_default_timezone_set('America/Lima');
$datetime = date("Y-m-d");
$codQ = date('Y-m-d-H-i-s') . '_' . uniqid();

$dateString = $datetime;

$logip = getRealIP();

if (isset($_GET['q']) && isset($_GET['keygenesis'])) {
    $q = limpiartitulo($_GET['q']);
    $q = \urlencode($q);
    echo makearray_result($q);
} else{
    echo "no";
}
function getRealIP()
{

    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }
}

function makearray_result ($q){

    //Buscar en Youtube
    $url = ('https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=50&type=video&videoDimension=2d&fields=items(id%2Csnippet)&key=AIzaSyBBjUxeiVbKtV_StxWPa5DGf8wJUSnDgOk&q=' . $q);
    $getU = ($url);
    $json = file_get_contents($getU);
    $data = json_decode($json, true);
    $num = count($data['items']);

    if ($num !== 0) {
        foreach ($data['items'] as $items) {
            switch ($items['id']['kind']) {
                case 'youtube#video':
                    $id = $items['id']['videoId'];
                    $title = $items['snippet']['title'];
                    $title = limpiartitulo($title);
                    $imgDef = $items['snippet']['thumbnails']['default']['url'];
                    $url = "http://192.168.1.53/find/catch2.php?qs=" . $id;
                    $urlsecondary = "http://192.168.1.53/find/catch.php?qs=" . $id;

                    $vars_dats[] = array("id", "title", "imgDef", "url", "urlsecondary");
                    $resultado[] = compact($vars_dats);
                    break;
            }
        }
    } else {
        $var_dats[] = array("num");
        $resultado[] = compact($var_dats);
    }

    $jsonResult = json_encode($resultado);

    return $jsonResult;
}

function limpiartitulo($String){
    $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
    $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
    $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
    $String = str_replace(array('í','ì','î','ï'),"i",$String);
    $String = str_replace(array('é','è','ê','ë'),"e",$String);
    $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
    $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
    $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
    $String = str_replace(array('ú','ù','û','ü'),"u",$String);
    $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
    $String = str_replace(array('[','^','´','`','¨','~',']'),"",$String);
    $String = str_replace("ç","c",$String);
    $String = str_replace("?","",$String);
    $String = str_replace("¿","",$String);
    $String = str_replace("Ç","C",$String);
    $String = str_replace("ñ","n",$String);
    $String = str_replace("Ñ","N",$String);
    $String = str_replace("Ý","Y",$String);
    $String = str_replace("ý","y",$String);
    $String = str_replace("ã","a",$String);
    $String = str_replace("&","y",$String);
    $String = str_replace("(","",$String);
    $String = str_replace(")","",$String);
    $String = str_replace("'","",$String);
    $String = str_replace(".","",$String);
    $String = str_replace("|","",$String);
    $String = str_replace("/","",$String);
    $String = str_replace("@","",$String);
    $String = str_replace("■","",$String);
    $String = str_replace("♥","",$String);
    $String = str_replace("-","",$String);
    $String = str_replace("♡","",$String);
    $String = str_replace("ღ","",$String);
    $String = str_replace("▶","",$String);
    $String = str_replace("▮","",$String);
    $String = str_replace("●","",$String);
    $String = str_replace("#","",$String);
    $String = str_replace("®","",$String);
    $String = str_replace("©","",$String);
    $String = str_replace("™","",$String);
    $String = str_replace("#","",$String);
    $String = str_replace("◢◤","",$String);
    $String = str_replace("&aacute;","a",$String);
    $String = str_replace("&Aacute;","A",$String);
    $String = str_replace("&eacute;","e",$String);
    $String = str_replace("&Eacute;","E",$String);
    $String = str_replace("&iacute;","i",$String);
    $String = str_replace("&Iacute;","I",$String);
    $String = str_replace("&oacute;","o",$String);
    $String = str_replace("&Oacute;","O",$String);
    $String = str_replace("&uacute;","u",$String);
    $String = str_replace("&Uacute;","U",$String);
    $String = str_replace("&ndash;","-",$String);
    $String = str_replace("%09","",$String);
    return $String;
}