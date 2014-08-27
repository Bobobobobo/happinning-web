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
    <title>What's happinning here</title>

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
    <div id="pin-page">
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">What's Happinning?</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li class="Profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id="profile-image" src="http://identicon.org/?t=<?php echo $result['userId']?>&s=19"/>My Profile <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-power-off fa-lg"></i>Logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
    <div id="pin-block">
      <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              <div id="pin-title">
                <div class="row">
                  <div class="col-md-9">
                    <h4><?php echo $result['text']?></h4>
                  </div>
                  <div class="col-md-3">
                    <h6 class="pull-right">by <img id="profile-image" src="http://identicon.org/?t=<?php echo $result['userId']?>&s=19"/> <a href="/user/<?php echo $result['userId']?>"><?php echo $result['username']?></a></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4">
                  <div class="acf-map">
                    <div class="marker" data-lat="<?php echo $result['location']['coordinates'][1]; ?>" data-lng="<?php echo $result['location']['coordinates'][0]; ?>"></div>
                  </div>
              </div>
              <div class="col-md-8">
                <div id="pin-detail" class="pull-right">
                  <div id="local-block">
                    At: <?php echo $result['location']['subLocality']?>, <?php echo $result['location']['locality']?>
                  </div>
                  <div id="img-gallery">
                    <img src="<?php echo $result['image']?>"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
