<?php

namespace App\Controllers;

use \Core\BaseController;
use \Core\Request;
use \App\Models\Client;
use \App\Models\Folder;


class ClientController extends BaseController
{
    public function index()
    {
        $clients = Client::query()->get();
        $this->view('clients.index', [
            'clients' => $clients
        ])->render();
    }

    public function create()
    {
        $this->view('clients.create')->render();
    }

    public function store(Request $request)
    {
        $errors = $request->validate([
            'email' => 'required|email',
            'name' => 'required'
        ], 'client');

        if ($errors) {
            $this->redirectToRoute('clients.create');
        } else {
            $newClient = $_POST['client'];
            $client = new Client([
                'name' => $newClient['name'],
                'email' => $newClient['email'],
                'phone' => $newClient['phone'],
                'mobile_phone' => $newClient['mobile_phone'],
                'notes' => $newClient['notes'],
                'city' => $newClient['city'],
                'plz' => $newClient['plz'],
                'street' => $newClient['street'],
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => $request->user()
            ]);

            $id = $client->query()->insert();

            $folder = new Folder([
                'name' => $newClient['name'],
                'position' => NULL,
                'is_client' => 1,
                'client_id' => $id,
                'parent_id' => NULL,
                'created_by' => $request->user(),
                'created_at' => date("Y-m-d H:i:s")
            ]);

            if($id && $folder->query()->insert()) {
                $request->flash()->message($this->translate('Successfully created') . ' "' . $newClient['name'] . '"!')->success()->set();
                $this->redirectToRoute('clients.show', ['clientId' => $id]);
            } else {
                $request->flash()->message($this->translate('Something went wrong!'))->error()->set();
                $this->redirectToRoute('clients.create');
            }
        }
    }

    public function show(Request $request)
    {
        $id = $request->getParam('clientId');
        $client = Client::query()->where('id', $id)->getOne();
        $this->view('clients.show', [
            'client' => $client
        ])->render();
    }

    public function edit(Request $request)
    {
        $id = $request->getParam('clientId');
        $client = Client::query()->where('id', $id)->getOne();
        $this->view('clients.edit', [
            'client' => $client
        ])->render();
    }

    public function update(Request $request)
    {
        $id = $request->getParam('clientId');

        $errors = $request->validate([
            'email' => 'required|email',
            'name' => 'required'
        ], 'client');

        if($errors) {
            $this->redirectToRoute('clients.edit', ['clientId' => $id]);
            return;
        }

        $client = $_POST['client'];

        Client::query()->where('id', $id)->update([
            'name' => $client['name'],
            'email' => $client['email'],
            'phone' => $client['phone'],
            'mobile_phone' => $client['mobile_phone'],
            'notes' => $client['notes'],
            'city' => $client['city'],
            'plz' => $client['plz'],
            'street' => $client['street'],
        ]);

        $request->flash()->message($this->translate('Successfully updated') . ' "' . $client['name'] . '"!')->success()->set();
        $this->redirectToRoute('clients.edit', ['clientId' => $id]);
    }

    public function delete(Request $request)
    {
        $id = $request->getParam('clientId');

        Client::query()->where('id', $id)->delete();

        $this->redirectToRoute('clients');
    }
}