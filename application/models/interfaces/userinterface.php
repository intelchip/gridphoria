<?php

/**
 *
 * @author jamesarama
 */
interface UserInterface {

    /**
     * Our Destructor 
     */
    public function __destruct();

    /**
     * Our gettor
     * @param type $property
     * @return type 
     */
    public function __get($property);

    /**
     * Our setter method
     * @param type $property
     * @param type $value
     * @return type 
     */
    public function __set($property, $value);

    /**
     * Method to authenticate user
     * Used when trying to login user
     * 
     * @return boolean 
     */
    public function authenticate_user();

    /**
     * Method to check whether user exists in the database
     * @param string $email
     * @return boolean 
     */
    public function check_user();

    /**
     *
     * method to get user password aka tokken
     * @return string password
     *
     */
    public function get_access_tokken();

    /**
     * Method to populate current user's information 
     */
    public function get_current_user();

    /**
     * Method to populate user information 
     */
    public function get_user();

    /**
     * Method to save user into current database context
     * @return void 
     */
    public function save();

    /**
     * Method to update user's information
     * @return void 
     */
    public function update();

    /**
     * Method to delete User
     * @return void 
     */
    public function delete();
}

