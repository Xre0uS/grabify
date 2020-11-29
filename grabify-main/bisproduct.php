<style>
<?php include 'css/bisproduct.css'; ?>
</style>
<html>

<div class="product-card">
  <div class="product-details">
    <h1>Product title</h1>
    <p>Description</p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <button style="float: left;font-size:20px" onclick=MyDelete()>Delete</button>
    <button style="float: left;font-size:20px" onclick="window.location.href='editbis.php'">Edit</button>
  </div>
</div>

</html>


<script>
function MyDelete() {
  alert("Successfully deleted your product");
  window.location.href='bis.php';
}
</script>
