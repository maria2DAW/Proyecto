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
	
	public function insertar_letra($cancionLetra, $contenidoLetra, $contenidoLetraSinHtml)
	{
		$campos = array(
		'id_letra_cancion' => null,
		'cancion_letra' => $cancionLetra,
		'contenido_letra' => $contenidoLetra,
        'contenido_letra_sin_html' => $contenidoLetraSinHtml
		);
		
		$this->db->insert('letra_cancion',$campos);
	}

    public function actualizar_visitas($idLetra, $arrayDatos)
    {
        $campos = $arrayDatos;

        $this->db->where('id_letra_cancion', $idLetra);
        $this->db->update('letra_cancion', $campos);
    }
	
	public function eliminar_letra($idLetra)
	{
		$this->db->where('id_letra_cancion', $idLetra);
		$this->db->delete('letra_cancion');
	}

    public function letras_mas_visitadas($numLimit)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM letra_cancion l, cancion c ';
        $qSqlA .= 'WHERE l.cancion_letra = c.id_cancion ';
        $qSqlA .= 'ORDER BY l.visitas_letra DESC ';
        $qSqlA .= 'LIMIT '.$numLimit;

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function busqueda_existencia_en_cancion($cadenaBusqueda)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM letra_cancion l, cancion c, album a, interprete i ';
        $qSqlA .= 'WHERE l.cancion_letra = c.id_cancion ';
        $qSqlA .= 'AND c.album_cancion = a.id_album ';
        $qSqlA .= 'AND a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND l.contenido_letra_sin_html LIKE "%'.$cadenaBusqueda.'%" ';
        $qSqlA .= 'ORDER BY c.nombre_cancion';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function busqueda_cancion_por_titulo($cadenaBusqueda)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM letra_cancion l, cancion c, album a, interprete i ';
        $qSqlA .= 'WHERE l.cancion_letra = c.id_cancion ';
        $qSqlA .= 'AND c.album_cancion = a.id_album ';
        $qSqlA .= 'AND a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND c.nombre_cancion LIKE "%'.$cadenaBusqueda.'%" ';
        $qSqlA .= 'ORDER BY c.nombre_cancion';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function busqueda_cancion_por_album($cadenaBusqueda)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM letra_cancion l, cancion c, album a, interprete i ';
        $qSqlA .= 'WHERE l.cancion_letra = c.id_cancion ';
        $qSqlA .= 'AND c.album_cancion = a.id_album ';
        $qSqlA .= 'AND a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND a.nombre_album LIKE "%'.$cadenaBusqueda.'%" ';
        $qSqlA .= 'ORDER BY c.nombre_cancion';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

    public function busqueda_cancion_por_interprete($cadenaBusqueda)
    {
        $qSqlA = 'SELECT * ';
        $qSqlA .= 'FROM letra_cancion l, cancion c, album a, interprete i ';
        $qSqlA .= 'WHERE l.cancion_letra = c.id_cancion ';
        $qSqlA .= 'AND c.album_cancion = a.id_album ';
        $qSqlA .= 'AND a.interprete_album = i.id_interprete ';
        $qSqlA .= 'AND i.nombre_interprete LIKE "%'.$cadenaBusqueda.'%" ';
        $qSqlA .= 'ORDER BY c.nombre_cancion';

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }

}