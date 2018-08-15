<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cgeneral extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('text');
        $this->load->library('session');
        $this->load->model("General");
    }

    public function index() {
        //$this->load->view('welcome_message');
    }
    
    public function validacionGeneral($tabla,$wherefrom,$campo=null,$id=null){
        $array=$this->input->post();
        foreach ($array as $value) {
            $dato=$value;
        }
        $where = array($wherefrom => $dato);
        $resul = $this->General->NumDatos($tabla,$where,$wherefrom);
        if($resul > 0){
            $noexiste = false;
            if(!$noexiste && !empty($campo)){
                $where = array($campo => $id,$wherefrom => $dato);
                $resul = $this->General->NumDatos($tabla,$where,$wherefrom);
                if($resul > 0){
                    $noexiste=true;
                }
            }
        }else{
            $noexiste = true;
        }
        echo json_encode(array('valid' => $noexiste));
    }
    
    public function funcionLista($param) {
        switch ($param) {
            case '1':
                $this->listaPerfil();
                break;
            case '6':
                $this->dataEditarUser($this->input->post("id"));
                break;
            
        }
    }

    public function listaPerfil() {
        $valores = $this->General->listadoPerfil();
        //var_dump($valores);
        foreach ($valores as $value) {
            echo '<option value="' . $value['id_perfil'] . '">' . $value['perfil'] . '</option>';
            //utf8_encode()
        }
    }

    public function dataEditarUser($id_acceso) {
        $valores = $this->General->DataUser($id_acceso);
        echo json_encode($valores);
    }

    function CambioEstatus($tabla,$campo,$estatus) {
        $this->load->model("General");
        $data = array(
            $estatus => $this->input->post("estatus")
        );

        $where = array(
            $campo => $this->input->post("id")
        );
        try {
            // inicio de la transanccion en sql
            $this->db->trans_begin();
            // procedimiento transsaccional de insercion
            $datos = array(
                'data' => $data,
                'tabla' => $tabla,
                'where' => $where
            );
            $user = $this->General->ModificarDatosGeneral($datos);

            // cierre de la transaccion
            $this->db->trans_commit();
        } catch (Exception $e) {
            // devolver toda la transaccion
            $this->db->trans_rollback();
            exit();
        }
        $valores = array('');
        echo json_encode($valores);
        echo 'true';
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */