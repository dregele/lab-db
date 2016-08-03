<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
 
<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/_custom.css">


</style>
</head>
<body>
<!-- Beginning header -->
<div id="logo">AanstadLab</div><div id="tablename"><?php echo "$whatisthis <img height='24px' src='$whaticon'>" ?></div>
 <ul>
  <li><a href="<?php echo base_url();?>index.php/main/plasmids">Plasmids</a></li>
  <li><a href="<?php echo base_url();?>index.php/main/oligos">Oligos</a></li>
  <li><a href="http://localhost/protocols">Protocols</a></li>
  <li style="float:right"><a class="active" href="<?php echo base_url();?>index.php/auth/logout">Logout</a></li>
  <li class="texts" style="float:right"><?php echo "Logged in as $ia_user"; ?></li>  
</ul>

<!-- End of header-->
    <div>

        <?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->

<!-- End of Footer -->
</body>
</html>