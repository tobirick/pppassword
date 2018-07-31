<?php
/**
 * Created by PhpStorm.
 * User: tobias.rickmann
 * Date: 13.07.2018
 * Time: 16:09
 */

namespace App\Controllers\API;

use App\Models\Client;
use Core\Request;

class ClientController
{
    public function index(Request $request)
    {
        $clients = Client::query()->select('*, id as client_id')->get();

        $request->ajax()->send($clients)->json();
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}