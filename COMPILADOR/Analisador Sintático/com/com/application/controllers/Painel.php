<?php
class Painel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('conf');
    }



    public function index() {
        $this->load->view('header');
        $this->load->view('barra_superior');
        $this->load->view('painel/sin');
        $this->load->view('footer');
    }

    public function lex() {
        $this->load->view('header');
        $this->load->view('barra_superior');
        $this->load->view('painel/lex');
        $this->load->view('footer');
    }

    public function arvore() {
        //$this->load->view('header');
        //$this->load->view('barra_superior');
        $this->load->view('painel/arvore');
        //$this->load->view('footer');
    }

    public function download(){
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="codigo.ah"');
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: binary');
        //header('Content-Length: ' . filesize($aquivoNome));
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Expires: 0');
        // Envia o arquivo para o cliente
        readfile(base_url() .'src/codigo.ah');
    }

    
    public function ajax($func = null, $par = null) {


    }




}
