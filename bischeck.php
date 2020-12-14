<script src="https://www.google.com/recaptcha/api.js" async defer></script>


<style>
<?php include 'css/bislogin.css'; ?>

</style>
<form action="php/dobischeck.php" method="post">
<div class="container">

      <div class="form-field">
      <h1>Grabify</h1>
      <h3> Enter Your Username and Password to check your business status </h3>

        <label for="username">
          Username
        </label>
        <input type="text" name="username" id="username" size="50" required autofocus/>
        <br>
        <br>
        <label for="password">
          Password
        </label>
        <input type="password" name="password" id="password" size="50" required autofocus/>
        <br>
        <br>
        <div class="g-recaptcha" data-sitekey="6LfXJQEaAAAAALGBfXk-TjUlI8CTyBeRDWk4bZRy"></div>
        <br>

		<input style=background-color:lightgreen type="submit" value="Check Account Status" />
      </div>
</form>

<a href="bislogin.php">
        Want to Login?
      </a>
</div>



