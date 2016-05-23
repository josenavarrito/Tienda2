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
        $dato['direccion']="/Cliente/Comprobarcliente";
        $this->load->view('layout',array(
            'cuerpo'=>$this->load->view('Clientes/index',$dato,true)));
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
    $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Principal',$datos,true))
    );
}
public function Agregar() {
    //$sql="select * from tbl_provincias;";
    //$datos['provincias']=$this->Clientes->leeruno($sql);
    $datos['provincia']=$this->Clientes->provincias();
    $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/Nuevocliente',$datos,true))
    );
}
public function Micuenta($id) {
    if($id=="pedidos")
    {
        $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/Micuenta',0,true))
    );
    }
   else if($id=="datos")
    {
        $email=$_SESSION['email'];
        $sql="select * from usuarios where correo_electronico='$email'";
        $datos['dato']=$this->Clientes->leeruno($sql);
        $datos['provincia']=$this->Clientes->provincias();
        $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/Cambiardatos',$datos,true))
    );
    }
    else if($id=="contrasena")
    {
        $email=$_SESSION['email'];
        $sql="select * from usuarios where correo_electronico='$email'";
        $datos['dato']=$this->Clientes->leeruno($sql);
        $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/Cambiarcontrasena',$datos,true))
        );
    }
     else if($id=="guardacontrasena")
    {
        $this->form_validation->set_rules('contrasenaactual','Contraseña Actual','required');
        $this->form_validation->set_rules('nuevacontrasena','Nueva Contraseña','required');
         if($this->form_validation->run() == FALSE)
        {
            $email=$_SESSION['email'];
            $sql="select * from usuarios where correo_electronico='$email'";
            $datos['dato']=$this->Clientes->leeruno($sql);
            $this->load->view('layout',array(
            'cuerpo'=>$this->load->view('Clientes/Cambiarcontrasena',$datos,true))
            );
            
        }
        else
        {
            $email=$_SESSION['email'];
            $contraseña=$_POST['contrasenaactual'];            
            $sql="select * from usuarios where correo_electronico='$email' and contraseña='$contraseña'";
            $cliente=$this->Clientes->leeruno($sql);
            if(empty($cliente))
            {
                $sql="select * from usuarios where correo_electronico='$email'";
                $datos['dato']=$this->Clientes->leeruno($sql);
                $datos['error']="Contraseña Actual Incorrecta";
                $this->load->view('layout',array(
                'cuerpo'=>$this->load->view('Clientes/Cambiarcontrasena',$datos,true))
                );
            }
            else{
                $nuevacontraseña=$_POST['nuevacontrasena'];
                $sql="update usuarios set contraseña='$nuevacontraseña' where correo_electronico='$email'";
                $cliente=$this->Clientes->Modificar($sql);
                $this->load->view('layout',array(
                'cuerpo'=>$this->load->view('Clientes/Cambios',0,true))
                );
            }
        }
    }
     else if($id=="guardacambios")
    {   $this->form_validation->set_rules('nombreusuario','Nombre de usuario','required');
        $this->form_validation->set_rules('nombre','Nombre','required');
        $this->form_validation->set_rules('apellido','Apellido','required');
        $this->form_validation->set_rules('dni','DNI','required|exact_length[9]|regex_match[/^[0-9]{8}[A-Z]$/]');
        $this->form_validation->set_rules('direccion','Direccion','required');
        $this->form_validation->set_rules('cp','Codigo Postal','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('provincia','Provincia','required');
       if($this->form_validation->run() == FALSE)
        {
            $email=$_SESSION['email'];
            $sql="select * from usuarios where correo_electronico='$email'";
            $datos['dato']=$this->Clientes->leeruno($sql);
            $datos['provincia']=$this->Clientes->provincias();
            $this->load->view('layout',array(
            'cuerpo'=>$this->load->view('Clientes/Cambiardatos',$datos,true))
            );
        }
        else
        {
            $usuario=$_SESSION['email'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $dni=$_POST['dni'];
            $direccion=$_POST['direccion'];
            $cp=$_POST['cp'];
            $email=$_POST['email'];
            $provincia=$_POST['provincia'];
            $nombreusuario=$_POST['nombreusuario'];
            if($provincia=='Provincia')
            {    
                $email=$_SESSION['email'];
                $sql="select * from usuarios where correo_electronico='$email'";
                $datos['dato']=$this->Clientes->leeruno($sql);
                $datos['provincia']=$this->Clientes->provincias();
                $datos['error']="Elige una Provincia";
                $this->load->view('layout',array(
                'cuerpo'=>$this->load->view('Clientes/Cambiardatos',$datos,true))
                );
            }
            else{
            $sql="update usuarios set nombre='$nombre', apellidos='$apellido',"
                    . "dni='$dni', direccion='$direccion', cp='$cp',"
                    . "correo_electronico='$email', provincia='$provincia',"
                    . "nombreusuario='$nombreusuario' where correo_electronico='$usuario'";
                $cliente=$this->Clientes->Modificar($sql);
                $datos=array(
                    'email'=>$email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($datos);
                $this->load->view('layout',array(
                'cuerpo'=>$this->load->view('Clientes/Cambios',0,true))
                );
        };
        }
    }
    else{
    redirect(site_url());
    }
}
public function Comprobarcliente() {
    $this->form_validation->set_rules('email','email','required|valid_email');
    $this->form_validation->set_rules('contrasena','contraseña','required');
    
    if($this->form_validation->run() == FALSE)
    {
        $dato['direccion']="/Cliente/Comprobarcliente";
        $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/index',$dato,true))
    );
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
            $direccion['direccion']="/Cliente/Comprobarcliente";
            $direccion['error']="Esta cuenta no existe";
            $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/index',$direccion,true))
    );
        }
        else
        {
            $contrasena=$_POST['contrasena'];
            $sql="select * from usuarios where correo_electronico='$email' and contraseña='$contrasena'";
            $cliente=$this->Clientes->leeruno($sql);
            if(empty($cliente))
            {
                $direccion['direccion']="/Cliente/Comprobarcliente";
                $direccion['error']="La contraseña es incorrecta";
                $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/index',$direccion,true))
    );
            }
            else
            {
                $datos=array(
                    'email'=>$email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($datos);
                if(isset($_POST['compra']))
                {
                    
                    redirect(site_url("/Productos/Comprar"));
                }
                else{
                    redirect(site_url());
                }
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
        $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/Nuevocliente',$datos,true))
    );
    }
    else
    {
        $provincia=$_POST['provincia'];
        if($provincia=='Provincia')
        {
            $datos['provincia']=$this->Clientes->provincias();
            $datos['error']="Elige una Provincia";
            $this->load->view('layout',array(
            'cuerpo'=>$this->load->view('Clientes/Nuevocliente',$datos,true)));
        }
        else{
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
            redirect(site_url());
        }
        else
        {
            $datos['provincia']=$this->Clientes->provincias();
            $datos['error']="Este usuario ya esta registrado<br>Compruebe los datos";
            $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Clientes/Nuevocliente',$datos,true))
    );
         // aqui va el codigo si encuentra un mismo correo electrocino o mismo nombre de usuario
        }
        //redireccionamos al controlador de agregar el usuario
        //junto con los datos de los campos
        
        //$this->Clientes->insertar($datos);
        //redirect(base_url());
}}
}
}
