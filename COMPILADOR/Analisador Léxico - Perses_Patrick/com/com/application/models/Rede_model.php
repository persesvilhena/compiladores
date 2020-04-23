<?php

class Rede_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function ver_per(){
        $this->db->select('*');
        $this->db->from('iris2');
        return $this->db->get()->result();
    }


    


}
