<?php

/* 
 * 
 */
if ( ! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class logout extends CI_Controller
{
    public function index()
    {
        $this->session->sess_destroy();
        setcookie(session_name(),'',time()-3600);
        $_SESSION= array();
        redirect('default_control');
    }
}




