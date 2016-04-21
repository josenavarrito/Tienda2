<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Producto');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $sesion=$this->session;
            if($sesion=="")
            {
                $datos = array(
                    'email'=>"desconocido",
                    'logged_in' => FALSE
                    ); 
                $this->session->set_userdata($datos);
            }
          $email=$this->session->userdata('email');
          if($email=="")
          {
              $datos = array(
                    'email'=>"desconocido",
                    'logged_in' => FALSE
                    ); 
                $this->session->set_userdata($datos);
          }
          $sql="SELECT * From productos where destacados=1 and oculto=1";
          $datos['hola']=  $this->Producto->Buscar($sql);
		//echo $this->session->userdata('email');
		$this->load->view('Plantilla/Header');
                $this->load->view('Principal',$datos);
                $this->load->view('Plantilla/Footer');
	}
        public function Empresa()
	{
		$this->load->view('Plantilla/Header');
                $this->load->view('Somos');
                $this->load->view('Plantilla/Footer');
	}
}
