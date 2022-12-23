<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ApiHelper
{

    public static function getResponse($request)
    {
        $response = Route::dispatch($request);
        $responseBody = json_decode($response->getContent(), false);

        if ($responseBody == null)
            abort(503, "API is not responding");

        return $responseBody;
    }

}
