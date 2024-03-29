<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    <?php include 'css/styles.css'; ?>
    
  
    .carousel {
      z-index: -99;
    }

    .carousel .one {
      background: url(assets/img/slide3blur.jpg);
      background-size: cover;
      -moz-background-size: cover;
    }

    .carousel .two {
      background: url(assets/img/slide2blur.jpg);
      background-size: cover;
      -moz-background-size: cover;
    }

    .carousel .three {
      background: url(assets/img/slide1blur.jpg);
      background-size: cover;
      -moz-background-size: cover;
    }

    .carousel .active.left {
      left: 0;
      opacity: 0;
      z-index: 2;
    }
  </style>
  <title>Grabify - Home</title>
</head>

<body>

  <?php include 'php/userloginfn.php'; ?>

  <div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol style="margin: auto;" class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">

        <div class="item active">
          <img src="https://www.acurax.com/wp-content/themes/acuraxsite/images/inner_page_bnr.jpg?x26444" alt="Los Angeles" style="width:100%;">
          <div class="carousel-caption">
            <h3>Booking</h3>
            <p>Book now!</p>
          </div>
        </div>

        <div class="item">
          <img src="https://www.acurax.com/wp-content/themes/acuraxsite/images/inner_page_bnr.jpg?x26444" alt="Chicago" style="width:100%;">
          <div class="carousel-caption">
            <h3>Recommentations</h3>
            <p>high ratings by users</p>
          </div>
        </div>

        <div class="item">
          <img src="https://www.acurax.com/wp-content/themes/acuraxsite/images/inner_page_bnr.jpg?x26444" alt="New York" style="width:100%;">
          <div class="carousel-caption">
            <h3>Restaurants Near you</h3>
            <p></p>
          </div>
        </div>

      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

</body>

</html>