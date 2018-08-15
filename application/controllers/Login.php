<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
        //$this->load->helper('text');
        $this->load->helper(array('form', 'url', 'text'));
        $this->load->library('session');
        $this->load->model("General");
        $this->load->model("Accesos");
    }

    public function index() {
        $this->load->view('login');
    }
    public function DataTecnicos() {
        $valor = $this->Accesos->getUserInfoTecnicos();
        echo json_encode($valor);
    }
    
    function acceso_out() {

        $user = $this->input->post("username");
        $pass = $this->input->post("password");



        $this->load->model("M_panel");


        $resLA = ($dataLA = $this->M_panel->authenticateLA($user, $pass)) ? true : false;
        $dataLA = $resLA ? $dataLA : null;
        if ($resLA) {
            //var_dump($dataLA);
            //exit();
            $resBDSYS = ($dataBDSYS = $this->M_panel->authenticateBDSYS($dataLA[1])) ? true : false;
            if ($resBDSYS) {
                $dataBDSYS['info'][0]['user'] = $dataLA[0];
                $this->session->set_userdata(array(
                    "loggedin" => $resBDSYS,
                    "userinfo" => $dataBDSYS['info'][0],
                ));
            } else {
                return false;
            }
        } else {
            return false;
        }

        //echo var_dump($this->session->userdata('userinfo'));
        echo $resBDSYS ? base_url() . 'home/bandeja/inicio' : false;
    }

    function rpHash($value) {
        $hash = 5381;
        $value = strtoupper($value);
        for ($i = 0; $i < strlen($value); $i++) {
            $hash = ord(substr($value, $i));
        }
        return $hash;
    }

    function acceso() {

        if ($this->rpHash($this->input->post('defaultReal')) == $this->input->post('defaultRealHash')) {
        $user = $this->input->post("username");
        $pass = $this->input->post("password");



        
        $r = ( $userData = $this->Accesos->authenticateBDSYS($user, md5($pass)) ) ? true : false;
        $r2 = ( $userData2 = $this->Accesos->authenticateBDSYS2($user, md5($pass)) ) ? true : false;

        $userData = $r ? $userData : null;
        if ($r) {
            $this->session->set_userdata(array(
                "loggedin" => $r,
                "userinfo" => $userData['info'][0],
            ));


            $acceso = base_url() . 'routing/bandeja/inicio';
        } else if ($r2) {
            $acceso = base_url() . 'activacion/' . $userData2['info'][0]["id_acceso"];
        } else {
            $acceso = false;
        }
         }else{
          $acceso = false;
          } 
        //echo var_dump($this->session->userdata('userinfo'));
        echo $acceso;
    }

    public function registroUsuario() {
        
            $data_persona = array(
                'nombre' => $this->input->post("nombre"),
                'apellido' => $this->input->post("apellido"),
                'correo' => $this->input->post("correo"),
                'telefono' => $this->input->post("tlf"),
                'ci' => $this->input->post("ci"),
                'nacionalidad' => $this->input->post("nac"),
                'estatus_empre' => '1'
            );
            $data = array(
                'data' => $data_persona,
                'tabla' => 'personas'
            );

            try {
                // inicio de la transanccion en sql
                $this->db->trans_begin();
                // procedimiento transsaccional de insercion

                $id_persona = $this->General->insercionGeneral($data, '2');

                $data_acceso = array(
                    'usuario' => $this->input->post("user"),
                    'clave' => md5($this->input->post("clave")),
                    'id_persona' => $id_persona,
                    'id_perfil' => $this->input->post("perfil"),
                    'estatus' => '1'
                );
                $data_accesos = array(
                    'data' => $data_acceso,
                    'tabla' => 'accesos'
                );
                //var_dump($data_accesos);

                $user = $this->General->insercionGeneral($data_accesos, '1');
                // cierre de la transaccion
                $this->db->trans_commit();
            } catch (Exception $e) {
                // devolver toda la transaccion
                $this->db->trans_rollback();
                exit();
            }
            echo $user;
        
    }

    public function ModificarUser() {
        
        $data_acceso = array(
            'usuario' => $this->input->post("user"),
            'id_perfil' => $this->input->post("perfil")
        );
        $clave = $this->input->post("passwd");
        if(!empty($clave)){
            $data_acceso['clave']=md5($clave);
        }
        $where = array(
            'id_acceso' => $this->input->post("id_acceso")
        );
        $data_accesos = array(
            'data' => $data_acceso,
            'tabla' => 'accesos',
            'where' => $where
        );
        try {
            // inicio de la transanccion en sql
            $this->db->trans_begin();
            // procedimiento transsaccional de insercion

            $user = $this->General->ModificarDatosGeneral($data_accesos);

            $data_persona = array(
                'nombre' => $this->input->post("nombre"),
                'apellido' => $this->input->post("apellido"),
                'correo' => $this->input->post("correo"),
                'telefono' => $this->input->post("tlf"),
                'ci' => $this->input->post("ci"),
                'nacionalidad' => $this->input->post("nac")
            );
            $where_per = array(
                'id_persona' => $this->input->post("id_persona")
            );
            $data_personas = array(
                'data' => $data_persona,
                'tabla' => 'personas',
                'where' => $where_per
            );
            $user = $this->General->ModificarDatosGeneral($data_personas);

            // cierre de la transaccion
            $this->db->trans_commit();
        } catch (Exception $e) {
            // devolver toda la transaccion
            $this->db->trans_rollback();
            exit();
        }
        echo 'true';
    }

    function EliminarUser() {
        $data = array(
            'estatus' => $this->input->post("estatus") - 1
        );

        $where = array(
            'id_acceso' => $this->input->post("id_user")
        );
        try {
            // inicio de la transanccion en sql
            $this->db->trans_begin();
            // procedimiento transsaccional de insercion
            $datos = array(
                'data' => $data,
                'tabla' => 'accesos',
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
        echo 'true';
    }
    
    function CambioEstatus($tabla,$campo,$estatus) {
        $this->load->model("M_panel");
        $data = array(
            $estatus => $this->input->post("estatus") + 1
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
            $user = $this->M_panel->ModificarDatosGeneral($datos);

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
