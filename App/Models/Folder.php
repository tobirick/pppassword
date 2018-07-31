<?php
/**
 * Created by PhpStorm.
 * User: tobias.rickmann
 * Date: 13.07.2018
 * Time: 16:10
 */

namespace App\Models;

use Core\Model;

class Folder extends Model
{
    protected static $table = 'folders';
    protected static $fillable = ['name', 'position', 'is_client', 'client_id', 'parent_id', 'created_by', 'created_at'];

    public static function getAllFolders() {
        $folders = self::query()
            ->select('folders.*, clients.city, clients.email, clients.phone, clients.mobile_phone, clients.notes, clients.city, clients.street, clients.plz')
            ->where('folders.parent_id IS NULL')
            ->join('left', [
            'clients' => ['id' => 'client_id']
        ])->get();

        foreach($folders as $folder) {
            if($folder->is_client) {
                $folder->password_records = Password::getAllPasswordsWithDetailsByClientID($folder->client_id);
            }

            $childrenFolders = self::getFoldersByParentID($folder->id);
            $folder->children_folders = $childrenFolders;
        }

        return $folders;
    }

    public static function getFolderByID($id) {
        $folder = self::query()
            ->select('folders.*, clients.city, clients.email, clients.phone, clients.mobile_phone, clients.notes, clients.city, clients.street, clients.plz')
            ->where('folders.id = ' . $id)
            ->join('left', [
            'clients' => ['id' => 'client_id']
        ])->getOne();

        if($folder->is_client) {
            $folder->password_records = Password::getAllPasswordsWithDetailsByClientID($folder->client_id);
        }

        $childrenFolders = self::getFoldersByParentID($folder->id);
        $folder->children_folders = $childrenFolders;

        return $folder;
    }

    public static function getFoldersByParentID($parentID) {
        $folders = self::query()->where('parent_id', $parentID)->get();

        foreach($folders as $folder) {
            if($folder->is_client) {
                $folder->password_records = Password::getAllPasswordsWithDetailsByClientID($folder->client_id);
            }

            $childrenFolders = self::getFoldersByParentID($folder->id);
            $folder->children_folders = $childrenFolders;
        }

        return $folders;
    }
}