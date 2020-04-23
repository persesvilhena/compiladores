<?php
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('conf');
    }


    public function index() {
        redirect("painel/");
    }




}
