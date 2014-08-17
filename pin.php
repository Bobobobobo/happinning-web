<?php 
  $url="http://localhost:3000/getPin?pinID=53eb7fe2954d008825a5a779";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = json_decode(curl_exec($ch), true);

  curl_close($ch);
  //var_dump($result);
?>

<html>
  <head>
  </head>
  <body>
    <h3>It's not happinning... Yet</h3>
    <?php echo $result["location"]["coordinates"][0]; ?>
  </body>  
</html>