<?php

namespace App\Controllers;

use \Core\BaseController;
use \App\Models\User;

class IndexController extends BaseController
{
    public function index()
    {
        $this->view('index')->render();
    }
}