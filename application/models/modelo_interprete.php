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
	
	public function lista_interpretes_empiezan_por_letra($letra)
    {
    	$qSqlA = "SELECT * FROM interprete WHERE nombre_interprete LIKE '".$letra."%' ORDER BY nombre_interprete";
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function lista_interpretes_empiezan_por_numero()
    {
    	$qSqlA = "SELECT * FROM interprete WHERE nombre_interprete REGEXP '^[0-9]' ORDER BY nombre_interprete";
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function lista_interpretes_empiezan_por_otro_caracter()
    {
    	$qSqlA = "SELECT * FROM interprete WHERE nombre_interprete REGEXP '^[^[:alnum:]]' ORDER BY nombre_interprete";
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function insertar_interprete($nombreInt, $tipoInt, $origenInt, $biografiaInt, $imagenInt, $usuarioInt)
	{
		$campos = array(
		'id_interprete' => null,
		'nombre_interprete' => $nombreInt,
		'tipo_interprete' => $tipoInt,
		'origen_interprete' => $origenInt,
		'biografia_interprete' => $biografiaInt,
		'imagen_interprete' => $imagenInt,
		'usuario_interprete' => $usuarioInt
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
	