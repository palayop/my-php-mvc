<?php

namespace Palayop\Demomvc\Controllers;

use Palayop\Demomvc\Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->setLayout('layout');
    }

    public function index()
    {
        $this->view('index');
    }
}