<?php

class Csv_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database();
        }



	function flush_tmp($tmptable) {
		
		$this->db->truncate($tmptable);
	}
	
	
	
	function insert_tmp($tmptable, $data) {
		
		$this->db->insert_batch($tmptable, $data);
	}
	
	
	
	function get_tmp($tmptable) {
		#date = date('Y-m-d', time());
		$query = $this->db->get($tmptable);		
		$result = $query->result_array();
		
		return $result;
	}
	
	
	
	function insert_csv($table, $tmptable) {
		
		// insert tmp in real table: insert $table select * from $tmptable;
		$this->db->query("INSERT INTO $table SELECT * FROM $tmptable;");
		$this->flush_tmp($tmptable);
	}
	
	
	
	function get_fields($table){
		// get fields from database
		
		$fields = $this->db->list_fields($table);
		
		return $fields;
	}
	
	
	
	
	function get_written_rows($table){
		// get rows with matching name column from csv
		// better: get n last affected rows
		
		$query = $this->db->get($table);
		
		$result = $query->result_array();
		
		return $result;
	}
	
}
// end of file