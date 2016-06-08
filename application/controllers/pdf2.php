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
class pdf2 extends CI_Controller{
    //put your code here
    function Index() {
        $this->load->library('pdf');
        $this->load->model('Producto');
        $provincias=$this->Producto->LeeTodo();
        
        $this->pdf=new Pdf();
        $this->pdf->AddPage();
        foreach ($provincias as $provincia)
        {
            $this->pdf->Cell(25,5,$provincia->nombre,'B',0,'L',0);
            $this->pdf->Ln(5);
        }
        $this->pdf->Output('Lista de provincias.pdf','I');
}
    
}
