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
    private $start_time;
    private $end_time;
    private $slot;
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

        if ($this->id) {
            $this->get_user();
        }


        setlocale(LC_MONETARY, 'en_US');
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
                        start_time,
                        end_time,
                        slot,
                        modified,
                        modified_by)
              values('{$this->crn}', 
                        '{$this->name}', 
                        '{$this->description}', 
                        '{$this->instructor_id}', 
                        '{$this->semester}',
                        '{$this->start_time}',
                        '{$this->end_time}',
                        '{$this->slot}',
                        '{$this->modified}', 
                        '{$this->modified_by}')";

        $this->CI->db->query($sql);
    }

    /**
     * Method to update user in current database context
     * @return void 
     */
    public function update() {
        
        $this->modified = time();
        $this->modified_by = "SYS";

        $sql = "update 
                    users 
                set 
                    crn = '{$this->crn}', 
                    name = '{$this->last_name}',
                    description = '{$this->description}', 
                    instructor_id = '{$this->instructor_id}', 
                    semester = '{$this->semester}',
                    start_time = '{$this->start_time}',
                    end_time = '{$this->end_time}',
                    slot = '{$this->slot}',
                    modified = '{$this->modified}', 
                    modified_by = '{$this->modified_by}'
                where 
                    id = '{$this->id}'";

        $this->CI->db->query($sql);
    }

    /**
     * Implementation of the method that deletes a user
     * @return void 
     */
    public function delete() {
        $sql = "delete from courses where id = '{$this->id}'";
        $this->CI->db->query($sql);
    }

}
