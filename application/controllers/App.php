<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author Mithu CN
 */
class App extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('AppModel');
    }

   

}
