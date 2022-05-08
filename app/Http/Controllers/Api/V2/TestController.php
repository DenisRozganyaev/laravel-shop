<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        return response()->json(['name' =>  'v1/' . __CLASS__]);
    }
}
