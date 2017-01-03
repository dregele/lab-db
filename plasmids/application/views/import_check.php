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

	<h3>Entries to insert</h3>
	<p>
		<a href='index'>go back</a>
		<a href='insert_csv?table=<?php echo $table ?>'>continue</a>
	</p>
	
		<table style="width:50%;  font-family: monospace;">
			<tr style="font-weight: bold;"><?php foreach($fields as $key) {  echo "<td>" . $key . "</td>";}?></tr>
			<?php foreach($result as $row) {  echo "<tr><td>" . implode($row, "</td><td>") . "</td></tr>";}?>
		</table>
 
    </div>
<!-- Beginning footer -->

<!-- End of Footer -->
</body>
</html>