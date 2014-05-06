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
     * Post data
     * @var array $data
     */
    public static $data = null;

    /**
     * Default Constructor 
     */
    public function __construct() {
        parent::__construct();

        $this->data = $this->input->post("data");
        $this->session_uid = $this->usermodel->session_uid;
        $this->session_logged_in = $this->usermodel->session_logged_in;

        if (!$this->session_logged_in) {
            redirect("/");
        }


//        $this->output->enable_profiler(TRUE);
    }

    public function index() {
        $data = $this->layoutmodel->main("Gridphoria | Dashboard");
        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/index");
        $this->load->view("layout/footer", $data);
    }

    /**
     * Account settings page
     */
    public function account_settings() {
        $data = $this->layoutmodel->main("Gridphoria | Account Settings");

        // get current user info
        $current_user = $this->usermodel;
        $data["current_user"] = $current_user->get_current_user();

        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/account_settings", $data);
        $this->load->view("layout/footer", $data);
    }

    /* ==========================================================================
     * Courses Section 
     * ========================================================================= */

    /**
     * Page that will enable user to add courses
     */
    public function add_courses() {
        $data = $this->layoutmodel->main("Gridphoria | Add Courses");
        $this->load->view("layout/header", $data);
        if ($this->usermodel->is_curent_user_chair()) {
            $this->load->view("dashboard/add_courses");
        } else {
            echo "You do not have sufficient rights to view this page!";
        }
        $this->load->view("layout/footer", $data);
    }

    /**
     * Page that will list courses
     * @param type $uid
     * @param type $page
     */
    public function view_courses($uid = null, $year = null, $semester = null, $page = 1) {
        $user_id = str_replace("uid_", "", $uid);
        if (!$year) {
            $year = date("Y");
        } else if (!$semester) {
            $semester = "Fall";
        }

        $data = $this->layoutmodel->main("Gridphoria | View Courses");
        $data["courses"] = $this->datamodel->getCourses($user_id, $year, $semester, $page);
        $data["pages"] = $this->paginatormodel;
        $data["pages"]->currentPage = $page;
        $data["pages"]->section = "/index.php?/dashboard/view_courses/$uid/$year/$semester";
        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/view_courses", $data);
        $this->load->view("layout/footer", $data);
    }

    /**
     * Page that will list courses from search results
     * @param type $uid
     * @param type $page
     */
    public function search_courses($uid = null, $page = 1) {
        $user_id = str_replace("uid_", "", $uid);
        $data = $this->layoutmodel->main("Gridphoria | View Courses");
        $search = $this->input->post("query");

        $data["courses"] = $this->datamodel->searchCourses($user_id, $page, $search);
        $data["pages"] = $this->paginatormodel;
        $data["pages"]->currentPage = $page;
        $data["pages"]->section = "/index.php?/dashboard/search_courses/$uid";
        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/search_courses", $data);
        $this->load->view("layout/footer", $data);
    }

    /**
     * Edit course page
     * @param int $id
     */
    public function edit_course($id) {

        $data = $this->layoutmodel->main("Gridphoria | Edit Course");
        $this->load->view("layout/header", $data);
        if ($this->usermodel->is_curent_user_chair()) {
            $this->load->view("dashboard/edit_course");
        } else {
            echo "You do not have sufficient rights to view this page!";
        }
        $this->load->view("layout/footer", $data);
    }

    /**
     * Deletes a course
     * @param int $id
     */
    public function delete_course($id) {

        if ($this->usermodel->is_curent_user_chair()) {
            $this->datamodel->deleteCourse($id);
        }
        redirect("/dashboard/view_courses");
    }

    /**
     * Asigns a course to the currently logged in user
     * @param type $id
     */
    public function take_course($id) {
        if ($id && is_numeric($id)) {
            $this->datamodel->takeCourse($id);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            echo "There was an error!";
        }
    }

    /**
     * Changes a course to TBA
     * @param type $id
     */
    public function release_course($id) {
        $course = $this->datamodel->getCourse($id);
        if ($course->instructor_id == $this->session_uid) {
            $this->datamodel->releaseCourse($id);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            echo "There was an error!";
        }
    }

    /* ==========================================================================
     * Semesters Section 
     * ========================================================================= */

    public function view_semesters($year = null) {
        if (!$year) {
            $year = date("Y");
        }

        $data = $this->layoutmodel->main("Gridphoria | Semesters");
        $data["semesters"] = $this->datamodel->getSemesters($year);
        $data["year"] = $year;
        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/view_semesters", $data);
        $this->load->view("layout/footer", $data);
    }

    public function open_semester() {

        $data = $this->layoutmodel->main("Gridphoria | Open Semester");
        $this->load->view("layout/header", $data);
        if ($data['is_current_user_faculty_chair']) {
            $this->load->view("dashboard/open_semester");
        } else {
            echo "You do not have sufficient rights to view this page!";
        }
        $this->load->view("layout/footer", $data);
    }

    /* ==========================================================================
     * Slots Section 
     * ========================================================================= */

    /**
     * Page that shows the add slots page
     */
    public function add_slots() {

        $data = $this->layoutmodel->main("Gridphoria | Add Slots");
        $this->load->view("layout/header", $data);
        if ($data['is_current_user_faculty_chair']) {
            $this->load->view("dashboard/add_slots");
        } else {
            echo "You do not have sufficient rights to view this page!";
        }
        $this->load->view("layout/footer", $data);
    }

    /**
     * Page that lets user edit a slot
     * @param type $id
     */
    public function edit_slot($id) {

        $data = $this->layoutmodel->main("Gridphoria | Edit Slot");
        $data["slot"] = $this->datamodel->getSlot($id);
        $data["available_spots"] = $this->datamodel->getAvailableSlots($id);
        $this->load->view("layout/header", $data);

        if ($data['is_current_user_faculty_chair']) {
            $this->load->view("dashboard/edit_slot");
        } else {
            echo "You do not have sufficient rights to view this page!";
        }
        $this->load->view("layout/footer", $data);
    }

    /**
     * Page that lists out all the slots
     */
    public function view_slots() {

        $data = $this->layoutmodel->main("Gridphoria | Manage Slots");
        $data["slots"] = $this->datamodel->getSlots();

        $this->load->view("layout/header", $data);
        $this->load->view("dashboard/view_slots", $data);
        $this->load->view("layout/footer", $data);
    }

    /**
     * Deletes a slot
     * @param type $id
     */
    public function delete_slot($id) {

        $data = $this->layoutmodel->main("Gridphoria | Delete Slots");
        if ($data['is_current_user_faculty_chair']) {
            $this->datamodel->deleteSlot($id);
        }
        redirect("/dashboard/view_slots");
    }

    /* ==========================================================================
     * Users Section 
     * ========================================================================= */

    public function users() {

        $data = $this->layoutmodel->main("Gridphoria | Users");
        $data["users"] = $this->datamodel->getUsers();
        $this->load->view("layout/header", $data);
        if ($data['is_current_user_faculty_chair']) {
            $this->load->view("dashboard/users");
        } else {
            echo "You do not have sufficient rights to view this page!";
        }
        $this->load->view("layout/footer", $data);
    }

    public function enable_user($id) {

        $user = $this->usermodel;
        $user->id = $id;
        $user->get_user();

        if ($user->check_user()) {
            $user->enabled = 1;
            $user->update();
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function disable_user($id) {

        $user = $this->usermodel;
        $user->id = $id;
        $user->get_user();

        if ($user->check_user()) {
            $user->enabled = 0;
            $user->update();
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Logs out the user by destroying the current session
     */
    public function logout() {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        redirect("/");
    }

}
