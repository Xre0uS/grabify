<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<head>
<style>
<?php include 'css/bislogin.css'; ?>
</style>
</head>
<div class="container">
    <h3>Grabify Business Login</h3>
    <form action="php/dobislogin.php" method="post" id="login-form">
      <div class="form-field">
        <label for="username">
          Username
        </label>
        <input type="text" name="ausername" id="username" size="50" required autofocus/>
      </div>
      
      <div class="form-field">
        <label for="pass">
          Password
        </label>
        <input type="password" name="password" id="pass" size="50" required />
      </div>
      <div class="g-recaptcha" data-sitekey="6LfXJQEaAAAAALGBfXk-TjUlI8CTyBeRDWk4bZRy"></div>
      <br>      
      <div id="form-submit">
        <input type="submit" value="Login" />
      </div>
    </form>

      <a href="bisregister.php">
      Need an account ? <br>
      </a>
      <br>

      <a href="bischeck.php">
        Check Account Status?
      </a>
    
  </div>
</div>