<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Datamodel extends CI_Model {

    /**
     * Session uid
     * @var int $session_uid 
     */
    public static $session_uid = null;

    /**
     * Logged in?
     * @var boolean $session_logged_in 
     */
    public static $session_logged_in = null;

    public function __construct() {
        parent::__construct();
        $this->session_uid = $this->usermodel->session_uid;
        $this->session_logged_in = $this->usermodel->session_logged_in;
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

    public function getSemester($semester_id) {
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

    public function getCourse($id) {
        $sql = "select * from courses where id='$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function getCourseSchedule($course_id) {
        $sql = "select * from course_schedule where course_id = '$course_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function deleteCourse($id) {

        $sql = "delete from courses where id='$id' && instructor_id = '{$this->session_uid}'";
        $this->db->query($sql);
    }

}
