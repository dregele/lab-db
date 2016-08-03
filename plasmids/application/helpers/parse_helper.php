<?php

/*********************
A script to parse genbank files for plasmids and extract
- name
- length
- sequence
- list of features (label, coordinates, type, strand)
**********************/

// open & read the file

function seqparse($seqfile){
	$gbarray = array_map('trim', explode(PHP_EOL, file_get_contents($seqfile)));
	// init seqarray
	$seqarr = array();
	$firstline = array_shift($gbarray);
	switch($firstline) {

		default:
		$seqarr = 'ERR';
		break;

		// FASTA

		case substr($firstline, 0, 1) === '>':
			$seqarr['seqname'] = substr(preg_split('/\s+/', $firstline)[0],1);
			$seqarr['sequence'] = preg_replace('/[0-9_\s]/', '', implode('',$gbarray));
			$seqarr['seqlength'] = strlen($seqarr['sequence']);
			break;

		// GENBANK
		case substr($firstline, 0, 5) === 'LOCUS':
			$info = preg_split('/\s+/', $firstline);
			$seqarr['seqname'] = $info[1];
			$seqarr['seqlength'] = $info[2];


			foreach ($gbarray as $k => $v){
				
					switch($v) {
						case substr($v, 0, 6) === '/label':

							$feat_name = substr($v, 8, -1) ;
							$feat_info = preg_split('/\s+/',$gbarray[$k-1]);
							$feat_type = $feat_info[0];
							$feat_loc = $feat_info[1];
							
							if (substr($feat_loc, 0, 10) === 'complement') {
								$feat_strand = "2";
								$feat_coord = explode('..', substr($feat_loc, 11, -1));
								}

							else {
								$feat_strand = "1";
								$feat_coord = explode("..", $feat_loc);
							} 

							$feat_start = $feat_coord[0] ;
							$feat_end = $feat_coord[1] ;
							
							$seqarr['features'][] = array(
							'feat_name' => $feat_name,
							'feat_type' => $feat_type,
							'feat_strand' => $feat_strand,
							'feat_start' => $feat_start,
							'feat_end' => $feat_end,
							);

							break;
						
						case substr($v, 0, strlen('ORIGIN')) === 'ORIGIN':
							$seqstartline = $k+1;
							break;

						case substr($v, 0, strlen('//')) === '//':
							$seqendline = $k;
							break;

						default :
							break;


					} // close switch()

			} // close foreach()

			// clean and stringify sequence
			$seqarr["sequence"] = preg_replace('/[0-9_\s]/','', implode('',array_slice($gbarray, $seqstartline, $seqendline-$seqstartline)));
			break;

		} //close switch($firstline)

	return $seqarr;

} //end function seqparse()



function seq2ap ($seqarray) {

$featarr = $seqarray['features'];
$featcount = count($featarr);
$bp = '  bp';
$plasmidradius = "180";

$apsource = <<<EOD

<style>
            #p1 {border:1px solid #ccc}
            #t1 {fill:#f0f0f0;stroke:#ccc}
            .sminor {stroke:#ccc}
            .smajor {stroke:#f00}
            .sml { fill:#999;font-size:10px }
            .smajorin { stroke:#999 }
            .marker { fill:none;stroke:#000000 }
            .arrow { fill:#555;stroke:#000000 }
            .mlabel { fill:#000;font-size:10px;font-weight:bold }
</style>
<plasmid plasmidheight="700" plasmidwidth="700" sequencelength="{$seqarray['seqlength']}">
        <plasmidtrack radius=$plasmidradius width="0" style='fill:#fafafa;stroke:#ccc'>        
            <tracklabel text="{$seqarray['seqname']}" style='font-size:25px;font-weight:bold' vadjust="300">
            </tracklabel>
            <tracklabel text="{$seqarray['seqlength']}{$bp}" vadjust="330" style='font-size:15px;'>
            </tracklabel>
            <trackscale class='sminor' direction='in' interval='500'></trackscale>
            <trackscale class='smajorin' interval='1000' direction='in' showlabels='1' labelclass='sml'></trackscale>
EOD;


foreach($featarr as $featkey => $feat) {
	
	${'feat' . $featkey . '_name'} = $feat['feat_name'];
	${'feat' . $featkey . '_start'} = $feat['feat_start'];
	${'feat' . $featkey . '_end'} = $feat['feat_end'];
	${'feat' . $featkey . '_strand'} = $feat['feat_strand'];
	${'feat' . $featkey . '_type'} = $feat['feat_type'];


	
	$featlength = $feat['feat_end'] - $feat['feat_start'];


	if ($featlength < 0) {
		$feat['length'] = $featlength + $seqarray['seqlength'];
	}

	else {
		$feat['length'] = $featlength;
	}



	$pxperbp = round( ($plasmidradius*2*pi()) / $seqarray['seqlength'] , 1 );

	$pxperfeatname = strlen($feat['feat_name'])*10+20;

	$pxperfeat = $feat['length'] * $pxperbp;

	$vadjust = strlen($feat['feat_name'])*10/2;

	$labelclass = '';

	if ($pxperfeatname > $pxperfeat) {
		$labelclass = "vadjust='$vadjust' hadjust='0' halign='outer' valign='outer' showline='1' linevadjust='-10'";
	}

	elseif ($pxperfeatname <= $pxperfeat) {
		$labelclass = "type='path'";
	
	}

	$trackarrow = '';
	$arrowthings = '';

	if ($feat['length'] > ($seqarray['seqlength']/10) ) {

		if ($feat['feat_strand'] == 1) {

			$arrowthings = "arrowendlength='5' arrowendwidth='4' arrowendangle='0'";
			
		}

		elseif ($feat['feat_strand'] == 2) {

			$arrowthings = "arrowstartlength='5' arrowstartwidth='5' arrowstartangle='0' ";
		}


		$trackarrow = "<trackmarker class='arrow' start='{$feat['feat_start']}' end='{$feat['feat_end']}' vadjust='0' wadjust='3' $arrowthings>";
	}

	$apsource .= <<<EOD
	$trackarrow
	<trackmarker class='marker' start='{$feat['feat_start']}' end='{$feat['feat_end']}' vadjust='20' wadjust='15'>
            	<markerlabel class='mlabel' text='{$feat['feat_name']}' {$labelclass}>
            	</markerlabel>
    </trackmarker>
EOD;

	
}

$apsource .= <<<EOD
</plasmidtrack>
    </plasmid>
EOD;

return $apsource;
}




?>