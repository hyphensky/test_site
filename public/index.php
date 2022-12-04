<?php
require "../header.php";
$news = new News();
$data = $news->getNews($pdo, 3);
$result = array();
if($data){
    foreach ($data as $key => $item) {
        $result[$key]['title'] = $item['title'];
        $result[$key]['description'] = preg_replace('/([^?!.]*.).*/ui', '\\1', $item['description']);
        $result[$key]['datetime'] = date("d-m-Y H:i:s", $item['datetime']);
    }
}

include '../views/index.phtml';