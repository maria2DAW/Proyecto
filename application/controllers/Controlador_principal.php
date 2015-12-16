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
            $this->data['enlaceLogin'] = 'accesoUsuarios';
        }
		
		//Lista de tipos de intérpretes
        $this->data['listaTiposInterprete'] = $this->mod_tipo_int->lista_tipos_interprete();

		//Lista de géneros
        $this->data['listaGeneros'] = $this->mod_gen->lista_generos();
	}

    public function establecerContenidoPrincipal($title, $contenido)
    {
        $this->data['title'] = $title;
        $this->data['main_content'] = $contenido;
        $this->load->view('plantillas/template', $this->data);
    }
	
	public function index()
    {
        // -- Ranquins --
        $this->data['numUsuarios'] = $this->mod_general->numero_registros("usuario");
        $this->data['numInterpretes'] = $this->mod_general->numero_registros("interprete");
        $this->data['numAlbumes'] = $this->mod_general->numero_registros("album");
        $this->data['numLetras'] = $this->mod_general->numero_registros("letra_cancion");

        $this->data['numTop'] = 5;
        $this->data['numPuesto'] = 1;

        $this->data['letraMasVisitadas'] = $this->mod_let->letras_mas_visitadas($this->data['numTop']);
        $this->data['usuConMasLetras'] = $this->mod_usu->usuarios_com_mas_letras_subidas($this->data['numTop']);
        $this->data['intConMasLetras'] = $this->mod_int->interpretes_con_mas_letras($this->data['numTop']);
        // -- Ranquins --

		$this->establecerContenidoPrincipal("Canticum", "inicio");
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

    public function comprobarImagen($imagen, $directorio)
    {
        $comprobar = true;

        $config['upload_path'] = './assets/img/'.$directorio.'/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '2048';
        $config['max_width']  = '1080';
        $config['max_filename'] = '200';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);

        if (isset($_FILES['imgSubida']) && !empty($_FILES['imgSubida']['name']))
        {
            if (!$this->upload->do_upload('imgSubida'))
            {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('comprobarImagen', $this->upload->display_errors());

                $comprobar = false;
            }
        }

        return $comprobar;
    }
	
	public function formularioNuevoInterprete() 
	{
        $this->establecerContenidoPrincipal("Nuevo Intérprete", "formularioNuevoInterprete");
	} 
	
	public function guardar_datos_interprete()
	{
        $destino = "interpretes";

		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
		$this->form_validation->set_rules('nomInt', 'nombre de intérprete', 'trim|required|max_length[50]|is_unique[interprete.nombre_interprete]');
		$this->form_validation->set_rules('orgInt', 'origen de intérprete', 'trim|max_length[50]|callback_alpha_space');
        $this->form_validation->set_rules('imgSubida', 'imágen de intérprete', 'trim|max_length[200]|callback_comprobarImagen['.$destino.']');
		
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

            if(isset($_FILES['imgSubida']) && !empty($_FILES['imgSubida']['name']))
            {
                $datosInterprete['imagen_interprete'] = $_FILES['imgSubida']['name'];
            }
			
			//Se inserta el intérprete
			
			$nombreUsuario = $this->session->userdata['nombreregistro'];
            $codigoUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);
            $datosInterprete['usuario_interprete'] = $codigoUsuario;
			
			$this->mod_general->insertar("interprete", $datosInterprete);
			
			//Géneros seleccionados			
			
			$idInsertInterprete = $this->mod_general->obtener_id_ultimo_insert();
			
			$generosInterprete = $this->input->post('genInt');
			
			if(count($generosInterprete) > 0) //Si $generosInterprete no está vacío
			{
				foreach($generosInterprete as $generoInte) //Insertamos todos los géneros de dicho intérprete
				{
					$this->mod_gen->insertar_genero_interprete($idInsertInterprete, $generoInte);
				}
			}
			
			$this->gestion_interpretes();
		}
	}
	
	public function formularioNuevoAlbum() 
	{
        $this->establecerContenidoPrincipal("Nuevo Álbum", "formularioNuevoAlbum");
	}
	
	//Arreglar función
    public function guardar_datos_album()
	{
        $destino = "albumes";

        $interpreteAlb = $this->input->post('intAlb');

		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
		$this->form_validation->set_rules('nomAlb', 'nombre del álbum', 'trim|required|max_length[30]|callback_comprobarExistenciaAlbum['.$interpreteAlb.']');
		$this->form_validation->set_rules('intAlb', 'intérprete del álbum', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('numPis', 'nº de pistas del álbum', 'trim|max_length[3]|numeric');
		$this->form_validation->set_rules('anLan', 'año del álbum', 'trim|exact_length[4]|numeric');
        $this->form_validation->set_rules('imgSubida', 'imágen de intérprete', 'trim|max_length[200]|callback_comprobarImagen['.$destino.']');

        $this->form_validation->set_message('comprobarExistenciaAlbum', 'Este álbum ya existe para este intérprete');
	
		if(!$this->form_validation->run())
		{
			$this->formularioNuevoAlbum();
		}
		
		else
		{
            $datosAlbum = array(
                'nombre_album' => $this->input->post('nomAlb'),
                'numero_pistas' => $this->input->post('numPis'),
                'anyo_lanzamiento' => $this->input->post('anLan'),
                'informacion_album' => $this->input->post('infAlb')
            );

            if(isset($_FILES['imgSubida']) && !empty($_FILES['imgSubida']['name']))
            {
                $datosAlbum['imagen_album'] = $_FILES['imgSubida']['name'];
            }

            $nombreUsuario = $this->session->userdata['nombreregistro'];
            $idUsu = $this->mod_usu->obtener_id_usuario($nombreUsuario);
			
			if ( !$this->mod_int->comprobar_existencia_interprete($interpreteAlb))
			{
				$this->mod_int->insertar_solo_nombre_interprete($interpreteAlb, $idUsu);
                $datosAlbum['interprete_album'] = $this->mod_general->obtener_id_ultimo_insert();
			}

            else
            {
                $datosAlbum['interprete_album'] = $this->mod_int->obtener_id_interprete($interpreteAlb);
            }

            $datosAlbum['usuario_album'] = $idUsu;

            $this->mod_general->insertar("album", $datosAlbum);
            $idInsertAlbum = $this->mod_general->obtener_id_ultimo_insert();

            //Géneros seleccionados

            $generosAlbum = $this->input->post('genAlb');

            if(count($generosAlbum) > 0) //Si $generosInterprete no está vacío
            {
                foreach($generosAlbum as $generoAlbu) //Insertamos todos los géneros de dicho intérprete
                {
                    $this->mod_gen->insertar_genero_album($idInsertAlbum, $generoAlbu);
                }
            }
			
			$this->index();
		}
	}

    public function comprobarExistenciaAlbum($nAlb, $iAlb)
    {
        $comprobacion = true;

        if ($this->mod_int->comprobar_existencia_interprete($iAlb))
        {
            $idInterpreteAlb = $this->mod_int->obtener_id_interprete($iAlb);

            if($this->mod_alb->comprobar_existencia_album($nAlb, $idInterpreteAlb))
            {
                $comprobacion =  false;
            }
        }

        return $comprobacion;
    }

    public function indice_albumes()
    {
        $this->data['listaAlbumes'] = $this->mod_general->lista__odenada('album', 'nombre_album');

        $this->establecerContenidoPrincipal('Índice de letras', 'indiceAlbumes');
    }

    public function albumes_por_indice_letra($letra)
    {
        $this->data['listaAlbumesPorLetra'] = $this->mod_alb->lista_albumes_empiezan_por_letra($letra);
        $this->data['numAlbumesPorLetra'] = count($this->data['listaAlbumesPorLetra']);

        $this->data['letra'] = $letra;

        $this->load->view('vistaAlbumesPorIndiceLetra',$this->data);
    }

    public function albumes_por_indice_simbolo()
    {
        $this->data['listaAlbumesPorSimbolo'] = $this->mod_alb->lista_albumes_empiezan_por_otro_caracter();
        $this->data['numAlbumesPorSimbolo'] = count($this->data['listaAlbumesPorSimbolo']);

        $this->load->view('vistaAlbumesPorIndiceSimbolo',$this->data);
    }

    public function albumes_por_indice_numero()
    {
        $this->data['listaAlbumesPorNumero'] = $this->mod_can->lista_canciones_empiezan_por_numero();
        $this->data['numAlbumesPorNumero'] = count($this->data['listaAlbumesPorNumero']);

        $this->load->view('vistaAlbumesPorIndiceNumero',$this->data);
    }
	
	public function formularioLoguear() 
	{
        $this->establecerContenidoPrincipal('Login', 'formLogin');
	}
	
	public function logear()
	{
        $pass = $this->input->post('passUsu');
        $passMd5 = md5($pass);

        $nomUsuario = $this->input->post('nomUsu');

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$this->form_validation->set_rules('nomUsu', 'nombre de usuario', 'required|callback_validarUsuarioYPassword['.$passMd5.']');
		$this->form_validation->set_rules('passUsu', 'contraseña', 'required');

		$this->form_validation->set_message('validarUsuarioYPassword', 'Nombre de usuario o contraseña incorrecto');

		if($this->form_validation->run() == false)
		{
            $data['main_content'] = 'indiceInterpretes';
			$this->formularioLoguear();
		}
		
		else
		{
            $usuariObtenido = $this->mod_usu->obtener_usuario_por_registro($nomUsuario);

            $datos_sesion = array(
                    'nombreregistro' => $usuariObtenido->nombre_registro_usuario,
                    'nivelusuario' => $usuariObtenido->nivel_usuario
            );

            $this->session->set_userdata($datos_sesion);
			
			$nombreUsuario = $this->session->userdata['nombreregistro'];


            $this->data['login'] = $nombreUsuario;
            $this->data['enlaceLogin'] = 'accesoUsuarios';

            $this->index();
		}
	}

    public function formularioRestaurarPass()
    {
        $this->establecerContenidoPrincipal('Restaurar Contraseña', 'formPassOlvidada');
    }

    public function restaurarPass()
    {
        $email = $this->input->post('emailCuenta');

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        $this->form_validation->set_rules('emailCuenta', 'e-mail', 'required|trim|valid_email|callback_comprobarSiExisteEmailCuenta');

        $this->form_validation->set_message('comprobarSiExisteEmailCuenta', 'Este email no está registrado');

        if($this->form_validation->run() == false)
        {
            $this->formularioRestaurarPass();
        }

        else
        {
            $nombreUsuario = $this->mod_usu->obtener_nombre_usuario_por_email($email);

            $randomPass = $this->generadorPass();
            $randomPassMd5 = md5($randomPass);

            $idUsuario = $this->mod_usu->obtener_id_usuario_por_email($email);

            $this->mod_usu->cambiar_contrasenya($idUsuario, $randomPassMd5);

            $this->enviarPassEmail($nombreUsuario, $email, $randomPass);
            $this->formularioLoguear();
        }
    }

    public function enviarPassEmail($usuario, $email, $nuevaPass)
    {
        // Utilizando smtp
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';
        $config['mailtype'] = 'html';


        $this->email->initialize($config);

        $this->email->from('aula4@iessansebastian.com', 'Canticum');
        $this->email->to($email);
        $this->email->subject('Solicitud para restaurar contraseña');
        $this->email->message("<html><body><h2>Esta contraseña es aleatoria.<br>Puede modificarla accediendo a su perfil de usuario si así lo desea.</h2><p>Usuario: <font color='blue'>" . $usuario .
            "</font></p><p>Nuevo password--> <font color='blue'>$nuevaPass</font></p></body></html>");

        return $this->email->send();

    }

    /**
     * @return string Contraseña aleatoria
     *
     * @obtenido_de: http://www.cristalab.com/tutoriales/generar-password-aleatorio-en-php-en-1-linea-de-codigo-c46930l/
     */
    public function generadorPass()
    {
        $psswd = substr( md5(microtime()), 1, 12);
        return $psswd;
    }

    public function comprobarSiExisteEmailCuenta($emailCuenta)
    {
        if($this->mod_usu->comprobarEmail($emailCuenta))
        {
            return true;
        }

        else
        {
            return false;
        }
    }

    public function formularioCambiarPass()
    {
        $this->establecerContenidoPrincipal('Restaurar Contraseña', 'formCambiarPass');
    }

    public function guardar_datos_nueva_pass()
    {
        $nombreUsuario = $this->session->userdata['nombreregistro'];

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        $this->form_validation->set_rules('conActual', 'contraseña actual', 'required|callback_comprobarPassUsuario['.$nombreUsuario.']');
        $this->form_validation->set_rules('conNueva', 'nueva contraseña', 'required|exact_length[12]|matches[conNueva2]|md5');
        $this->form_validation->set_rules('conNueva2', 'repita la nueva contraseña', 'required|exact_length[12]|md5');

        $this->form_validation->set_message('comprobarPassUsuario', 'Esta no es su contraseña actual');

        if($this->form_validation->run() == false)
        {
            $this->formularioCambiarPass();
        }

        else
        {
            $idUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);

            $nuevaPass = $this->input->post('conNueva');

            $this->mod_usu->cambiar_contrasenya($idUsuario, $nuevaPass);

            $this->accesoUsuarios();
        }

    }

    public function comprobarPassUsuario($pass, $usuario)
    {
        if($this->mod_usu->comprobarPassUsuario($pass, $usuario))
        {
            return true;
        }

        else
        {
            return false;
        }
    }


    public function accesoUsuarios()
    {
        $nombreUsuario = $this->session->userdata['nombreregistro'];
        $this->data['usuarioConectado'] = $this->mod_usu->obtener_usuario_por_registro($nombreUsuario);

        $this->data['paisUsuario'] = $this->mod_pais->obtener_nombre_pais($this->data['usuarioConectado']->pais_usuario);

        $this->data['interpretesUsuario'] = $this->mod_int->lista_interpretes_usuario($this->data['usuarioConectado']->id_usuario);

        $this->data['albumesUsuario'] = $this->mod_alb->lista_albumes_usuario($this->data['usuarioConectado']->id_usuario);

        $this->data['cancionesUsuario'] = $this->mod_can->lista_canciones_usuario($this->data['usuarioConectado']->id_usuario);

        $nivelUsuario = $this->session->userdata['nivelusuario'];

        if($nivelUsuario == 'A')
        {
            $main_content = 'panelAdmin';
        }

        else
        {
            $main_content = 'panelUsuario';
        }

        $this->establecerContenidoPrincipal($nombreUsuario, $main_content);
    }
	
	public function validarUsuarioYPassword($nomUsuario, $passUsuario)
    {
        $loginValido = $this->mod_usu->comprobarUsuarioYPassword($nomUsuario, $passUsuario);

        if($loginValido)
        {
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

        $this->data['enlaceLogin'] = 'accesoUsuarios';
        $this->data['login'] = 'LOG IN';
		
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
		$this->form_validation->set_rules('passUsuario', 'contraseña', 'required|exact_length[12]|matches[pass2Usuario]|md5');
        $this->form_validation->set_rules('pass2Usuario', 'repetir contraseña', 'required|exact_length[12]|md5');
        $this->form_validation->set_rules('nombre', 'nombre', 'required|trim|callback_alpha_space');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required|trim|callback_alpha_space');
        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email|trim|is_unique[usuario.email_usuario]');


        $this->form_validation->set_message('alpha_space','El campo %s debe estar compuesto sólo por letras');
        $this->form_validation->set_message('is_unique','Este %s ya existe');
		
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
        $this->data['numInterpretesLetra'] = count($this->data['listaInterpretesPorLetra']);

        $this->data['letra'] = $letra;
		
		$this->load->view('vistaInterpretesPorIndiceLetra',$this->data);
	}
	
	public function vista_info_interpretes($idInterprete)
	{
        $this->data['infoInterpretes'] = $this->mod_int->obtener_interprete_por_id($idInterprete);
        $this->data['tipoInterprete'] = $this->mod_tipo_int->obtener_nombre_tipo_interprete($this->data['infoInterpretes']->tipo_interprete);
        $this->data['listaGenerosInterprete'] = $this->mod_gen->lista_generos_interprete($idInterprete);

        $this->data['usuarioInterprete'] = $this->mod_usu->obtener_nombre_usuario($this->data['infoInterpretes']->usuario_interprete);
		
		//$camposInt = $this->mod_int->obtener_campos_interprete();

        $title =  "Información de ".$this->data['infoInterpretes']->nombre_interprete;

        $this->establecerContenidoPrincipal($title, 'vistaInformacionInterprete');
	}

    public function lista_albumes_interprete($idInt)
    {
        $this->data['listaAlbumesInt'] = $this->mod_alb->lista_albumes_interprete($idInt);
        $this->data['numAlbumesInt'] = count($this->data['listaAlbumesInt']);

        $this->load->view('listaAlbumesInterprete',$this->data);
    }

    public function vista_info_albumes($idAlbum)
    {
        $this->data['infoAlbumes'] = $this->mod_alb->obtener_album_por_id($idAlbum);
        $this->data['listaGenerosAlbum'] = $this->mod_gen->lista_generos_album($idAlbum);

        $this->data['interpreteAlbum'] = $this->mod_alb->obtener_interprete_album($this->data['infoAlbumes']->id_album);

        $this->data['usuarioAlbum'] = $this->mod_usu->obtener_nombre_usuario($this->data['infoAlbumes']->usuario_album);

        $title =  "Información de ".$this->data['infoAlbumes']->nombre_album;

        $this->establecerContenidoPrincipal($title, 'vistaInformacionAlbum');
    }

    public function lista_canciones_album($idAlb)
    {
        $this->data['listaCancionesAlb'] = $this->mod_can->lista_canciones_album($idAlb);
        $this->data['numCancionesAlb'] = count($this->data['listaCancionesAlb']);

        $this->load->view('listaCancionesAlbum',$this->data);
    }
	
	public function vista_anyadir_letra()
	{
        $this->establecerContenidoPrincipal('Añadir una nueva letra', 'vistaAnyadirLetra');
	}

    /**
     * Función que elimina de una cadena las etiquetas de HTML o PHP que contenga
     *
     * @param $string  La cadena de la que queremos remover los tags de HTML o PHP
     * @return mixed|string  La cadena sin las etiquetas HTML/PHP
     *
     * @obtenida_de http://php.net/manual/en/function.strip-tags.php
     */
    function rip_tags($string) {

        // ----- remove HTML TAGs -----
        $string = preg_replace ('/<[^>]*>/', ' ', $string);

        // ----- remove control characters -----
        $string = str_replace("\r", '', $string);    // --- replace with empty space
        $string = str_replace("\n", ' ', $string);   // --- replace with space
        $string = str_replace("\t", ' ', $string);   // --- replace with space

        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));

        return $string;

    }
	
	public function guardar_datos_letra()
	{
        $interpreteCancion = $this->input->post('intCan'); //Nombre del intérprete
        $albumCancion = $this->input->post('albCan');

        $parametrosComprobarCancion = $interpreteCancion.','.$albumCancion;

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        $this->form_validation->set_rules('intCan', 'intérprete de la canción', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('albCan', 'álbum de la canción', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('titCan', 'título de la canción', 'trim|required|max_length[30]|callback_comprobarExistenciaCancion['.$parametrosComprobarCancion.']');
        $this->form_validation->set_rules('wysihtml5-textarea', 'letra de la canción', 'required');

        $this->form_validation->set_message('comprobarExistenciaCancion','Esta canción ya existe');

        if(!$this->form_validation->run())
        {
            $this->vista_anyadir_letra();
        }

        else
        {
            $tituloCancion = $this->input->post('titCan');
            $letraCancion = $this->input->post('wysihtml5-textarea');
            $letraCancionSinHtml = $this->rip_tags($this->input->post('wysihtml5-textarea'));


            $nombreUsuario = $this->session->userdata['nombreregistro'];
            $codigoUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);

            $idInt = "";
            $idAlb = "";

            if($this->mod_int->comprobar_existencia_interprete($interpreteCancion))
            {
                $idInt = $this->mod_int->obtener_id_interprete($interpreteCancion);
            }

            else
            {
                $this->mod_int->insertar_solo_nombre_interprete($interpreteCancion, $codigoUsuario);
                $idInt = $this->mod_int->obtener_id_interprete_ultimo_insert();
            }

            if($this->mod_alb->comprobar_existencia_album($albumCancion, $idInt))
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

                $this->mod_let->insertar_letra($idCan, $letraCancion, $letraCancionSinHtml);

                $this->index();
            }

        }
	}

    public function comprobarExistenciaCancion($nCan, $paraComprobacion)
    {
        //$parametros[0] = intérprete de la canción
        //$parametros[1] = álbum de la canción
        $parametros = explode(",", $paraComprobacion);

        $comprobacion = true;

        if ($this->mod_int->comprobar_existencia_interprete($parametros[0]))
        {
            $idInterpreteCan = $this->mod_int->obtener_id_interprete($parametros[0]);

            if($this->mod_alb->comprobar_existencia_album($parametros[1], $idInterpreteCan))
            {
                $idAlbumCan = $this->mod_alb->obtener_id_album($idInterpreteCan, $parametros[1]);

                if($this->mod_can->comprobar_existencia_cancion($nCan, $idAlbumCan, $idInterpreteCan))
                {
                    $comprobacion =  false;
                }
            }
        }

        return $comprobacion;
    }
	
	public function indice_letras()
	{
        $this->establecerContenidoPrincipal('Índice de Letras', 'indiceLetras');
	}

    public function letras_por_indice_letra($letra)
    {
        $this->data['listaCancionesPorLetra'] = $this->mod_can->lista_canciones_empiezan_por_letra($letra);
        $this->data['numCancionesPorLetra'] = count($this->data['listaCancionesPorLetra']);

        $this->data['letra'] = $letra;

        $this->load->view('vistaLetrasPorIndiceLetra',$this->data);
    }

    public function letras_por_indice_simbolo()
    {
        $this->data['listaLetrasPorSimbolo'] = $this->mod_can->lista_canciones_empiezan_por_otro_caracter();
        $this->data['numCancionesPorSimbolo'] = count($this->data['listaLetrasPorSimbolo']);

        $this->load->view('vistaLetrasPorIndiceSimbolo',$this->data);
    }

    public function letras_por_indice_numero()
    {
        $this->data['listaLetrasPorNumero'] = $this->mod_can->lista_canciones_empiezan_por_numero();
        $this->data['numCancionesPorNumero'] = count($this->data['listaLetrasPorNumero']);

        $this->load->view('vistaLetrasPorIndiceNumero',$this->data);
    }

	public function mostrar_letra($idCancion)
	{
        $this->data['interpreteLetra'] = $this->mod_can->obtener_interprete_cancion($idCancion);
        $this->data['albumLetra'] = $this->mod_can->obtener_album_cancion($idCancion);
        $this->data['cancionObtenida'] = $this->mod_can->obtenerCancion($idCancion);
        $this->data['letraObtenida'] = $this->mod_let->obtenerLetra($idCancion);

        $visitas = $this->data['letraObtenida']->visitas_letra;
        $visitas++;

        $idLet = $this->data['letraObtenida']->id_letra_cancion;
        $datos['visitas_letra'] = $visitas;

        $this->mod_let->actualizar_visitas($idLet, $datos);

        $this->data['visitasLetra'] = $visitas;

        $title = $this->data['cancionObtenida']->nombre_cancion;

        $this->establecerContenidoPrincipal($title, 'mostrarLetra');
	}
	
	//Gestiones ADMIN
	
		//Tipos de interprete
	
	public function gestion_tipos_interprete()
	{
        $this->data['listaTiposInterprete'] = $this->mod_tipo_int->lista_tipos_interprete_odenada("nombre_tipo_interprete");

        $this->establecerContenidoPrincipal('Gestión de tipos de intérprete', 'gestionTiposInterprete');
	}
	
	public function formularioNuevoTipoInterprete()
	{
        $this->establecerContenidoPrincipal('Nuevo Tipo de Intérprete', 'formNuevoTipoInterprete');
	}

	public function guardar_datos_tipo_interprete()
	{
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		$this->form_validation->set_rules('nomTipoInt', 'nombre del tipo de intérprete', 'required|min_length[3]|max_length[50]|trim|is_unique[tipo_interprete.nombre_tipo_interprete]|callback_alpha_space');

        $this->form_validation->set_message('alpha_space','El campo %s debe estar compuesto sólo por letras');
        $this->form_validation->set_message('is_unique','Este %s ya existe');
		
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

    public function datos_usuario()
    {
        $nombreUsuario = $this->session->userdata['nombreregistro'];
        $this->data['usuarioConectado'] = $this->mod_usu->obtener_usuario_por_registro($nombreUsuario);

        $this->data['paisUsuario'] = $this->mod_pais->obtener_nombre_pais($this->data['usuarioConectado']->pais_usuario);

        $this->load->view('datosUsuario',$this->data);
    }

    public function vista_anyadir_publicaciones_Usuario()
    {
        $this->load->view('anyadirPublicacionUsuario');
    }

    public function vista_publicaciones_Usuario()
    {
        $this->load->view('publicacionesUsuario');
    }

    public function interpretes_Usuario()
    {
        $nombreUsuario = $this->session->userdata['nombreregistro'];
        $idUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);

        $this->data['interpretesUsuario'] = $this->mod_int->lista_interpretes_usuario($idUsuario);

        $this->load->view('interpretesUsuario',$this->data);
    }

    public function albumes_Usuario()
    {
        $nombreUsuario = $this->session->userdata['nombreregistro'];
        $idUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);

        $this->data['albumesUsuario'] = $this->mod_alb->lista_albumes_usuario($idUsuario);

        $this->load->view('albumesUsuario',$this->data);
    }

    public function canciones_Usuario()
    {
        $nombreUsuario = $this->session->userdata['nombreregistro'];
        $idUsuario = $this->mod_usu->obtener_id_usuario($nombreUsuario);

        $this->data['cancionesUsuario'] = $this->mod_can->lista_canciones_usuario($idUsuario);

        $this->load->view('cancionesUsuario',$this->data);
    }

    public function cargarFormularioNuevoInterprete()
    {
        $this->load->view('formularioNuevoInterprete', $this->data);
    }

	
	//FIN Usuario
	
	//Géneros
	
	public function gestion_generos()
	{
		$this->data['listaGeneros'] = $this->mod_gen->lista_generos_odenada("id_genero");

        $this->establecerContenidoPrincipal('Gestión de géneros', 'gestionGeneros');
	}
	
	public function formularioNuevoGenero()
	{
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

        $this->establecerContenidoPrincipal('Modificar Género', 'formModificarGenero');
	}
	
	public function modificar_datos_genero()
	{		
		$idGenero = $this->input->post('idGen');
		
		$this->form_validation->set_rules('nomGen', 'nombre del género', 'required|alpha|min_length[3]|max_length[100]|trim|is_unique[genero.nombre_genero]');

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

        $this->establecerContenidoPrincipal('Gestión de Intérpretes', 'gestionInterpretes');
	}
	
	//FIN Intérpretes

    public function busqueda()
    {
        $cadenaBusqueda = $this->input->post('inputBusqueda');
        $criterioBusqueda = $this->input->post('selectBusqueda');

        $this->form_validation->set_rules('inputBusqueda', 'búsqueda', 'required|trim');

        if($this->form_validation->run() == false)
        {
            $this->index();
        }

        else
        {
            switch ($criterioBusqueda) {
                case "busletra":

                    $this->data['resultadoObtenido'] = $this->mod_let->busqueda_existencia_en_cancion($cadenaBusqueda);

                    break;
                case "bustitulo":

                    $this->data['resultadoObtenido'] = $this->mod_let->busqueda_cancion_por_titulo($cadenaBusqueda);

                    break;
                case "busalbum":

                    $this->data['resultadoObtenido'] = $this->mod_let->busqueda_cancion_por_album($cadenaBusqueda);

                    break;
                case "businterprete":

                    $this->data['resultadoObtenido'] = $this->mod_let->busqueda_cancion_por_interprete($cadenaBusqueda);

                    break;
            }

            $this->data['numResultados'] = count($this->data['resultadoObtenido']);

            $this->establecerContenidoPrincipal('Resultados de la búsqueda', 'resultadosBusqueda');
        }

    }

    public function categoriasLetra()
    {
        $this->data['listaGeneros'] = $this->mod_gen->lista_generos();

        $this->establecerContenidoPrincipal('Categorías de Letras', 'categoriasLetra');
    }

    public function categoriaSeleccionadaLetra($idGenero)
    {
        $this->data['nombreGenero'] = $this->mod_gen->obtener_genero($idGenero)->nombre_genero;

        $this->data['LetrasGeneroSeleccionado'] = $this->mod_can->obtener_canciones_por_genero($idGenero);

        $this->data['numResultados'] = count($this->data['LetrasGeneroSeleccionado']);

        $this->establecerContenidoPrincipal('Letras de '.$this->data['nombreGenero'], 'listaCancionesPorGenero');
    }

    public function categoriaSinGeneroLetra()
    {
        $this->data['LetrasSinGenero'] = $this->mod_can->obtener_canciones_sin_genero();

        $this->data['numResultados'] = count($this->data['LetrasSinGenero']);

        $this->establecerContenidoPrincipal('Letras sin género ', 'listaCancionesSinGenero');
    }
}	