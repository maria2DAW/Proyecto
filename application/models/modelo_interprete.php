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
	
	public function insertar_solo_nombre_interprete($nombreInt, $usuarioInt)
	{
		$campos = array(
		'id_interprete' => null,
		'nombre_interprete' => $nombreInt,
		'usuario_interprete' => $usuarioInt
		);
		
		$this->db->insert('interprete',$campos);
	}
	
	public function comprobar_existencia_interprete($nombreInterprete)
	{
		$existe = false;
		
		/*$listaInterpretes = $this->lista_interpretes();
		
		foreach ($listaInterpretes as $interprete)
		{
			if($interprete->nombre_interprete == $nombreInterprete)
			{
				$existe = true;
			}
		}*/
		
		$qSqlA = 'SELECT * from interprete WHERE nombre_interprete = "'.$nombreInterprete.'";';
    	$eSqlA = $this->db->query($qSqlA);
		
		if($eSqlA->num_rows() > 0)
		{
			$existe = true;
		}
		
		return $existe;
	}
	
	public function obtener_id_interprete($nombreInterprete)
	{
		$qSqlA = $this->db->query('SELECT id_interprete from interprete where nombre_interprete = "'.$nombreInterprete.'";');
    	$row = $qSqlA->row();
		return $row->id_interprete;
	}
	
	public function obtener_id_interprete_ultimo_insert()
	{
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	public function obtener_interprete_por_nombre($nombreInterprete)
    {
    	$qSqlA = 'SELECT * from interprete WHERE nombre_interprete = '.$nombreInterprete;
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->row();
    }
	
	public function obtener_interprete_por_id($idInterprete)
    {
    	$qSqlA = 'SELECT * from interprete WHERE id_interprete = '.$idInterprete;
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function obtener_campos_interprete()
    {
		$campos = $this->db->list_fields('interprete');
		return $campos;
    }
}	
	