<?php

class Modelo_letra extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		//$this->load->database();
    }
    
    public function lista_letras()
    {
    	$qSqlA = 'SELECT * from letra_cancion';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function obtenerLetra($idCancion)
    {
    	$qSqlA = 'SELECT * FROM letra_cancion WHERE cancion_letra = '.$idCancion;
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->row();
    }
	
	public function insertar_letra($cancionLetra, $contenidoLetra)
	{
		$campos = array(
		'id_letra_cancion' => null,
		'cancion_letra' => $cancionLetra,
		'contenido_letra' => $contenidoLetra,
		);
		
		$this->db->insert('letra_cancion',$campos);
	}
	
	public function eliminar_letra($idLetra)
	{
		$this->db->where('id_letra_cancion', $idLetra);
		$this->db->delete('letra_cancion');
	}
}