<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
<?php include 'css/bispage.css'; ?>
<?php include 'css/style.css'; ?>


</style>

</head>

<body>
    <h2>Bussiness Page </h2>
    <h2> Welcome XXX User </h2>
    <h2><button style="font-size: 24px;"  onclick="window.location.href='editbisprofile.php'">Edit Profile</button></h2>

    
    <br>
    <br>
    <div class="line"></div>
    <h2> Exisiting Products </h2>
    <br>
    <br>

    <section class="sec-boxes" role="section">
    <adrticle class="box">
        <h1 onclick="window.location.href='bisproduct.php'">Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyDelete()>Delete</button>
        <button style="float: right;font-size:20px" onclick="window.location.href='editbis.php'">Edit</button>
      </adrticle>
      <adrticle class="box">
        <h1 onclick="window.location.href='bisproduct.php'">Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyDelete()>Delete</button>
        <button style="float: right;font-size:20px" onclick="window.location.href='editbis.php'">Edit</button>
      </adrticle>
      <adrticle class="box">
        <h1 onclick="window.location.href='bisproduct.php'">Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyDelete()>Delete</button>
        <button style="float: right;font-size:20px" onclick="window.location.href='editbis.php'">Edit</button>
      </adrticle>
      <adrticle class="box">
        <h1 onclick="window.location.href='bisproduct.php'">Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyDelete()>Delete</button>
        <button style="float: right;font-size:20px" onclick="window.location.href='editbis.php'">Edit</button>
      </adrticle>
      <adrticle class="box">
        <h1 onclick="window.location.href='bisproduct.php'">Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyDelete()>Delete</button>
        <button style="float: right;font-size:20px" onclick="window.location.href='editbis.php'">Edit</button>
      </adrticle>
      <adrticle class="box">
        <h1 onclick="window.location.href='bisproduct.php'">Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyDelete()>Delete</button>
        <button style="float: right;font-size:20px" onclick="window.location.href='editbis.php'">Edit</button>
      </adrticle>
      <adrticle class="box">
        <h1 onclick="window.location.href='bisproduct.php'">Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyDelete()>Delete</button>
        <button style="float: right;font-size:20px" onclick="window.location.href='editbis.php'">Edit</button>
      </adrticle>
      <adrticle class="box">
        <h1 onclick="window.location.href='bisproduct.php'">Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px;" onclick=MyDelete()>Delete</button>
        <button style="float: right;font-size:20px;" onclick="window.location.href='editbis.php'">Edit</button>
      </adrticle>
    </section>
    <div class="line"></div>
    <h2> Products Waiting for Approval </h2>
    <br>
    <br>
    <section class="sec-boxes" role="section">
    <adrticle class="box">
        <h1>Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyApprove()>Approve</button>
      </adrticle>
      <adrticle class="box">
        <h1>Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px" onclick=MyApprove()>Approve</button>
      </adrticle>
      <adrticle class="box">
        <h1>Product X</h1>
        Image
        <p>Basic Description</p>
        <button style="float: right;font-size:20px;" onclick=MyApprove()>Approve</button>
      </adrticle>
      <adrticle class="box">
      <h1> Add New Product </h1>
      <button onclick="window.location.href='bisaddproduct.php'" style="font-size:40px;">Click Here</button>
</section>


<script>
function MyDelete() {
  alert("Successfully deleted your product");
  window.location.href='bis.php';
}
function MyApprove() {
  alert("The product has been approved and will be published to your store page");
  window.location.href='bis.php';

}
</script>

</body>