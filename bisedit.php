<?php include 'bisnav.php';
  $email=$_SESSION['email'];
  $address= $_SESSION['address'];
  $contact_number=$_SESSION['contact_number'];
  ?>
<style>
<?php include 'css/bislogin.css'; ?>
</style>


<div class="container">
    <h3>Update Account Information</h3>
    <form action="php/dobisedit.php" method="post" id="login-form">
      
      <div class="form-field">
        <label for="cname">
          Company Name
        </label>
        <input type="text" name="cname" id="cname" size="50" value="<?php echo $company_name ?>"required />
      </div>
      
            
      <div class="form-field">
        <label for="email">
          Email
        </label>
        <input type="text" name="email" id="email" size="50" value="<?php echo $email ?>" required />
      </div>
      
            
      <div class="form-field">
        <label for="address">
          Address
        </label>
        <input type="text" name="address" id="address" size="50" value="<?php echo $address ?>" required />
      </div>
                  
      <div class="form-field">
        <label for="cnumber">
          Contact Number
        </label>
        <input type="text" name="cnumber" id="cnumber" size="50" value="<?php echo $contact_number ?>" pattern="^[6,8,9]{1}[0-9]{7,}$" title="Minimum of 8 Numbers. Starting With 6,8,9" required />
      </div>
      <div id="form-submit">
        <input type="submit" value="Edit" name="Edit"/>
      </div>
    </form>
    <form action="biseditpassword.php" method="post" >
    <div id="form-submit">
        <input type="submit" value="Change Password"/>
      </div>
    </form>
    <form action="confirmdeletebis.php" method="post" >
    <div id="form-delete">
        <input type="submit" value="Delete"/>
      </div>
    </form>
</div>


    