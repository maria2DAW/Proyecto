<?php

class Modelo_usuario extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		//$this->load->database();
	}
	
	public function lista_usuarios()
	{
		$qSqlA = 'SELECT * from usuario';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
	}
	
	public function lista_usuarios_odenada($ordenacion)
    {
    	$qSqlA = 'SELECT * from usuario ORDER BY '.$ordenacion.';';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->result();
    }
	
	public function numero_usuarios()
    {
    	$qSqlA = 'SELECT * FROM usuario';
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->num_rows();
    }
	
	public function numero_usuarios_baja($baja)
    {
    	$qSqlA = 'SELECT * FROM usuario WHERE baja = '.$baja;
    	$eSqlA = $this->db->query($qSqlA);
    	return $eSqlA->num_rows();
    }
	
	public function obtener_usuario($idUsuario)
	{
		$qSqlA = 'SELECT * FROM usuario WHERE id_usuario = '.$idUsuario;
		$eSqlA = $this->db->query($qSqlA);
		return $eSqlA->row();
	}

    public function obtener_usuario_por_registro($registroUsuario)
    {
        $qSqlA = 'SELECT * FROM usuario WHERE nombre_registro_usuario = "'.$registroUsuario.'";';
        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->row();
    }
	
	public function insertar_usuario($nombreUsu, $email, $pass, $nombre, $apellidos, $pais)
	{
		$campos = array(
				'id_usuario' => null,
				'nombre_registro_usuario' => $nombreUsu,
				'email_usuario' => $email,
				'password_usuario' => $pass,
				'nombre_usuario' => $nombre,
				'apellidos_usuario' => $apellidos,
				'pais_usuario' => $pais
		);
		
		$this->db->insert('usuario',$campos);
	}	
	
	public function modificar_usuario($idUsuario, $nombre, $apellidos, $pais)
	{
		$campos = array(
		'nombre_usuario' => $nombre,
		'apellidos_usuario' => $apellidos,
		'pais_usuario' => $pais		
        );
		
        $this->db->where('id_usuario', $idUsuario);
        return $this->db->update('usuario', $campos);
	}
	
	public function cambiar_contrasenya($idUsuario, $nuevaPass)
	{
		$campos = array('password_usuario' => $nuevaPass );
		$this->db->where('id_usuario', $idUsuario);
		return $this->db->update('usuario', $campos);
	}
	
	public function comprobarUsuarioYPassword($usuarioIntroducido, $password)
    {
        //comprobamos que el nombre de usuario (o el e-mail) y contraseña coinciden
        // y que el usuario no este dado de baja
		
		$sql = "SELECT * FROM usuario WHERE nombre_registro_usuario = ? AND password_usuario = ? AND baja = ? OR email_usuario = ? AND password_usuario = ? AND baja = ?;"; 

		$query = $this->db->query($sql, array($usuarioIntroducido, $password, 0, $usuarioIntroducido, $password, 0));

        return $query->row();
    }
	
	public function cerrarSesion()
	{
		return $this->session->sess_destroy();
	}
	
	public function obtener_id_usuario($nombreRegistroUsuario)
	{
		$qSqlA = $this->db->query('SELECT id_usuario from usuario where nombre_registro_usuario = "'.$nombreRegistroUsuario.'";');
		$row = $qSqlA->row();
		return $row->id_usuario;
	}
	
	public function obtener_nombre_usuario($idUsuario)
	{
		$qSqlA = $this->db->query('SELECT nombre_registro_usuario from usuario where id_usuario = '.$idUsuario.';');
		$row = $qSqlA->row();
		return $row->nombre_registro_usuario;
	}
	
	public function baja_usuario($idUsuario)
	{
		$campos = array(
		'baja' => 1
		);
		
		$this->db->where('id_usuario', $idUsuario);
		return $this->db->update('usuario', $campos);
	}

    public function existeSesionUsuario()
    {
        //Comprobamos si existe la variable de sesión username. En caso de no existir, le impediremos el paso a
        //la página para usuarios registrados.

        if(isset($this->session->userdata['nombreregistro']))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function usuarios_com_mas_letras_subidas($numLimit)
    {
        $qSqlA = 'SELECT u.nombre_registro_usuario, COUNT( c.usuario_cancion ) AS num_letras ';
        $qSqlA .= 'FROM cancion c, usuario u ';
        $qSqlA .= 'WHERE c.usuario_cancion = u.id_usuario ';
        $qSqlA .= 'GROUP BY u.id_usuario ';
        $qSqlA .= 'ORDER BY num_letras DESC ';
        $qSqlA .= 'LIMIT '.$numLimit;

        $eSqlA = $this->db->query($qSqlA);
        return $eSqlA->result();
    }
	
}