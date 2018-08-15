<?php

/*
 * class Accesos
 */

class Accesos extends CI_Model {
    /*
     * __construct()
     * Función constructora del modelo
     */

    function __construct() {
        parent::__construct();
    }

    function getUserInfo($clvusuario) {
        $query = $this->db->select('*')
                ->from('accesos')
                ->join('personas', 'accesos.id_persona = personas.id_persona')
                ->where(array('id_acceso' => $clvusuario))
                ->get();

        if ($query->num_rows() > 0) {

            $user["info"] = $query->result_array();
            
        } else
            $user = false;

        return $user;
    }
    
    function getUserInfoTecnicos($clvusuario=null,$where=null) {
        if($where == null){
            $where = array('estatus' => '1','id_perfil'=>'3');
        }
        if($clvusuario != null){
            $where = array('estatus' => '1','id_perfil'=>'3','id_acceso'=>$clvusuario);
        }
        $query = $this->db->select('*')
                ->from('accesos')
                ->join('personas', 'accesos.id_persona = personas.id_persona')
                ->where($where)
                ->get();

        if ($query->num_rows() > 0) {

            $user = $query->result_array();
            
        } else
            $user = false;

        return $user;
    }

    /*
     * function authenticate
     * @param $strlogin, $strclave
     */

 
    function authenticateBDSYS($user,$clave) {

        $query = $this->db->select('id_acceso')
                ->where(array(
                    'usuario' => $user,
                    'clave' => $clave,
                    'estatus' => '1'
                ))
                ->get('accesos');

        if ($query->num_rows() > 0) {
            $clvusuario = $query->result_array();
            $clvusuario = $clvusuario[0]['id_acceso'];
            

            $user = $this->getUserInfo($clvusuario);
            
            return $user;
        } else {
            return false;
        }
    }
    
    function authenticateBDSYS2($user,$clave) {

        $query = $this->db->select('id_acceso')
                ->where(array(
                    'usuario' => $user,
                    'clave' => $clave,
                    'estatus' => '4'
                ))
                ->get('accesos');

        if ($query->num_rows() > 0) {
            $clvusuario = $query->result_array();
            $clvusuario = $clvusuario[0]['id_acceso'];
            

            $user = $this->getUserInfo($clvusuario);
            return $user;
        } else {
            return false;
        }
    }

    function datauser($ci) {
        $query = $this->db->select('id_persona')
                ->where(array(
                    'ci' => $strlogin,
                    'estatus' => '1'
                ))
                ->get('accesos');

        if ($query->num_rows() > 0) {
            $clvusuario = $query->result_array();
            $clvusuario = $clvusuario[0]['id_persona'];
            return $this->getUserInfo($clvusuario);
        } else
            return false;
    }

    /*
     * function listadoUsuarios
     * @param 
     */

    function listadoUsuarios() {
        $query = $this->db->select('accesos.id_acceso,personas.nombre,personas.apellido,personas.correo,accesos.estatus,accesos.usuario,perfiles.perfil,perfiles.id_perfil')
                ->from('accesos')
                ->join('personas', 'accesos.id_persona = personas.id_persona')
                ->join('perfiles', 'accesos.id_perfil = perfiles.id_perfil')
                ->where(array('accesos.estatus !=' => '0'))
                ->order_by('personas.id_persona','asc')
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
