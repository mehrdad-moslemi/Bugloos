<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function count(Request $request){
        return response()->json([
            'count' => Log::filter($request->all())->count()
        ]);
    }
}
