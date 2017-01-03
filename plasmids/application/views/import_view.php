<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
 
 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/_custom.css">


</style>
</head>
<body>
<!-- Beginning header -->
<div id="logo">Import</div><div id="tablename"><?php echo $table ?></div>
 <ul>
  <li><a href="<?php echo base_url();?>index.php/main/plasmids">Plasmids</a></li>
  <li><a href="<?php echo base_url();?>index.php/main/oligos">Oligos</a></li>
  <li><a href="localhost/protocols">Protocols</a></li>
  
  <li style="float:right"><a class="active" href="<?php echo base_url();?>index.php/auth/logout">Logout</a></li>
  <li class="texts" style="float:right"><?php echo "Logged in as $ia_user"; ?></li>  
 </ul>

<!-- End of header-->


<div>
	<p>Select file to import (in <?php echo $table?>):</p>
	
	<form action="<?php echo base_url();?>index.php/import/check_csv?table=<?php echo $table?>" method="post" enctype="multipart/form-data">
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Import file" name="submit">
	</form>
 
</div>
	
	
<!-- Beginning footer -->

<!-- End of Footer -->
</body>
</html>