<!DOCTYPE html>

<html lang="en">

<head>


    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/_custom.css">


<title><?php echo $name; ?></title>

</head>

<body>


<div id="container">
	<div id="header">
		<div id="logo">AanstadLab</div>
		<div id="tablename">Oligos <img src="<?php echo base_url().'assets/grocery_crud/themes/flexigrid/css/images/oligos.png'?>"></div>
 	</div>

	<div id="toprow">
	
		<div id="entryname">#<?php echo $id . ' ' . $name; ?> </div>

	    <div class="location">Box: <?php echo $box ?></div>
	    <div class="location">Added by <?php echo $added_by ?> on <?php echo $added_on ?></div>
	    
	    
	    <div class="location"> <?php if ($modified_by != '') { echo 'Edited by ' . $modified_by . ' on ' . $modified_on;  } ?> </div>

	</div>

	<div id="main">
		<div class="fieldname">Use: </div><div class="fieldvalue"><?php echo $use_for ?></div>

		<?php if ($target != '') { echo "<div class='fieldname'>Target: </div><div class='fieldvalue'>$target</div>"; } ?>

		<div class="fieldname">Sequence</div><div class="fieldvalue"><?php echo $sequence; ?></div>

		<div id="description"> <?php if ($description != '') { echo $description; } ?> </div>

		<?php if ($pcr_conditions != '') { echo "<div class='comment'>$comment</div>"; } ?>
	</div>

</div>


</body>