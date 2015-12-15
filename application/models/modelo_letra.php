<?php

class Modelo_letra extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		//$this->load->database();
    }
    
    function lista_letras()
    {
    	$qSqlA = 'SELECT * from letra_cancion';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
}	