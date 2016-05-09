<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrador
 *
 * @author 2DAW
 */
class Administrador extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Producto');
    }

    
    // Cambio de prueba
    
    public function index() {
                $dato['direccion']="Administrador/Comprobaradministrador";
                $this->load->view('Plantilla/Header');
                $this->load->view('Clientes/Index',$dato);
                $this->load->view('Plantilla/Footer');
    } 
    public function Comprobaradministrador() {
    $this->form_validation->set_rules('email','email','required');
    $this->form_validation->set_rules('contrasena','contraseña','required');
    
    if($this->form_validation->run() == FALSE)
    {
        $dato['direccion']="Administrador/Comprobaradministrador";
        $this->load->view('Plantilla/Header');
        $this->load->view('Clientes/Index',$dato);
        $this->load->view('Plantilla/Footer');
    }
    else
    {
        $campo="Nombre en la base de datos";
        $campo2="Nombre en el formulario";
        //redireccionamos al controlador de agregar el usuario
        //junto con los datos de los campos
        $datos = array(
           $campo->$this->input->post($campo2),
            $campo->$this->input->post($campo2)
        );
        $this->Clientes->insertar($datos);
        redirect(base_url());
    }
}
public function AgregarProducto() {
    $this->load->view('Plantilla/Header');
    $this->load->view('Administrador/Agregar');
    $this->load->view('Plantilla/Footer');
}
public function Insertarproducto() {
    $this->form_validation->set_rules('nombres','Nombre','required');
    $this->form_validation->set_rules('precios','Precio','required');
    $this->form_validation->set_rules('imagenes','Imagen','required');
    $this->form_validation->set_rules('descripciones','Descripcion','required');
    $this->form_validation->set_rules('cantidades','Cantidad','required');
    $this->form_validation->set_rules('categorias','Categoria','required');
    $this->form_validation->set_rules('descuentos','Descuento','');
    $this->form_validation->set_rules('codigos','Codigo','');
    $this->form_validation->set_rules('destacado','Destacados','');
    $this->form_validation->set_rules('fecha_i','Fecha de Inicio','');
    $this->form_validation->set_rules('fecha_f','Fecha Final','');
    $this->form_validation->set_rules('ocultos','oculto','');
    $this->form_validation->set_rules('anuncios','Anuncio','');
    $this->form_validation->set_rules('ivas','Iva','');
    if($_POST['codigos']=="")
        {
            $_POST['codigos']=NULL;
        }
    
    if($this->form_validation->run() == FALSE)
    {
        $this->load->view('Plantilla/Header');
        $this->load->view('Administrador/Agregar');
        $this->load->view('Plantilla/Footer');
    }
    else
    {
      /*  $campo=array(
            "nombre"=>"nombres",
            "precio",
            "imagen","descripcion","cantidad","categoria_id",
            "descuento","codigo","destacados","fecha_inicio","fecha_final","oculto",
            'anuncio',"iva");
        $campo2=array(,"precios","imagenes","descripciones","cantidades","categorias",
            "descuentos","codigos","destacado","fecha_i","fecha_f","ocultos",
            'anuncios',"ivas");
        */
        if(isset($_POST['ocultos']))
           $ocultos=0; 
        else
            $ocultos=1; 
        if(isset($_POST['destacado']))
            $destacado=1;
        else
            $destacado=0;
        $datos=array(
            'nombre'=>$this->input->post('nombres'),
            'precio'=>$this->input->post('precios'),
            'imagen'=>$this->input->post('imagenes'),
            'descripcion'=>$this->input->post('descripciones'),
            'cantidad'=>$this->input->post('cantidades'),
            'categorias_id'=>$this->input->post('categorias'),
            'descuento'=>$this->input->post('descuentos'),
            'codigo'=>$this->input->post('codigos'),
            'destacados'=>$destacado,
            'fecha_inicio'=>$this->input->post('fecha_i'),
            'fecha_final'=>$this->input->post('fecha_f'),
            'oculto'=>$ocultos,
            'anuncio'=>$this->input->post('anuncios'),
            'iva'=>$this->input->post('ivas'),
        );
        
        /*foreach($campo as $nombre_bd=>$nombre_form) {
            $registro[$nombre_bd]=$this->input->post($nombre_form);
        }
        */
        $this->Producto->insertar($datos);
        redirect(base_url()."Administrador");
    }
}


}
