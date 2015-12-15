<?php

class Modelo_interprete extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		//$this->load->database();
    }
    
    public function lista_interpretes()
    {
    	$qSqlA = 'SELECT * from interprete';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }	
	
	public function insertar_interprete($nombreInt, $tipoInt, $generoInt, $origenInt, $biografiaInt, $imagenInt)
	{
		$campos = array(
		'id_interprete' => null,
		'nombre_interprete' => $nombreInt,
		'tipo_interprete' => $tipoInt,
		'genero_interprete' => $generoInt,
		'origen_interprete' => $origenInt,
		'biografia_interprete' => $biografiaInt,
		'imagen_interprete' => $imagenInt
		);
		
		$this->db->insert('interprete',$campos);
	}
	
	public function insertar_solo_nombre_interprete($nombreInt)
	{
		$campos = array(
		'id_interprete' => null,
		'nombre_interprete' => $nombreInt
		);
		
		$this->db->insert('interprete',$campos);
	}
	
	public function comprobar_existencia_interprete($nombreInterprete)
	{
		$existe = false;
		
		$listaInterpretes = $this->lista_interpretes();
		
		foreach ($listaInterpretes as $interprete)
		{
			if($interprete->nombre_interprete == $nombreInterprete)
			{
				$existe = true;
			}
		}
		
		return $existe;
	}
	
	public function obtener_id_interprete($nombreInterprete)
	{
		$qSqlA = $this->db->query('SELECT id_interprete from interprete where nombre_interprete = "'.$nombreInterprete.'";');
    	$row = $qSqlA->row();
		return $row->id_interprete;
	}
}	
	