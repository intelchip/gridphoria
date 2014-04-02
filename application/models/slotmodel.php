<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'interfaces/slotinterface.php';

class SlotModel implements SlotInterface {
    
    

    private $CI;
    private $id;
    private $slot;
    private $capacity;
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
        $sql = "delete from slots where id = '{$this->id}'";
        $this->CI->db->query($sql);        
    }

    /**
     * checks whethe the model is valid
     * Used when saving a slot
     * @return boolean true|false
     */
    public function is_valid() {
        $is_valid = isset($this->capacity) && is_numeric($this->capacity) && isset($this->modified) && isset($this->modified) && isset($this->modified_by);
        return $is_valid;
    }

    /**
     * Saves slot to backend
     */
    public function save() {
        $sql = "insert into slots(slot, capacity, modified, modified_by) values('{$this->slot}', '{$this->capacity}', '{$this->modified}', '{$this->modified_by}')";
        
        if ($this->is_valid()) {
            $this->CI->db->query($sql);
        }
    }

    /**
     * Updates model from the db
     */
    public function update() {
        $sql = "update slots set slot = '{$this->slot}', capacity = '{$this->capacity}', modified = '{$this->modified}', modified_by = '{$this->modified_by}' where id = '{$this->id}'";
        
        if($this->is_valid() && isset($this->id) && is_numeric($this->id))
        {
            $this->CI->db->query($sql);
        }
    }

}
