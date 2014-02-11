<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

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
