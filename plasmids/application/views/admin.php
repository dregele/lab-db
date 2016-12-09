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
<h1>Admin</h1>
<ul>
  <li><a href="<?php echo base_url();?>index.php/admin/index">Users</a></li>
  <li><a href="<?php echo base_url();?>index.php/admin/groups">Groups</a></li>
  <li><a href="<?php echo base_url();?>index.php/auth/create_user">Add user</a></li>
</ul>

<!-- End of header-->
    <div>

        <?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->
After adding an user, remember to activate it.
<!-- End of Footer -->
</body>
</html>