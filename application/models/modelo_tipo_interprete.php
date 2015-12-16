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
	
	public function obtener_nombre_tipo_interprete($idTipoInterprete)
	{
		$qSqlA = $this->db->query('SELECT nombre_tipo_interprete FROM tipo_interprete WHERE id_tipo_interprete = '.$idTipoInterprete.';');
		$row = $qSqlA->row();
		return $row->nombre_tipo_interprete;
	}
	
}