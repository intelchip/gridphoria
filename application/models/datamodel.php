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
    public function getRoles() {
        $sql = "select * from roles";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Returns an array of objects from the semesters table
     * @return type
     */
    public function getSemesters() {
        $sql = "select * from semesters";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function getSemester($semester_id){
        $sql = "select * from semesters where id = '$semester_id'";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->semester;
    }

    public function getInstructors() {
        $sql = "select * from users";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getSlots() {
        $sql = "select * from slots";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getCourses() {
        $sql = "select * from courses";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
