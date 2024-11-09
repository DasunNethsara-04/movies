<?php

namespace ZenithPHP\App;

use ZenithPHP\Config\CORS;
use ZenithPHP\Core\Http\InitEnv;
use ZenithPHP\Core\Http\Router;

// Load environment variables
InitEnv::load();

// Set CORS headers
CORS::setHeaders();

/**
 * This file defines the routes for the application.
 * It uses the Router class to map URLs to their corresponding controller actions.
 *
 * Please do not remove or change anything above this comment.
 */

// YOUR ROUTES GO HERE
// Router::get('/', 'WelcomeController', 'index');

Router::get('/api/', 'MovieController', 'index');
Router::get('/api/get-movie', 'MovieController', 'getMovie');
