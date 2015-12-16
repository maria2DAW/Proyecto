<?php

class Modelo_cancion extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		//$this->load->database();
    }
    
    public function lista_canciones()
    {
    	$qSqlA = 'SELECT * FROM cancion ORDER BY nombre_cancion';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function obtenerCancion($idCancion)
    {
    	$qSqlA = 'SELECT * FROM cancion WHERE id_cancion = '.$idCancion;
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->row();
    }
	
	public function insertar_cancion($nombreCan, $albumCan, $duracionCan, $compositorCan, $comentarioCan, $enlaceYou, $usuarioCan)
	{
		$campos = array(
		'id_cancion' => null,
		'nombre_cancion' => $nombreCan,
		'album_cancion' => $albumCan,
		'duracion_cancion' => $duracionCan,
		'compositor_cancion' => $compositorCan,
		'comentario_cancion' => $comentarioCan,
		'enlace_youtube' => $enlaceYou,
		'usuario_cancion' => $usuarioCan
		);
		
		$this->db->insert('interprete',$campos);
	}
	
	public function insertar_solo_nombre_cancion($nombreCan, $albumCan, $usuarioCan)
	{
		$campos = array(
		'id_cancion' => null,
		'nombre_cancion' => $nombreCan,
		'album_cancion' => $albumCan,
		'usuario_cancion' => $usuarioCan
		);
		
		$this->db->insert('cancion',$campos);
	}
	
	public function comprobar_existencia_cancion($nombreCancion, $idAlbum, $idInterprete)
	{
		$existe = false;
		
		$qSqlA = 'SELECT * from cancion c, album a WHERE c.nombre_cancion = "'.$nombreCancion.'" AND c.album_cancion = '.$idAlbum.' AND a.interpre_album = '.$idInterprete;
    	$eSqlA = $this->db->query($qSqlA);
		
		if($eSqlA->num_rows() > 0)
		{
			$existe = true;
		}
		
		return $existe;
	}
	
	public function obtener_id_cancion($nombreCancion, $idAlbum, $idInterprete)
	{
		$qSqlA = $this->db->query('SELECT * from cancion c, album a WHERE c.nombre_cancion = "'.$nombreCancion.'" AND c.album_cancion = '.$idAlbum.' AND a.interpre_album = '.$idInterprete);
    	$row = $qSqlA->row();
		return $row->id_cancion;
	}
	
	public function obtener_id_cancion_ultimo_insert()
	{
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
}	