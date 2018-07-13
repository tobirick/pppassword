<?php

namespace App\Controllers;

use \Core\BaseController;
use \Core\Request;
use \App\Models\Password;

class PasswordController extends BaseController
{
    public function index(Request $request)
    {
        $this->view('passwords.index')->render();
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}