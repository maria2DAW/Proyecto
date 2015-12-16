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
	
	public function obtener_tipo_interprete($idTipoInterprete)
	{
		$qSqlA = 'SELECT * FROM tipo_interprete WHERE id_tipo_interprete = '.$idTipoInterprete;
		$eSqlA = $this->db->query($qSqlA);
		return $eSqlA->row();
	}
	
	public function obtener_nombre_tipo_interprete($idTipoInterprete)
	{
		$qSqlA = $this->db->query('SELECT nombre_tipo_interprete FROM tipo_interprete WHERE id_tipo_interprete = '.$idTipoInterprete.';');
		$row = $qSqlA->row();
		return $row->nombre_tipo_interprete;
	}
	
	public function lista_tipos_interprete_odenada($ordenacion)
    {
    	$qSqlA = 'SELECT * from tipo_interprete ORDER BY '.$ordenacion.';';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function nuevo_tipo_interprete($nombreTipoInt)
    {
    	$data = array(
		'id_tipo_interprete' => null,
		'nombre_tipo_interprete' => $nombreTipoInt
		);
		
		$this->db->insert('tipo_interprete', $data);	
    }
	
	public function modificar_tipo_interprete($idTipoInt, $nombreTipoInt)
    {
    	$data = array(
		'nombre_tipo_interprete' => $nombreTipoInt
		);
		
		$this->db->where('id_tipo_interprete',$idTipoInt);
		$this->db->update('tipo_interprete', $data); 
    }

	public function eliminar_tipo_interprete($idTipoInt)
    {
    	$this->db->where('id_tipo_interprete',$idTipoInt);
		return $this->db->delete('tipo_interprete');
    }
	
}