<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cperfiles extends CI_Controller {

	public function __construct() {
        parent::__construct();
        //$this->load->helper('text');
        $this->load->helper(array('form', 'url', 'text'));
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('login');
    }
    public function Data() {
        $this->load->model("Perfiles");
        $valor = $this->Perfiles->listadoPerfiles($this->input->post("id"));
        echo json_encode($valor);
    }
    

    public function registroPerfil() {
        $this->load->model("General");
            $data = array(
                'perfil' => $this->input->post("nombre"),
                'estatus' => '1'
            );
            $data = array(
                'data' => $data,
                'tabla' => 'perfiles'
            );

            try {
                // inicio de la transanccion en sql
                $this->db->trans_begin();
                // procedimiento transsaccional de insercion

                $id = $this->General->insercionGeneral($data, '2');
                // cierre de la transaccion
                $this->db->trans_commit();
            } catch (Exception $e) {
                // devolver toda la transaccion
                $this->db->trans_rollback();
                exit();
            }
            echo $id;
        
    }

    public function ModificarPerfil() {
        $this->load->model("General");
        
        $data = array(
            'perfil' => $this->input->post("nombre")
        );
        $where = array(
            'id_perfil' => $this->input->post("id_perfil")
        );
        $struc = array(
            'data' => $data,
            'tabla' => 'perfiles',
            'where' => $where
        );
        try {
            // inicio de la transanccion en sql
            $this->db->trans_begin();
            // procedimiento transsaccional de insercion

            $user = $this->General->ModificarDatosGeneral($struc);

            // cierre de la transaccion
            $this->db->trans_commit();
        } catch (Exception $e) {
            // devolver toda la transaccion
            $this->db->trans_rollback();
            exit();
        }
        echo 'true';
    }

    

    function salir() {
        $this->session->sess_destroy();
        header('Location:' . base_url());
    }

}
