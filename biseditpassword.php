<?php include 'bisnav.php'; ?>
<style>
<?php include 'css/bislogin.css'; ?>
</style>

<html>
<div class="container">
    <h3>Update Account Information</h3>
    <form action="php/dobiseditpassword.php" method="post" id="login-form">
      <div class="form-field">
        <label for="oldpassword">
          Enter Old Password
        </label>
        <input type="password" name="oldpassword" id="oldpassword" size="50" required autofocus/>
      </div>
      <div class="form-field">
        <label for="newpassword">
          Enter New Password
        </label>
        <input type="password" name="newpassword" id="newpassword" size="50" pattern="^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{7,}$" title="Minimum of 7 characters. Should have at least one special character and one number and one UpperCase Letter." required/>
      </div>
      <div id="form-submit">
        <input type="submit" value="Change" name="Change"/>
      </div>
  </div>
      </form>


</html>