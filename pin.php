<?php 
  $url="http://54.179.16.196:3000/getPin?pinID=53eb7fe2954d008825a5a779";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = curl_exec($ch);

  curl_close($ch);
  var_dump(json_decode($result, true));
?>