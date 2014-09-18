<?php
  $pinID = $_GET['id'];
  $url='http://54.179.16.196:3000/getPin?pinID='.$pinID;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = json_decode(curl_exec($ch), true);

  curl_close($ch);
  //var_dump($result);
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Happinning: What's Happinning here</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="pin-block">
      <div class="container">
        <div class="pin-panel">
          <div class="pin-panel-heading">
            <div id="pin-title">
              <h4><?php echo $result['text']?></h4>
            </div>
          </div>
          <!-- pin-panel-heading-->
          <div class="pin-panel-body">
            <div class="row">
              <div class="col-md-8">
                  <div id="img-gallery">
                    <img src="http://54.179.16.196:3000<?php echo $result['image']?>"/>
                  </div>
              </div>
              <div class="col-md-4">
                <div id="pin-detail">
                  <div id="info-block">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="icons">
                          <i class="fa fa-map-marker fa-4x"></i>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div id="author-block">
                          <h4><img id="profile-image" src="http://identicon.org/?t=<?php echo $result['userId']?>&s=19"/> <a href="/user/<?php echo $result['userId']?>"><?php echo $result['userId']?></a></h4>
                        </div>
                        <div id="local-block">
                          At: <?php echo $result['location']['subLocality']?>, <?php echo $result['location']['locality']?>
                        </div>
                        <div id="date-block">
                          <?php echo $result['uploadDate']?> mins ago
                        </div>
                      </div>
                    </div>
                    <div id="interaction-block">
                      <div class="row">
                        <div class="col-md-6 last">
                            <i class="fa fa-heart-o fa-2x"></i><a class="int-text pull-right"><h4>Like</h4></a>
                        </div>
                        <div class="col-md-6">
                            <i class="fa fa-pencil fa-2x"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapseComment" class="int-text pull-right"><h4>Comment</h4></a>
                        </div>
                      </div>
                    </div>
                    <div id="collapseComment" class="panel-collapse collapse" style="padding-top: 10px;">
                      <input type="text" class="form-control" placeholder="Comment here..."></input>
                    </div>
                  </div>
                  <div id="comment-block">
                    <div id="pin-title">
                      TITLE
                    </div>
                    <div id="pin-comments">
                      <div class="pin-comment">
                        COMMENT 1
                      </div>
                      <div class="pin-comment">
                        COMMENT 2
                      </div>
                      <div class="pin-comment">
                        COMMENT 3
                      </div>
                      <div class="pin-comment">
                        COMMENT 4
                      </div>
                      <div class="pin-comment">
                        COMMENT 5
                      </div>
                    </div>
                  </div>
                  <div id="map-block">
                    <div class="map-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseMap">
                        Maps <i class="fa fa-chevron-circle-down"></i>
                      </a>
                    </div>
                    <div id="collapseMap" class="panel-collapse collapse">
                      <div class="acf-map">
                        <div class="marker" data-lat="<?php echo $result['location']['coordinates'][1]; ?>" data-lng="<?php echo $result['location']['coordinates'][0]; ?>"></div>
                      </div>
                    </div>
                  </div>
                  <!-- map-block -->
                </div>
                <!-- pin-detail-->
              </div>
            </div>
          </div>
          <!-- pin-panel-body -->
        </div>
        <!-- pin-panel -->
      </div>
    </div>
    <!-- pin-block -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="js/googlemap.js"></script>
    <script>
      $(document).ready(function(){

        $('.acf-map').each(function(){

          render_map( $(this) );

        });

      });
    </script>
  </body>
</html>
