<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
<title>Home page – My Website</title>
<meta http-equiv="description" content="page description" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style type="text/css">@import "styles.css";</style>
</head>

<body>

<?php include("includes/header.html");?>
<?php include("includes/nav.html");?>

<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b>Configure Sensors</b></h5>
  </header>


  <div class="w3-container w3-padding-16">
  <form method="POST">
  X position <input type="text" name="x_pos"><br>
  Y position <input type="text" name="y_pos"><br>
  <input type="submit" value="Add Sensor">
  </div>
  
  <div class="w3-container w3-padding-16"
  <form method="UPDATE">
  Sensor name <input type="text" name="s_name"><br>
  X position <input type="text" name="x_pos"><br>
  Y position <input type="text" name="y_pos"><br>
  <input type="submit" value="Change Sensor">
  </div>
  
  <div class="w3-container w3-padding-16">
  <form method="DELETE">
  X position <input type="text" name="x_pos"><br>
  Y position <input type="text" name="y_pos"><br>
  <input type="submit" value="Remove Sensor">
  </div>

  <!-- Footer -->
<?php include("includes/footer.html");?>

  <!-- End page content -->
</div>



</body>
</html>