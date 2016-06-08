<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once APPPATH.'/third_party/fpdf/fpdf.php';
/**
 * Description of Pdf
 *
 * @author jose
 */
class Pdf_jose extends FPDF{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function Header() {
        $this->SetFont('Arial','B',18);
        $this->Cell(30);
        $this->Cell(120,10,'Resumen de Factura',0,1,'C');
        $this->Cell(180,20,'MuchBeard',0,1,'C');
            
    }
    
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina'.$this->PageNo(),0,0,'C');
    }
}
