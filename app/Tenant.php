<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = "tenants";

    public static function getTenant()
    {
        $url = request()->getHttpHost();
        $url_array = explode('.', $url);
        $subdomain = $url_array[0];

        if($subdomain == 'www')
        {
            $subdomain = $url_array[1];
        }

        $tenant  = Tenant::where('subdomain', 'LIKE', $subdomain)->first();
        
        if($tenant != "wildcard")
        {
            return "Welcome ".$tenant->name;
        }
        return view('welcome');

        if(!$tenant)
        {
            return view('tenant-not-found')->with([ 'tenant' => $subdomain ]);
        }
    }
}