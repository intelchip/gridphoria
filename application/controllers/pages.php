<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->session_uid = $this->usermodel->session_uid;
        $this->session_logged_in = $this->usermodel->session_logged_in;
//        $this->output->enable_profiler(TRUE);
    }

    public function index() {
        redirect(base_url());
    }

    /**
     * Login page
     */
    public function login() {

        // redirect back to home if logged in
        if ($this->session_uid) {
            redirect(base_url());
        }

        $data = $this->layoutmodel->main("Gridphoria | Login");
        $this->load->view("layout/header", $data);
        $this->load->view("pages/login", $data);
        $this->load->view("layout/footer", $data);
    }

    /**
     * Register page
     */
    public function register() {

        // redirect back to home if logged in
        if ($this->session_uid) {
            redirect(base_url());
        }

        $data = $this->layoutmodel->main("Gridphoria | Register");
        $this->session->unset_userdata("uid");
        $this->session->unset_userdata("logged_in");
        $this->session->unset_userdata("login_time");
        $this->load->view("layout/header", $data);
        $this->load->view("pages/register", $data);
        $this->load->view("layout/footer", $data);
    }

}
