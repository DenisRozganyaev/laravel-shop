<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        return response()->json(['name' =>  'v2/' . __CLASS__]);
    }
}
