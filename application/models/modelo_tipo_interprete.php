<?php

class Modelo_tipo_interprete extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		//$this->load->database();
	}
	
	public function lista_tipos_interprete()
    {
    	$qSqlA = 'SELECT * from tipo_interprete';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
}