<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador_principal extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('modelo_interprete','mod_int');
		$this->load->model('modelo_album','mod_alb');
		$this->load->model('modelo_cancion','mod_can');
		$this->load->model('modelo_letra','mod_let');
		$this->load->model('modelo_usuario','mod_usu');
	}
	
	public function index() 
	{
		
		$data['title'] = "Inicio";
		$data['main_content'] = 'inicio';
		$this->load->view('plantillas/template', $data);
	}
	
	public function formularioNuevoInterprete() 
	{
		$data['title'] = "Nuevo Intérprete";
		$data['main_content'] = 'formularioNuevoInterprete';
		$this->load->view('plantillas/template', $data);
	}
	
	public function guardar_datos_interprete()
	{
		$nombreInt = $this->input->post('nomInt');
		$tipoInt = $this->input->post('tipoInt');
		$generoInt = $this->input->post('genInt');
		$origenInt = $this->input->post('orgInt');
		$biografiaInt = $this->input->post('bioInt');
		$imagenInt = null;
		
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width']  = '1080';
		$config['max_height']  = '1024';
		$config['max_filename'] = '200';
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('imgInt'))
        {
			$datosImagenSubida  = $this->upload->data();			
			$imagenInt = $datosImagenSubida['file_name'];
		}
		
		/*else
		{
			$data['title'] = "Intérprete no añadido";
			$data['main_content'] = 'formularioNuevoInterprete';
			$this->load->view('plantillas/template', $data);
		}*/
		
		$nombreUsuario = $this->session->userdata['nombreregistro'];
		$codigoUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);
		
		$this->mod_int->insertar_interprete($nombreInt, $tipoInt, $generoInt, $origenInt, $biografiaInt, $imagenInt, $codigoUsuario);
		
		$data['title'] = "Inicio";
		$data['main_content'] = 'inicio';
		$this->load->view('plantillas/template', $data);
	}
	
	public function formularioNuevoAlbum() {
		
		$data['title'] = "Nuevo Álbum";
		$data['main_content'] = 'formularioNuevoAlbum';
		$this->load->view('plantillas/template', $data);
	}
	
	public function guardar_datos_album()
	{		
		$nombreAlb = $this->input->post('nomAlb');
		$InterpreteAlb = $this->input->post('intAlb');
		$generoAlb = $this->input->post('genAlb');
		$numeroPis = $this->input->post('numPis');
		$anyoLan = $this->input->post('anLan');
		$informacionAlb = $this->input->post('infAlb');
		$imagenAlb = null;
		
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['max_width']  = '1080';
		$config['max_height']  = '1024';
		$config['max_filename'] = '200';
		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('imgAlb'))
        {
			$datosImagenSubida  = $this->upload->data();			
			$imagenAlb = $datosImagenSubida['file_name'];			
		}
		
		/*else
		{
			$data['title'] = "Álbum no añadido";
			$data['main_content'] = 'formularioNuevoAlbum';
			$this->load->view('plantillas/template', $data);
		}*/
		
		if ( !$this->mod_int->comprobar_existencia_interprete($InterpreteAlb))
		{
			$this->mod_int->insertar_solo_nombre_interprete($InterpreteAlb);
		}
		
		$codigoInterprete = $this->mod_int->obtener_id_interprete($InterpreteAlb);
		
		$nombreUsuario = $this->session->userdata['nombreregistro'];
		$codigoUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);
		
		$this->mod_alb->insertar_album($nombreAlb, $codigoInterprete, $generoAlb, $numeroPis, $anyoLan, $informacionAlb, $imagenAlb, $codigoUsuario);
		
		$data['title'] = 'Inicio';
		$data['main_content'] = 'inicio';
		$this->load->view('plantillas/template', $data);
	}
	
	public function formularioLoguear() {
		
		$data['title'] = "Login";
		$data['main_content'] = 'formLogin';
		$this->load->view('plantillas/template', $data);
	}
	
	public function logear()
	{
        $pass = $this->input->post('passUsu');

        $this->form_validation->set_error_delimiters('<div>','</div>');

		$this->form_validation->set_rules('nomUsu', 'nombre de usuario', 'required|callback_validarUsuarioYPassword['.$pass.']');
		$this->form_validation->set_rules('passUsu', 'contraseña', 'required');

		$this->form_validation->set_message('required', 'Debe introducir el campo %s');
        $this->form_validation->set_message('validarUsuarioYPassword', 'Nombre de usuario o contraseña incorrecto');

		if($this->form_validation->run() == false)
		{
			$data['title'] = 'Errores';
			$data['main_content'] = 'formLogin';
			$this->load->view('plantillas/template', $data);
		}
		
		else
		{
            $datos_sesion = array(
                    'nombreregistro' => $this->input->post('nomUsu'),
                    'passwordusuario' => $pass
            );

            $this->session->set_userdata($datos_sesion);
			
			$data['title'] = $this->session->userdata['nombreregistro'];
			$data['main_content'] = 'panelUsuario';
			$this->load->view('plantillas/template', $data);
		}
	}
	
	public function validarUsuarioYPassword($nomUsuario, $passUsuario)
    {
        $loginValido = $this->mod_usu->comprobarUsuarioYPassword($nomUsuario, $passUsuario);

        if($loginValido)
        {
			//echo $loginValido[0]['nombre_usuario'];			
            return true;
        }

        else
        {
            return false;			
        }
    }
	
	public function cerrarSesion()
	{
		$this->mod_usu->cerrarSesion();
		
		$data['title'] = "Login";
		$data['main_content'] = 'formLogin';
		$this->load->view('plantillas/template', $data);
	}
}	