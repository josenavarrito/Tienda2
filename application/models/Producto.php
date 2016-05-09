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
class Producto extends CI_Model{
    public function insertar($datos) {
        $this->db->insert('productos',$datos);
    }
    public function LeeTodo() {
        $query=$this->db->query("SELECT * from productos where oculto!=0 order by categorias_id");
        return $query->result_array();
    }
    Public function Buscar($sql){
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    
    public function Filas() {
        $sql = $this->db->query('SELECT * from productos where oculto!=0');
		return  $sql->num_rows() ;
    }
    
    function total_paginados($por_pagina,$segmento) 
        {
            $sql = $this->db
                    ->limit($por_pagina,$segmento)
                    ->where("oculto!=0")
                    ->order_by("categorias_id")
                    ->get('productos');
            if($sql->num_rows()>0)
            {
                foreach($sql->result() as $fila)
		{
		    $data[] = $fila;
		}
                    return $data;
            }
	}
        
       public function FilasCategoria($categoria) {
        $sql = $this->db->query("SELECT * from productos where oculto!=0 and categorias_id='$categoria'");
		return  $sql->num_rows() ;
    }
    
    function total_paginados_categoria($categoria,$por_pagina,$segmento) 
        {
            $sql = $this->db
                    ->limit($por_pagina,$segmento)
                    ->where("oculto!=0 and categorias_id=$categoria")
                    ->get('productos');
            if($sql->num_rows()>0)
            {
                foreach($sql->result() as $fila)
		{
		    $data[] = $fila;
		}
                    return $data;
            }
	}
        function Categorias() {
            $sql=$this->db->query("SELECT id,nombre from categorias");
            return $sql->result_array();
        }
}
