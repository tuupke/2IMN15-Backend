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
  <h5><b>Add User</b></h5>
  </header>
  
  <form method="POST">
  Name <input type="text" name="name"><br>
  Password <input type="text" name="password"><br>
  Email <input type="text" name="email"><br>
  Facepattern <input type="text" name="facepattern"><br>
  Type <input type="text" name="type"><br>
  <input type="submit" value="submit">
  </form>
  <!-- Footer -->
<?php include("includes/footer.html");?>

  <!-- End page content -->
</div>



</body>
</html>