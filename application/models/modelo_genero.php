<?php

class Modelo_genero extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function lista_generos()
    {
    	$qSqlA = 'SELECT * from genero ORDER BY nombre_genero';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function insertar_genero_interprete($idInterprete, $idGenero)
	{
		$campos = array(
		'id_interprete_genero' => $idInterprete,
		'genero_interprete' => $idGenero
		);
		
		$this->db->insert('genero_interprete',$campos);
	}
	
	public function lista_generos_interprete($idInterprete)
    {
    	$qSqlA = 'SELECT nombre_genero FROM genero_interprete i, genero g WHERE i.id_interprete_genero = '.$idInterprete.' AND i.genero_interprete = g.id_genero';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }

	public function insertar_genero_album($idAlbum, $idGenero)
	{
		$campos = array(
		'id_album_genero' => $idAlbum,
		'genero_album' => $idGenero
		);
		
		$this->db->insert('genero_album',$campos);
	}
	
	public function lista_generos_album($idAlbum)
    {
    	$qSqlA = 'SELECT nombre_genero FROM genero_album a, genero g WHERE i.id_album_genero = '.$idAlbum.' AND a.genero_album = g.id_genero';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
}