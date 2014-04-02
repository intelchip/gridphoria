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

    /**
     * Returns a semester
     * @param int $semester_id
     * @return string
     */
    public function getSemester($semester_id) {
        $sql = "select * from semesters where id = '$semester_id'";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->semester;
    }

    /**
     * Returns arn array object of instructors from the users table
     * @return type
     */
    public function getInstructors() {
        $sql = "select * from users";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Returns an array object of slots in the users table
     * @return type
     */
    public function getSlots() {
        $sql = "select * from slots";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * Returns a single slot's data
     * @param int $id
     * @return object
     */
    public function getSlot($id){
        $sql = "select * from slots where id = '$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    /**
     * Gets number of available slots in a slot section
     * @param type $id
     * @return int available slots
     */
    public function getAvailableSlots($id){
        
        $slot = $this->getSlot($id);
        $capacity = $slot->capacity;
        
        $sql = "select count(*) as used_slots from slot_allocation where slot_id = '$id'";
        $query = $this->db->query($sql);
        
        return $capacity - $query->row()->used_slots;  
    }
    
    public function deleteSlot($id){
        $slot = $this->slotmodel;
        $slot->id = $id;
        $slot->delete();
    }

    /**
     * Returns an array object of courses
     * @return type
     */
    public function getCourses() {
        $sql = "select * from courses";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Returns a single course from DB
     * @param type $id
     * @return type
     */
    public function getCourse($id) {
        $sql = "select * from courses where id='$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    /**
     * Gets an array object of course schedules
     * @param type $course_id
     * @return type
     */
    public function getCourseSchedule($course_id) {
        $sql = "select * from course_schedule where course_id = '$course_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * Deletes a course
     * @param type $id
     */
    public function deleteCourse($id) {
        $course = $this->coursemodel;
        $course->id=$id;
        $course->delete();
    }

}
