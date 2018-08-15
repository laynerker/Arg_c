<?php

/*
 * class Perfiles
 */

class Perfiles extends CI_Model {
    /*
     * __construct()
     * Función constructora del modelo
     */

    function __construct() {
        parent::__construct();
    }


    /*
     * function listadoPerfiles
     * @param 
     */

    function listadoPerfiles($id=null) {
        $where = null;
        if($id == null){
            $where = array('estatus !=' => '0');
        }else{
            $where = array('estatus !=' => '0','id_perfil'=>$id);
        }
        $query = $this->db->select('*')
                ->from('perfiles')
                ->where($where)
                ->order_by('id_perfil','asc')
                ->get();
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row)
                $data[] = $row;

            return $data;
        } else {
            //echo $this->db->last_query();
            return false;
        }
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
