<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'interfaces/userinterface.php';

/**
 * This is the userinfomodel
 * We will try to handle all user data in this model
 */
class UserModel implements UserInterface {

    private $CI;
    private $id;
    private $role;
    private $email;
    private $first_name;
    private $last_name;
    private $password;
    private $role_id;
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
     * Method to authenticate user
     * Used when trying to login user
     * 
     * @return boolean 
     */
    public function authenticate_user() {

        $sql = "select * from users where email = '{$this->email}' && password = '{$this->password}'";
        $query = $this->CI->db->query($sql);

        if ($query->num_rows() > 0) {

            $this->id = $query->row()->id;
            $this->get_user();
        }

        return $query->num_rows() > 0;
    }

    /**
     * Method to check whether user exists in the database
     * @return boolean 
     */
    public function check_user() {

        $sql = "select * from users where email = '{$this->email}'";
        $result = $this->CI->db->query($sql);
        $row = $result->row();

        if ($result->num_rows() > 0) {
            $this->id = $row->id;
        }

        return $result->num_rows() > 0;
    }

    /**
     *
     * method to get user password aka tokken
     * @return string password
     *
     */
    public function get_access_tokken() {
        $query = $this->CI->db->query("select * from users where email = '{$this->email}'");
        $row = $query->row();

        return @$row->password;
    }

    /**
     * Method to populate current user's information 
     *
     * @return \UserModel 
     */
    public function get_current_user() {
        $sql = "select 
                    *
                from
                    users
                where
                    id = {$this->session_uid}";

        if ($this->session_uid > 0) {

            $row = $this->CI->db->query($sql)->row();

            $this->id = $row->id;
            $this->email = $row->email;
            $this->first_name = $row->first_name;
            $this->last_name = $row->last_name;
            $this->password = $row->password;
            $this->role_id = $row->role_id;
            $this->modified = $row->modified;
            $this->modified_by = $row->modified_by;
        }

        return $this;
    }

    /**
     * Method to populate user information 
     *
     * @return \UserModel 
     */
    public function get_user() {
        $sql = "select 
                    *
                from
                    users
                where
                    id = {$this->id}";

        if ($this->id > 0) {

            $row = $this->CI->db->query($sql)->row();

            $this->id = $row->id;
            $this->email = $row->email;
            $this->first_name = $row->first_name;
            $this->last_name = $row->last_name;
            $this->password = $row->password;
            $this->role_id = $row->role_id;
            $this->modified = $row->modified;
            $this->modified_by = $row->modified_by;
        }

        return $this;
    }

    /**
     * Method to reset user's password
     * @return void 
     */
    public function resetpassword() {

        $sql = "update users set password = '{$this->password}' where id = '{$this->id}'";
        $this->CI->db->query($sql);
    }

    /**
     * Method to save user into current database context
     * @return void 
     */
    public function save() {

        $sql = "insert 
              into 
                users ( email, 
                        first_name,
                        last_name,
                        password,
                        role_id,
                        modified,
                        modified_by)
              values('{$this->email}', 
                        '{$this->first_name}', 
                        '{$this->last_name}', 
                        '{$this->password}', 
                        '{$this->role_id}', 
                        '{$this->modified}', 
                        '{$this->modified_by}')";

        echo $sql;

        $this->CI->db->query($sql);
    }

    /**
     * Method to update user in current database context
     * @return void 
     */
    public function update() {

        $sql = "update 
                    users 
                set 
                    first_name = '{$this->first_name}', 
                    last_name = '{$this->last_name}', 
                    email = '{$this->email}', 
                    password = '{$this->password}', 
                    role_id = '{$this->role_id}', 
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
        $sql = "delete from users where id = '{$this->id}'";
        $this->CI->db->query($sql);
    }

}
