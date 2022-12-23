<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserHelper
{
    public static function getRole($user_id)
    {
        if ($user_id == '0')
            return "Owner";
        elseif ($user_id == '1')
            return "Manajer";
        elseif ($user_id == '2')
            return "Teknisi";
        else return "Kasir";
    }

    public static function getJK($user_jk)
    {
        if ($user_jk == "L"){
            return "Laki-laki";
        } else {
            return "Perempuan";
        }
    }
}
