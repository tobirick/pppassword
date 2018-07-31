<?php
/**
 * Created by PhpStorm.
 * User: tobias.rickmann
 * Date: 13.07.2018
 * Time: 16:09
 */

namespace App\Controllers\API;


use App\Models\Folder;
use App\Models\Client;
use Core\Request;

class FolderController
{
    public function index(Request $request)
    {
        $folders = Folder::getAllFolders();

        $request->ajax()->send($folders)->json();
    }

    public function store(Request $request)
    {
        $folder = $request->ajax()->getJSON()['folder'];

        $folderErrors = $request->validate([
            'name' => 'required'
        ], 'folder');

        if(sizeof($folderErrors) === 0) {
            if($folder['isClient'] === 1) {

                $clientErrors = $request->validate([
                    'email' => 'email'
                ], $folder['client']);

                if(sizeof($clientErrors) > 0) {
                    return;
                }

                $client = new Client([
                    'name' => $folder['name'],
                    'email' => $folder['client']['email'],
                    'phone' => $folder['client']['phone'],
                    'mobile_phone' => $folder['client']['mobilePhone'],
                    'notes' => $folder['client']['notes'],
                    'city' => $folder['client']['city'],
                    'plz' => $folder['client']['plz'],
                    'street' => $folder['client']['street'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'created_by' => $request->user()
                ]);

                $savedClientId = $client->query()->insert();
            }

            $newFolder = new Folder([
                'name' => $folder['name'],
                'position' => $folder['position'],
                'is_client' => $folder['isClient'],
                'client_id' => isset($savedClientId) ? $savedClientId : NULL,
                'parent_id' => $folder['parentId'],
                'created_by' => $request->user(),
                'created_at' => date("Y-m-d H:i:s")
            ]);

            $savedFolderId = $newFolder->query()->insert();

            $folderToSend = Folder::getFolderByID($savedFolderId);

            $request->ajax()->send($folderToSend)->json();
        }
    }

    public function show()
    {

    }

    public function update(Request $request)
    {
        $folder = $request->ajax()->getJSON()['folder'];
        $folderId = $request->getParam('folderId');

        $folderErrors = $request->validate([
            'name' => 'required'
        ], 'folder');

        if(sizeof($folderErrors) === 0) {
            if($folder['isClient'] === 1) {

                $clientErrors = $request->validate([
                    'email' => 'email'
                ], $folder['client']);

                if(sizeof($clientErrors) > 0) {
                    return;
                }

                Client::query()->where('id', $folder['client']['id'])->update([
                    'name' => $folder['name'],
                    'email' => $folder['client']['email'],
                    'phone' => $folder['client']['phone'],
                    'mobile_phone' => $folder['client']['mobilePhone'],
                    'notes' => $folder['client']['notes'],
                    'city' => $folder['client']['city'],
                    'plz' => $folder['client']['plz'],
                    'street' => $folder['client']['street']
                ]);
            }

            Folder::query()->where('id', $folderId)->update([
                'name' => $folder['name']
            ]);

            $folderToSend = Folder::getFolderByID($folderId);

            $request->ajax()->send($folderToSend)->json();
        }

    }

    public function delete()
    {

    }
}