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
	
	public function insertar_letra($cancionLetra, $contenidoLetra, $usuarioLetra)
	{
		$campos = array(
		'id_letra_cancion' => null,
		'cancion_letra' => $cancionLetra,
		'contenido_letra' => $contenidoLetra,
		'usuario_letra' => $usuarioLetra,
		);
		
		$this->db->insert('letra_cancion',$campos);
	}
}