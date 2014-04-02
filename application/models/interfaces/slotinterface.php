<?php

interface SlotInterface{
    
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
     * Method that checks whether a slot is valid
     * Mainly used when saving a course
     * @return boolean true | false
     */
    public function is_valid();
    
    /**
     * Method that will save a course
     */
    public function save();
    
    /**
     * Method that will help in updating a course
     */
    public function update();
    
    
    /**
     * Method that will delete a course
     */
    public function delete();
}