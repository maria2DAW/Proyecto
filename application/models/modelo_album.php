<?php

class Modelo_album extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		//$this->load->database();
    }
    
    public function lista_albumes()
    {
    	$qSqlA = 'SELECT * from album';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function insertar_album($nombreAlb, $interpreteAlb, $generoAlb, $numPistas, $anyoAlb, $informacionAlb, $imagenAlb)
	{
		$campos = array(
		'id_album' => null,
		'nombre_album' => $nombreAlb,
		'interprete_album' => $interpreteAlb,
		'genero_album' => $generoAlb,
		'numero_pistas' => $numPistas,
		'anyo_lanzamiento' => $anyoAlb,
		'informacion_album' => $informacionAlb,
		'imagen_album' => $imagenAlb
		);
		
		$this->db->insert('album',$campos);
	}
	
	public function insertar_solo_nombre_album($nombreAlb)
	{
		$campos = array(
		'id_album' => null,
		'nombre_album' => $nombreAlb
		);
		
		$this->db->insert('album',$campos);
	}
	
	public function comprobar_existencia_album($nombreAlbum)
	{
		$existe = false;
		
		$listaAlbumes = $this->lista_albumes();
		
		foreach ($listaAlbumes as $album)
		{
			if($album->nombre_album == $nombreAlbum)
			{
				$existe = true;
			}
		}
		
		return $existe;
	}
	
	public function obtener_id_album($nombreAlbum)
	{
		$qSqlA = $this->db->query('SELECT id_album from album where nombre_album = "'.$nombreAlbum.'";');
    	$row = $qSqlA->row();
		return $row->id_album;
	}
}	