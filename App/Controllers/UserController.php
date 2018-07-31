<?php

namespace App\Controllers;

use \Core\BaseController;
use \Core\Request;
use \App\Models\User;
use \App\Models\Auth;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::getUserDetails();
        $this->view('users.index', [
            'users' => $users
        ])->render();
    }

    public function create()
    {
        $this->view('users.create')->render();
    }

    public function store(Request $request)
    {
        $errors = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], 'user');

        if ($errors) {
            $this->redirectToRoute('users.create');
        } else {
            $newUser = new Auth([
                'email' => $_POST['user']['email']
            ]);
            $id = $newUser->register($_POST['user']['password']);

            if ($id) {
                $user = $_POST['user'];
                User::query()->where('id', $id)->update([
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'city' => $user['city'],
                    'plz' => $user['plz'],
                    'street' => $user['street'],
                    'phone' => $user['phone'],
                    'mobile_phone' => $user['mobile_phone'],
                    'notes' => $user['notes']
                ]);
                $request->flash()->message($this->translate('Successfully created') . ' "' . $user['first_name'] . ' ' . $user['last_name'] . '"!')->success()->set();
                $this->redirectToRoute('users.show', ['userId' => $id]);
            } else {
                $request->flash()->message($this->translate('Something went wrong!'))->error()->set();
                $this->redirectToRoute('users.create');
            }
        }
    }

    public function show(Request $request)
    {
        $id = $request->getParam('userId');
        $user = User::getUserDetail(($id));
        $this->view('users.show', [
            'user' => $user
        ])->render();
    }

    public function edit(Request $request)
    {
        $id = $request->getParam('userId');
        $user = User::getUserDetail(($id));
        $this->view('users.edit', [
            'user' => $user
        ])->render();
    }

    public function update(Request $request)
    {
        $id = $request->getParam('userId');

        $errors = $request->validate([
            'email' => 'required|email'
        ], 'user');

        if($errors) {
            $this->redirectToRoute('users.edit', ['userId' => $id]);
            return;
        }

        $user = $_POST['user'];

        // Update User Details
        User::query()->where('id', $id)->update([
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'city' => $user['city'],
            'plz' => $user['plz'],
            'street' => $user['street'],
            'phone' => $user['phone'],
            'mobile_phone' => $user['mobile_phone'],
            'notes' => $user['notes']
        ]);

        // Update Username and E-Mail
        User::query()->table('users')->where('id', $id)->update([
            'email' => $user['email'],
            'username' => $user['username']
        ]);

        $request->flash()->message($this->translate('Successfully updated') . ' "' . $user['first_name'] . ' ' . $user['last_name'] . '"!')->success()->set();
        $this->redirectToRoute('users.edit', ['userId' => $id]);
    }

    public function delete(Request $request)
    {
        $id = $request->getParam('userId');

        User::query()->table('users')->where('id', $id)->delete();

        $this->redirectToRoute('users');
    }
}