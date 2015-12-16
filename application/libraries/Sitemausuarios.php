<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Sistemausuarios{

    /**
     * Reference to the CodeIgniter instance
     *
     * @var object
     */
    protected $CI;

    /**
     * Id usuario
     *
     * @var int
     */
    public $_id = 0;

    /**
     * Nombre con el que se registró el usuario
     *
     * @var string
     */
    public $_nombreRegistro = "";

    /**
     * Contraseña del usuario
     *
     * @var string
     */
    public $_pass = "";

    /**
     * Nivel de usuario (usuario común o administrador)
     *
     * @var string
     */
    public $_nivel = "";

    /**
     * Para comprobar si el usuario está bien autentificado
     *
     * @var bool
     */
    public $_autentificado = FALSE;

    public function __construct($auto = TRUE)
    {
        if($auto)
        {
            $this->CI =& get_instance();

            $this->CI->load->model('Modelo_usuario','mod_usu'); //Cargamos el modelo usuario

            if($this->login($this->CI->session->userdata('nombreRegistro'), $this->CI->session->userdata('pass')))
            {
                $this->_id = $this->CI->session->userdata('id');
                $this->_nombreRegistro = $this->CI->session->userdata('nombreRegistro');
                $this->_pass = $this->CI->session->userdata('pass');
                $this->_nivel = $this->CI->session->userdata('nivel');
            }
        }
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getNombreRegistro()
    {
        return $this->_nombreRegistro;
    }

    public function getPass()
    {
        return $this->_pass;
    }

    public function getNivel()
    {
        return $this->_nivel;
    }

    public function login($nick = "", $clave = "")
    {
        if(emptyempty($nick)||emptyempty($clave))
        return FALSE;

        $this->CI =& get_instance();

        $loginValido = $this->mod_usu->comprobarUsuarioYPassword($nick, $clave);

        //login ok
        if($loginValido)
        {
            $this->CI->session->set_userdata('id', $loginValido->id_usuario);
            $this->_id = $loginValido->id_usuario;
            $this->CI->session->set_userdata('nombreRegistro', $nick);
            $this->_nombreRegistro = $nick;
            $this->CI->session->set_userdata('pass', $clave);
            $this->_pass = $clave;
            $this->CI->session->set_userdata('nivel', $loginValido->nivel_usuario);
            $this->_nivel = $loginValido->nivel_usuario;
            $this->_autentificado = TRUE;

            return TRUE;
        }
        else
        {
            $this->_autentificado = FALSE;
            $this->logout();

            return FALSE;
        }
    }

    public function logout()
    {
        $this->CI =& get_instance();
        $this->CI->session->sess_destroy();
        $this->_autentificado = FALSE;
    }

    /**
     * Comprueba si el nivel de usuario es Administrador o no
     *
     * @return bool
     */
    public function checkAdmin()
    {
        if(!$this->_autentificado)
        {
            return FALSE;
        }

        if($this->_nivel == "A")
        {
            return TRUE;
        }

        else
        {
            return FALSE;
        }
    }

}