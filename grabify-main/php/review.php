<html>

<head>
    <title>Review </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://raw.githubusercontent.com/kartik-v/bootstrap-star-rating/master/css/star-rating.min.css'>

   <script src="js/jquery.star-rating-svg.js"></script>
    <link rel="stylesheet" type="text/css" href="css/star-rating-svg.css">
     

</head>

<body>
<h2 style="text-align: center">
            Ratings and Review
        </h2>
    <div class="row container" style="position:absolute; left:500px">
        <div class="col-md-6">
            <div class="row">

                <div class="col-md-6">
                    <h3 align="center"><b>4.5</b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00"></i></h3>
                    <p style="position:absolute;left:50px">24 ratings and 24 reviews</p>
                </div>
                <div class="col-md-6">

                    <h4 align="center">5 <i class="fa fa-star" data-rating="5" style="font-size:20px;color:green;"></i> Total 13</h4>
                    <h4 align="center">4 <i class="fa fa-star" data-rating="4" style="font-size:20px;color:green;"></i> Total 11</h4>
                    <h4 align="center">3 <i class="fa fa-star" data-rating="3" style="font-size:20px;color:green;"></i> Total 10</h4>
                    <h4 align="center">2 <i class="fa fa-star" data-rating="2" style="font-size:20px;color:green;"></i> Total 5</h4>
                    <h4 align="center">1 <i class="fa fa-star" data-rating="1" style="font-size:20px;color:green;"></i> Total 5</h4>


                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <h4>5 <i class="fa fa-star" data-rating="5" style="font-size:20px;color:green;"></i> by John</span></h4>
                    <p>Great Service</p>
                    <a href="editReview.php">Edit</a>

                </div>
            </div>



            <form action="createReview.php" method="post">
                Ratings <select id="star-rating" name="ratings" required>
    <option value="">Select a rating</option>
  <option value="5">Excellent</option>
  <option value="4">Very Good</option>
  <option value="3">Average</option>
  <option value="2">Poor</option>
  <option value="1">Terrible</option>
</select>
        <br>
        Date:<table border="0" cellspacing="0">

<tr><td  align=left  >   

<select name="DateVisit[month]" value='' required>Select Month</option>
<option value='01'>January</option>
<option value='02'>February</option>
<option value='03'>March</option>
<option value='04'>April</option>
<option value='05'>May</option>
<option value='06'>June</option>
<option value='07'>July</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>

-

</td><td  align=left  >   

<select name="DateVisit[day]" required>

<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select>


</td><td  align=left  >   

-
<?php echo date("Y"); ?> 



</table><br>
        Review:<textarea class="form-control" rows="5" placeholder="Write your review here..." name="remark" id="remark" required></textarea><br>
                <button type="submit" class="btn btn-primary button" style="position:absolute; left:250px">
                submit
              </button>
        
        </form>

</body>

</html>
