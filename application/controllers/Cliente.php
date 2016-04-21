<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente
 *
 * @author jose
 */
class Cliente extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Clientes');
    } 
    public function index() {
    $dato['direccion']="Cliente/Comprobarcliente";
    $this->load->view('Plantilla/Header');
    $this->load->view('Clientes/Index',$dato);
    $this->load->view('Plantilla/Footer');
}
public function Cerrar() {
    $datos=array(
                    'email'=>'desconocido',
                    'logged_in' => FALSE
                );
    $this->session->set_userdata($datos);
    $this->load->model('Producto');
    $sql="SELECT * From productos where destacados=1 and oculto=1";
    $datos['hola']=  $this->Producto->Buscar($sql);
    $this->load->view('Plantilla/Header');
    $this->load->view('Principal',$datos);
    $this->load->view('Plantilla/Footer');
}
public function Agregar() {
    //$sql="select * from tbl_provincias;";
    //$datos['provincias']=$this->Clientes->leeruno($sql);
    $datos['provincia']=$this->Clientes->provincias();
    $this->load->view('Plantilla/Header');
    $this->load->view('Clientes/NuevoCliente',$datos);
    $this->load->view('Plantilla/Footer');
}
public function Micuenta() {
    $this->load->view('Plantilla/Header');
    $this->load->view('Clientes/Micuenta');
    $this->load->view('Plantilla/Footer');
}
public function Comprobarcliente() {
    $this->form_validation->set_rules('email','email','required|valid_email');
    $this->form_validation->set_rules('contrasena','contraseña','required');
    
    if($this->form_validation->run() == FALSE)
    {
        $dato['direccion']="Cliente/Comprobarcliente";
        $this->load->view('Plantilla/Header');
        $this->load->view('Clientes/Index',$dato);
        $this->load->view('Plantilla/Footer');
    }
    else
    {
        $campo="correo_electronico";
        $campo2="email";
        $email=$_POST['email'];
        $sql="select * from usuarios where correo_electronico='$email'";
        //redireccionamos al controlador de agregar el usuario
        //junto con los datos de los campos
        //$dato= $campo->$this->input->post($campo2);
        $cliente=$this->Clientes->leeruno($sql);
        if(empty($cliente))
        {
            $direccion['direccion']="Cliente/Comprobarcliente";
            $direccion['error']="Esta cuenta no existe";
            $this->load->view('Plantilla/Header');
            $this->load->view('Clientes/Index',$direccion);
            $this->load->view('Plantilla/Footer');
        }
        else
        {
            $contrasena=$_POST['contrasena'];
            $sql="select * from usuarios where correo_electronico='$email' and contraseña='$contrasena'";
            $cliente=$this->Clientes->leeruno($sql);
            if(empty($cliente))
            {
                $direccion['direccion']="Cliente/Comprobarcliente";
                $direccion['error']="La contraseña es incorrecta";
                $this->load->view('Plantilla/Header');
                $this->load->view('Clientes/Index',$direccion);
                $this->load->view('Plantilla/Footer');
            }
            else
            {
                $datos=array(
                    'email'=>$email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($datos);
                echo $_POST['compra'];
                if(isset($_POST['comprar']))
                {
                    echo"la compra se ha realizado con exito";
                }
                else{
                    
                }
                //redirect(base_url());
            }
        }
    }
}
public function Agregacliente() {
    $this->form_validation->set_rules('nombre','Nombre','required|alpha');
    $this->form_validation->set_rules('apellido','Apellidos','required|alpha');
    $this->form_validation->set_rules('email','Email','required|valid_email');
    $this->form_validation->set_rules('contrasena','Contraseña','required');
    $this->form_validation->set_rules('dni','DNI','required|exact_length[9]|regex_match[/^[0-9]{8}[A-Z]$/]');
    $this->form_validation->set_rules('cp','Codigo Postal','required');
    $this->form_validation->set_rules('nombre_usuario','Nombre de usuario','required');
    $this->form_validation->set_rules('direccion','Direccion','required');
    $this->form_validation->set_rules('provincia','Provincia','required');
    
    if($this->form_validation->run() == FALSE)
    {
        //redireccionamos a la vista del formulario otra vez
        $datos['provincia']=$this->Clientes->provincias();
        $this->load->view('Plantilla/Header');
        $this->load->view('Clientes/Nuevocliente',$datos);
        $this->load->view('Plantilla/Footer');
    }
    else
    {
        $email=$_POST['email'];
        $username=$_POST['nombre_usuario'];
        $dni=$_POST['dni'];
        $sql="select * from usuarios where correo_electronico='$email' or nombreusuario='$username' or dni='$dni'";
        $cliente=$this->Clientes->leeruno($sql);
        if(empty($cliente))
        {
            $datos = array(
                    'nombre'=>$this->input->post('nombre'),
                    'apellidos'=>$this->input->post('apellido'),
                    'correo_electronico'=>$this->input->post('email'),
                    'contraseña'=>$this->input->post('contrasena'),
                    'dni'=>$this->input->post('dni'),
                    'cp'=>$this->input->post('cp'),
                    'nombreusuario'=>$this->input->post('nombre_usuario'),
                    'direccion'=>$this->input->post('direccion'),
                    'provincia'=>$this->input->post('provincia')
                );
            $this->Clientes->insertar($datos);
            //$direccion['direccion']="Cliente/Comprobarcliente";
            //$this->load->view('Plantilla/Header');
            //$this->load->view('/Index',$direccion);
            //$this->load->view('Plantilla/Footer');
            $datos=array(
                    'email'=>$email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($datos);
            redirect(base_url());
        }
        else
        {
            $datos['provincia']=$this->Clientes->provincias();
            $datos['error']="Este usuario ya esta registrado<br>Compruebe los datos";
            $this->load->view('Plantilla/Header');
            $this->load->view('Clientes/NuevoCliente',$datos);
            $this->load->view('Plantilla/Footer');
         // aqui va el codigo si encuentra un mismo correo electrocino o mismo nombre de usuario
        }
        //redireccionamos al controlador de agregar el usuario
        //junto con los datos de los campos
        
        //$this->Clientes->insertar($datos);
        //redirect(base_url());
    }
}
public function CambiarDatos() {
        $this->load->view('Plantilla/Header');
        $this->load->view('Clientes/Cambiardatos');
        $this->load->view('Plantilla/Footer');
}
}
