<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrabajos extends CI_Controller {

	public function __construct() {
        parent::__construct();
        //$this->load->helper('text');
        $this->load->helper(array('form', 'url', 'text'));
        $this->load->library('session');
        $this->load->model("General");
    }

    public function index() {
        $this->load->view('login');
    }

    
    public function searchEmpre(){
        $where = array('rif' => $this->input->post("rif"),'estatus_empre !=' => '0',);
        $valor = $this->General->listadoEmpresas(null,$where);
        if($valor != 'false'){
            echo json_encode($valor);
        }else{
            echo $valor;
        }
    }
    

public function RegistroTrabajo() {        
            $datos_t = array(
                'nombre' => $this->input->post("nombre"),
                'descripcion' => $this->input->post("descrip"),
                'estatus_trab' => '1'
            );
            $data_t = array(
                'data' => $datos_t,
                'tabla' => 'trabajos'
            );
            try {
                // inicio de la transanccion en sql
                $this->db->trans_begin();
                // procedimiento transsaccional de insercion
                $id = $this->General->insercionGeneral($data_t, '2');  
            
                // cierre de la transaccion
                $this->db->trans_commit();
            } catch (Exception $e) {
                // devolver toda la transaccion
                $this->db->trans_rollback();
                exit();
            }
            echo $id;
        
    }
    
    public function Data(){
        $valor = $this->General->listadoTrabajos($this->input->post("id"));
        echo json_encode($valor);
    }

    public function ModificarTrabajo() {
        $datos_t = array(
                'nombre' => $this->input->post("nombre"),
                'descripcion' => $this->input->post("descrip")
            );
        $where_t = array(
            'id_trabajo' => $this->input->post("id_trabajo"),
        );
        $struc_t = array(
            'data' => $datos_t,
            'tabla' => 'trabajos',
            'where' => $where_t
        );
        try {
            // inicio de la transanccion en sql
            $this->db->trans_begin();
            // procedimiento transsaccional de insercion
            $trabajo= $this->General->ModificarDatosGeneral($struc_t);
            // cierre de la transaccion
            $this->db->trans_commit();
        } catch (Exception $e) {
            // devolver toda la transaccion
            $this->db->trans_rollback();
            echo 'false';
            exit();
        }
        echo 'true';
    }

    

    function salir() {
        $this->session->sess_destroy();
        header('Location:' . base_url());
    }

}
