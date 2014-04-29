<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Paginatormodel extends CI_Model {

    var $itemsPerPage;
    var $itemsTotal;
    var $currentPage;
    var $numPages;
    var $midRange;
    var $low;
    var $high;
    var $limit;
    var $return;
    var $defaultIpp = 25;
    var $section;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $ipp = $this->input->get("ipp");
        $this->currentPage = 1;
        $this->midRange = 7;
        $this->itemsPerPage = (!empty($ipp)) ? $ipp : $this->defaultIpp;
    }

    /**
     * Creates the pagination links
     * @public
     * @method paginate
     */
    function paginate() {
        $ipp = $this->input->get("ipp");
        if ($ipp == 'All') {
            $this->numPages = ceil($this->itemsTotal / $this->defaultIpp);
            $this->itemsPerPage = $this->defaultIpp;
        } else {
            if (!is_numeric($this->itemsPerPage) OR $this->itemsPerPage <= 0)
                $this->itemsPerPage = $this->defaultIpp;
            $this->numPages = ceil($this->itemsTotal / $this->itemsPerPage);
        }
//        $this->currentPage = (int) @ $_GET['page']; // must be numeric > 0
        if ($this->currentPage < 1 || !is_numeric($this->currentPage)) {
            $this->currentPage = 1;
        }
        if ($this->currentPage > $this->numPages) {
            $this->currentPage = $this->numPages;
        }
        $prev_page = $this->currentPage - 1;
        $next_page = $this->currentPage + 1;

        $this->return = "<ul class=\"pagination\">";
        if ($this->numPages > 10) {
            $this->return .= ($this->currentPage != 1 && $this->itemsTotal >= 10) ? "<li><a class=\"paginate\" href=\"$this->section/$prev_page?ipp=$this->itemsPerPage\">« Previous</a></li> " : "<li><span class=\"inactive\" href=\"#\">« Previous</span></li> ";

            $this->start_range = $this->currentPage - floor($this->midRange / 2);
            $this->end_range = $this->currentPage + floor($this->midRange / 2);

            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }
            if ($this->end_range > $this->numPages) {
                $this->start_range -= $this->end_range - $this->numPages;
                $this->end_range = $this->numPages;
            }
            $this->range = range($this->start_range, $this->end_range);
            for ($i = 1; $i <= $this->numPages; $i++) {
                if ($this->range[0] > 2 && $i == $this->range[0]) {
                    $this->return .= "<li class=\"unavailable\"><a href=\"\">&hellip;</a></li>";
                }
                // loop through all pages. if first, last, or in range, display
                if ($i == 1 || $i == $this->numPages || in_array($i, $this->range)) {
                    $this->return .= ($i == $this->currentPage) ? "<li><a title=\"Go to page $i of $this->numPages\" class=\"current\" href=\"#\">$i</a></li>" : "<li><a class=\"paginate\" title=\"Go to page $i of $this->numPages\" href=\"$this->section/$i?ipp=$this->itemsPerPage\">$i</a></li>";
                }
                if ($this->range[$this->midRange - 1] < $this->numPages - 1 && $i == $this->range[$this->midRange - 1]) {
                    $this->return .= "<li class=\"unavailable\"><a href=\"\">&hellip;</a></li>";
                }
            }
            $this->return .= (($this->currentPage != $this->numPages && $this->itemsTotal >= 10)) ? "<li><a class=\"paginate\" href=\"$this->section/$next_page?ipp=$this->itemsPerPage\">Next »</a></li>" : "<li><span class=\"inactive\" href=\"#\">» Next</span></li>";
            $this->return .= (@$_GET['page'] == 'All') ? "<li class=\"current\"><a class=\"current\" style=\"margin-left:10px\" href=\"#\">All</a></li>" : "<li><a class=\"paginate\" style=\"margin-left:10px\" href=\"$this->section/1?ipp=All\">All</a></li>";
        } else {
            for ($i = 1; $i <= $this->numPages; $i++) {
                $this->return .= ($i == $this->currentPage) ? "<li class=\"current\"><a class=\"current\" href=\"#\">$i</a></li>" : "<li><a class=\"paginate\" href=\"$this->section/$i?ipp=$this->itemsPerPage\">$i</a></li>";
            }
            $this->return .= "<li><a class=\"paginate\" href=\"$this->section/1?ipp=All\">All</a></li>";
        }
        $this->return .= "</ul>";
        $this->low = ($this->currentPage - 1) * $this->itemsPerPage;
        $this->high = (@$_GET['ipp'] == 'All') ? $this->itemsTotal : ($this->currentPage * $this->itemsPerPage) - 1;
        $this->limit = (@$_GET['ipp'] == 'All') ? "" : " LIMIT $this->low,$this->itemsPerPage";
    }

    /**
     * returns string containing html display for items per page
     * @public
     * @method displayItemsPerPage
     * @return string
     */
    function displayItemsPerPage() {
        $items = '';
        $ipp_array = array(10, 25, 50, 100, 'All');
        foreach ($ipp_array as $ipp_opt) {
            $items .= ($ipp_opt == $this->itemsPerPage) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n" : "<option value=\"$ipp_opt\">$ipp_opt</option>\n";
        }
        return "<span class=\"paginate\">Items per page:</span><select class=\"paginate\" onchange=\"window.location='$this->section/1?ipp='+this[this.selectedIndex].value;return false\">$items</select>\n";
    }

    /**
     * returns string for a jump menu
     * @public
     * @method displayJumpMenu
     * @return string
     */
    function displayJumpMenu() {
        for ($i = 1; $i <= $this->numPages; $i++) {
            $option .= ($i == $this->currentPage) ? "<option value=\"$i\" selected>$i</option>\n" : "<option value=\"$i\">$i</option>\n";
        }
        return "<span class=\"paginate\">Page:</span><select class=\"paginate\" onchange=\"window.location='$this->section/'+this[this.selectedIndex].value+'?ipp=$this->itemsPerPage';return false\">$option</select>\n";
    }

    /**
     * returns string for pagination links
     * @public
     * @method displayPages
     * @return string
     */
    function displayPages() {
        return $this->return;
    }

}
