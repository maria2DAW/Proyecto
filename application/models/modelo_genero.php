<?php

class Modelo_genero extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function lista_generos()
    {
    	$qSqlA = 'SELECT * from genero ORDER BY nombre_genero';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function insertar_genero_interprete($idInterprete, $idGenero)
	{
		$campos = array(
		'id_interprete_genero' => $idInterprete,
		'genero_interprete' => $idGenero
		);
		
		$this->db->insert('genero_interprete',$campos);
	}
	
}