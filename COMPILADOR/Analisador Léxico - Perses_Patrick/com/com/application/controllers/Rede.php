<?php
class Rede extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('conf');
    }



    public function index() {
        $this->load->view('header');
        $this->load->view('barra_superior');
        $this->load->view('painel/home');
        $this->load->view('footer');
    }

    public function per() {
        $this->load->view('header');
        $this->load->view('barra_superior');
        $this->load->view('rede/per');
        $this->load->view('footer');
    }

    public function gulosa() {
        $this->load->view('header');
        $this->load->view('barra_superior');
        $this->load->view('painel/gulosa');
        $this->load->view('footer');
    }

    public function gulosa_json() {
        echo $this->painel_model->ver_gulosa()->json;
    }



}
