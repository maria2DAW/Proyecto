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
		$this->load->model('modelo_pais','mod_pais');
		$this->load->model('modelo_tipo_interprete','mod_tipo_int');
		$this->load->model('modelo_genero','mod_gen');
	}
	
	public function index() 
	{		
		$data['title'] = "Inicio";
		$data['main_content'] = 'inicio';
		$this->load->view('plantillas/template', $data);
	}
	
	public function formularioNuevoInterprete() 
	{
		$data['listaTiposInterprete'] = $this->mod_tipo_int->lista_tipos_interprete();
		
		$data['listaGeneros'] = $this->mod_gen->lista_generos();
		
		$data['title'] = "Nuevo Intérprete";
		$data['main_content'] = 'formularioNuevoInterprete';
		$this->load->view('plantillas/template', $data);
	}
	
	public function guardar_datos_interprete()
	{
		$nombreInt = $this->input->post('nomInt');
		$tipoInt = $this->input->post('tipoInt');
		$origenInt = $this->input->post('orgInt');
		$biografiaInt = $this->input->post('bioInt');
		$imagenInt = $this->input->post('imgInt');
		
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
		
		$this->mod_int->insertar_interprete($nombreInt, $tipoInt, $origenInt, $biografiaInt, $imagenInt, $codigoUsuario);
		
		$idInsertInterprete = $this->mod_int->obtener_id_interprete_ultimo_insert();
		$data["idInsertInterprete"] = $idInsertInterprete;
		
		$generosInterprete = $this->input->post('genInt');
		
		foreach($generosInterprete as $generoInte)
		{
			$this->mod_gen->insertar_genero_interprete($idInsertInterprete, $generoInte);
		}
		
		$data['title'] = "Datos intérprete";
		$data['main_content'] = 'haciendoPruebas';
		$this->load->view('plantillas/template', $data);
	}
	
	public function formularioNuevoAlbum() 
	{		
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
	
	public function formularioLoguear() 
	{		
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
		
		$this->formularioLoguear();
	}
	
	public function formularioRegistro() 
	{
		$listaContinentes = array('Asia','Africa','Europe','North America','Oceania','South America');
		$data['listaContinentes'] = $listaContinentes;
		
		$listaPaisesContinente = array();
		
		for($i = 0; $i < count($listaContinentes); $i++)
		{
			$listaPais = $this->mod_pais->lista_paises_continente($listaContinentes[$i]);
			array_push($listaPaisesContinente, $listaPais); 
		}
		
		$data['listaPaisesContinente'] = $listaPaisesContinente;
	
		$data['title'] = "Registro";
		$data['main_content'] = 'registroUsuario';
		$this->load->view('plantillas/template', $data);
	}
	
	public function guardar_datos_usuario()
	{
		$this->form_validation->set_rules('nombreUsuario', 'nombre de usuario', 'required|min_length[5]|max_length[20]|trim|is_unique[usuario.nombre_registro_usuario]');
		$this->form_validation->set_rules('passUsuario', 'contraseña', 'required|exact_length[12]|trim|matches[pass2Usuario]|md5');
        $this->form_validation->set_rules('pass2Usuario', 'repetir contraseña', 'required|trim|md5');
        $this->form_validation->set_rules('nombre', 'nombre', 'required|trim|alpha');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required|trim|alpha');
        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email|trim|is_unique[usuario.email_usuario]');

        $this->form_validation->set_message('required', 'Debe introducir el campo %s');
        $this->form_validation->set_message('valid_email', 'Dirección de e-mail no válida');
        $this->form_validation->set_message('matches', 'Los campos %s y %s no coinciden');
        $this->form_validation->set_message('alpha','El campo %s debe estar compuesto sólo por letras');
        $this->form_validation->set_message('min_length','El campo %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length','El campo %s debe tener como máximo %s carácteres');
        $this->form_validation->set_message('exact_length','El campo %s debe tener %s carácteres');
        $this->form_validation->set_message('is_unique','Este %s ya está registrado');
		
		if($this->form_validation->run() == false)
		{
			$this->formularioRegistro();
		}
		
		else 
		{			
			$nombreUsu = $this->input->post('nombreUsuario');
			$email = $this->input->post('email');
			$pass = $this->input->post('passUsuario');
			$nombre = $this->input->post('nombre');
			$apellidos = $this->input->post('apellidos');
			$pais = $this->input->post('pais');
			
			$this->mod_usu->insertar_usuario($nombreUsu, $email, $pass, $nombre, $apellidos, $pais);
			
			$this->index();
		}
	}
	
	public function indice_interpretes()
	{		
		$data['title'] = "Índice de intérpretes";
		$data['main_content'] = 'indiceInterpretes';
		$this->load->view('plantillas/template', $data);
	}
	
	public function interpretes_por_indice_simbolo()
	{
		$data['listaInterpretesPorSimbolo'] = $this->mod_int->lista_interpretes_empiezan_por_otro_caracter();
		
		$this->load->view('vistaInterpretesPorIndiceSimbolo',$data);
	}
	
	public function interpretes_por_indice_numero()
	{
		$data['listaInterpretesPorNumero'] = $this->mod_int->lista_interpretes_empiezan_por_numero();
		
		$this->load->view('vistaInterpretesPorIndiceNumero',$data);
	}
	
	public function interpretes_por_indice_letra($letra)
	{
		$data['listaInterpretesPorLetra'] = $this->mod_int->lista_interpretes_empiezan_por_letra($letra);
		$data['letra'] = $letra;
		
		$this->load->view('vistaInterpretesPorIndiceLetra',$data);
	}
	
	public function vista_info_interpretes($idInterprete)
	{
		$data['infoInterpretes'] = $this->mod_int->obtener_interprete_por_id($idInterprete);
		$data['tipoInterprete'] = $this->mod_tipo_int->obtener_nombre_tipo_interprete($data['infoInterpretes'][0]->tipo_interprete);
		$data['usuarioInterprete'] = $this->mod_usu->obtener_nombre_usuario($data['infoInterpretes'][0]->usuario_interprete);
		
		//$camposInt = $this->mod_int->obtener_campos_interprete();
		
		$data['title'] = "Información de ".$data['infoInterpretes'][0]->nombre_interprete;
		$data['main_content'] = 'vistaInformacionInterprete';
		$this->load->view('plantillas/template', $data);
	}
	
	public function vista_anyadir_letra()
	{
		$data['title'] = "Añadir una nueva letra";
		$data['main_content'] = 'vistaAnyadirLetra';
		$this->load->view('plantillas/template', $data);
	}
	
	public function guardar_datos_letra()
	{
		$nombreInterpreteCancion = $this->input->post('intCan'); //Nombre del intérprete
		$albumCancion = $this->input->post('albCan');
		$tituloCancion = $this->input->post('titCan');
		$letraCancion = $this->input->post('letraCancion');
		
		$nombreUsuario = $this->session->userdata['nombreregistro'];
		$codigoUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);
		
		$idInt = "";
		$idAlb = "";
		
		if($this->mod_int->comprobar_existencia_interprete($nombreInterpreteCancion))
		{
			$idInt = $this->mod_int->obtener_id_interprete($nombreInterpreteCancion);
		}
		
		else
		{
			$this->mod_int->insertar_solo_nombre_interprete($nombreInterpreteCancion, $codigoUsuario);
			$idInt = $this->mod_int->obtener_id_interprete_ultimo_insert();
		}
		
		if($this->mod_alb->comprobar_existencia_album($idInt, $albumCancion))
		{
			$idAlb = $this->mod_alb->obtener_id_album($idInt, $albumCancion);
		}
		
		else
		{
			$this->mod_alb->insertar_solo_nombre_album($albumCancion, $idInt, $codigoUsuario);
			$idAlb = $this->mod_alb->obtener_id_album_ultimo_insert();
		}
		
		$this->mod_can->insertar_solo_nombre_cancion($tituloCancion, $idAlb, $codigoUsuario);
		$idCan = $this->mod_can->obtener_id_cancion_ultimo_insert();
		
		$this->mod_let->insertar_letra($idCan, $letraCancion);
		
		$this->index();
	}
	
	public function indice_letras()
	{
		$data['listaCanciones'] = $this->mod_can->lista_canciones();
		
		$data['title'] = "Índice de letras";
		$data['main_content'] = 'indiceLetras';
		$this->load->view('plantillas/template', $data);
	}
	
	public function mostrar_letra($idCancion)
	{
		$data['cancionObtenida'] = $this->mod_can->obtenerCancion($idCancion);
		$data['letraObtenida'] = $this->mod_let->obtenerLetra($idCancion);
		
		$data['title'] = $data['cancionObtenida']->nombre_cancion;
		$data['main_content'] = 'mostrarLetra';
		$this->load->view('plantillas/template', $data);
	}
	
	
}	