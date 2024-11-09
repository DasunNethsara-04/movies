<?php

namespace ZenithPHP\App\Controllers;

use ZenithPHP\Core\Controller\Controller;
use hmerritt\Imdb;
use ZenithPHP\Core\Http\Request;
use ZenithPHP\Core\Http\Response;

class MovieController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $response->json(['message' => 'Welcome to ZenithPHP!']);
    }

    public function getMovie(Request $request, Response $response)
    {
        $imdb = new Imdb();
        $data = $imdb->search("Iron Man");
        $response->json($data['titles']);
    }
}
