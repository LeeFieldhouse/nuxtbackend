<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function mostPopular(){
        try {
        $mostPopular = Tag::select('tag')
            ->groupBy('tag')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();

            return response()->json($mostPopular);
        }catch(\Exception $e){
            dd($e);
        }
    }
}
