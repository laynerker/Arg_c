<?php
$datos = array('data' => $data['valores']);
$extremidades = array('tronco' => $data['tronco']);
$this->load->view('panel/extremidades/head',$extremidades);
$this->load->view('panel/troncos/'.$data['tronco'],$datos);
$this->load->view('panel/extremidades/footer',$extremidades);
?>

