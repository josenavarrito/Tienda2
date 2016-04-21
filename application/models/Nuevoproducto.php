<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nuevoproducto
 *
 * @author 2DAW
 */
class Nuevoproducto extends CI_Model{
    public function insertar($datos) {
        $this->db->insert('productos',$datos);
    }
    public function LeeTodo() {
        $query=$this->db->query('SELECT * from productos');
        return $query->result();
    }
}
