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

    //put your code here
    public function index() {
        $data = [];
        $data['title'] = "Home page";
        $json = $this->AppModel->getMoiveList();
        $data['genres'] = $json->genres;
        $data['contain'] = $this->load->view('home.php', $data, TRUE);
        $this->load->view('index', $data);
    }

    function pagination($page) {
        $data = [];
        $this->load->library("pagination");
        $genre = $this->input->post('genre');
        $searchText = $this->input->post('searchText');
        $json = $this->AppModel->getMoiveList();
        $moviesList = $json->movies;
        $keys = array_keys($moviesList);
        $flag = false;
        /* Start perform for filter movielist */
        if (!empty($searchText)) {
            $flag = true;
            $searchText = preg_quote(strtolower($searchText), '~');
            $allMovieTitle = array_map(function ($a) {
                return strtolower($a->title);
            }, $moviesList);
            $result = preg_grep('~' . $searchText . '~', $allMovieTitle);
            $keys = array_keys($result);
        }
        if (!empty($genre)) {
            $flag = true;
            $genreKey = [];
            foreach ($keys as $key) {
                if (in_array($genre, $moviesList[$key]->genres))
                    $genreKey[] = $key;
            }
            $keys = $genreKey;
        }
        if ($flag) {
            $filterMovieslist = [];
            foreach ($keys as $key) {
                $filterMovieslist[] = $moviesList[$key];
            }
            $moviesList = $filterMovieslist;
        }
        $data['moviesList'] = $moviesList;
        /* start perform to create pagination */
        $config = array();
        $config["base_url"] = "page";
        $config["total_rows"] = count($data['moviesList']);
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config["use_page_numbers"] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config["num_links"] = 1;
        $this->pagination->initialize($config);
        $start = ($page - 1) * $config["per_page"];
        $movies = array_slice($data['moviesList'], $start, $config["per_page"]);
        $output = '<div class="row" id="movieRow">';
        $i = 0;
        $isDataFind = FALSE;
        foreach ($movies as $movie) {
            $isDataFind = TRUE;
            $output .='<div class="col-md-3"><div><a href="' . base_url('app/movieDetail/' . $movie->id) . '"><img class="img-thumbnail" alt="' . $movie->title . '" src="' . $movie->posterUrl . '">
                <h6 class="mute" style="color:black">' . $movie->title . '</h6><div class="caption"><em>Year: ' . $movie->year . '</em><br>
                <em>Director: ' . $movie->director . '</em><br>';

            foreach ($movie->genres as $genre) {
                $output .='<mark>' . $genre . '</mark> ';
            }
            $output .='</div></a></div></div>';
            $i++;
            if ($i % 4 == 0)
                $output .= '</div><div class="row" id="movieRow">';
        }
        if ($isDataFind) {
            $output = array(
                'status' => True,
                'pagination_link' => $this->pagination->create_links(),
                'movieList' => $output
            );
        } else {
            $output = [
                'status' => False,
                'message' => "Nothing to be matched !!"
            ];
        }

        echo json_encode($output);
    }

    function movieDetail($id) {
        $data = [];
        $data['title'] = "Movie details page";
        $data['movieDetails'] = $this->AppModel->getMoiveListByid($id);
        $data['contain'] = $this->load->view('details.php', $data, TRUE);
        $this->load->view('index', $data);
    }

}
