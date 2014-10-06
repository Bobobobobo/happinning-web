<?php
  // get pin detail
  $pinID = $_GET['id'];
  $url='http://54.179.16.196:3000/getPin?pinID='.$pinID;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = json_decode(curl_exec($ch), true);

  // create profile image url
  $profile = 'http://identicon.org/?t='.$result['userId']."&s=20";
  curl_close($ch);

  // get comments from pin
  $url='http://54.179.16.196:3000/getComments?pinID='.$pinID;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $comment = json_decode(curl_exec($ch), true);

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
                <div class="acf-map">
                  <div class="marker" data-lat="<?php echo $result['location']['coordinates'][1]; ?>" data-lng="<?php echo $result['location']['coordinates'][0]; ?>"></div>
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
                          <h4><img style="background-image:url('<?php echo $profile?>'); width: 20px; height: 20px;"/> <a href="/user/<?php echo $result['userId']?>"><?php echo $result['username']?></a></h4>
                        </div>
                        <div id="local-block">
                          At: <?php echo $result['location']['subLocality']?>, <?php echo $result['location']['locality']?>
                        </div>
                        <div id="date-block">
                          <span class="elapse-time"><?php echo $result['uploadDate']?></span>
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
                  <?php if ($comment['commentsNum'] > 0): ?>
                    <div id="comment-block">
                      <div id="pin-title">
                        <?php echo $result['text']?>
                      </div>
                      <div id="pin-comments">
                        <?php $i = 0; while ($i < $comment['commentsNum']):?>
                          <div class="pin-comment">
                            <?php $comments = $comment['comments'];?>
                            <?php $c = $comments[$i]; ?>
                            <div class="comment-1">
                              <?php $commentorURL = 'http://identicon.org/?t='.$c['userImage']."&s=20"?>
                              <img style="background-image: url('<?php echo $commentorURL ?>'); width: 20px; height: 20px;" class="commentor-img"/> <a href="#"><?php echo $c['username']; ?></a><i>: <?php echo $c['comment']; ?></i>
                            </div>
                            <div class="comment-2">
                              <span class="elapse-time"><?php echo $c['commentDate']?></span>
                            </div>
                          </div>
                        <?php $i++; endwhile; ?>
                      </div>
                    </div>
                  <?php endif ?>
                  <div id="map-block">
                    <div class="map-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseGallery">
                        Images <i class="fa fa-chevron-circle-down"></i>
                      </a>
                    </div>
                    <div id="collapseGallery" class="panel-collapse collapse in">
                      <div id="img-gallery">
                        <img src="http://54.179.16.196:3000<?php echo $result['image']?>"/>
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
    <script src="js/moment.js"></script>
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

      var nodeList = document.getElementsByClassName("elapse-time");
      for (var i = 0, length = nodeList.length; i < length; i++) {
        moment().format();
	var x = moment(parseInt(nodeList[i].innerHTML)).fromNow();
        nodeList[i].innerHTML = x;
      };
    </script>
  </body>
</html>
