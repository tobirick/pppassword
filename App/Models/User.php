<?php

namespace App\Models;

use \Core\Model;

class User extends Model
{
    protected static $table = 'user_details';
    protected static $fillable = ['email', 'username', 'first_name', 'last_name', 'city', 'plz', 'street', 'notes', 'phone', 'mobile_phone'];

    public static function getUserDetails() {
        $users = self::query()->select()->join('right', [
            'users' => ['id' => 'user_id']
        ])->get();

        return $users;
    }

    public static function getUserDetail($id) {
        $user = self::query()->select()->join('right', [
            'users' => ['id' => 'user_id']
        ])->getOne();

        return $user;
    }
}