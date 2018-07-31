<?php
/**
 * Created by PhpStorm.
 * User: tobias.rickmann
 * Date: 13.07.2018
 * Time: 16:10
 */

namespace App\Controllers\API;

use App\Models\Password;
use Core\Request;
use Core\Crypt;

class PasswordController
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $password = $request->ajax()->getJSON()['passwordRecord'];

        $errors = $request->validate([
            'title' => 'required',
            'email' => 'email',
        ], 'passwordRecord');

        if (sizeof($errors) === 0) {
            $newPassword = new Password([
                'title' => $password['title'],
                'url' => Crypt::encrypt($password['url']),
                'email' => Crypt::encrypt($password['email']),
                'username' => Crypt::encrypt($password['username']),
                'password' => Crypt::encrypt($password['password']),
                'notes' => $password['notes'],
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => $request->user(),
            ]);

            $savedPasswordId = $newPassword->query()->insert();

            $clients = $password['clients'];
            $tags = $password['tags'];
            $entryFields = $password['entryFields'];

            if ($clients) {
                foreach ($clients as $client) {
                    $passwordClients[] = Password::query()->table('password_record_clients')->insert([
                        'password_record_id' => $savedPasswordId,
                        'client_id' => $client,
                    ]);
                }
            }

            if ($tags) {
                foreach ($tags as $tag) {
                    $passwordTags[] = Password::query()->table('password_record_tags')->insert([
                        'password_record_id' => $savedPasswordId,
                        'title' => $tag['title'],
                    ]);
                }
            }

            if ($entryFields) {
                foreach ($entryFields as $entryField) {
                    $passwordEntryFields[] = Password::query()->table('password_record_entry_fields')->insert([
                        'password_record_id' => $savedPasswordId,
                        'field_key' => $entryField['field_key'],
                        'field_value' => Crypt::encrypt($entryField['field_value'])
                    ]);
                }
            }

            $savedPassword = Password::getPasswordWithDetailsByID($savedPasswordId);

            $request->ajax()->send($savedPassword)->json();
        }

    }

    public function show()
    {

    }

    public function update(Request $request)
    {
        $password = $request->ajax()->getJSON()['passwordRecord'];
        $passwordId = $request->getParam('passwordId');

        $errors = $request->validate([
            'title' => 'required',
            'email' => 'email',
        ], 'passwordRecord');

        if (sizeof($errors) === 0) {
            Password::query()->where('id', $passwordId)->update([
                'title' => $password['title'],
                'url' => Crypt::encrypt($password['url']),
                'email' => Crypt::encrypt($password['email']),
                'username' => Crypt::encrypt($password['username']),
                'password' => Crypt::encrypt($password['password']),
                'notes' => $password['notes'],
            ]);

            $clients = $password['clients'];
            $oldClients = Password::query()->table('password_record_clients')->where('password_record_id', $passwordId)->get();

            $tags = $password['tags'];
            $oldTags = Password::query()->table('password_record_tags')->where('password_record_id', $passwordId)->get();

            $entryFields = $password['entryFields'];
            $oldEntryFields = Password::query()->table('password_record_entry_fields')->where('password_record_id', $passwordId)->get();

            // Check clients
            if ($clients) {
                foreach ($clients as $client) {
                    $clientAlreadyExists = array_filter($oldClients, function ($e) use (&$client) {
                        return $e->client_id === $client;
                    });

                    if (!$clientAlreadyExists) {
                        Password::query()->table('password_record_clients')->insert([
                            'password_record_id' => $passwordId,
                            'client_id' => $client,
                        ]);
                    }
                }
            } else {
                Password::query()->table('password_record_clients')->where('password_record_id', $passwordId)->delete();
            }

            // Check tags
            if ($tags) {
                foreach ($tags as $tag) {
                    $tagTitle = $tag['title'];
                    $tagAlreadyExists = array_filter($oldTags, function ($e) use (&$tagTitle) {
                        return $e->title === $tagTitle;
                    });

                    if ($tagAlreadyExists) {
                        Password::query()->table('password_record_tags')->where([
                            'password_record_id' => $passwordId,
                            'title' => $tagTitle,
                        ])->update([
                            'title' => $tagTitle,
                        ]);
                    } else {
                        Password::query()->table('password_record_tags')->insert([
                            'password_record_id' => $passwordId,
                            'title' => $tagTitle,
                        ]);
                    }
                }
            } else {
                Password::query()->table('password_record_tags')->where('password_record_id', $passwordId)->delete();
            }

            // Checks entry fields
            if ($entryFields) {
                foreach ($entryFields as $entryField) {
                    $entryFieldId = $entryField['id'];
                    $entryFieldAlreadyExists = array_filter($oldEntryFields, function ($e) use (&$entryFieldId) {
                        return $e->id === $entryFieldId;
                    });

                    if ($entryFieldAlreadyExists) {
                        Password::query()->table('password_record_entry_fields')->where('id', $entryFieldId)->update([
                            'field_key' => Crypt::encrypt($entryField['field_key']),
                            'field_value' => Crypt::encrypt($entryField['field_value']),
                        ]);
                    } else {
                        Password::query()->table('password_record_entry_fields')->insert([
                            'password_record_id' => $passwordId,
                            'field_key' => Crypt::encrypt($entryField['field_key']),
                            'field_value' => Crypt::encrypt($entryField['field_value']),
                        ]);
                    }
                }
            } else {
                Password::query()->table('password_record_entry_fields')->where('password_record_id', $passwordId)->delete();
            }

            $savedPassword = Password::getPasswordWithDetailsByID($passwordId);

            $request->ajax()->send($savedPassword)->json();
        }
    }

    public function delete()
    {

    }
}
