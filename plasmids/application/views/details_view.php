<!DOCTYPE html>

<html lang="en">

<head>


    <meta charset="utf-8" />
 	<script type = 'text/javascript' src = "<?php echo base_url();?>assets/js/angularplasmid.complete.min.js"></script>
 	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/_custom.css">

<title><?php echo $name; ?></title>

</head>

<body>


<div id="container">

	<div id="toprow">

		<div id="entryname">#<?php echo $id . ' ' . $name; ?> </div>
	    <div class="location">Plasmid Box: <?php echo $box ?> - Glycerol Stock: <?php echo $bact_box ?> </div>
	    <div class="location">Added by <?php echo $added_by ?> on <?php echo $added_on ?></div>
	    
	    
	    <div class="location"> <?php if ($modified_by != '') { echo 'Edited by ' . $modified_by . ' on ' . $modified_on;  } ?> </div>

	</div>

	<div id="main">

	  <div id="description"> <?php if ($description != '') { echo $description; } ?> </div>
	  <?php if ($benchlink != '') { echo "<div class='fieldname'>Benchling</div><div class='fieldvalue'><a href=$benchlink> $benchlink '</a></div>"; } ?>
	  <?php if ($comment != '') { echo "<div class='fieldvalue'>Comments:<br />$comment</div>"; } ?>
	  <div id='plasmidmap'> <?php echo $apsource?> </div>
	</div>

</div>


</body>