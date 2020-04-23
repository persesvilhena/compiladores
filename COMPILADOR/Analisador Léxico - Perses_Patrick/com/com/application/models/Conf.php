<?php

class Conf extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Painel_model');
        $this->load->model('Rede_model');
    }
    
}
