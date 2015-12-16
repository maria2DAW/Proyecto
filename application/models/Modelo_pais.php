<?php

class Modelo_pais extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function lista_paises()
    {
    	$qSqlA = 'SELECT * from pais ORDER BY nombre_pais';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function lista_paises_continente($continente)
    {
    	$qSqlA = 'SELECT * from pais WHERE continente_pais = "'.$continente.'" ORDER BY nombre_pais';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result_array();
    }
	
	public function lista_paises_odenada($ordenacion)
    {
    	$qSqlA = 'SELECT * from pais ORDER BY '.$ordenacion;
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }

    public function obtener_nombre_pais($idPais)
    {
        $qSqlA = 'SELECT * from pais WHERE id_pais = "'.$idPais.'";';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->row();
    }
}