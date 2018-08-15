<?php

/*
 * class m_listas_generales
 */

class General extends CI_Model {
    /*
     * __construct()
     * Función constructora del modelo
     */

    function __construct() {
        parent::__construct();
    }

    /*
     * function listadoPerfil
     * @param 
     */

    function listadoPerfil() {
        $query = $this->db->select('*')
                /* ->where(array(
                  'estatus ' => 'true',
                  )) */
                ->get('perfiles');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else
            return false;
    }

    
    function conexionAPI($uri){
        $ch = curl_init($uri);
        curl_setopt_array($ch, array(
            CURLOPT_HTTPHEADER  => array(TOKEN),
            CURLOPT_RETURNTRANSFER  =>true,
            CURLOPT_VERBOSE     => 1
        ));
        $out = curl_exec($ch);
        curl_close($ch);
        $jsondata = json_decode($out);
        return $jsondata;
    }
    
    /*
     * function insercionGeneral
     * @param 'data','tabla'
     */

    function insercionGeneral($data, $tipo) {
        //$this->db->insert_id();

        if ($this->db->insert($data['tabla'], $data['data'])) {
            if ($tipo == 1) {
                return true;
            } elseif ($tipo == 2) {
                return $this->db->insert_id();
            }
        } else
            return false;
    }
    
    /*
     * function ModificarDatosGeneral
     * @param 'data','tabla','where'
     */

    function ModificarDatosGeneral($data) {
        $query_persona = $this->db->where($data['where'])
                ->update($data['tabla'], $data['data']);
        if ($query_persona) {
            return true;
        } else
            return false;
    }
    
    function NumDatos($table,$where,$campos) {
        $query = $this->db->select($campos)
                ->where($where)
                ->get($table);
            return $query->num_rows();
    }
    
    function DataUser($clvusuario) {
        $query = $this->db->select('*')
                ->from('accesos')
                ->join('personas', 'accesos.id_persona = personas.id_persona')
                ->where(array('accesos.id_acceso' => $clvusuario))
                ->get();

        if ($query->num_rows() > 0) {

            $user = $query->result_array();
        } else
            $user = false;

        return $user;
    }
    
}    
