<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Clientes
 *
 * @author jose
 */
class Productos extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Producto');
    }
    public function Prueba() {
        $this->load->view('layout');
    }
public function index() {
    $this->load->library('pagination');
  
    $config['base_url'] = base_url().'Productos/index';
    $config['total_rows'] = $this->Producto->filas();//calcula el número de filas  
    $config['per_page'] = 6; //Número de registros mostrados por páginas
    $config['num_links'] = 20; //Número de links mostrados en la paginación
    $config['first_link'] = 'Primera';//primer link
    $config['last_link'] = 'Última';//último link
    $config["uri_segment"] = 3;//el segmento de la paginación
    $config['next_link'] = 'Siguiente';//siguiente link
    $config['prev_link'] = 'Anterior';//anterior link
    $this->pagination->initialize($config); //inicializamos la paginación		
    $productos["lista"] = $this->Producto->total_paginados($config['per_page'],$this->uri->segment(3));			
    //cargamos la vista y el array data
    
    $this->load->view('Plantilla/Header');
    $this->load->view('Productos/Index',$productos);
    $this->load->view('Plantilla/Footer');
}
public function Categoria($id,$seg=0) {
    //$id=$_GET['id'];
    $this->load->library('pagination');
  
    $config['base_url'] = base_url().'Productos/index';
    $config['total_rows'] = $this->Producto->filasCategoria($id);//calcula el número de filas  
    $config['per_page'] = 6; //Número de registros mostrados por páginas
    $config['num_links'] = 20; //Número de links mostrados en la paginación
    $config['first_link'] = 'Primera';//primer link
    $config['last_link'] = 'Última';//último link
    $config["uri_segment"] = 3;//el segmento de la paginación
    $config['next_link'] = 'Siguiente';//siguiente link
    $config['prev_link'] = 'Anterior';//anterior link
    $this->pagination->initialize($config); //inicializamos la paginación		
    $productos["lista"] = $this->Producto->total_paginados_categoria($id,$config['per_page'],$seg);
    
    $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Productos/index',$productos,true))
    );
//    $this->load->view('Plantilla/Header'); 
//    $this->load->view('Productos/Index',$productos);   
//    $this->load->view('Plantilla/Footer');
}
public function Producto() {
   
    $id=$_GET['id'];
    $sql="SELECT * FROM productos WHERE id_productos=$id";
    $productos['hola']=$this->Producto->Buscar($sql);
    $this->load->view('Plantilla/Header');
    $this->load->view('Productos/Ver',$productos);
    $this->load->view('Plantilla/Footer');      
}

public function Buscar() {
    $nombre=$_GET['nombre'];
    $sql="SELECT * FROM productos WHERE nombre LIKE '%$nombre%'";
    $productos['hola']=$this->Producto->Buscar($sql);
    $this->load->view('Plantilla/Header');
    $this->load->view('Productos/Buscar',$productos);
    $this->load->view('Plantilla/Footer');      
}

public function Anadir_Carrito() {
    if(isset($_POST['id']))
        $id=$_POST['id'];
    else
        $id=$_GET['id'];
    $sql="SELECT * FROM productos WHERE id_productos=$id";
    $producto=$this->Producto->Buscar($sql);
    //echo $producto->nombre;
    foreach ($producto as $prod)
    {
        if(isset($_GET['cantidad']))
            $cantidad=$_GET['cantidad'];
        else if(isset($_POST['cantidad']))
            $cantidad=$_POST['cantidad'];
        else
            $cantidad=1;
        $data = array(
               'id'      => $prod['id_productos'],
               'qty'     => $cantidad,
               'price'   => $prod['precio'],
               'name'    => $prod['nombre'],
         );
    }
    $this->cart->insert($data);
    redirect(base_url()."Productos/Ver_Carrito");
}

public function Ver_Carrito() {
    $datos['carrito']=  $this->cart->contents();
    $this->load->view('Plantilla/Header');
    $this->load->view('Productos/Carrito',$datos);
    $this->load->view('Plantilla/Footer');    
}
public function Elimina_producto_carrito() {
    $id=$_GET['id'];
        $data = array(
               'rowid'      => $id,
               'qty'    =>0,
        );
    $this->cart->update($data);
    $datos['carrito']=  $this->cart->contents();
    $this->load->view('Plantilla/Header');
    $this->load->view('Productos/Carrito',$datos);
    $this->load->view('Plantilla/Footer');    
}

public function Destruir_Carrito() {
    $this->cart->destroy();
    $this->load->view('Plantilla/Header');
    $this->load->view('Productos/Carrito');
    $this->load->view('Plantilla/Footer');
}
 
function Comprar() {
    $log=$this->session->userdata('logged_in');
          if($log==FALSE)
          {
              $dato['direccion']="Cliente/Comprobarcliente";
              $dato['compra']=1;
              $this->load->view('Plantilla/Header');
              $this->load->view('Clientes/index',$dato);
              $this->load->view('Plantilla/Footer');
          }
          else
          {
              echo "la compra se ha realizado con exito";
          }
    $datos['carrito']=  $this->cart->contents();
}
}
