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
class Nuevocliente extends CI_Model {
    public function insertar($datos) {
        $this->db->insert('Clientes',$datos);
    }
    public function LeeTodo() {
        $query=$this->db->get('Clientes');
        return $query->result();
    }
}
