<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>Grabify Admin</title>
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/adminmanage.js"></script>
</head>

<style>
  <?php include 'css/styles.css'; ?><?php include 'css/admin.css'; ?>
</style>

<body>
  <?php include 'php/navbar.php'; ?>

  <div id="adminFnWrapper" class="adminFnWrapper" style="display: none;">
    <?php include 'php/masteradmin.php'; ?>
  </div>

  <div id="bisAdminFnWrapper" class="adminFnWrapper" style="display: none;">
    <?php include 'php/businessadmin.php'; ?>
  </div>

  <div id="userAdminFnWrapper" class="adminFnWrapper" style="display: none;">
    <?php include 'php/useradmin.php'; ?>
  </div>

</body>

<script>
  $(document).ready(function() {
    verifyAdmin();
  });
</script>