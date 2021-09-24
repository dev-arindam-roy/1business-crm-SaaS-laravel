<?php

namespace App\Traits;
use App\Models\User;
use App\Models\Subdomain;

trait HelperTrait {
    
    public static function emailExistOrNot($email)
    {
        $user = User::where('email_id', $email)->first();
        if (empty($user)) {
            return json_encode(true);
        }
        return json_encode(false);
    }

    public static function contactNumberExistOrNot($contactNumber)
    {
        $user = User::where('mobile_number', $contactNumber)->first();
        if (empty($user)) {
            return json_encode(true);
        }
        return json_encode(false);
    }

    public static function subdomainExistOrNot($subDomain)
    {
        $subdomain = Subdomain::where('name', $subDomain)->first();
        if (empty($subdomain)) {
            return json_encode(true);
        }
        return json_encode(false);
    }
}