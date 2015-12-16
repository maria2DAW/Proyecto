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

    public function lista_albumes_interprete($idInterprete)
    {
        $qSqlA = "SELECT * ";
        $qSqlA.= "FROM album a, interprete i ";
        $qSqlA.= "WHERE a.interprete_album = i.id_interprete ";
        $qSqlA.= "AND a.interprete_album = ".$idInterprete;
        $qSqlA.= " ORDER BY a.nombre_album";

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

    public function obtener_album_por_id($idAlbum)
    {
        $qSqlA = 'SELECT * from album WHERE id_album = '.$idAlbum;
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->row();
    }

    public function obtener_interprete_album($idAlbum)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM album a, interprete i ';
        $qSqlA .= 'WHERE a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND a.id_album = '.$idAlbum;
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->row();
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

    public function lista_albumes_empiezan_por_letra($letra)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM album a, interprete i ';
        $qSqlA .= 'WHERE a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND a.nombre_album LIKE "'.$letra.'%" ';
        $qSqlA .= 'ORDER BY a.nombre_album';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function lista_albumes_empiezan_por_numero()
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM album a, interprete i ';
        $qSqlA .= 'WHERE a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND a.nombre_album REGEXP "^[0-9]" ';
        $qSqlA .= 'ORDER BY a.nombre_album';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function lista_albumes_empiezan_por_otro_caracter()
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM album a, interprete i ';
        $qSqlA .= 'WHERE a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND a.nombre_album REGEXP "^[^[:alnum:]]" ';
        $qSqlA .= 'ORDER BY a.nombre_album';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
}	