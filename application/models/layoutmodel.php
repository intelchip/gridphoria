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
            array('main.css?version=2.0&amp;time=' . time()),
            array('foundation.css'),
            array("jquery.timepicker.css"),
            array('bootstrap-datepicker.css')
        );
        $this->js = array(
            array("vendor/modernizr.js"),
            array("foundation.min.js"),
            array("jquery.timepicker.js"),
            array("bootstrap-datepicker.js"),
            array("common.js")
        );

        $this->carabiner->group('main-styles', array('css' => $this->css));
        $this->carabiner->group('main-scripts', array('js' => $this->js));

        $data['css'] = $this->carabiner->display_string('main-styles');
        $data['js'] = $this->carabiner->display_string('main-scripts');


        return $data;
    }
}