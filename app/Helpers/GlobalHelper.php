<?php
namespace App\Helpers;
use App\Traits\HelperTrait;

class GlobalHelper {

    use HelperTrait;

    public static function generateToken($id = '')
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $token = $id;
        for ($i = 0; $i < 60; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }
        return base64_encode($token);
    }
}