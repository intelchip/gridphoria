<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

//        $this->output->enable_profiler(TRUE);
    }

    public function index() {
        $data = $this->layoutmodel->main("Gridphoria | Dashboard");
        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/index");
        $this->load->view("layout/footer", $data);
    }

    /**
     * Page that will enable user to add courses
     */
    public function add_courses() {
        $data = $this->layoutmodel->main("Gridphoria | Add Courses");
        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/add_courses");
        $this->load->view("layout/footer", $data);
    }

    /**
     * Page that will list courses
     */
    public function view_courses() {
        $data = $this->layoutmodel->main("Gridphoria | View Courses");
        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/view_courses");
        $this->load->view("layout/footer", $data);
    }
    
    public function edit_course($id){
        
        $data = $this->layoutmodel->main("Gridphoria | Edit Course");
        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/edit_course");
        $this->load->view("layout/footer", $data);
    }
    
    public function delete_course($id){
        $this->datamodel->deleteCourse($id);        
        redirect(base_url()."index.php?/dashboard/view_courses");
    }

    /**
     * Logs out the user by destroying the current session
     */
    public function logout() {

        $this->session->unset_userdata();
        $this->session->sess_destroy();
        session_destroy();

        redirect(base_url());
    }

}
