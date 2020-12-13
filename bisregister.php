<head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
<?php include 'css/bislogin.css'; ?>
</style>
</head>
<div class="container">
    <h3>Grabify Business Register</h3>
    <form action="php/dobisregister.php" method="post" id="login-form">
      <div class="form-field">
        <label for="username">
          Username
        </label>
        <input type="text" name="username" id="user-name" size="50" required autofocus/>
      </div>
      
      <div class="form-field">
        <label for="password">
          Password
        </label>
        <input type="password" name="password" pattern="^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{7,}$" title="Minimum of 7 characters. Should have at least one special character and one number and one UpperCase Letter." required>      </div>

        <div class="form-field">
        <label for="cpassword">
          Confirm Password
        </label>
        <input type="password" name="cpassword" pattern="^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{7,}$" title="Minimum of 7 characters. Should have at least one special character and one number and one UpperCase Letter." required>      </div>

      <div class="form-field">
        <label for="cname">
          Company Name
        </label>
        <input type="text" name="cname" id="cname" size="50" required />
      </div>
      
            
      <div class="form-field">
        <label for="email">
          Email
        </label>
        <input type="text" name="email" id="email" size="50" required />
      </div>
            
      <div class="form-field">
        <label for="address">
          Address
        </label>
        <input type="text" name="address" id="address" size="50" required />
      </div>
                  
      <div class="form-field">
        <label for="cnumber">
          Contact Number
        </label>
        <input type="text" name="cnumber" id="cnumber" size="50" pattern="^[6,8,9]{1}[0-9]{7}$" title="Singapore Number Only without contry code. Starting With 6,8,9" required />
      </div>
      <div class="g-recaptcha" data-sitekey="6LfXJQEaAAAAALGBfXk-TjUlI8CTyBeRDWk4bZRy"></div>

      <div id="form-submit">
        <input type="submit" name="Register" value="Register"/>
      </div>
    </form>
    
    <span>
      <a href="http://localhost/grabify/bislogin.php">
      Want to Login ?
      </a>

  </div>
</div>