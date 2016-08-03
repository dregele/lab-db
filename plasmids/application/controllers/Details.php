<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller

{

	public function showplasmid($id = 0)
	{

		if (!$this->ion_auth->logged_in())
			{
    			redirect('auth/login');
			}


    	$this->load->model('Details_model');

    	$details = $this->Details_model->get_details('plasmids', $id);

    	if($details['map_file'] != '')
    	{
    		$details['apsource'] = "<img style='height: 100%; width: 100%; object-fit: contain' src='" . base_url() . "assets/uploads/files/plasmids/maps/" . $details['map_file'] . "'/>";
    	}

    	elseif($details['seq_file'] != '' and $details['map_file'] == '')
    	{
    		$this->load->helper('parse');
    		$details['apsource'] = seq2ap(seqparse(base_url() . "assets/uploads/files/plasmids/sequences/" .$details['seq_file']));	
    	}

    	else
    	{
    		$details['apsource'] = '';
    	}	

    	$this->load->view('details_plasmids', $details);
 	
    	}
	

 



	public function showoligo($id = 0)
	{

		if (!$this->ion_auth->logged_in())
			{
    			redirect('auth/login');
			}

    	$this->load->model('Details_model');

    	$details = $this->Details_model->get_details('oligos', $id);    	

    	

    	$this->load->view('details_oligos', $details);
 	
    	}
}
