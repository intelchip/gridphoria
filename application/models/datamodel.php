<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Datamodel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Returns an array of objects from the roles table
     * @return type
     */
    public function getRoles(){
        $sql = "select * from roles";
        $query = $this->db->query($sql);
        return $query->result();
    }
}