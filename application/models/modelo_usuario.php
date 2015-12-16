<?php

class Modelo_usuario extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		//$this->load->database();
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
	
	public function comprobarUsuarioYPassword($usuarioIntroducido, $password)
    {
        //comprobamos que el nombre de usuario (o el e-mail) y contraseña coinciden
        // y que el usuario no este dado de baja
		
		$sql = "SELECT * FROM usuario WHERE nombre_registro_usuario = ? AND password_usuario = ? AND baja = ? OR email_usuario = ? AND password_usuario = ? AND baja = ?;"; 

		$query = $this->db->query($sql, array($usuarioIntroducido, $password, 0, $usuarioIntroducido, $password, 0));

        return $query->result_array();
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
	
}