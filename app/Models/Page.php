<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Auth;

class Page extends Eloquent
{

    protected $table ='pages';
    protected $guarded = ['_token'];

    public static function access()
    {
        $access_list = [ 
            '0' => 'Accest fara cont',
            '1' => 'Acces client',
            '5' => 'Acces owner',
            '10' => 'Acces administrator',
        ];

        if($user = Auth::user()) {
            foreach($access_list as $access => $label) {
                if($user->access_level < $access)
                    unset($access_list[$access]);
            }
        }
        return $access_list;
    }

}