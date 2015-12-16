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

    public function lista_albumes_usuario($idUsuario)
    {
        $qSqlA = "SELECT * FROM album WHERE usuario_album = ".$idUsuario;
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

	public function insertar_album($nombreAlb, $interpreteAlb, $numPistas, $anyoAlb, $informacionAlb, $imagenAlb, $usuarioAlb)
	{
		$campos = array(
		'id_album' => null,
		'nombre_album' => $nombreAlb,
		'interprete_album' => $interpreteAlb,
		'numero_pistas' => $numPistas,
		'anyo_lanzamiento' => $anyoAlb,
		'informacion_album' => $informacionAlb,
		'imagen_album' => $imagenAlb,
		'usuario_album' => $usuarioAlb
		);
		
		$this->db->insert('album',$campos);
	}

	public function insertar_solo_nombre_album($nombreAlb, $interpreteAlb, $usuarioAlb)
	{
		$campos = array(
		'id_album' => null,
		'nombre_album' => $nombreAlb,
		'interprete_album' => $interpreteAlb,
		'usuario_album' => $usuarioAlb
		);
		
		$this->db->insert('album',$campos);
	}
	
	public function comprobar_existencia_album($nombreAlbum, $interpreteAlbum)
	{
		$existe = false;
		
		$qSqlA = 'SELECT * from album WHERE nombre_album = "'.$nombreAlbum.'" AND interprete_album = '.$interpreteAlbum;
    	$eSqlA = $this->db->query($qSqlA);
		
		if($eSqlA->num_rows() > 0)
		{
			$existe = true;
		}
		
		return $existe;
	}
	
	public function obtener_id_album($interpreteAlbum, $nombreAlbum)
	{
		$qSqlA = $this->db->query('SELECT * from album WHERE nombre_album = "'.$nombreAlbum.'" AND interprete_album = '.$interpreteAlbum);
    	$row = $qSqlA->row();
		return $row->id_album;
	}
	
	public function obtener_id_album_ultimo_insert()
	{
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
}	