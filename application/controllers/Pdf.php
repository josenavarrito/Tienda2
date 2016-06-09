<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pdf
 *
 * @author jose
 */
class Pdf extends CI_Controller{
    //put your code here
    function Index($id) {
        $this->load->library('Pdf_jose');
        $this->load->model('Clientes');
        $sql="select nombre, apellidos, dni, pedidos.direccion as direc "
                . "from usuarios join pedidos on usuarios_id=usuarios.id "
                . "where pedidos.id='$id'";
        $clietes=$this->Clientes->leeruno($sql);
        $sql="select precio,cantidad,id_productos "
                . "from lineapedidos "
                . "where pedidos_id='$id'";
        $pedidos=$this->Clientes->leeruno($sql);
        
        $this->pdf=new Pdf_jose();
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
 
    /* Se define el titulo, márgenes izquierdo, derecho y
     * el color de relleno predeterminado
     */
    $this->pdf->SetTitle("Lista de alumnos");
    $this->pdf->SetLeftMargin(15);
    $this->pdf->SetRightMargin(15);
    $this->pdf->SetFillColor(200,200,200);
 
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'B', 9);
    /*
     * TITULOS DE COLUMNAS
     *
     * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
     */
    foreach ($clietes as $cliente)
    {
    $this->pdf->Cell(17,5,utf8_decode('Sr/Sra: '.$cliente['nombre']),0,0,'C',0);
    $this->pdf->Cell(80,5,utf8_decode($cliente['apellidos']),0,1,'L',0);
    $this->pdf->Cell(75,5,utf8_decode("DNI: ".$cliente['dni']),0,1,'L',0);
    $this->pdf->Cell(10,5,utf8_decode("Direccion: ".$cliente['direc']),0,1,'L',0);
    $this->pdf->Ln(7);
    }
      $this->pdf->Cell(15,5,utf8_decode("Nº"),'TBL',0,'C',0);
      // Se imprimen los datos de cada alumno
      $this->pdf->Cell(60,5,utf8_decode("Producto"),'TB',0,'L',0);
      $this->pdf->Cell(50,5,"Cantidad",'TB',0,'L',0);
      $this->pdf->Cell(40,5,"Precio",'TB',0,'L',0);
      //$porcentaje=round($apellido->cantidad/($total/100),2);
      $this->pdf->Cell(10,5,"Total",'TBR',0,'L',0);
      //Se agrega un salto de linea
      $this->pdf->Ln(5);
    // La variable $x se utiliza para mostrar un número consecutivo
    $x = 1;
    foreach ($pedidos as $pedido) {
        $sql="select nombre "
                . "from productos "
                . "where id_productos='".$pedido['id_productos']."'";
        $productos=$this->Clientes->leeruno($sql);
        foreach ($productos as $producto) {
            
        }
      // se imprime el numero actual y despues se incrementa el valor de $x en uno
      $this->pdf->Cell(15,5,$x++,'TBL',0,'C',0);
      // Se imprimen los datos de cada alumno
      $this->pdf->Cell(60,5,utf8_decode($producto['nombre']),'TB',0,'L',0);
      $this->pdf->Cell(50,5,$pedido['cantidad'],'TB',0,'L',0);
      $this->pdf->Cell(40,5,$pedido['precio'].iconv('UTF-8', 'windows-1252', " €"),'TB',0,'L',0);
      //$porcentaje=round($apellido->cantidad/($total/100),2);
      $this->pdf->Cell(10,5,$pedido['cantidad']*$pedido['precio'].iconv('UTF-8', 'windows-1252', " €"),'TBR',0,'L',0);
      //Se agrega un salto de linea
      $this->pdf->Ln(5);
    }
    /*
     * Se manda el pdf al navegador
     *
     * $this->pdf->Output(nombredelarchivo, destino);
     *
     * I = Muestra el pdf en el navegador
     * D = Envia el pdf para descarga
     *
     */
    $this->pdf->Output("Lista de alumnos.pdf", 'I');
}
    
}
