<?php

class Modelo_pais extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		//$this->load->database();
	}
	
	public function lista_paises()
    {
    	$qSqlA = 'SELECT * from pais ORDER BY nombre_pais';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
}