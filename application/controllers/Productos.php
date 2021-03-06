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
        //$this->load->model('Producto');
    }
public function index() {
    $this->load->library('pagination');
    
  
    $config['base_url'] = site_url().'/Productos/index';
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
    
     $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Productos/index',$productos,true))
    );
}
public function Categoria($id,$seg=0) {
    //$id=$_GET['id'];
    $this->load->library('pagination');
  
    $config['base_url'] = site_url().'/Productos/Categoria/'.$id.'/';
    $config['total_rows'] = $this->Producto->filasCategoria($id);//calcula el número de filas  
    $config['per_page'] = 6; //Número de registros mostrados por páginas
    $config['num_links'] = 20; //Número de links mostrados en la paginación
    $config['first_link'] = 'Primera';//primer link
    $config['last_link'] = 'Última';//último link
    $config["uri_segment"] = 4;//el segmento de la paginación
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
    $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Productos/Ver',$productos,true))
    );
}

public function Buscar() {
    $nombre=$_GET['nombre'];
    $sql="SELECT * FROM productos WHERE nombre LIKE '%$nombre%'";
    $productos['hola']=$this->Producto->Buscar($sql);
    $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Productos/Buscar',$productos,true))
    );
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
    redirect(site_url()."/Productos/Ver_Carrito");
}

public function Ver_Carrito() {
    $datos['carrito']=  $this->cart->contents();
    $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Productos/Carrito',$datos,true))
    );
}
public function Elimina_producto_carrito() {
    $id=$_GET['id'];
        $data = array(
               'rowid'      => $id,
               'qty'    =>0,
        );
    $this->cart->update($data);
    $datos['carrito']=  $this->cart->contents();
    $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Productos/Carrito',$datos,true))
    );
}

public function Destruir_Carrito() {
    $this->cart->destroy();
    $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Productos/Carrito',0,true))
    );
}
 
function Comprar() {
    $numero_productos=  $this->cart->total_items();
    if($numero_productos>0)
    {
        $log=$this->session->userdata('logged_in');
        if($log==FALSE)
        {
            $dato['direccion']="Cliente/Comprobarcliente";
            $dato['compra']=1;
            $this->load->view('layout',array(
            'cuerpo'=>$this->load->view('Clientes/index',$dato,true)));
        }
        else
        {  
            $this->load->model('Clientes');
            $usuario=$_SESSION['email'];
            $sql="select * from usuarios where correo_electronico='$usuario'";
            $datos=$this->Clientes->leeruno($sql);
            $fecha=date("Y-m-d");
            $val=0;
            $error="";
            foreach ($this->cart->contents() as $items)
            {
                $id=$items['id'];
                $cantidad=$items['qty'];
                $sql="select nombre,cantidad from productos where id_productos='$id'";
                $numero=$this->Producto->Buscar($sql);
                foreach ($numero as $cant)
                {
                    if($cant['cantidad']<$cantidad)
                    {
                        $val=1;
                        $error.="Cantidad de ".$cant['nombre']." por encima del Stock <br>";
                    }
                }
            }
            if($val==0)
            {
                foreach ($datos as $dato)
                {
                    $datosusuario=array('direccion'=>$dato['direccion'],'fecha'=>$fecha,
                    'estado'=>'pendiente','usuarios_id'=>$dato['id'],'cp'=>$dato['cp'],
                        'provincia'=>$dato['provincia']);
                }
                $id_pedido=$this->Clientes->Comprar($datosusuario);
                if(!isset($descuento))
                {
                   $descuento=NULL;
                }
                foreach ($this->cart->contents() as $items)
                {
                    $id=$items['id'];
                    $cantidad=$items['qty'];
                    $precio=$items['price'];    
                    $producto=array('id_productos'=>$id,'pedidos_id'=>$id_pedido,
                    'precio'=>$precio,'descuento'=>$descuento,'cantidad'=>$cantidad);
                    $this->Clientes->Comprar2($producto);
                }
                $this->cart->destroy(); 
                $id=$_SESSION['id'];
                $sql="select * from pedidos where usuarios_id='$id'";
                $datos['pedidos']=$this->Clientes->leeruno($sql);
                $this->load->view('layout',array(
                'cuerpo'=>$this->load->view('Clientes/Micuenta',$datos,true)));
            }
            else{
                 $dato['error']="<h3>$error</h3>";
            $this->load->view('layout',array(
            'cuerpo'=>$this->load->view('Productos/Carrito',$dato,true)));
                }
          }
            $datos['carrito']=  $this->cart->contents();  
    }
    else
    {
        $dato['error']="<h3>No tienes ningun articulo en la cesta</h3>";
        $this->load->view('layout',array(
        'cuerpo'=>$this->load->view('Productos/Carrito',$dato,true)));
    }
}
}
