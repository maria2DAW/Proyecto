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
        //comprobamos que el nombre de usuario y contraseña coinciden
        // y que el usuario no este dado de baja

        /*$data = array(
            'nombreregistro' => $nombreUsuario,
            'passwordusuario' => $password,
        	'baja'=> 0
        );

        $query = $this->db->get_where('usuario',$data);*/
		
		$this->db->where('nombre_registro_usuario', $usuarioIntroducido);
		$this->db->or_where('email_usuario', $usuarioIntroducido);
		$this->db->where('baja', 0);
		$query = $this->db->get('usuario');

        return $query->result_array();
    }
	
	public function cerrarSesion()
	{
		return $this->session->sess_destroy();
	}
	
}