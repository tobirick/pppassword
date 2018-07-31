<?php

namespace App\Models;

use \Core\Model;

class Client extends Model
{
    protected static $table = 'clients';
    protected static $fillable = ['name', 'email', 'notes', 'city', 'plz', 'street', 'created_by', 'created_at', 'phone', 'mobile_phone'];

    public static function getClientsByPasswordID($id)
    {
        $clients = self::query()
            ->table('password_record_clients')
            ->select('clients.*')
            ->where('password_record_id', $id)
            ->join('inner', ['clients' => ['id' => 'client_id']])
            ->get();

        return $clients;
    }
}