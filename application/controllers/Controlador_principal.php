<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador_principal extends CI_Controller {

    /**
     * @var Array que contiene las variables generales
     */
    private $data;
	
	public function __construct()
	{
		parent::__construct();

        $this->data = array();

        $this->load->model('Modelo_general','mod_general');
		$this->load->model('Modelo_interprete','mod_int');
		$this->load->model('Modelo_album','mod_alb');
		$this->load->model('Modelo_cancion','mod_can');
		$this->load->model('Modelo_letra','mod_let');
		$this->load->model('Modelo_usuario','mod_usu');
		$this->load->model('Modelo_pais','mod_pais');
		$this->load->model('Modelo_tipo_interprete','mod_tipo_int');
		$this->load->model('Modelo_genero','mod_gen');

        if(! $this->mod_usu->existeSesionUsuario())
        {
            $this->data['login'] = 'LOG IN';
            $this->data['enlaceLogin'] = 'formularioLoguear';
        }

        else
        {
            $this->data['login'] = $this->session->userdata['nombreregistro'];


                $this->data['enlaceLogin'] = 'logear';
        }
	}

    public function establecerContenidoPrincipal($title, $contenido)
    {
        $this->data['title'] = $title;
        $this->data['main_content'] = $contenido;
        $this->load->view('plantillas/template', $this->data);
    }
	
	public function index() 
	{		
		$this->establecerContenidoPrincipal("Inicio", "inicio");
	}
	
	public function formularioNuevoInterprete() 
	{
        $this->data['listaTiposInterprete'] = $this->mod_tipo_int->lista_tipos_interprete();

        $this->data['listaGeneros'] = $this->mod_gen->lista_generos();

        $this->establecerContenidoPrincipal("Nuevo Intérprete", "formularioNuevoInterprete");
	}

	function alpha_space($str)
	{
		//return ( ! preg_match("/^[a-zñÑáéíóúÁÉÍÓÚ ]+$/i", $str)) ? FALSE : TRUE;

       $validacion = FALSE;

        if(preg_match("/^[a-zñÑáéíóúÁÉÍÓÚ ]+$/i", $str) || empty($str))
        {
            $validacion = TRUE;
        }

        return $validacion;

	} 
	
	public function guardar_datos_interprete()
	{
		
		$this->form_validation->set_rules('nomInt', 'nombre de intérprete', 'trim|required|max_length[50]|is_unique[interprete.nombre_interprete]');
		$this->form_validation->set_rules('orgInt', 'origen de intérprete', 'trim|max_length[50]|callback_alpha_space');
		
        $this->form_validation->set_message('required', 'Debe introducir el campo %s');
        $this->form_validation->set_message('max_length','El campo %s debe tener como máximo %s carácteres');
        $this->form_validation->set_message('is_unique','Este %s ya existe');
		$this->form_validation->set_message('alpha_space', 'El campo %s debe estar compuesto sólo por letras');
		
		if(!$this->form_validation->run())
		{
			$this->formularioNuevoInterprete();
		}
		
		else
		{
            $datosInterprete = array(
                'nombre_interprete' => $this->input->post('nomInt'),
                'tipo_interprete' => $this->input->post('tipoInt'),
                'origen_interprete' => $this->input->post('orgInt'),
                'biografia_interprete' => $this->input->post('bioInt')
            );
			
			//Subir imagen
			
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

                $datosInterprete['imagen_interprete'] = $imagenInt;
			}
			
			//Se inserta el intérprete
			
			$nombreUsuario = $this->session->userdata['nombreregistro'];
            $codigoUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);
            $datosInterprete['usuario_interprete'] = $codigoUsuario;
			
			$this->mod_general->insertar("interprete", $datosInterprete);
			
			//Géneros seleccionados			
			
			$idInsertInterprete = $this->mod_general->obtener_id_ultimo_insert();
			
			$generosInterprete = $this->input->post('genInt');
			
			if(count($generosInterprete) > 0)
			{
				foreach($generosInterprete as $generoInte)
				{
					$this->mod_gen->insertar_genero_interprete($idInsertInterprete, $generoInte);
				}
			}
			
			$this->gestion_interpretes();
		}
	}
	
	public function formularioNuevoAlbum() 
	{		
		/*$data['title'] = "Nuevo Álbum";
		$data['main_content'] = 'formularioNuevoAlbum';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal("Nuevo Álbum", "formularioNuevoAlbum");
	}
	
	//Arreglar función
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
		
		/*$data['title'] = 'Inicio';
		$data['main_content'] = 'inicio';
		$this->load->view('plantillas/template', $data);*/

        $this->index();
	}
	
	public function formularioLoguear() 
	{
        $this->establecerContenidoPrincipal('Login', 'formLogin');
	}
	
	public function logear()
	{
        $pass = $this->input->post('passUsu');

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$this->form_validation->set_rules('nomUsu', 'nombre de usuario', 'required|callback_validarUsuarioYPassword['.$pass.']');
		$this->form_validation->set_rules('passUsu', 'contraseña', 'required');

		$this->form_validation->set_message('required', 'Debe introducir el campo %s');
        $this->form_validation->set_message('validarUsuarioYPassword', 'Nombre de usuario o contraseña incorrecto');

		if($this->form_validation->run() == false)
		{
            $data['main_content'] = 'indiceInterpretes';
			$this->formularioLoguear();
		}
		
		else
		{
            $datos_sesion = array(
                    'nombreregistro' => $this->input->post('nomUsu'),
                    'passwordusuario' => $pass
            );

            $this->session->set_userdata($datos_sesion);
			
			$nombreUsuario = $this->session->userdata['nombreregistro'];
			
			//$data['title'] = $nombreUsuario;
			
			if($nombreUsuario == 'ADMIN')
			{
				$main_content = 'panelAdmin';
			}
			
			else
			{
				$main_content = 'panelUsuario';
			}
			
			
			/*$data['main_content'] = $main_content;
			$this->load->view('plantillas/template', $data);*/

            $this->establecerContenidoPrincipal($nombreUsuario, $main_content);
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
        $this->data['listaContinentes'] = $listaContinentes;
		
		$listaPaisesContinente = array();
		
		for($i = 0; $i < count($listaContinentes); $i++)
		{
			$listaPais = $this->mod_pais->lista_paises_continente($listaContinentes[$i]);
			array_push($listaPaisesContinente, $listaPais); 
		}

        $this->data['listaPaisesContinente'] = $listaPaisesContinente;

        $this->establecerContenidoPrincipal('Registro', 'formRegistroUsuario');
	}
	
	public function guardar_datos_usuario()
	{
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$this->form_validation->set_rules('nombreUsuario', 'nombre de usuario', 'required|min_length[5]|max_length[20]|trim|is_unique[usuario.nombre_registro_usuario]');
		$this->form_validation->set_rules('passUsuario', 'contraseña', 'required|exact_length[12]|trim|matches[pass2Usuario]|md5');
        $this->form_validation->set_rules('pass2Usuario', 'repetir contraseña', 'required|trim|md5');
        $this->form_validation->set_rules('nombre', 'nombre', 'required|trim|callback_alpha_space');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required|trim|callback_alpha_space');
        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email|trim|is_unique[usuario.email_usuario]');

        $this->form_validation->set_message('required', 'Debe introducir el campo %s');
        $this->form_validation->set_message('valid_email', 'Dirección de e-mail no válida');
        $this->form_validation->set_message('matches', 'Los campos %s y %s no coinciden');
        $this->form_validation->set_message('alpha_space','El campo %s debe estar compuesto sólo por letras');
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
		/*$data['title'] = "Índice de intérpretes";
		$data['main_content'] = 'indiceInterpretes';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Índice de intérpretes', 'indiceInterpretes');
	}
	
	public function interpretes_por_indice_simbolo()
	{
        $this->data['listaInterpretesPorSimbolo'] = $this->mod_int->lista_interpretes_empiezan_por_otro_caracter();
		
		$this->load->view('vistaInterpretesPorIndiceSimbolo',$this->data);
	}
	
	public function interpretes_por_indice_numero()
	{
        $this->data['listaInterpretesPorNumero'] = $this->mod_int->lista_interpretes_empiezan_por_numero();
		
		$this->load->view('vistaInterpretesPorIndiceNumero',$this->data);
	}
	
	public function interpretes_por_indice_letra($letra)
	{
        $this->data['listaInterpretesPorLetra'] = $this->mod_int->lista_interpretes_empiezan_por_letra($letra);
        $this->data['letra'] = $letra;
		
		$this->load->view('vistaInterpretesPorIndiceLetra',$this->data);
	}
	
	public function vista_info_interpretes($idInterprete)
	{
        $this->data['infoInterpretes'] = $this->mod_int->obtener_interprete_por_id($idInterprete);
        $this->data['tipoInterprete'] = $this->mod_tipo_int->obtener_nombre_tipo_interprete($this->data['infoInterpretes']->tipo_interprete);
        $this->data['usuarioInterprete'] = $this->mod_usu->obtener_nombre_usuario($this->data['infoInterpretes']->usuario_interprete);
		
		//$camposInt = $this->mod_int->obtener_campos_interprete();
		
		/*$data['title'] = "Información de ".$data['infoInterpretes'][0]->nombre_interprete;
		$data['main_content'] = 'vistaInformacionInterprete';
		$this->load->view('plantillas/template', $data);*/

        $title =  "Información de ".$this->data['infoInterpretes']->nombre_interprete;

        $this->establecerContenidoPrincipal($title, 'vistaInformacionInterprete');
	}
	
	public function vista_anyadir_letra()
	{
		/*$data['title'] = "Añadir una nueva letra";
		$data['main_content'] = 'vistaAnyadirLetra';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Añadir una nueva letra', 'vistaAnyadirLetra');
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
		
		if(!$this->mod_can->comprobar_existencia_cancion($tituloCancion, $idAlb, $idInt))
		{
			$this->mod_can->insertar_solo_nombre_cancion($tituloCancion, $idAlb, $codigoUsuario);
			$idCan = $this->mod_can->obtener_id_cancion_ultimo_insert();
			
			$this->mod_let->insertar_letra($idCan, $letraCancion);
			
			$this->index();
		}
		
		else
		{
			/*$data['title'] = "Cancion existente";
			$data['main_content'] = 'vistaAnyadirLetra';
			$this->load->view('plantillas/template', $data);*/

            $this->establecerContenidoPrincipal('Cancion existente', 'vistaAnyadirLetra');
		}
	}
	
	public function indice_letras()
	{
		$this->data['listaCanciones'] = $this->mod_can->lista_canciones();

        /*$this->data['title'] = "Índice de letras";
        $this->data['main_content'] = 'indiceLetras';
		$this->load->view('plantillas/template', $this->data);*/

        $this->establecerContenidoPrincipal('Índice de letras', 'indiceLetras');
	}

	public function mostrar_letra($idCancion)
	{
        $this->data['interpreteLetra'] = $this->mod_can->obtener_interprete_cancion($idCancion);
        $this->data['albumLetra'] = $this->mod_can->obtener_album_cancion($idCancion);
        $this->data['cancionObtenida'] = $this->mod_can->obtenerCancion($idCancion);
        $this->data['letraObtenida'] = $this->mod_let->obtenerLetra($idCancion);
		
		/*$data['title'] = $data['cancionObtenida']->nombre_cancion;
		$data['main_content'] = 'mostrarLetra';
		$this->load->view('plantillas/template', $data);*/

        $title = $this->data['cancionObtenida']->nombre_cancion;

        $this->establecerContenidoPrincipal($title, 'mostrarLetra');
	}
	
	//Gestiones ADMIN
	
		//Tipos de interprete
	
	public function gestion_tipos_interprete()
	{
        $this->data['listaTiposInterprete'] = $this->mod_tipo_int->lista_tipos_interprete_odenada("nombre_tipo_interprete");
		
		/*$data['title'] = "Gestión de tipos de intérprete";
		$data['main_content'] = 'gestionTiposInterprete';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Gestión de tipos de intérprete', 'gestionTiposInterprete');
	}
	
	public function formularioNuevoTipoInterprete()
	{
		/*$data['title'] = "Nuevo Tipo de Intérprete";
		$data['main_content'] = 'formNuevoTipoInterprete';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Nuevo Tipo de Intérprete', 'formNuevoTipoInterprete');
	}

	public function guardar_datos_tipo_interprete()
	{
		$this->form_validation->set_rules('nomTipoInt', 'nombre del tipo de intérprete', 'required|alpha|min_length[3]|max_length[50]|trim|is_unique[tipo_interprete.nombre_tipo_interprete]');
		
        $this->form_validation->set_message('required', 'Debe introducir el %s');
        $this->form_validation->set_message('alpha','El %s debe estar compuesto sólo por letras');
        $this->form_validation->set_message('min_length','El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length','El %s debe tener como máximo %s carácteres');
        $this->form_validation->set_message('is_unique','Este %s ya está registrado');
		
		if($this->form_validation->run() == false)
		{
			$this->formularioNuevoTipoInterprete();
		}
		
		else 
		{			
			$nombreTipoInt = $this->input->post('nomTipoInt');
			
			$this->mod_tipo_int->nuevo_tipo_interprete($nombreTipoInt);
			
			$this->gestion_tipos_interprete();
		}
	}
	
	public function formularioModificarTipoInterprete($idTipoInt)
	{
		$this->data['tipoIntObtenido'] = $this->mod_tipo_int->obtener_tipo_interprete($idTipoInt);
		
		/*$data['title'] = "Modificar Tipo de Intérprete";
		$data['main_content'] = 'formModificarTipoInterprete';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Modificar Tipo de Intérprete', 'formModificarTipoInterprete');
	}
	
	public function modificar_datos_tipo_interprete()
	{		
		$idTipoInt = $this->input->post('idTipoInt');
		
		$this->form_validation->set_rules('nomTipoInt', 'nombre del tipo de intérprete', 'required|alpha|min_length[3]|max_length[50]|trim|is_unique[tipo_interprete.nombre_tipo_interprete]');
		
        $this->form_validation->set_message('required', 'Debe introducir el %s');
        $this->form_validation->set_message('alpha','El %s debe estar compuesto sólo por letras');
        $this->form_validation->set_message('min_length','El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length','El %s debe tener como máximo %s carácteres');
        $this->form_validation->set_message('is_unique','Este %s ya está registrado');
		
		if($this->form_validation->run() == false)
		{
			$this->formularioModificarTipoInterprete($idTipoInt);
		}
		
		else 
		{			
			$nombreTipoInt = $this->input->post('nomTipoInt');
			
			$this->mod_tipo_int->modificar_tipo_interprete($idTipoInt, $nombreTipoInt);
			
			$this->gestion_tipos_interprete();
		}
	}
	
	public function eliminarTipoInterprete($idTipoInt)
	{
		$this->mod_tipo_int->eliminar_tipo_interprete($idTipoInt);
		
		$this->gestion_tipos_interprete();
	}
	
		//FIN Tipos de interprete
		
		//Usuario
	
	public function gestion_usuarios()
	{
		$this->data['listaUsuarios'] = $this->mod_usu->lista_usuarios_odenada("nombre_registro_usuario");
		
		/*$data['title'] = "Gestión de Usuarios";
		$data['main_content'] = 'gestionUsuarios';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Gestión de Usuarios', 'gestionUsuarios');
	}
	
	public function formularioModificarUsuario($idUsuario)
	{
		$this->data['usuarioObtenido'] = $this->mod_usu->obtener_usuario($idUsuario);
		
		$listaContinentes = array('Asia','Africa','Europe','North America','Oceania','South America');
		$this->data['listaContinentes'] = $listaContinentes;
		
		$listaPaisesContinente = array();
		
		for($i = 0; $i < count($listaContinentes); $i++)
		{
			$listaPais = $this->mod_pais->lista_paises_continente($listaContinentes[$i]);
			array_push($listaPaisesContinente, $listaPais); 
		}
		
		$this->data['listaPaisesContinente'] = $listaPaisesContinente;
		
		/*$data['title'] = "Modificar Usuario";
		$data['main_content'] = 'formModificarUsuario';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Modificar Usuario', 'formModificarUsuario');
	}
	
	public function modificar_datos_usuario()
	{
		$idUsuario = $this->input->post('idUsuario');
		
		$this->form_validation->set_rules('nombre', 'nombre del usuario', 'required|alpha|min_length[3]|max_length[50]|trim');
		$this->form_validation->set_rules('apellidos', 'apellidos del usuario', 'required|alpha|min_length[3]|max_length[200]|trim');
		
        $this->form_validation->set_message('required', 'Debe introducir el campo %s');
        $this->form_validation->set_message('alpha','El campo %s debe estar compuesto sólo por letras');
        $this->form_validation->set_message('min_length','El campo %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length','El campo %s debe tener como máximo %s carácteres');
		
		if($this->form_validation->run() == false)
		{
			$this->formularioModificarUsuario($idUsuario);
		}
		
		else 
		{
			$nombre = $this->input->post('nombre');
			$apellidos = $this->input->post('apellidos');
			$pais = $this->input->post('pais');
			
			$this->mod_usu->modificar_usuario($idUsuario, $nombre, $apellidos, $pais);
			
			$this->gestion_usuarios();
		}
	}
	
	public function dar_de_baja_usuario($idUsuario)
	{
		$this->mod_usu->baja_usuario($idUsuario);
		
		$this->gestion_usuarios();
	}
	
	//FIN Usuario
	
	//Géneros
	
	public function gestion_generos()
	{
		$this->data['listaGeneros'] = $this->mod_gen->lista_generos_odenada("id_genero");
		
		/*$data['title'] = "Gestión de géneros";
		$data['main_content'] = 'gestionGeneros';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Gestión de géneros', 'gestionGeneros');
	}
	
	public function formularioNuevoGenero()
	{
		/*$data['title'] = "Nuevo Género";
		$data['main_content'] = 'formNuevoGenero';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Nuevo Género', 'formNuevoGenero');
	}
	
	public function guardar_datos_genero()
	{
		$this->form_validation->set_rules('nomGen', 'nombre del género', 'required|alpha|min_length[3]|max_length[100]|trim|is_unique[genero.nombre_genero]');
		
        $this->form_validation->set_message('required', 'Debe introducir el %s');
        $this->form_validation->set_message('alpha','El %s debe estar compuesto sólo por letras');
        $this->form_validation->set_message('min_length','El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length','El %s debe tener como máximo %s carácteres');
        $this->form_validation->set_message('is_unique','Este %s ya está registrado');
		
		if($this->form_validation->run() == false)
		{
			$this->formularioNuevoGenero();
		}
		
		else 
		{			
			$nombreGen = $this->input->post('nomGen');
			
			$this->mod_gen->nuevo_genero($nombreGen);
			
			$this->gestion_generos();
		}
	}
	
	public function formularioModificarGenero($idGenero)
	{
		$this->data['generoObtenido'] = $this->mod_gen->obtener_genero($idGenero);
		
		/*$data['title'] = "Modificar Género";
		$data['main_content'] = 'formModificarGenero';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Modificar Género', 'formModificarGenero');
	}
	
	public function modificar_datos_genero()
	{		
		$idGenero = $this->input->post('idGen');
		
		$this->form_validation->set_rules('nomGen', 'nombre del género', 'required|alpha|min_length[3]|max_length[100]|trim|is_unique[genero.nombre_genero]');
		
        $this->form_validation->set_message('required', 'Debe introducir el %s');
        $this->form_validation->set_message('alpha','El %s debe estar compuesto sólo por letras');
        $this->form_validation->set_message('min_length','El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length','El %s debe tener como máximo %s carácteres');
        $this->form_validation->set_message('is_unique','Este %s ya está registrado');
		
		if($this->form_validation->run() == false)
		{
			$this->formularioModificarGenero($idGenero);
		}
		
		else 
		{			
			$nombreGenero = $this->input->post('nomGen');
			
			$this->mod_gen->modificar_genero($idGenero, $nombreGenero);
			
			$this->gestion_generos();
		}
	}
	
	public function eliminarGenero($idGenero)
	{
		$this->mod_gen->eliminar_genero($idGenero);
		
		$this->gestion_generos();
	}
	
	//FIN Géneros
	
	//Intérpretes
	
	public function gestion_interpretes()
	{
		$this->data['listaInterpretes'] = $this->mod_int->lista_interpretes_odenada("nombre_interprete");
		
		/*$data['title'] = "Gestión de Intérpretes";
		$data['main_content'] = 'gestionInterpretes';
		$this->load->view('plantillas/template', $data);*/

        $this->establecerContenidoPrincipal('Gestión de Intérpretes', 'gestionInterpretes');
	}
	
	//FIN Intérpretes
}	