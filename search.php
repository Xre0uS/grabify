<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        <?php include 'css/styles.css'; ?>
    </style>
    <title>Grabify - Search</title>
</head>

<body>

<?php include 'php/userloginfn.php'; ?>
<div align=center>
<form action="search.php" method="get">

<!--  <input type="hidden" name="token" value="<?php// echo $token; ?>" /> -->
Search Product: <input type="text" name="search" id="search">
<input type="submit" value="Search">
<br></br>


</form>
</div>


</body>

</html>