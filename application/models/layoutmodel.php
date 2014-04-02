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
        
        
//<link href='../fullcalendar/fullcalendar.css' rel='stylesheet' />
//<link href='../fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
//<script src='../lib/moment.min.js'></script>
//<script src='../lib/jquery.min.js'></script>
//<script src='../lib/jquery-ui.custom.min.js'></script>
//<script src='../fullcalendar/fullcalendar.min.js'></script>


        $this->css = array(
            array('main.css?version=2.0&amp;time=' . time()),
            array('foundation.css'),
            array("jquery.timepicker.css"),
            array('bootstrap-datepicker.css'),
            array('fullcalendar.css'),
            array('fullcalendar.print.css'),
            array('foundation-icons.css')
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


        return $data;
    }
}