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
class Clientes extends CI_Model {
    public function insertar($datos) {
        $this->db->insert('usuarios',$datos);
    }
    public function LeeTodo() {
        $query=$this->db->get('usuarios');
        return $query->result();
    }
    public function leeruno($sql) {
        $query=$this->db->query($sql);
        return $query->result_array();
        
    }
    public function Modificar($sql) {
        $query=$this->db->query($sql);
    }
    public function provincias() {
        $query=$this->db->get('tbl_provincias');
        return $query->result_array();
    }
}
