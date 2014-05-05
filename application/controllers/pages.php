<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

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
        $this->session_uid = $this->usermodel->session_uid;
        $this->session_logged_in = $this->usermodel->session_logged_in;

//        $this->output->enable_profiler(TRUE);
    }

    public function index() {
        redirect("/");
    }

    /**
     * Login page
     */
    public function login() {

        // redirect back to home if logged in
        if ($this->session_uid) {
            redirect("/");
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

    /**
     * Method to show the forgot password page
     */
    public function forgotpassword() {

        $data = $this->layoutmodel->main("Gridphoria | Forgot password");
        $data += $this->session->all_userdata();

        $data += $this->_sendpasswordinfo();

        $this->load->view("layout/header", $data);
        $this->load->view('pages/forgotpassword', $data);
        $this->load->view('layout/footer', $data);
    }

    /**
     * Method to show the reset password page
     */
    public function resetpassword($uid, $tokken, $page) {

        $data = $this->layoutmodel->main("Login");
        $data += $this->session->all_userdata();
        $data["current_page"] = "login";

        $data['tokken'] = $tokken;
        $data += $this->_resetpassword($uid, $tokken, $page);

        $this->load->view("layout/header", $data);
        $this->load->view('pages/resetpassword', $data);
        $this->load->view('layout/footer', $data);
    }

    /**
     * Method to send password reset info
     * @return Array
     */
    private function _sendpasswordinfo() {
        $logininfo = $this->input->post('data');
        $email = $logininfo['user']['email'];

        $this->usermodel->email = $email;
        $this->usermodel->check_user();
        $this->usermodel->get_user();
        $tokken = $this->usermodel->get_access_tokken();

        $data = array();

        if ($tokken && $email) {
            $uid = $this->usermodel->id;

            // find out the domain:
            $domain = $_SERVER['HTTP_HOST'];

            $message = "Hello there! \n";
            $message .= "Use this URI to reset your password:\n ";
            $message .= "http://" . $domain . "/pages/resetpassword/$uid/$tokken";

            $this->load->library('email');

            $this->email->from('no-reply@gridphoria.com', 'Gridphoria');
            $this->email->to($email);

            $this->email->subject('Password Reset Info');
            $this->email->message($message);

            if ($this->email->send()) {
                $data['successmessage'] = "You have been sent your reset password information";
            } else {
                $data['errormessage'] = "Sorry but seems like there was an error while sending you the information";
            }

//            echo "<pre>";
//            echo $this->email->print_debugger();
//            echo "</pre>";
        }else if ($email && !$tokken) {
            $data['errormessage'] = "Sorry but we dont have you on file!";
        }

        return $data;
    }

    /**
     * Method to process reset password info
     * @param int $uid
     * @param string $tokken
     * @return Array
     */
    private function _resetpassword($uid, $tokken, $page) {

        $this->usermodel->_id = $uid;
        $this->usermodel->check_user();
        $this->usermodel->get_user();
        $tokken = $this->usermodel->get_access_tokken();

        $email = $this->usermodel->email;

        $data = array();

        $data['email'] = $email;
        $data['uid'] = $uid;

        $password = sha1($this->input->post("password"));
        $cpassword = sha1($this->input->post("cpassword"));

        if ($password == $cpassword && $tokken == $this->usermodel->get_access_tokken() && $page == "send") {
            $this->db->query("update users set password = '$password' where id = $uid");

            $newdata = array(
                'uid' => $uid,
                'login_time' => time(),
                'logged_in' => true
            );

            $this->session->set_userdata($newdata);
            redirect("/dashboard");
        }

        return $data;
    }

}
