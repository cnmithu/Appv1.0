<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppModel
 *
 * @author Mithu CN
 */
class AppModel extends CI_Model {

    //put your code here
    public $str;

    function __construct() {
        parent::__construct();
        $this->str = file_get_contents(base_url('db.json'));
    }

    function getMoiveList() {
        return json_decode($this->str);
    }

    function getMoiveListByid($id) {
        $json = json_decode($this->str);
        
        foreach ($json->movies as $movie) {
            if ($movie->id == $id)
                return $movie;
        }
    }

}
