<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Layoutmodel extends CI_Model {

    var $css = null;
    var $js = null;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Method to load styles and scripts of a page
     * @param string $page - This is the title of the page
     * @return Array 
     */
    public function main($page) {

        $data['page'] = $page;


        $this->css = array(
            array('bootstrap.min.css'),
            array('bootstrap-timepicker.min.css'),
            array('foundation.css'),
            array("jquery.timepicker.css"),
            array('bootstrap-datepicker.css'),
            array('fullcalendar.css'),
            array('fullcalendar.print.css'),
            array('foundation-icons.css'),
            array('main.css?version=2.0&amp;time=' . time())
        );
        $this->js = array(
            array("vendor/modernizr.js"),
            array("foundation.min.js"),
            array("foundation/foundation.abide.js"),
            array("jquery.timepicker.js"),
            array("bootstrap-datepicker.js"),
            array("moment.min.js"),
            array("fullcalendar.min.js"),
            array("common.js")
        );

        $this->carabiner->group('main-styles', array('css' => $this->css));
        $this->carabiner->group('main-scripts', array('js' => $this->js));

        $data['css'] = $this->carabiner->display_string('main-styles');
        $data['js'] = $this->carabiner->display_string('main-scripts');

        // Add is_faculty_chair here since the layout model is added throughout all pages
        $data['is_current_user_faculty_chair'] = $this->usermodel->is_curent_user_chair();

        return $data;
    }

}
