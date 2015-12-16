<?php

class Modelo_general extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function lista($nombreTabla)
    {
    	$qSqlA = 'SELECT * from '.$nombreTabla;
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }

    public function lista__odenada($nombreTabla, $ordenacion)
    {
        $qSqlA = 'SELECT * from '.$nombreTabla.' ORDER BY '.$ordenacion;
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

	public function insertar($nombreTabla, $arrayDatos)
	{
		$campos = $arrayDatos;
		
		$this->db->insert($nombreTabla, $campos);
	}

    public function obtener_por_campo($nombreTabla, $nombreCampo, $valorCampo)
    {
        $qSqlA = 'SELECT * from '.$nombreTabla.' WHERE '.$nombreCampo.' = '.$valorCampo;
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function obtener_por_campo_simple($nombreTabla, $nombreCampo, $valorCampo)
    {
        $qSqlA = 'SELECT * from '.$nombreTabla.' WHERE '.$nombreCampo.' = '.$valorCampo;
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->row();
    }
	
	public function obtener_id_ultimo_insert()
	{
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

    public function numero_registros($nombreTabla)
    {
        $qSqlA = 'SELECT * FROM '.$nombreTabla;
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->num_rows();
    }
}	