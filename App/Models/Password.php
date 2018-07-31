<?php

namespace App\Models;

use \Core\Model;
use \Core\Crypt;

class Password extends Model
{
    protected static $table = 'password_records';
    protected static $fillable = ['title', 'url', 'username', 'email', 'password', 'notes', 'created_by', 'created_at', 'password_record_id', 'client_id', 'field_key', 'field_value', 'title'];

    public static function getAllPasswordsWithDetailsByClientID($clientID) {
        $passwords = self::query()
            ->table('password_record_clients')
            ->where('client_id', $clientID)
            ->join('inner', ['password_records' => ['id' => 'password_record_id']])
            ->get();

        foreach($passwords as $password) {
            $password->password = Crypt::decrypt($password->password);
            $password->url = Crypt::decrypt($password->url);
            $password->username = Crypt::decrypt($password->username);
            $password->email = Crypt::decrypt($password->email);

            $passwordTags = self::query()
                ->table('password_record_tags')
                ->where('password_record_id', $password->id)
                ->get();
            $password->tags = $passwordTags;

            $passwordEntryFields = self::query()
                ->table('password_record_entry_fields')
                ->where('password_record_id', $password->id)
                ->get();
            
            foreach($passwordEntryFields as $passwordEntryField) {
                $passwordEntryField->field_value = Crypt::decrypt($passwordEntryField->field_value);
            }

            $password->entry_fields = $passwordEntryFields;

            $clients = Client::getClientsByPasswordID($password->id);
            $password->clients = $clients;
        }

        return $passwords;
    }

    public static function getPasswordWithDetailsByID($id) {
        $password = self::query()
            ->where('id', $id)
            ->getOne();

        $password->password = Crypt::decrypt($password->password);
        $password->url = Crypt::decrypt($password->url);
        $password->username = Crypt::decrypt($password->username);
        $password->email = Crypt::decrypt($password->email);

        $passwordTags = self::query()
            ->table('password_record_tags')
            ->where('password_record_id', $id)
            ->get();
        $password->tags = $passwordTags;

        $passwordEntryFields = self::query()
            ->table('password_record_entry_fields')
            ->where('password_record_id', $id)
            ->get();

        foreach($passwordEntryFields as $passwordEntryField) {
            $passwordEntryField->field_value = Crypt::decrypt($passwordEntryField->field_value);
        }

        $password->entry_fields = $passwordEntryFields;

        $clients = Client::getClientsByPasswordID($password->id);
        $password->clients = $clients;

        return $password;
    }
}