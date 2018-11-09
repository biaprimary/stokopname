<?php
function current_page($uri = "/"){
  return strstr(request()->path(), $uri);
}

function searchArray($value){
  $path = Request::segment(1);
  $array = ['suppliers', 'buyers', 'categories','items','transactions'];
  $search_path = array_flip($array);
  if (isset($search_path[$path])) {
    return $value;
  }
}

function dateConversion($value){
  return date('d F Y', strtotime($value));
}




?>
