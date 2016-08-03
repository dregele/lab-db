<?php
class Details_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_details($table, $id)

	{

  		if($id != FALSE)

  		{
    		$query = $this->db->get_where($table, array('id' => $id));

    		return $query->row_array();
  		}

  		else
  		{

    		return FALSE;
  		}

	}

}


