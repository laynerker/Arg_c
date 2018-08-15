<?php

/*
 * class Trabajos
 */

class Trabajos extends CI_Model {
    /*
     * __construct()
     * Función constructora del modelo
     */

    function __construct() {
        parent::__construct();
    }


    
    /*
     * function verificarGeneral
     * @param 'tabla','campo'
     */

    function verificarGeneral($buscar) {

        $query = $this->db->select('*')
                ->from($buscar['tabla'])
                ->where($buscar['campo'])
                ->get();

        if ($query->num_rows() > 0) {
            return true;
            //echo $query->num_rows().'holllll';
            exit();
        } else
            return false;
    }
    
    

}
