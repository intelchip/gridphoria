<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends CI_Controller {

    /**
     * Post Request data
     * @var array $data
     */
    var $data = null;

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

    /**
     * Default Constructor 
     */
    public function __construct() {
        parent::__construct();

        $this->data = $this->input->post("data");
        $this->session_uid = $this->usermodel->session_uid;
        $this->session_logged_in = $this->usermodel->session_logged_in;
    }

    /**
     * Method to handle direct access to the post controller 
     */
    public function index() {
        redirect('/');
    }

    public function add_courses() {
        $course = $this->coursemodel;
        $course->crn = $this->data["course"]["crn"];
        $course->name = $this->data["course"]["name"];
        $course->description = $this->data["course"]["description"];
        $course->semester = $this->data["course"]["semester"];
        $course->instructor_id = $this->data["course"]["instructor"];
        $course->start_time = $this->data["course"]["start_time"];
        $course->end_time = $this->data["course"]["end_time"];
        $course->slot = $this->data["course"]["slot"];
        $course->save();

        redirect($_SERVER['HTTP_REFERER'] . "?success=true");
    }

}
