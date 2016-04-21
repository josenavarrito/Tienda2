<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once APPPATH.'/third_party/fpdf.php';
/**
 * Description of Pdf
 *
 * @author jose
 */
class Hector extends FPDF{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function Header() {
        $this->SetFont('Arial','B',13);
        $this->Cell(30);
        $this->Cell(120,10,'Paises',0,0,'C');
            
    }
    
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina'.$this->PageNo(),0,0,'C');
    }
    
    public function Contenedor() {
        $this->load->database('Tienda');
        $datos=$this->db->get('tbl_provincias');
        return $datos->result();
    }
}
