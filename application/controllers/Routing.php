<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Routing extends CI_Controller {
public $Cinicio;
    public function __construct() {
        parent::__construct();
        //$this->load->helper('text');
        $this->load->helper(array('form', 'url', 'text'));
        $this->load->library('session');
        $this->load->model("General");
    }

    public function bandeja($pagina, $variable = false) {
        $loggedin = $this->session->userdata('loggedin');
        $userdata = $this->session->userdata('userinfo');

        if (intval($loggedin) != 0) {
            $datos = array(
                'data' => $this->selectorMoulo($pagina, $variable)
            );
                $this->load->view('panel/cuerpo', $datos);
            
        } else {
            header('Location: ' . base_url() . 'login');
            exit();
        }
    }

    function selectorMoulo($modulo, $variable = false) {
        switch ($modulo) {
            case 'inicio':
                
                $uribasemonetaria = BASEURL."base";
                $databasemonetaria = $this->General->conexionAPI($uribasemonetaria);
                
                $uribasemonetariausa = BASEURL."base_usd";
                $databasemonetariausa = $this->General->conexionAPI($uribasemonetariausa);
                
                $uricotizacionUSD = BASEURL."usd";
                $datacotizacionUSD = $this->General->conexionAPI($uricotizacionUSD);
                
                $uriusd_of = BASEURL."usd_of";
                $datausd_of = $this->General->conexionAPI($uriusd_of);
                
                $uriuva = BASEURL."uva";
                $datauva = $this->General->conexionAPI($uriuva);
                
                $valor = array(
                    'basemonetaria' => $this->actual($databasemonetaria),
                    'basemonetariausa' => $this->actual($databasemonetariausa),
                    'cotizacionUSD' => $this->actual($datacotizacionUSD),
                    'usd_of' => $this->actual($datausd_of),
                    'uva' => $this->actual($datauva),
                    'userdata' => $this->session->userdata('userinfo')
                );
                $valore = array(
                    'tronco' => $modulo,
                    'valores' => $valor
                );
                return $valore;
                break;
            case 'accesos':
                $this->load->model("Accesos");
                $valore = array(
                    'tronco' => $modulo,
                    'valores' => $this->Accesos->listadoUsuarios()
                );
                return $valore;
                break;
            case 'perfiles':
                $this->load->model("Perfiles");
                $valor = $this->Perfiles->listadoPerfiles();
                $valore = array(
                    'tronco' => $modulo,
                    'valores' => $valor
                );
                return $valore;
                break;
            case 'trabajos':
                $valore = $this->orden($modulo,"base",$variable);
                return $valore;
                break;
            case 'bmusa':
                $valore = $this->orden($modulo,"base_usd",$variable);
                return $valore;
                break;
            case 'cusa':
                $valore = $this->orden($modulo,"usd",$variable);
                return $valore;
                break;
            case 'cofiusa':
                $valore = $this->orden($modulo,"usd_of",$variable);
                return $valore;
                break;
            case 'uva':
                $valore = $this->orden($modulo,"uva",$variable);
                return $valore;
                break;
        }
    }
    
    function orden($modulo,$lista,$variable=null){
                $uribasemonetaria = BASEURL.$lista;
                $databasemonetaria = $this->General->conexionAPI($uribasemonetaria);
                
                if($variable != false){
                    $valores = array();
                    $array = explode('_', $variable);
                    for ($i = 0; $i < count($databasemonetaria); $i++) {                    
                        $time = strtotime($databasemonetaria[$i]->d);
                        $newformat = date('Y-m-d',$time);
                        if($newformat >= $array[0] && $newformat <= $array[1]){
                            $valores[$i]=$databasemonetaria[$i];
                        }
                    }
                }else{
                    $valores = $databasemonetaria;
                    $array = null;
                }
                
                
                
                $valore = array(
                    'tronco' => $modulo,
                    'valores' => array('datos'=>$valores,'intervalos' =>$array) ,
                );
                return $valore;
    }
    
    function actual($jsondata){
        $numr = count($jsondata);
        $data = $jsondata[$numr-1];
        $time = strtotime($data->d);
        $newformat = date('d-m-Y',$time);
        $valor = number_format($data->v, 2, ',', '.');
        $resul = array(
            'date'  =>$newformat,
            'dato'  => $valor
        );
        return $resul;
    }
}
