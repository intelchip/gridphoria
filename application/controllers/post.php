<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

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
        redirect(base_url() . '/');
    }

    /* ==========================================================================
      Courses
     * ========================================================================= */

    /**
     * Adds courses to the DB
     */
    public function add_courses() {
        $course = $this->coursemodel;
        $course->crn = $this->data["course"]["crn"];
        $course->name = $this->data["course"]["name"];
        $course->description = $this->data["course"]["description"];
        $course->semester = $this->data["course"]["semester"];
        $course->instructor_id = $this->data["course"]["instructor"];
        $course->slots = $this->data["course"]["slots"];

        if ($course->is_valid()) {
            $course->save();
            redirect($_SERVER['HTTP_REFERER'] . "?success=true");
        } else {
            redirect($_SERVER['HTTP_REFERER'] . "?success=error");
        }
    }

    /**
     * Updates a course
     * @param int $id
     */
    public function edit_course() {
        $course = $this->coursemodel;
        $course->id = $this->data["course"]["id"];
        $course->crn = $this->data["course"]["crn"];
        $course->name = $this->data["course"]["name"];
        $course->description = $this->data["course"]["description"];
        $course->semester = $this->data["course"]["semester"];
        $course->instructor_id = $this->data["course"]["instructor"];
        $course->slots = $this->data["course"]["slots"];

        if ($course->is_valid()) {
            $course->update();
            redirect("/dashboard/edit_course/{$course->id}?success=true");
        } else {
            redirect("/dashboard/edit_course/{$course->id}?success=error");
        }
    }

    /* ==========================================================================
      Semesters
     * ========================================================================= */

    /**
     * Creates/opens a semester
     */
    public function open_semester() {
        $semester = $this->semestermodel;
        $semester->semester = $this->data["semester"]["name"];
        $semester->year = $this->data["semester"]["year"];
        $semester->modified = time();
        $semester->modified_by = "Chair";

        if (!$this->datamodel->semesterExists($semester->semester, $semester->year)) {
            $semester->save();
            redirect("/dashboard/open_semester?success=true");
        } else {
            redirect("/dashboard/open_semester?success=error");
        }
    }

    /* ==========================================================================
      Slots
     * ========================================================================= */

    /**
     * Adds slots to the DB
     */
    public function add_slots() {
        $slot_info = $this->data["slot"];
        $name = $slot_info["slot_name"];
        $capacity = $slot_info["capacity"];
        $schedule = $slot_info["schedule"];

        $user = $this->usermodel->get_current_user();

        $slot = $this->slotmodel;
        $slot->slot = $name;
        $slot->capacity = $capacity;
        $slot->schedule = $schedule;
        $slot->modified = time();
        $slot->modified_by = $user->email;


        if ($slot->is_valid()) {
            $slot->save();
            redirect("/dashboard/view_slots?success=true");
        } else {
            redirect($_SERVER['HTTP_REFERER'] . "?success=error");
        }
    }

    /**
     * Edits slots
     */
    public function edit_slot() {
        $slot_info = $this->data["slot"];
        $id = $slot_info["slot_id"];
        $name = $slot_info["slot_name"];
        $capacity = $slot_info["capacity"];
        $schedule = $slot_info["schedule"];

        $user = $this->usermodel->get_current_user();

        $slot = $this->slotmodel;
        $slot->id = $id;
        $slot->slot = $name;
        $slot->capacity = $capacity;
        $slot->schedule = $schedule;
        $slot->modified = time();
        $slot->modified_by = $user->email;


        if ($slot->is_valid()) {
            $slot->update();
            redirect("/dashboard/edit_slot/$id?success=true");
        } else {
            redirect("/dashboard/edit_slot/$id?success=error");
        }
    }

}
