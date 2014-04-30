<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'interfaces/semesterinterface.php';

class SemesterModel implements SemesterInterface {

    private $CI;
    private $id;
    private $semester;
    private $year;
    private $modified;
    private $modified_by;

    /**
     * Session Data
     * @var array $session_data 
     */
    public static $session_data;

    /**
     * Logged in?
     * @var boolean $session_logged_in 
     */
    public static $session_logged_in;

    /**
     * Session uid
     * @var int $session_uid 
     */
    public static $session_uid;

    /**
     * Load our database context at Bookmodel instantiation.
     * When a model is loaded it does NOT connect automatically to your database.
     */
    public function __construct() {

        $this->CI = & get_instance();

        $this->session_uid = $this->CI->session->userdata('uid');
        $this->session_logged_in = $this->CI->session->userdata('logged_in');
        $this->session_data = $this->CI->session->all_userdata();
    }

    /**
     * Our Destructor 
     */
    public function __destruct() {

        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /**
     * Our gettor
     * @param type $property
     * @return type 
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /**
     * Our setter method
     * @param type $property
     * @param type $value
     * @return type 
     */
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this->$property;
    }

    /**
     * Deletes slot from db
     */
    public function delete() {
        $sql = "delete from semesters where id = '{$this->id}'";
        $this->CI->db->query($sql);
    }

    /**
     * checks whethe the model is valid
     * Used when saving a slot
     * @return boolean true|false
     */
    public function is_valid() {
        $is_valid = isset($this->semester) && isset($this->year) && is_numeric($this->year) && isset($this->modified) && isset($this->modified_by);
        return $is_valid;
    }

    /**
     * Saves slot to backend
     */
    public function save() {
        $sql = "insert into semesters(semester, year, modified, modified_by) values('{$this->semester}', '{$this->year}', '{$this->modified}', '{$this->modified_by}')";

        if ($this->is_valid()) {
            $this->CI->db->query($sql);
        }
    }

    /**
     * Updates model from the db
     */
    public function update() {
        $sql = "update semesters set semester = '{$this->semester}', year = '{$this->year}', modified = '{$this->modified}', modified_by = '{$this->modified_by}' where id = '{$this->id}'";

        if ($this->is_valid() && isset($this->id) && is_numeric($this->id)) {
            $this->CI->db->query($sql);
        }
    }

}
