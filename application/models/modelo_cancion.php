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
    	$qSqlA = 'SELECT * from canciones';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function insertar_cancion($nombreCan, $albumCan, $generoCan, $duracionCan, $compositorCan, $comentarioCan, $enlaceYou)
	{
		$campos = array(
		'id_cancion' => null,
		'nombre_cancion' => $nombreCan,
		'album_cancion' => $albumCan,
		'genero_cancion' => $generoCan,
		'duracion_cancion' => $duracionCan,
		'compositor_cancion' => $compositorCan,
		'comentario_cancion' => $comentarioCan,
		'enlace_youtube' => $enlaceYou
		);
		
		$this->db->insert('interprete',$campos);
	}
	
	public function insertar_solo_nombre_cancion($nombreCan)
	{
		$campos = array(
		'id_cancion' => null,
		'nombre_cancion' => $nombreCan
		);
		
		$this->db->insert('cancion',$campos);
	}
	
	public function comprobar_existencia_cancion($nombreCancion)
	{
		$existe = false;
		
		$listaCanciones = $this->lista_canciones();
		
		foreach ($listaCanciones as $cancion)
		{
			if($cancion->nombre_cancion == $nombreCancion)
			{
				$existe = true;
			}
		}
		
		return $existe;
	}
	
	public function obtener_id_cancion($nombreCancion)
	{
		$qSqlA = $this->db->query('SELECT id_cancion from cancion where nombre_cancion = "'.$nombreCancion.'";');
    	$row = $qSqlA->row();
		return $row->id_cancion;
	}
}	