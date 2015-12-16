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

    public function lista_canciones_usuario($idUsuario)
    {
        $qSqlA = "SELECT * FROM cancion WHERE usuario_cancion = ".$idUsuario;
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
	
	public function obtenerCancion($idCancion)
    {
    	$qSqlA = 'SELECT * FROM cancion WHERE id_cancion = '.$idCancion;
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->row();
    }

    public function lista_canciones_album($idAlbum)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM cancion c, album a ';
        $qSqlA .= 'WHERE c.album_cancion = a.id_album ';
        $qSqlA .= 'AND c.album_cancion = '.$idAlbum;
        $qSqlA .= ' ORDER BY c.nombre_cancion';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
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
		
		$qSqlA = 'SELECT * from cancion c, album a WHERE c.nombre_cancion = "'.$nombreCancion.'" AND c.album_cancion = '.$idAlbum.' AND a.interprete_album = '.$idInterprete;
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
	
	public function obtener_interprete_cancion($idCancion)
	{
		$qSqlA = $this->db->query('SELECT * FROM cancion c, album a, interprete i WHERE c.id_cancion = '.$idCancion.' AND c.album_cancion = a.id_album AND a.interprete_album = i.id_interprete');
		return $qSqlA->row();
	}

    public function obtener_album_cancion($idCancion)
    {
        $qSqlA = $this->db->query('SELECT * FROM cancion c, album a WHERE c.id_cancion = '.$idCancion.' AND c.album_cancion = a.id_album');
        return $qSqlA->row();
    }

    public function obtener_canciones_por_genero($idGenero)
    {
        $qSqlA = "SELECT * ";
        $qSqlA .= "FROM cancion c, genero g, genero_cancion x ";
        $qSqlA .= "WHERE x.genero_cancion = ".$idGenero;
        $qSqlA .= " AND x.genero_cancion = g.id_genero ";
        $qSqlA .= "AND x.id_cancion_genero = c.id_cancion ";

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function obtener_canciones_sin_genero()
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM cancion T1 ';
        $qSqlA .= 'LEFT OUTER JOIN genero_cancion T2 ';
        $qSqlA .= 'ON T1.id_cancion = T2.id_cancion_genero ';
        $qSqlA .= 'WHERE T2.id_cancion_genero IS NULL';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function lista_canciones_empiezan_por_letra($letra)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM letra_cancion l, cancion c, album a, interprete i ';
        $qSqlA .= 'WHERE l.cancion_letra = c.id_cancion ';
        $qSqlA .= 'AND c.album_cancion = a.id_album ';
        $qSqlA .= 'AND a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND c.nombre_cancion LIKE "'.$letra.'%" ';
        $qSqlA .= 'ORDER BY c.nombre_cancion';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function lista_canciones_empiezan_por_numero()
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM letra_cancion l, cancion c, album a, interprete i ';
        $qSqlA .= 'WHERE l.cancion_letra = c.id_cancion ';
        $qSqlA .= 'AND c.album_cancion = a.id_album ';
        $qSqlA .= 'AND a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND c.nombre_cancion REGEXP "^[0-9]" ';
        $qSqlA .= 'ORDER BY c.nombre_cancion';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function lista_canciones_empiezan_por_otro_caracter()
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM letra_cancion l, cancion c, album a, interprete i ';
        $qSqlA .= 'WHERE l.cancion_letra = c.id_cancion ';
        $qSqlA .= 'AND c.album_cancion = a.id_album ';
        $qSqlA .= 'AND a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND c.nombre_cancion REGEXP "^[^[:alnum:]]" ';
        $qSqlA .= 'ORDER BY c.nombre_cancion';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
}