<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'interfaces/courseinterface.php';

/**
 * This is the userinfomodel
 * We will try to handle all user data in this model
 */
class CourseModel implements CourseInterface {

    private $CI;
    private $id;
    private $crn;
    private $name;
    private $description;
    private $instructor_id;
    private $semester;
    private $slots;
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
     * Method that will check whether our course is valid
     * Mainly will be used when checking whether a course is valid for saving to the db
     * @return boolean true | false
     */
    public function is_valid() {
        $is_valid = isset($this->crn) && isset($this->description) && isset($this->instructor_id) && isset($this->semester) && count($this->slots);
        return $is_valid;
    }

    /**
     * Method to save user into current database context
     * @return void 
     */
    public function save() {

        $this->modified = time();
        $this->modified_by = "SYS";

        $sql = "insert 
              into 
                courses ( crn, 
                        name,
                        description,
                        instructor_id,
                        semester,
                        modified,
                        modified_by)
              values('{$this->crn}', 
                        '{$this->name}', 
                        '{$this->description}', 
                        '{$this->instructor_id}', 
                        '{$this->semester}',
                        '{$this->modified}', 
                        '{$this->modified_by}')";

        $this->CI->db->query($sql);

        // insert course schedule
        $this->id = $this->CI->db->insert_id();


        // insert into slot allocation table
        foreach ($this->slots as $slot) {
            if (is_numeric($slot)) {
                $slot_sql = "insert 
                     into
                        slot_allocation (course_id, 
                        slot_id, 
                        modified,
                        modified_by)
                     values('{$this->id}', 
                        '{$slot}', 
                        '{$this->modified}', 
                        '{$this->modified_by}');";
                $this->CI->db->query($slot_sql);
            }
        }
    }

    /**
     * Method to update user in current database context
     * @return void 
     */
    public function update() {

        $this->modified = time();
        $this->modified_by = "SYS";

        $sql = "update 
                    courses 
                set 
                    crn = '{$this->crn}', 
                    name = '{$this->name}',
                    description = '{$this->description}', 
                    instructor_id = '{$this->instructor_id}', 
                    semester = '{$this->semester}',
                    modified = '{$this->modified}', 
                    modified_by = '{$this->modified_by}'
                where 
                    id = '{$this->id}'";

        $this->CI->db->query($sql);

        // clear slot_allocation table
        $slot_sql = "delete from 
                        slot_allocation 
                     where
                        course_id = '{$this->id}' ;";
        $this->CI->db->query($slot_sql);


        // insert into slot allocation table
        foreach ($this->slots as $slot) {
            if (is_numeric($slot)) {
                $slot_sql = "insert 
                     into
                        slot_allocation (course_id, 
                        slot_id, 
                        modified,
                        modified_by)
                     values('{$this->id}', 
                        '{$slot}', 
                        '{$this->modified}', 
                        '{$this->modified_by}');";
                $this->CI->db->query($slot_sql);
            }
        }
    }

    /**
     * Implementation of the method that deletes a user
     * @return void 
     */
    public function delete() {
        $course_sql = "delete from courses where id='{$this->id}' && instructor_id = '{$this->session_uid}'";
        $this->CI->db->query($course_sql);

        $slot_allocation_sql = "delete from slot_allocation where course_id = '{$this->id}'";
        $this->CI->db->query($slot_allocation_sql);
    }

}
