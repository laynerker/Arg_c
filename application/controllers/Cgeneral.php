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
            case '2':
                $this->listaTiposConsumibles();
                break;
            case '3':
                $this->listaColeccion();
                break;
            case '4':
                $this->listaEmpresas();
                break;
            case '5':
                $this->listaTipoVivienda();
                break;
            case '6':
                $this->dataEditarUser($this->input->post("id"));
                break;
            case '7':
                $this->datosEditarProdictos($this->input->post("id"));
                break;
            case '9':
                $this->datosEditarColeccion($this->input->post("id"));
                break;
            case '10':
                $this->datosEditarEmpresas($this->input->post("id"));
                break;
            case '11':
                $this->datosEditarProyecto($this->input->post("id"));
                break;
            case '12':
                $this->datosEditarQuienesSomos($this->input->post("id"));
                break;
            case '13':
                $this->datosSection($this->input->post("id"));
                break;
            case '14':
                $this->listaTipo('s');
                break;
            case '15':
                $this->listaColeccion($this->input->post("id"));
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

    public function listaTiposConsumibles() {
        $valores = $this->General->listadoTiposConsumibles();
        foreach ($valores as $value) {
            echo '<option value="' . $value['id_tipo_consu'] . '">' . $value['nombre'] . '</option>';
        }
    }
    public function dataTiposEmpresas() {
        $valores = $this->General->listadoTiposEmpresas();
        echo json_encode($valores);
    }

    public function datosEditarProdictos($id_producto) {
        $valores = $this->M_listas_generales->DataProducto($id_producto);
        echo json_encode($valores);
        //var_dump($valores);
    }
    public function datosEditarProyecto($id_proyecto) {
        $valores = $this->M_listas_generales->DataProyecto($id_proyecto);
        echo json_encode($valores);
        //var_dump($valores);
    }

    public function datosEditarQuienesSomos($id_tipo) {
        $valores = $this->M_listas_generales->DataListaQuienesSomos($id_tipo);
        echo json_encode($valores);
        //var_dump($valores);
    }
    public function datosSection($id_tipo) {
        $valores = $this->M_listas_generales->DataListaTipos($id_tipo);
        echo json_encode($valores);
        //var_dump($valores);
    }

    public function datosEditarColeccion($id_coleccion) {
        $valores = $this->M_listas_generales->DataListaColeccion($id_coleccion);
        echo json_encode($valores);
        //var_dump($valores);
    }

    public function datosEditarEmpresas($id_empresa) {
        $valores = $this->M_listas_generales->DataListaEmpresas($id_empresa);
        echo json_encode($valores);
        //var_dump($valores);
    }

    public function listaColeccion($id) {
        $id = isset($id)?$id:'a';
        $t = isset($id)?'s':null;
        $valores = $this->M_listas_generales->DataListaColeccion($t,$id);
        //var_dump($id_estado);
        if ($valores) {
            $i = 1;
            foreach ($valores as $value) {
                echo '<option value="' . $value['id_coleccion'] . '">' . $value['coleccion'] . '</option>';
                $i++;
            }
        }
    }

    public function listaEmpresas() {
        $valores = $this->M_listas_generales->DataListaEmpresas('a');
        //var_dump($id_estado);
        if ($valores) {
            $i = 1;
            foreach ($valores as $value) {

                echo '<option value="' . $value['id_empresa'] . '">' . $value['nombre'] . '</option>';
                $i++;
            }
        }
    }

    public function listaTipoVivienda() {
        $valores = $this->M_listas_generales->DataListaTipoVivienda();
        //var_dump($valores);
        $i = 1;
        foreach ($valores as $value) {

            echo '<option value="' . $value['id_tip_viv'] . '">' . $value['tipo_vivienda'] . '</option>';
            $i++;
        }
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