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
	<div id="header">
	<a href="<?php echo base_url();?>index.php/main/plasmids">
		<div id="logo">AanstadLab</div>
		<div id="tablename">Plasmids<img height='24px' src="<?php echo base_url().'assets/grocery_crud/themes/flexigrid/css/images/plasmids.svg'?>"></div>
	</a>
 	</div>

	<div id="toprow">

		<div id="entryname">#<?php echo $id . ' ' . $name; ?> </div>

		<div class="location">

			Plasmid Box: <?php echo $box ?> - Glycerol Stock: <?php echo $bact_box ?>
			
			
		</div>
		
		<?php if ($benchlink != '') { echo "<div><p><a href=$benchlink>Benchling</a></p></div>"; } ?>
		
		<div id="info">	    

	    	<p><?php if (!$added_by=='') {echo "Added by " .  $added_by . " on "; } else {echo "Added on ";} ?> <?php echo $added_on ?><?php if ($modified_by != '') { echo ' / Edited by ' . $modified_by . ' on ' . $modified_on;  } ?> </p>
	    	

	    </div>
	    
	    
	    <hr />

	</div>

	<div id="main">



	  <div id="description"> <?php if ($description != '') { echo $description; } ?> </div>

	  <div class="fieldname">Source/Reference</div><div class="fieldvalue"><?php echo $source; ?></div>
	  
	  <div class="fieldname">Antibiotic selection</div><div class="fieldvalue"><?php echo $bact_sel; ?></div>


 	  <?php if ($lin_asrna != '' and $asrna_prom != '') { echo "<div class='fieldname'>for antisense RNA:</div><div class='fieldvalue'>Linearize with <em>$lin_asrna</em> and use <em>$asrna_prom</em> RNA polymerase</div>"; } ?>

 	  <?php if ($lin_srna != '' and $other_prom != '') { echo "<div class='fieldname'>for sense mRNA:</div><div class='fieldvalue'>Linearize with <em>$lin_srna</em> and use <em>$other_prom</em> RNA polymerase</div>"; } ?>
 	  	</hr>

	  <?php if ($comment != '') { echo "<div class='fieldvalue longfield'>$comment</div>"; } ?>
	<div id='plasmidmap'> <?php echo $apsource?> </div>
	</div>

</div>


</body>