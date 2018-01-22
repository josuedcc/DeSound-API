<?php
header('Content-Type: application/json');

    function getKeywordSuggestionsFromGoogle($keyword) {
    $keywords = array();
    $data = file_get_contents('http://suggestqueries.google.com/complete/search?output=firefox&ds=yt&q='.urlencode($keyword));
    if (($data = json_decode($data, true)) !== null) {
        $keywords = $data[1][1];
    }

    $num = count($data[1]);
    for ($i=0; $i < $num; $i++) { 
        $id = $i;
        $name = $data[1][$i];
        $vars_filter[$i] = array("id"=>$id,"name"=>$name);
        //$resultadofilter[] = compact($vars_filter);
    }

    $root = array("resultados"=>array($vars_filter));
    

    return $root;
}

if (isset($_GET['q'])){
    $q = $_GET['q'];
    $q = \urlencode($q);
    echo json_encode(getKeywordSuggestionsFromGoogle($q));
}

//var_dump(getKeywordSuggestionsFromGoogle('alex ubago'));
?>